<?php

// Dans SuperAdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->hasRole('superadmin')) {
            return $next($request);
        }

        abort(403, 'Accès interdit.');
    }
}
