<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->role === 'superadmin') {
            return redirect()->route('superadmin.users.index');
        }

        return $next($request);
    }
}

