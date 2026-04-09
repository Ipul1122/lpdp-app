<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - LPDP App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen font-sans">

    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border border-gray-100 text-center">
        <h1 class="text-3xl font-extrabold text-indigo-900 mb-2">Verifikasi Email</h1>
        <p class="text-gray-500 text-sm mb-6">Kami telah mengirimkan 6 digit kode OTP ke email <br> <span class="font-bold text-indigo-600">{{ $email }}</span></p>

        <form action="{{ route('otp.process') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <input type="text" name="otp" maxlength="6"
                       class="w-full text-center text-2xl tracking-[0.5em] px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-200" 
                       placeholder="••••••" required autocomplete="off">
            </div>

            <button type="submit" 
                    class="w-full bg-indigo-700 hover:bg-indigo-800 text-white font-bold py-3 rounded-lg shadow-md transition-colors duration-200 cursor-pointer">
                Verifikasi OTP
            </button>
        </form>
    </div>

    <script type="module">
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('error'))
                window.Swal.fire({
                    icon: 'error',
                    title: 'Verifikasi Gagal',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#dc2626',
                });
            @endif
        });
    </script>
</body>
</html>