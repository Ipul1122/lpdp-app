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
        // 1. Validasi input dengan pengecekan UNIQUE untuk NIK
        $validated = $request->validate([
            'foto_ktp'          => 'required|image|mimes:jpeg,png,jpg|max:5120',
            
            // Tambahkan rule unique ke tabel user_profiles kolom nik
            // Pengecualian diberikan untuk user_id milik user yang sedang login agar dia bisa mengupdate datanya sendiri
            'nik'               => 'required|string|size:16|unique:user_profiles,nik,' . Auth::id() . ',user_id',
            
            'nama'              => 'required|string|max:255',
            'no_telp'           => 'required|numeric|digits_between:10,15',
            'tempat_lahir'      => 'required|string|max:100', 
            'tanggal_lahir'     => 'required|date',           
            'alamat'            => 'required|string',
            'rt'                => 'required|numeric',
            'rw'                => 'required|numeric',
            'kelurahan'         => 'required|string|max:100',
            'kecamatan'         => 'required|string|max:100',
            'agama'             => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'pekerjaan'         => 'required|string|max:100',
            'kewarganegaraan'   => 'required|string|max:50',
            'program_beasiswa'  => 'required|in:sarjana,magister,dokter', 
        ], [
            // Pesan Error Kustom jika NIK duplikat
            'nik.unique' => 'NIK sudah digunakan oleh pendaftar lain.',
        ]);

        // ... Sisa kode di bawahnya (menggabungkan tanggal lahir, upload KTP, dll) tetap persis sama seperti sebelumnya ...
        $validated['tempat_tglLahir'] = $validated['tempat_lahir'] . ', ' . $validated['tanggal_lahir'];
        unset($validated['tempat_lahir']);
        unset($validated['tanggal_lahir']);
        $validated['status'] = 'pending';

        if ($request->hasFile('foto_ktp')) {
            $path = $request->file('foto_ktp')->store('ktp', 'public');
            $validated['foto_ktp'] = $path;
        }

        UserProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return redirect()->route('riwayat.index')->with('success', 'Pendaftaran program ' . ucfirst($validated['program_beasiswa']) . ' berhasil disubmit!');
    }
}