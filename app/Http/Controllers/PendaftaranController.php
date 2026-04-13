<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Mail\NotifikasiPendaftaranAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function index()
    {
        $profile = UserProfile::where('user_id', Auth::id())->first();
        
        if ($profile) {
            // Jika data sudah Final (Pending/Diterima/Ditolak)
            if ($profile->status !== 'draft') {
                return view('pendaftaran.selesai', ['user' => Auth::user()]);
            }
            
            // Jika status masih "draft", arahkan untuk melanjutkan
            return redirect()->route('pendaftaran.step1')->with('info', 'Anda memiliki draft, silakan lanjutkan pengisian.');
        }

        // Jika belum pernah mendaftar sama sekali
        return view('pendaftaran.index');
    }

public function create()
    {
        $userProfile = UserProfile::where('user_id', Auth::id())->first();
        
        // KUNCI KEAMANAN: Blokir jika sudah dikirim final
        if ($userProfile && $userProfile->status !== 'draft') {
            return redirect()->route('pendaftaran.index');
        }

        $tempat_lahir = '';
        $tanggal_lahir = '';
        if ($userProfile && $userProfile->tempat_tglLahir) {
            $ttl = explode(', ', $userProfile->tempat_tglLahir);
            $tempat_lahir = $ttl[0] ?? '';
            $tanggal_lahir = $ttl[1] ?? '';
        }

        return view('pendaftaran.step1', [
            'step' => 1, 
            'userProfile' => $userProfile, 
            'tempat_lahir' => $tempat_lahir, 
            'tanggal_lahir' => $tanggal_lahir
        ]);
    }
    public function store(Request $request)
    {
        $profilExist = UserProfile::where('user_id', Auth::id())->first();

        $validated = $request->validate([
            'foto_ktp'          => $profilExist ? 'nullable|image|mimes:jpeg,png,jpg|max:5120' : 'required|image|mimes:jpeg,png,jpg|max:5120',
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

        // Menggabungkan tempat dan tanggal lahir
        $validated['tempat_tglLahir'] = $validated['tempat_lahir'] . ', ' . $validated['tanggal_lahir'];
        unset($validated['tempat_lahir']);
        unset($validated['tanggal_lahir']);
        
        // PENTING: Status di set ke 'draft', bukan 'pending'
        $validated['status'] = 'draft'; 
        $validated['is_pengajuan_ulang'] = false; 

        // Manajemen file KTP
        if ($request->hasFile('foto_ktp')) {
            if ($profilExist && $profilExist->foto_ktp) {
                Storage::disk('public')->delete($profilExist->foto_ktp);
            }
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
        }

        // Simpan atau perbarui data
        UserProfile::updateOrCreate(
            ['user_id' => Auth::id()], 
            $validated
        );

        return redirect()->route('pendaftaran.step2')->with('success', 'Data Profil berhasil disimpan (Draft), silakan lanjut ke Tahap 2.');
    }

}