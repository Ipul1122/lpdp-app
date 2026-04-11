<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\ResetPasswordMail;

class PasswordResetController extends Controller
{
    // 1. Menampilkan form input email
    public function showRequestForm()
    {
        return view('auth.lupaPassword');
    }

    // 2. Memproses pengiriman email reset
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Email ini tidak terdaftar di sistem kami.'
        ]);

        // Buat token acak
        $token = Str::random(64);

        // Simpan token ke tabel bawaan Laravel (password_reset_tokens)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        // Kirim email menggunakan sistem antrean (Queue) agar tidak lemot
        Mail::to($request->email)->queue(new ResetPasswordMail($request->email, $token));

        return back()->with('success', 'Link untuk mereset password telah dikirim ke email Anda.');
    }

    // 3. Menampilkan form password baru (dari klik link di email)
    public function showResetForm(Request $request, $token)
    {
        return view('auth.passwordBaru', ['token' => $token, 'email' => $request->email]);
    }

    // 4. Memproses penyimpanan password baru
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed', // butuh input password_confirmation
        ]);

        // Cek validitas token
        $resetRecord = DB::table('password_reset_tokens')
                        ->where('email', $request->email)
                        ->where('token', $request->token)
                        ->first();

        if (!$resetRecord) {
            return back()->with('error', 'Token reset password tidak valid atau sudah kedaluwarsa.');
        }

        // Update password user
        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        // Hapus token agar tidak bisa dipakai lagi
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diubah! Silakan login dengan password baru.');
    }
}