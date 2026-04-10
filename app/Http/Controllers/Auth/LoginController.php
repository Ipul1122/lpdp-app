<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}