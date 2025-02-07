<?php

namespace App\Services\Impl;

use App\Services\FileService;
use App\Services\UserAgentService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class UserAgentServiceImpl implements UserAgentService
{
    function detectDevice($userAgent)
    {
        if (preg_match('/mobile/i', $userAgent)) return 'Mobile';
        if (preg_match('/tablet/i', $userAgent)) return 'Tablet';
        if (preg_match('/laptop|notebook/i', $userAgent)) return 'Laptop';
        return 'Desktop';
    }

    function detectBrowser($userAgent){
        if (strpos($userAgent, 'Brave') !== false || strpos($userAgent, 'Vivaldi') !== false) return 'Brave';
        if (strpos($userAgent, 'Opera') !== false || strpos($userAgent, 'OPR') !== false) return 'Opera';
        if (strpos($userAgent, 'Chrome') !== false) return 'Chrome';
        if (strpos($userAgent, 'Firefox') !== false) return 'Firefox';
        if (strpos($userAgent, 'Safari') !== false && strpos($userAgent, 'Chrome') === false) return 'Safari';
        if (strpos($userAgent, 'Edge') !== false) return 'Edge';
        return 'Other';
    }

    function detectOS($userAgent){
        if (strpos($userAgent, 'Windows') !== false) return 'Windows';
        if (strpos($userAgent, 'Mac OS') !== false) return 'macOS';
        if (strpos($userAgent, 'Linux') !== false) return 'Linux';
        if (strpos($userAgent, 'Android') !== false) return 'Android';
        if (strpos($userAgent, 'iPhone') !== false) return 'iOS';
        return 'Other';
    }

    function getLocationFromIP($ip){
        try {
            $response = Http::get("http://ip-api.com/json/{$ip}");
            $data = $response->json();

            if (isset($data['status']) && $data['status'] === 'fail') {
                return 'Unknown Location';
            }

            $city = $data['city'] ?? 'Unknown City';
            $country = $data['country'] ?? 'Unknown Country';

            return "{$city}, {$country}";
        } catch (\Exception $e) {
            return 'Unknown Location';
        }
    }
}
