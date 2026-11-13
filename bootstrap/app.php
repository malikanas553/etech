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
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create()
    // Bootstrap caches (APP_*_CACHE in .env) point at D:/cache/etech. Laravel only treats
    // paths starting with "/" or "\" as absolute, so register the Windows drive prefix too.
    ->addAbsoluteCachePathPrefix('D:');
