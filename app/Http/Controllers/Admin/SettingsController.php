<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Setting;
use App\Models\AdminAuditLog;

class SettingsController extends Controller
{
    /**
     * Tampilkan halaman pengaturan admin.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $isLocked = Setting::get('lock_registration', '0') === '1';

        return view('admin.settings.index', compact('admin', 'isLocked'));
    }

    /**
     * Memproses pembaruan password admin.
     */
    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password' => 'Password baru harus minimal 8 karakter dan mengandung huruf kapital, angka, serta simbol.',
        ]);

        // Cek kecocokan password saat ini
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.'])->onlyInput('current_password');
        }

        // Update password
        $admin->password = Hash::make($request->password);
        $admin->save();

        // Catat Jejak Audit
        AdminAuditLog::create([
            'admin_id' => $admin->id,
            'action' => 'change_password',
            'target_type' => 'Admin',
            'target_id' => $admin->id,
            'details' => 'Admin mengubah password akun.',
            'ip_address' => $request->ip()
        ]);

        return back()->with('success', 'Password Anda berhasil diperbarui.');
    }

    /**
     * Memproses pengaturan kunci pendaftaran.
     */
    public function updateRegistrationLock(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        $request->validate([
            'lock_registration' => ['required', 'in:0,1'],
        ]);

        $lockState = $request->lock_registration;
        Setting::set('lock_registration', $lockState);

        $statusStr = $lockState === '1' ? 'Terkunci (Ditutup)' : 'Terbuka (Dibuka)';

        // Catat Jejak Audit
        AdminAuditLog::create([
            'admin_id' => $admin->id,
            'action' => $lockState === '1' ? 'lock_registration' : 'unlock_registration',
            'target_type' => 'Setting',
            'target_id' => 0,
            'details' => 'Admin mengubah status pendaftaran menjadi: ' . $statusStr,
            'ip_address' => $request->ip()
        ]);

        return back()->with('success', 'Status pendaftaran berhasil diubah menjadi ' . $statusStr . '.');
    }
}
