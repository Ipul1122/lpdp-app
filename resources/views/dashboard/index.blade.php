<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LPDP App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-sans">

    <div class="p-8 max-w-7xl mx-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-slate-800">Dashboard Utama</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-50 px-4 py-2 rounded-lg text-red-600 font-semibold hover:bg-red-100 transition">Keluar</button>
            </form>
        </div>
        
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 h-32">Status Pendaftaran</div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 h-32">Riwayat Dokumen</div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 h-32">Pengumuman</div>
        </div>
    </div>

    @if(session('show_welcome_popover'))
    <div x-data="{ step: 1 }" 
         id="welcome-popover" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-md">
        
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden w-full max-w-5xl flex flex-col max-h-[90vh]">
            
            <div class="bg-slate-50 px-8 py-4 border-b border-slate-100 flex items-center justify-center space-x-4 shrink-0">
                <template x-for="i in [1, 2, 3]">
                    <div class="flex items-center">
                        <div :class="step >= i ? 'bg-orange-600 text-white shadow-md' : 'bg-slate-200 text-slate-500'" 
                             class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300" 
                             x-text="i"></div>
                        <div x-show="i < 3" :class="step > i ? 'bg-orange-600' : 'bg-slate-200'" class="w-12 h-1 mx-2 rounded transition-colors duration-300"></div>
                    </div>
                </template>
            </div>

            <div class="flex-1 flex flex-col md:flex-row overflow-hidden bg-white">
                
                <div class="h-48 md:h-auto md:w-5/12 lg:w-1/2 flex-shrink-0 relative">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop" 
                         alt="Students" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-indigo-900/20"></div>
                </div>

                <div class="flex-1 overflow-y-auto relative p-8 md:p-10">
                    
                    <div x-show="step === 1" x-transition.opacity.duration.300ms>
                        <h2 class="text-3xl font-extrabold text-orange-600 mb-6">Selamat datang di LPDP</h2>
                        <div class="space-y-4 text-slate-700">
                            <p class="font-medium text-lg text-slate-800">Halo, {{ Auth::user()->name }}</p>
                            <p class="font-semibold text-orange-700">Selamat Datang Di Beasiswa LPDP</p>
                            <p>Program Beasiswa LPDP adalah skema beasiswa terintegrasi lintas kementrian yang dirancang untuk menyiapkan talenta unggul indonesia pada <strong>Bidang STEM Industri Strategis</strong> serta program <strong>SHARE</strong>.</p>
                            <ul class="list-disc pl-5 space-y-2 mt-4 text-slate-600 marker:text-orange-500">
                                <li>Jelajahi kurasi program berdasarkan 8 Bidang Prioritas</li>
                                <li>Pantau status pendaftaran secara terupdate</li>
                                <li>Akses panduan dan pembaruan kebijakan.</li>
                            </ul>
                        </div>
                    </div>

                    <div x-show="step === 2" x-transition.opacity.duration.300ms style="display: none;">
                        <h2 class="text-2xl font-bold text-slate-800 mb-4">Syarat & Ketentuan</h2>
                        <p class="text-sm text-slate-500 mb-4">Harap baca dengan teliti sebelum melanjutkan pendaftaran.</p>
                        
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-6 h-64 md:h-80 overflow-y-scroll text-slate-600 leading-relaxed text-sm pr-4">
                            <h3 class="font-bold text-slate-800 mb-2">1. Pendahuluan</h3>
                            <p class="mb-4 text-justify">Penerima Beasiswa LPDP wajib mematuhi seluruh ketentuan yang ditetapkan oleh Lembaga Pengelola Dana Pendidikan. Beasiswa ini bertujuan untuk menghasilkan pemimpin masa depan yang berintegritas. Segala bentuk pemalsuan dokumen akan mengakibatkan diskualifikasi permanen dan sanksi hukum.</p>
                            
                            <h3 class="font-bold text-slate-800 mb-2">2. Kewajiban Penerima</h3>
                            <p class="mb-4 text-justify">Penerima beasiswa wajib menyelesaikan studi tepat waktu sesuai dengan durasi yang ditetapkan dalam Letter of Guarantee (LoG). Setelah menyelesaikan studi, alumni wajib kembali ke Indonesia dan mengabdi di tanah air selama masa (n+1) tahun secara berturut-turut.</p>

                            <h3 class="font-bold text-slate-800 mb-2">3. Ketentuan Pendanaan</h3>
                            <p class="mb-4 text-justify">Dana pendidikan yang diberikan mencakup Dana Pendaftaran, Dana SPP/Tuition Fee, Dana Tunjangan Buku, Dana Penelitian Tesis/Disertasi, Dana Seminar Internasional, dan Dana Publikasi Jurnal Internasional sesuai dengan standar biaya yang berlaku.</p>

                            <h3 class="font-bold text-slate-800 mb-2">4. Pelaporan Akademik</h3>
                            <p class="mb-4 text-justify">Setiap semester, penerima beasiswa wajib mengunggah Laporan Perkembangan Studi (Logbook) yang telah disetujui oleh dosen pembimbing ke dalam portal ini. Kegagalan pelaporan dapat mengakibatkan penundaan atau pemberhentian pencairan dana hidup bulanan (Living Allowance).</p>
                        </div>
                    </div>

                    <div x-show="step === 3" x-transition.opacity.duration.300ms style="display: none;" class="flex flex-col items-center justify-center h-full text-center py-6">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-6 shadow-inner">
                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 mb-4">Langkah Terakhir</h2>
                        <p class="text-slate-600 max-w-sm mx-auto mb-8">
                            Lengkapi <strong>Profile & CV</strong> Anda untuk mulai mendaftar Beasiswa LPDP. Pastikan data pendidikan dan pengalaman kerja sudah sesuai dengan dokumen asli.
                        </p>
                        <div class="bg-gray-300 px-6 py-4 rounded-xl border border-indigo-100 w-full max-w-sm">
                            <p class="text-orange-700 text-sm font-medium italic">"Pendidikan adalah senjata paling mematikan di dunia, karena dengan itu Anda bisa mengubah dunia."</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-slate-50 px-8 py-5 border-t border-slate-100 flex justify-between items-center shrink-0">
                <button x-show="step > 1" @click="step--" class="text-slate-500 font-semibold hover:text-orange-600 transition cursor-pointer px-4 py-2">
                    &larr; Kembali
                </button>
                <div x-show="step === 1"></div> <button @click="step < 3 ? step++ : document.getElementById('welcome-popover').remove()" 
                        class="bg-orange-600 hover:bg-orange-600 text-white font-bold py-2.5 px-8 rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-0.5 cursor-pointer">
                    <span x-text="step < 3 ? 'Selanjutnya' : 'Lengkapi Profil Sekarang'"></span>
                </button>
            </div>
        </div>
    </div>
    @endif
</body>
</html>