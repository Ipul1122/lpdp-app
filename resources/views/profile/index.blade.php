@extends('layouts.app')
@section('title', 'Profil Saya')

@section('content')
<div class="max-w-4xl mx-auto mb-10 mt-8 px-4">
    
    <div class="flex items-center gap-3 mb-8">
        <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Profil Saya</h2>
            <p class="text-slate-500 text-sm">Kelola informasi data diri dan dokumen KTP Anda.</p>
        </div>
    </div>

    @if($isLocked)
        <div class="bg-amber-50 border border-amber-200 text-amber-800 px-5 py-4 rounded-2xl mb-8 flex items-start gap-4 shadow-sm">
            <svg class="w-6 h-6 mt-0.5 shrink-0 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <div>
                <strong class="font-bold text-base block mb-1">Profil Sedang Terkunci</strong>
                <p class="text-sm leading-relaxed">Data profil Anda tidak dapat diubah karena formulir pendaftaran Anda sudah dikirim dan sedang dalam proses review oleh Administrator. Perubahan hanya bisa dilakukan jika status Anda dikembalikan (Revisi).</p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 md:p-10">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <fieldset {{ $isLocked ? 'disabled' : '' }}>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Program Beasiswa yang Diinginkan</label>
                        <select name="program_beasiswa" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                            <option value="">-- Pilih Program --</option>
                            <option value="sarjana" {{ old('program_beasiswa', $userProfile?->program_beasiswa) == 'sarjana' ? 'selected' : '' }}>Beasiswa Sarjana (S1)</option>
                            <option value="magister" {{ old('program_beasiswa', $userProfile?->program_beasiswa) == 'magister' ? 'selected' : '' }}>Beasiswa Magister (S2)</option>
                            <option value="dokter" {{ old('program_beasiswa', $userProfile?->program_beasiswa) == 'dokter' ? 'selected' : '' }}>Beasiswa Dokter Spesialis</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik', $userProfile?->nik) }}" required maxlength="16" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap (Sesuai KTP)</label>
                        <input type="text" name="nama" value="{{ old('nama', $userProfile?->nama) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $tempat_lahir) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $tanggal_lahir) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">No. WhatsApp</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp', $userProfile?->no_telp) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">RT</label>
                            <input type="text" name="rt" value="{{ old('rt', $userProfile?->rt) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">RW</label>
                            <input type="text" name="rw" value="{{ old('rw', $userProfile?->rw) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kelurahan/Desa</label>
                        <input type="text" name="kelurahan" value="{{ old('kelurahan', $userProfile?->kelurahan) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kecamatan</label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $userProfile?->kecamatan) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap</label>
                        <textarea name="alamat" rows="2" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">{{ old('alamat', $userProfile?->alamat) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Agama</label>
                        <select name="agama" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
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
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Status Perkawinan</label>
                        <select name="status_perkawinan" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                            <option value="">-- Pilih Status --</option>
                            <option value="Belum Kawin" {{ old('status_perkawinan', $userProfile?->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                            <option value="Kawin" {{ old('status_perkawinan', $userProfile?->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                            <option value="Cerai Hidup" {{ old('status_perkawinan', $userProfile?->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                            <option value="Cerai Mati" {{ old('status_perkawinan', $userProfile?->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Pekerjaan</label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $userProfile?->pekerjaan) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $userProfile?->kewarganegaraan ?? 'WNI') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm {{ $isLocked ? 'bg-slate-50' : '' }}">
                    </div>

                    <div class="md:col-span-2 mt-4">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Foto KTP</label>
                        
                        @if($userProfile && $userProfile->foto_ktp)
                            <div class="mb-4">
                                <a href="{{ asset('storage/' . $userProfile->foto_ktp) }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-blue-600 font-semibold hover:underline bg-blue-50 px-4 py-2 rounded-lg border border-blue-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Lihat KTP Saat Ini
                                </a>
                            </div>
                        @endif

                        @if(!$isLocked)
                            <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer relative">
                                <input type="file" name="foto_ktp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".jpg,.jpeg,.png" {{ $userProfile ? '' : 'required' }}>
                                <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                <p class="text-sm text-slate-600 font-medium">Klik untuk mengunggah {{ $userProfile ? 'KTP baru (Opsional)' : 'foto KTP' }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                @if(!$isLocked)
                    <div class="flex justify-end mt-10 pt-6 border-t border-slate-100">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-indigo-200 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Simpan Perubahan Profil
                        </button>
                    </div>
                @endif
                
            </fieldset>
        </form>
    </div>
</div>
@endsection