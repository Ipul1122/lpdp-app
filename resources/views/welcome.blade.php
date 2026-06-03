<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pendaftaran Beasiswa TUBEL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased selection:bg-orange-500 selection:text-white flex flex-col min-h-screen">

    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-95 transition-opacity">
                    <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-orange-500/30">
                        L
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-800">TUBEL<span class="text-orange-500">App</span></span>
                </a>

                <div class="flex items-center gap-4">
                    
                    <div class="h-6 w-px bg-slate-200 hidden md:block mx-2"></div>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-slate-800 hover:bg-slate-900 text-white text-sm font-bold py-2.5 px-6 rounded-full transition shadow-lg shadow-slate-200">
                                Ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-orange-500 transition px-2">Masuk</a>
                            <a href="{{ route('register') }}" class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-bold py-2.5 px-6 rounded-full transition shadow-lg shadow-orange-200">
                                Daftar Sekarang
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mt-10 md:mt-20">
                
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-orange-100 text-orange-600 font-semibold text-xs mb-6 border border-orange-200">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                    Pendaftaran Tahun 2026 Telah Dibuka
                </div>

                <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight mb-6">
                    Wujudkan Mimpimu dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-amber-500">Beasiswa TUBEL </span>
                </h1>
                
                <p class="text-lg text-slate-500 mb-10 leading-relaxed max-w-2xl mx-auto">
                    Platform pendaftaran terintegrasi yang memudahkan langkahmu menggapai pendidikan tinggi. Proses transparan, mudah, dan terstruktur dalam 7 tahapan yang jelas.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ route('pendaftaran.index') }}" class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-8 rounded-2xl transition shadow-xl shadow-orange-200 text-lg flex items-center justify-center gap-2">
                            Lanjutkan Pendaftaran <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-8 rounded-2xl transition shadow-xl shadow-orange-200 text-lg flex items-center justify-center gap-2">
                            Mulai Perjalananmu <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="{{ route('syarat.pendaftaran') }}" class="w-full sm:w-auto bg-white hover:bg-slate-50 text-slate-700 font-bold py-4 px-8 rounded-2xl border border-slate-200 transition text-lg flex items-center justify-center gap-2">
                            Pelajari Syaratnya
                        </a>
                    @endauth
                </div>
            </div>

            <div class="mt-24 md:mt-32">
                <div class="text-center mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800">Proses Pendaftaran 7 Langkah</h2>
                    <p class="text-slate-500 mt-2">Sistem kami dirancang agar Anda bisa melengkapi dokumen secara bertahap tanpa takut kehilangan data (Auto-Save).</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- Langkah 1 -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md hover:border-orange-100 transition duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center font-extrabold text-xl shadow-inner">1</div>
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 014 0m-6 8a2 2 0 100-4 2 2 0 000 4zm5.334-1.334a3.334 3.334 0 00-3.334 3.334h6.668a3.334 3.334 0 00-3.334-3.334z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 mb-2">Registrasi Data</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Pengisian data diri dasar, NIK, pemilihan jenjang beasiswa (S1/S2/Spesialis), serta unggah foto KTP.</p>
                        </div>
                    </div>

                    <!-- Langkah 2 -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md hover:border-orange-100 transition duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center font-extrabold text-xl shadow-inner">2</div>
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 mb-2">Data Industri</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Rincian instansi asal, jabatan, status kepegawaian, dan unggah surat rekomendasi/izin kerja dari instansi.</p>
                        </div>
                    </div>

                    <!-- Langkah 3 -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md hover:border-orange-100 transition duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center font-extrabold text-xl shadow-inner">3</div>
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 mb-2">Universitas</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Pemilihan negara, kota, nama kampus, program studi tujuan, serta unggah berkas kelulusan (LoA) & KHS/IPK.</p>
                        </div>
                    </div>

                    <!-- Langkah 4 -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md hover:border-orange-100 transition duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center font-extrabold text-xl shadow-inner">4</div>
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 mb-2">Profil & Biodata</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Kelengkapan deskripsi diri, riwayat pendidikan, riwayat kerja/organisasi, list prestasi, keahlian, dan bahasa.</p>
                        </div>
                    </div>

                    <!-- Langkah 5 -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md hover:border-orange-100 transition duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center font-extrabold text-xl shadow-inner">5</div>
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 mb-2">Surat Rekomendasi</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Pengisian identitas pemberi rekomendasi (akademisi/pimpinan) dan unggah berkas surat rekomendasi resmi.</p>
                        </div>
                    </div>

                    <!-- Langkah 6 -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md hover:border-orange-100 transition duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center font-extrabold text-xl shadow-inner">6</div>
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 mb-2">Esai Kontribusi</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Menulis esai komitmen kembali ke Indonesia, rencana studi, dan rencana kontribusi pasca studi (1500 - 2000 kata).</p>
                        </div>
                    </div>

                    <!-- Langkah 7 (Highlighted) -->
                    <div class="bg-gradient-to-br from-orange-500 to-amber-500 text-white p-6 rounded-3xl shadow-lg shadow-orange-500/20 hover:shadow-xl hover:shadow-orange-500/30 transition duration-300 flex flex-col justify-between col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-2">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-white/20 text-white rounded-2xl flex items-center justify-center font-extrabold text-xl shadow-inner">7</div>
                                <svg class="w-6 h-6 text-orange-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            </div>
                            <h3 class="font-bold text-white mb-2 text-lg">Ringkasan & Kirim Final</h3>
                            <p class="text-sm text-orange-50 leading-relaxed">Melakukan peninjauan akhir (review) menyeluruh terhadap semua berkas dan data dari Tahap 1 sampai 6, menyetujui pernyataan kebenaran data, lalu mengirimkan pendaftaran secara final dan aman.</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-10 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-slate-800 rounded-lg flex items-center justify-center text-white font-bold text-sm">L</div>
                <span class="font-bold text-slate-800">TUBEL App</span>
            </div>
            <p class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} Sistem Pendaftaran Beasiswa. Seluruh hak cipta dilindungi.
            </p>
        </div>
    </footer>

</body>
</html>