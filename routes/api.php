<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegistrationApiController;
use App\Http\Controllers\Api\Auth\OtpVerificationApiController;
use App\Http\Controllers\Api\Auth\LoginApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [RegistrationApiController::class, 'processRegistration']);
Route::post('/verify-otp', [OtpVerificationApiController::class, 'verify']);
Route::post('/login', [LoginApiController::class, 'login']);