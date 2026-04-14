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


        return view('admin.dashboard', compact('totalPendaftar', 'totalPending', 'totalDiterima', 'totalRevisi', 'totalDitolak'));
    }
}