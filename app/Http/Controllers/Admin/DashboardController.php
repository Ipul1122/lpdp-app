<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data dinamis dari database
        $totalPendaftar = UserProfile::count();
        $totalPending = UserProfile::where('status', 'pending')->count();
        $totalDiterima = UserProfile::where('status', 'diterima')->count();
        $totalRevisi = UserProfile::where('status', 'revisi')->count(); 
        $totalDitolak = UserProfile::where('status', 'ditolak')->count();

        // Statistik Kategori Pendaftaran
        $totalUsulanUnit = UserProfile::where('kategori', 'Usulan Unit')->count();
        $totalManajemenTalenta = UserProfile::where('kategori', 'Manajemen Talenta')->count();

        // Statistik Program Beasiswa
        $totalMagister = UserProfile::where('program_beasiswa', 'magister')->count();
        $totalDokter = UserProfile::where('program_beasiswa', 'dokter')->count();

        // 5 Pendaftar terbaru
        $recentPendaftar = UserProfile::with(['universitas'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPendaftar', 
            'totalPending', 
            'totalDiterima', 
            'totalRevisi', 
            'totalDitolak',
            'totalUsulanUnit',
            'totalManajemenTalenta',
            'totalMagister',
            'totalDokter',
            'recentPendaftar'
        ));
    }
}