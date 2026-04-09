<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome'); // Ini bawaan Laravel
});

// --------------------------------------------------------
// 1. Rute untuk Tamu (Belum Login)
// --------------------------------------------------------
Route::middleware('guest')->group(function () {
    
    // Register & OTP
    Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegistrationController::class, 'processRegistration'])->name('register.process');
    Route::get('/verify-otp', [OtpVerificationController::class, 'showVerifyForm'])->name('otp.verify');
    Route::post('/verify-otp', [OtpVerificationController::class, 'processVerification'])->name('otp.process');

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'processLogin'])->name('login.process');
});

// --------------------------------------------------------
// 2. Rute untuk User (Sudah Login)
// --------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    

    // Halaman Dashboard Utama
    Route::get('/dashboard', function () {
        return view('dashboard.index'); // Pastikan file resources/views/dashboard/index.blade.php ada
    })->name('dashboard');
});