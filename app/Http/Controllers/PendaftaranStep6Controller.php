<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserProfile;

class PendaftaranStep6Controller extends Controller
{
    public function create()
    {
        $profilExist = UserProfile::where('user_id', Auth::id())->first();
        
        // Kunci akses jika belum isi Step 1 ATAU sudah Final
        if (!$profilExist || !in_array($profilExist->status, ['draft', 'ditolak'])) {
            return redirect()->route('pendaftaran.index')->with('error', 'Akses ditolak atau formulir sudah terkunci.');
        }

        return view('pendaftaran.step6', [
            'step' => 6,
            'userProfile' => $profilExist
        ]);
    }

    public function store(Request $request)
    {
        $profil = UserProfile::where('user_id', Auth::id())->firstOrFail();

        // Validasi file PDF Surat Komitmen
        // Jika sudah ada file sebelumnya, file baru bersifat optional (nullable). Jika baru pertama kali, required.
        $validated = $request->validate([
            'surat_komitmen' => $profil->surat_komitmen ? 'nullable|file|mimes:pdf|max:5120' : 'required|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('surat_komitmen')) {
            if ($profil->surat_komitmen) {
                Storage::disk('public')->delete($profil->surat_komitmen);
            }
            $path = $request->file('surat_komitmen')->store('dokumen_komitmen', 'public');
            
            $profil->update([
                'surat_komitmen' => $path
            ]);
        }

        return redirect()->route('pendaftaran.step7')->with('success', 'Surat Komitmen berhasil diunggah, lanjut ke Tahap 7.');
    }
}