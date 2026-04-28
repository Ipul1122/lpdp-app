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
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-orange-500/30">
                        L
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-800">TUBEL<span class="text-orange-500">App</span></span>
                </div>

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
                        <a href="{{ route('panduan') }}" class="w-full sm:w-auto bg-white hover:bg-slate-50 text-slate-700 font-bold py-4 px-8 rounded-2xl border border-slate-200 transition text-lg flex items-center justify-center gap-2">
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

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-slate-100 text-slate-600 rounded-2xl flex items-center justify-center font-bold text-xl mb-4">1</div>
                        <h3 class="font-bold text-slate-800 mb-2">Data KTP</h3>
                        <p class="text-sm text-slate-500">Validasi NIK dan identitas diri dasar.</p>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-slate-100 text-slate-600 rounded-2xl flex items-center justify-center font-bold text-xl mb-4">2</div>
                        <h3 class="font-bold text-slate-800 mb-2">Industri</h3>
                        <p class="text-sm text-slate-500">Detail instansi dan status kepegawaian.</p>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-slate-100 text-slate-600 rounded-2xl flex items-center justify-center font-bold text-xl mb-4">3</div>
                        <h3 class="font-bold text-slate-800 mb-2">Universitas</h3>
                        <p class="text-sm text-slate-500">Pilihan kampus tujuan dan unggah LoA.</p>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-slate-100 text-slate-600 rounded-2xl flex items-center justify-center font-bold text-xl mb-4">4+</div>
                        <h3 class="font-bold text-slate-800 mb-2">Profil & Essay</h3>
                        <p class="text-sm text-slate-500">Lengkapi esai kontribusi dan surat rekomendasi.</p>
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