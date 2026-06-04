@extends('layouts.app')

@section('title', 'Riwayat Pendaftaran')

@section('content')
<div class="max-w-6xl mx-auto mt-8 px-4 mb-20">

    <nav class="flex items-center text-sm font-medium text-slate-500 mb-8">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        <a href="{{ route('dashboard') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
        <svg class="w-4 h-4 mx-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-800">Riwayat Pendaftaran</span>
    </nav>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">Riwayat</h1>
        <p class="text-slate-500">Pantau status dan riwayat pendaftaran beasiswa Anda di sini.</p>
    </div>

    <div class="flex items-center space-x-8 border-b border-slate-200 mb-6">
        <button class="flex items-center gap-2 pb-4 text-orange-500 font-semibold border-b-2 border-orange-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Riwayat Pendaftaran
        </button>
    </div>

    <div class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden min-h-[400px] flex flex-col">
        
        <div class="grid grid-cols-5 gap-4 p-6 bg-slate-50 border-b border-slate-100 text-sm font-semibold text-slate-600">
            <div>Kode Registrasi</div>
            <div>Program Pilihan</div>
            <div>Waktu Direspon</div>
            <div>Waktu Submit</div>
            <div>Status Pendaftaran</div>
        </div>

       <div class="flex-1 flex flex-col" x-data="{ detailOpen: false }">
            
            @if($riwayatProfil)
                <div class="grid grid-cols-5 gap-4 p-6 border-b border-slate-50 items-center text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                    
                    <div class="font-bold text-slate-800">
                        REG-{{ str_pad($riwayatProfil->id, 5, '0', STR_PAD_LEFT) }}
                    </div>
                    
                    <div class="capitalize font-medium">
                        Beasiswa {{ $riwayatProfil->program_beasiswa ?? 'Belum Memilih' }}
                    </div>
                    
                    <div>
                        @if($riwayatProfil->responded_at)
                            <div class="text-slate-800 font-medium">
                                {{ $riwayatProfil->responded_at->format('d M Y, H:i') }} WIB
                            </div>
                        @else
                            <div class="text-slate-400 italic text-xs flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Menunggu respon
                            </div>
                        @endif
                    </div>
                    
                    <div>
                        @if($riwayatProfil->submitted_at)
                            <div class="text-slate-800 font-medium">
                                {{ $riwayatProfil->submitted_at->format('d M Y, H:i') }} WIB
                            </div>
                            @if($riwayatProfil->is_pengajuan_ulang)
                                <span class="block text-[10px] text-orange-500 font-bold mt-0.5">(Revisi / Pengajuan Ulang)</span>
                            @endif
                        @else
                            <div class="text-slate-800 font-medium">
                                {{ $riwayatProfil->created_at->format('d M Y, H:i') }} WIB
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex flex-col items-start gap-2">
                        @php
                            $statusColor = match($riwayatProfil->status) {
                                'pending'  => 'bg-amber-100 text-amber-700 border-amber-200',
                                'diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'diterima' => 'bg-green-100 text-green-700 border-green-200',
                                'ditolak'  => 'bg-red-100 text-red-700 border-red-200',
                                default    => 'bg-slate-100 text-slate-700 border-slate-200',
                            };
                        @endphp

                        <span class="{{ $statusColor }} px-3 py-1 rounded-full text-xs font-bold border capitalize">
                            {{ $riwayatProfil->status }}
                        </span>

                        {{-- Button to toggle detail & download PDF --}}
                        <div class="flex flex-wrap gap-2 mt-1">
                            <button type="button" @click="detailOpen = !detailOpen" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-800 text-white text-xs font-semibold rounded-lg hover:bg-slate-900 transition shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Detail Pengisian
                            </button>
                            
                            <a href="{{ route('pendaftaran.summary.pdf') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-orange-500 text-white text-xs font-semibold rounded-lg hover:bg-orange-600 transition shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                Unduh PDF
                            </a>
                        </div>

                        {{-- Fitur jika ditolak: Tampilkan alasan dan tombol Ajukan Ulang --}}
                        @if($riwayatProfil->status === 'ditolak')
                            <div class="mt-1 text-[11px] text-red-600 bg-red-50 p-2 rounded border border-red-100 w-full max-w-[150px]">
                                <span class="font-bold block mb-0.5">Alasan Penolakan:</span>
                                {{ $riwayatProfil->catatan ?? 'Tidak memenuhi kelengkapan berkas.' }}
                            </div>
                            
                            <a href="{{ route('pendaftaran.step1', ['action' => 'revisi']) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-orange-500 text-white text-xs font-semibold rounded-lg hover:bg-orange-600 transition shadow-sm mt-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Ajukan Ulang
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Collapsible Detail Panel --}}
                <div x-show="detailOpen" x-transition style="display: none;" class="p-6 border-t border-slate-200 bg-white space-y-4">
                    
                    @if($riwayatProfil->status === 'ditolak' && $riwayatProfil->catatan)
                        <div class="bg-red-50 border border-red-100 text-red-700 p-4 rounded-xl mb-4 text-sm">
                            <b>Riwayat Penolakan Admin:</b> {{ $riwayatProfil->catatan }}
                        </div>
                    @endif

                    <div x-data="{ tab1: true }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab1 = !tab1" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">1</span> Data Pribadi & KTP</span>
                            <svg :class="{'rotate-180': tab1}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab1" class="p-5 border-t border-slate-100 text-sm grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div><span class="block text-slate-400 text-xs mb-1">Kategori Pendaftaran</span><p class="font-bold text-orange-600">{{ $riwayatProfil->kategori ?? '-' }}</p></div>
                            <div><span class="block text-slate-400 text-xs mb-1">NIK</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->nik }}</p></div>
                            <div><span class="block text-slate-400 text-xs mb-1">Nama</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->nama }}</p></div>
                            <div><span class="block text-slate-400 text-xs mb-1">TTL</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->tempat_tglLahir }}</p></div>
                            <div><span class="block text-slate-400 text-xs mb-1">Telepon/WA</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->no_telp }}</p></div>
                            <div class="col-span-2"><span class="block text-slate-400 text-xs mb-1">Alamat</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->alamat }}, RT {{ $riwayatProfil->rt }}/RW {{ $riwayatProfil->rw }}, {{ $riwayatProfil->kelurahan }}, {{ $riwayatProfil->kecamatan }}</p></div>
                            <div>
                                <span class="block text-slate-400 text-xs mb-1">Pas Foto 3x4</span>
                                @if($riwayatProfil->pas_foto) <a href="{{ asset('storage/' . $riwayatProfil->pas_foto) }}" target="_blank" class="text-blue-600 hover:underline font-semibold flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Lihat Pas Foto</a> @else <span class="text-red-500">Tidak ada</span> @endif
                            </div>
                            <div>
                                <span class="block text-slate-400 text-xs mb-1">Dokumen KTP</span>
                                @if($riwayatProfil->foto_ktp) <a href="{{ asset('storage/' . $riwayatProfil->foto_ktp) }}" target="_blank" class="text-blue-600 hover:underline font-semibold flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Lihat Foto KTP</a> @else <span class="text-red-500">Tidak ada</span> @endif
                            </div>
                        </div>
                    </div>

                    <div x-data="{ tab2: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab2 = !tab2" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">2</span> Unit Kerja</span>
                            <svg :class="{'rotate-180': tab2}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab2" style="display:none;" class="p-5 border-t border-slate-100 text-sm grid grid-cols-1 md:grid-cols-3 gap-4">
                            @if($riwayatProfil->industri)
                                <div><span class="block text-slate-400 text-xs mb-1">Unit Kerja</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->industri->unit_kerja ?? '-' }}</p></div>
                                <div><span class="block text-slate-400 text-xs mb-1">Jabatan</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->industri->jabatan ?? '-' }}</p></div>
                                <div><span class="block text-slate-400 text-xs mb-1">Golongan</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->industri->golongan ?? '-' }}</p></div>
                                <div><span class="block text-slate-400 text-xs mb-1">Tanggal Pensiun</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->industri->tanggal_pensiun ?? '-' }}</p></div>
                            @else <p class="text-slate-500 italic col-span-3">Data belum diisi.</p> @endif
                        </div>
                    </div>

                    <div x-data="{ tab3: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab3 = !tab3" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">3</span> Universitas Tujuan</span>
                            <svg :class="{'rotate-180': tab3}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab3" style="display:none;" class="p-5 border-t border-slate-100 text-sm grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($riwayatProfil->universitas)
                                <div><span class="block text-slate-400 text-xs mb-1">Universitas</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->universitas->nama_universitas ?? '-' }}</p></div>
                                <div><span class="block text-slate-400 text-xs mb-1">Program Studi</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->universitas->program_studi ?? '-' }}</p></div>
                                <div><span class="block text-slate-400 text-xs mb-1">Lokasi Kampus (Kota)</span><p class="font-semibold text-slate-800">{{ $riwayatProfil->universitas->kota ?? '-' }}</p></div>
                                <div><span class="block text-slate-400 text-xs mb-1">Rencana Studi</span><p class="font-semibold text-slate-800">Mulai: {{ $riwayatProfil->universitas->tanggal_mulai_studi ?? '-' }} ({{ $riwayatProfil->universitas->durasi_studi ?? '-' }} Bulan)</p></div>
                                <div>
                                    <span class="block text-slate-400 text-xs mb-1">LoA / Bukti Lulus</span>
                                    @if($riwayatProfil->universitas->loa) <a href="{{ asset('storage/' . $riwayatProfil->universitas->loa) }}" target="_blank" class="text-blue-600 hover:underline font-semibold inline-flex items-center gap-1">📄 Lihat Dokumen LoA</a> @else <span class="text-slate-500">-</span> @endif
                                </div>
                                <div>
                                    <span class="block text-slate-400 text-xs mb-1">KHS / Bukti IPK</span>
                                    @if($riwayatProfil->universitas->khs_ipk) <a href="{{ asset('storage/' . $riwayatProfil->universitas->khs_ipk) }}" target="_blank" class="text-blue-600 hover:underline font-semibold inline-flex items-center gap-1">📄 Lihat KHS/IPK</a> @else <span class="text-slate-500">-</span> @endif
                                </div>
                            @else <p class="text-slate-500 italic col-span-2">Data belum diisi.</p> @endif
                        </div>
                    </div>

                    <div x-data="{ tab4: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab4 = !tab4" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">4</span> Surat Rekomendasi</span>
                            <svg :class="{'rotate-180': tab4}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab4" style="display:none;" class="p-5 border-t border-slate-100 text-sm">
                            @if($riwayatProfil->rekomendasi && $riwayatProfil->rekomendasi->file_rekomendasi)
                                <p class="mb-2"><b>Kategori Rekomendasi:</b> {{ $riwayatProfil->rekomendasi->kategori ?? '-' }}</p>
                                <p class="mb-2"><b>Perekomendasi:</b> {{ $riwayatProfil->rekomendasi->nama_perekomendasi ?? '-' }} ({{ $riwayatProfil->rekomendasi->jabatan_perekomendasi ?? '-' }} - {{ $riwayatProfil->rekomendasi->instansi_perekomendasi ?? '-' }})</p>
                                <a href="{{ asset('storage/' . $riwayatProfil->rekomendasi->file_rekomendasi) }}" target="_blank" class="text-blue-600 hover:underline font-semibold inline-flex items-center gap-1">📄 Lihat Surat Rekomendasi</a>
                            @else
                                <p class="text-red-500 font-bold italic">(TIDAK DAPAT REKOMENDASI)</p>
                            @endif
                        </div>
                    </div>

                    <div x-data="{ tab5: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab5 = !tab5" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">5</span> Essay Kontribusi</span>
                            <svg :class="{'rotate-180': tab5}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab5" style="display:none;" class="p-5 border-t border-slate-100 text-sm">
                            @if($riwayatProfil->essay)
                                <div class="bg-slate-50 p-4 rounded-xl leading-relaxed whitespace-pre-wrap font-medium text-slate-700 max-h-60 overflow-y-auto">{{ $riwayatProfil->essay->essay_kontribusi }}</div>
                            @else <p class="text-slate-500 italic">Data belum diisi.</p> @endif
                        </div>
                    </div>

                    <div x-data="{ tab6: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab6 = !tab6" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">6</span> Surat Komitmen</span>
                            <svg :class="{'rotate-180': tab6}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab6" style="display:none;" class="p-5 border-t border-slate-100 text-sm">
                            @if($riwayatProfil->surat_komitmen)
                                <a href="{{ asset('storage/' . $riwayatProfil->surat_komitmen) }}" target="_blank" class="text-blue-600 hover:underline font-semibold inline-flex items-center gap-1">📄 Lihat Surat Komitmen</a>
                            @else
                                <p class="text-slate-500 italic">Belum diunggah.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="flex-1 flex flex-col items-center justify-center p-12 text-slate-300">
                    <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-slate-400 font-medium text-lg">Belum ada riwayat pendaftaran</p>
                    <a href="{{ route('pendaftaran.index') }}" class="mt-4 px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition">Mulai Pendaftaran</a>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection