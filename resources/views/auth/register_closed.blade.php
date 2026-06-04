<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Ditutup - TUBEL App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('storage/lpdp-icon.png') }}">
</head>
<body class="bg-slate-50 min-h-screen flex flex-col md:flex-row font-sans">

    <!-- Left Section: Sentences & Brand -->
    <div class="hidden md:flex md:w-1/2 lg:w-3/5 bg-gradient-to-tr from-orange-600 via-orange-500 to-amber-500 text-white p-12 lg:p-16 flex-col justify-between relative overflow-hidden">
        <!-- Background decorative pattern -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px]"></div>
        
        <!-- Logo -->
        <div class="relative z-10 flex items-center space-x-3">
            <div class="bg-white p-2.5 rounded-2xl shadow-sm">
                <img src="{{ asset('storage/lpdp-icon.png') }}" alt="Logo" class="w-8 h-8 object-contain">
            </div>
            <span class="text-2xl font-bold tracking-wider">TUBEL App</span>
        </div>

        <!-- Main text/sentences -->
        <div class="relative z-10 my-auto max-w-xl">
            <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight mb-6">
                Mulai Perjalanan Akademis Anda
            </h1>
            <p class="text-lg text-orange-50/90 leading-relaxed font-light mb-8">
                Daftarkan diri Anda sekarang untuk mengajukan beasiswa Tugas Belajar (TUBEL) secara online dengan alur yang mudah, cepat, dan transparan.
            </p>
            
            <div class="flex items-center space-x-4 bg-white/10 p-5 rounded-2xl border border-white/10 backdrop-blur-md">
                <div class="bg-orange-500/30 text-white rounded-full p-2.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-white">Proses Pendaftaran Mandiri</h3>
                    <p class="text-sm text-orange-100">Ikuti instruksi langkah-demi-langkah hingga selesai</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="relative z-10 text-sm text-orange-100/70">
            &copy; {{ date('Y') }} TUBEL App. Hak Cipta Dilindungi.
        </div>
    </div>

    <!-- Right Section: Closed Card -->
    <div class="w-full md:w-1/2 lg:w-2/5 flex items-center justify-center p-8 sm:p-12 md:p-16 bg-white min-h-screen">
        <div class="w-full max-w-md text-center">
            
            <!-- Mobile Header (Hidden on Desktop) -->
            <div class="flex items-center space-x-2 mb-8 md:hidden justify-center">
                <div class="bg-white border border-slate-100 p-2 rounded-xl shadow-sm">
                    <img src="{{ asset('storage/lpdp-icon.png') }}" alt="Logo" class="w-6 h-6 object-contain">
                </div>
                <span class="text-xl font-bold text-slate-800">TUBEL App</span>
            </div>

            <!-- Lock Illustration/Icon -->
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-orange-50 text-orange-500 mb-8 border border-orange-100 shadow-sm animate-bounce">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>

            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-800">Pendaftaran Ditutup</h1>
                <p class="text-slate-500 mt-3 text-sm leading-relaxed max-w-sm mx-auto">
                    Mohon maaf, saat ini pendaftaran akun baru untuk calon penerima beasiswa Tugas Belajar (TUBEL) sedang ditutup.
                </p>
                <div class="mt-4 p-4 bg-slate-50 rounded-2xl border border-slate-100/80 text-left flex items-start gap-3">
                    <svg class="w-5 h-5 text-orange-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Silakan hubungi administrator instansi Anda untuk informasi lebih lanjut mengenai jadwal pembukaan pendaftaran beasiswa berikutnya.
                    </p>
                </div>
            </div>

            <a href="{{ route('login') }}" 
               class="inline-flex items-center justify-center w-full bg-slate-900 hover:bg-slate-850 text-white font-bold py-3.5 rounded-xl shadow-lg transition-all duration-200 cursor-pointer">
                Kembali ke Halaman Login
            </a>
        </div>
    </div>

</body>
</html>
