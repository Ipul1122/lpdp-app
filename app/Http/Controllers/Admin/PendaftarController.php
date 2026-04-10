<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;

class PendaftarController extends Controller
{
    public function index()
    {
        // Mengambil data semua pendaftar
        $pendaftars = UserProfile::all();

        return view('admin.pendaftar.index', compact('pendaftars'));
    }

    public function updateStatus($id)
    {
        $pendaftar = UserProfile::findOrFail($id);
        $pendaftar->status = request('status');
        $pendaftar->save();

        return back()->with('success', 'Status pendaftar berhasil diperbarui');
    }
}