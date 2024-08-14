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

        if ($user) {
            if ($user->role === 'superadmin') {
                return redirect()->route('superadmin.users.index');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'serveur') {
                return redirect()->route('serveur.calendrier');
            }
        }

        return $next($request);
    }
}

