<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserProfile;

class ProfileController extends Controller
{
    public function index()
    {
        $userProfile = UserProfile::where('user_id', Auth::id())->first();

        // Pecah Tempat dan Tanggal Lahir
        $tempat_lahir = '';
        $tanggal_lahir = '';
        if ($userProfile && $userProfile->tempat_tglLahir) {
            $ttl = explode(', ', $userProfile->tempat_tglLahir);
            $tempat_lahir = $ttl[0] ?? '';
            $tanggal_lahir = $ttl[1] ?? '';
        }

        // Kunci profil jika data sedang direview Admin atau sudah lulus
        // (Boleh diedit hanya jika belum mendaftar, status draft, atau sedang ditolak/revisi)
        $isLocked = $userProfile && !in_array($userProfile->status, ['draft', 'ditolak']);

        return view('profile.index', compact('userProfile', 'tempat_lahir', 'tanggal_lahir', 'isLocked'));
    }

    public function update(Request $request)
    {
        $profilExist = UserProfile::where('user_id', Auth::id())->first();

        if ($profilExist && !in_array($profilExist->status, ['draft', 'ditolak'])) {
            return back()->with('error', 'Profil terkunci karena pendaftaran Anda sedang diproses.');
        }

        $validated = $request->validate([
            'foto_ktp'          => $profilExist && $profilExist->foto_ktp ? 'nullable|image|mimes:jpeg,png,jpg|max:5120' : 'required|image|mimes:jpeg,png,jpg|max:5120',
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
            'nik.unique' => 'NIK ini sudah terdaftar di sistem kami.',
        ]);

        $validated['tempat_tglLahir'] = $validated['tempat_lahir'] . ', ' . $validated['tanggal_lahir'];
        unset($validated['tempat_lahir']);
        unset($validated['tanggal_lahir']);
        
        // Jika user baru pertama kali mengisi lewat halaman Profile, jadikan draft
        if (!$profilExist) {
            $validated['status'] = 'draft'; 
            $validated['is_pengajuan_ulang'] = false;
        }

        if ($request->hasFile('foto_ktp')) {
            if ($profilExist && $profilExist->foto_ktp) {
                Storage::disk('public')->delete($profilExist->foto_ktp);
            }
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
        }

        UserProfile::updateOrCreate(['user_id' => Auth::id()], $validated);

        return back()->with('success', 'Profil Anda berhasil diperbarui.');
    }
}