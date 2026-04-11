<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LPDP App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-800 overflow-x-hidden" x-data="{ sidebarOpen: false }">

    @include('layouts.sidebar')

    <div class="transition-all duration-300 ease-in-out md:ml-20"
         :class="{'ml-0': !sidebarOpen, 'ml-20': sidebarOpen}">
        
        @include('layouts.navbar')

        <main class="p-4 md:p-8 min-h-[calc(100vh-5rem)]">
            @yield('content')
        </main>
        
    </div>

    <a href="{{ route('panduan') }}" 
       class="fixed bottom-6 right-6 md:bottom-8 md:right-8 w-14 h-14 bg-slate-800 text-white rounded-full flex items-center justify-center shadow-[0_10px_25px_-5px_rgba(0,0,0,0.3)] hover:bg-orange-500 hover:scale-110 transition-all duration-300 z-50 group cursor-pointer border-2 border-white/20">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        
        <span class="absolute right-16 bg-slate-800 text-white text-xs font-semibold px-3 py-2 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap shadow-lg translate-y-1 group-hover:translate-y-0 duration-200">
            Buku Panduan
        </span>
    </a>

    <script type="module">
        document.addEventListener('DOMContentLoaded', function () {
            
            // Konfigurasi bawaan untuk Toast
            const Toast = window.Swal.mixin({
                toast: true,
                position: 'top-end', // Muncul di pojok kanan atas
                showConfirmButton: false, // Hilangkan tombol OK
                timer: 4000, // Hilang otomatis dalam 4 detik
                timerProgressBar: true, // Ada garis loading di bawahnya
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', window.Swal.stopTimer)
                    toast.addEventListener('mouseleave', window.Swal.resumeTimer)
                }
            });

            // Tangkap session 'success' dari Laravel
            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            @endif

            // Tangkap session 'error' dari Laravel (Opsional, sangat berguna)
            @if(session('error'))
                Toast.fire({
                    icon: 'error',
                    title: "{{ session('error') }}"
                });
            @endif

            // Tangkap Error Validasi Bawaan Laravel (Termasuk error NIK)
            @if($errors->any())
                Toast.fire({
                    icon: 'error',
                    title: "{{ $errors->first() }}"
                });
            @endif
            // -------------------------

            // Tangkap session 'info' dari Laravel
            @if(session('info'))
                Toast.fire({
                    icon: 'info',
                    title: "{{ session('info') }}"
                });
            @endif
        });
    </script>

</body>
</html>