<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Ensure user is authenticated and has role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Proceed with request
        }

        // If not admin, abort with 403 Forbidden
        abort(403, 'Unauthorized access.');
    }
}
