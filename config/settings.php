<?php

return [
    'default_profile_image' => 'assets/images/default/default_user.webp',
    'default_settings' => [
        [
            'key' => 'site_name',
            'value' => env('APP_NAME', 'PolyBookLib'),
        ],
        [
            'key' => 'logo',
            'value' => env('APP_LOGO', '/favicon.ico'),
        ],
        [
            'key' => 'app_start_date',
            'value' => env('APP_START_DATE', '2025-01-01 10:10:00'),
        ],
        [
            'key' => 'contact_email',
            'value' => env('APP_EMAIL', 'info@polybooklib.com'),
        ],
        [
            'key' => 'address',
            'value' => env('APP_ADDRESS', '123 Main Street, Cityville'),
        ],
        [
            'key' => 'primary_contact',
            'value' => env('APP_PRIMARY_CONTACT', '+91 1234567890'),
        ],
        [
            'key' => 'secondary_contact',
            'value' => env('APP_SECONDARY_CONTACT', '9876543210'),
        ],

    ],

];
