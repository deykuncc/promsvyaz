<?php

use App\Http\Middleware\RoleApiMiddleware;
use App\Http\Middleware\RoleWebMiddleware;
use App\Http\Middleware\UserApiMiddleware;
use App\Http\Middleware\UserWebMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
        $middleware->validateCsrfTokens(except: [
            'api/*'
        ]);

        $middleware->alias([
            'user-web' => UserWebMiddleware::class,
            'user-api' => UserApiMiddleware::class,
            'role-api' => RoleApiMiddleware::class,
            'role-web' => RoleWebMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
