<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminAuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AdminAuditLog::with('admin')->latest();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('details', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%")
                  ->orWhereHas('admin', function($q) use($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }
        
        $logs = $query->paginate(15);
        
        return view('admin.audit_logs.index', compact('logs'));
    }
}
