@extends('layouts.app')
@section('title', 'Buku Panduan Pendaftaran')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 mb-20">
    
    <div class="text-center mb-16">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-orange-100 text-orange-500 mb-6 shadow-sm border border-orange-200">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        </div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-4">Buku Panduan Pendaftaran</h1>
        <p class="text-slate-500 max-w-2xl mx-auto text-lg">Pahami alur dan langkah-langkah di bawah ini untuk memastikan proses pendaftaran beasiswa Anda berjalan lancar tanpa kendala.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
                <span class="w-10 h-10 bg-slate-800 text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-md">1</span>
                <h3 class="text-xl font-bold text-slate-800">Pembuatan Akun & OTP</h3>
            </div>
            <ul class="space-y-3 text-slate-600 list-disc pl-5 leading-relaxed">
                <li>Klik tombol <strong class="text-slate-800">Daftar Sekarang</strong> di halaman utama.</li>
                <li>Masukkan Nama, Email yang valid, dan Password.</li>
                <li>Sistem akan mengirimkan <strong class="text-slate-800">6 digit Kode OTP</strong> ke email Anda.</li>
                <li>Masukkan kode OTP tersebut untuk mengaktifkan akun. Pendaftaran tidak bisa dilanjutkan jika email belum diverifikasi.</li>
            </ul>
        </div>

        <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-md transition relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-orange-50 rounded-bl-full z-0"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
                    <span class="w-10 h-10 bg-orange-500 text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-md shadow-orange-200">2</span>
                    <h3 class="text-xl font-bold text-slate-800">Pengisian 7 Tahap (Auto-Save)</h3>
                </div>
                <p class="text-slate-600 mb-3">Setelah login, klik menu <b>Pendaftaran</b>. Anda diwajibkan mengisi 7 tahapan berkas:</p>
                <ul class="space-y-2 text-sm text-slate-600 list-decimal pl-5 font-medium mb-4">
                    <li>Data Pribadi & Upload KTP</li>
                    <li>Data Industri / Instansi Pendukung</li>
                    <li>Universitas Tujuan & Upload LoA</li>
                    <li>Profil & Biodata Diri (Esai Singkat)</li>
                    <li>Surat Rekomendasi Tokoh</li>
                    <li>Esai Kontribusi (1500 - 2000 Kata)</li>
                    <li>Ringkasan Keseluruhan Data</li>
                </ul>
                <div class="bg-blue-50 text-blue-700 p-3 rounded-xl text-xs font-semibold flex items-start gap-2">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span><b>Fitur Draft:</b> Apa yang Anda ketik akan otomatis tersimpan sementara di perangkat. Anda bisa menutup halaman dan melanjutkannya nanti.</span>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
                <span class="w-10 h-10 bg-slate-800 text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-md">3</span>
                <h3 class="text-xl font-bold text-slate-800">Finalisasi & Kirim Berkas</h3>
            </div>
            <ul class="space-y-3 text-slate-600 list-disc pl-5 leading-relaxed">
                <li>Pada <strong class="text-slate-800">Tahap 7</strong>, Anda dapat melihat seluruh ringkasan data yang telah diinput dari Tahap 1 sampai 6.</li>
                <li>Periksa kembali data Anda dengan teliti. Jika ada kesalahan, Anda bisa menekan tombol "Edit" di bagian yang bersangkutan.</li>
                <li>Jika sudah yakin, setujui <b>Pernyataan Kebenaran Data</b> dan klik tombol hijau <strong class="text-slate-800">Kirim Pendaftaran Final</strong>.</li>
                <li><span class="text-red-500 font-semibold">Penting:</span> Setelah dikirim, data akan terkunci dan langsung masuk ke meja evaluasi Admin.</li>
            </ul>
        </div>

        <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
                <span class="w-10 h-10 bg-green-500 text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-md shadow-green-200">4</span>
                <h3 class="text-xl font-bold text-slate-800">Pantau Hasil & Revisi</h3>
            </div>
            <ul class="space-y-4 text-slate-600 list-disc pl-5 leading-relaxed">
                <li>Pantau status kelulusan Anda melalui menu <strong class="text-slate-800">Riwayat Pendaftaran</strong>.</li>
                <li>Jika berkas ditolak karena kurang lengkap, status akan berubah menjadi <span class="bg-red-100 text-red-600 px-2 py-0.5 rounded text-xs font-bold">Ditolak</span> beserta <b>Catatan Revisi</b> dari Admin.</li>
                <li>Anda dapat menekan tombol <strong class="text-slate-800">Revisi Berkas</strong> untuk memperbaiki data yang salah (melalui alur Tahap 1-7 kembali) dan mengirimkannya ulang.</li>
                <li>Pemberitahuan kelulusan atau penolakan juga akan dikirimkan otomatis ke nomor <b>WhatsApp</b> yang Anda daftarkan.</li>
            </ul>
        </div>

    </div>

    <div class="mt-16 bg-slate-900 text-white rounded-3xl p-10 text-center shadow-xl relative overflow-hidden">
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-orange-500/20 rounded-full blur-3xl pointer-events-none"></div>
        
        <h3 class="text-2xl font-bold mb-3 relative z-10">Masih Mengalami Kendala Teknis?</h3>
        <p class="text-slate-400 mb-8 relative z-10 max-w-2xl mx-auto leading-relaxed">Jika Anda mendapati sistem error, tidak menerima kode OTP di kotak masuk/spam, atau NIK terdeteksi ganda, silakan hubungi tim bantuan teknis kami.</p>
        
        <a href="mailto:support@lpdp.test" class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-10 rounded-xl transition shadow-lg shadow-orange-500/30 relative z-10 text-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            Hubungi Helpdesk
        </a>
    </div>

</div>
@endsection