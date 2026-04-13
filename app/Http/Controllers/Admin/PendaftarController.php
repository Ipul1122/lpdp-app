<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        // 1. TAMBAHKAN SEMUA RELASI DI SINI (Eager Loading)
        $query = UserProfile::with(['user', 'industri', 'universitas', 'biodata', 'rekomendasi', 'essay'])->latest();
        
        $filterActive = $request->filter ?? 'baru';

        // 2. Filter berdasarkan URL parameter
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

        $pendaftars = $query->get();
        
        return view('admin.pendaftar.index', compact('pendaftars', 'filterActive'));
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

        // 7. Tentukan filter redirect berdasarkan status baru
        $filterRedirect = match($request->status) {
            'diterima' => 'disetujui',
            'ditolak'  => 'ditolak',
            default    => 'baru',
        };

        return redirect()->route('admin.pendaftar.index', ['filter' => $filterRedirect])
                         ->with('success', 'Status pendaftar ' . $pendaftar->nama . ' berhasil diubah menjadi ' . ucfirst($request->status));
    }
}