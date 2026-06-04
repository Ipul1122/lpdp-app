@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 5')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 5])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <div class="mb-6 pb-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-800">Essay Kontribusi</h3>
            <p class="text-sm text-slate-500 mt-1">Jelaskan rencana kontribusi Anda untuk Indonesia setelah menyelesaikan studi Anda.</p>
        </div>

        <form id="step-form" action="{{ route('pendaftaran.step5.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Rencana Kontribusi untuk Indonesia (Minimal 10 Karakter) <span class="text-red-500">*</span></label>
                    <textarea name="essay_kontribusi" rows="12" required class="w-full px-5 py-4 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm leading-relaxed" placeholder="Tuliskan kontribusi nyata yang akan Anda berikan bagi instansi/masyarakat/negara...">{{ old('essay_kontribusi', $essay?->essay_kontribusi) }}</textarea>
                </div>
            </div>

            <div class="flex justify-between mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('pendaftaran.step4') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-orange-200 flex items-center gap-2">
                    Simpan & Lanjut ke Ringkasan <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection