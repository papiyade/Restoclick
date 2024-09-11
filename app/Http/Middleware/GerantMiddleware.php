<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GerantMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->hasRole('gérant')) {
            return $next($request);
        }

        abort(403, 'Accès interdit.');
    }
}
