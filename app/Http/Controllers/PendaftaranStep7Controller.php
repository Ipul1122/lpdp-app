<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiPendaftaranAdmin;
use App\Models\UserProfile;
use App\Models\IndustriPendukung;
use App\Models\UniversitasPendaftaran;
use App\Models\BiodataPendaftaran;
use App\Models\RekomendasiPendaftaran;
use App\Models\EssayPendaftaran;

class PendaftaranStep7Controller extends Controller
{
    public function create()
    {

        $profilExist = UserProfile::where('user_id', Auth::id())->first();
        
        // Kunci akses jika belum isi Step 1 ATAU sudah Final
        if (!$profilExist || !in_array($profilExist->status, ['draft', 'ditolak'])) {
            return redirect()->route('pendaftaran.index')->with('error', 'Akses ditolak atau formulir sudah terkunci.');
        }

        $userProfile = UserProfile::where('user_id', Auth::id())->first();
        if (!$userProfile) {
            return redirect()->route('pendaftaran.step1')->with('error', 'Selesaikan Tahap 1 terlebih dahulu.');
        }

        // Ambil semua data draf dari tahap 1 sampai 6
        $industri = IndustriPendukung::where('user_id', Auth::id())->first();
        $universitas = UniversitasPendaftaran::where('user_id', Auth::id())->first();
        $biodata = BiodataPendaftaran::where('user_id', Auth::id())->first();
        $rekomendasi = RekomendasiPendaftaran::where('user_id', Auth::id())->first();
        $essay = EssayPendaftaran::where('user_id', Auth::id())->first();

        

        return view('pendaftaran.step7', [
            'step' => 7,
            'userProfile' => $userProfile,
            'industri' => $industri,
            'universitas' => $universitas,
            'biodata' => $biodata,
            'rekomendasi' => $rekomendasi,
            'essay' => $essay
        ]);
    }

   public function store(Request $request)
    {
        $pendaftar = UserProfile::where('user_id', Auth::id())->firstOrFail();

        // Cek apakah ini pendaftaran baru atau revisi
        $isRevisi = ($pendaftar->status === 'ditolak');

        // Ubah status menjadi pending dan bersihkan catatan penolakan admin
        $pendaftar->update([
            'status' => 'pending',
            'is_pengajuan_ulang' => $isRevisi ? true : false,
            'catatan' => null,
            'submitted_at' => now(), 
            'responded_at' => null
        ]);

        // Tentukan tipe email notifikasi ke Admin
        $tipe = $isRevisi ? 'pengajuan_ulang' : 'baru';
        Mail::to('msyaifulloh2024@gmail.com')->queue(new NotifikasiPendaftaranAdmin($pendaftar, $tipe));

        return redirect()->route('riwayat.index')->with('success', 'Selamat! Seluruh Berkas Anda Telah Berhasil Dikirim dan Sedang Diproses.');
    }
}