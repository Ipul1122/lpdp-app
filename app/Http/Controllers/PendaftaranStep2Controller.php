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

        $tanggal_lahir = null;
        if ($profilExist && $profilExist->tempat_tglLahir) {
            $ttl = explode(', ', $profilExist->tempat_tglLahir);
            $tanggal_lahir = end($ttl);
        }

        $tanggal_pensiun = null;
        if ($tanggal_lahir) {
            try {
                $date = new \DateTime($tanggal_lahir);
                $date->modify('+60 years');
                $tanggal_pensiun = $date->format('Y-m');
            } catch (\Exception $e) {
                // ignore
            }
        }

        return view('pendaftaran.step2', [
            'step' => 2,
            'industri' => $industri,
            'userProfile' => $profilExist,
            'tanggal_pensiun' => $tanggal_pensiun
        ]);
    }

    public function store(Request $request)
    {
        $industriExist = IndustriPendukung::where('user_id', Auth::id())->first();
        $profilExist = UserProfile::where('user_id', Auth::id())->first();

        // Hitung tanggal pensiun secara otomatis (umur maksimal 60 tahun)
        $tanggal_lahir = null;
        if ($profilExist && $profilExist->tempat_tglLahir) {
            $ttl = explode(', ', $profilExist->tempat_tglLahir);
            $tanggal_lahir = end($ttl);
        }

        if ($tanggal_lahir) {
            try {
                $date = new \DateTime($tanggal_lahir);
                $date->modify('+60 years');
                $request->merge(['tanggal_pensiun' => $date->format('Y-m')]);
            } catch (\Exception $e) {
                // ignore
            }
        }

        $validated = $request->validate([
            'unit_kerja' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'golongan' => 'required|string|max:255',
            'tanggal_mulai_kerja' => 'nullable|string',
            'tanggal_pensiun' => 'required|string',
            'surat_izin' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('surat_izin')) {
            if ($industriExist && $industriExist->surat_izin) {
                Storage::disk('public')->delete($industriExist->surat_izin);
            }
            $validated['surat_izin'] = $request->file('surat_izin')->store('dokumen_industri', 'public');
        }

        // Format fields to Title Case
        $capitalFields = ['nama_instansi', 'unit_kerja', 'jabatan'];
        foreach ($capitalFields as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = ucwords(strtolower($validated[$field]));
            }
        }

        IndustriPendukung::updateOrCreate(['user_id' => Auth::id()], $validated);

        return redirect()->route('pendaftaran.step3')->with('success', 'Data Unit Kerja tersimpan, lanjut ke Tahap 3.');
    }
}