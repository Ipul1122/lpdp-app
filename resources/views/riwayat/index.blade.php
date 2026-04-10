@extends('layouts.app')

@section('title', 'Riwayat Pendaftaran')

@section('content')
<div class="max-w-6xl mx-auto">

    <nav class="flex items-center text-sm font-medium text-slate-500 mb-8">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        <a href="{{ route('dashboard') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
        <svg class="w-4 h-4 mx-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-800">Riwayat Pendaftaran</span>
    </nav>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">Riwayat</h1>
        <p class="text-slate-500">Riwayat pendaftaran dan pembatalan beasiswa Anda</p>
    </div>

    <div class="flex items-center space-x-8 border-b border-slate-200 mb-6">
        <button class="flex items-center gap-2 pb-4 text-orange-500 font-semibold border-b-2 border-orange-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Riwayat Pendaftaran
        </button>
        <button class="flex items-center gap-2 pb-4 text-slate-500 font-medium hover:text-slate-700 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Riwayat Pembatalan
        </button>
    </div>

    <div class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden min-h-[400px] flex flex-col">
        
        <div class="grid grid-cols-5 gap-4 p-6 bg-slate-50 border-b border-slate-100 text-sm font-semibold text-slate-600">
            <div>Kode Registrasi</div>
            <div>Program Beasiswa</div>
            <div>Waktu Pendaftaran</div>
            <div>Waktu Submit</div>
            <div>Status</div>
        </div>

       <div class="flex-1 flex flex-col">
            
            @if($riwayatProfil)
                <div class="grid grid-cols-5 gap-4 p-6 border-b border-slate-50 items-center text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                    <div class="font-bold text-slate-800">
                        REG-{{ str_pad($riwayatProfil->id, 5, '0', STR_PAD_LEFT) }}
                    </div>
                    
                    <div class="capitalize">
                        Beasiswa {{ $riwayatProfil->program_beasiswa ?? 'Belum Memilih' }}
                    </div>
                    
                    <div class="text-slate-500">-</div>
                    
                    <div>{{ $riwayatProfil->created_at->format('d M Y, H:i') }} WIB</div>
                    
                    <div>
                        @php
                            $statusColor = match($riwayatProfil->status) {
                                'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                'diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'diterima' => 'bg-green-100 text-green-700 border-green-200',
                                'ditolak'  => 'bg-red-100 text-red-700 border-red-200',
                                default    => 'bg-slate-100 text-slate-700 border-slate-200',
                            };
                        @endphp

                        <span class="{{ $statusColor }} px-3 py-1 rounded-full text-xs font-bold border capitalize">
                            {{ $riwayatProfil->status }}
                        </span>
                    </div>
                </div>
            @else
                <div class="flex-1 flex flex-col items-center justify-center p-12 text-slate-300">
                    <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-slate-400 font-medium text-lg">Belum ada riwayat pendaftaran</p>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection