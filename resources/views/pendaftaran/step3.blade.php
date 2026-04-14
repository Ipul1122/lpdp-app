@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 3')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 3])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <form id="step-form" action="{{ route('pendaftaran.step3.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Upload LoA --}}
                <div class="md:col-span-2 mt-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Letter of Acceptance (LoA) / Bukti Lulus Seleksi <span class="text-red-500">*</span></label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer relative" id="loa-upload-area">
                        <input type="file" name="loa" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".pdf,.jpg,.jpeg,.png" id="loa-input" {{ $universitas?->loa ? '' : 'required' }}>
                        
                        <div id="loa-preview-container">
                            @if(!($universitas?->loa))
                                <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                <p class="text-sm text-slate-600 font-medium">Klik atau seret file LoA ke sini</p>
                                <p class="text-xs text-slate-400 mt-1">PDF, JPG, PNG (Maks 5MB)</p>
                            @else
                                @php
                                    $loaPath = $universitas->loa;
                                    $loaNameStart = strrpos($loaPath, '/') + 1;
                                    $loaName = substr($loaPath, $loaNameStart);
                                    $loaExt = strtolower(pathinfo($loaName, PATHINFO_EXTENSION));
                                    $loaIsImage = in_array($loaExt, ['jpg', 'jpeg', 'png']);
                                @endphp
                                @if($loaIsImage)
                                    <img src="{{ Storage::url($loaPath) }}" alt="LoA Preview" class="w-32 h-32 object-cover mx-auto rounded-lg mb-3 border border-slate-200 relative z-0">
                                @else
                                    <div class="w-16 h-16 mx-auto mb-3 bg-slate-100 rounded-lg flex items-center justify-center relative z-0">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <p class="text-sm text-green-600 font-semibold">✓ {{ $loaName }}</p>
                                <p class="text-xs text-slate-500 mt-1">Klik untuk mengganti file</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Upload KHS/IPK --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Kartu Hasil Studi (KHS) / IPK Terakhir <span class="text-red-500">*</span></label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer relative" id="khs-upload-area">
                        <input type="file" name="khs_ipk" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".pdf,.jpg,.jpeg,.png" id="khs-input" {{ $universitas?->khs_ipk ? '' : 'required' }}>
                        
                        <div id="khs-preview-container">
                            @if(!($universitas?->khs_ipk))
                                <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                <p class="text-sm text-slate-600 font-medium">Klik atau seret file KHS/IPK ke sini</p>
                                <p class="text-xs text-slate-400 mt-1">PDF, JPG, PNG (Maks 5MB)</p>
                            @else
                                @php
                                    $khsPath = $universitas->khs_ipk;
                                    $khsNameStart = strrpos($khsPath, '/') + 1;
                                    $khsName = substr($khsPath, $khsNameStart);
                                    $khsExt = strtolower(pathinfo($khsName, PATHINFO_EXTENSION));
                                    $khsIsImage = in_array($khsExt, ['jpg', 'jpeg', 'png']);
                                @endphp
                                @if($khsIsImage)
                                    <img src="{{ Storage::url($khsPath) }}" alt="KHS/IPK Preview" class="w-32 h-32 object-cover mx-auto rounded-lg mb-3 border border-slate-200 relative z-0">
                                @else
                                    <div class="w-16 h-16 mx-auto mb-3 bg-slate-100 rounded-lg flex items-center justify-center relative z-0">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <p class="text-sm text-green-600 font-semibold">✓ {{ $khsName }}</p>
                                <p class="text-xs text-slate-500 mt-1">Klik untuk mengganti file</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Negara Tujuan <span class="text-red-500">*</span></label>
                    <select name="negara_tujuan" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">Pilih Negara</option>
                        <option value="Indonesia" {{ old('negara_tujuan', $universitas?->negara_tujuan) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                        <option value="Luar Negeri" {{ old('negara_tujuan', $universitas?->negara_tujuan) == 'Luar Negeri' ? 'selected' : '' }}>Luar Negeri</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Provinsi <span class="text-red-500">*</span></label>
                    <input type="text" name="provinsi" value="{{ old('provinsi', $universitas?->provinsi) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: DKI Jakarta">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kota <span class="text-red-500">*</span></label>
                    <input type="text" name="kota" value="{{ old('kota', $universitas?->kota) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Jakarta Selatan">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Universitas Tujuan <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_universitas" value="{{ old('nama_universitas', $universitas?->nama_universitas) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Ketik nama universitas...">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Program Studi <span class="text-red-500">*</span></label>
                    <input type="text" name="program_studi" value="{{ old('program_studi', $universitas?->program_studi) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: S1 Teknik Informatika">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Rencana Tanggal Mulai Studi <span class="text-red-500">*</span></label>
                    <input type="month" name="tanggal_mulai_studi" value="{{ old('tanggal_mulai_studi', $universitas?->tanggal_mulai_studi) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Rencana Durasi Studi (Bulan) <span class="text-red-500">*</span></label>
                    <input type="number" name="durasi_studi" value="{{ old('durasi_studi', $universitas?->durasi_studi) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: 48">
                </div>

            </div>

            <div class="flex justify-between mt-8 pt-6 border-t border-slate-100">
                <a href="{{ route('pendaftaran.step2') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-orange-200 flex items-center gap-2">
                    Simpan & Lanjut Tahap 4 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('step-form');
        const storageKey = 'draft_step_{{ $step }}_user_{{ Auth::id() }}';

        // 1. KEMBALIKAN DATA DARI LOCALSTORAGE
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

        // 2. SIMPAN DRAFT SAAT MENGETIK
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

        // 3. BERSIHKAN LOCALSTORAGE SAAT SUBMIT
        form.addEventListener('submit', function() {
            localStorage.removeItem(storageKey);
        });

        // ============================================
        // 4. HANDLE FILE PREVIEW UNTUK LOA
        // ============================================
        const loaInput = document.getElementById('loa-input');
        const loaUploadArea = document.getElementById('loa-upload-area');
        const loaPreviewContainer = document.getElementById('loa-preview-container'); // Ambil target container
        
        if (loaInput) {
            loaInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    showFilePreview(this.files[0], loaPreviewContainer);
                }
            });

            loaUploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                loaUploadArea.classList.add('bg-slate-100');
            });

            loaUploadArea.addEventListener('dragleave', () => {
                loaUploadArea.classList.remove('bg-slate-100');
            });

            loaUploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                loaUploadArea.classList.remove('bg-slate-100');
                if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                    loaInput.files = e.dataTransfer.files;
                    showFilePreview(e.dataTransfer.files[0], loaPreviewContainer);
                }
            });
        }

        // ============================================
        // 5. HANDLE FILE PREVIEW UNTUK KHS/IPK
        // ============================================
        const khsInput = document.getElementById('khs-input');
        const khsUploadArea = document.getElementById('khs-upload-area');
        const khsPreviewContainer = document.getElementById('khs-preview-container'); // Ambil target container
        
        if (khsInput) {
            khsInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    showFilePreview(this.files[0], khsPreviewContainer);
                }
            });

            khsUploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                khsUploadArea.classList.add('bg-slate-100');
            });

            khsUploadArea.addEventListener('dragleave', () => {
                khsUploadArea.classList.remove('bg-slate-100');
            });

            khsUploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                khsUploadArea.classList.remove('bg-slate-100');
                if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                    khsInput.files = e.dataTransfer.files;
                    showFilePreview(e.dataTransfer.files[0], khsPreviewContainer);
                }
            });
        }

        // ============================================
        // 6. FUNGSI UNTUK MENAMPILKAN PREVIEW FILE
        // ============================================
        // Tambahkan parameter targetContainer agar JS tahu div mana yang harus ditimpa
        function showFilePreview(file, targetContainer) {
            const fileName = file.name;
            const fileExt = fileName.substring(fileName.lastIndexOf('.')).toLowerCase();
            const isImage = ['.jpg', '.jpeg', '.png'].includes(fileExt);

            let previewHTML = '';
            
            if (isImage) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewHTML = `
                        <img src="${e.target.result}" alt="Preview" class="w-32 h-32 object-cover mx-auto rounded-lg mb-3 border border-slate-200 relative z-0">
                        <p class="text-sm text-green-600 font-semibold">✓ ${fileName}</p>
                        <p class="text-xs text-slate-500 mt-1">File siap di-upload</p>
                    `;
                    if(targetContainer) targetContainer.innerHTML = previewHTML;
                };
                reader.readAsDataURL(file);
            } else {
                previewHTML = `
                    <div class="w-16 h-16 mx-auto mb-3 bg-slate-100 rounded-lg flex items-center justify-center relative z-0">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-sm text-green-600 font-semibold">✓ ${fileName}</p>
                    <p class="text-xs text-slate-500 mt-1">File siap di-upload</p>
                `;
                if(targetContainer) targetContainer.innerHTML = previewHTML;
            }
        }
    });
</script>
@endsection