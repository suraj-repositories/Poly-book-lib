<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //
    public function index()
    {
        return view('web.contact.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'bail|required|string|max:256',
            'email' => 'bail|required|string|email|max:256',
            'subject' => 'bail|required|string|max:256',
            'message' => 'bail|required|string|min:10',
        ]);

        if(Auth::check()){
            $validated['user_id'] = Auth::id();
        }

        $contact = Contact::create($validated);

        return response('OK');
    }
}
