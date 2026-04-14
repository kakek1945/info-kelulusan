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
        $exceptions->render(function (\Throwable $e) {
            echo "<div style='font-family:sans-serif; padding: 20px; background: #fff;'>";
            echo "<h2>🚨 LARAVEL FATAL ERROR: </h2>";
            echo "<p style='color:red; font-size:18px;'><b>" . $e->getMessage() . "</b></p>";
            echo "<p><b>File:</b> " . $e->getFile() . "</p>";
            echo "<p><b>Line:</b> " . $e->getLine() . "</p>";
            echo "</div>";
            exit;
        });
    })->create();

if (isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] === 'production') {
    $app->useStoragePath('/tmp/storage');
    @mkdir('/tmp/storage/framework/views', 0777, true);
    @mkdir('/tmp/storage/framework/cache', 0777, true);
    @mkdir('/tmp/storage/logs', 0777, true);
}

return $app;
