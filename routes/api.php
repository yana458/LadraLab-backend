<?php

use Illuminate\Support\Facades\Route;
// AUTH
use App\Http\Controllers\Api\AuthController;
// CLIENT
use App\Http\Controllers\PetController;
use App\Http\Controllers\ReservationController;
// STAFF / ADMIN
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\DailyReportController;
// SERVICES
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {

    // Registro cliente
    Route::post('/register', [AuthController::class, 'register']);

    // Login
    Route::post('/login', [AuthController::class, 'login']);

    /*
    |--------------------------------------------------------------------------
    | Rutas autenticadas
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth:sanctum')->group(function () {

        // Logout
        Route::post('/logout', [AuthController::class, 'logout']);

        // Usuario autenticado
        Route::get('/me', [AuthController::class, 'me']);
    });
});

/*
|--------------------------------------------------------------------------
| SERVICES
|--------------------------------------------------------------------------
*/

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{service}', [ServiceController::class, 'show']);

/*
|--------------------------------------------------------------------------
| CLIENT
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PETS
    |--------------------------------------------------------------------------
    */

    Route::apiResource('pets', PetController::class);

    /*
    |--------------------------------------------------------------------------
    | RESERVATIONS
    |--------------------------------------------------------------------------
    */

    Route::apiResource('reservations', ReservationController::class);

    /*
    |--------------------------------------------------------------------------
    | CANCELAR RESERVA
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/reservations/{reservation}/cancel',
        [ReservationController::class, 'cancel']
    );
});

/*
|--------------------------------------------------------------------------
| STAFF
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->prefix('staff')->group(function () {

    // Pets del centro
    Route::get('/pets', [PetController::class, 'staffIndex']);
    Route::get('/pets/{pet}', [PetController::class, 'staffShow']);

    // Reservas del centro
    Route::get('/reservations', [ReservationController::class, 'staffIndex']);
    Route::post('/reservations', [ReservationController::class, 'staffStore']);

    Route::get(
        '/reservations/{reservation}',
        [ReservationController::class, 'staffShow']
    );

    Route::patch(
        '/reservations/{reservation}',
        [ReservationController::class, 'staffUpdate']
    );
});

/*
|--------------------------------------------------------------------------
| RESOURCES
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('resources', ResourceController::class);
});

/*
|--------------------------------------------------------------------------
| DAILY REPORTS
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('daily-reports', DailyReportController::class);

    Route::get(
        '/reservations/{reservation}/daily-reports',
        [DailyReportController::class, 'reservationReports']
    );

    Route::get(
        '/reservations/{reservation}/daily-reports/summary',
        [DailyReportController::class, 'summary']
    );
});


// // Rutas API de mascotas
// Route::apiResource('pets', PetController::class);
// Route::apiResource('reservations', ReservationController::class);
// Route::apiResource('resources', ResourceController::class);
