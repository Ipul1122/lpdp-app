<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        // Ambil data profil user saat ini (jika ada)
        $riwayatProfil = UserProfile::where('user_id', Auth::id())->first();

        // Kirim data ke view
        return view('riwayat.index', compact('riwayatProfil'));
    }
}