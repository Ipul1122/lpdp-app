@php
    if (!isset($userProfile)) {
        $userProfile = \App\Models\UserProfile::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
    }
@endphp

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-500 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Form Pendaftaran Beasiswa</h2>
            <p class="text-slate-500 text-sm">Lengkapi 7 tahap di bawah ini untuk mengajukan beasiswa.</p>
        </div>
    </div>
    @if($userProfile && $userProfile->kategori)
        <div class="shrink-0 flex items-center gap-2">
            <span class="text-xs text-slate-400 font-semibold uppercase">Jalur Kategori:</span>
            <span class="inline-flex items-center gap-1.5 bg-orange-50 text-orange-600 px-3 py-1.5 rounded-xl text-xs font-bold border border-orange-100 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @if($userProfile->kategori === 'Usulan Unit')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    @endif
                </svg>
                {{ $userProfile->kategori }}
            </span>
        </div>
    @endif
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6 overflow-x-auto">
    <div class="flex items-center justify-between min-w-[800px]">
        @for($i = 1; $i <= 7; $i++)
            <div class="flex items-center {{ $i == 7 ? '' : 'w-full' }}">
                
                @if($i < $step)
                    <a href="{{ route('pendaftaran.step' . $i) }}" 
                       class="w-10 h-10 shrink-0 flex items-center justify-center rounded-full font-bold text-sm transition-all duration-300 bg-green-500 text-white hover:bg-green-600 hover:ring-4 hover:ring-green-100 cursor-pointer shadow-sm relative group"
                       title="Kembali ke Tahap {{ $i }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </a>
                @elseif($i == $step)
                    <div class="w-10 h-10 shrink-0 flex items-center justify-center rounded-full font-bold text-sm transition-all duration-300 bg-orange-500 text-white ring-4 ring-orange-100 shadow-md">
                        {{ $i }}
                    </div>
                @else
                    <div class="w-10 h-10 shrink-0 flex items-center justify-center rounded-full font-bold text-sm transition-all duration-300 bg-slate-100 text-slate-400">
                        {{ $i }}
                    </div>
                @endif

                @if($i < 7)
                    <div class="w-full h-1 mx-2 rounded {{ $step > $i ? 'bg-green-500' : 'bg-slate-100' }}"></div>
                @endif
            </div>
        @endfor
    </div>
    
    <div class="text-center mt-5 flex flex-col items-center gap-2">
        <span class="inline-block bg-orange-100 text-orange-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">
            @if($step == 1) Tahap 1: Registrasi Data
            @elseif($step == 2) Tahap 2: Unit Kerja
            @elseif($step == 3) Tahap 3: Universitas
            @elseif($step == 4) Tahap 4: Rekomendasi
            @elseif($step == 5) Tahap 5: Essay
            @elseif($step == 6) Tahap 6: Surat Komitmen
            @elseif($step == 7) Tahap 7: Ringkasan & Kirim
            @endif
        </span>

        @if($step > 1)
            <p class="text-xs text-slate-500 font-medium mt-1">
                💡 Tip: Anda dapat mengeklik ikon <span class="text-green-600 font-bold">hijau</span> di atas untuk kembali merevisi tahap sebelumnya.
            </p>
        @endif
    </div>
</div>