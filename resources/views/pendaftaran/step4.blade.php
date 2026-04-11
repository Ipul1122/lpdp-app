@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 4')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 4])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <form id="step-form" action="{{ route('pendaftaran.step4.store') }}" method="POST">
            @csrf

            <div class="flex flex-col gap-6">
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Diri</label>
                    <textarea name="deskripsi_diri" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm leading-relaxed" placeholder="Sebutkan deskripsi diri anda secara singkat dan padat...">{{ old('deskripsi_diri', $biodata?->deskripsi_diri) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Riwayat Pendidikan</label>
                    <textarea name="riwayat_pendidikan" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm leading-relaxed" placeholder="Sebutkan riwayat pendidikan anda mulai dari S1, nama kampus, jurusan, dan tahun lulus...">{{ old('riwayat_pendidikan', $biodata?->riwayat_pendidikan) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pengalaman Kerja</label>
                    <textarea name="pengalaman_kerja" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm leading-relaxed" placeholder="Sebutkan pengalaman kerja anda (Posisi, Perusahaan, Tahun, Tanggung Jawab)...">{{ old('pengalaman_kerja', $biodata?->pengalaman_kerja) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pengalaman Organisasi</label>
                    <textarea name="pengalaman_organisasi" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm leading-relaxed" placeholder="Sebutkan pengalaman organisasi anda (Nama Organisasi, Jabatan, Tahun)...">{{ old('pengalaman_organisasi', $biodata?->pengalaman_organisasi) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Prestasi</label>
                    <textarea name="prestasi" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm leading-relaxed" placeholder="Sebutkan prestasi yang pernah anda raih (Nama Prestasi, Tingkat, Tahun)...">{{ old('prestasi', $biodata?->prestasi) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Keahlian / Skill</label>
                    <textarea name="keahlian" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm leading-relaxed" placeholder="Sebutkan keahlian atau skill teknis/non-teknis yang anda miliki...">{{ old('keahlian', $biodata?->keahlian) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Bahasa yang Dikuasai</label>
                    <textarea name="bahasa" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm leading-relaxed" placeholder="Sebutkan bahasa yang anda kuasai beserta tingkatannya (misal: Inggris - Aktif/TOEFL 550)...">{{ old('bahasa', $biodata?->bahasa) }}</textarea>
                </div>

            </div>

            <div class="flex justify-between mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('pendaftaran.step3') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-orange-200 flex items-center gap-2">
                    Simpan & Lanjut Tahap 5 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('step-form');
        const storageKey = 'draft_step_{{ $step }}_user_{{ Auth::id() }}';

        // 1. Kembalikan data
        const savedData = localStorage.getItem(storageKey);
        if (savedData) {
            const dataObj = JSON.parse(savedData);
            for (const key in dataObj) {
                const input = form.elements[key];
                if (input && input.type !== 'file' && !input.value) {
                    input.value = dataObj[key];
                }
            }
        }

        // 2. Simpan draf
        form.addEventListener('input', function(e) {
            if(e.target.type !== 'file' && e.target.name) {
                const formData = new FormData(form);
                const obj = {};
                formData.forEach((value, key) => {
                    if (key !== '_token' && typeof value === 'string') {
                        obj[key] = value;
                    }
                });
                localStorage.setItem(storageKey, JSON.stringify(obj));
            }
        });

        // 3. Bersihkan draf saat submit
        form.addEventListener('submit', function() {
            localStorage.removeItem(storageKey);
        });
    });
</script>
@endsection