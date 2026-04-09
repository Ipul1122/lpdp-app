<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginApiController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();

        // 3. Cek kecocokan password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau Password salah.'
            ], 401); // 401 Unauthorized
        }

        // 4. (Opsional) Cek apakah user sudah verifikasi OTP
        if (is_null($user->email_verified_at)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akun belum diverifikasi. Silakan masukkan kode OTP terlebih dahulu.'
            ], 403); // 403 Forbidden
        }

        // 5. Buat Token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // 6. Kembalikan Response Sukses + Token
        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil!',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ], 200);
    }
}