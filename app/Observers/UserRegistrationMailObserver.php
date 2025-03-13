<?php

namespace App\Observers;

use App\Facades\Settings;
use App\Mail\RegistrationMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserRegistrationMailObserver
{
    //
    public function created(User $user){

        try{
            if(Settings::get('registration_mail', 'off') == 'on'){
                Mail::to($user->email)->send(new RegistrationMail());
            }
        }catch(\Exception $e){
            Log::error('Error sending mail : ' . $e->getMessage());
        }

    }
}
