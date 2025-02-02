<?php

return [
    'default_settings' => [
        [
            'key' => 'site_name',
            'value' => env('APP_NAME', 'PolyBookLib'),
        ],
        [
            'key' => 'contact_email',
            'value' => env('APP_EMAIL', 'info@polybooklib.com'),
        ],
        [
            'key' => 'logo',
            'value' => env('APP_LOGO', '/favicon.ico'),
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
