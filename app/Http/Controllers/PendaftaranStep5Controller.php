<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserProfile;
use App\Models\RekomendasiPendaftaran;

class PendaftaranStep5Controller extends Controller
{
    public function create()
    {

        $profilExist = UserProfile::where('user_id', Auth::id())->first();
        
        // Kunci akses jika belum isi Step 1 ATAU sudah Final
        if (!$profilExist || $profilExist->status !== 'draft') {
            return redirect()->route('pendaftaran.index')->with('error', 'Akses ditolak atau formulir sudah terkunci.');
        }

        // Kunci akses jika Step 1 belum diisi
        if (!UserProfile::where('user_id', Auth::id())->exists()) {
            return redirect()->route('pendaftaran.step1')->with('error', 'Silakan selesaikan Tahap 1 terlebih dahulu.');
        }

        $rekomendasi = RekomendasiPendaftaran::where('user_id', Auth::id())->first();

        return view('pendaftaran.step5', [
            'step' => 5,
            'rekomendasi' => $rekomendasi
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perekomendasi' => 'nullable|string|max:255',
            'instansi_perekomendasi' => 'nullable|string|max:255',
            'jabatan_perekomendasi' => 'nullable|string|max:255',
            'file_rekomendasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $rekExist = RekomendasiPendaftaran::where('user_id', Auth::id())->first();

        if ($request->hasFile('file_rekomendasi')) {
            if ($rekExist && $rekExist->file_rekomendasi) {
                Storage::disk('public')->delete($rekExist->file_rekomendasi);
            }
            $validated['file_rekomendasi'] = $request->file('file_rekomendasi')->store('dokumen_rekomendasi', 'public');
        }

        RekomendasiPendaftaran::updateOrCreate(['user_id' => Auth::id()], $validated);

       return redirect()->route('pendaftaran.step6')->with('success', 'Rekomendasi tersimpan, lanjut ke Essay.');
    }
}