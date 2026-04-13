<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserProfile;
use App\Models\IndustriPendukung;
use App\Models\UniversitasPendaftaran;
use App\Models\BiodataPendaftaran;
use App\Models\RekomendasiPendaftaran;
use App\Models\EssayPendaftaran;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        // Tarik semua data dari Step 1 sampai 6
        $userProfile = UserProfile::where('user_id', $userId)->first();
        $industri = IndustriPendukung::where('user_id', $userId)->first();
        $universitas = UniversitasPendaftaran::where('user_id', $userId)->first();
        $biodata = BiodataPendaftaran::where('user_id', $userId)->first();
        $rekomendasi = RekomendasiPendaftaran::where('user_id', $userId)->first();
        $essay = EssayPendaftaran::where('user_id', $userId)->first();

        // Pecah Tempat dan Tanggal Lahir untuk form
        $tempat_lahir = '';
        $tanggal_lahir = '';
        if ($userProfile && $userProfile->tempat_tglLahir) {
            $ttl = explode(', ', $userProfile->tempat_tglLahir);
            $tempat_lahir = $ttl[0] ?? '';
            $tanggal_lahir = $ttl[1] ?? '';
        }

        // Kunci form jika status bukan draft/ditolak
        $isLocked = $userProfile && !in_array($userProfile->status, ['draft', 'ditolak']);

        return view('profile.index', compact(
            'userProfile', 'industri', 'universitas', 'biodata', 'rekomendasi', 'essay', 
            'tempat_lahir', 'tanggal_lahir', 'isLocked'
        ));
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $userProfile = UserProfile::where('user_id', $userId)->first();
        $section = $request->input('section', 'profil');

        // Pengecekan Kunci Keamanan
        if ($userProfile && !in_array($userProfile->status, ['draft', 'ditolak'])) {
            return back()->with('error', 'Profil terkunci karena pendaftaran Anda sedang diproses.');
        }

        // Paksa isi profil dulu sebelum tab lain
        if ($section !== 'profil' && !$userProfile) {
            return back()->with('error', 'Silakan isi Data Profil Pribadi terlebih dahulu.')->with('activeTab', 'profil');
        }

        // --- LOGIKA PENYIMPANAN BERDASARKAN TAB ---
        switch ($section) {
            case 'profil':
                $validated = $request->validate([
                    'foto_ktp'          => $userProfile && $userProfile->foto_ktp ? 'nullable|image|mimes:jpeg,png,jpg|max:5120' : 'required|image|mimes:jpeg,png,jpg|max:5120',
                    'nik'               => 'required|string|size:16|unique:user_profiles,nik,' . $userId . ',user_id',
                    'nama'              => 'required|string|max:255',
                    'no_telp'           => 'required|numeric',
                    'tempat_lahir'      => 'required|string|max:100', 'tanggal_lahir' => 'required|date',           
                    'alamat'            => 'required|string', 'rt' => 'required|numeric', 'rw' => 'required|numeric',
                    'kelurahan'         => 'required|string|max:100', 'kecamatan' => 'required|string|max:100',
                    'agama'             => 'required|string|max:50', 'status_perkawinan' => 'required|string|max:50',
                    'pekerjaan'         => 'required|string|max:100', 'kewarganegaraan' => 'required|string|max:50',
                    'program_beasiswa'  => 'required|in:sarjana,magister,dokter', 
                ]);
                $validated['tempat_tglLahir'] = $validated['tempat_lahir'] . ', ' . $validated['tanggal_lahir'];
                unset($validated['tempat_lahir'], $validated['tanggal_lahir']);
                
                if (!$userProfile) {
                    $validated['status'] = 'draft'; 
                    $validated['is_pengajuan_ulang'] = false;
                }

                if ($request->hasFile('foto_ktp')) {
                    if ($userProfile && $userProfile->foto_ktp) Storage::disk('public')->delete($userProfile->foto_ktp);
                    $validated['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'public');
                }
                UserProfile::updateOrCreate(['user_id' => $userId], $validated);
                break;

            case 'industri':
                $validated = $request->validate([
                    'instansi' => 'nullable|string', 'sektor' => 'nullable|string', 'jenis_instansi' => 'nullable|string',
                    'nama_instansi' => 'nullable|string', 'telepon_instansi' => 'nullable|string', 'provinsi' => 'nullable|string',
                    'kab_kota' => 'nullable|string', 'alamat_instansi' => 'nullable|string', 'status_kepegawaian' => 'nullable|string',
                    'tanggal_mulai_kerja' => 'nullable|string', 'pekerjaan' => 'nullable|string', 'penghasilan' => 'nullable|string',
                    'deskripsi_pekerjaan' => 'nullable|string', 'surat_izin' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                ]);
                $industri = IndustriPendukung::where('user_id', $userId)->first();
                if ($request->hasFile('surat_izin')) {
                    if ($industri && $industri->surat_izin) Storage::disk('public')->delete($industri->surat_izin);
                    $validated['surat_izin'] = $request->file('surat_izin')->store('dokumen_industri', 'public');
                }
                IndustriPendukung::updateOrCreate(['user_id' => $userId], $validated);
                break;

            case 'universitas':
                $validated = $request->validate([
                    'negara_tujuan' => 'nullable|string', 'provinsi' => 'nullable|string', 'kota' => 'nullable|string',
                    'nama_universitas' => 'nullable|string', 'program_studi' => 'nullable|string', 'tanggal_mulai_studi' => 'nullable|string',
                    'durasi_studi' => 'nullable|integer', 'loa' => 'nullable|file|mimes:pdf,jpg,png|max:5120', 'khs_ipk' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
                ]);
                $univ = UniversitasPendaftaran::where('user_id', $userId)->first();
                if ($request->hasFile('loa')) {
                    if ($univ && $univ->loa) Storage::disk('public')->delete($univ->loa);
                    $validated['loa'] = $request->file('loa')->store('dokumen_universitas', 'public');
                }
                if ($request->hasFile('khs_ipk')) {
                    if ($univ && $univ->khs_ipk) Storage::disk('public')->delete($univ->khs_ipk);
                    $validated['khs_ipk'] = $request->file('khs_ipk')->store('dokumen_universitas', 'public');
                }
                UniversitasPendaftaran::updateOrCreate(['user_id' => $userId], $validated);
                break;

            case 'biodata':
                $validated = $request->validate([
                    'deskripsi_diri' => 'nullable|string', 'riwayat_pendidikan' => 'nullable|string', 'pengalaman_kerja' => 'nullable|string',
                    'pengalaman_organisasi' => 'nullable|string', 'prestasi' => 'nullable|string', 'keahlian' => 'nullable|string', 'bahasa' => 'nullable|string',
                ]);
                BiodataPendaftaran::updateOrCreate(['user_id' => $userId], $validated);
                break;

            case 'rekomendasi':
                $validated = $request->validate([
                    'nama_perekomendasi' => 'nullable|string', 'instansi_perekomendasi' => 'nullable|string', 
                    'jabatan_perekomendasi' => 'nullable|string', 'file_rekomendasi' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
                ]);
                $rek = RekomendasiPendaftaran::where('user_id', $userId)->first();
                if ($request->hasFile('file_rekomendasi')) {
                    if ($rek && $rek->file_rekomendasi) Storage::disk('public')->delete($rek->file_rekomendasi);
                    $validated['file_rekomendasi'] = $request->file('file_rekomendasi')->store('dokumen_rekomendasi', 'public');
                }
                RekomendasiPendaftaran::updateOrCreate(['user_id' => $userId], $validated);
                break;

            case 'essay':
                $validated = $request->validate(['essay_kontribusi' => 'required|string|min:10']);
                EssayPendaftaran::updateOrCreate(['user_id' => $userId], $validated);
                break;
        }

        // Kembalikan ke tab yang sama dengan membawa pesan sukses
        return back()->with('success', 'Data berhasil diperbarui.')->with('activeTab', $section);
    }
}