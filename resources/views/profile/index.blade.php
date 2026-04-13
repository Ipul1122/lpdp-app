@extends('layouts.app')
@section('title', 'Pengaturan Profil')

@section('content')
<div x-data="{ activeTab: '{{ session('activeTab', 'profil') }}' }" class="max-w-7xl mx-auto px-4 mt-8 flex flex-col lg:flex-row gap-8 mb-20">
    
    <div class="w-full lg:w-72 shrink-0">
        <h2 class="text-xl font-extrabold text-slate-800 mb-6 px-2">Pengaturan</h2>
        
        <nav class="flex flex-col gap-1">
            <button @click="activeTab = 'profil'" :class="activeTab === 'profil' ? 'bg-indigo-50 text-indigo-700 font-bold shadow-sm' : 'text-slate-600 hover:bg-slate-50 font-medium'" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all w-full text-left">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> 
                Profil Pribadi
            </button>

            <button @click="activeTab = 'industri'" :class="activeTab === 'industri' ? 'bg-indigo-50 text-indigo-700 font-bold shadow-sm' : 'text-slate-600 hover:bg-slate-50 font-medium'" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all w-full text-left">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> 
                Industri / Pendukung
            </button>

            <button @click="activeTab = 'universitas'" :class="activeTab === 'universitas' ? 'bg-indigo-50 text-indigo-700 font-bold shadow-sm' : 'text-slate-600 hover:bg-slate-50 font-medium'" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all w-full text-left">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg> 
                Universitas Tujuan
            </button>

            <button @click="activeTab = 'biodata'" :class="activeTab === 'biodata' ? 'bg-indigo-50 text-indigo-700 font-bold shadow-sm' : 'text-slate-600 hover:bg-slate-50 font-medium'" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all w-full text-left">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg> 
                Biodata & Riwayat
            </button>

            <button @click="activeTab = 'rekomendasi'" :class="activeTab === 'rekomendasi' ? 'bg-indigo-50 text-indigo-700 font-bold shadow-sm' : 'text-slate-600 hover:bg-slate-50 font-medium'" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all w-full text-left">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> 
                Surat Rekomendasi
            </button>

            <button @click="activeTab = 'essay'" :class="activeTab === 'essay' ? 'bg-indigo-50 text-indigo-700 font-bold shadow-sm' : 'text-slate-600 hover:bg-slate-50 font-medium'" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all w-full text-left">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> 
                Essay Kontribusi
            </button>
        </nav>
    </div>

    <div class="flex-grow bg-white rounded-3xl shadow-sm border border-slate-200 p-8 md:p-10 relative">
        
        @if($isLocked)
            <div class="bg-amber-50 border border-amber-200 text-amber-800 px-5 py-4 rounded-2xl mb-8 flex items-start gap-4 shadow-sm">
                <svg class="w-6 h-6 mt-0.5 shrink-0 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <div>
                    <strong class="font-bold text-base block mb-1">Profil Sedang Terkunci</strong>
                    <p class="text-sm leading-relaxed">Data profil Anda tidak dapat diubah karena formulir pendaftaran Anda sudah dikirim dan sedang dalam proses review oleh Administrator.</p>
                </div>
            </div>
        @endif

        <fieldset {{ $isLocked ? 'disabled' : '' }}>
            
            <div x-show="activeTab === 'profil'" x-transition.opacity style="display: none;">
                <div class="mb-8 border-b border-slate-100 pb-4">
                    <h3 class="text-2xl font-extrabold text-slate-800">Pengaturan Profil</h3>
                    <p class="text-slate-500 text-sm mt-1">Perbarui data diri dan preferensi program beasiswa Anda.</p>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="section" value="profil">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Program Beasiswa yang Diinginkan</label>
                            <select name="program_beasiswa" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm">
                                <option value="">-- Pilih Program --</option>
                                <option value="sarjana" {{ old('program_beasiswa', $userProfile?->program_beasiswa) == 'sarjana' ? 'selected' : '' }}>Beasiswa Sarjana (S1)</option>
                                <option value="magister" {{ old('program_beasiswa', $userProfile?->program_beasiswa) == 'magister' ? 'selected' : '' }}>Beasiswa Magister (S2)</option>
                                <option value="dokter" {{ old('program_beasiswa', $userProfile?->program_beasiswa) == 'dokter' ? 'selected' : '' }}>Beasiswa Dokter Spesialis</option>
                            </select>
                        </div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">NIK</label><input type="text" name="nik" value="{{ $userProfile?->nik }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label><input type="text" name="nama" value="{{ $userProfile?->nama }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Tempat Lahir</label><input type="text" name="tempat_lahir" value="{{ $tempat_lahir }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Lahir</label><input type="date" name="tanggal_lahir" value="{{ $tanggal_lahir }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"></div>
                        <div class="md:col-span-2"><label class="block text-sm font-semibold text-slate-700 mb-2">No WhatsApp</label><input type="text" name="no_telp" value="{{ $userProfile?->no_telp }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"></div>
                        <div class="md:col-span-2"><label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Jalan</label><textarea name="alamat" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm">{{ $userProfile?->alamat }}</textarea></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">RT / RW</label><div class="flex gap-2"><input type="text" name="rt" value="{{ $userProfile?->rt }}" placeholder="RT" required class="w-1/2 px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"><input type="text" name="rw" value="{{ $userProfile?->rw }}" placeholder="RW" required class="w-1/2 px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"></div></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Kelurahan / Kecamatan</label><div class="flex gap-2"><input type="text" name="kelurahan" value="{{ $userProfile?->kelurahan }}" placeholder="Kelurahan" required class="w-1/2 px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"><input type="text" name="kecamatan" value="{{ $userProfile?->kecamatan }}" placeholder="Kecamatan" required class="w-1/2 px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"></div></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Agama</label><select name="agama" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"><option value="Islam" {{ $userProfile?->agama == 'Islam' ? 'selected' : '' }}>Islam</option><option value="Kristen" {{ $userProfile?->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option><option value="Katolik" {{ $userProfile?->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option><option value="Hindu" {{ $userProfile?->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option><option value="Buddha" {{ $userProfile?->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option><option value="Konghucu" {{ $userProfile?->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option></select></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Status Kawin</label><select name="status_perkawinan" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"><option value="Belum Kawin" {{ $userProfile?->status_perkawinan == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option><option value="Kawin" {{ $userProfile?->status_perkawinan == 'Kawin' ? 'selected' : '' }}>Kawin</option></select></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Pekerjaan</label><input type="text" name="pekerjaan" value="{{ $userProfile?->pekerjaan }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Kewarganegaraan</label><input type="text" name="kewarganegaraan" value="{{ $userProfile?->kewarganegaraan ?? 'WNI' }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm"></div>
                        <div class="md:col-span-2 mt-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Foto KTP</label>
                            @if($userProfile?->foto_ktp) <p class="mb-2"><a href="{{ asset('storage/' . $userProfile->foto_ktp) }}" target="_blank" class="text-blue-600 font-semibold text-sm hover:underline">📄 Lihat KTP Saat Ini</a></p> @endif
                            @if(!$isLocked) <input type="file" name="foto_ktp" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"> @endif
                        </div>
                    </div>
                    @if(!$isLocked) <div class="mt-8 text-right"><button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition">Simpan Profil</button></div> @endif
                </form>
            </div>

            <div x-show="activeTab === 'industri'" x-transition.opacity style="display: none;">
                <div class="mb-8 border-b border-slate-100 pb-4"><h3 class="text-2xl font-extrabold text-slate-800">Industri & Pekerjaan</h3></div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf <input type="hidden" name="section" value="industri">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Nama Instansi</label><input type="text" name="nama_instansi" value="{{ $industri?->nama_instansi }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Pekerjaan</label><input type="text" name="pekerjaan" value="{{ $industri?->pekerjaan }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Status Kepegawaian</label><select name="status_kepegawaian" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm"><option value="Tetap" {{ $industri?->status_kepegawaian == 'Tetap' ? 'selected' : '' }}>Tetap</option><option value="Kontrak" {{ $industri?->status_kepegawaian == 'Kontrak' ? 'selected' : '' }}>Kontrak</option></select></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Tgl Mulai Kerja</label><input type="month" name="tanggal_mulai_kerja" value="{{ $industri?->tanggal_mulai_kerja }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm"></div>
                        <div class="md:col-span-2"><label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Pekerjaan</label><textarea name="deskripsi_pekerjaan" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm">{{ $industri?->deskripsi_pekerjaan }}</textarea></div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Surat Izin Instansi</label>
                            @if($industri?->surat_izin) <p class="mb-2"><a href="{{ asset('storage/' . $industri->surat_izin) }}" target="_blank" class="text-blue-600 font-semibold text-sm hover:underline">📄 Lihat Dokumen Izin</a></p> @endif
                            @if(!$isLocked) <input type="file" name="surat_izin" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"> @endif
                        </div>
                    </div>
                    @if(!$isLocked) <div class="mt-8 text-right"><button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition">Simpan Industri</button></div> @endif
                </form>
            </div>

            <div x-show="activeTab === 'universitas'" x-transition.opacity style="display: none;">
                <div class="mb-8 border-b border-slate-100 pb-4"><h3 class="text-2xl font-extrabold text-slate-800">Universitas Tujuan</h3></div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf <input type="hidden" name="section" value="universitas">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2"><label class="block text-sm font-semibold text-slate-700 mb-2">Nama Universitas</label><input type="text" name="nama_universitas" value="{{ $universitas?->nama_universitas }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm"></div>
                        <div class="md:col-span-2"><label class="block text-sm font-semibold text-slate-700 mb-2">Program Studi</label><input type="text" name="program_studi" value="{{ $universitas?->program_studi }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Tgl Mulai Studi</label><input type="month" name="tanggal_mulai_studi" value="{{ $universitas?->tanggal_mulai_studi }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Durasi (Bulan)</label><input type="number" name="durasi_studi" value="{{ $universitas?->durasi_studi }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm"></div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">LoA (Letter of Acceptance)</label>
                            @if($universitas?->loa) <p class="mb-2"><a href="{{ asset('storage/' . $universitas->loa) }}" target="_blank" class="text-blue-600 font-semibold text-sm hover:underline">📄 Lihat LoA</a></p> @endif
                            @if(!$isLocked) <input type="file" name="loa" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"> @endif
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">KHS / IPK Terakhir</label>
                            @if($universitas?->khs_ipk) <p class="mb-2"><a href="{{ asset('storage/' . $universitas->khs_ipk) }}" target="_blank" class="text-blue-600 font-semibold text-sm hover:underline">📄 Lihat KHS</a></p> @endif
                            @if(!$isLocked) <input type="file" name="khs_ipk" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"> @endif
                        </div>
                    </div>
                    @if(!$isLocked) <div class="mt-8 text-right"><button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition">Simpan Universitas</button></div> @endif
                </form>
            </div>

            <div x-show="activeTab === 'biodata'" x-transition.opacity style="display: none;">
                <div class="mb-8 border-b border-slate-100 pb-4"><h3 class="text-2xl font-extrabold text-slate-800">Biodata & Riwayat</h3></div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf <input type="hidden" name="section" value="biodata">
                    <div class="space-y-6">
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Diri</label><textarea name="deskripsi_diri" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm">{{ $biodata?->deskripsi_diri }}</textarea></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Riwayat Pendidikan</label><textarea name="riwayat_pendidikan" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm">{{ $biodata?->riwayat_pendidikan }}</textarea></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Pengalaman Organisasi</label><textarea name="pengalaman_organisasi" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm">{{ $biodata?->pengalaman_organisasi }}</textarea></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Prestasi</label><textarea name="prestasi" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm">{{ $biodata?->prestasi }}</textarea></div>
                    </div>
                    @if(!$isLocked) <div class="mt-8 text-right"><button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition">Simpan Biodata</button></div> @endif
                </form>
            </div>

            <div x-show="activeTab === 'rekomendasi'" x-transition.opacity style="display: none;">
                <div class="mb-8 border-b border-slate-100 pb-4"><h3 class="text-2xl font-extrabold text-slate-800">Surat Rekomendasi</h3></div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf <input type="hidden" name="section" value="rekomendasi">
                    <div class="grid grid-cols-1 gap-6">
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Nama Tokoh/Akademisi</label><input type="text" name="nama_perekomendasi" value="{{ $rekomendasi?->nama_perekomendasi }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Instansi & Jabatan</label><div class="flex gap-2"><input type="text" name="instansi_perekomendasi" value="{{ $rekomendasi?->instansi_perekomendasi }}" placeholder="Instansi" class="w-1/2 px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm"><input type="text" name="jabatan_perekomendasi" value="{{ $rekomendasi?->jabatan_perekomendasi }}" placeholder="Jabatan" class="w-1/2 px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm"></div></div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">File Surat Rekomendasi</label>
                            @if($rekomendasi?->file_rekomendasi) <p class="mb-2"><a href="{{ asset('storage/' . $rekomendasi->file_rekomendasi) }}" target="_blank" class="text-blue-600 font-semibold text-sm hover:underline">📄 Lihat Rekomendasi</a></p> @endif
                            @if(!$isLocked) <input type="file" name="file_rekomendasi" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"> @endif
                        </div>
                    </div>
                    @if(!$isLocked) <div class="mt-8 text-right"><button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition">Simpan Rekomendasi</button></div> @endif
                </form>
            </div>

            <div x-show="activeTab === 'essay'" x-transition.opacity style="display: none;">
                <div class="mb-8 border-b border-slate-100 pb-4"><h3 class="text-2xl font-extrabold text-slate-800">Essay Kontribusi</h3></div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf <input type="hidden" name="section" value="essay">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Rencana Kontribusi untuk Indonesia (1500 - 2000 Kata)</label>
                        <textarea name="essay_kontribusi" rows="15" required class="w-full px-5 py-4 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm leading-relaxed">{{ $essay?->essay_kontribusi }}</textarea>
                    </div>
                    @if(!$isLocked) <div class="mt-8 text-right"><button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition">Simpan Essay</button></div> @endif
                </form>
            </div>

        </fieldset>
    </div>
</div>
@endsection