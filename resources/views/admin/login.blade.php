<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - TUBEL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('storage/lpdp-icon.png') }}">
</head>
<body class="bg-slate-50 min-h-screen flex flex-col md:flex-row font-sans">

    <!-- Left Section: Sentences & Brand -->
    <div class="hidden md:flex md:w-1/2 lg:w-3/5 bg-gradient-to-tr from-orange-700 via-orange-800 to-slate-900 text-white p-12 lg:p-16 flex-col justify-between relative overflow-hidden">
        <!-- Background decorative pattern -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px]"></div>
        
        <!-- Logo -->
        <div class="relative z-10 flex items-center space-x-3">
            <div class="bg-white p-2.5 rounded-2xl shadow-sm">
                <img src="{{ asset('storage/lpdp-icon.png') }}" alt="Logo" class="w-8 h-8 object-contain">
            </div>
            <span class="text-2xl font-bold tracking-wider">TUBEL Admin</span>
        </div>

        <!-- Main text/sentences -->
        <div class="relative z-10 my-auto max-w-xl">
            <span class="bg-orange-500/20 text-orange-300 border border-orange-500/30 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider mb-4 inline-block">Administrator Control Panel</span>
            <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight mb-6">
                Sistem Manajemen Tugas Belajar (TUBEL)
            </h1>
            <p class="text-lg text-orange-50/90 leading-relaxed font-light mb-8">
                Kelola proses verifikasi, seleksi, evaluasi, dan pemantauan berkas calon penerima Tugas Belajar secara efisien, aman, dan terintegrasi.
            </p>
            
            <div class="flex items-center space-x-4 bg-white/5 p-5 rounded-2xl border border-white/10 backdrop-blur-md">
                <div class="bg-orange-500/30 text-white rounded-full p-2.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-white">Sesi Terenkripsi</h3>
                    <p class="text-sm text-orange-200/80">Koneksi aman ke sistem administrasi utama</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="relative z-10 text-sm text-orange-100/70">
            &copy; {{ date('Y') }} TUBEL Admin. Hak Cipta Dilindungi.
        </div>
    </div>

    <!-- Right Section: Form -->
    <div class="w-full md:w-1/2 lg:w-2/5 flex items-center justify-center p-8 sm:p-12 md:p-16 bg-white min-h-screen">
        <div class="w-full max-w-md">
            
            <!-- Mobile Header (Hidden on Desktop) -->
            <div class="flex items-center space-x-2 mb-8 md:hidden justify-center">
                <div class="bg-white border border-slate-100 p-2 rounded-xl shadow-sm">
                    <img src="{{ asset('storage/lpdp-icon.png') }}" alt="Logo" class="w-6 h-6 object-contain">
                </div>
                <span class="text-xl font-bold text-slate-800">TUBEL Admin</span>
            </div>

            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-800">Administrator</h1>
                <p class="text-slate-500 mt-2 text-sm">Masuk ke panel manajemen TUBEL</p>
            </div>

            <form action="{{ route('admin.login.process') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all" placeholder="admin@domain.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                               class="w-full pl-4 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all" placeholder="••••••••">
                        <button type="button" onclick="togglePasswordVisibility('password')" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                            <svg id="password-eye-open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg id="password-eye-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-orange-100 transition-all duration-200 mt-6 cursor-pointer">
                    Login Admin
                </button>
            </form>
        </div>
    </div>

    <script>
        window.togglePasswordVisibility = function(inputId) {
            const input = document.getElementById(inputId);
            const eyeIconOpen = document.getElementById(inputId + '-eye-open');
            const eyeIconClose = document.getElementById(inputId + '-eye-close');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeIconOpen.classList.add('hidden');
                eyeIconClose.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeIconOpen.classList.remove('hidden');
                eyeIconClose.classList.add('hidden');
            }
        };
    </script>
</body>
</html>