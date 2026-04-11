@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 1')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 1])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <form action="{{ route('pendaftaran.step1.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Program Beasiswa <span class="text-red-500">*</span></label>
                    <select name="program_beasiswa" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">-- Pilih Program --</option>
                        <option value="sarjana" {{ old('program_beasiswa', $userProfile?->program_beasiswa) == 'sarjana' ? 'selected' : '' }}>Beasiswa Sarjana (S1)</option>
                        <option value="magister" {{ old('program_beasiswa', $userProfile?->program_beasiswa) == 'magister' ? 'selected' : '' }}>Beasiswa Magister (S2)</option>
                        <option value="dokter" {{ old('program_beasiswa', $userProfile?->program_beasiswa) == 'dokter' ? 'selected' : '' }}>Beasiswa Dokter Spesialis</option>
                    </select>
                </div>

                <div class="md:col-span-2 mt-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Foto KTP <span class="text-red-500">*</span></label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer relative">
                        <input type="file" name="foto_ktp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".jpg,.jpeg,.png" {{ $userProfile ? '' : 'required' }}>
                        <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        <p class="text-sm text-slate-600 font-medium">Klik untuk mengunggah foto KTP</p>
                        <p class="text-xs text-slate-400 mt-1">JPG, JPEG, PNG (Maks 5MB)</p>
                        @if($userProfile && $userProfile->foto_ktp)
                            <p class="text-xs text-green-600 mt-2 font-semibold">✓ KTP sudah terunggah. (Upload ulang jika ingin mengganti)</p>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" value="{{ old('nik', $userProfile?->nik) }}" required maxlength="16" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="16 Digit NIK">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap (Sesuai KTP) <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $userProfile?->nama) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Nama Lengkap">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $tempat_lahir ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Kota/Kabupaten">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $tanggal_lahir ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">No. WhatsApp <span class="text-red-500">*</span></label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $userProfile?->no_telp) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="08xxxxxxxx">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">RT <span class="text-red-500">*</span></label>
                        <input type="text" name="rt" value="{{ old('rt', $userProfile?->rt) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="001">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">RW <span class="text-red-500">*</span></label>
                        <input type="text" name="rw" value="{{ old('rw', $userProfile?->rw) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="002">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kelurahan/Desa <span class="text-red-500">*</span></label>
                    <input type="text" name="kelurahan" value="{{ old('kelurahan', $userProfile?->kelurahan) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Nama Kelurahan">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kecamatan <span class="text-red-500">*</span></label>
                    <input type="text" name="kecamatan" value="{{ old('kecamatan', $userProfile?->kecamatan) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Nama Kecamatan">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="2" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Nama Jalan, Blok, dsb">{{ old('alamat', $userProfile?->alamat) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Agama <span class="text-red-500">*</span></label>
                    <select name="agama" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">-- Pilih Agama --</option>
                        <option value="Islam" {{ old('agama', $userProfile?->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ old('agama', $userProfile?->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ old('agama', $userProfile?->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('agama', $userProfile?->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ old('agama', $userProfile?->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ old('agama', $userProfile?->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status Perkawinan <span class="text-red-500">*</span></label>
                    <select name="status_perkawinan" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Kawin" {{ old('status_perkawinan', $userProfile?->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Kawin" {{ old('status_perkawinan', $userProfile?->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                        <option value="Cerai Hidup" {{ old('status_perkawinan', $userProfile?->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="Cerai Mati" {{ old('status_perkawinan', $userProfile?->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pekerjaan <span class="text-red-500">*</span></label>
                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $userProfile?->pekerjaan) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kewarganegaraan <span class="text-red-500">*</span></label>
                    <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $userProfile?->kewarganegaraan ?? 'WNI') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                </div>

                

            </div>

            <div class="flex justify-end mt-8 pt-6 border-t border-slate-100">
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-orange-200 flex items-center gap-2">
                    Simpan & Lanjut Tahap 2 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection