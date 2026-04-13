@extends('layouts.app')
@section('title', 'Pendaftaran Selesai')

@section('content')
<div class="max-w-2xl mx-auto mt-10 md:mt-20 px-4">
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 md:p-12 text-center">
        
        <div class="w-24 h-24 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner border border-green-100">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        
        <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-4">{{ $user->name }}, Anda Sudah Mengisi Data!</h2>
        
        <p class="text-slate-500 mb-10 leading-relaxed text-sm md:text-base">
            Terima kasih, seluruh berkas pendaftaran Anda telah berhasil dikirim ke sistem dan saat ini sedang dalam antrean untuk di-<i>review</i> oleh Administrator. Anda tidak perlu mengisi formulir pendaftaran dari awal lagi.
        </p>

        <a href="{{ route('riwayat.index') }}" class="inline-flex items-center gap-3 bg-slate-800 hover:bg-slate-900 text-white font-bold py-4 px-8 rounded-xl transition shadow-lg shadow-slate-200 w-full sm:w-auto justify-center">
            <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            Cek Riwayat Pendaftaran
        </a>
        
    </div>
</div>
@endsection