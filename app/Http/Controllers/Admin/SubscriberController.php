<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    //
    public function index(Request $request)
    {
        $first_id = null;
        if($request->has('first_id')){
            $first_id = $request->first_id;
            session()->flash('first_id', $first_id);
            Notification::where('notifiable_type', Subscriber::class)->where('notifiable_id', $first_id)->update(['is_read' => true]);

        }
        $subscribers = Subscriber::orderByRaw(
            "CASE WHEN id = ? THEN 0 ELSE 1 END, id DESC",
            [$first_id]
        )->get();

        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        $last30days = Subscriber::whereBetween('created_at', [$startDate, $endDate])->count();
        return view('admin.subscriber.subscribers', compact('subscribers', 'last30days'));
    }
}
