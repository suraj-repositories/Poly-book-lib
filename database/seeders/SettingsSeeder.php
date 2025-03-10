<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // hero section
        HeroSection::create([
            'title' => 'Read, Discover, Download, Enjoy!',
            'caption' => 'Discover books and notes — download instantly, anytime!',
            'video_url' => config('app.tutorial_video_link'),
            'hero_image' => '',
            'about_image' => '',
        ]);

        //
        $defaultSettings = config('settings.default_settings');
        foreach ($defaultSettings as $setting) {

            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }

        SocialMedia::updateOrCreate(
            ['name' => 'github'],
            ['icon' => config('constants.social_media_icons.' . 'github' , 'bx bx-circle'), 'url' => config('constants.author_github_url') ]
        );



    }
}
