<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Check if the user is authenticated and their role is 'admin'
        if (Auth::check() && Auth::user()->role !== 'admin') {
            // If the user is not an admin, redirect them with an error message
            return redirect()->route('homePage')->with('error', 'Unauthorized access');
        }

        // Allow the request to proceed if the user is an admin
        return $next($request);
    }
}

