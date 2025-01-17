<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\PasswordUpdateController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
// Vehicles
use App\Http\Controllers\Api\V1\ParkingController;
// Zones
use App\Http\Controllers\Api\V1\VehicleController;
// Parkings
use App\Http\Controllers\Api\V1\ZoneController;
use Illuminate\Support\Facades\Route;

//
Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class);
    //
    Route::post('login', LoginController::class);
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', action: [ProfileController::class, 'show']);
    Route::put('profile', action: [ProfileController::class, 'update']);
    // password update
    Route::put('password', PasswordUpdateController::class);
    // logout
    Route::post('logout', LogoutController::class);

    // Vehicles
    Route::apiResource('vehicles', VehicleController::class);
    // Parkings
    Route::prefix('parkings')->group(function () {
        Route::post('start', [ParkingController::class, 'start']);
        Route::get('{parking}', [ParkingController::class, 'show']);
        Route::put('{parking}', [ParkingController::class, 'stop']);
    });

});

// Public routes
Route::get('zones', [ZoneController::class, 'index']);
