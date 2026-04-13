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
            // Izinkan masuk ke form jika statusnya draft ATAU ditolak (untuk revisi)
            if (in_array($profile->status, ['draft', 'ditolak'])) {
                return redirect()->route('pendaftaran.step1')->with('info', 'Silakan lanjutkan pengisian atau revisi data Anda.');
            }
            
            // Jika sudah dikirim final (pending/diterima)
            return view('pendaftaran.selesai', ['user' => Auth::user()]);
        }

        return view('pendaftaran.index');
    }

    public function create()
        {
            $userProfile = UserProfile::where('user_id', Auth::id())->first();
            
            // Kunci jika statusnya BUKAN draft dan BUKAN ditolak
            if ($userProfile && !in_array($userProfile->status, ['draft', 'ditolak'])) {
                return redirect()->route('pendaftaran.index');
            }

            $tempat_lahir = '';
            $tanggal_lahir = '';
            if ($userProfile && $userProfile->tempat_tglLahir) {
                $ttl = explode(', ', $userProfile->tempat_tglLahir);
                $tempat_lahir = $ttl[0] ?? '';
                $tanggal_lahir = $ttl[1] ?? '';
            }

            $step = 1;

            return view('pendaftaran.step1', compact('step', 'userProfile', 'tempat_lahir', 'tanggal_lahir'));
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

        $validated['tempat_tglLahir'] = $validated['tempat_lahir'] . ', ' . $validated['tanggal_lahir'];
        unset($validated['tempat_lahir']);
        unset($validated['tanggal_lahir']);
        
        // PENTING: Jika statusnya ditolak, biarkan tetap 'ditolak' sampai Step 7.
        // Jika data baru, set jadi 'draft'.
        $validated['status'] = ($profilExist && $profilExist->status === 'ditolak') ? 'ditolak' : 'draft'; 
        
        if ($request->hasFile('foto_ktp')) {
            if ($profilExist && $profilExist->foto_ktp) {
                Storage::disk('public')->delete($profilExist->foto_ktp);
            }
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
        }

        UserProfile::updateOrCreate(['user_id' => Auth::id()], $validated);

        return redirect()->route('pendaftaran.step2')->with('success', 'Data tersimpan, silakan lanjut ke Tahap 2.');
    }

}