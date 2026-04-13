<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek secara spesifik apakah email terdaftar
        $userExists = User::where('email', $request->email)->exists();
        if (!$userExists) {
            return back()->with('error', 'Email belum terdaftar di sistem kami.');
        }

        // Cek kecocokan password & login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah user belum verifikasi OTP
            if (is_null($user->email_verified_at)) {
                // Logout paksa
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Kembalikan ke halaman OTP
                return redirect()->route('otp.verify')
                    ->with('registered_email', $user->email)
                    ->with('error', 'Silakan verifikasi OTP terlebih dahulu sebelum login.');
            }
            // ----------------------------

            $request->session()->regenerate();
            
            // Tambahkan pesan sukses di sini untuk ditangkap oleh Dashboard
            return redirect()->intended('/dashboard')->with('success', 'Telah berhasil login!');
        }

        // Jika email ada tapi gagal login, berarti password salah
        return back()->with('error', 'Password yang Anda masukkan salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Tambahkan toast saat berhasil keluar
        return redirect('/login')->with('success', 'Anda telah berhasil keluar aplikasi.');
    }
}