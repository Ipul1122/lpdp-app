<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $query = UserProfile::with(['user', 'industri', 'universitas', 'rekomendasi', 'essay'])->latest();
        
        $filterActive = $request->filter ?? 'baru';

        // Filter berdasarkan URL parameter
        switch ($filterActive) {
            case 'pengajuan_ulang':
                // Hanya tampilkan yang direvisi DAN statusnya masih pending
                $query->where('is_pengajuan_ulang', true)
                      ->where('status', 'pending');
                break;
                
            case 'disetujui':
                $query->where('status', 'diterima');
                break;
                
            case 'ditolak':
                $query->where('status', 'ditolak');
                break;
                
            case 'baru':
            default:
                // Tampilkan pendaftar baru DAN statusnya masih pending
                $query->where('status', 'pending')
                      ->where(function($q) {
                          $q->where('is_pengajuan_ulang', false)
                            ->orWhereNull('is_pengajuan_ulang');
                      });
                break;
        }

        // Filter berdasarkan Program Beasiswa (magister atau dokter)
        if ($request->filled('program_beasiswa')) {
            $query->where('program_beasiswa', $request->program_beasiswa);
        }

        // Filter berdasarkan Kategori (Usulan Unit atau Manajemen Talenta)
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $pendaftars = $query->paginate(10); 
        
        return view('admin.pendaftar.index', compact(
            'pendaftars', 'filterActive'));
    }
   public function updateStatus(Request $request, $id)
    {
        // 1. Lakukan validasi request terlebih dahulu
        $request->validate([
            'status'  => 'required|in:pending,diproses,diterima,ditolak',
            'catatan' => 'nullable|string|max:255',
            'filter'  => 'nullable|string|in:baru,pengajuan_ulang,disetujui,ditolak',
        ]);

        // 2. Cari pendaftar berdasarkan ID
        $pendaftar = UserProfile::findOrFail($id);

        // 3. Masukkan data status dan rekam waktu respon Admin
        $pendaftar->status = $request->status;
        $pendaftar->responded_at = now(); // Taruh di sini, bukan di dalam array validate

        // 4. Kelola Catatan Penolakan
        if ($request->status === 'ditolak') {
            // Jika ditolak, simpan catatan dari admin
            $pendaftar->catatan = $request->catatan;
        } else {
            // Bersihkan catatan jika diubah menjadi diterima/diproses
            $pendaftar->catatan = null; 
        }

        // 5. Reset is_pengajuan_ulang ketika sudah ada keputusan
        if ($request->status === 'diterima' || $request->status === 'ditolak') {
            $pendaftar->is_pengajuan_ulang = false;
        }

        // 6. Simpan perubahan ke database
        $pendaftar->save();

        // 6b. Catat Jejak Audit Admin
        \App\Models\AdminAuditLog::create([
            'admin_id' => auth()->guard('admin')->id(),
            'action' => 'update_status',
            'target_type' => 'UserProfile',
            'target_id' => $pendaftar->id,
            'details' => 'Mengubah status pendaftaran ' . $pendaftar->nama . ' (REG-' . str_pad($pendaftar->id, 5, '0', STR_PAD_LEFT) . ') menjadi ' . ucfirst($request->status) . ($request->catatan ? ' dengan catatan: ' . $request->catatan : ''),
            'ip_address' => $request->ip()
        ]);

        // 6a. Catat Notifikasi untuk User jika disetujui / ditolak
        if ($request->status === 'diterima' || $request->status === 'ditolak') {
            $title = $request->status === 'diterima' ? 'Pendaftaran Disetujui' : 'Pendaftaran Ditolak';
            $message = $request->status === 'diterima' 
                ? 'Selamat! Berkas pendaftaran Anda telah disetujui oleh Admin.'
                : 'Maaf, berkas pendaftaran Anda ditolak. Catatan: ' . ($request->catatan ?? 'Tidak ada catatan khusus.');
            $type = $request->status === 'diterima' ? 'approved' : 'rejected';

            \App\Models\Notification::create([
                'user_id' => $pendaftar->user_id,
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'is_read' => false,
            ]);
        }

        // 7. Tentukan filter redirect berdasarkan status baru
        $filterRedirect = match($request->status) {
            'diterima' => 'disetujui',
            'ditolak'  => 'ditolak',
            default    => 'baru',
        };

        return redirect()->route('admin.pendaftar.index', ['filter' => $filterRedirect])
                         ->with('success', 'Status pendaftar ' . $pendaftar->nama . ' berhasil diubah menjadi ' . ucfirst($request->status));
    }

    public function infoPendaftar(Request $request)
    {
        $search = $request->query('search');
        $filter = $request->query('filter');

        $query = User::leftJoin('user_profiles', 'users.id', '=', 'user_profiles.user_id')
                    ->select(
                        'users.id as reg_id', 
                        'users.email', 
                        'users.password', 
                        'users.created_at',
                        'user_profiles.nama', 
                        'user_profiles.no_telp'
                    );

        // Logika FITUR SEARCH (Jika admin mengetik sesuatu)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('user_profiles.nama', 'like', "%{$search}%")
                  ->orWhere('users.email', 'like', "%{$search}%")
                  ->orWhere('user_profiles.no_telp', 'like', "%{$search}%");
            });
        }

        // Logika FITUR DROPDOWN FILTER
        if ($filter === 'lengkap') {
            $query->whereNotNull('user_profiles.nama');
        } elseif ($filter === 'belum_lengkap') {
            $query->whereNull('user_profiles.nama'); // Hanya yang baru daftar Gmail saja
        }

        // Eksekusi Query dengan Pagination
        $users = $query->orderBy('users.created_at', 'desc')->paginate(15);

        // Kirim data dan status pencarian ke tampilan
        return view('admin.pendaftar.infoPendaftar', compact('users', 'search', 'filter'));
    }

    public function exportCsv()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=daftar-pendaftar-" . now()->format('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $pendaftarans = UserProfile::with(['user', 'industri', 'universitas', 'rekomendasi', 'essay'])->get();

        $columns = [
            'No REG',
            'NIK',
            'Nama Lengkap',
            'Email',
            'No. WhatsApp',
            'Tempat Tanggal Lahir',
            'Alamat',
            'RT',
            'RW',
            'Kelurahan/Desa',
            'Kecamatan',
            'Agama',
            'Status Perkawinan',
            'Pekerjaan',
            'Kewarganegaraan',
            'Program Beasiswa',
            'Kategori Pendaftaran',
            'Pas Foto 3x4 (Link)',
            'Foto KTP (Link)',
            'Unit Kerja',
            'Jabatan',
            'Golongan',
            'Tanggal Mulai Kerja',
            'Tanggal Pensiun',
            'Surat Izin / Rekomendasi Instansi (Link)',
            'Universitas Tujuan',
            'Program Studi',
            'Kota Universitas',
            'Rencana Mulai Studi',
            'Durasi Studi (Bulan)',
            'LoA (Link)',
            'KHS / Bukti IPK (Link)',
            'Kategori Rekomendasi',
            'Nama Perekomendasi',
            'Instansi Perekomendasi',
            'Jabatan Perekomendasi',
            'Surat Rekomendasi (Link)',
            'Essay Kontribusi',
            'Surat Komitmen (Link)',
            'Status',
            'Catatan Admin',
            'Waktu Submit'
        ];

        $callback = function() use($pendaftarans, $columns) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for proper Excel encoding
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, $columns, ",", '"', "\\");
 
            foreach ($pendaftarans as $p) {
                fputcsv($file, [
                    'REG-' . str_pad($p->user_id, 5, '0', STR_PAD_LEFT),
                    $p->nik ?? '-',
                    $p->nama ?? '-',
                    $p->user->email ?? '-',
                    $p->no_telp ?? '-',
                    $p->tempat_tglLahir ?? '-',
                    $p->alamat ?? '-',
                    $p->rt ?? '-',
                    $p->rw ?? '-',
                    $p->kelurahan ?? '-',
                    $p->kecamatan ?? '-',
                    $p->agama ?? '-',
                    $p->status_perkawinan ?? '-',
                    $p->pekerjaan ?? '-',
                    $p->kewarganegaraan ?? '-',
                    $p->program_beasiswa ? ucfirst($p->program_beasiswa) : '-',
                    $p->kategori ?? '-',
                    $p->pas_foto ? url(Storage::url($p->pas_foto)) : '-',
                    $p->foto_ktp ? url(Storage::url($p->foto_ktp)) : '-',
                    $p->industri?->unit_kerja ?? '-',
                    $p->industri?->jabatan ?? '-',
                    $p->industri?->golongan ?? '-',
                    $p->industri?->tanggal_mulai_kerja ?? '-',
                    $p->industri?->tanggal_pensiun ?? '-',
                    $p->industri?->surat_izin ? url(Storage::url($p->industri->surat_izin)) : '-',
                    $p->universitas?->nama_universitas ?? '-',
                    $p->universitas?->program_studi ?? '-',
                    $p->universitas?->kota ?? '-',
                    $p->universitas?->tanggal_mulai_studi ?? '-',
                    $p->universitas?->durasi_studi ?? '-',
                    $p->universitas?->loa ? url(Storage::url($p->universitas->loa)) : '-',
                    $p->universitas?->khs_ipk ? url(Storage::url($p->universitas->khs_ipk)) : '-',
                    $p->rekomendasi?->kategori ?? '-',
                    $p->rekomendasi?->nama_perekomendasi ?? '-',
                    $p->rekomendasi?->instansi_perekomendasi ?? '-',
                    $p->rekomendasi?->jabatan_perekomendasi ?? '-',
                    $p->rekomendasi?->file_rekomendasi ? url(Storage::url($p->rekomendasi->file_rekomendasi)) : '-',
                    $p->essay?->essay_kontribusi ?? '-',
                    $p->surat_komitmen ? url(Storage::url($p->surat_komitmen)) : '-',
                    ucfirst($p->status),
                    $p->catatan ?? '-',
                    $p->submitted_at ? $p->submitted_at->format('d-m-Y H:i') . ' WIB' : '-'
                ], ",", '"', "\\");
            }
 
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}