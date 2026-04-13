<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegistrationApiController;
use App\Http\Controllers\Api\Auth\OtpVerificationApiController;
use App\Http\Controllers\Api\Auth\LoginApiController;
use App\Http\Controllers\Api\PendaftaranApiController;

// ==========================================
// RUTE PUBLIK (Bisa diakses tanpa login/token)
// ==========================================
Route::post('/register', [RegistrationApiController::class, 'processRegistration']);
Route::post('/verify-otp', [OtpVerificationApiController::class, 'verify']);
Route::post('/login', [LoginApiController::class, 'login']);


// ==========================================
// RUTE PRIVAT (Wajib menyertakan Bearer Token)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    
    // Mengecek data user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Endpoint untuk Submit/Edit Profil (Tahap 1)
    Route::post('/pendaftaran/profil', [PendaftaranApiController::class, 'storeProfil']);
    
}); 