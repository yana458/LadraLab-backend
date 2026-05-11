<?php

use Illuminate\Support\Facades\Route;
// AUTH
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AdminUserController;
// CLIENT
use App\Http\Controllers\PetController;
use App\Http\Controllers\ReservationController;
// STAFF / ADMIN
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\DailyReportController;
// SERVICES
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MediaController;

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

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get(
        '/services/{service}/availability',
        [ServiceController::class, 'availability']
    );
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/services', [ServiceController::class, 'store']);
    Route::patch('/services/{service}', [ServiceController::class, 'update']);
});

/*
|--------------------------------------------------------------------------
| ADMIN USERS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
    Route::get('/users', [AdminUserController::class, 'index']);
    Route::post('/users', [AdminUserController::class, 'store']);
    Route::get('/users/{user}', [AdminUserController::class, 'show']);
    Route::patch('/users/{user}', [AdminUserController::class, 'update']);
});

/*
|--------------------------------------------------------------------------
| CLIENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'role:client'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PETS
    |--------------------------------------------------------------------------
    */

    Route::apiResource('pets', PetController::class)
    ->except(['create', 'edit']);

    /*
    |--------------------------------------------------------------------------
    | RESERVATIONS
    |--------------------------------------------------------------------------
    */

    Route::apiResource('reservations', ReservationController::class)
    ->except(['create', 'edit']);

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

Route::middleware(['auth:sanctum', 'role:staff,admin'])->prefix('staff')->group(function () {

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

Route::middleware(['auth:sanctum', 'role:staff,admin'])->group(function () {

    Route::apiResource('resources', ResourceController::class)
    ->except(['create', 'edit']);
});

/*
|--------------------------------------------------------------------------
| DAILY REPORTS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'role:staff,admin'])->group(function () {

    Route::apiResource('daily-reports', DailyReportController::class)
    ->except(['create', 'edit']);

    /*
    |--------------------------------------------------------------------------
    | MEDIA
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/daily-reports/{dailyReport}/media',
        [MediaController::class, 'index']
    );

    Route::post(
        '/daily-reports/{dailyReport}/media',
        [MediaController::class, 'store']
    );

    Route::delete(
        '/daily-reports/{dailyReport}/media/{media}',
        [MediaController::class, 'destroy']
    );
});

/*
|--------------------------------------------------------------------------
| DAILY REPORTS - CLIENT + STAFF
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum'])->group(function () {

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
