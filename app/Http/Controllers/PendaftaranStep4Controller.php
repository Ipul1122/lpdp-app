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

        $profilExist = UserProfile::where('user_id', Auth::id())->first();
        
        // Kunci akses jika belum isi Step 1 ATAU sudah Final
       if (!$profilExist || !in_array($profilExist->status, ['draft', 'ditolak'])) {
            return redirect()->route('pendaftaran.index')->with('error', 'Akses ditolak atau formulir sudah terkunci.');
        }

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
        // Ubah nullable menjadi required untuk semua isian teks
        $validated = $request->validate([
            'deskripsi_diri' => 'required|string',
            'riwayat_pendidikan' => 'required|string',
            'pengalaman_kerja' => 'required|string',
            'pengalaman_organisasi' => 'required|string',
            'prestasi' => 'required|string',
            'keahlian' => 'required|string',
            'bahasa' => 'required|string',
        ]);

        BiodataPendaftaran::updateOrCreate(['user_id' => Auth::id()], $validated);

        // Arahkan ke Tahap 5
        return redirect()->route('pendaftaran.step5')->with('success', 'Data Profil & Biodata tersimpan, lanjut ke Tahap 5.');
    }
}