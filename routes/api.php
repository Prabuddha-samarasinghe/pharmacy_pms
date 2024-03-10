<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\MedicationController;
use App\Http\Controllers\Api\CustomerController;

Route::post("register", [ApiController::class, "register"]);
Route::post("login", [ApiController::class, "login"]);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get("profile", [ApiController::class, "profile"]);
    Route::get("refresh", [ApiController::class, "refreshToken"]);
    Route::get("logout", [ApiController::class, "logout"]);
});

Route::resource("medication", MedicationController::class);

Route::group(['prefix' => 'api'], function () {
    Route::apiResource('customers', CustomerController::class);
});
