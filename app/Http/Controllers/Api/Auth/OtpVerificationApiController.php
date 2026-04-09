<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\JsonResponse;

class OtpVerificationApiController extends Controller
{
    protected RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Memproses verifikasi OTP via API
     */
    public function verify(Request $request): JsonResponse
    {
        // 1. Validasi input
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|numeric|digits:6',
        ]);

        // 2. Panggil service untuk mengecek OTP
        $result = $this->registrationService->verifyOtp($request->email, $request->otp);

        // 3. Jika OTP salah atau kedaluwarsa
        if (!$result['status']) {
            return response()->json([
                'status'  => 'error',
                'message' => $result['message'],
            ], 400); // 400 Bad Request
        }

        // 4. Jika OTP benar
        return response()->json([
            'status'  => 'success',
            'message' => $result['message'],
        ], 200); // 200 OK
    }
}