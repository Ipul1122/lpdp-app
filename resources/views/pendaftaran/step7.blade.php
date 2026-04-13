@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 7 (Ringkasan)')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 7])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        
        <div class="text-center mb-8">
            <h3 class="text-2xl font-bold text-slate-800">Ringkasan Keseluruhan Data</h3>
            <p class="text-slate-500 mt-2">Mohon periksa kembali seluruh data Anda di bawah ini. Klik pada masing-masing tahap untuk melihat detailnya.</p>
        </div>

        <div class="space-y-4">
            
            <div x-data="{ open: true }" class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <button @click="open = !open" type="button" class="w-full px-6 py-4 bg-slate-50 hover:bg-slate-100 transition-colors flex justify-between items-center outline-none">
                    <h4 class="font-bold text-slate-700 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-sm">1</span> 
                        Data Pribadi & KTP
                    </h4>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 text-slate-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition class="p-6 border-t border-slate-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-y-5 gap-x-6 text-sm">
                        <div class="md:col-span-3 pb-2 border-b border-slate-100"><span class="block text-slate-400 text-xs mb-1">Program Beasiswa</span><p class="font-bold text-orange-600 capitalize">{{ $userProfile?->program_beasiswa ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">NIK</span><p class="font-semibold text-slate-800">{{ $userProfile?->nik ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Nama Lengkap</span><p class="font-semibold text-slate-800">{{ $userProfile?->nama ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Tempat, Tanggal Lahir</span><p class="font-semibold text-slate-800">{{ $userProfile?->tempat_tglLahir ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">No. WhatsApp</span><p class="font-semibold text-slate-800">{{ $userProfile?->no_telp ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Agama</span><p class="font-semibold text-slate-800">{{ $userProfile?->agama ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Status Perkawinan</span><p class="font-semibold text-slate-800">{{ $userProfile?->status_perkawinan ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Pekerjaan</span><p class="font-semibold text-slate-800">{{ $userProfile?->pekerjaan ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Kewarganegaraan</span><p class="font-semibold text-slate-800">{{ $userProfile?->kewarganegaraan ?? '-' }}</p></div>
                        <div class="md:col-span-3"><span class="block text-slate-400 text-xs mb-1">Alamat Lengkap</span><p class="font-semibold text-slate-800">{{ $userProfile?->alamat ?? '-' }}, RT {{ $userProfile?->rt ?? '-' }}/RW {{ $userProfile?->rw ?? '-' }}, Kel. {{ $userProfile?->kelurahan ?? '-' }}, Kec. {{ $userProfile?->kecamatan ?? '-' }}</p></div>
                        <div class="md:col-span-3">
                            <span class="block text-slate-400 text-xs mb-1">Foto KTP</span>
                            @if($userProfile?->foto_ktp) <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">✓ Terlampir</span> @else <span class="text-red-500 text-xs">Kosong</span> @endif
                        </div>
                    </div>
                    <a href="{{ route('pendaftaran.step1', ['edit' => 'step1']) }}" class="text-xs font-bold text-blue-600 hover:underline">✏️ Edit Tahap 1</a>
                </div>
            </div>

            <div x-data="{ open: false }" class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <button @click="open = !open" type="button" class="w-full px-6 py-4 bg-slate-50 hover:bg-slate-100 transition-colors flex justify-between items-center outline-none">
                    <h4 class="font-bold text-slate-700 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-sm">2</span> Industri / Pendukung
                    </h4>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 text-slate-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition style="display: none;" class="p-6 border-t border-slate-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-y-5 gap-x-6 text-sm">
                        <div><span class="block text-slate-400 text-xs mb-1">Instansi</span><p class="font-semibold text-slate-800">{{ $industri?->instansi ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Sektor</span><p class="font-semibold text-slate-800">{{ $industri?->sektor ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Jenis Instansi</span><p class="font-semibold text-slate-800">{{ $industri?->jenis_instansi ?? '-' }}</p></div>
                        <div class="md:col-span-2"><span class="block text-slate-400 text-xs mb-1">Nama Instansi</span><p class="font-semibold text-slate-800">{{ $industri?->nama_instansi ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Telepon Instansi</span><p class="font-semibold text-slate-800">{{ $industri?->telepon_instansi ?? '-' }}</p></div>
                        <div class="md:col-span-3"><span class="block text-slate-400 text-xs mb-1">Alamat Instansi</span><p class="font-semibold text-slate-800">{{ $industri?->alamat_instansi ?? '-' }}, {{ $industri?->kab_kota ?? '-' }}, {{ $industri?->provinsi ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Pekerjaan</span><p class="font-semibold text-slate-800">{{ $industri?->pekerjaan ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Status Kepegawaian</span><p class="font-semibold text-slate-800">{{ $industri?->status_kepegawaian ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Tanggal Mulai Kerja</span><p class="font-semibold text-slate-800">{{ $industri?->tanggal_mulai_kerja ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Penghasilan</span><p class="font-semibold text-slate-800">{{ $industri?->penghasilan ?? '-' }}</p></div>
                        <div class="md:col-span-2"><span class="block text-slate-400 text-xs mb-1">Deskripsi Pekerjaan</span><p class="font-semibold text-slate-800">{{ $industri?->deskripsi_pekerjaan ?? '-' }}</p></div>
                        <div class="md:col-span-3">
                            <span class="block text-slate-400 text-xs mb-1">Surat Izin / Rekomendasi Instansi</span>
                            @if($industri?->surat_izin) <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">✓ Terlampir</span> @else <span class="text-slate-500 text-xs">-</span> @endif
                        </div>
                    </div>
                    <a href="{{ route('pendaftaran.step2', ['edit' => 'step2']) }}" class="text-xs font-bold text-blue-600 hover:underline">✏️ Edit Tahap 2</a>
                </div>
            </div>

            <div x-data="{ open: false }" class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <button @click="open = !open" type="button" class="w-full px-6 py-4 bg-slate-50 hover:bg-slate-100 transition-colors flex justify-between items-center outline-none">
                    <h4 class="font-bold text-slate-700 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-sm">3</span> Universitas Tujuan
                    </h4>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 text-slate-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition style="display: none;" class="p-6 border-t border-slate-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-6 text-sm">
                        <div><span class="block text-slate-400 text-xs mb-1">Nama Universitas</span><p class="font-semibold text-slate-800">{{ $universitas?->nama_universitas ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Program Studi</span><p class="font-semibold text-slate-800">{{ $universitas?->program_studi ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Lokasi Kampus</span><p class="font-semibold text-slate-800">{{ $universitas?->kota ?? '-' }}, {{ $universitas?->provinsi ?? '-' }}, {{ $universitas?->negara_tujuan ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Rencana Studi</span><p class="font-semibold text-slate-800">Mulai: {{ $universitas?->tanggal_mulai_studi ?? '-' }} ({{ $universitas?->durasi_studi ?? '-' }} Bulan)</p></div>
                        <div>
                            <span class="block text-slate-400 text-xs mb-1">LoA (Letter of Acceptance)</span>
                            @if($universitas?->loa) <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">✓ Terlampir</span> @else <span class="text-slate-500 text-xs">-</span> @endif
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs mb-1">KHS / Bukti IPK</span>
                            @if($universitas?->khs_ipk) <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">✓ Terlampir</span> @else <span class="text-slate-500 text-xs">-</span> @endif
                        </div>
                    </div>
                    <a href="{{ route('pendaftaran.step3', ['edit' => 'step3']) }}" class="text-xs font-bold text-blue-600 hover:underline">✏️ Edit Tahap 3</a>
                </div>
            </div>

            <div x-data="{ open: false }" class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <button @click="open = !open" type="button" class="w-full px-6 py-4 bg-slate-50 hover:bg-slate-100 transition-colors flex justify-between items-center outline-none">
                    <h4 class="font-bold text-slate-700 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-sm">4</span> Profil / Biodata
                    </h4>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 text-slate-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition style="display: none;" class="p-6 border-t border-slate-200 space-y-5">
                    <div><span class="block text-slate-400 text-xs mb-1">Deskripsi Diri</span><p class="font-medium text-slate-700 text-sm whitespace-pre-wrap">{{ $biodata?->deskripsi_diri ?? '-' }}</p></div>
                    <div><span class="block text-slate-400 text-xs mb-1">Riwayat Pendidikan</span><p class="font-medium text-slate-700 text-sm whitespace-pre-wrap">{{ $biodata?->riwayat_pendidikan ?? '-' }}</p></div>
                    <div><span class="block text-slate-400 text-xs mb-1">Pengalaman Kerja</span><p class="font-medium text-slate-700 text-sm whitespace-pre-wrap">{{ $biodata?->pengalaman_kerja ?? '-' }}</p></div>
                    <div><span class="block text-slate-400 text-xs mb-1">Pengalaman Organisasi</span><p class="font-medium text-slate-700 text-sm whitespace-pre-wrap">{{ $biodata?->pengalaman_organisasi ?? '-' }}</p></div>
                    <div><span class="block text-slate-400 text-xs mb-1">Prestasi</span><p class="font-medium text-slate-700 text-sm whitespace-pre-wrap">{{ $biodata?->prestasi ?? '-' }}</p></div>
                    <div><span class="block text-slate-400 text-xs mb-1">Keahlian</span><p class="font-medium text-slate-700 text-sm whitespace-pre-wrap">{{ $biodata?->keahlian ?? '-' }}</p></div>
                    <div><span class="block text-slate-400 text-xs mb-1">Bahasa</span><p class="font-medium text-slate-700 text-sm whitespace-pre-wrap">{{ $biodata?->bahasa ?? '-' }}</p></div>
                    <div class="mt-5 text-right">
                        <a href="{{ route('pendaftaran.step4', ['edit' => 'step4']) }}" class="text-xs font-bold text-blue-600 hover:underline">✏️ Edit Tahap 4</a>
                    </div>
                </div>
            </div>

            <div x-data="{ open: false }" class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <button @click="open = !open" type="button" class="w-full px-6 py-4 bg-slate-50 hover:bg-slate-100 transition-colors flex justify-between items-center outline-none">
                    <h4 class="font-bold text-slate-700 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-sm">5</span> Surat Rekomendasi
                    </h4>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 text-slate-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition style="display: none;" class="p-6 border-t border-slate-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-y-5 gap-x-6 text-sm">
                        <div><span class="block text-slate-400 text-xs mb-1">Nama Perekomendasi</span><p class="font-semibold text-slate-800">{{ $rekomendasi?->nama_perekomendasi ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Instansi</span><p class="font-semibold text-slate-800">{{ $rekomendasi?->instansi_perekomendasi ?? '-' }}</p></div>
                        <div><span class="block text-slate-400 text-xs mb-1">Jabatan</span><p class="font-semibold text-slate-800">{{ $rekomendasi?->jabatan_perekomendasi ?? '-' }}</p></div>
                        <div class="md:col-span-3">
                            <span class="block text-slate-400 text-xs mb-1">File Rekomendasi</span>
                            @if($rekomendasi?->file_rekomendasi) <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">✓ Terlampir</span> @else <span class="text-slate-500 text-xs">-</span> @endif
                        </div>
                    </div>
                        <div class="mt-5 text-right">
                            <a href="{{ route('pendaftaran.step5', ['edit' => 'step5']) }}" class="text-xs font-bold text-blue-600 hover:underline">✏️ Edit Tahap 5</a>
                        </div>
                </div>
            </div>

            <div x-data="{ open: false }" class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <button @click="open = !open" type="button" class="w-full px-6 py-4 bg-slate-50 hover:bg-slate-100 transition-colors flex justify-between items-center outline-none">
                    <h4 class="font-bold text-slate-700 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-sm">6</span> Essay Kontribusi
                    </h4>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 text-slate-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition style="display: none;" class="p-6 border-t border-slate-200">
                    <div class="bg-slate-50 p-4 rounded-xl text-sm text-slate-700 leading-relaxed whitespace-pre-wrap font-medium">
                        {{ $essay?->essay_kontribusi ?? '- Belum diisi -' }}
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('pendaftaran.step6', ['edit' => 'step6']) }}" class="text-xs font-bold text-blue-600 hover:underline">✏️ Edit Tahap 6</a>
                    </div>
                </div>
            </div>

        </div> <form id="final-form" action="{{ route('pendaftaran.step7.store') }}" method="POST" class="mt-10 pt-8 border-t border-slate-200">
            @csrf

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mb-8 flex items-start gap-4">
                <div class="text-blue-500 mt-0.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="font-bold text-blue-800 text-sm">Pernyataan Kebenaran Data</h4>
                    <p class="text-xs text-blue-600 mt-1 leading-relaxed">Dengan menekan tombol di bawah ini, saya menyatakan bahwa seluruh data dan dokumen yang saya lampirkan adalah benar dan dapat dipertanggungjawabkan. Saya siap menerima sanksi jika di kemudian hari ditemukan kecurangan.</p>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('pendaftaran.step6') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-10 rounded-xl transition shadow-xl shadow-green-200 flex items-center gap-2 text-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Kirim Pendaftaran Final
                </button>
            </div>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('final-form');
        
        form.addEventListener('submit', function(e) {
            // 1. Hentikan form agar tidak langsung terkirim
            e.preventDefault(); 

            // 2. Tampilkan Popover Konfirmasi SweetAlert
            Swal.fire({
                title: 'Konfirmasi Pengiriman',
                text: 'Apakah {{ $userProfile?->nama ?? Auth::user()->name }} sudah yakin dengan datanya?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a', // Warna hijau success
                cancelButtonColor: '#94a3b8', // Warna abu-abu
                confirmButtonText: 'Sudah, Kirim Final!',
                cancelButtonText: 'Belum, Cek Lagi',
                reverseButtons: true // Memposisikan tombol "Sudah" di sebelah kanan
            }).then((result) => {
                
                // 3. Jika tombol "Sudah" diklik
                if (result.isConfirmed) {
                    
                    // Bersihkan memori draft di LocalStorage
                    const userId = '{{ Auth::id() }}';
                    for (let i = 1; i <= 6; i++) {
                        localStorage.removeItem('draft_step_' + i + '_user_' + userId);
                    }
                    
                    // Munculkan loading agar user tidak menekan berkali-kali
                    Swal.fire({
                        title: 'Mengirim Data...',
                        text: 'Mohon tunggu sebentar.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Lanjutkan pengiriman form ke database
                    form.submit();
                }
                // Jika tombol "Belum" diklik, popover akan tertutup secara otomatis
                // dan tidak melakukan apa-apa (kembali ke halaman form)
            });
        });
    });
</script>
@endsection