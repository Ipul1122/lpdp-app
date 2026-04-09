<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - LPDP App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 font-sans">

    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-5xl w-full grid grid-cols-1 md:grid-cols-2">
        
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
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex items-center justify-center px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg transition-transform transform hover:-translate-y-1">
                    Next
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
        </div>
    </div>

</body>
</html>