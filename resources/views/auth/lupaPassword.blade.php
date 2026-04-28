<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - TUBEL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-slate-800 text-center mb-2">Lupa Password?</h2>
            <p class="text-slate-500 text-sm text-center mb-8">Masukkan alamat email yang terdaftar, kami akan mengirimkan tautan untuk mereset password Anda.</p>

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"
                           placeholder="contoh@gmail.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-orange-200 mb-4">
                    Kirim Link Reset
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-sm text-slate-500 hover:text-orange-500 transition font-medium">
                        &larr; Kembali ke halaman Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", confirmButtonColor: '#f97316' });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Oops!', text: "{{ session('error') }}", confirmButtonColor: '#f97316' });
        @endif
    </script>
</body>
</html>