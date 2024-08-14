<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Autres middlewares...

    protected $routeMiddleware = [
        // Autres middlewares...
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'superadmin' => \App\Http\Middleware\SuperAdminMiddleware::class,
        'serveur' => \App\Http\Middleware\ServeurMiddleware::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        \App\Http\Middleware\RedirectAfterLogin::class,
        'redirect.if.authenticated' => \App\Http\Middleware\RedirectIfAuthenticated::class,



    ];

    // Autres configurations...
}
