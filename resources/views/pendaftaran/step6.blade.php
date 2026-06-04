@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 6 (Surat Komitmen)')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 6])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <form id="step-form" action="{{ route('pendaftaran.step6.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-8">
                
                {{-- Deskripsi Langkah --}}
                <div class="border-b border-slate-100 pb-5">
                    <h3 class="text-xl font-bold text-slate-800">Dokumen Surat Komitmen</h3>
                    <p class="text-sm text-slate-500 mt-1">Harap ikuti instruksi di bawah ini untuk melengkapi berkas pendaftaran Anda.</p>
                </div>

                {{-- Grid Alur --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {{-- Langkah 1: Download --}}
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 flex flex-col justify-between">
                        <div>
                            <span class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-sm font-bold mb-3">1</span>
                            <h4 class="font-bold text-slate-800 text-sm">Unduh Template</h4>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">Unduh formulir Surat Komitmen resmi beasiswa yang telah disediakan di bawah ini.</p>
                        </div>
                        
                        <div class="mt-5">
                            <a href="{{ asset('storage/Surat_Komitmen_Beasiswa_Setjen_DPR_RI.pdf') }}" download class="w-full py-2.5 px-4 bg-orange-500 hover:bg-orange-600 text-white rounded-xl text-xs font-bold transition flex items-center justify-center gap-2 shadow-sm shadow-orange-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Unduh Surat Komitmen
                            </a>
                        </div>
                    </div>

                    {{-- Langkah 2: Isi & Tanda Tangan --}}
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 flex flex-col">
                        <div>
                            <span class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-sm font-bold mb-3">2</span>
                            <h4 class="font-bold text-slate-800 text-sm">Isi & Tandatangani</h4>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">Pastikan seluruh data diri diisi dengan benar. Tandatangani dokumen di atas meterai Rp 10.000 jika diperlukan.</p>
                        </div>
                        <div class="mt-4 flex-grow flex items-center justify-center">
                            <div class="text-slate-300">
                                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Langkah 3: Scan & Upload --}}
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 flex flex-col">
                        <div>
                            <span class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-sm font-bold mb-3">3</span>
                            <h4 class="font-bold text-slate-800 text-sm">Scan & Kirim</h4>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">Pindai dokumen yang telah ditandatangani ke dalam format PDF, lalu unggah berkasnya ke kolom di bawah ini.</p>
                        </div>
                        <div class="mt-4 flex-grow flex items-center justify-center">
                            <div class="text-slate-300">
                                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Upload Area --}}
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Surat Komitmen (Format PDF) <span class="text-red-500">*</span></label>
                    <div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center hover:bg-slate-50 transition cursor-pointer relative" id="komitmen-upload-area">
                        <input type="file" name="surat_komitmen" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".pdf" id="komitmen-input" {{ $userProfile?->surat_komitmen ? '' : 'required' }}>
                        
                        <div id="komitmen-preview-container">
                            @if(!($userProfile?->surat_komitmen))
                                <svg class="w-10 h-10 text-slate-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="text-sm text-slate-600 font-medium">Klik atau seret file PDF Surat Komitmen ke sini</p>
                                <p class="text-xs text-slate-400 mt-1">Hanya mendukung format PDF (Maks 5MB)</p>
                            @else
                                @php
                                    $filePath = $userProfile->surat_komitmen;
                                    $fileNameStart = strrpos($filePath, '/') + 1;
                                    $fileName = substr($filePath, $fileNameStart);
                                @endphp
                                <div class="w-16 h-16 mx-auto mb-3 bg-slate-100 rounded-lg flex items-center justify-center relative z-0">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-sm text-green-600 font-semibold">✓ {{ $fileName }}</p>
                                <p class="text-xs text-slate-500 mt-1">Klik untuk mengganti file</p>
                                <div class="mt-3">
                                    <a href="{{ Storage::url($filePath) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-bold transition relative z-20">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Lihat Surat yang Diunggah
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex justify-between mt-8 pt-6 border-t border-slate-100">
                <a href="{{ route('pendaftaran.step5') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-orange-200 flex items-center gap-2">
                    Simpan & Lanjut Tahap 7 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('step-form');

        // ============================================
        // 2. HANDLE FILE PREVIEW UNTUK SURAT KOMITMEN
        // ============================================
        const komitmenInput = document.getElementById('komitmen-input');
        const komitmenUploadArea = document.getElementById('komitmen-upload-area');
        const komitmenPreviewContainer = document.getElementById('komitmen-preview-container');
        
        if (komitmenInput) {
            komitmenInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    showFilePreview(this.files[0], komitmenPreviewContainer);
                }
            });

            komitmenUploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                komitmenUploadArea.classList.add('bg-slate-100');
            });

            komitmenUploadArea.addEventListener('dragleave', () => {
                komitmenUploadArea.classList.remove('bg-slate-100');
            });

            komitmenUploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                komitmenUploadArea.classList.remove('bg-slate-100');
                if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                    komitmenInput.files = e.dataTransfer.files;
                    showFilePreview(e.dataTransfer.files[0], komitmenPreviewContainer);
                }
            });
        }

        // ============================================
        // 3. FUNGSI UNTUK MENAMPILKAN PREVIEW FILE
        // ============================================
        function showFilePreview(file, targetContainer) {
            const fileName = file.name;
            let previewHTML = `
                <div class="w-16 h-16 mx-auto mb-3 bg-slate-100 rounded-lg flex items-center justify-center relative z-0">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <p class="text-sm text-green-600 font-semibold">✓ ${fileName}</p>
                <p class="text-xs text-slate-500 mt-1">File siap di-upload</p>
            `;
            if(targetContainer) targetContainer.innerHTML = previewHTML;
        }
    });
</script>
@endsection