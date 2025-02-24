<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    //

    public function index(){

        return view('admin.settings.app_settings');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'address' => 'required|max:256',
            'primary_contact' => 'required|max:20',
            'secondary_contact' => 'required|max:20',
            'contact_email' => 'required|email|max:256',
            'location' => 'required'
        ]);

        foreach($validated as $key => $value){
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Settings Saved Successfully!');

    }
}
