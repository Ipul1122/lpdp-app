@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 2')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 2])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <form id="step-form" action="{{ route('pendaftaran.step2.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Upload Surat Izin / Rekomendasi --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Surat Izin / Rekomendasi</label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer relative" id="surat-izin-upload-area">
                        <input type="file" name="surat_izin" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.jpg,.jpeg,.png" id="surat-izin-input">
                        @if(!($industri?->surat_izin))
                            <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            <p class="text-sm text-slate-600 font-medium">Klik untuk mengunggah atau seret file ke sini</p>
                            <p class="text-xs text-slate-400 mt-1">PDF, JPG, PNG (Maks 5MB)</p>
                        @else
                            @php
                                $suratPath = $industri->surat_izin;
                                $suratNameStart = strrpos($suratPath, '/') + 1;
                                $suratName = substr($suratPath, $suratNameStart);
                                $suratExt = strtolower(pathinfo($suratName, PATHINFO_EXTENSION));
                                $suratIsImage = in_array($suratExt, ['jpg', 'jpeg', 'png']);
                            @endphp
                            @if($suratIsImage)
                                <img src="{{ Storage::url($suratPath) }}" alt="Surat Izin Preview" class="w-32 h-32 object-cover mx-auto rounded-lg mb-3 border border-slate-200">
                            @else
                                <div class="w-16 h-16 mx-auto mb-3 bg-slate-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <p class="text-sm text-green-600 font-semibold">✓ {{ $suratName }}</p>
                            <p class="text-xs text-slate-500 mt-1">Klik untuk mengganti file</p>
                        @endif
                    </div>
                </div>

                {{-- Instansi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Instansi</label>
                    <select name="instansi" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">Pilih Instansi</option>
                        <option value="Pemerintah" {{ old('instansi', $industri?->instansi) == 'Pemerintah' ? 'selected' : '' }}>Pemerintah</option>
                        <option value="Swasta" {{ old('instansi', $industri?->instansi) == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                    </select>
                </div>

                {{-- Sektor --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Sektor</label>
                    <select name="sektor" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">Pilih Sektor</option>
                        <option value="Pendidikan" {{ old('sektor', $industri?->sektor) == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        <option value="Teknologi" {{ old('sektor', $industri?->sektor) == 'Teknologi' ? 'selected' : '' }}>Teknologi / IT</option>
                    </select>
                </div>

                {{-- Jenis Instansi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Jenis Instansi</label>
                    <select name="jenis_instansi" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">Pilih Jenis Instansi</option>
                        <option value="BUMN" {{ old('jenis_instansi', $industri?->jenis_instansi) == 'BUMN' ? 'selected' : '' }}>BUMN / BUMD</option>
                        <option value="Multinasional" {{ old('jenis_instansi', $industri?->jenis_instansi) == 'Multinasional' ? 'selected' : '' }}>Perusahaan Multinasional</option>
                    </select>
                </div>

                {{-- Nama Instansi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Instansi</label>
                    <input type="text" name="nama_instansi" value="{{ old('nama_instansi', $industri?->nama_instansi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: PT. Teknologi Cerdas">
                </div>

                {{-- No. Telepon Instansi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">No. Telepon Instansi</label>
                    <input type="text" name="telepon_instansi" value="{{ old('telepon_instansi', $industri?->telepon_instansi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Mulai dengan 0 atau +62">
                </div>

                {{-- Provinsi --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Provinsi</label>
                    <select name="provinsi" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">Pilih Provinsi</option>
                        <option value="DKI Jakarta" {{ old('provinsi', $industri?->provinsi) == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                        <option value="Jawa Barat" {{ old('provinsi', $industri?->provinsi) == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                    </select>
                </div>

                {{-- Kab/Kota --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kab/Kota</label>
                    <select name="kab_kota" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">Pilih Kab/Kota</option>
                        <option value="Jakarta Selatan" {{ old('kab_kota', $industri?->kab_kota) == 'Jakarta Selatan' ? 'selected' : '' }}>Jakarta Selatan</option>
                        <option value="Bandung" {{ old('kab_kota', $industri?->kab_kota) == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                    </select>
                </div>

                {{-- Alamat Instansi --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Instansi</label>
                    <textarea name="alamat_instansi" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Nama Jalan, Gedung, No...">{{ old('alamat_instansi', $industri?->alamat_instansi) }}</textarea>
                </div>

                {{-- Status Kepegawaian --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status Kepegawaian</label>
                    <select name="status_kepegawaian" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">Pilih Status</option>
                        <option value="Tetap" {{ old('status_kepegawaian', $industri?->status_kepegawaian) == 'Tetap' ? 'selected' : '' }}>Karyawan Tetap</option>
                        <option value="Kontrak" {{ old('status_kepegawaian', $industri?->status_kepegawaian) == 'Kontrak' ? 'selected' : '' }}>Karyawan Kontrak</option>
                    </select>
                </div>

                {{-- Tanggal Mulai Kerja --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Mulai Kerja (Bulan & Tahun)</label>
                    <input type="month" name="tanggal_mulai_kerja" value="{{ old('tanggal_mulai_kerja', $industri?->tanggal_mulai_kerja) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                </div>

                {{-- Pekerjaan --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pekerjaan</label>
                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $industri?->pekerjaan) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Web Developer">
                </div>

                {{-- Penghasilan --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Penghasilan (Rp)</label>
                    <select name="penghasilan" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">Pilih Range</option>
                        <option value="< 5 Juta" {{ old('penghasilan', $industri?->penghasilan) == '< 5 Juta' ? 'selected' : '' }}>Kurang dari Rp 5 Juta</option>
                        <option value="5 - 10 Juta" {{ old('penghasilan', $industri?->penghasilan) == '5 - 10 Juta' ? 'selected' : '' }}>Rp 5 Juta - Rp 10 Juta</option>
                    </select>
                </div>

                {{-- Deskripsi Pekerjaan --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Pekerjaan</label>
                    <textarea name="deskripsi_pekerjaan" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Jelaskan peran anda secara singkat...">{{ old('deskripsi_pekerjaan', $industri?->deskripsi_pekerjaan) }}</textarea>
                </div>
            </div>

            <div class="flex justify-between mt-8 pt-6 border-t border-slate-100">
                <a href="{{ route('pendaftaran.step1') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-orange-200 flex items-center gap-2">
                    Simpan & Lanjut Tahap 3 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle file preview untuk Surat Izin
        const suratIzinInput = document.getElementById('surat-izin-input');
        const uploadArea = document.getElementById('surat-izin-upload-area');
        
        if (suratIzinInput) {
            suratIzinInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    showFilePreview(this.files[0], uploadArea);
                }
            });

            // Drag and drop
            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.classList.add('bg-slate-100');
            });

            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('bg-slate-100');
            });

            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.classList.remove('bg-slate-100');
                if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                    suratIzinInput.files = e.dataTransfer.files;
                    showFilePreview(e.dataTransfer.files[0], uploadArea);
                }
            });
        }

        // Fungsi untuk menampilkan preview file
        function showFilePreview(file, uploadArea) {
            const fileName = file.name;
            const fileExt = fileName.substring(fileName.lastIndexOf('.')).toLowerCase();
            const isImage = ['.jpg', '.jpeg', '.png'].includes(fileExt);

            let previewHTML = '';
            
            if (isImage) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewHTML = `
                        <img src="${e.target.result}" alt="Preview" class="w-32 h-32 object-cover mx-auto rounded-lg mb-3 border border-slate-200">
                        <p class="text-sm text-green-600 font-semibold">✓ ${fileName}</p>
                        <p class="text-xs text-slate-500 mt-1">File siap di-upload</p>
                    `;
                    uploadArea.innerHTML = previewHTML;
                };
                reader.readAsDataURL(file);
            } else {
                previewHTML = `
                    <div class="w-16 h-16 mx-auto mb-3 bg-slate-100 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-sm text-green-600 font-semibold">✓ ${fileName}</p>
                    <p class="text-xs text-slate-500 mt-1">File siap di-upload</p>
                `;
                uploadArea.innerHTML = previewHTML;
            }
        }
    });
</script>
@endsection
       