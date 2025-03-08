<?php

namespace App\Http\Middleware;

use App\Facades\Settings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestDownloadMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Settings::get('guest_download', config('app.guest_download')) == "off") {
            if (Auth::check()) {
                return $next($request);
            }
            return redirect()->route('login')->with('warning', 'Authentication Required!');
        } else {
            return $next($request);
        }
    }
}
