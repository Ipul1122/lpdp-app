<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Mail\NotifikasiPendaftaranAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\IndustriPendukung;
use App\Models\UniversitasPendaftaran;

class PendaftaranController extends Controller
{
    public function index()
    {
       // Cek apakah user sudah punya data pendaftaran
        $hasProfile = UserProfile::where('user_id', Auth::id())->exists();

        // Jika sudah ada data (Draft Step 1 sudah diisi), langsung lompatkan ke Step 2
        if ($hasProfile) {
            return redirect()->route('pendaftaran.step', 2)->with('info', 'Anda sudah memiliki draft pendaftaran Tahap 1. Silakan lanjutkan.');
        }

        // Jika belum ada data sama sekali
        return view('pendaftaran.index');
    }

    // FUNGSI BARU: Mengatur Tampilan Berdasarkan Step (1-9)
    public function createStep($step)
    {
        $step = (int) $step;
        if ($step < 1 || $step > 9) abort(404);

        $profilExist = UserProfile::where('user_id', Auth::id())->first();

        // Cegah user melompat ke Step 2 dkk jika Step 1 belum diisi
        if ($step > 1 && !$profilExist) {
            return redirect()->route('pendaftaran.step', 1)->with('error', 'Silakan selesaikan Tahap 1 terlebih dahulu.');
        }

        $userProfile = $profilExist;
        $industri = IndustriPendukung::where('user_id', Auth::id())->first();
        $universitas = UniversitasPendaftaran::where('user_id', Auth::id())->first(); 

        // Siapkan variabel untuk Tempat dan Tanggal Lahir (khusus Step 1)
        $tempat_lahir = '';
        $tanggal_lahir = '';
        if ($userProfile && $userProfile->tempat_tglLahir) {
            $ttl = explode(', ', $userProfile->tempat_tglLahir);
            $tempat_lahir = $ttl[0] ?? '';
            $tanggal_lahir = $ttl[1] ?? '';
        }

        // --- INI BAGIAN YANG DIUBAH ---
        // Mencari file pendaftaran/step1.blade.php, step2.blade.php, dst.
        $viewName = 'pendaftaran.step' . $step; 
        
        if (view()->exists($viewName)) {
            return view($viewName, compact('step', 
            'userProfile', 
            'industri', 
            'universitas',
            'tempat_lahir', 
            'tanggal_lahir'));
        }

        // Jika file pendaftaran/step3.blade.php (dan seterusnya) belum dibuat, tampilkan pesan ini
        return redirect()->route('riwayat.index')->with('info', 'Tahap ' . $step . ' sedang dalam proses pengembangan.');
    }
    // FUNGSI BARU: Menyimpan Data Berdasarkan Step (1-9)
    public function storeStep(Request $request, $step)
    {
        $step = (int) $step;
        $profilExist = UserProfile::where('user_id', Auth::id())->first();

        // ==========================================
        // PENYIMPANAN TAHAP 1: PROFIL & KTP
        // ==========================================
        if ($step === 1) {
            $validated = $request->validate([
                // KTP hanya wajib (required) jika baru pertama kali daftar. Jika sudah ada draft, jadi opsional (nullable).
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
                'nik.unique' => 'NIK sudah digunakan oleh pendaftar lain.',
            ]);

            $validated['tempat_tglLahir'] = $validated['tempat_lahir'] . ', ' . $validated['tanggal_lahir'];
            unset($validated['tempat_lahir']);
            unset($validated['tanggal_lahir']);
            $validated['status'] = 'pending';
            $validated['is_pengajuan_ulang'] = false; 

            if ($request->hasFile('foto_ktp')) {
                if ($profilExist && $profilExist->foto_ktp) {
                    Storage::disk('public')->delete($profilExist->foto_ktp);
                }
                $path = $request->file('foto_ktp')->store('ktp', 'public');
                $validated['foto_ktp'] = $path;
            }

            UserProfile::updateOrCreate(['user_id' => Auth::id()], $validated);

            // CATATAN: Pengiriman Notifikasi Email ke Admin dihapus dari Step 1.
            // Baru akan dikirimkan nanti ketika User menyimpan Step ke-9.

            return redirect()->route('pendaftaran.step', 2)->with('success', 'Data Profil tersimpan, lanjut ke Tahap 2.');
        }

        // ==========================================
        // PENYIMPANAN TAHAP 2: INDUSTRI / PENDUKUNG
        // ==========================================
        if ($step === 2) {
            $validated = $request->validate([
                'instansi' => 'nullable|string|max:255',
                'sektor' => 'nullable|string|max:255',
                'jenis_instansi' => 'nullable|string|max:255',
                'nama_instansi' => 'nullable|string|max:255',
                'telepon_instansi' => 'nullable|string|max:20',
                'provinsi' => 'nullable|string|max:255',
                'kab_kota' => 'nullable|string|max:255',
                'alamat_instansi' => 'nullable|string',
                'status_kepegawaian' => 'nullable|string|max:255',
                'tanggal_mulai_kerja' => 'nullable|string',
                'pekerjaan' => 'nullable|string|max:255',
                'penghasilan' => 'nullable|string|max:255',
                'deskripsi_pekerjaan' => 'nullable|string',
                'surat_izin' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ]);

            $industriExist = IndustriPendukung::where('user_id', Auth::id())->first();

            if ($request->hasFile('surat_izin')) {
                if ($industriExist && $industriExist->surat_izin) {
                    Storage::disk('public')->delete($industriExist->surat_izin);
                }
                $validated['surat_izin'] = $request->file('surat_izin')->store('dokumen_industri', 'public');
            }

            IndustriPendukung::updateOrCreate(['user_id' => Auth::id()], $validated);

            return redirect()->route('pendaftaran.step', 3)->with('success', 'Data Industri tersimpan, lanjut ke Tahap 3.');
        }

        // ==========================================
        // PENYIMPANAN TAHAP 3: UNIVERSITAS TUJUAN
        // ==========================================
        if ($step === 3) {
            $validated = $request->validate([
                'negara_tujuan' => 'nullable|string|max:255',
                'provinsi' => 'nullable|string|max:255',
                'kota' => 'nullable|string|max:255',
                'nama_universitas' => 'nullable|string|max:255',
                'program_studi' => 'nullable|string|max:255',
                'tanggal_mulai_studi' => 'nullable|string',
                'durasi_studi' => 'nullable|integer',
                'loa' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'khs_ipk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ]);

            $univExist = UniversitasPendaftaran::where('user_id', Auth::id())->first();

            // Cek dan simpan file LoA
            if ($request->hasFile('loa')) {
                if ($univExist && $univExist->loa) {
                    Storage::disk('public')->delete($univExist->loa);
                }
                $validated['loa'] = $request->file('loa')->store('dokumen_universitas', 'public');
            }

            // Cek dan simpan file KHS/IPK
            if ($request->hasFile('khs_ipk')) {
                if ($univExist && $univExist->khs_ipk) {
                    Storage::disk('public')->delete($univExist->khs_ipk);
                }
                $validated['khs_ipk'] = $request->file('khs_ipk')->store('dokumen_universitas', 'public');
            }

            UniversitasPendaftaran::updateOrCreate(['user_id' => Auth::id()], $validated);

            return redirect()->route('pendaftaran.step', 4)->with('success', 'Data Universitas tersimpan, lanjut ke Tahap 4.');
        }

        // ==========================================
        // UNTUK SEMENTARA JIKA MASUK KE TAHAP 3 KE ATAS
        // ==========================================
        return redirect()->route('riwayat.index')->with('info', 'Tahap ' . $step . ' sedang dalam proses pengembangan.');
    }

    // ==========================================
    // RUTE EDIT UNTUK REVISI PENOLAKAN ADMIN
    // ==========================================
    public function edit($id)
    {
        $profil = UserProfile::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($profil->status !== 'ditolak') {
            return redirect()->route('riwayat.index')->with('error', 'Hanya pendaftaran yang ditolak yang bisa diajukan ulang.');
        }

        $ttl = explode(', ', $profil->tempat_tglLahir);
        $tempat_lahir = $ttl[0] ?? '';
        $tanggal_lahir = $ttl[1] ?? '';

        return view('pendaftaran.edit', compact('profil', 'tempat_lahir', 'tanggal_lahir'));
    }

    public function update(Request $request, $id)
    {
        $profil = UserProfile::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($profil->status !== 'ditolak') {
            return redirect()->route('riwayat.index')->with('error', 'Akses ditolak.');
        }

        $validated = $request->validate([
            'foto_ktp'          => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'nik'               => 'required|string|size:16|unique:user_profiles,nik,' . $profil->id,
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
            'nik.unique' => 'NIK sudah digunakan oleh pendaftar lain.',
        ]);

        $validated['tempat_tglLahir'] = $validated['tempat_lahir'] . ', ' . $validated['tanggal_lahir'];
        unset($validated['tempat_lahir']);
        unset($validated['tanggal_lahir']);
        
        $validated['status'] = 'pending';
        $validated['catatan'] = null;
        $validated['is_pengajuan_ulang'] = true; 

        if ($request->hasFile('foto_ktp')) {
            $path = $request->file('foto_ktp')->store('ktp', 'public');
            $validated['foto_ktp'] = $path;
        }

        $profil->update($validated);

        // Notifikasi pengajuan ulang tetap dikirim karena ini merevisi data secara langsung
        Mail::to('msyaifulloh2024@gmail.com')->send(new NotifikasiPendaftaranAdmin($profil, 'pengajuan_ulang'));

        return redirect()->route('riwayat.index')->with('success', 'Data pendaftaran berhasil diperbarui dan diajukan ulang!');
    }
}