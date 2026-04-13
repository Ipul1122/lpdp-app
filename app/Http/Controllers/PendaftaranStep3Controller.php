<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserProfile;
use App\Models\UniversitasPendaftaran;

class PendaftaranStep3Controller extends Controller
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

        $universitas = UniversitasPendaftaran::where('user_id', Auth::id())->first();

        return view('pendaftaran.step3', [
            'step' => 3,
            'universitas' => $universitas
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'negara_tujuan' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'nama_universitas' => 'nullable|string|max:255',
            'program_studi' => 'nullable|string|max:255',
            'tanggal_mulai_studi' => 'nullable|string',
            'durasi_studi' => 'nullable|integer',
            'loa' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'khs_ipk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $univExist = UniversitasPendaftaran::where('user_id', Auth::id())->first();

        if ($request->hasFile('loa')) {
            if ($univExist && $univExist->loa) {
                Storage::disk('public')->delete($univExist->loa);
            }
            $validated['loa'] = $request->file('loa')->store('dokumen_universitas', 'public');
        }

        if ($request->hasFile('khs_ipk')) {
            if ($univExist && $univExist->khs_ipk) {
                Storage::disk('public')->delete($univExist->khs_ipk);
            }
            $validated['khs_ipk'] = $request->file('khs_ipk')->store('dokumen_universitas', 'public');
        }

        UniversitasPendaftaran::updateOrCreate(['user_id' => Auth::id()], $validated);

        // Nanti diganti ke step4 jika sudah dibuat
        return redirect()->route('pendaftaran.step4')->with('success', 'Data Universitas tersimpan, lanjut ke Tahap 4.');
    }
}