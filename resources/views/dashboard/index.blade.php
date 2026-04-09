@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="max-w-6xl mx-auto space-y-8">
        
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl p-8 md:p-10 text-white shadow-xl flex flex-col md:flex-row items-center justify-between relative overflow-hidden">
            <div class="md:w-3/4 z-10">
                <h2 class="text-3xl font-bold mb-3">Lengkapi Profil & CV Sebelum Mendaftar</h2>
                <p class="text-orange-50 mb-8 leading-relaxed text-sm md:text-base pr-4">
                    Profil dan CV wajib dilengkapi untuk melanjutkan pendaftaran beasiswa. Isi data dirimu agar kami dapat menampilkan syarat dan program yang paling sesuai. Jika data dirimu sudah lengkap, silakan lanjutkan ke tahap pendaftaran.
                </p>
                <button class="bg-white text-orange-600 font-bold px-6 py-3 rounded-full hover:bg-orange-50 transition shadow-lg inline-flex items-center text-sm">
                    Lengkapi Profil Sekarang &rarr;
                </button>
            </div>
            
            <div class="hidden md:flex md:w-1/4 z-10 justify-end">
                <img src="https://api.dicebear.com/7.x/bottts/svg?seed=lpdp&backgroundColor=transparent" alt="Mascot" class="w-40 h-40 object-contain drop-shadow-2xl">
            </div>

            <div class="absolute right-0 top-0 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl transform translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
        </div>

        <div>
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                </svg>
                <h3 class="text-2xl font-bold text-slate-800">Beasiswa yang Sedang Dibuka</h3>
            </div>
            <p class="text-slate-500 mb-6 text-sm ml-10">Pilih program yang sesuai dengan jenjang pendidikan dan rencana studi kamu</p>

            <div class="grid grid-cols-1 gap-8">
                
                <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-200 shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-800">Sarjana</h4>
                            <span class="inline-block bg-orange-50 text-orange-600 text-xs font-bold px-3 py-1 rounded-full mt-1 border border-orange-100">Beasiswa Sarjana</span>
                        </div>
                    </div>

                    <p class="text-slate-600 text-sm mb-5">Sarjana program satu gelar (single degree/joint degree) atau dua gelar (double degree) selama masa studi.</p>
                    
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-3 text-sm text-slate-700">
                            <svg class="w-5 h-5 text-orange-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Beasiswa Garuda Sarjana, Beasiswa Talenta Indonesia</span>
                        </li>
                        <li class="flex items-start gap-3 text-sm text-slate-700">
                            <svg class="w-5 h-5 text-orange-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span><strong>Syarat:</strong> Beasiswa Garuda Sarjana (Umum : IELTS : 6,5 - iBT : 80, PTE: 58, ITP:500) - (Khusus : IQ : 110, SAT : ≥ 1.170)</span>
                        </li>
                    </ul>

                    <a href="{{ route('pendaftaran.create', ['program' => 'sarjana']) }}" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3.5 rounded-2xl transition shadow-lg shadow-orange-200 flex items-center justify-center gap-2 cursor-pointer">
                        Daftar Sekarang &rarr;
                    </a>
                </div>

                <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-200 shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-800">Magister (S2)</h4>
                            <span class="inline-block bg-blue-50 text-blue-600 text-xs font-bold px-3 py-1 rounded-full mt-1 border border-blue-100">Beasiswa Lanjutan</span>
                        </div>
                    </div>

                    <p class="text-slate-600 text-sm mb-5">Magister program satu gelar (single degree) paling lama 24 bulan untuk riset dan pengembangan keilmuan pada Bidang STEM dan SHARE.</p>
                    
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-3 text-sm text-slate-700">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Beasiswa Reguler S2, Beasiswa Perguruan Tinggi Utama Dunia (PTUD) S2</span>
                        </li>
                        <li class="flex items-start gap-3 text-sm text-slate-700">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span><strong>Syarat:</strong> IPK minimal 3.00. Kemampuan Bahasa Inggris (Dalam Negeri: TOEFL ITP 500 / Luar Negeri: IELTS 6.5 / iBT 80)</span>
                        </li>
                    </ul>

                    <a href="{{ route('pendaftaran.create', ['program' => 'magister']) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-2xl transition shadow-lg shadow-blue-200 flex items-center justify-center gap-2 cursor-pointer">
                        Daftar Magister S2 &rarr;
                    </a>
                </div>

                <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-md transition duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-200 shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-800">Dokter Spesialis & Subspesialis</h4>
                            <span class="inline-block bg-emerald-50 text-emerald-600 text-xs font-bold px-3 py-1 rounded-full mt-1 border border-emerald-100">Beasiswa Target</span>
                        </div>
                    </div>

                    <p class="text-slate-600 text-sm mb-5">Program pemenuhan tenaga kesehatan dan pendidik medis untuk profesi Dokter Spesialis dan Subspesialis di rumah sakit jejaring seluruh Indonesia.</p>
                    
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-3 text-sm text-slate-700">
                            <svg class="w-5 h-5 text-emerald-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Beasiswa Dokter Spesialis Kementerian Kesehatan/LPDP</span>
                        </li>
                        <li class="flex items-start gap-3 text-sm text-slate-700">
                            <svg class="w-5 h-5 text-emerald-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span><strong>Syarat:</strong> Memiliki STR (Surat Tanda Registrasi) yang masih berlaku. Berkomitmen mengabdi (n+1) tahun di wilayah yang ditentukan.</span>
                        </li>
                    </ul>

                    <a href="{{ route('pendaftaran.create', ['program' => 'dokter']) }}" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3.5 rounded-2xl transition shadow-lg shadow-emerald-200 flex items-center justify-center gap-2 cursor-pointer">
                        Daftar Spesialis &rarr;
                    </a>
                </div>

            </div>
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
                            <p class="font-medium text-lg text-slate-800">Halo, {{ Auth::user()->name ?? 'User' }}</p>
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
                        <div class="bg-gray-200 px-6 py-4 rounded-xl border border-gray-300 w-full max-w-sm">
                            <p class="text-orange-700 text-sm font-medium italic">"Pendidikan adalah senjata paling mematikan di dunia, karena dengan itu Anda bisa mengubah dunia."</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-slate-50 px-8 py-5 border-t border-slate-100 flex justify-between items-center shrink-0">
                <button x-show="step > 1" @click="step--" class="text-slate-500 font-semibold hover:text-orange-600 transition cursor-pointer px-4 py-2">
                    &larr; Kembali
                </button>
                <div x-show="step === 1"></div> 
                <button <a href="{{ route('pendaftaran.index') }}" @click="step < 3 ? step++ : document.getElementById('welcome-popover').remove()" 
                        class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2.5 px-8 rounded-xl shadow-lg shadow-orange-200 transition-all transform hover:-translate-y-0.5 cursor-pointer">
                    <span x-text="step < 3 ? 'Selanjutnya' : 'Lengkapi Profil Sekarang'"></span>
                </button>
            </div>
        </div>
    </div>
    @endif
@endsection