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

        // Filter jika admin menekan tab pengajuan ulang
        if ($request->filter === 'pengajuan_ulang') {
            $query->where('is_pengajuan_ulang', true);
        }

        $pendaftars = $query->get();
        return view('admin.pendaftar.index', compact('pendaftars'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,diterima,ditolak',
            'catatan' => 'nullable|string|max:255'
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

        return back()->with('success', 'Status pendaftar ' . $pendaftar->nama . ' berhasil diubah menjadi ' . ucfirst($request->status));
    }
}