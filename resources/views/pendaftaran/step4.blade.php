@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 4')

@section('content')
<div class="max-w-5xl mx-auto mb-10" x-data="{ showForm: {{ ($rekomendasi && ($rekomendasi->kategori || $rekomendasi->nama_perekomendasi || $rekomendasi->file_rekomendasi)) ? 'true' : 'false' }} }">
    
    @include('pendaftaran.components.stepper', ['step' => 4])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <div class="mb-6 pb-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-800">Surat Rekomendasi <span class="text-xs text-slate-400 font-normal">(Opsional)</span></h3>
            <p class="text-sm text-slate-500 mt-1">Sertakan satu surat rekomendasi dari tokoh, pimpinan, atau akademisi yang mengenal Anda dengan baik (seluruh isian bersifat opsional).</p>
        </div>

        <!-- Pilihan Surat Rekomendasi -->
        <div class="mb-8 p-4 bg-slate-50 rounded-xl border border-slate-100">
            <label class="block text-sm font-semibold text-slate-700 mb-3 text-center">Apakah Anda memiliki Surat Rekomendasi untuk disertakan?</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-2xl mx-auto">
                <!-- Pilihan Ya -->
                <button type="button" 
                        @click="showForm = true"
                        :class="showForm ? 'border-orange-500 bg-orange-50/30 text-orange-700 ring-2 ring-orange-500/20' : 'border-slate-200 hover:border-slate-300 text-slate-600 bg-white'"
                        class="flex items-center gap-3.5 p-3.5 rounded-xl border text-left transition cursor-pointer outline-none">
                    <div :class="showForm ? 'bg-orange-500 text-white' : 'bg-slate-100 text-slate-500'" 
                         class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-xs sm:text-sm">Ya, Ada Surat Rekomendasi</p>
                        <p class="text-[11px] sm:text-xs opacity-75 mt-0.5">Isi formulir dan unggah surat rekomendasi</p>
                    </div>
                </button>

                <!-- Pilihan Tidak -->
                <button type="button" 
                        @click="showForm = false"
                        :class="!showForm ? 'border-orange-500 bg-orange-50/30 text-orange-700 ring-2 ring-orange-500/20' : 'border-slate-200 hover:border-slate-300 text-slate-600 bg-white'"
                        class="flex items-center gap-3.5 p-3.5 rounded-xl border text-left transition cursor-pointer outline-none">
                    <div :class="!showForm ? 'bg-orange-500 text-white' : 'bg-slate-100 text-slate-500'" 
                         class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-xs sm:text-sm">Tidak Ada, Lewati Langkah Ini</p>
                        <p class="text-[11px] sm:text-xs opacity-75 mt-0.5">Lanjut langsung ke tahap berikutnya</p>
                    </div>
                </button>
            </div>
        </div>

        <form id="step-form" action="{{ route('pendaftaran.step4.store') }}" method="POST" enctype="multipart/form-data" x-show="showForm" x-collapse>
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Judul (Kategori) Rekomendasi <span class="text-xs text-slate-400 font-normal">(Opsional)</span></label>
                    <input type="text" name="kategori" value="{{ old('kategori', $rekomendasi?->kategori) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Rekomendasi Akademik / Profesional / Atasan">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Perekomendasi (Tokoh/Akademisi) <span class="text-xs text-slate-400 font-normal">(Opsional)</span></label>
                    <input type="text" name="nama_perekomendasi" value="{{ old('nama_perekomendasi', $rekomendasi?->nama_perekomendasi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Prof. Dr. Budi Santoso, M.Si.">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Instansi / Asal Perekomendasi <span class="text-xs text-slate-400 font-normal">(Opsional)</span></label>
                    <input type="text" name="instansi_perekomendasi" value="{{ old('instansi_perekomendasi', $rekomendasi?->instansi_perekomendasi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Universitas Indonesia">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Jabatan <span class="text-xs text-slate-400 font-normal">(Opsional)</span></label>
                    <input type="text" name="jabatan_perekomendasi" value="{{ old('jabatan_perekomendasi', $rekomendasi?->jabatan_perekomendasi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Dekan Fakultas Ilmu Komputer">
                </div>

                <div class="md:col-span-2 mt-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Surat Rekomendasi <span class="text-xs text-slate-400 font-normal">(Opsional)</span></label>
                    
                    @if($rekomendasi?->file_rekomendasi)
                        <div class="mb-3 p-4 bg-indigo-50 border border-indigo-100 rounded-xl flex items-center justify-between shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white text-indigo-500 rounded-lg flex items-center justify-center border border-indigo-100 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">Dokumen Telah Tersimpan</p>
                                    <a href="{{ asset('storage/' . $rekomendasi->file_rekomendasi) }}" target="_blank" class="text-xs text-indigo-600 font-semibold hover:underline flex items-center gap-1">
                                        Lihat Dokumen Saat Ini
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </div>
                            </div>
                            <div class="hidden sm:inline-flex items-center gap-1 bg-green-100 text-green-700 px-2.5 py-1 rounded-md border border-green-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-xs font-bold">Terunggah</span>
                            </div>
                        </div>
                    @endif

                    <div id="drop_zone" class="border-2 border-dashed border-slate-300 rounded-xl p-8 text-center hover:bg-slate-50 transition cursor-pointer relative group">
                        <input type="file" id="file_input" name="file_rekomendasi" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.jpg,.jpeg,.png">
                        
                        <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        </div>
                        
                        <p class="text-sm text-slate-600 font-medium" id="default_text">
                            {{ $rekomendasi?->file_rekomendasi ? 'Klik atau seret untuk mengganti dokumen' : 'Klik untuk mengunggah atau seret dokumen ke sini' }}
                        </p>
                        <p id="file_name_display" class="text-sm font-semibold text-orange-600 mt-2" style="display: none;"></p>
                        <p id="file_info_display" class="text-xs text-slate-400 mt-1">Format yang didukung: PDF, JPG, PNG (Maksimal 5MB)</p>
                    </div>
                </div>

            </div>

            <div class="flex justify-between mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('pendaftaran.step3') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-orange-200 flex items-center gap-2">
                    Simpan & Lanjut Tahap 5 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>

        <!-- Skip Content -->
        <div x-show="!showForm" x-collapse class="bg-slate-50 border border-slate-200 rounded-xl p-6 text-center max-w-xl mx-auto my-4 shadow-sm">
            <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h4 class="font-bold text-slate-800 text-sm">Surat Rekomendasi Bersifat Opsional</h4>
            <p class="text-xs text-slate-500 mt-2 mb-6 leading-relaxed">
                Anda memilih untuk melewati pengisian Surat Rekomendasi. Langkah ini bersifat opsional dan Anda dapat langsung melanjutkannya ke tahap berikutnya tanpa memengaruhi kelayakan pendaftaran.
            </p>
            
            <div class="flex justify-center gap-3">
                <a href="{{ route('pendaftaran.step3') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-2.5 px-5 rounded-xl transition text-xs flex items-center gap-1.5 border border-slate-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <a href="{{ route('pendaftaran.step5') }}" 
                   class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2.5 px-6 rounded-xl transition shadow-md shadow-orange-100 text-xs flex items-center gap-1.5">
                    Lewati & Lanjut Tahap 5 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('step-form');
    });

    document.getElementById('file_input').addEventListener('change', function(e) {
        var displayBox = document.getElementById('drop_zone');
        var nameDisplay = document.getElementById('file_name_display');
        var defaultText = document.getElementById('default_text');
        
        if (e.target.files.length > 0) {
            var fileName = e.target.files[0].name;
            var fileSize = (e.target.files[0].size / 1024).toFixed(2); // Convert to KB
            
            displayBox.classList.remove('border-slate-300', 'hover:bg-slate-50');
            displayBox.classList.add('border-orange-300', 'bg-orange-50');
            
            defaultText.style.display = 'none';
            nameDisplay.style.display = 'block';
            nameDisplay.innerHTML = '✓ File Dipilih: <strong>' + fileName + '</strong> (' + fileSize + ' KB)';
        } else {
            displayBox.classList.remove('border-orange-300', 'bg-orange-50');
            displayBox.classList.add('border-slate-300', 'hover:bg-slate-50');
            defaultText.style.display = 'block';
            nameDisplay.style.display = 'none';
        }
    });
</script>
@endsection