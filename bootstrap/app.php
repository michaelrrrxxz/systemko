<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\SleepMiddleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Inertia\Inertia;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,

        ]);
        $middleware->alias([
            'prevent-back-history' => \App\Http\Middleware\PreventBackHistory::class,
           'sleep' => SleepMiddleware::class,
           'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
           'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
           'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (HttpException $exception, $request) {
            if ($exception->getStatusCode() === 403) {
                return Inertia::render('Errors/403', [
                    'status' => 403,
                    'message' => 'You do not have the required permissions to access this page.',
                ])->toResponse($request)->setStatusCode(403);
            }
        });
    })->create();
