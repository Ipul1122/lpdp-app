<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - LPDP App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen font-sans">

    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-indigo-900">Portal LPDP</h1>
            <p class="text-gray-500 mt-2 text-sm">Registrasi Akun Calon Penerima Beasiswa</p>
        </div>

        <form action="{{ route('register.process') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-200 @error('email') border-red-500 focus:ring-red-500 @else border-gray-300 @enderror" 
                       placeholder="contoh@kampus.ac.id">
                @error('email')
                    <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-200 @error('password') border-red-500 focus:ring-red-500 @else border-gray-300 @enderror" 
                       placeholder="Minimal 8 karakter">
                @error('password')
                    <span class="text-red-500 text-xs font-medium mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-200" 
                       placeholder="Ulangi password Anda">
            </div>

            <button type="submit" 
                    class="w-full bg-indigo-700 hover:bg-indigo-800 text-white font-bold py-3 rounded-lg shadow-md transition-colors duration-200 cursor-pointer mt-4">
                Buat Akun
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-semibold">Masuk di sini</a>
        </p>
    </div>

    <script type="module">
        document.addEventListener('DOMContentLoaded', function () {
            // Menangkap session 'success' dari Controller
            @if(session('success'))
                window.Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#4338ca', // indigo-700
                });
            @endif

            // Menangkap session 'error' dari Controller (Service failure)
            @if(session('error'))
                window.Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#dc2626', // red-600
                });
            @endif
        });
    </script>
</body>
</html>