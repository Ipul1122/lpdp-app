<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Keamanan - LPDP App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen font-sans">

    <div class="bg-white p-8 md:p-12 rounded-3xl shadow-2xl w-full max-w-md border border-slate-100 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-indigo-600"></div>

        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-50 rounded-full mb-4">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-800">Verifikasi Email</h1>
            <p class="text-slate-500 mt-2">Kode OTP telah dikirimkan ke <br> <span class="font-semibold text-slate-700">{{ $email }}</span></p>
        </div>

        <form action="{{ route('otp.process') }}" method="POST" id="otp-form">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="flex justify-center gap-2 mb-8" id="otp-inputs">
                @for ($i = 0; $i < 6; $i++)
                    <input type="text" maxlength="1" 
                           class="otp-digit w-12 h-14 text-center text-2xl font-bold border-2 border-slate-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-all duration-200"
                           required>
                @endfor
            </div>

            <input type="hidden" name="otp" id="real-otp">

            <button type="submit" 
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-200 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                Verifikasi Akun
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-sm text-slate-500">Tidak menerima kode? 
                <button class="text-indigo-600 font-bold hover:underline cursor-pointer">Kirim Ulang</button>
            </p>
        </div>
    </div>

    <script type="module">
        document.addEventListener('DOMContentLoaded', function () {
            const digits = document.querySelectorAll('.otp-digit');
            const realOtpInput = document.getElementById('real-otp');
            const form = document.getElementById('otp-form');

            // Logika auto-focus antar kotak
            digits.forEach((digit, index) => {
                digit.addEventListener('input', (e) => {
                    if (e.target.value.length === 1 && index < digits.length - 1) {
                        digits[index + 1].focus();
                    }
                    updateRealOtp();
                });

                digit.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        digits[index - 1].focus();
                    }
                });
            });

            function updateRealOtp() {
                let combined = "";
                digits.forEach(d => combined += d.value);
                realOtpInput.value = combined;
            }

            @if(session('error'))
                window.Swal.fire({
                    icon: 'error',
                    title: 'Verifikasi Gagal',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#4f46e5',
                });
            @endif
        });
    </script>
</body>
</html>