<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Pendaftaran REG-{{ str_pad($userProfile->id, 5, '0', STR_PAD_LEFT) }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: white !important;
                color: black !important;
            }
            .print-card {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
            }
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased p-4 sm:p-8">

    <!-- Top Action Bar (Hidden on Print) -->
    <div class="max-w-4xl mx-auto mb-6 no-print flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
        <a href="{{ route('riwayat.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Riwayat
        </a>
        <button onclick="window.print()" class="px-5 py-2.5 bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-orange-100 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak / Simpan PDF
        </button>
    </div>

    <!-- Main Printable Content -->
    <div class="max-w-4xl mx-auto bg-white border border-slate-200 rounded-3xl p-8 sm:p-12 shadow-sm print-card">
        
        <!-- Header Kop Surat -->
        <div class="flex items-center justify-between border-b-4 border-double border-slate-900 pb-6 mb-8">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center text-white font-black text-3xl shadow-md no-print">
                    L
                </div>
                <div>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">TUBEL<span class="text-orange-500">App</span></h1>
                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Portal Pendaftaran Beasiswa Tugas Belajar</p>
                </div>
            </div>
            <div class="text-right">
                <span class="inline-block px-3 py-1 bg-slate-100 text-slate-800 font-bold text-xs rounded-full border border-slate-200">
                    KARTU PENDAFTARAN
                </span>
                <span class="block text-sm font-bold text-slate-800 mt-2">
                    REG-{{ str_pad($userProfile->id, 5, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>

        <div class="space-y-8">
            
            <!-- Ringkasan Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 p-5 rounded-2xl border border-slate-200">
                <div>
                    <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider">Program Pilihan</span>
                    <p class="text-lg font-bold text-orange-600 capitalize mt-1">Beasiswa {{ $userProfile->program_beasiswa ?? '-' }}</p>
                </div>
                <div>
                    <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider">Kategori Jalur</span>
                    <p class="text-lg font-bold text-slate-800 capitalize mt-1">{{ $userProfile->kategori ?? '-' }}</p>
                </div>
            </div>

            <!-- TAHAP 1: DATA PRIBADI -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest border-b border-slate-200 pb-2 mb-4">1. Data Diri & Pribadi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-6 text-sm">
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Nama Lengkap</span><span class="font-semibold text-slate-800 text-right">{{ $userProfile->nama ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">NIK (Nomor Induk Kependudukan)</span><span class="font-semibold text-slate-800 text-right">{{ $userProfile->nik ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Tempat, Tanggal Lahir</span><span class="font-semibold text-slate-800 text-right">{{ $userProfile->tempat_tglLahir ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">No. WhatsApp / HP</span><span class="font-semibold text-slate-800 text-right">{{ $userProfile->no_telp ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Agama</span><span class="font-semibold text-slate-800 text-right">{{ $userProfile->agama ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Status Perkawinan</span><span class="font-semibold text-slate-800 text-right">{{ $userProfile->status_perkawinan ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Pekerjaan</span><span class="font-semibold text-slate-800 text-right">{{ $userProfile->pekerjaan ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Kewarganegaraan</span><span class="font-semibold text-slate-800 text-right">{{ $userProfile->kewarganegaraan ?? '-' }}</span></div>
                    <div class="md:col-span-2 flex flex-col py-1"><span class="text-slate-500">Alamat Lengkap</span><span class="font-semibold text-slate-800 mt-1">{{ $userProfile->alamat ?? '-' }}, RT {{ $userProfile->rt ?? '-' }}/RW {{ $userProfile->rw ?? '-' }}, Kel. {{ $userProfile->kelurahan ?? '-' }}, Kec. {{ $userProfile->kecamatan ?? '-' }}</span></div>
                </div>
            </div>

            <!-- TAHAP 2: UNIT KERJA -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest border-b border-slate-200 pb-2 mb-4">2. Rincian Unit Kerja</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-6 text-sm">
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Unit Kerja Asal</span><span class="font-semibold text-slate-800 text-right">{{ $industri->unit_kerja ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Jabatan</span><span class="font-semibold text-slate-800 text-right">{{ $industri->jabatan ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Golongan Kepegawaian</span><span class="font-semibold text-slate-800 text-right">{{ $industri->golongan ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Tanggal Mulai Kerja</span><span class="font-semibold text-slate-800 text-right">{{ $industri->tanggal_mulai_kerja ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Estimasi Tanggal Pensiun</span><span class="font-semibold text-slate-800 text-right">{{ $industri->tanggal_pensiun ?? '-' }}</span></div>
                </div>
            </div>

            <!-- TAHAP 3: UNIVERSITAS TUJUAN -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest border-b border-slate-200 pb-2 mb-4">3. Universitas & Program Studi Tujuan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-6 text-sm">
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Nama Universitas</span><span class="font-semibold text-slate-800 text-right">{{ $universitas->nama_universitas ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Program Studi Pilihan</span><span class="font-semibold text-slate-800 text-right">{{ $universitas->program_studi ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Lokasi Kampus (Kota)</span><span class="font-semibold text-slate-800 text-right">{{ $universitas->kota ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Rencana Mulai Studi</span><span class="font-semibold text-slate-800 text-right">{{ $universitas->tanggal_mulai_studi ?? '-' }}</span></div>
                    <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Rencana Durasi Studi</span><span class="font-semibold text-slate-800 text-right">{{ $universitas->durasi_studi ?? '-' }} Bulan</span></div>
                </div>
            </div>

            <div class="page-break"></div>

            <!-- TAHAP 4: SURAT REKOMENDASI -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest border-b border-slate-200 pb-2 mb-4">4. Keterangan Surat Rekomendasi</h3>
                @if($rekomendasi && $rekomendasi->nama_perekomendasi)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-6 text-sm">
                        <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Kategori Rekomendasi</span><span class="font-semibold text-slate-800 text-right">{{ $rekomendasi->kategori ?? '-' }}</span></div>
                        <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Nama Pemberi Rekomendasi</span><span class="font-semibold text-slate-800 text-right">{{ $rekomendasi->nama_perekomendasi ?? '-' }}</span></div>
                        <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Asal Instansi</span><span class="font-semibold text-slate-800 text-right">{{ $rekomendasi->instansi_perekomendasi ?? '-' }}</span></div>
                        <div class="flex justify-between py-1 border-b border-slate-100"><span class="text-slate-500">Jabatan</span><span class="font-semibold text-slate-800 text-right">{{ $rekomendasi->jabatan_perekomendasi ?? '-' }}</span></div>
                    </div>
                @else
                    <p class="text-sm text-slate-500 italic">Pengaju memilih untuk tidak menyertakan Surat Rekomendasi.</p>
                @endif
            </div>

            <!-- TAHAP 5: ESSAY KONTRIBUSI -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest border-b border-slate-200 pb-2 mb-4">5. Esai Rencana Kontribusi</h3>
                <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200 text-sm leading-relaxed text-slate-800 whitespace-pre-wrap font-medium">
                    {{ $essay->essay_kontribusi ?? '- Esai belum ditulis -' }}
                </div>
            </div>

            <!-- Tanda Tangan & Pernyataan -->
            <div class="pt-10">
                <div class="flex justify-between items-start text-sm">
                    <div>
                        <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider">Tanggal Pengiriman</span>
                        <p class="font-semibold text-slate-800 mt-1">{{ $userProfile->submitted_at ? $userProfile->submitted_at->translatedFormat('d F Y, H:i') . ' WIB' : now()->translatedFormat('d F Y, H:i') . ' WIB' }}</p>
                    </div>
                    <div class="text-center w-64">
                        <p class="text-slate-600 font-semibold mb-20">Pendaftar Beasiswa,</p>
                        <div class="border-b border-slate-400 w-full mx-auto"></div>
                        <p class="font-bold text-slate-800 mt-2">{{ $userProfile->nama ?? Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500">NIK. {{ $userProfile->nik ?? '-' }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Automatically open print dialog -->
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
