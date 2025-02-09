<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    //
    public function index()
    {
        $subscribers = Subscriber::orderBy('id', 'desc')->paginate(10);
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        $last30days = Subscriber::whereBetween('created_at', [$startDate, $endDate])->count();
        return view('admin.subscriber.subscribers', compact('subscribers', 'last30days'));
    }
}
