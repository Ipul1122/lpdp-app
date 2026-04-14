@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-5xl mx-auto pb-10">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">Ikhtisar Pendaftaran</h1>
        <p class="text-slate-500 text-sm mt-1">Pantau statistik dan kelola status pendaftar beasiswa secara real-time.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <a href="{{ route('admin.pendaftar.index', ['filter' => 'baru']) }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 border-l-4 border-l-amber-400 hover:shadow-md hover:-translate-y-1 transition-all duration-300 block">
            <p class="text-slate-500 text-sm font-semibold mb-2 group-hover:text-amber-600 transition-colors">Menunggu (Baru)</p>
            <div class="flex items-end justify-between">
                <h3 class="text-4xl font-black text-amber-500">{{ $totalPending }}</h3>
                <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.pendaftar.index', ['filter' => 'pengajuan_ulang']) }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 border-l-4 border-l-blue-500 hover:shadow-md hover:-translate-y-1 transition-all duration-300 block">
            <p class="text-slate-500 text-sm font-semibold mb-2 group-hover:text-blue-600 transition-colors">Butuh Revisi</p>
            <div class="flex items-end justify-between">
                <h3 class="text-4xl font-black text-blue-600">{{ $totalRevisi ?? 0 }}</h3>
                <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </a>


        <a href="{{ route('admin.pendaftar.index', ['filter' => 'disetujui']) }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 border-l-4 border-l-green-500 hover:shadow-md hover:-translate-y-1 transition-all duration-300 block">
            <p class="text-slate-500 text-sm font-semibold mb-2 group-hover:text-green-600 transition-colors">Diterima / Lulus</p>
            <div class="flex items-end justify-between">
                <h3 class="text-4xl font-black text-green-500">{{ $totalDiterima }}</h3>
                <div class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-green-500 group-hover:bg-green-500 group-hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.pendaftar.index', ['filter' => 'ditolak']) }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 border-l-4 border-l-red-500 hover:shadow-md hover:-translate-y-1 transition-all duration-300 block">
            <p class="text-slate-500 text-sm font-semibold mb-2 group-hover:text-red-600 transition-colors">Ditolak</p>
            <div class="flex items-end justify-between">
                <h3 class="text-4xl font-black text-red-500">{{ $totalDitolak ?? 0 }}</h3>
                <div class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </a>


        <a href="{{ route('admin.pendaftar.index') }}" class="md:col-span-2 group bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-800 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between relative overflow-hidden">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
            
            <div class="relative z-10">
                <p class="text-slate-300 text-sm font-semibold mb-1 group-hover:text-white transition-colors">Total Pendaftar Keseluruhan</p>
                <div class="flex items-baseline gap-3">
                    <h3 class="text-5xl font-black text-white">{{ $totalPendaftar }}</h3>
                    <span class="text-slate-400 font-medium text-sm">Pendaftar</span>
                </div>
            </div>
            
            <div class="relative z-10 w-14 h-14 rounded-full bg-white/10 flex items-center justify-center text-white group-hover:bg-white group-hover:text-slate-800 transition-colors mt-6 md:mt-0 shadow-inner">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </a>

    </div>
</div>
@endsection