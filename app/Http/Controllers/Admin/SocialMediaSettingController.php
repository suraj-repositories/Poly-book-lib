<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaSettingController extends Controller
{
    //
    public function index()
    {
        $socialMedia = SocialMedia::pluck('url', 'name');
        $socialMedias = SocialMedia::get();

        return view('admin.settings.social_media', compact('socialMedia', 'socialMedias'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'twitter' => 'nullable|url',
            'github' => 'nullable|url',
            'telegram' => 'nullable|url',
            'reddit' => 'nullable|url',
        ]);


        foreach ($validated as $name => $url) {

            SocialMedia::updateOrCreate(
                ['name' => $name],
                ['icon' => config('constants.social_media_icons.' . $name, 'bx bx-circle'), 'url' => $url ]
            );
        }

        return back()->with('success', 'Social media links saved successfully.');
    }
}
