<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\Auth\PasswordResetController;

// ADMIN
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendaftarController;

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/buku-panduan', function () {
    return view('panduan.index');
})->name('panduan');

// --------------------------------------------------------
// 1. Rute untuk Tamu (Belum Login)
// --------------------------------------------------------
Route::middleware('guest')->group(function () {
    
    // Register & OTP
    Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegistrationController::class, 'processRegistration'])->name('register.process');
    Route::get('/verify-otp', [OtpVerificationController::class, 'showVerifyForm'])->name('otp.verify');
    Route::post('/verify-otp', [OtpVerificationController::class, 'processVerification'])->name('otp.process');
    // Tambahkan baris ini di bawahnya:
    Route::post('/resend-otp', [OtpVerificationController::class, 'resendOtp'])->name('otp.resend');

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'processLogin'])->name('login.process');

    Route::get('/lupa-password', [PasswordResetController::class, 'showRequestForm'])->name('password.request');
    Route::post('/lupa-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    
    // Rute Buat Password Baru
    Route::get('/password-baru/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password-baru', [PasswordResetController::class, 'updatePassword'])->name('password.update');
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

    // --- RUTE PENDAFTARAN MULTI-STEP BARU ---
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    
    // Redirect rute 'buat' yang lama agar otomatis masuk ke step 1
    Route::get('/pendaftaran/buat', function() {
        return redirect()->route('pendaftaran.step', 1);
    })->name('pendaftaran.create');

    // Rute dinamis untuk 9 Step
    Route::get('/pendaftaran/step/{step}', [PendaftaranController::class, 'createStep'])->name('pendaftaran.step');
    Route::post('/pendaftaran/step/{step}', [PendaftaranController::class, 'storeStep'])->name('pendaftaran.step.store');
    // ----------------------------------------

    // Rute Edit & Update (Untuk Revisi/Pengajuan Ulang)
    Route::get('/pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/{id}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
});

// --- RUTE ADMIN ---
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Rute yang bisa diakses tanpa login
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    });

    // Rute yang PROTECTED (Harus login admin)
    Route::middleware('auth:admin')->group(function () {
    
            // Dashboard (Dinamis)
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // Manajemen Pendaftar
            Route::get('/pendaftar', [PendaftarController::class, 'index'])->name('pendaftar.index');
            Route::post('/pendaftar/{id}/status', [PendaftarController::class, 'updateStatus'])->name('pendaftar.updateStatus');

            Route::get('/notifikasi', function () {return view('admin.notifikasi.index');
            })->name('notifikasi.index');

            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        });
});