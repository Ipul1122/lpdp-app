<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use App\Models\BiodataPendaftaran;

class PendaftaranStep4Controller extends Controller
{
    public function create()
    {
        // Kunci akses jika Step 1 belum diisi
        if (!UserProfile::where('user_id', Auth::id())->exists()) {
            return redirect()->route('pendaftaran.step1')->with('error', 'Silakan selesaikan Tahap 1 terlebih dahulu.');
        }

        $biodata = BiodataPendaftaran::where('user_id', Auth::id())->first();

        return view('pendaftaran.step4', [
            'step' => 4,
            'biodata' => $biodata
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'deskripsi_diri' => 'nullable|string',
            'riwayat_pendidikan' => 'nullable|string',
            'pengalaman_kerja' => 'nullable|string',
            'pengalaman_organisasi' => 'nullable|string',
            'prestasi' => 'nullable|string',
            'keahlian' => 'nullable|string',
            'bahasa' => 'nullable|string',
        ]);

        BiodataPendaftaran::updateOrCreate(['user_id' => Auth::id()], $validated);

        // Arahkan ke Riwayat (karena Step 5 belum ada)
        return redirect()->route('pendaftaran.step5')->with('success', 'Data Profil & Biodata tersimpan, lanjut ke Tahap 5.');
    }
}