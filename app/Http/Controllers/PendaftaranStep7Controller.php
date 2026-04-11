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

        // Di sini kita akhirnya mengirimkan Notifikasi ke Admin bahwa ada pendaftar baru
        // (Gunakan queue agar aplikasi tidak lemot saat loading)
        Mail::to('msyaifulloh2024@gmail.com')->queue(new NotifikasiPendaftaranAdmin($pendaftar, 'baru'));

        return redirect()->route('riwayat.index')->with('success', 'Selamat! Seluruh Berkas Pendaftaran Beasiswa Anda Telah Berhasil Dikirim dan Sedang Diproses.');
    }
}