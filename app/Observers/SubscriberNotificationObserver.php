<?php

namespace App\Observers;

use App\Models\Notification;
use App\Models\Subscriber;
use App\Models\User;

class SubscriberNotificationObserver
{
    //

    public function created(Subscriber $subscriber){

        Notification::create([
            'user_id' => User::where('role', 'ADMIN')->value('id'),
            'title' => 'New Subscriber Alert!',
            'message' => 'A new subscriber has joined! Email: ' . $subscriber->email,
            'type' => 'subscriber',
            'notifiable_id' => $subscriber->id,
            'notifiable_type' => Subscriber::class,
        ]);

    }
}
