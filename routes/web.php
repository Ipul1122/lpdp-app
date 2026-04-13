<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PendaftaranStep2Controller;
use App\Http\Controllers\PendaftaranStep3Controller;
use App\Http\Controllers\PendaftaranStep4Controller;
use App\Http\Controllers\PendaftaranStep5Controller;
use App\Http\Controllers\PendaftaranStep6Controller;
use App\Http\Controllers\PendaftaranStep7Controller;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\ProfileController;

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

   // --- RUTE PENDAFTARAN MULTI-STEP ---
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Redirect rute 'buat' yang lama agar otomatis masuk ke step 1
    Route::get('/pendaftaran/buat', function() {
        return redirect()->route('pendaftaran.step1');
    })->name('pendaftaran.create');

    // TAHAP 1 (Profil & KTP)
    Route::get('/pendaftaran/step/1', [PendaftaranController::class, 'create'])->name('pendaftaran.step1');
    Route::post('/pendaftaran/step/1', [PendaftaranController::class, 'store'])->name('pendaftaran.step1.store');

    // TAHAP 2 (Industri Pendukung)
    Route::get('/pendaftaran/step/2', [PendaftaranStep2Controller::class, 'create'])->name('pendaftaran.step2');
    Route::post('/pendaftaran/step/2', [PendaftaranStep2Controller::class, 'store'])->name('pendaftaran.step2.store');

    // TAHAP 3 (Universitas)
    Route::get('/pendaftaran/step/3', [PendaftaranStep3Controller::class, 'create'])->name('pendaftaran.step3');
    Route::post('/pendaftaran/step/3', [PendaftaranStep3Controller::class, 'store'])->name('pendaftaran.step3.store');

    // TAHAP 4 (Profil & Biodata)
    Route::get('/pendaftaran/step/4', [PendaftaranStep4Controller::class, 'create'])->name('pendaftaran.step4');
    Route::post('/pendaftaran/step/4', [PendaftaranStep4Controller::class, 'store'])->name('pendaftaran.step4.store');

    Route::get('/pendaftaran/step/5', [PendaftaranStep5Controller::class, 'create'])->name('pendaftaran.step5');
    Route::post('/pendaftaran/step/5', [PendaftaranStep5Controller::class, 'store'])->name('pendaftaran.step5.store');

    Route::get('/pendaftaran/step/6', [PendaftaranStep6Controller::class, 'create'])->name('pendaftaran.step6');
    Route::post('/pendaftaran/step/6', [PendaftaranStep6Controller::class, 'store'])->name('pendaftaran.step6.store');

    Route::get('/pendaftaran/step/7', [PendaftaranStep7Controller::class, 'create'])->name('pendaftaran.step7');
    Route::post('/pendaftaran/step/7', [PendaftaranStep7Controller::class, 'store'])->name('pendaftaran.step7.store');
    
    // Rute Edit & Update (Untuk Revisi Admin) tetap di Controller Utama
    // Route::get('/pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    // Route::put('/pendaftaran/{id}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
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
            
            // Mengizinkan metode GET dan POST sekaligus
            Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
        });
});