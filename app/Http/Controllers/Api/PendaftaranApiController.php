<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\UserProfile;
use Illuminate\Validation\ValidationException;

class PendaftaranApiController extends Controller
{
    public function storeProfil(Request $request)
    {
        try {
            // Ambil user yang sedang login dari token API (Sanctum)
            $user = $request->user();
            $profilExist = UserProfile::where('user_id', $user->id)->first();

            // Pengecekan Kunci Keamanan
            if ($profilExist && !in_array($profilExist->status, ['draft', 'ditolak'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profil terkunci karena pendaftaran Anda sedang diproses.'
                ], 403); // 403 Forbidden
            }

            // Validasi Input API
            $validated = $request->validate([
                'foto_ktp'          => $profilExist && $profilExist->foto_ktp ? 'nullable|image|mimes:jpeg,png,jpg|max:5120' : 'required|image|mimes:jpeg,png,jpg|max:5120',
                'nik'               => 'required|string|size:16|unique:user_profiles,nik,' . $user->id . ',user_id',
                'nama'              => 'required|string|max:255',
                'no_telp'           => 'required|numeric',
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
            ]);

            // Gabungkan Tempat & Tanggal Lahir
            $validated['tempat_tglLahir'] = $validated['tempat_lahir'] . ', ' . $validated['tanggal_lahir'];
            unset($validated['tempat_lahir'], $validated['tanggal_lahir']);
            
            // Set status untuk pendaftar baru
            if (!$profilExist) {
                $validated['status'] = 'draft'; 
                $validated['is_pengajuan_ulang'] = false;
            }

            // Manajemen File Upload KTP
            if ($request->hasFile('foto_ktp')) {
                if ($profilExist && $profilExist->foto_ktp) {
                    Storage::disk('public')->delete($profilExist->foto_ktp);
                }
                $validated['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
            }

            // Simpan ke Database
            $profile = UserProfile::updateOrCreate(
                ['user_id' => $user->id], 
                $validated
            );

            // Berikan Respons Sukses
            return response()->json([
                'success' => true,
                'message' => 'Data profil (Tahap 1) berhasil disimpan.',
                'data'    => $profile
            ], 200);

        } catch (ValidationException $e) {
            // Tangkap error validasi dan kembalikan format JSON yang rapi
            return response()->json([
                'success' => false,
                'message' => 'Terdapat kesalahan pada data yang dikirim.',
                'errors'  => $e->errors()
            ], 422); // 422 Unprocessable Entity
        }
    }
}