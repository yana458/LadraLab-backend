<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION EXCEPTION
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            ValidationException $e,
            $request
        ) {

            return response()->json([
                'message' => 'Datos inválidos',
                'errors' => $e->errors()
            ], 422);
        });

        /*
        |--------------------------------------------------------------------------
        | AUTHENTICATION EXCEPTION
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            AuthenticationException $e,
            $request
        ) {

            return response()->json([
                'message' => 'No autenticado'
            ], 401);
        });

        /*
        |--------------------------------------------------------------------------
        | MODEL NOT FOUND
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            ModelNotFoundException $e,
            $request
        ) {

            return response()->json([
                'message' => 'Recurso no encontrado'
            ], 404);
        });

        /*
        |--------------------------------------------------------------------------
        | ROUTE NOT FOUND
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            NotFoundHttpException $e,
            $request
        ) {

            return response()->json([
                'message' => 'Ruta no encontrada'
            ], 404);
        });

        /*
        |--------------------------------------------------------------------------
        | GENERIC ERROR
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            Throwable $e,
            $request
        ) {

            return response()->json([
                'message' => 'Error interno del servidor'
            ], 500);
        });

    })->create();
