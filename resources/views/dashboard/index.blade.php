<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LPDP App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans">

    <div class="p-8 max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-slate-800">Dashboard Utama</h1>
        <p class="text-slate-500 mt-2">Selamat datang di sistem informasi beasiswa LPDP.</p>
        
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="text-red-600 font-semibold hover:underline">Keluar (Logout)</button>
        </form>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 h-40">Statistik 1</div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 h-40">Statistik 2</div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 h-40">Statistik 3</div>
        </div>
    </div>

    @if(session('show_welcome_popover'))
    <div id="welcome-popover" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-300">
        
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 transform scale-100 animate-[bounceIn_0.5s_ease-out]">
            
            <div class="h-64 md:h-auto bg-indigo-100 relative">
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop" 
                     alt="Students" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-indigo-900/20"></div>
            </div>

            <div class="p-8 md:p-12 flex flex-col justify-center">
                
                <h1 class="text-3xl font-extrabold text-indigo-900 mb-6">
                    Selamat datang di LPDP
                </h1>

                <div class="space-y-4 text-slate-700 text-base leading-relaxed">
                    <p class="font-medium text-lg text-slate-800">Halo, {{ Auth::user()->name }}</p>
                    
                    <p class="font-semibold text-indigo-700">Selamat Datang Di Beasiswa LPDP</p>
                    
                    <p>
                        Program Beasiswa LPDP adalah skema beasiswa terintegrasi lintas kementrian yang dirancang untuk menyiapkan talenta unggul indonesia pada <strong>Bidang STEM Industri Strategis</strong> serta program <strong>SHARE (Social, Humanities, Art for People, Religious Studies & Economics)</strong>. Gunakan aplikasi ini untuk memulai perjalan beasiswa mu.
                    </p>

                    <ul class="list-disc pl-5 space-y-2 mt-4 text-slate-600 marker:text-indigo-500">
                        <li>Jelajahi kurasi program berdasarkan 8 Bidang Prioritas</li>
                        <li>Pantau status pendaftaran Beasiswa LPDP secara terupdate</li>
                        <li>Akses panduan, syarat, dan pembaruan kebijakan tertentu.</li>
                    </ul>
                </div>

                <div class="mt-10 flex justify-end">
                    <button id="close-popover-btn" class="inline-flex items-center justify-center px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg transition-transform transform hover:-translate-y-1 cursor-pointer">
                        Next
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const popover = document.getElementById('welcome-popover');
            const closeBtn = document.getElementById('close-popover-btn');

            if(popover && closeBtn) {
                closeBtn.addEventListener('click', function() {
                    // Animasi menghilang (fade out)
                    popover.classList.add('opacity-0');
                    setTimeout(() => {
                        popover.style.display = 'none';
                    }, 300); // Waktu sesuai durasi transisi tailwind
                });
            }
        });
    </script>
    
    <style>
        @keyframes bounceIn {
            0% { transform: scale(0.9); opacity: 0; }
            80% { transform: scale(1.02); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
    @endif

</body>
</html>