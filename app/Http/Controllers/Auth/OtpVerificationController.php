<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\RegistrationService;

class OtpVerificationController extends Controller
{
    protected RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function showVerifyForm(Request $request)
    {
        // Pastikan ada email dari proses registrasi
        $email = session('registered_email');
        if (!$email) {
            return redirect()->route('register')->with('error', 'Silakan daftar terlebih dahulu.');
        }

        // Kita simpan ulang email ke session agar tidak hilang saat reload halaman
        session()->keep(['registered_email']);

        return view('auth.verify_otp', compact('email'));
    }

    public function processVerification(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|numeric|digits:6',
        ]);

        $result = $this->registrationService->verifyOtp($request->email, $request->otp);

        if (!$result['status']) {
            session()->flash('registered_email', $request->email); // Kembalikan session
            return back()->with('error', $result['message']);
        }

        // Jika berhasil, arahkan ke halaman login atau dashboard
        return redirect()->route('register')->with('success', 'Akun terverifikasi! Silakan login.');
    }

    public function resendOtp(Request $request)
    {
        // Ambil email dari session
        $email = session('registered_email');
        
        if (!$email) {
            return redirect()->route('register')->with('error', 'Sesi telah habis, silakan daftar ulang.');
        }

        // Pertahankan session email
        session()->keep(['registered_email']);

        // Panggil service untuk proses resend
        $result = $this->registrationService->resendOtp($email);

        if (!$result['status']) {
            return back()->with('error', $result['message']);
        }

        return back()->with('success', $result['message']);
    }
}