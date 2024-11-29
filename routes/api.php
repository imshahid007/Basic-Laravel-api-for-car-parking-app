<?php

use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use Illuminate\Support\Facades\Route;


//
Route::prefix("auth")->group(function () {
    Route::post("register", RegisterController::class);
    //
    Route::post('login', LoginController::class);


});
