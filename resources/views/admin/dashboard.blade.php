@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-6xl mx-auto pb-12 space-y-8">
    
    <!-- Header Section / Welcome Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 rounded-3xl p-8 shadow-lg border border-slate-800 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(249,115,22,0.1),transparent_50%)]"></div>
        <div class="relative z-10 space-y-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-orange-500/10 text-orange-400 border border-orange-500/20">
                <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                Sistem Aktif
            </span>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Selamat Datang Kembali, {{ Auth::guard('admin')->user()->name }}! 👋</h1>
            <p class="text-slate-300 text-sm leading-relaxed max-w-xl">
                Pantau seluruh statistik pendaftar beasiswa dan kelola berkas pelamar beasiswa secara real-time.
            </p>
        </div>
        <div class="relative z-10 bg-white/5 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/10 text-right shrink-0">
            <span class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Tanggal Hari Ini</span>
            <span class="text-lg font-bold text-white block mt-1">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </span>
        </div>
    </div>
    
    <!-- Quick Statistics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Pending (Baru) Card -->
        <a href="{{ route('admin.pendaftar.index', ['filter' => 'baru']) }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-amber-400"></div>
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-amber-50 rounded-xl text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-slate-800 group-hover:text-white transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Menunggu (Baru)</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $totalPending }}</h3>
            </div>
        </a>

        <!-- Revisi Card -->
        <a href="{{ route('admin.pendaftar.index', ['filter' => 'pengajuan_ulang']) }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-blue-500"></div>
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18.5"></path></svg>
                </div>
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-slate-800 group-hover:text-white transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Butuh Revisi</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $totalRevisi }}</h3>
            </div>
        </a>

        <!-- Approved Card -->
        <a href="{{ route('admin.pendaftar.index', ['filter' => 'disetujui']) }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-green-500"></div>
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-green-50 rounded-xl text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-slate-800 group-hover:text-white transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Diterima / Lulus</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $totalDiterima }}</h3>
            </div>
        </a>

        <!-- Rejected Card -->
        <a href="{{ route('admin.pendaftar.index', ['filter' => 'ditolak']) }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-red-500"></div>
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-red-50 rounded-xl text-red-600 group-hover:bg-red-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-slate-800 group-hover:text-white transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Ditolak</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $totalDitolak }}</h3>
            </div>
        </a>
    </div>

    <!-- Total Overall Wide Card -->
    <a href="{{ route('admin.pendaftar.index') }}" class="group bg-gradient-to-r from-slate-800 to-slate-900 p-8 rounded-3xl shadow-sm border border-slate-800 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between relative overflow-hidden">
        <div class="absolute -right-6 -top-6 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
        <div class="relative z-10">
            <p class="text-slate-300 text-xs font-bold uppercase tracking-wider mb-2">Total Pendaftar Keseluruhan</p>
            <div class="flex items-baseline gap-3">
                <h3 class="text-5xl font-black text-white">{{ $totalPendaftar }}</h3>
                <span class="text-slate-400 font-semibold text-sm">Pelamar Terdaftar</span>
            </div>
        </div>
        <div class="relative z-10 w-14 h-14 rounded-full bg-white/10 flex items-center justify-center text-white group-hover:bg-white group-hover:text-slate-800 transition-colors mt-6 md:mt-0 shadow-inner">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
    </a>

    <!-- Detail Statistics & Recent Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Side: Distributions Analysis -->
        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Analisis Distribusi Pendaftar</h3>
                    <p class="text-xs text-slate-400 mt-1">Perbandingan porsi pendaftar berdasarkan kategori pendaftaran dan program beasiswa.</p>
                </div>
                
                <hr class="border-slate-100">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Chart 1: Kategori -->
                    <div class="flex flex-col items-center">
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Jalur / Kategori Pendaftaran</h4>
                        <div class="w-full max-w-[180px] aspect-square relative">
                            <canvas id="kategoriChart"></canvas>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 mt-4 text-center">
                            <div class="p-2 rounded-xl bg-slate-50 border border-slate-100/80">
                                <span class="block text-[9px] font-bold text-slate-400 uppercase">Usulan Unit</span>
                                <span class="text-sm font-black text-slate-800">{{ $totalUsulanUnit }}</span>
                            </div>
                            <div class="p-2 rounded-xl bg-slate-50 border border-slate-100/80">
                                <span class="block text-[9px] font-bold text-slate-400 uppercase">Talenta</span>
                                <span class="text-sm font-black text-slate-800">{{ $totalManajemenTalenta }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Chart 2: Beasiswa -->
                    <div class="flex flex-col items-center">
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Jenjang Program Beasiswa</h4>
                        <div class="w-full max-w-[180px] aspect-square relative">
                            <canvas id="beasiswaChart"></canvas>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-2 mt-4 text-center">
                            <div class="p-2 rounded-xl bg-slate-50 border border-slate-100/80">
                                <span class="block text-[9px] font-bold text-slate-400 uppercase">Magister (S2)</span>
                                <span class="text-sm font-black text-slate-800">{{ $totalMagister }}</span>
                            </div>
                            <div class="p-2 rounded-xl bg-slate-50 border border-slate-100/80">
                                <span class="block text-[9px] font-bold text-slate-400 uppercase">Spesialis</span>
                                <span class="text-sm font-black text-slate-800">{{ $totalDokter }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Workflow Guide -->
            <div class="bg-gradient-to-r from-slate-50 to-slate-100/50 p-6 rounded-3xl border border-slate-100 shadow-sm space-y-4">
                <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Langkah Evaluasi Berkas</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-2xl border border-slate-200/60 shadow-sm flex items-start gap-3">
                        <span class="w-6 h-6 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold shrink-0">1</span>
                        <div>
                            <span class="block font-bold text-slate-800 text-xs">Cek Keaslian Berkas</span>
                            <span class="text-[11px] text-slate-500 mt-1 block">Periksa unggahan KTP, LoA Universitas, KHS/IPK, Rekomendasi, dan Komitmen.</span>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-slate-200/60 shadow-sm flex items-start gap-3">
                        <span class="w-6 h-6 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold shrink-0">2</span>
                        <div>
                            <span class="block font-bold text-slate-800 text-xs">Tentukan Kelayakan</span>
                            <span class="text-[11px] text-slate-500 mt-1 block">Pastikan data pengusul unit kerja atau data talent relevan dengan kriteria TUBEL.</span>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border border-slate-200/60 shadow-sm flex items-start gap-3">
                        <span class="w-6 h-6 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold shrink-0">3</span>
                        <div>
                            <span class="block font-bold text-slate-800 text-xs">Aksi & Notifikasi WA</span>
                            <span class="text-[11px] text-slate-500 mt-1 block">Luluskan pelamar beasiswa atau kembalikan (tolak) berkas dengan catatan revisi yang jelas.</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Side: Recent Applicants -->
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col h-full">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Pendaftar Terbaru</h3>
                        <p class="text-xs text-slate-400 mt-0.5">5 pendaftaran terakhir yang masuk.</p>
                    </div>
                    <a href="{{ route('admin.pendaftar.index') }}" class="text-xs font-bold text-orange-500 hover:text-orange-600 hover:underline shrink-0">Lihat Semua</a>
                </div>

                <div class="divide-y divide-slate-100 flex-1 flex flex-col justify-start">
                    @forelse($recentPendaftar as $p)
                        <div class="py-4 hover:bg-slate-50/50 transition duration-150 rounded-xl px-2 -mx-2 flex gap-3.5 items-start">
                            <!-- Avatar / Initial -->
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center font-bold text-slate-600 text-sm shrink-0">
                                {{ strtoupper(substr($p->nama, 0, 1)) }}
                            </div>
                            
                            <!-- Information -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <h4 class="font-bold text-slate-800 text-sm truncate" title="{{ $p->nama }}">{{ $p->nama }}</h4>
                                    
                                    @php
                                        $badgeColor = match($p->status) {
                                            'pending' => 'bg-amber-50 text-amber-600 border-amber-200/50',
                                            'diterima' => 'bg-green-50 text-green-600 border-green-200/50',
                                            'ditolak'  => 'bg-red-50 text-red-600 border-red-200/50',
                                            default    => 'bg-slate-50 text-slate-600 border-slate-200/50',
                                        };
                                    @endphp
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border capitalize shrink-0 {{ $badgeColor }}">
                                        {{ $p->status }}
                                    </span>
                                </div>

                                <p class="text-xs text-slate-500 mt-0.5 truncate">
                                    {{ $p->universitas->nama_universitas ?? 'Universitas belum diisi' }}
                                </p>

                                <div class="flex items-center gap-1.5 mt-2">
                                    <span class="px-1.5 py-0.5 text-[9px] font-semibold text-slate-500 bg-slate-100 rounded capitalize">
                                        Beasiswa {{ $p->program_beasiswa }}
                                    </span>
                                    @if($p->kategori)
                                        <span class="px-1.5 py-0.5 text-[9px] font-semibold text-orange-600 bg-orange-50 rounded">
                                            {{ $p->kategori }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center flex flex-col items-center justify-center flex-1">
                            <svg class="w-12 h-12 text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <p class="text-xs font-semibold text-slate-400">Belum ada data pendaftar masuk</p>
                        </div>
                    @endforelse
                </div>

                @if($recentPendaftar->isNotEmpty())
                    <div class="pt-4 border-t border-slate-100 mt-auto">
                        <a href="{{ route('admin.pendaftar.index', ['filter' => 'baru']) }}" class="w-full py-2.5 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold text-xs rounded-xl transition flex items-center justify-center gap-2 border border-slate-200/50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            Tinjau Berkas Baru
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Kategori Chart
        const ctxKategori = document.getElementById('kategoriChart').getContext('2d');
        new Chart(ctxKategori, {
            type: 'doughnut',
            data: {
                labels: ['Usulan Unit', 'Manajemen Talenta'],
                datasets: [{
                    data: [{{ $totalUsulanUnit }}, {{ $totalManajemenTalenta }}],
                    backgroundColor: ['#f97316', '#6366f1'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '65%'
            }
        });

        // 2. Beasiswa Chart
        const ctxBeasiswa = document.getElementById('beasiswaChart').getContext('2d');
        new Chart(ctxBeasiswa, {
            type: 'doughnut',
            data: {
                labels: ['Magister (S2)', 'Dokter Spesialis'],
                datasets: [{
                    data: [{{ $totalMagister }}, {{ $totalDokter }}],
                    backgroundColor: ['#10b981', '#06b6d4'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '65%'
            }
        });
    });
</script>
@endsection