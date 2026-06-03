<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat Pendaftaran - Portal Pendaftaran Beasiswa TUBEL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased selection:bg-orange-500 selection:text-white flex flex-col min-h-screen">

    <!-- Navbar -->
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

    <!-- Main Content -->
    <main class="flex-grow pt-32 pb-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-orange-100 text-orange-500 mb-6 shadow-sm border border-orange-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Syarat & Ketentuan Pendaftaran</h1>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg leading-relaxed">Pastikan Anda memenuhi seluruh kriteria dan mempersiapkan dokumen yang diperlukan sebelum memulai proses pendaftaran beasiswa TUBEL.</p>
            </div>

            <!-- Grid Ketentuan Umum & Akademis -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Ketentuan Umum -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
                        <div class="w-10 h-10 bg-orange-500 text-white rounded-xl flex items-center justify-center shadow-md shadow-orange-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Persyaratan Umum</h3>
                    </div>
                    <ul class="space-y-4 text-slate-600">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Warga Negara Indonesia (WNI) yang setia pada NKRI.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Merupakan Aparatur Sipil Negara (ASN), TNI, POLRI, atau Pegawai Swasta aktif.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Mendapatkan persetujuan/rekomendasi tertulis dari pimpinan instansi atau perusahaan asal.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Sehat jasmani, rohani, dan bebas narkoba (dibuktikan dengan surat keterangan kesehatan saat kelulusan).</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Tidak sedang menjalani sanksi disiplin atau proses hukum pidana.</span>
                        </li>
                    </ul>
                </div>

                <!-- Persyaratan Akademis -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
                        <div class="w-10 h-10 bg-slate-800 text-white rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Persyaratan Akademis</h3>
                    </div>
                    <ul class="space-y-4 text-slate-600">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Memiliki Letter of Acceptance (LoA) Unconditional dari perguruan tinggi terakreditasi yang masuk dalam daftar mitra.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>IPK minimal dari jenjang pendidikan sebelumnya:
                                <ul class="mt-2 space-y-1 pl-4 list-disc text-sm text-slate-500">
                                    <li>Pendaftaran S1: Rata-rata Nilai Rapor/Ijazah &ge; 80.00</li>
                                    <li>Pendaftaran S2: IPK &ge; 3.00 pada skala 4.00</li>
                                    <li>Pendaftaran Spesialis: IPK &ge; 3.25 pada skala 4.00</li>
                                </ul>
                            </span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Memenuhi persyaratan bahasa asing (TOEFL/IELTS) sesuai dengan syarat minimum program studi tujuan.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Dokumen yang Wajib Diunggah -->
            <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm mb-12 hover:shadow-md transition duration-300">
                <div class="flex items-center gap-4 mb-8 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 bg-amber-500 text-white rounded-xl flex items-center justify-center shadow-md shadow-amber-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Berkas & Dokumen Wajib</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Doc 1 -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex items-start gap-4">
                        <div class="p-2.5 bg-blue-100 text-blue-600 rounded-xl shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 014 0m-6 8a2 2 0 100-4 2 2 0 000 4zm5.334-1.334a3.334 3.334 0 00-3.334 3.334h6.668a3.334 3.334 0 00-3.334-3.334z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Kartu Tanda Penduduk</h4>
                            <p class="text-xs text-slate-500 mt-1">Scan KTP asli format JPG/PNG dengan resolusi jelas.</p>
                        </div>
                    </div>

                    <!-- Doc 2 -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex items-start gap-4">
                        <div class="p-2.5 bg-indigo-100 text-indigo-600 rounded-xl shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2v8a2 2 0 002-2V10z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Surat Izin Instansi</h4>
                            <p class="text-xs text-slate-500 mt-1">Surat resmi dari instansi asal (format PDF, maks 2MB).</p>
                        </div>
                    </div>

                    <!-- Doc 3 -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex items-start gap-4">
                        <div class="p-2.5 bg-emerald-100 text-emerald-600 rounded-xl shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">LoA Unconditional</h4>
                            <p class="text-xs text-slate-500 mt-1">Surat penerimaan perguruan tinggi tanpa syarat (PDF).</p>
                        </div>
                    </div>

                    <!-- Doc 4 -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex items-start gap-4">
                        <div class="p-2.5 bg-purple-100 text-purple-600 rounded-xl shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Transkrip Nilai / KHS</h4>
                            <p class="text-xs text-slate-500 mt-1">Transkrip akademik jenjang sebelumnya / KHS terakhir.</p>
                        </div>
                    </div>

                    <!-- Doc 5 -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex items-start gap-4">
                        <div class="p-2.5 bg-rose-100 text-rose-600 rounded-xl shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m16-10a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Surat Rekomendasi</h4>
                            <p class="text-xs text-slate-500 mt-1">Surat rekomendasi dari akademisi atau tokoh masyarakat.</p>
                        </div>
                    </div>

                    <!-- Doc 6 -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 flex items-start gap-4">
                        <div class="p-2.5 bg-orange-100 text-orange-600 rounded-xl shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Esai Kontribusi</h4>
                            <p class="text-xs text-slate-500 mt-1">Esai rencana studi dan kontribusi pasca studi (1500-2000 kata).</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-slate-900 text-white rounded-3xl p-10 text-center shadow-xl relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-orange-500/20 rounded-full blur-3xl pointer-events-none"></div>
                
                <h3 class="text-2xl font-bold mb-3 relative z-10">Sudah Siap Melakukan Pendaftaran?</h3>
                <p class="text-slate-400 mb-8 relative z-10 max-w-2xl mx-auto leading-relaxed">Persiapkan seluruh dokumen di atas, kemudian buat akun atau masuk untuk memulai langkah pendaftaran Anda.</p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 relative z-10">
                    @auth
                        <a href="{{ route('pendaftaran.index') }}" class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-10 rounded-xl transition shadow-lg shadow-orange-500/30 text-lg w-full sm:w-auto justify-center">
                            Lanjutkan Pendaftaran
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-10 rounded-xl transition shadow-lg shadow-orange-500/30 text-lg w-full sm:w-auto justify-center">
                            Mulai Daftar Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-bold py-4 px-10 rounded-xl transition border border-white/20 text-lg w-full sm:w-auto justify-center">
                            Masuk ke Akun
                        </a>
                    @endauth
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
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
