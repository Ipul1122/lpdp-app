@extends('layouts.app')

@section('title', 'Notifikasi Aktivitas')

@section('content')
<div class="max-w-4xl mx-auto mt-8 px-4 mb-20">

    {{-- Breadcrumb --}}
    <nav class="flex items-center text-sm font-medium text-slate-500 mb-8">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        <a href="{{ route('dashboard') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
        <svg class="w-4 h-4 mx-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-800">Notifikasi</span>
    </nav>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Pusat Notifikasi</h1>
            <p class="text-slate-500">Pantau seluruh riwayat respon dan status pengajuan berkas Anda.</p>
        </div>
        
        @if($notifications->where('is_read', false)->isNotEmpty())
            <form action="{{ route('notifikasi.markAllRead') }}" method="POST" class="shrink-0">
                @csrf
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2 bg-orange-50 text-orange-600 hover:bg-orange-100 font-bold rounded-xl transition text-sm cursor-pointer border border-orange-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-sm font-semibold flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Notification List --}}
    <div class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden">
        @if($notifications->isNotEmpty())
            <div class="divide-y divide-slate-100">
                @foreach($notifications as $notif)
                    <div class="p-6 hover:bg-slate-50/50 transition duration-150 flex items-start gap-4 {{ !$notif->is_read ? 'bg-orange-50/5' : '' }}">
                        {{-- Icon --}}
                        <div class="shrink-0 p-3 rounded-2xl flex items-center justify-center 
                            {{ $notif->type === 'approved' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">
                            @if($notif->type === 'approved')
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            @endif
                        </div>

                        {{-- Details --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-1">
                                <h3 class="text-sm font-bold text-slate-800 truncate">{{ $notif->title }}</h3>
                                <span class="text-[10px] text-slate-400 font-medium shrink-0">{{ $notif->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-slate-600 leading-relaxed font-medium">{{ $notif->message }}</p>
                            
                            {{-- Action buttons if applicable --}}
                            @if($notif->type === 'rejected')
                                <div class="mt-4 flex gap-2">
                                    <a href="{{ route('pendaftaran.step1', ['action' => 'revisi']) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-800 text-white text-xs font-bold rounded-lg hover:bg-slate-900 transition shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Revisi Sekarang
                                    </a>
                                    <a href="{{ route('riwayat.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-600 hover:bg-slate-200 text-xs font-bold rounded-lg transition">
                                        Lihat Riwayat
                                    </a>
                                </div>
                            @elseif($notif->type === 'approved')
                                <div class="mt-4">
                                    <a href="{{ route('riwayat.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 text-xs font-bold rounded-lg transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Detail Pendaftaran
                                    </a>
                                </div>
                            @endif
                        </div>

                        {{-- Unread Dot --}}
                        @if(!$notif->is_read)
                            <div class="shrink-0 mt-1.5">
                                <span class="block w-2.5 h-2.5 bg-orange-500 rounded-full"></span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($notifications->hasPages())
                <div class="p-6 border-t border-slate-100">
                    {{ $notifications->links() }}
                </div>
            @endif
        @else
            <div class="p-16 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-base font-bold text-slate-700 mb-1">Belum ada notifikasi</h3>
                <p class="text-sm text-slate-400 max-w-sm">Setiap ada update status persetujuan dari admin, log aktivitas akan tampil di halaman ini.</p>
            </div>
        @endif
    </div>

</div>
@endsection
