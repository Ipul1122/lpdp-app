<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserProfile;
use App\Models\IndustriPendukung;

class PendaftaranStep2Controller extends Controller
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

        $industri = IndustriPendukung::where('user_id', Auth::id())->first();

        return view('pendaftaran.step2', [
            'step' => 2,
            'industri' => $industri
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'instansi' => 'nullable|string|max:255',
            'sektor' => 'nullable|string|max:255',
            'jenis_instansi' => 'nullable|string|max:255',
            'nama_instansi' => 'nullable|string|max:255',
            'telepon_instansi' => 'nullable|string|max:20',
            'provinsi' => 'nullable|string|max:255',
            'kab_kota' => 'nullable|string|max:255',
            'alamat_instansi' => 'nullable|string',
            'status_kepegawaian' => 'nullable|string|max:255',
            'tanggal_mulai_kerja' => 'nullable|string',
            'pekerjaan' => 'nullable|string|max:255',
            'penghasilan' => 'nullable|string|max:255',
            'deskripsi_pekerjaan' => 'nullable|string',
            'surat_izin' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $industriExist = IndustriPendukung::where('user_id', Auth::id())->first();

        if ($request->hasFile('surat_izin')) {
            if ($industriExist && $industriExist->surat_izin) {
                Storage::disk('public')->delete($industriExist->surat_izin);
            }
            $validated['surat_izin'] = $request->file('surat_izin')->store('dokumen_industri', 'public');
        }

        IndustriPendukung::updateOrCreate(['user_id' => Auth::id()], $validated);

        return redirect()->route('pendaftaran.step3')->with('success', 'Data Industri tersimpan, lanjut ke Tahap 3.');
    }
}