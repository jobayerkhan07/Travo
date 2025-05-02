<?php

use App\Http\Middleware\AdminAuthIsLoggedInMiddleware;
use App\Http\Middleware\UserAuthCheckMiddleware;
use App\Http\Middleware\UserAuthIsLoggedInMiddleware;
use App\Http\Middleware\VendorAuthCheckMiddleware;
use App\Http\Middleware\VendorAuthIsLoggedInMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminAuthCheckMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin.authCheck' => AdminAuthCheckMiddleware::class,
            'admin.isLoggedIn' => AdminAuthIsLoggedInMiddleware::class,

            'vendor.authCheck' => VendorAuthCheckMiddleware::class,
            'vendor.isLoggedIn' => VendorAuthIsLoggedInMiddleware::class,

            'user.authCheck' => UserAuthCheckMiddleware::class,
            'user.isLoggedIn' => UserAuthIsLoggedInMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
