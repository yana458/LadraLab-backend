<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ResourceController;

// Rutas API de mascotas
Route::apiResource('pets', PetController::class);
Route::apiResource('reservations', ReservationController::class);
Route::apiResource('resources', ResourceController::class);
