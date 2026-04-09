<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterAccountRequest;
use App\Services\Auth\RegistrationService;

class RegistrationController extends Controller
{
    // Inject Service via Constructor
    protected RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Menampilkan halaman form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Memproses data registrasi yang disubmit.
     */
    public function processRegistration(RegisterAccountRequest $request)
    {
        // $request->validated() hanya mengambil data yang sudah lolos aturan di RegisterAccountRequest
        $user = $this->registrationService->createNewAccount($request->validated());

        if (!$user) {
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem saat membuat akun. Silakan coba lagi.');
        }

        // Jika sukses, lempar pesan ke session untuk ditangkap SweetAlert di halaman login (atau halaman ini sendiri)
        return redirect()->route('otp.verify')->with('registered_email', $user->email);
    }
}