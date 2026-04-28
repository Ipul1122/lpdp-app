<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TUBEL App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen font-sans">

    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border border-slate-100 relative z-10">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-orange-600">Masuk Akun</h1>
            <p class="text-slate-500 mt-2 text-sm">Lanjutkan perjalanan TUBEL Anda</p>
        </div>

        <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none" required>
                @error('email')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" name="password" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none" required>
            </div>

            <button type="submit" class="w-full bg-orange-600 hover:bg-orange-800 text-white font-bold py-3 rounded-lg shadow-md transition-colors duration-200 mt-4">
                Masuk
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('password.request') }}" class="text-sm text-orange-600 hover:text-orange-800 font-medium">
                Lupa password?
            </a>
        </div>

        <div class="mt-6 text-center">
            <p class="text-slate-500 text-sm">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-orange-600 hover:text-orange-800 font-medium">Daftar di sini</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            @endif

            @if(session('error'))
                Toast.fire({
                    icon: 'error',
                    title: "{{ session('error') }}"
                });
            @endif
        });
    </script>
</body>
</html>