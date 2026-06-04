@extends('layouts.admin.app')
@section('title', 'Jejak Audit Admin')

@section('content')
<div class="max-w-6xl mx-auto pb-20">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Jejak Audit Aktivitas Admin</h1>
            <p class="text-slate-500 text-sm mt-1">Log pencatatan aktivitas dan keputusan yang diambil oleh administrator sistem.</p>
        </div>
        
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm shrink-0">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>
    </div>

    <!-- Search Form -->
    <form action="{{ route('admin.audit-logs.index') }}" method="GET" class="mb-6 flex flex-col md:flex-row gap-3">
        <div class="relative flex-1">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aktivitas, admin, atau detail..." 
                   class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none text-sm transition-all shadow-sm">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-slate-800 text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-slate-700 transition shadow-sm flex items-center justify-center min-w-[100px]">
                Cari
            </button>
            
            @if(request('search'))
                <a href="{{ route('admin.audit-logs.index') }}" class="bg-slate-100 text-slate-500 border border-slate-200 px-4 py-3 rounded-xl text-sm font-bold hover:bg-slate-200 hover:text-slate-700 transition shadow-sm flex items-center justify-center shrink-0" title="Reset Pencarian">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
            @endif
        </div>
    </form>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-sm">
                        <th class="py-4 px-6 font-semibold text-slate-600 whitespace-nowrap">Waktu</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 whitespace-nowrap">Administrator</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 whitespace-nowrap">Aksi</th>
                        <th class="py-4 px-6 font-semibold text-slate-600">Detail Aktivitas</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 whitespace-nowrap">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6 text-slate-600 whitespace-nowrap font-medium">
                                {{ $log->created_at->translatedFormat('d M Y, H:i') }} WIB
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-800 block">{{ $log->admin->name ?? 'System' }}</span>
                                <span class="text-xs text-slate-400">{{ $log->admin->email ?? '-' }}</span>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                @php
                                    $badgeColor = match($log->action) {
                                        'update_status' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                                        'login' => 'bg-green-50 text-green-700 border-green-100',
                                        'logout' => 'bg-amber-50 text-amber-700 border-amber-100',
                                        default => 'bg-slate-50 text-slate-700 border-slate-100',
                                    };
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold border capitalize {{ $badgeColor }}">
                                    {{ str_replace('_', ' ', $log->action) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-slate-700 font-medium">
                                {{ $log->details }}
                            </td>
                            <td class="py-4 px-6 text-slate-500 whitespace-nowrap font-mono text-xs">
                                {{ $log->ip_address ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 px-6 text-center text-slate-500">
                                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Tidak ada log audit yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-slate-100 bg-slate-50">
            {{ $logs->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
