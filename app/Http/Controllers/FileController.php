<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserProfile;
use App\Models\IndustriPendukung;
use App\Models\UniversitasPendaftaran;
use App\Models\RekomendasiPendaftaran;

class FileController extends Controller
{
    /**
     * Tampilkan/Unduh berkas pendaftaran secara aman.
     */
    public function show(Request $request, $type, $userId = null)
    {
        // 1. Cek Autentikasi (User biasa atau Admin)
        $isUserLoggedIn = Auth::check();
        $isAdmin = Auth::guard('admin')->check();

        if (!$isUserLoggedIn && !$isAdmin) {
            abort(403, 'Akses ditolak. Silakan login terlebih dahulu.');
        }

        // 2. Tentukan User ID yang datanya akan diakses
        $currentUserId = Auth::id();
        if (!$isAdmin) {
            // Jika bukan admin, pastikan tidak mengakses milik orang lain secara eksplisit
            if ($userId && $userId != $currentUserId) {
                abort(403, 'Akses ditolak. Anda hanya diperbolehkan mengakses berkas Anda sendiri.');
            }
            $userId = $currentUserId;
        } else {
            // Jika admin, tapi tidak menyertakan userId di parameter, gunakan user id pendaftar
            if (!$userId) {
                abort(400, 'Parameter User ID diperlukan bagi Admin.');
            }
        }

        // 3. Cari path berkas di database berdasarkan jenis (type)
        $path = null;
        switch ($type) {
            case 'foto_ktp':
            case 'pas_foto':
            case 'surat_komitmen':
                $profile = UserProfile::where('user_id', $userId)->first();
                $path = $profile ? $profile->{$type} : null;
                break;
                
            case 'surat_izin':
                $industri = IndustriPendukung::where('user_id', $userId)->first();
                $path = $industri ? $industri->surat_izin : null;
                break;
                
            case 'loa':
            case 'khs_ipk':
                $universitas = UniversitasPendaftaran::where('user_id', $userId)->first();
                $path = $universitas ? $universitas->{$type} : null;
                break;
                
            case 'file_rekomendasi':
                $rekomendasi = RekomendasiPendaftaran::where('user_id', $userId)->first();
                $path = $rekomendasi ? $rekomendasi->file_rekomendasi : null;
                break;
                
            default:
                abort(404, 'Tipe berkas tidak dikenali.');
        }

        // 4. Cek apakah berkas ada di storage privat (local disk)
        if (!$path || !Storage::disk('local')->exists($path)) {
            abort(404, 'Berkas tidak ditemukan pada server.');
        }

        // 5. Sajikan berkas ke browser
        $filePath = Storage::disk('local')->path($path);
        
        // Dapatkan mime type
        $mimeType = Storage::disk('local')->mimeType($path) ?? 'application/octet-stream';
        
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);
    }
}
