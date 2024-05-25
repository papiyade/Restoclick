<?php
// Dans AdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        abort(403, 'Accès interdit.');


    }
    protected function shouldPassThrough($request)
{
    $openRoutes = [
        'front-menu/*',
    ];

    foreach ($openRoutes as $route) {
        if ($request->is($route)) {
            return true;
        }
    }

    return false;
}
}
