<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Keamanan - TUPEL App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen font-sans">

    <div class="bg-white p-8 md:p-12 rounded-3xl shadow-2xl w-full max-w-md border border-slate-100 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-orange-600"></div>

        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-50 rounded-full mb-4">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                           class="otp-digit w-12 h-14 text-center text-2xl font-bold border-2 border-slate-200 rounded-xl focus:border-orange-500 focus:ring-0 transition-all duration-200"
                           required>
                @endfor
            </div>

            <input type="hidden" name="otp" id="real-otp">

            <button type="submit" 
                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-orange-200 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                Verifikasi Akun
            </button>
        </form>

        <div class="mt-8 flex flex-col items-center justify-center gap-2">
            <p class="text-sm text-slate-500">Tidak menerima kode atau sudah kadaluwarsa?</p>
            
            <form action="{{ route('otp.resend') }}" method="POST">
                @csrf
                <button type="submit" class="text-orange-600 hover:text-orange-700 font-bold text-sm hover:underline transition-colors cursor-pointer">
                    Kirim Ulang Kode OTP
                </button>
            </form>
        </div>
    </div>

    <script type="module">
        document.addEventListener('DOMContentLoaded', function () {
            const digits = document.querySelectorAll('.otp-digit');
            const realOtpInput = document.getElementById('real-otp');

            digits.forEach((digit, index) => {
                // 1. Mencegah huruf masuk & Auto-focus ke kanan
                digit.addEventListener('input', (e) => {
                    e.target.value = e.target.value.replace(/[^0-9]/g, ''); 
                    
                    if (e.target.value !== '' && index < digits.length - 1) {
                        digits[index + 1].focus();
                    }
                    updateRealOtp();
                });

                // 2. Auto-focus ke kiri saat tekan Backspace
                digit.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && e.target.value === '' && index > 0) {
                        digits[index - 1].focus();
                    }
                });

                // 3. Fitur Paste 6 digit sekaligus
                digit.addEventListener('paste', (e) => {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
                    
                    if (pastedData) {
                        for (let i = 0; i < pastedData.length; i++) {
                            digits[i].value = pastedData[i];
                        }
                        updateRealOtp();
                        
                        if (pastedData.length < 6) {
                            digits[pastedData.length].focus();
                        } else {
                            digits[5].focus();
                        }
                    }
                });
            });

            function updateRealOtp() {
                let combined = "";
                digits.forEach(d => combined += d.value);
                realOtpInput.value = combined;
            }

            // 4. Menangkap pesan dari Controller Anda: return back()->with('error', ...)
            @if(session('error'))
                window.Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#ea580c', 
                });
            @endif

            // 5. Menangkap pesan dari Controller Anda: return back()->with('success', ...)
            @if(session('success'))
                window.Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#ea580c',
                });
            @endif
        });
    </script>
</body>
</html>