<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppSettingController extends Controller
{
    //

    public function index()
    {

        return view('admin.settings.app_settings');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|max:256',
            'primary_contact' => 'required|max:20',
            'secondary_contact' => 'required|max:20',
            'contact_email' => 'required|email|max:256',
            'location' => 'required'
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Settings Saved Successfully!');
    }

    public function saveOrUpdateSetting(Request $request)
    {
        $validated = $request->validate([
            'key' => ['required', Rule::in([
                'registration_mail',
                'maintainence_mode',
                'social_login',
                'social_registrtion',
                'guest_download',
                'social_media_sharing'
            ])],
            'value' => ['required', Rule::in(['on', 'off'])]
        ]);

        Setting::updateOrCreate(
            ['key' => $validated['key']],
            ['value' => $validated['value']]
        );

        return response()->json(['status' => 'success', 'message' => 'Setting updated successfully']);
    }
}
