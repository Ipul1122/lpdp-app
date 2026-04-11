@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 3')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 3])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <form id="step-form" action="{{ route('pendaftaran.step3.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Negara Tujuan</label>
                    <select name="negara_tujuan" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">Pilih Negara</option>
                        <option value="Indonesia" {{ old('negara_tujuan', $universitas?->negara_tujuan) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                        <option value="Luar Negeri" {{ old('negara_tujuan', $universitas?->negara_tujuan) == 'Luar Negeri' ? 'selected' : '' }}>Luar Negeri</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Provinsi</label>
                    <input type="text" name="provinsi" value="{{ old('provinsi', $universitas?->provinsi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: DKI Jakarta">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kota</label>
                    <input type="text" name="kota" value="{{ old('kota', $universitas?->kota) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Jakarta Selatan">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Universitas Tujuan</label>
                    <input type="text" name="nama_universitas" value="{{ old('nama_universitas', $universitas?->nama_universitas) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Ketik nama universitas...">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Program Studi</label>
                    <input type="text" name="program_studi" value="{{ old('program_studi', $universitas?->program_studi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: S1 Teknik Informatika">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Rencana Tanggal Mulai Studi</label>
                    <input type="month" name="tanggal_mulai_studi" value="{{ old('tanggal_mulai_studi', $universitas?->tanggal_mulai_studi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Rencana Durasi Studi (Bulan)</label>
                    <input type="number" name="durasi_studi" value="{{ old('durasi_studi', $universitas?->durasi_studi) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: 48">
                </div>

                <div class="md:col-span-2 mt-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Letter of Acceptance (LoA) / Bukti Lulus Seleksi</label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer relative">
                        <input type="file" name="loa" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.jpg,.jpeg,.png">
                        <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        <p class="text-sm text-slate-600 font-medium">Klik atau seret file LoA ke sini</p>
                        <p class="text-xs text-slate-400 mt-1">PDF, JPG, PNG (Maks 5MB)</p>
                        @if($universitas?->loa)
                            <p class="text-xs text-green-600 mt-2 font-semibold">✓ File LoA sudah terunggah</p>
                        @endif
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Kartu Hasil Studi (KHS) / IPK Terakhir</label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:bg-slate-50 transition cursor-pointer relative">
                        <input type="file" name="khs_ipk" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.jpg,.jpeg,.png">
                        <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        <p class="text-sm text-slate-600 font-medium">Klik atau seret file KHS/IPK ke sini</p>
                        <p class="text-xs text-slate-400 mt-1">PDF, JPG, PNG (Maks 5MB)</p>
                        @if($universitas?->khs_ipk)
                            <p class="text-xs text-green-600 mt-2 font-semibold">✓ File KHS/IPK sudah terunggah</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-8 pt-6 border-t border-slate-100">
                <a href="{{ route('pendaftaran.step2') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-orange-200 flex items-center gap-2">
                    Simpan & Lanjut Tahap 4 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('step-form');
        // Buat kunci unik per user dan per step agar tidak tertukar
        const storageKey = 'draft_step_{{ $step }}_user_{{ Auth::id() }}';

        // 1. KEMBALIKAN DATA JIKA ADA DI LOCALSTORAGE
        const savedData = localStorage.getItem(storageKey);
        if (savedData) {
            const dataObj = JSON.parse(savedData);
            for (const key in dataObj) {
                const input = form.elements[key];
                // Jangan timpa input file, dan jangan timpa jika sudah ada data dari database/old
                if (input && input.type !== 'file' && !input.value) {
                    input.value = dataObj[key];
                }
            }
        }

        // 2. SIMPAN SETIAP KALI USER MENGETIK/MENGUBAH INPUT
        form.addEventListener('input', function(e) {
            if(e.target.type !== 'file' && e.target.name) {
                const formData = new FormData(form);
                const obj = {};
                formData.forEach((value, key) => {
                    // Hindari menyimpan token CSRF
                    if (key !== '_token' && typeof value === 'string') {
                        obj[key] = value;
                    }
                });
                localStorage.setItem(storageKey, JSON.stringify(obj));
            }
        });

        // 3. BERSIHKAN LOCALSTORAGE KETIKA FORM BERHASIL DI-SUBMIT
        form.addEventListener('submit', function() {
            localStorage.removeItem(storageKey);
        });
    });
</script>
@endsection