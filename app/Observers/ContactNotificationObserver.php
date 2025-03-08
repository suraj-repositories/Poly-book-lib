<?php

namespace App\Observers;

use App\Models\Contact;
use App\Models\Notification;
use App\Models\User;

class ContactNotificationObserver
{
    //
    public function created(Contact $contact)
    {
        Notification::create([
            'user_id' => User::where('role', 'ADMIN')->value('id'),
            'title' => 'New Contact Message',
            'message' => 'You have received a new contact message from ' . $contact->name,
            'type' => 'contact',
            'notifiable_id' => $contact->id,
            'notifiable_type' => Contact::class,
        ]);
    }
}
