<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Source\Wrapper;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(remove: [
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $throwable) {
            $statusCode = method_exists($throwable, 'getStatusCode') ? $throwable->getStatusCode() : 500;

            return Wrapper::_response([
                'Message'=>$throwable->getMessage(),
                'Info'=>[
                    // 'trace'=>$throwable->getTrace(),
                    'line'=>$throwable->getLine(),
                    'file'=>$throwable->getFile(),
                ]
            ], $statusCode);
        });
    })->create();
