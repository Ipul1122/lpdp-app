@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 7 (Ringkasan)')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 7])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        
        <div class="text-center mb-10">
            <h3 class="text-2xl font-bold text-slate-800">Ringkasan Pendaftaran</h3>
            <p class="text-slate-500 mt-2">Mohon periksa kembali data Anda. Jika ada yang salah, tekan tombol <b>Edit</b> di setiap bagian.</p>
        </div>

        <div class="space-y-6">
            
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 relative">
                <div class="flex justify-between items-center mb-4 border-b border-slate-200 pb-3">
                    <h4 class="font-bold text-slate-700 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs">1</span> Data Pribadi & KTP
                    </h4>
                    <a href="{{ route('pendaftaran.step1') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition">Edit</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div><span class="block text-slate-500 text-xs mb-1">Nama</span><p class="font-semibold text-slate-800">{{ $userProfile?->nama ?? '-' }}</p></div>
                    <div><span class="block text-slate-500 text-xs mb-1">NIK</span><p class="font-semibold text-slate-800">{{ $userProfile?->nik ?? '-' }}</p></div>
                    <div><span class="block text-slate-500 text-xs mb-1">Program</span><p class="font-semibold text-slate-800 capitalize">{{ $userProfile?->program_beasiswa ?? '-' }}</p></div>
                    <div><span class="block text-slate-500 text-xs mb-1">No WhatsApp</span><p class="font-semibold text-slate-800">{{ $userProfile?->no_telp ?? '-' }}</p></div>
                </div>
            </div>

            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 relative">
                <div class="flex justify-between items-center mb-4 border-b border-slate-200 pb-3">
                    <h4 class="font-bold text-slate-700 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs">2</span> Industri / Pendukung
                    </h4>
                    <a href="{{ route('pendaftaran.step2') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition">Edit</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div><span class="block text-slate-500 text-xs mb-1">Nama Instansi</span><p class="font-semibold text-slate-800">{{ $industri?->nama_instansi ?? 'Tidak diisi' }}</p></div>
                    <div><span class="block text-slate-500 text-xs mb-1">Pekerjaan</span><p class="font-semibold text-slate-800">{{ $industri?->pekerjaan ?? 'Tidak diisi' }}</p></div>
                    <div class="col-span-2"><span class="block text-slate-500 text-xs mb-1">Status Kepegawaian</span><p class="font-semibold text-slate-800">{{ $industri?->status_kepegawaian ?? '-' }}</p></div>
                </div>
            </div>

            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 relative">
                <div class="flex justify-between items-center mb-4 border-b border-slate-200 pb-3">
                    <h4 class="font-bold text-slate-700 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs">3</span> Universitas Tujuan
                    </h4>
                    <a href="{{ route('pendaftaran.step3') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition">Edit</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div class="col-span-2"><span class="block text-slate-500 text-xs mb-1">Nama Universitas</span><p class="font-semibold text-slate-800">{{ $universitas?->nama_universitas ?? 'Tidak diisi' }}</p></div>
                    <div class="col-span-2"><span class="block text-slate-500 text-xs mb-1">Program Studi</span><p class="font-semibold text-slate-800">{{ $universitas?->program_studi ?? 'Tidak diisi' }}</p></div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="font-bold text-slate-700 text-sm">Tahap 4: Profil</h4>
                        <a href="{{ route('pendaftaran.step4') }}" class="text-xs font-semibold text-blue-600">Edit</a>
                    </div>
                    @if($biodata?->deskripsi_diri)
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-bold"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Data Terisi</span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded bg-red-100 text-red-700 text-xs font-bold">X Kosong</span>
                    @endif
                </div>

                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="font-bold text-slate-700 text-sm">Tahap 5: Rekomendasi</h4>
                        <a href="{{ route('pendaftaran.step5') }}" class="text-xs font-semibold text-blue-600">Edit</a>
                    </div>
                    @if($rekomendasi?->nama_perekomendasi)
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-bold"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Terisi ({{ $rekomendasi->nama_perekomendasi }})</span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded bg-slate-200 text-slate-600 text-xs font-bold">Kosong/Opsional</span>
                    @endif
                </div>

                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="font-bold text-slate-700 text-sm">Tahap 6: Essay</h4>
                        <a href="{{ route('pendaftaran.step6') }}" class="text-xs font-semibold text-blue-600">Edit</a>
                    </div>
                    @if($essay?->essay_kontribusi)
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-bold"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Essay Tersimpan</span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded bg-red-100 text-red-700 text-xs font-bold">X Belum Ditulis</span>
                    @endif
                </div>
            </div>

        </div>

        <form id="final-form" action="{{ route('pendaftaran.step7.store') }}" method="POST" class="mt-10 pt-8 border-t border-slate-200">
            @csrf

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mb-8 flex items-start gap-4">
                <div class="text-blue-500 mt-0.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="font-bold text-blue-800 text-sm">Pernyataan Kebenaran Data</h4>
                    <p class="text-xs text-blue-600 mt-1 leading-relaxed">Dengan menekan tombol di bawah ini, saya menyatakan bahwa seluruh data dan dokumen yang saya lampirkan adalah benar dan dapat dipertanggungjawabkan. Saya siap menerima sanksi jika di kemudian hari ditemukan kecurangan.</p>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('pendaftaran.step6') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-10 rounded-xl transition shadow-xl shadow-green-200 flex items-center gap-2 text-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Kirim Pendaftaran Final
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('final-form');
        
        form.addEventListener('submit', function() {
            // Hapus semua draft milik user ini dari tahapan 1 sampai 6
            const userId = '{{ Auth::id() }}';
            for (let i = 1; i <= 6; i++) {
                localStorage.removeItem('draft_step_' + i + '_user_' + userId);
            }
        });
    });
</script>
@endsection