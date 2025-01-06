<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            return redirect('/login'); // Redirect to login if not authenticated
        }

        // Check if the user has one of the specified roles
        if (!in_array(auth()->user()->role, $roles)) {
            return redirect('/'); // Redirect to home or any other page if the role does not match
        }

        return $next($request); // Proceed to the next middleware or request
    }
}