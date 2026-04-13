<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Models\UserProfile;
use App\Models\IndustriPendukung;
use App\Models\UniversitasPendaftaran;
use App\Models\BiodataPendaftaran;
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
    // STEP 1: PROFIL (Sudah Ada)
    // ==============================================
    public function storeProfil(Request $request) { /* (Isi fungsi ini sama seperti yang Anda miliki sebelumnya) */ }

    // ==============================================
    // STEP 2: INDUSTRI
    // ==============================================
    public function storeIndustri(Request $request)
    {
        try {
            $user = $request->user();
            if ($this->checkLockStatus($user->id)) {
                return response()->json(['success' => false, 'message' => 'Profil terkunci.'], 403);
            }

            $validated = $request->validate([
                'nama_instansi' => 'nullable|string', 'pekerjaan' => 'nullable|string',
                'status_kepegawaian' => 'nullable|string', 'tanggal_mulai_kerja' => 'nullable|string',
                'deskripsi_pekerjaan' => 'nullable|string', 'surat_izin' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ]);

            $industri = IndustriPendukung::where('user_id', $user->id)->first();
            if ($request->hasFile('surat_izin')) {
                if ($industri && $industri->surat_izin) Storage::disk('public')->delete($industri->surat_izin);
                $validated['surat_izin'] = $request->file('surat_izin')->store('dokumen_industri', 'public');
            }

            $data = IndustriPendukung::updateOrCreate(['user_id' => $user->id], $validated);
            return response()->json(['success' => true, 'message' => 'Tahap 2 (Industri) disimpan.', 'data' => $data], 200);
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

            $validated = $request->validate([
                'nama_universitas' => 'nullable|string', 'program_studi' => 'nullable|string',
                'tanggal_mulai_studi' => 'nullable|string', 'durasi_studi' => 'nullable|integer',
                'loa' => 'nullable|file|mimes:pdf,jpg,png|max:5120', 'khs_ipk' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            ]);

            $univ = UniversitasPendaftaran::where('user_id', $user->id)->first();
            if ($request->hasFile('loa')) {
                if ($univ && $univ->loa) Storage::disk('public')->delete($univ->loa);
                $validated['loa'] = $request->file('loa')->store('dokumen_universitas', 'public');
            }
            if ($request->hasFile('khs_ipk')) {
                if ($univ && $univ->khs_ipk) Storage::disk('public')->delete($univ->khs_ipk);
                $validated['khs_ipk'] = $request->file('khs_ipk')->store('dokumen_universitas', 'public');
            }

            $data = UniversitasPendaftaran::updateOrCreate(['user_id' => $user->id], $validated);
            return response()->json(['success' => true, 'message' => 'Tahap 3 (Universitas) disimpan.', 'data' => $data], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    // ==============================================
    // STEP 4: BIODATA
    // ==============================================
    public function storeBiodata(Request $request)
    {
        try {
            $user = $request->user();
            if ($this->checkLockStatus($user->id)) return response()->json(['success' => false, 'message' => 'Profil terkunci.'], 403);

            // TAMBAHKAN KOLOM YANG HILANG DI SINI
            $validated = $request->validate([
                'deskripsi_diri'        => 'nullable|string', 
                'riwayat_pendidikan'    => 'nullable|string',
                'pengalaman_kerja'      => 'nullable|string', // <-- Ini ditambahkan
                'pengalaman_organisasi' => 'nullable|string', 
                'prestasi'              => 'nullable|string',
                'keahlian'              => 'nullable|string', // <-- Ini ditambahkan
                'bahasa'                => 'nullable|string', // <-- Ini ditambahkan
            ]);

            $data = BiodataPendaftaran::updateOrCreate(['user_id' => $user->id], $validated);
            return response()->json(['success' => true, 'message' => 'Tahap 4 (Biodata) disimpan.', 'data' => $data], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    // ==============================================
    // STEP 5: REKOMENDASI
    // ==============================================
    public function storeRekomendasi(Request $request)
    {
        try {
            $user = $request->user();
            if ($this->checkLockStatus($user->id)) return response()->json(['success' => false, 'message' => 'Profil terkunci.'], 403);

            $validated = $request->validate([
                'nama_perekomendasi' => 'nullable|string', 'instansi_perekomendasi' => 'nullable|string', 
                'jabatan_perekomendasi' => 'nullable|string', 'file_rekomendasi' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            ]);

            $rek = RekomendasiPendaftaran::where('user_id', $user->id)->first();
            if ($request->hasFile('file_rekomendasi')) {
                if ($rek && $rek->file_rekomendasi) Storage::disk('public')->delete($rek->file_rekomendasi);
                $validated['file_rekomendasi'] = $request->file('file_rekomendasi')->store('dokumen_rekomendasi', 'public');
            }

            $data = RekomendasiPendaftaran::updateOrCreate(['user_id' => $user->id], $validated);
            return response()->json(['success' => true, 'message' => 'Tahap 5 (Rekomendasi) disimpan.', 'data' => $data], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    // ==============================================
    // STEP 6: ESSAY
    // ==============================================
    public function storeEssay(Request $request)
    {
        try {
            $user = $request->user();
            if ($this->checkLockStatus($user->id)) return response()->json(['success' => false, 'message' => 'Profil terkunci.'], 403);

            $validated = $request->validate(['essay_kontribusi' => 'required|string|min:10']);

            $data = EssayPendaftaran::updateOrCreate(['user_id' => $user->id], $validated);
            return response()->json(['success' => true, 'message' => 'Tahap 6 (Essay) disimpan.', 'data' => $data], 200);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }

    // ==============================================
    // STEP 7: KIRIM FINAL
    // ==============================================
    public function submitFinal(Request $request)
    {
        $user = $request->user();
        $pendaftar = UserProfile::where('user_id', $user->id)->first();

        if (!$pendaftar) return response()->json(['success' => false, 'message' => 'Anda belum mengisi Profil Tahap 1.'], 404);

        $isRevisi = ($pendaftar->status === 'ditolak');

        $pendaftar->update([
            'status' => 'pending',
            'is_pengajuan_ulang' => $isRevisi ? true : false,
            'catatan' => null,
            'submitted_at' => now(),
            'responded_at' => null
        ]);

        return response()->json(['success' => true, 'message' => 'Pendaftaran Final Berhasil Dikirim dan Sedang Diproses.'], 200);
    }

    // ==============================================
    // GET: AMBIL SELURUH DATA PENDAFTARAN (STEP 1 - 6)
    // ==============================================
    public function getPendaftaranData(Request $request)
    {
        $userId = $request->user()->id;

        // Tarik data dari masing-masing tabel berdasarkan user_id
        $profil      = UserProfile::where('user_id', $userId)->first();
        $industri    = IndustriPendukung::where('user_id', $userId)->first();
        $universitas = UniversitasPendaftaran::where('user_id', $userId)->first();
        $biodata     = BiodataPendaftaran::where('user_id', $userId)->first();
        $rekomendasi = RekomendasiPendaftaran::where('user_id', $userId)->first();
        $essay       = EssayPendaftaran::where('user_id', $userId)->first();

        // Logika bonus: Cek apakah semua tahap sudah terisi
        $isReadyToSubmit = ($profil && $industri && $universitas && $biodata && $rekomendasi && $essay);

        return response()->json([
            'success' => true,
            'message' => 'Data pendaftaran berhasil diambil.',
            'data'    => [
                'is_ready_to_submit' => $isReadyToSubmit,
                'status_keseluruhan' => $profil ? $profil->status : 'Belum Mulai',
                'tahapan' => [
                    'step1_profil'      => $profil,
                    'step2_industri'    => $industri,
                    'step3_universitas' => $universitas,
                    'step4_biodata'     => $biodata,
                    'step5_rekomendasi' => $rekomendasi,
                    'step6_essay'       => $essay,
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
            // AMAN DARI IDOR: Kita WAJIB mencocokkan user_id dengan ID yang sedang login
            $userIdLogin = $request->user()->id;

            $pendaftar = UserProfile::with([
                'industri', 'universitas', 'biodata', 'rekomendasi', 'essay'
            ])
            ->where('id', $id)
            ->where('user_id', $userIdLogin) // <--- INI GEMBOK KEDUA NYA
            ->firstOrFail();

            return response()->json([
                'success' => true,
                'data'    => $pendaftar
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika ID tidak ada, ATAU jika ID ada tapi milik orang lain,
            // sistem akan pura-pura tidak tahu dan melempar 404.
            return response()->json([
                'success' => false,
                'message' => 'Data pendaftar tidak ditemukan atau Anda tidak memiliki akses.'
            ], 404);
        }
    }

}