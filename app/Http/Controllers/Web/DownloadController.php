<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Download;
use App\Models\Transaction;
use App\Models\User;
use App\Services\FileService;
use App\Services\UserAgentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;

class DownloadController extends Controller
{

    private $fileService;
    private $userAgentService;

    public function __construct(FileService $fileService, UserAgentService $userAgentService)
    {
        $this->fileService = $fileService;
        $this->userAgentService = $userAgentService;
    }

    //
    public function download($type, $id, Request $request)
    {
        $modelClass = $this->getModelClass($type);

        if (!$modelClass) return abort(404);

        $item = $modelClass::findOrFail($id);

        if (!isset($item->file) || !$this->fileService->fileExists($item->file->file_path, 'private')) {
            abort(404, 'Resource Not Available!');
        }

        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');

        $deviceType = $this->userAgentService->detectDevice($userAgent);
        $browser = $this->userAgentService->detectBrowser($userAgent);
        $os = $this->userAgentService->detectOS($userAgent);
        $location = $this->userAgentService->getLocationFromIP($ip);

        $isPurchased = false;
        if (Auth::check()) {
            $user = User::find(Auth::id());
            $isPurchased = $user->isPurchased($type, $id);
        }

        if ($item->price <= 0 || $isPurchased) {

            Download::create([
                'user_id' => Auth::id(),
                'downloadable_id' => $id,
                'downloadable_type' => $modelClass,
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'device_type' => $deviceType,
                'browser' => $browser,
                'os' => $os,
                'location' => $location
            ]);
            return response()->download(storage_path("app/private/{$item->file->file_path}"));
        }

        return redirect()->back()->with('error', 'You must purchase this item first.');
    }

    private function getModelClass($type)
    {
        return match ($type) {
            'book' => Book::class,
            default => null,
        };
    }

    public function purchase($type, $id, Request $request)
    {

        $modelClass = $this->getModelClass($type);
        if (!$modelClass) return abort(404);

        $item = $modelClass::findOrFail($id);

        if (!isset($item->file) || !$this->fileService->fileExists($item->file->file_path, 'private')) {
            abort(404, 'Resource Not Available!');
        }

        if (Auth::check()) {
            $user = User::find(Auth::id());
            $isPurchased = $user->isPurchased($type, $id);
            if ($isPurchased) {
                return response()->json([
                    'already_purchased' => true,
                    'redirect_url' => route('download', ['type' => $type, 'id' => $id])
                ]);
            }
        }

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $orderData = [
            'receipt'         => 'T_' . uniqid(),
            'amount'          => $item->price * 100, // (₹1 = 100 paise)
            'currency'        => 'INR',
            'payment_capture' => 1
        ];

        $razorpayOrder = $api->order->create($orderData);

        return response()->json([
            'order_id' => $razorpayOrder['id'],
            'amount' => $razorpayOrder['amount']
        ]);
    }

    public function paymentSuccess($type, $id, Request $request)
    {

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $modelClass = $this->getModelClass($type);
        $item = $modelClass::findOrFail($id);

        try {
            $paymentId = $request->razorpay_payment_id ?? null;
            if (!$paymentId) {
                return $this->handleTransactionFailure($item, $modelClass, 'Invalid payment ID.');
            }

            $payment = $api->payment->fetch($paymentId);

            $metadata = [
                'payment_id' => $payment->id,
                'method' => $payment->method,
                'email' => $payment->email ?? null,
                'contact' => $payment->contact ?? null,
                'currency' => $payment->currency,
                'status' => $payment->status,
            ];

            if ($payment->status !== 'captured') {
                return $this->handleTransactionFailure($item, $modelClass, 'Payment failed.', $metadata);
            }

            $this->createTransaction($item, $modelClass, 'completed', $metadata, $payment->amount / 100);
            return redirect()->route('download', ['type' => $type, 'id' => $id]);
        } catch (\Exception $e) {
            return $this->handleTransactionFailure($item, $modelClass, 'Error while retrieving payment data: ' . $e->getMessage());
        }
    }

    /**
     * Creates a transaction record.
     */
    private function createTransaction($item, $modelClass, $status, $metadata, $amount)
    {
        return Transaction::create([
            'user_id' => auth()->id(),
            'transaction_id' => $metadata['payment_id'] ?? uniqid(),
            'amount' => $amount,
            'status' => $status,
            'payment_method' => $metadata['method'] ?? 'unknown',
            'metadata' => json_encode($metadata),
            'purchasable_id' => $item->id,
            'purchasable_type' => $modelClass,
        ]);
    }

    /**
     * Handles failed transactions and redirects with an error message.
     */
    private function handleTransactionFailure($item, $modelClass, $errorMessage, $metadata = [])
    {
        $metadata["error"] = $errorMessage;
        $this->createTransaction($item, $modelClass, 'failed', $metadata, $item->price);
        return redirect()->back()->with('error', $errorMessage);
    }
}
