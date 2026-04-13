<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Berakhir (419) - LPDP App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-800 flex items-center justify-center min-h-screen">
    
    @php
        // Logika deteksi: Apakah user berada di area admin?
        $isAdmin = request()->is('admin*');
        
        // Tentukan URL dan Label berdasarkan konteks
        $urlBeranda = $isAdmin ? route('admin.dashboard') : url('/');
        $labelBeranda = $isAdmin ? 'Beranda Admin' : 'Beranda Utama';
    @endphp

    <div class="max-w-2xl mx-auto px-4 w-full">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 md:p-12 text-center relative overflow-hidden">
            
            <div class="absolute -top-10 -right-10 w-32 h-32 {{ $isAdmin ? 'bg-slate-100' : 'bg-orange-50' }} rounded-full opacity-50"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-slate-50 rounded-full opacity-50"></div>

            <div class="relative z-10 w-24 h-24 {{ $isAdmin ? 'bg-slate-100 text-slate-600' : 'bg-orange-50 text-orange-500' }} rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner border {{ $isAdmin ? 'border-slate-200' : 'border-orange-100' }}">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            
            <h2 class="relative z-10 text-2xl md:text-3xl font-bold text-slate-800 mb-3">Sesi Halaman Berakhir</h2>
            
            <p class="relative z-10 text-slate-500 mb-8 leading-relaxed text-sm md:text-base px-2">
                Maaf, tampaknya Anda berada di halaman ini terlalu lama sehingga sesi keamanan berakhir. Silakan muat ulang halaman atau kembali ke beranda {{ strtolower($labelBeranda) }} Anda.
            </p>

            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <button onclick="window.location.reload()" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 {{ $isAdmin ? 'bg-slate-800 hover:bg-slate-900' : 'bg-orange-500 hover:bg-orange-600' }} text-white font-bold py-3 px-8 rounded-xl transition shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Muat Ulang
                </button>

                <a href="{{ $urlBeranda }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-100 text-slate-700 font-bold py-3 px-8 rounded-xl border border-slate-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    {{ $labelBeranda }}
                </a>
            </div>
            
        </div>
    </div>
</body>
</html>