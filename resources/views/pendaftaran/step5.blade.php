@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 5')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 5])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <div class="mb-6 pb-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-800">Surat Rekomendasi</h3>
            <p class="text-sm text-slate-500 mt-1">Sertakan satu surat rekomendasi dari tokoh, pimpinan, atau akademisi yang mengenal Anda dengan baik.</p>
        </div>

        <form id="step-form" action="{{ route('pendaftaran.step5.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Perekomendasi (Tokoh/Akademisi)</label>
                    <input type="text" name="nama_perekomendasi" value="{{ old('nama_perekomendasi', $rekomendasi?->nama_perekomendasi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Prof. Dr. Budi Santoso, M.Si.">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Instansi / Asal Perekomendasi</label>
                    <input type="text" name="instansi_perekomendasi" value="{{ old('instansi_perekomendasi', $rekomendasi?->instansi_perekomendasi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Universitas Indonesia">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Jabatan</label>
                    <input type="text" name="jabatan_perekomendasi" value="{{ old('jabatan_perekomendasi', $rekomendasi?->jabatan_perekomendasi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Dekan Fakultas Ilmu Komputer">
                </div>

                <div class="md:col-span-2 mt-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Surat Rekomendasi</label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-8 text-center hover:bg-slate-50 transition cursor-pointer relative group">
                        <input type="file" name="file_rekomendasi" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        </div>
                        <p class="text-sm text-slate-600 font-medium">Klik untuk mengunggah atau seret dokumen ke sini</p>
                        <p class="text-xs text-slate-400 mt-1">Format yang didukung: PDF, JPG, PNG (Maksimal 5MB)</p>
                        
                        @if($rekomendasi?->file_rekomendasi)
                            <div class="mt-4 inline-flex items-center gap-2 bg-green-50 text-green-700 px-3 py-1.5 rounded-lg border border-green-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-xs font-semibold">Surat Rekomendasi sudah terunggah</span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="flex justify-between mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('pendaftaran.step4') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-orange-200 flex items-center gap-2">
                    Simpan & Lanjut Tahap 6 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('step-form');
        const storageKey = 'draft_step_{{ $step }}_user_{{ Auth::id() }}';

        // 1. Kembalikan data
        const savedData = localStorage.getItem(storageKey);
        if (savedData) {
            const dataObj = JSON.parse(savedData);
            for (const key in dataObj) {
                const input = form.elements[key];
                if (input && input.type !== 'file' && !input.value) {
                    input.value = dataObj[key];
                }
            }
        }

        // 2. Simpan draf
        form.addEventListener('input', function(e) {
            if(e.target.type !== 'file' && e.target.name) {
                const formData = new FormData(form);
                const obj = {};
                formData.forEach((value, key) => {
                    if (key !== '_token' && typeof value === 'string') {
                        obj[key] = value;
                    }
                });
                localStorage.setItem(storageKey, JSON.stringify(obj));
            }
        });

        // 3. Bersihkan draf saat submit
        form.addEventListener('submit', function() {
            localStorage.removeItem(storageKey);
        });
    });
</script>
@endsection