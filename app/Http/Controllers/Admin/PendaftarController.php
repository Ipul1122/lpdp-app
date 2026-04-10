<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    public function index()
    {
        $pendaftars = UserProfile::with('user')->latest()->get();
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