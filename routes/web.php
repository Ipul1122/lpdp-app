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
use App\Http\Controllers\NotifikasiController;

// ADMIN
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendaftarController;
use App\Http\Controllers\Admin\NotifikasiController as AdminNotifikasiController;
use App\Http\Controllers\Admin\SettingsController;

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/buku-panduan', function () {
    return view('panduan.index');
})->name('panduan');

Route::get('/syarat-pendaftaran', function () {
    return view('syaratPendaftaran');
})->name('syarat.pendaftaran');

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
    Route::post('/pendaftaran/draft/save', [PendaftaranController::class, 'saveDraft'])->name('pendaftaran.draft.save');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Redirect rute 'buat' yang lama agar otomatis masuk ke kategori selection
    Route::get('/pendaftaran/buat', function() {
        return redirect()->route('pendaftaran.kategori');
    })->name('pendaftaran.create');

    // Pemilihan Kategori Pendaftaran
    Route::get('/pendaftaran/kategori', [PendaftaranController::class, 'chooseCategory'])->name('pendaftaran.kategori');
    Route::post('/pendaftaran/kategori', [PendaftaranController::class, 'storeCategory'])->name('pendaftaran.kategori.store');

    // TAHAP 1 (Profil & KTP)
    Route::get('/pendaftaran/step/1', [PendaftaranController::class, 'create'])->name('pendaftaran.step1');
    Route::post('/pendaftaran/step/1', [PendaftaranController::class, 'store'])->name('pendaftaran.step1.store');

    // TAHAP 2 (Industri Pendukung)
    Route::get('/pendaftaran/step/2', [PendaftaranStep2Controller::class, 'create'])->name('pendaftaran.step2');
    Route::post('/pendaftaran/step/2', [PendaftaranStep2Controller::class, 'store'])->name('pendaftaran.step2.store');

    // TAHAP 3 (Universitas)
    Route::get('/pendaftaran/step/3', [PendaftaranStep3Controller::class, 'create'])->name('pendaftaran.step3');
    Route::post('/pendaftaran/step/3', [PendaftaranStep3Controller::class, 'store'])->name('pendaftaran.step3.store');

    // TAHAP 4 (Surat Rekomendasi)
    Route::get('/pendaftaran/step/4', [PendaftaranStep4Controller::class, 'create'])->name('pendaftaran.step4');
    Route::post('/pendaftaran/step/4', [PendaftaranStep4Controller::class, 'store'])->name('pendaftaran.step4.store');

    // TAHAP 5 (Essay Kontribusi)
    Route::get('/pendaftaran/step/5', [PendaftaranStep5Controller::class, 'create'])->name('pendaftaran.step5');
    Route::post('/pendaftaran/step/5', [PendaftaranStep5Controller::class, 'store'])->name('pendaftaran.step5.store');

    // TAHAP 6 (Surat Komitmen)
    Route::get('/pendaftaran/step/6', [PendaftaranStep6Controller::class, 'create'])->name('pendaftaran.step6');
    Route::post('/pendaftaran/step/6', [PendaftaranStep6Controller::class, 'store'])->name('pendaftaran.step6.store');

    // TAHAP 7 (Ringkasan & Kirim)
    Route::get('/pendaftaran/step/7', [PendaftaranStep7Controller::class, 'create'])->name('pendaftaran.step7');
    Route::post('/pendaftaran/step/7', [PendaftaranStep7Controller::class, 'store'])->name('pendaftaran.step7.store');
    Route::get('/pendaftaran/summary/pdf', [PendaftaranStep7Controller::class, 'exportPdf'])->name('pendaftaran.summary.pdf');
    
    // Rute Edit & Update (Untuk Revisi Admin) tetap di Controller Utama
    // Route::get('/pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    // Route::put('/pendaftaran/{id}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/mark-all-read', [NotifikasiController::class, 'markAllAsRead'])->name('notifikasi.markAllRead');
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
            Route::get('/pendaftar/export', [PendaftarController::class, 'exportCsv'])->name('pendaftar.export');
            Route::get('/pendaftar/export-pdf', [PendaftarController::class, 'exportPdfList'])->name('pendaftar.exportPdfList');
            Route::get('/pendaftar/{id}/pdf', [PendaftarController::class, 'exportPdf'])->name('pendaftar.pdf');
            Route::post('/pendaftar/{id}/status', [PendaftarController::class, 'updateStatus'])->name('pendaftar.updateStatus');
            Route::get('/audit-logs', [\App\Http\Controllers\Admin\AuditLogController::class, 'index'])->name('audit-logs.index');

            Route::get('/notifikasi', [AdminNotifikasiController::class, 'index'])->name('notifikasi.index');
            Route::post('/notifikasi/mark-all-read', [AdminNotifikasiController::class, 'markAllAsRead'])->name('notifikasi.markAllRead');

            Route::get('/pendaftar/infoPendaftar', [PendaftarController::class, 'infoPendaftar'])->name('pendaftar.infoPendaftar');
            
            // Pengaturan
            Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
            Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');
            Route::post('/settings/registration', [SettingsController::class, 'updateRegistrationLock'])->name('settings.updateRegistrationLock');

            // Mengizinkan metode GET dan POST sekaligus
            Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
        });
});