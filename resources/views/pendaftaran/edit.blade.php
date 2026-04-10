@extends('layouts.app')

@section('title', 'Ajukan Ulang Pendaftaran')

@section('content')
<div class="max-w-4xl mx-auto mb-10">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">Ajukan Ulang Pendaftaran</h1>
        <p class="text-slate-500">Perbaiki data Anda berdasarkan catatan dari admin, kemudian submit kembali.</p>
    </div>

    {{-- Pesan Penolakan Admin --}}
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-8 shadow-sm">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-bold text-red-800">Catatan Penolakan Sebelumnya:</h3>
                <div class="mt-1 text-sm text-red-700">
                    {{ $profil->catatan ?? 'Data Anda belum memenuhi persyaratan.' }}
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('pendaftaran.update', $profil->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
        @csrf
        @method('PUT')

        <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Program Beasiswa</h3>
        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Program <span class="text-red-500">*</span></label>
            <select name="program_beasiswa" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
                <option value="sarjana" {{ (old('program_beasiswa', $profil->program_beasiswa) == 'sarjana') ? 'selected' : '' }}>Sarjana (S1)</option>
                <option value="magister" {{ (old('program_beasiswa', $profil->program_beasiswa) == 'magister') ? 'selected' : '' }}>Magister (S2)</option>
                <option value="dokter" {{ (old('program_beasiswa', $profil->program_beasiswa) == 'dokter') ? 'selected' : '' }}>Dokter (Spesialis)</option>
            </select>
        </div>

        <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2 mt-8">Data Pribadi</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $profil->nama) }}" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">NIK <span class="text-red-500">*</span></label>
                <input type="text" name="nik" value="{{ old('nik', $profil->nik) }}" maxlength="16" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
                @error('nik') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $tempat_lahir) }}" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $tanggal_lahir) }}" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nomor Telepon/WA <span class="text-red-500">*</span></label>
                <input type="text" name="no_telp" value="{{ old('no_telp', $profil->no_telp) }}" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
            </div>
        </div>

        <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2 mt-8">Data Profil Tambahan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Agama <span class="text-red-500">*</span></label>
                <select name="agama" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
                    <option value="Islam" {{ old('agama', $profil->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ old('agama', $profil->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ old('agama', $profil->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ old('agama', $profil->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ old('agama', $profil->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ old('agama', $profil->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Status Perkawinan <span class="text-red-500">*</span></label>
                <select name="status_perkawinan" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
                    <option value="Belum Kawin" {{ old('status_perkawinan', $profil->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Kawin" {{ old('status_perkawinan', $profil->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                    <option value="Cerai Hidup" {{ old('status_perkawinan', $profil->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ old('status_perkawinan', $profil->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Pekerjaan <span class="text-red-500">*</span></label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $profil->pekerjaan) }}" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kewarganegaraan <span class="text-red-500">*</span></label>
                <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $profil->kewarganegaraan) }}" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
            </div>
        </div>

        <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2 mt-8">Alamat Domisili</h3>
        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
            <textarea name="alamat" rows="3" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>{{ old('alamat', $profil->alamat) }}</textarea>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">RT <span class="text-red-500">*</span></label>
                <input type="number" name="rt" value="{{ old('rt', $profil->rt) }}" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">RW <span class="text-red-500">*</span></label>
                <input type="number" name="rw" value="{{ old('rw', $profil->rw) }}" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kelurahan/Desa <span class="text-red-500">*</span></label>
                <input type="text" name="kelurahan" value="{{ old('kelurahan', $profil->kelurahan) }}" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kecamatan <span class="text-red-500">*</span></label>
                <input type="text" name="kecamatan" value="{{ old('kecamatan', $profil->kecamatan) }}" class="w-full rounded-xl border-slate-300 focus:ring-orange-500 focus:border-orange-500" required>
            </div>
        </div>

        <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2 mt-8">Upload Dokumen</h3>
        <div class="mb-8">
            <label class="block text-sm font-medium text-slate-700 mb-1">Foto KTP</label>
            <p class="text-xs text-slate-500 mb-2">Biarkan kosong jika tidak ingin mengubah foto KTP sebelumnya.</p>
            <input type="file" name="foto_ktp" accept="image/jpeg,image/png,image/jpg" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
            @if($profil->foto_ktp)
                <div class="mt-3 text-sm text-blue-600 font-medium">
                    <a href="{{ asset('storage/'.$profil->foto_ktp) }}" target="_blank" class="hover:underline">Lihat KTP Saat Ini</a>
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end gap-4 pt-6 border-t mt-4">
            <a href="{{ route('riwayat.index') }}" class="px-6 py-2.5 text-slate-600 font-medium hover:bg-slate-100 rounded-xl transition">Batal</a>
            <button type="submit" class="px-8 py-2.5 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl shadow-md transition transform hover:-translate-y-0.5">
                Kirim Pengajuan Ulang
            </button>
        </div>
    </form>

</div>
@endsection