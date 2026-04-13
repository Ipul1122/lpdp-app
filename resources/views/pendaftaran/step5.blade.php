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
        
        <input type="file" id="file_input" name="file_rekomendasi" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.jpg,.jpeg,.png" {{ $rekomendasi?->file_rekomendasi ? '' : 'required' }}>
        
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



    document.getElementById('file_input').addEventListener('change', function(e) {
        var displayBox = document.getElementById('drop_zone');
        var nameDisplay = document.getElementById('file_name_display');
        var defaultText = document.getElementById('default_text');
        
        if (e.target.files.length > 0) {
            var fileName = e.target.files[0].name;
            var fileSize = (e.target.files[0].size / 1024).toFixed(2); // Convert to KB
            
            // Change box appearance to indicate file is ready
            displayBox.classList.remove('border-slate-300', 'hover:bg-slate-50');
            displayBox.classList.add('border-orange-300', 'bg-orange-50');
            
            // Hide default text and show file name
            defaultText.style.display = 'none';
            nameDisplay.style.display = 'block';
            nameDisplay.innerHTML = '✓ File Dipilih: <strong>' + fileName + '</strong> (' + fileSize + ' KB)';
        } else {
            // Reset if no file selected
            displayBox.classList.remove('border-orange-300', 'bg-orange-50');
            displayBox.classList.add('border-slate-300', 'hover:bg-slate-50');
            defaultText.style.display = 'block';
            nameDisplay.style.display = 'none';
        }
    });
</script>
@endsection