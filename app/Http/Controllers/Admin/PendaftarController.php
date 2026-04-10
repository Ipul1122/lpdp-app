<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $query = UserProfile::with('user')->latest();
        $filterActive = $request->filter ?? 'baru';

        // Filter berdasarkan URL parameter
        switch ($filterActive) {
            case 'pengajuan_ulang':
                $query->where('is_pengajuan_ulang', true);
                break;
            case 'disetujui':
                $query->where('status', 'diterima');
                break;
            case 'ditolak':
                $query->where('status', 'ditolak');
                break;
            case 'baru':
            default:
                // Tampilkan pendaftar baru (is_pengajuan_ulang false/null)
                $query->where(function($q) {
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
        $request->validate([
            'status' => 'required|in:pending,diproses,diterima,ditolak',
            'catatan' => 'nullable|string|max:255',
            'filter' => 'nullable|string|in:baru,pengajuan_ulang,disetujui,ditolak'
        ]);

        $pendaftar = UserProfile::findOrFail($id);
        $pendaftar->status = $request->status;

        // Jika ditolak, simpan catatan dari admin
        if ($request->status === 'ditolak') {
            $pendaftar->catatan = $request->catatan;
        } else {
            // Bersihkan catatan jika diubah menjadi diterima/diproses
            $pendaftar->catatan = null; 
        }

        $pendaftar->save();

        // Tentukan filter redirect berdasarkan status baru
        $filterRedirect = match($request->status) {
            'diterima' => 'disetujui',
            'ditolak' => 'ditolak',
            default => 'baru',
        };

        return redirect()->route('admin.pendaftar.index', ['filter' => $filterRedirect])
                        ->with('success', 'Status pendaftar ' . $pendaftar->nama . ' berhasil diubah menjadi ' . ucfirst($request->status));
    }
}