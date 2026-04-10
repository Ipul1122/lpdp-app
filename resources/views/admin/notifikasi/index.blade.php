{{-- @extends('layouts.admin.app')

@section('title', 'Notifikasi Pendaftaran')

@section('content')
<div class="p-8">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Pusat Notifikasi</h2>
        <p class="text-slate-500 text-sm mt-1">Pantau aktivitas pendaftaran dan pengajuan ulang dari user.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <ul class="divide-y divide-slate-100">
            <li class="p-4 hover:bg-slate-50 transition flex items-start gap-4 bg-blue-50/50">
                <div class="bg-blue-100 text-blue-600 p-2 rounded-lg shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-sm font-semibold text-slate-800">Pengajuan Ulang (Revisi)</h4>
                    <p class="text-sm text-slate-600 mt-0.5">Budi Santoso telah memperbaiki form pendaftaran dan mengajukan ulang.</p>
                    <span class="text-xs text-slate-400 mt-2 block">2 jam yang lalu</span>
                </div>
                <a href="{{ route('admin.pendaftar.index') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700 bg-white border border-blue-200 px-3 py-1.5 rounded-lg shadow-sm">
                    Review Sekarang
                </a>
            </li>

            <li class="p-4 hover:bg-slate-50 transition flex items-start gap-4">
                <div class="bg-emerald-100 text-emerald-600 p-2 rounded-lg shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-sm font-semibold text-slate-800">Pendaftar Baru</h4>
                    <p class="text-sm text-slate-600 mt-0.5">Siti Aminah baru saja mengirimkan berkas pendaftaran LPDP.</p>
                    <span class="text-xs text-slate-400 mt-2 block">1 hari yang lalu</span>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection --}}