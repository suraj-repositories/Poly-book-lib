<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Download;
use App\Models\User;
use App\Services\FileService;
use App\Services\UserAgentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (!isset($item->file) || !$this->fileService->fileExists($item->file->file_path)) {
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
            $isPurchased = $user->transactions()->where('purchasable_id', $id)->where('purchasable_type', $modelClass)->exists();
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
            return response()->download(storage_path("app/public/{$item->file->file_path}"));
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


}
