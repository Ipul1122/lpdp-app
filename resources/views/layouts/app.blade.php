<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LPDP App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-800">

    @include('layouts.sidebar')

    @include('layouts.navbar')

    <main class="ml-20 p-8 min-h-[calc(100vh-5rem)]">
        @yield('content')
    </main>

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