<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Keamanan - TUBEL App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('storage/lpdp-icon.png') }}">
</head>
<body class="bg-slate-50 min-h-screen flex flex-col md:flex-row font-sans">

    <!-- Left Section: Sentences & Brand -->
    <div class="hidden md:flex md:w-1/2 lg:w-3/5 bg-gradient-to-tr from-orange-600 via-orange-500 to-amber-500 text-white p-12 lg:p-16 flex-col justify-between relative overflow-hidden">
        <!-- Background decorative pattern -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px]"></div>
        
        <!-- Logo -->
        <div class="relative z-10 flex items-center space-x-3">
            <div class="bg-white p-2.5 rounded-2xl shadow-sm">
                <img src="{{ asset('storage/lpdp-icon.png') }}" alt="Logo" class="w-8 h-8 object-contain">
            </div>
            <span class="text-2xl font-bold tracking-wider">TUBEL App</span>
        </div>

        <!-- Main text/sentences -->
        <div class="relative z-10 my-auto max-w-xl">
            <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight mb-6">
                Verifikasi Dua Langkah
            </h1>
            <p class="text-lg text-orange-50/90 leading-relaxed font-light mb-8">
                Verifikasi Identitas Anda. Demi keamanan akun, masukkan kode verifikasi (OTP) yang telah kami kirimkan ke alamat email terdaftar Anda.
            </p>
            
            <div class="flex items-center space-x-4 bg-white/10 p-5 rounded-2xl border border-white/10 backdrop-blur-md">
                <div class="bg-orange-500/30 text-white rounded-full p-2.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-white">Autentikasi Email</h3>
                    <p class="text-sm text-orange-100">Memastikan hanya Anda yang dapat mengakses akun ini</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="relative z-10 text-sm text-orange-100/70">
            &copy; {{ date('Y') }} TUBEL App. Hak Cipta Dilindungi.
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
                <span class="text-xl font-bold text-slate-800">TUBEL App</span>
            </div>

            <div class="text-center md:text-left mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-orange-50 rounded-full mb-4">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-800">Verifikasi Email</h1>
                <p class="text-slate-500 mt-2 text-sm">Kode OTP telah dikirimkan ke <br> <span class="font-semibold text-slate-700">{{ $email }}</span></p>
            </div>

            <form action="{{ route('otp.process') }}" method="POST" id="otp-form">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="flex justify-center gap-2 mb-8" id="otp-inputs">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" maxlength="1" 
                               class="otp-digit w-12 h-14 text-center text-2xl font-bold border-2 border-slate-200 rounded-xl focus:border-orange-500 focus:ring-0 transition-all duration-200 outline-none"
                               required>
                    @endfor
                </div>

                <input type="hidden" name="otp" id="real-otp">

                <button type="submit" 
                        class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-orange-100 transition-all duration-200 cursor-pointer">
                    Verifikasi Akun
                </button>
            </form>

            <div class="mt-8 flex flex-col items-center justify-center gap-2">
                <p class="text-sm text-slate-500">Tidak menerima kode atau sudah kadaluwarsa?</p>
                
                <form action="{{ route('otp.resend') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-orange-600 hover:text-orange-850 font-bold text-sm hover:underline transition-colors cursor-pointer">
                        Kirim Ulang Kode OTP
                    </button>
                </form>
            </div>
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