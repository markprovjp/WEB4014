<?php

namespace App\Http;

class Kernel extends \Illuminate\Foundation\Http\Kernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Session\Middleware\StartSession::class,
        // \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, array<int, class-string|string>|class-string|string>
     */

     protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\EnsurePasswordIsConfirmed::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'Quantri' => \App\Http\Middleware\Quantri::class,
        'admin' => \App\Http\Middleware\Admin::class,
        'user' => \App\Http\Middleware\User::class,
        'guest' => \App\Http\Middleware\Guest::class,
     ];


    
}