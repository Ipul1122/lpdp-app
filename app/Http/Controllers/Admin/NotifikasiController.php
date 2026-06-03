<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of admin notifications.
     */
    public function index()
    {
        $notifications = Notification::whereNull('user_id')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.notifikasi.index', compact('notifications'));
    }

    /**
     * Mark all notifications as read for the admin.
     */
    public function markAllAsRead()
    {
        Notification::whereNull('user_id')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Semua notifikasi admin berhasil ditandai telah dibaca.');
    }
}
