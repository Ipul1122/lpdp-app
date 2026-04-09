<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterAccountRequest;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\JsonResponse;

class RegistrationApiController extends Controller
{
    protected RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Memproses pendaftaran akun via API.
     */
    public function processRegistration(RegisterAccountRequest $request): JsonResponse
    {
        // 1. Validasi otomatis tertangani oleh RegisterAccountRequest.
        // Jika gagal, Laravel otomatis mengembalikan response JSON 422 Unprocessable Entity.

        // 2. Panggil service untuk simpan ke database
        $user = $this->registrationService->createNewAccount($request->validated());

        // 3. Jika terjadi error di server/database
        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan sistem saat membuat akun.',
            ], 500);
        }

        // 4. Jika sukses
        return response()->json([
            'status'  => 'success',
            'message' => 'Akun berhasil dibuat!',
            'data'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                // Jangan kembalikan password di response API
            ]
        ], 201); // 201 Created
    }
}