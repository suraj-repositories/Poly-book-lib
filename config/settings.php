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
        [
            'key' => 'location',
            'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3570.896423977319!2d80.28544827510751!3d26.491279578074945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399c383cda76b883%3A0x570e07ac70db62ee!2sGovernment%20Polytechnic%20Kanpur!5e0!3m2!1sen!2sin!4v1741599847319!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
        ],

    ],

];
