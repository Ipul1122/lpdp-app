<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use App\Models\EssayPendaftaran;

class PendaftaranStep6Controller extends Controller
{
    public function create()
    {
        if (!UserProfile::where('user_id', Auth::id())->exists()) {
            return redirect()->route('pendaftaran.step1')->with('error', 'Selesaikan Tahap 1 terlebih dahulu.');
        }

        $essay = EssayPendaftaran::where('user_id', Auth::id())->first();

        return view('pendaftaran.step6', [
            'step' => 6,
            'essay' => $essay
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'essay_kontribusi' => 'required|string|min:10', // Minimal ada isinya
        ]);

        EssayPendaftaran::updateOrCreate(['user_id' => Auth::id()], $validated);

        // Arahkan ke Riwayat karena Step 7 belum ada
        return redirect()->route('pendaftaran.step7')->with('success', 'Essay tersimpan. Silakan periksa kembali ringkasan pendaftaran Anda.');
    }
}