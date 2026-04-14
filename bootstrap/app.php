<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->report(function (\Throwable $e) {
            error_log("======= LARAVEL ORIGINAL ERROR =======");
            error_log($e->getMessage());
            error_log($e->getFile() . ':' . $e->getLine());
            error_log("======================================");
        });
    })->create();

if (isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] === 'production') {
    $app->useStoragePath('/tmp/storage');
    @mkdir('/tmp/storage/framework/views', 0777, true);
    @mkdir('/tmp/storage/framework/cache', 0777, true);
    @mkdir('/tmp/storage/logs', 0777, true);
}

return $app;
