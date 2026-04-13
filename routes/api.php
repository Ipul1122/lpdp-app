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
    Route::get('/user', function (Request $request) { return $request->user(); });

    // Rute Pendaftaran
    Route::post('/pendaftaran/profil', [PendaftaranApiController::class, 'storeProfil']);
    Route::post('/pendaftaran/industri', [PendaftaranApiController::class, 'storeIndustri']);
    Route::post('/pendaftaran/universitas', [PendaftaranApiController::class, 'storeUniversitas']);
    Route::post('/pendaftaran/biodata', [PendaftaranApiController::class, 'storeBiodata']);
    Route::post('/pendaftaran/rekomendasi', [PendaftaranApiController::class, 'storeRekomendasi']);
    Route::post('/pendaftaran/essay', [PendaftaranApiController::class, 'storeEssay']);
    Route::post('/pendaftaran/submit-final', [PendaftaranApiController::class, 'submitFinal']);
    // Endpoint untuk Mengambil Seluruh Data Pendaftaran (GET)
    Route::get('/pendaftaran', [PendaftaranApiController::class, 'getPendaftaranData']);
    Route::get('/pendaftaran/{id}', [PendaftaranApiController::class, 'show']);
});