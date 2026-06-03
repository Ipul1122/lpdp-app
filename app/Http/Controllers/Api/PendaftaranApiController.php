<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiPendaftaranAdmin;
use App\Models\Notification;
use App\Models\UserProfile;
use App\Models\IndustriPendukung;
use App\Models\UniversitasPendaftaran;
use App\Models\RekomendasiPendaftaran;
use App\Models\EssayPendaftaran;

class PendaftaranApiController extends Controller
{
    // Cek Kunci Keamanan (Fungsi Bantuan)
    private function checkLockStatus($userId)
    {
        $profile = UserProfile::where('user_id', $userId)->first();
        return ($profile && !in_array($profile->status, ['draft', 'ditolak']));
    }

    // ==============================================
    // STEP 0: KATEGORI
    // ==============================================
    public function storeCategory(Request $request)
    {
        try {
            $user = $request->user();
            if ($this->checkLockStatus($user->id)) {
                return response()->json(['success' => false, 'message' => 'Profil terkunci.'], 403);
            }

            $validated = $request->validate([
                'kategori' => 'required|in:Usulan Unit,Manajemen Talenta'
            ]);

            $userProfile = UserProfile::where('user_id', $user->id)->first();
            $status = ($userProfile && $userProfile->status === 'ditolak') ? 'ditolak' : 'draft';

            $data = UserProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'kategori' => $validated['kategori'],
                    'status' => $status
                ]
            );

            return response()->json(['success' => true, 'message' => 'Kategori pendaftaran berhasil dipilih.', 'data' => $data], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    // ==============================================
    // STEP 1: PROFIL
    // ==============================================
    public function storeProfil(Request $request)
    {
        try {
            $user = $request->user();
            if ($this->checkLockStatus($user->id)) {
                return response()->json(['success' => false, 'message' => 'Profil terkunci.'], 403);
            }

            $profilExist = UserProfile::where('user_id', $user->id)->first();

            // Cek apakah kategori sudah dipilih terlebih dahulu
            if (!$profilExist || !$profilExist->kategori) {
                return response()->json(['success' => false, 'message' => 'Silakan pilih kategori pendaftaran terlebih dahulu.'], 400);
            }

            $validated = $request->validate([
                'foto_ktp'          => ($profilExist && $profilExist->foto_ktp) ? 'nullable|image|mimes:jpeg,png,jpg|max:5120' : 'required|image|mimes:jpeg,png,jpg|max:5120',
                'nik'               => 'required|string|size:16|unique:user_profiles,nik,' . $user->id . ',user_id',
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
                'program_beasiswa'  => 'required|in:magister,dokter',
            ], [
                'nik.unique' => 'NIK ini sudah terdaftar di sistem kami.',
            ]);

            $validated['tempat_tglLahir'] = $validated['tempat_lahir'] . ', ' . $validated['tanggal_lahir'];
            unset($validated['tempat_lahir'], $validated['tanggal_lahir']);

            $validated['status'] = ($profilExist && $profilExist->status === 'ditolak') ? 'ditolak' : 'draft'; 

            if ($request->hasFile('foto_ktp')) {
                if ($profilExist && $profilExist->foto_ktp) {
                    Storage::disk('public')->delete($profilExist->foto_ktp);
                }
                $validated['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
            }

            // Format fields to Title Case / Sentence Case
            $capitalFields = ['nama', 'tempat_lahir', 'kelurahan', 'kecamatan', 'pekerjaan', 'kewarganegaraan'];
            foreach ($capitalFields as $field) {
                if (isset($validated[$field])) {
                    $validated[$field] = ucwords(strtolower($validated[$field]));
                }
            }
            if (isset($validated['alamat'])) {
                $validated['alamat'] = ucfirst($validated['alamat']);
            }

            $data = UserProfile::updateOrCreate(['user_id' => $user->id], $validated);

            return response()->json(['success' => true, 'message' => 'Tahap 1 (Profil) disimpan.', 'data' => $data], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    // ==============================================
    // STEP 2: UNIT KERJA
    // ==============================================
    public function storeIndustri(Request $request)
    {
        try {
            $user = $request->user();
            if ($this->checkLockStatus($user->id)) {
                return response()->json(['success' => false, 'message' => 'Profil terkunci.'], 403);
            }

            // Kunci akses jika Step 1 belum diisi
            $profilExist = UserProfile::where('user_id', $user->id)->first();
            if (!$profilExist || !$profilExist->nik) {
                return response()->json(['success' => false, 'message' => 'Silakan selesaikan Tahap 1 terlebih dahulu.'], 400);
            }

            $validated = $request->validate([
                'unit_kerja' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'golongan' => 'required|string|max:255',
                'tanggal_mulai_kerja' => 'nullable|string',
                'tanggal_pensiun' => 'required|string',
                'surat_izin' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ]);

            $industri = IndustriPendukung::where('user_id', $user->id)->first();
            if ($request->hasFile('surat_izin')) {
                if ($industri && $industri->surat_izin) Storage::disk('public')->delete($industri->surat_izin);
                $validated['surat_izin'] = $request->file('surat_izin')->store('dokumen_industri', 'public');
            }

            // Format fields to Title Case
            $capitalFields = ['nama_instansi', 'unit_kerja', 'jabatan'];
            foreach ($capitalFields as $field) {
                if (isset($validated[$field])) {
                    $validated[$field] = ucwords(strtolower($validated[$field]));
                }
            }

            $data = IndustriPendukung::updateOrCreate(['user_id' => $user->id], $validated);
            return response()->json(['success' => true, 'message' => 'Tahap 2 (Unit Kerja) disimpan.', 'data' => $data], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    // ==============================================
    // STEP 3: UNIVERSITAS
    // ==============================================
    public function storeUniversitas(Request $request)
    {
        try {
            $user = $request->user();
            if ($this->checkLockStatus($user->id)) return response()->json(['success' => false, 'message' => 'Profil terkunci.'], 403);

            // Kunci akses jika Step 1 belum diisi
            $profilExist = UserProfile::where('user_id', $user->id)->first();
            if (!$profilExist || !$profilExist->nik) {
                return response()->json(['success' => false, 'message' => 'Silakan selesaikan Tahap 1 terlebih dahulu.'], 400);
            }

            $univExist = UniversitasPendaftaran::where('user_id', $user->id)->first();
            $validated = $request->validate([
                'kota' => 'required|string|max:255',
                'nama_universitas' => 'required|string|max:255',
                'program_studi' => 'required|string|max:255',
                'tanggal_mulai_studi' => 'required|string',
                'durasi_studi' => 'required|integer',
                'loa' => ($univExist && $univExist->loa) ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120' : 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'khs_ipk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ]);

            if ($request->hasFile('loa')) {
                if ($univExist && $univExist->loa) Storage::disk('public')->delete($univExist->loa);
                $validated['loa'] = $request->file('loa')->store('dokumen_universitas', 'public');
            }
            if ($request->hasFile('khs_ipk')) {
                if ($univExist && $univExist->khs_ipk) Storage::disk('public')->delete($univExist->khs_ipk);
                $validated['khs_ipk'] = $request->file('khs_ipk')->store('dokumen_universitas', 'public');
            }

            // Format fields to Title Case
            $capitalFields = ['kota'];
            foreach ($capitalFields as $field) {
                if (isset($validated[$field])) {
                    $validated[$field] = ucwords(strtolower($validated[$field]));
                }
            }

            $data = UniversitasPendaftaran::updateOrCreate(['user_id' => $user->id], $validated);
            return response()->json(['success' => true, 'message' => 'Tahap 3 (Universitas) disimpan.', 'data' => $data], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    // ==============================================
    // STEP 4: REKOMENDASI
    // ==============================================
    public function storeRekomendasi(Request $request)
    {
        try {
            $user = $request->user();
            if ($this->checkLockStatus($user->id)) return response()->json(['success' => false, 'message' => 'Profil terkunci.'], 403);

            // Kunci akses jika Step 1 belum diisi
            $profilExist = UserProfile::where('user_id', $user->id)->first();
            if (!$profilExist || !$profilExist->nik) {
                return response()->json(['success' => false, 'message' => 'Silakan selesaikan Tahap 1 terlebih dahulu.'], 400);
            }

            $validated = $request->validate([
                'kategori' => 'nullable|string|max:255',
                'nama_perekomendasi' => 'nullable|string|max:255',
                'instansi_perekomendasi' => 'nullable|string|max:255',
                'jabatan_perekomendasi' => 'nullable|string|max:255',
                'file_rekomendasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ]);

            $rek = RekomendasiPendaftaran::where('user_id', $user->id)->first();
            if ($request->hasFile('file_rekomendasi')) {
                if ($rek && $rek->file_rekomendasi) Storage::disk('public')->delete($rek->file_rekomendasi);
                $validated['file_rekomendasi'] = $request->file('file_rekomendasi')->store('dokumen_rekomendasi', 'public');
            }

            // Format fields to Title Case
            $capitalFields = ['kategori', 'nama_perekomendasi', 'instansi_perekomendasi', 'jabatan_perekomendasi'];
            foreach ($capitalFields as $field) {
                if (isset($validated[$field]) && $validated[$field] !== null) {
                    $validated[$field] = ucwords(strtolower($validated[$field]));
                }
            }

            $data = RekomendasiPendaftaran::updateOrCreate(['user_id' => $user->id], $validated);
            return response()->json(['success' => true, 'message' => 'Tahap 4 (Rekomendasi) disimpan.', 'data' => $data], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    // ==============================================
    // STEP 5: ESSAY
    // ==============================================
    public function storeEssay(Request $request)
    {
        try {
            $user = $request->user();
            if ($this->checkLockStatus($user->id)) return response()->json(['success' => false, 'message' => 'Profil terkunci.'], 403);

            // Kunci akses jika Step 1 belum diisi
            $profilExist = UserProfile::where('user_id', $user->id)->first();
            if (!$profilExist || !$profilExist->nik) {
                return response()->json(['success' => false, 'message' => 'Silakan selesaikan Tahap 1 terlebih dahulu.'], 400);
            }

            $validated = $request->validate(['essay_kontribusi' => 'required|string|min:10']);

            if (isset($validated['essay_kontribusi'])) {
                $validated['essay_kontribusi'] = ucfirst($validated['essay_kontribusi']);
            }

            $data = EssayPendaftaran::updateOrCreate(['user_id' => $user->id], $validated);
            return response()->json(['success' => true, 'message' => 'Tahap 5 (Essay) disimpan.', 'data' => $data], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    // ==============================================
    // STEP 6: KIRIM FINAL
    // ==============================================
    public function submitFinal(Request $request)
    {
        $user = $request->user();
        $pendaftar = UserProfile::where('user_id', $user->id)->first();

        if (!$pendaftar || !$pendaftar->nik) return response()->json(['success' => false, 'message' => 'Anda belum mengisi Profil Tahap 1.'], 404);

        $isRevisi = ($pendaftar->status === 'ditolak');

        $pendaftar->update([
            'status' => 'pending',
            'is_pengajuan_ulang' => $isRevisi ? true : false,
            'catatan' => null,
            'submitted_at' => now(),
            'responded_at' => null
        ]);

        // Catat Notifikasi untuk Admin
        Notification::create([
            'user_id' => null, // null = Admin
            'title' => $isRevisi ? 'Pengajuan Ulang (Revisi)' : 'Pendaftar Baru',
            'message' => $isRevisi 
                ? $pendaftar->nama . ' telah memperbaiki form pendaftaran dan mengajukan ulang.'
                : $pendaftar->nama . ' baru saja mengirimkan berkas pendaftaran.',
            'type' => $isRevisi ? 're_submission' : 'new_registration',
            'is_read' => false,
        ]);

        // Tentukan tipe email notifikasi ke Admin
        $tipe = $isRevisi ? 'pengajuan_ulang' : 'baru';
        Mail::to('msyaifulloh2024@gmail.com')->queue(new NotifikasiPendaftaranAdmin($pendaftar, $tipe));

        return response()->json(['success' => true, 'message' => 'Pendaftaran Final Berhasil Dikirim dan Sedang Diproses.'], 200);
    }

    // ==============================================
    // GET: AMBIL SELURUH DATA PENDAFTARAN (STEP 1 - 5)
    // ==============================================
    public function getPendaftaranData(Request $request)
    {
        $userId = $request->user()->id;

        // Tarik data dari masing-masing tabel berdasarkan user_id
        $profil      = UserProfile::where('user_id', $userId)->first();
        $industri    = IndustriPendukung::where('user_id', $userId)->first();
        $universitas = UniversitasPendaftaran::where('user_id', $userId)->first();
        $rekomendasi = RekomendasiPendaftaran::where('user_id', $userId)->first();
        $essay       = EssayPendaftaran::where('user_id', $userId)->first();

        // Cek apakah semua tahap sudah terisi
        $isReadyToSubmit = ($profil && $profil->nik && $industri && $universitas && $essay);

        return response()->json([
            'success' => true,
            'message' => 'Data pendaftaran berhasil diambil.',
            'data'    => [
                'is_ready_to_submit' => $isReadyToSubmit,
                'status_keseluruhan' => $profil ? $profil->status : 'Belum Mulai',
                'tahapan' => [
                    'step1_profil'      => $profil,
                    'step2_unit_kerja'  => $industri,
                    'step3_universitas' => $universitas,
                    'step4_rekomendasi' => $rekomendasi,
                    'step5_essay'       => $essay,
                ]
            ]
        ], 200);
    }

    // ==============================================
    // GET: AMBIL DATA BERDASARKAN ID
    // ==============================================
    public function show(Request $request, $id)
    {
        try {
            $userIdLogin = $request->user()->id;

            $pendaftar = UserProfile::with([
                'industri', 'universitas', 'rekomendasi', 'essay'
            ])
            ->where('id', $id)
            ->where('user_id', $userIdLogin)
            ->firstOrFail();

            return response()->json([
                'success' => true,
                'data'    => $pendaftar
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data pendaftar tidak ditemukan atau Anda tidak memiliki akses.'
            ], 404);
        }
    }

}