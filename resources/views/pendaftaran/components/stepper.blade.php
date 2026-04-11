<div class="flex items-center gap-3 mb-8">
    <div class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-500 flex items-center justify-center">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
    </div>
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Form Pendaftaran Beasiswa</h2>
        <p class="text-slate-500 text-sm">Lengkapi 7 tahap di bawah ini untuk mengajukan beasiswa.</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6 overflow-x-auto">
    <div class="flex items-center justify-between min-w-[800px]">
        @for($i = 1; $i <= 7; $i++)
            <div class="flex items-center {{ $i == 7 ? '' : 'w-full' }}">
                <div class="w-10 h-10 shrink-0 flex items-center justify-center rounded-full font-bold text-sm transition-all duration-300 
                    {{ $step == $i ? 'bg-orange-500 text-white ring-4 ring-orange-100' : 
                      ($step > $i ? 'bg-green-500 text-white' : 'bg-slate-100 text-slate-400') }}">
                    @if($step > $i)
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    @else
                        {{ $i }}
                    @endif
                </div>
                @if($i < 7)
                    <div class="w-full h-1 mx-2 rounded {{ $step > $i ? 'bg-green-500' : 'bg-slate-100' }}"></div>
                @endif
            </div>
        @endfor
    </div>
    <div class="text-center mt-4">
        <span class="inline-block bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
            @if($step == 1) Tahap 1: Registrasi Data
            @elseif($step == 2) Tahap 2: Industri
            @elseif($step == 3) Tahap 3: Universitas
            @elseif($step == 4) Tahap 4: Profil
            @elseif($step == 5) Tahap 5: Rekomendasi
            @elseif($step == 6) Tahap 6: Essay
            @elseif($step == 7) Tahap 7: Ringkasan & Kirim
            @endif
        </span>
    </div>
</div>