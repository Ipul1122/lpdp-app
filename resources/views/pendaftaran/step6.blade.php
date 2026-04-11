@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 6')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 6])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-100">
            <div class="p-2 bg-orange-100 text-orange-600 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-800">Isian Essay</h3>
                <p class="text-sm text-slate-500">Lengkapi essay yang diperlukan untuk pendaftaran beasiswa.</p>
            </div>
        </div>

        <form id="step-form" action="{{ route('pendaftaran.step6.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <div class="flex justify-between items-end mb-3">
                    <label class="block text-sm font-bold text-slate-700">
                        Komitmen kembali ke Indonesia, rencana pasca studi, dan rencana kontribusi di Indonesia <span class="text-red-500">*</span>
                    </label>
                    <span id="word-count-display" class="text-xs font-bold px-2 py-1 bg-slate-100 rounded text-slate-600">
                        0 Kata
                    </span>
                </div>
                
                <p class="text-xs text-blue-600 mb-3 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Target: 1500 - 2000 kata.
                </p>

                <textarea id="essay-input" name="essay_kontribusi" rows="20" required 
                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm leading-relaxed" 
                    placeholder="Tuliskan essay anda di sini...">{{ old('essay_kontribusi', $essay?->essay_kontribusi) }}</textarea>
                
                @error('essay_kontribusi')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('pendaftaran.step5') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-orange-200 flex items-center gap-2">
                    Simpan & Lanjut Tahap 7 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('step-form');
        const essayInput = document.getElementById('essay-input');
        const wordCountDisplay = document.getElementById('word-count-display');
        const storageKey = 'draft_step_{{ $step }}_user_{{ Auth::id() }}';

        // --- FUNGSI HITUNG KATA ---
        function updateWordCount() {
            const text = essayInput.value.trim();
            const words = text ? text.split(/\s+/).length : 0;
            wordCountDisplay.innerText = words + ' Kata';
            
            // Ubah warna indikator jika masuk range
            if (words >= 1500 && words <= 2000) {
                wordCountDisplay.classList.replace('bg-slate-100', 'bg-green-100');
                wordCountDisplay.classList.replace('text-slate-600', 'text-green-600');
            } else {
                wordCountDisplay.classList.add('bg-slate-100');
                wordCountDisplay.classList.add('text-slate-600');
                wordCountDisplay.classList.remove('bg-green-100', 'text-green-600');
            }
        }

        // --- LOCAL STORAGE LOGIC ---
        const savedData = localStorage.getItem(storageKey);
        if (savedData) {
            const dataObj = JSON.parse(savedData);
            if (dataObj.essay_kontribusi && !essayInput.value) {
                essayInput.value = dataObj.essay_kontribusi;
            }
        }
        updateWordCount();

        essayInput.addEventListener('input', function() {
            updateWordCount();
            const obj = { essay_kontribusi: essayInput.value };
            localStorage.setItem(storageKey, JSON.stringify(obj));
        });

        form.addEventListener('submit', function() {
            localStorage.removeItem(storageKey);
        });
    });
</script>
@endsection