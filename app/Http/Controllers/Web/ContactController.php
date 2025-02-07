<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index(){
       return view('web.contact.contact');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'bail|required|string|max:256',
            'email' => 'bail|required|string|email|max:256',
            'subject' => 'bail|required|string|max:256',
            'message' => 'bail|required|string|min:10',
        ]);

        Contact::create($validated);

        return response('OK');

    }

}
