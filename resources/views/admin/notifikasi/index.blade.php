@extends('layouts.admin.app')

@section('title', 'Notifikasi Pendaftaran')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Pusat Notifikasi Admin</h2>
            <p class="text-slate-500 text-sm mt-1">Pantau aktivitas pendaftaran baru dan pengajuan ulang dari user.</p>
        </div>
        
        @if($notifications->where('is_read', false)->isNotEmpty())
            <form action="{{ route('admin.notifikasi.markAllRead') }}" method="POST" class="shrink-0">
                @csrf
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2 bg-orange-50 text-orange-600 hover:bg-orange-100 font-bold rounded-xl transition text-sm cursor-pointer border border-orange-200 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    {{-- Notification List --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if($notifications->isNotEmpty())
            <ul class="divide-y divide-slate-100">
                @foreach($notifications as $notif)
                    <li class="p-5 hover:bg-slate-50 transition flex items-start gap-4 {{ !$notif->is_read ? 'bg-orange-50/10' : '' }}">
                        {{-- Icon --}}
                        <div class="shrink-0 p-3 rounded-xl flex items-center justify-center
                            {{ $notif->type === 're_submission' ? 'bg-blue-100 text-blue-600' : 'bg-emerald-100 text-emerald-600' }}">
                            @if($notif->type === 're_submission')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18.5"></path></svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            @endif
                        </div>

                        {{-- Details --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-1">
                                <h4 class="text-sm font-bold text-slate-800 truncate">{{ $notif->title }}</h4>
                                <span class="text-[10px] text-slate-400 font-medium shrink-0">{{ $notif->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-slate-600 leading-relaxed font-medium">{{ $notif->message }}</p>
                        </div>

                        {{-- Action Link --}}
                        <div class="shrink-0 flex items-center gap-3 self-center">
                            @if($notif->type === 're_submission')
                                <a href="{{ route('admin.pendaftar.index', ['filter' => 'pengajuan_ulang']) }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 bg-white border border-blue-200 px-3 py-1.5 rounded-lg shadow-sm whitespace-nowrap">
                                    Review Sekarang
                                </a>
                            @else
                                <a href="{{ route('admin.pendaftar.index', ['filter' => 'baru']) }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 bg-white border border-emerald-200 px-3 py-1.5 rounded-lg shadow-sm whitespace-nowrap">
                                    Review Sekarang
                                </a>
                            @endif

                            @if(!$notif->is_read)
                                <span class="block w-2.5 h-2.5 bg-orange-500 rounded-full shrink-0"></span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>

            {{-- Pagination --}}
            @if($notifications->hasPages())
                <div class="p-5 border-t border-slate-100">
                    {{ $notifications->links() }}
                </div>
            @endif
        @else
            <div class="p-16 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-base font-bold text-slate-700 mb-1">Belum ada notifikasi</h3>
                <p class="text-sm text-slate-400 max-w-sm font-medium">Setiap ada pengguna yang menyelesaikan pengisian form atau pengajuan revisi berkas, notifikasi log akan muncul di sini.</p>
            </div>
        @endif
    </div>
</div>
@endsection