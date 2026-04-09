@extends('layouts.app')

@section('title', 'Pendaftaran')

@section('content')
<div class="max-w-5xl mx-auto">
    
    <nav class="flex items-center text-sm font-medium text-slate-500 mb-8">
        <a href="{{ route('dashboard') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
        <svg class="w-4 h-4 mx-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-800">Pendaftaran</span>
    </nav>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-10 md:p-16 flex flex-col items-center text-center">
        
        <div class="w-64 h-64 mb-6 relative">
            <img src="https://api.dicebear.com/7.x/bottts/svg?seed=lpdp-empty&backgroundColor=transparent" alt="Ilustrasi Kosong" class="w-full h-full object-contain drop-shadow-xl">
        </div>

        <div class="inline-flex items-center gap-2 bg-orange-50 text-orange-600 px-4 py-1.5 rounded-full text-xs font-bold mb-6 border border-orange-100">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Belum Ada Data
        </div>

        <h2 class="text-3xl font-extrabold text-slate-800 mb-4">Belum Ada Pendaftaran</h2>
        <p class="text-slate-500 max-w-xl mx-auto mb-10 leading-relaxed">
            Saat ini Anda belum mendaftar beasiswa. Mulai perjalanan pendidikan Anda dengan mendaftar program beasiswa yang tersedia.
        </p>

        <a href="{{ route('pendaftaran.create') }}" class="inline-flex items-center gap-3 bg-orange-600 hover:bg-orange-700 text-white font-bold py-3.5 px-8 rounded-full shadow-lg shadow-orange-200 transition-transform transform hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
            Mulai Pendaftaran Baru
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        
        <div class="bg-green-50 border border-green-100 rounded-2xl p-6">
            <div class="w-8 h-8 bg-green-200 text-green-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-slate-800 font-bold mb-2">Lengkapi Profil</h3>
            <p class="text-sm text-slate-600 leading-relaxed">Pastikan data profil Anda sudah lengkap sebelum mendaftar.</p>
        </div>

        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6">
            <div class="w-8 h-8 bg-blue-200 text-blue-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h3 class="text-slate-800 font-bold mb-2">Siapkan Dokumen</h3>
            <p class="text-sm text-slate-600 leading-relaxed">Persiapkan dokumen pendukung seperti CV, ijazah, dan transkrip.</p>
        </div>

        <div class="bg-orange-50 border border-orange-100 rounded-2xl p-6">
            <div class="w-8 h-8 bg-orange-200 text-orange-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
            </div>
            <h3 class="text-slate-800 font-bold mb-2">Pilih Program</h3>
            <p class="text-sm text-slate-600 leading-relaxed">Jelajahi program beasiswa yang sesuai dengan tujuan pendidikan Anda.</p>
        </div>

    </div>

</div>
@endsection