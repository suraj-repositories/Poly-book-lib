<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Subscriber;
use App\Models\User;
use App\Services\UserAgentService;
use Illuminate\Http\Request;
use Mockery\Matcher\Subset;

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

        if(Subscriber::where('email', $validated['email'])->exists()){
            return response('Already Subscribed!');
        }

        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');

        $deviceType = $this->userAgentService->detectDevice($userAgent);
        $browser = $this->userAgentService->detectBrowser($userAgent);
        $os = $this->userAgentService->detectOS($userAgent);
        $location = $this->userAgentService->getLocationFromIP($ip);

        $subscriber = Subscriber::create([
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
