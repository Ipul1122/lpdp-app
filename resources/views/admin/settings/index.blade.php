@extends('layouts.admin.app')

@section('title', 'Pengaturan')

@section('content')
<div class="max-w-5xl mx-auto pb-12 space-y-8">
    
    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 rounded-3xl p-8 shadow-lg border border-slate-800 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(249,115,22,0.1),transparent_50%)]"></div>
        <div class="relative z-10 space-y-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-orange-500/10 text-orange-400 border border-orange-500/20">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Pengaturan Sistem
            </span>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Pengaturan</h1>
            <p class="text-slate-300 text-sm leading-relaxed max-w-xl">
                Ubah password akun admin Anda dan kelola status kunci pendaftaran beasiswa Tugas Belajar (TUBEL).
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Card: Change Password (Span 7) -->
        <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between">
            <div class="p-8 space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Ubah Password Admin</h3>
                    <p class="text-xs text-slate-400 mt-1">Gunakan password yang kuat dengan perpaduan huruf kapital, angka, dan simbol.</p>
                </div>
                
                <hr class="border-slate-100">

                <form action="{{ route('admin.settings.updatePassword') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label for="current_password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" required
                               class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:outline-none transition-all duration-200 @error('current_password') border-red-500 focus:ring-red-500 @else border-slate-200 @enderror"
                               placeholder="Masukkan password saat ini">
                        @error('current_password')
                            <span class="text-red-500 text-xs font-medium mt-1.5 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password Baru</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:outline-none transition-all duration-200 @error('password') border-red-500 focus:ring-red-500 @else border-slate-200 @enderror"
                               placeholder="Masukkan password baru">
                        
                        <!-- Interactive Password Requirements -->
                        <div class="mt-3 grid grid-cols-2 gap-2 text-xs bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p id="char-length" class="text-gray-500 flex items-center gap-1.5 font-medium">
                                <span class="indicator text-red-500">❌</span> Min. 8 Karakter
                            </p>
                            <p id="char-upper" class="text-gray-500 flex items-center gap-1.5 font-medium">
                                <span class="indicator text-red-500">❌</span> Huruf Kapital
                            </p>
                            <p id="char-number" class="text-gray-500 flex items-center gap-1.5 font-medium">
                                <span class="indicator text-red-500">❌</span> Angka
                            </p>
                            <p id="char-symbol" class="text-gray-500 flex items-center gap-1.5 font-medium">
                                <span class="indicator text-red-500">❌</span> Simbol (!@#$%^&*)
                            </p>
                        </div>
                        
                        @error('password')
                            <span class="text-red-500 text-xs font-medium mt-1.5 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:outline-none transition-all duration-200"
                               placeholder="Ulangi password baru">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full md:w-auto px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl transition duration-200 shadow-md flex items-center justify-center gap-2 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Card: Lock/Unlock Registration (Span 5) -->
        <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between">
            <div class="p-8 space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Kontrol Status Pendaftaran</h3>
                    <p class="text-xs text-slate-400 mt-1">Kunci atau buka akses pembuatan akun baru bagi pendaftar beasiswa TUBEL.</p>
                </div>
                
                <hr class="border-slate-100">

                <div class="p-5 rounded-2xl border flex items-start gap-4 {{ $isLocked ? 'bg-rose-50/50 border-rose-100 text-rose-800' : 'bg-emerald-50/40 border-emerald-100 text-emerald-800' }}">
                    <div class="p-2.5 rounded-xl shrink-0 {{ $isLocked ? 'bg-rose-100 text-rose-600' : 'bg-emerald-100 text-emerald-600' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($isLocked)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                            @endif
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <span class="text-xs font-bold uppercase tracking-wider">Status Pendaftaran Saat Ini</span>
                        <h4 class="text-lg font-black tracking-tight {{ $isLocked ? 'text-rose-700' : 'text-emerald-700' }}">
                            {{ $isLocked ? 'Terkunci (Ditutup)' : 'Terbuka (Aktif)' }}
                        </h4>
                        <p class="text-xs leading-relaxed opacity-90 mt-1">
                            {{ $isLocked 
                                ? 'Pendaftar tidak dapat membuat akun baru. Akses registrasi dialihkan ke halaman pemberitahuan ditutup.' 
                                : 'Registrasi terbuka penuh. Calon pendaftar beasiswa dapat membuat akun baru melalui formulir online.' 
                            }}
                        </p>
                    </div>
                </div>

                <form id="lock-form" action="{{ route('admin.settings.updateRegistrationLock') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Tindakan Akses Pendaftaran</label>
                        
                        <div class="grid grid-cols-2 gap-4">
                            
                            <!-- Option Open (0) -->
                            <label class="relative flex flex-col p-4 bg-slate-50 rounded-2xl border cursor-pointer hover:bg-slate-100/50 transition-all focus-within:ring-2 focus-within:ring-orange-500 {{ !$isLocked ? 'border-emerald-500 bg-emerald-50/20 ring-1 ring-emerald-500/20' : 'border-slate-200' }}">
                                <input type="radio" name="lock_registration" value="0" class="sr-only" {{ !$isLocked ? 'checked' : '' }} onchange="toggleLockStateStyles(this)">
                                <span class="flex items-center justify-between">
                                    <span class="text-sm font-bold text-slate-800">Buka</span>
                                    <span class="w-4.5 h-4.5 rounded-full border border-slate-300 flex items-center justify-center bg-white shrink-0 {{ !$isLocked ? 'border-emerald-500' : '' }}">
                                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 {{ !$isLocked ? 'block' : 'hidden' }}"></span>
                                    </span>
                                </span>
                                <span class="text-[10px] text-slate-500 mt-2 leading-relaxed">
                                    Izinkan calon pelamar mendaftar akun baru.
                                </span>
                            </label>

                            <!-- Option Lock (1) -->
                            <label class="relative flex flex-col p-4 bg-slate-50 rounded-2xl border cursor-pointer hover:bg-slate-100/50 transition-all focus-within:ring-2 focus-within:ring-orange-500 {{ $isLocked ? 'border-rose-500 bg-rose-50/20 ring-1 ring-rose-500/20' : 'border-slate-200' }}">
                                <input type="radio" name="lock_registration" value="1" class="sr-only" {{ $isLocked ? 'checked' : '' }} onchange="toggleLockStateStyles(this)">
                                <span class="flex items-center justify-between">
                                    <span class="text-sm font-bold text-slate-800">Kunci</span>
                                    <span class="w-4.5 h-4.5 rounded-full border border-slate-300 flex items-center justify-center bg-white shrink-0 {{ $isLocked ? 'border-rose-500' : '' }}">
                                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500 {{ $isLocked ? 'block' : 'hidden' }}"></span>
                                    </span>
                                </span>
                                <span class="text-[10px] text-slate-500 mt-2 leading-relaxed">
                                    Tutup registrasi & cegah akun pendaftaran baru.
                                </span>
                            </label>
                            
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="button" onclick="confirmLockStateChange()" class="w-full px-6 py-3 bg-orange-600 hover:bg-slate-900 text-white font-bold rounded-xl transition duration-200 shadow-md flex items-center justify-center gap-2 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Terapkan Status Akses
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    // Live validation for password input
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        if (passwordInput) {
            const criteria = {
                length: { el: document.getElementById('char-length'), reg: /.{8,}/ },
                upper: { el: document.getElementById('char-upper'), reg: /[A-Z]/ },
                number: { el: document.getElementById('char-number'), reg: /[0-9]/ },
                symbol: { el: document.getElementById('char-symbol'), reg: /[^A-Za-z0-9]/ }
            };

            passwordInput.addEventListener('input', function() {
                const val = this.value;
                
                for (let key in criteria) {
                    const item = criteria[key];
                    const indicator = item.el.querySelector('.indicator');
                    if (item.reg.test(val)) {
                        indicator.innerText = "✅";
                        item.el.classList.replace('text-gray-500', 'text-green-600');
                    } else {
                        indicator.innerText = "❌";
                        item.el.classList.replace('text-green-600', 'text-gray-500');
                    }
                }
            });
        }
    });

    // Style toggles dynamically on radio change
    function toggleLockStateStyles(input) {
        const parentLabels = input.form.querySelectorAll('label.relative');
        parentLabels.forEach(label => {
            const radio = label.querySelector('input[type="radio"]');
            const dotContainer = label.querySelector('.w-4\\.5');
            const dot = label.querySelector('.rounded-full > span');
            
            if (radio.checked) {
                if (radio.value === '1') {
                    // Lock active
                    label.className = "relative flex flex-col p-4 bg-rose-50/20 border-rose-500 rounded-2xl border cursor-pointer hover:bg-slate-100/50 transition-all focus-within:ring-2 focus-within:ring-orange-500 ring-1 ring-rose-500/20";
                    dotContainer.classList.add('border-rose-500');
                    dotContainer.classList.remove('border-slate-300');
                    dot.className = "w-2.5 h-2.5 rounded-full bg-rose-500 block";
                } else {
                    // Open active
                    label.className = "relative flex flex-col p-4 bg-emerald-50/20 border-emerald-500 rounded-2xl border cursor-pointer hover:bg-slate-100/50 transition-all focus-within:ring-2 focus-within:ring-orange-500 ring-1 ring-emerald-500/20";
                    dotContainer.classList.add('border-emerald-500');
                    dotContainer.classList.remove('border-slate-300');
                    dot.className = "w-2.5 h-2.5 rounded-full bg-emerald-500 block";
                }
            } else {
                label.className = "relative flex flex-col p-4 bg-slate-50 rounded-2xl border cursor-pointer hover:bg-slate-100/50 transition-all focus-within:ring-2 focus-within:ring-orange-500 border-slate-200";
                dotContainer.classList.remove('border-emerald-500', 'border-rose-500');
                dotContainer.classList.add('border-slate-300');
                dot.className = "w-2.5 h-2.5 rounded-full bg-slate-500 hidden";
            }
        });
    }

    // Sweetalert confirm on Lock Registration
    function confirmLockStateChange() {
        const form = document.getElementById('lock-form');
        const selectedValue = form.querySelector('input[name="lock_registration"]:checked').value;
        const actionText = selectedValue === '1' ? 'MENGUNCI (MENUTUP)' : 'MEMBUKA (MENGAKTIFKAN)';
        const textDetail = selectedValue === '1' 
            ? 'Setelah dikunci, calon pendaftar tidak dapat melakukan pendaftaran akun baru!' 
            : 'Setelah dibuka, calon pendaftar dapat kembali mendaftar akun baru seperti biasa.';
        
        Swal.fire({
            title: `Apakah Anda yakin ingin ${actionText} pendaftaran?`,
            text: textDetail,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: selectedValue === '1' ? '#e11d48' : '#10b981', // rose-600 : emerald-500
            cancelButtonColor: '#475569', // slate-600
            confirmButtonText: 'Ya, Ubah Status!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endsection
