<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\OtpCode;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RegistrationService
{
    public function createNewAccount(array $validatedData): ?User
    {
        try {
            $name = explode('@', $validatedData['email'])[0];

            $user = User::create([
                'name'     => $name,
                'email'    => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // 1. Generate 6 Digit OTP
            $otp = rand(100000, 999999);

            // 2. Simpan OTP ke database (berlaku 10 menit)
            OtpCode::create([
                'email'      => $user->email,
                'otp'        => $otp,
                'expires_at' => Carbon::now()->addMinutes(10),
            ]);

            // 3. Kirim Email langsung ke Gmail
            Mail::to($user->email)->send(new OtpMail((string) $otp));

            return $user;
        } catch (\Exception $e) {
            Log::error('Gagal membuat akun registrasi: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Logika untuk mengirim ulang OTP
     */
    public function resendOtp(string $email): array
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return ['status' => false, 'message' => 'Pengguna tidak ditemukan!'];
        }

        // Hapus OTP lama jika ada
        OtpCode::where('email', $email)->delete();

        // 1. Generate OTP Baru
        $otp = rand(100000, 999999);

        // 2. Simpan OTP baru ke database
        OtpCode::create([
            'email'      => $user->email,
            'otp'        => $otp,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        // 3. Kirim Email OTP Baru
        Mail::to($user->email)->send(new OtpMail((string) $otp));

        return ['status' => true, 'message' => 'Kode OTP baru berhasil dikirim ke email Anda!'];
    }

    /**
     * Logika untuk memverifikasi OTP
     */
    public function verifyOtp(string $email, string $otp): array
    {
        $otpRecord = OtpCode::where('email', $email)->where('otp', $otp)->first();

        if (!$otpRecord) {
            return ['status' => false, 'message' => 'Kode OTP tidak valid!'];
        }

        if (Carbon::now()->greaterThan($otpRecord->expires_at)) {
            return ['status' => false, 'message' => 'Kode OTP sudah kedaluwarsa!'];
        }

        // Jika valid, update status verifikasi user
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->update(['email_verified_at' => Carbon::now()]);
        }

        // Hapus OTP agar tidak bisa dipakai lagi
        $otpRecord->delete();

        return ['status' => true, 'message' => 'Email berhasil diverifikasi!'];
    }
}