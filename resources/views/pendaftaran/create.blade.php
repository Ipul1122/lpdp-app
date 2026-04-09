@extends('layouts.app')

@section('title', 'Form Pendaftaran')

@section('content')
<div class="max-w-4xl mx-auto">

    <nav class="flex items-center text-sm font-medium text-slate-500 mb-6">
        <a href="{{ route('dashboard') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
        <svg class="w-4 h-4 mx-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        
        <a href="{{ route('pendaftaran.index') }}" class="hover:text-orange-500 transition-colors">Pendaftaran</a>
        <svg class="w-4 h-4 mx-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        
        <span class="text-slate-800">Form Profil & CV</span>
    </nav>

    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
        
        <div class="mb-8 border-b border-slate-100 pb-4">
            <h2 class="text-2xl font-bold text-slate-800">Lengkapi Profil & CV</h2>
            <p class="text-slate-500 text-sm mt-1">Silakan isi data diri Anda dengan teliti sesuai dengan dokumen asli.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                <h3 class="text-red-700 font-bold mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                    Mohon perbaiki kesalahan berikut:
                </h3>
                <ul class="text-red-600 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Foto KTP <span class="text-red-500">*</span></label>
                <input type="file" name="foto_ktp" accept="image/*" required
                       @class([
                           'w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 border rounded-xl cursor-pointer',
                           'border-red-500' => $errors->has('foto_ktp'),
                           'border-slate-300' => !$errors->has('foto_ktp'),
                       ])>
                <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 5MB.</p>
                @error('foto_ktp')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">NIK <span class="text-red-500">*</span></label>
                <input type="text" name="nik" required maxlength="16" placeholder="16 Digit NIK" 
                       value="{{ old('nik') }}"
                       oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                       @class([
                           'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none',
                           'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('nik'),
                           'border-slate-300 focus:ring-orange-500' => !$errors->has('nik'),
                       ])>
                @error('nik')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" required placeholder="Sesuai KTP" 
                       value="{{ old('nama') }}"
                       @class([
                           'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none',
                           'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('nama'),
                           'border-slate-300 focus:ring-orange-500' => !$errors->has('nama'),
                       ])>
                @error('nama')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nomor Telepon (WhatsApp) <span class="text-red-500">*</span></label>
                <input type="text" name="no_telp" required placeholder="Contoh: 081234567890" 
                       value="{{ old('no_telp') }}"
                       oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                       @class([
                           'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none',
                           'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('no_telp'),
                           'border-slate-300 focus:ring-orange-500' => !$errors->has('no_telp'),
                       ])>
                @error('no_telp')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                <input type="text" name="tempat_lahir" required placeholder="Contoh: Jakarta" 
                       value="{{ old('tempat_lahir') }}"
                       @class([
                           'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none bg-white',
                           'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('tempat_lahir'),
                           'border-slate-300 focus:ring-orange-500' => !$errors->has('tempat_lahir'),
                       ])>
                @error('tempat_lahir')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_lahir" required 
                       value="{{ old('tanggal_lahir') }}"
                       @class([
                           'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none bg-white cursor-pointer',
                           'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('tanggal_lahir'),
                           'border-slate-300 focus:ring-orange-500' => !$errors->has('tanggal_lahir'),
                       ])>
                @error('tanggal_lahir')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 border-t border-slate-100 pt-4 mt-2">
                <h3 class="text-sm font-bold text-slate-800 mb-4">Detail Alamat</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="col-span-2 md:col-span-4">
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Alamat Jalan <span class="text-red-500">*</span></label>
                        <input type="text" name="alamat" required placeholder="Nama jalan, gang, atau blok" 
                               value="{{ old('alamat') }}"
                               @class([
                                   'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none',
                                   'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('alamat'),
                                   'border-slate-300 focus:ring-orange-500' => !$errors->has('alamat'),
                               ])>
                        @error('alamat')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">RT <span class="text-red-500">*</span></label>
                        <input type="text" name="rt" required placeholder="001" maxlength="3" 
                               value="{{ old('rt') }}"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                               @class([
                                   'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none',
                                   'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('rt'),
                                   'border-slate-300 focus:ring-orange-500' => !$errors->has('rt'),
                               ])>
                        @error('rt')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">RW <span class="text-red-500">*</span></label>
                        <input type="text" name="rw" required placeholder="002" maxlength="3" 
                               value="{{ old('rw') }}"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                               @class([
                                   'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none',
                                   'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('rw'),
                                   'border-slate-300 focus:ring-orange-500' => !$errors->has('rw'),
                               ])>
                        @error('rw')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Kelurahan/Desa <span class="text-red-500">*</span></label>
                        <input type="text" name="kelurahan" required 
                               value="{{ old('kelurahan') }}"
                               @class([
                                   'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none',
                                   'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('kelurahan'),
                                   'border-slate-300 focus:ring-orange-500' => !$errors->has('kelurahan'),
                               ])>
                        @error('kelurahan')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Kecamatan <span class="text-red-500">*</span></label>
                        <input type="text" name="kecamatan" required 
                               value="{{ old('kecamatan') }}"
                               @class([
                                   'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none',
                                   'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('kecamatan'),
                                   'border-slate-300 focus:ring-orange-500' => !$errors->has('kecamatan'),
                               ])>
                        @error('kecamatan')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Agama <span class="text-red-500">*</span></label>
                <select name="agama" required 
                        @class([
                            'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none bg-white cursor-pointer',
                            'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('agama'),
                            'border-slate-300 focus:ring-orange-500' => !$errors->has('agama'),
                        ])>
                    <option value="" disabled {{ old('agama') ? '' : 'selected' }}>Pilih Agama</option>
                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
                @error('agama')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Status Perkawinan <span class="text-red-500">*</span></label>
                <select name="status_perkawinan" required 
                        @class([
                            'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none bg-white cursor-pointer',
                            'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('status_perkawinan'),
                            'border-slate-300 focus:ring-orange-500' => !$errors->has('status_perkawinan'),
                        ])>
                    <option value="" disabled {{ old('status_perkawinan') ? '' : 'selected' }}>Pilih Status</option>
                    <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                    <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                </select>
                @error('status_perkawinan')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Pekerjaan <span class="text-red-500">*</span></label>
                <input type="text" name="pekerjaan" required placeholder="Contoh: Mahasiswa, Pegawai Swasta" 
                       value="{{ old('pekerjaan') }}"
                       @class([
                           'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none',
                           'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('pekerjaan'),
                           'border-slate-300 focus:ring-orange-500' => !$errors->has('pekerjaan'),
                       ])>
                @error('pekerjaan')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Kewarganegaraan <span class="text-red-500">*</span></label>
                <select name="kewarganegaraan" required 
                        @class([
                            'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none bg-white cursor-pointer',
                            'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('kewarganegaraan'),
                            'border-slate-300 focus:ring-orange-500' => !$errors->has('kewarganegaraan'),
                        ])>
                    <option value="WNI" {{ old('kewarganegaraan', 'WNI') == 'WNI' ? 'selected' : '' }}>WNI</option>
                    <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA</option>
                </select>
                @error('kewarganegaraan')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 border-t border-slate-100 pt-6 mt-2">
                <h3 class="text-sm font-bold text-slate-800 mb-4">Pemilihan Program</h3>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Pilih Program Beasiswa <span class="text-red-500">*</span></label>
                    <select name="program_beasiswa" required 
                            @class([
                                'w-full px-4 py-2 border rounded-xl focus:ring-2 outline-none bg-white cursor-pointer',
                                'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('program_beasiswa'),
                                'border-slate-300 focus:ring-orange-500' => !$errors->has('program_beasiswa'),
                            ])>
                        <option value="" disabled {{ !old('program_beasiswa') && !request('program') ? 'selected' : '' }}>-- Silakan Pilih Program --</option>
                        <option value="sarjana" {{ old('program_beasiswa', request('program')) == 'sarjana' ? 'selected' : '' }}>Beasiswa Sarjana (S1)</option>
                        <option value="magister" {{ old('program_beasiswa', request('program')) == 'magister' ? 'selected' : '' }}>Beasiswa Magister (S2)</option>
                        <option value="dokter" {{ old('program_beasiswa', request('program')) == 'dokter' ? 'selected' : '' }}>Beasiswa Dokter Spesialis</option>
                    </select>
                    @error('program_beasiswa')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="md:col-span-2 mt-8">
                <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-orange-200 transition-all cursor-pointer">
                    Simpan Data Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection