<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Services\UserAgentService;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    //

    private $userAgentService;

    public function __construct(UserAgentService $userAgentService)
    {
        $this->userAgentService = $userAgentService;
    }

    public function store(Request $request){
        $validated = $request->validate([
            'email' => 'required'
        ]);

        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');

        $deviceType = $this->userAgentService->detectDevice($userAgent);
        $browser = $this->userAgentService->detectBrowser($userAgent);
        $os = $this->userAgentService->detectOS($userAgent);
        $location = $this->userAgentService->getLocationFromIP($ip);

        Subscriber::create([
            'email' => $validated['email'],
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'device_type' => $deviceType,
            'browser' => $browser,
            'os' => $os,
            'location' => $location
        ]);

        return response('OK');
    }

}
