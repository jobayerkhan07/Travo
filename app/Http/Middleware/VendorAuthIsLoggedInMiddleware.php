<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorAuthIsLoggedInMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('vendor_id') && (url(request()->path()) == 'vendor.showLogin' || url(request()->path()) == 'vendor.showRegister')) {
            return back();
        }
        return $next($request);
    }
}
