@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-orange-100 text-orange-500 mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        </div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-3">Buku Panduan Pendaftaran</h1>
        <p class="text-slate-500 max-w-2xl mx-auto">Ikuti langkah-langkah di bawah ini untuk memastikan proses pendaftaran beasiswa Anda berjalan lancar tanpa kendala.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-8 h-8 bg-slate-800 text-white rounded-lg flex items-center justify-center font-bold">1</span>
                <h3 class="text-lg font-bold text-slate-800">Pembuatan Akun</h3>
            </div>
            <ul class="space-y-3 text-sm text-slate-600 list-disc pl-5">
                <li>Klik tombol <strong class="text-slate-800">Daftar</strong> di halaman utama.</li>
                <li>Masukkan Nama, Email aktif, dan Password.</li>
                <li>Buka email Anda untuk melihat <strong class="text-slate-800">6 digit Kode OTP</strong>.</li>
                <li>Masukkan kode OTP untuk mengaktifkan akun Anda. Pendaftaran gagal jika OTP tidak diverifikasi.</li>
            </ul>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-8 h-8 bg-slate-800 text-white rounded-lg flex items-center justify-center font-bold">2</span>
                <h3 class="text-lg font-bold text-slate-800">Isi Data Diri & KTP</h3>
            </div>
            <ul class="space-y-3 text-sm text-slate-600 list-disc pl-5">
                <li>Setelah login, klik menu <strong class="text-slate-800">Pendaftaran</strong>.</li>
                <li>Siapkan foto KTP dalam format <strong class="text-slate-800">JPG/PNG</strong> (Maks 5MB). Pastikan foto tidak buram.</li>
                <li>Isi 16 digit NIK. NIK tidak dapat digunakan ganda oleh pengguna lain.</li>
                <li>Pastikan data yang diisi (Agama, Tempat Lahir, dll) sama persis dengan yang ada di KTP Anda.</li>
            </ul>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-8 h-8 bg-orange-500 text-white rounded-lg flex items-center justify-center font-bold">3</span>
                <h3 class="text-lg font-bold text-slate-800">Pilih Program Beasiswa</h3>
            </div>
            <ul class="space-y-3 text-sm text-slate-600 list-disc pl-5">
                <li>Di bagian bawah form pendaftaran, terdapat opsi <strong class="text-slate-800">Pemilihan Program</strong>.</li>
                <li>Anda bisa memilih antara Sarjana (S1), Magister (S2), atau Dokter Spesialis.</li>
                <li>Perhatian: Setelah Anda menekan tombol Simpan, Anda <strong class="text-slate-800 text-red-500">tidak bisa</strong> membatalkan atau mengubah program beasiswa yang telah dipilih.</li>
            </ul>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-8 h-8 bg-green-500 text-white rounded-lg flex items-center justify-center font-bold">4</span>
                <h3 class="text-lg font-bold text-slate-800">Memantau Hasil Seleksi</h3>
            </div>
            <ul class="space-y-3 text-sm text-slate-600 list-disc pl-5">
                <li>Buka menu <strong class="text-slate-800">Riwayat</strong> di Dashboard Anda.</li>
                <li>Status awal Anda adalah <span class="bg-amber-100 text-amber-700 px-2 py-0.5 rounded text-xs font-bold">Pending</span>.</li>
                <li>Panitia/Admin akan memeriksa berkas Anda. Jika diterima atau ditolak, status akan berubah dan Anda mungkin mendapatkan pesan khusus dari Admin via WhatsApp.</li>
            </ul>
        </div>

    </div>

    <div class="mt-12 bg-slate-900 text-white rounded-3xl p-8 text-center shadow-xl relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-orange-500/20 rounded-full blur-2xl"></div>
        
        <h3 class="text-xl font-bold mb-2 relative z-10">Masih Mengalami Kendala?</h3>
        <p class="text-slate-400 text-sm mb-6 relative z-10 max-w-lg mx-auto">Jika Anda mendapati sistem error, tidak menerima kode OTP, atau NIK tidak bisa diinput, silakan hubungi pusat bantuan kami.</p>
        
        <a href="mailto:support@lpdp.test" class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full transition shadow-lg relative z-10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            Hubungi Helpdesk
        </a>
    </div>

</div>
@endsection