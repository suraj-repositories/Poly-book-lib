<?php

namespace App\Http\Middleware;

use App\Facades\Settings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintainenceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->routeIs('web.under_maintainence')) {
            return $next($request);
        }

        if (Settings::get('maintainence_mode', 'off') == 'on') {
            return redirect()->route('web.under_maintainence');
        }

        return $next($request);
    }
}
