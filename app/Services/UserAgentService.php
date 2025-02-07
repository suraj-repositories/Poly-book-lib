<?php

namespace App\Services;

interface UserAgentService
{
    function detectDevice($userAgent);

    function detectBrowser($userAgent);

    function detectOS($userAgent);

    function getLocationFromIP($ip);

}
