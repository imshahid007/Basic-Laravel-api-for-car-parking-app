<?php

use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use App\Http\Controllers\Api\V1\Auth\PasswordUpdateController;
use Illuminate\Support\Facades\Route;


//
Route::prefix("auth")->group(function () {
    Route::post("register", RegisterController::class);
    //
    Route::post('login', LoginController::class);


    // Authenticated routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('profile', action: [ProfileController::class, 'show']);
        Route::put('profile', action: [ProfileController::class, 'update']);
        // password update
        Route::put('password', PasswordUpdateController::class);
    });
});
