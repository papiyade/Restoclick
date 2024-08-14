<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     protected function authenticated(Request $request, $user)
     {
         if ($user->role === 'superadmin') {
             return redirect()->route('superadmin.index');
         } elseif ($user->role === 'admin') {
             return redirect()->route('admin.index');
         } elseif ($user->role === 'serveur') {
             return redirect()->route('serveur.calendrier');
         }

         // Redirection par défaut pour les autres utilisateurs
         return redirect()->route('serveur.calendrier');
     }


    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/superadmin/index');
        }

        return back()->withErrors([
            'email' => 'Cet Email n\'existe pas dans l\'application.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
