<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //

    public function index(){

        $notifications = Notification::latest()->get();

        return view('admin.notification.notification', compact('notifications'));
    }

    public function clearAll(){
        Notification::where('is_read', false)->update(['is_read' => true]);

        return redirect()->back();
    }
}
