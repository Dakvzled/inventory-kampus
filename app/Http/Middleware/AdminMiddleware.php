<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// Import the Auth facade
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if the user is authenticated AND if their 'type' is 'admin'
        if (Auth::check() && Auth::user()->type == "admin") {
            // If they are an admin, allow the request to proceed
            return $next($request);
        }

        // 2. If the user is NOT an admin (or not logged in), stop the request
        // and return a 401 Unauthorized response.
        abort(401, 'Unauthorized Access!');
    }
}

