<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function index()
    {
       // Cek apakah user sudah punya data pendaftaran
        $hasProfile = UserProfile::where('user_id', Auth::id())->exists();

        // Jika sudah ada data, arahkan ke form edit atau status (untuk sekarang kita arahkan ke form)
        if ($hasProfile) {
            return redirect()->route('pendaftaran.create')->with('info', 'Anda sudah memiliki draft pendaftaran.');
        }

        // Jika belum ada data, tampilkan halaman empty state
        return view('pendaftaran.index');
    }

    public function create()
    {
        return view('pendaftaran.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi input yang baru (tempat dan tanggal sudah dipisah)
        $validated = $request->validate([
            'foto_ktp'          => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'nik'               => 'required|string|size:16',
            'nama'              => 'required|string|max:255',
            'tempat_lahir'      => 'required|string|max:100', 
            'tanggal_lahir'     => 'required|date',           
            'alamat'            => 'required|string',
            'rt'                => 'required|string|max:5',
            'rw'                => 'required|string|max:5',
            'kelurahan'         => 'required|string|max:100',
            'kecamatan'         => 'required|string|max:100',
            'agama'             => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'pekerjaan'         => 'required|string|max:100',
            'kewarganegaraan'   => 'required|string|max:50',
        ]);

        // 2. GABUNGKAN tempat dan tanggal menjadi satu string (Format: "Jakarta, 2000-08-17")
        // Ini dilakukan agar sesuai dengan kolom 'tempat_tglLahir' di database
        $validated['tempat_tglLahir'] = $validated['tempat_lahir'] . ', ' . $validated['tanggal_lahir'];

        // 3. Hapus array tempat dan tanggal yang terpisah agar tidak error saat di-insert ke DB
        unset($validated['tempat_lahir']);
        unset($validated['tanggal_lahir']);

        // 4. Proses Upload Foto KTP
        if ($request->hasFile('foto_ktp')) {
            // Simpan ke storage/app/public/ktp
            $path = $request->file('foto_ktp')->store('ktp', 'public');
            $validated['foto_ktp'] = $path;
        }

        // 5. Simpan ke Database
        UserProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        // 6. Redirect ke halaman empty state / status pendaftaran
        return redirect()->route('dashboard')->with('success', 'Data Profil & CV berhasil disimpan!');
    }
}