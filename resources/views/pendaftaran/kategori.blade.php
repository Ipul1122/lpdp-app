@extends('layouts.app')

@section('title', 'Pilih Kategori Pendaftaran')

@section('content')
<div class="max-w-4xl mx-auto mb-10" x-data="{ selectedCategory: '{{ old('kategori', $userProfile?->kategori ?? '') }}' }">
    
    <nav class="flex items-center text-sm font-medium text-slate-500 mb-8">
        <a href="{{ route('dashboard') }}" class="hover:text-orange-500 transition-colors">Beranda</a>
        <svg class="w-4 h-4 mx-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('pendaftaran.index') }}" class="hover:text-orange-500 transition-colors">Pendaftaran</a>
        <svg class="w-4 h-4 mx-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-800">Pilih Kategori</span>
    </nav>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 md:p-12">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 class="text-3xl font-extrabold text-slate-800 mb-3">Pilih Kategori Pendaftaran</h2>
            <p class="text-slate-500 text-sm leading-relaxed">
                Silakan pilih kategori jalur pendaftaran Anda terlebih dahulu sebelum mengisi formulir pendaftaran beasiswa.
            </p>
        </div>

        <form action="{{ route('pendaftaran.kategori.store') }}" method="POST">
            @csrf
            
            <input type="hidden" name="kategori" :value="selectedCategory" required>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <!-- CARD 1: Usulan Unit -->
                <div @click="selectedCategory = 'Usulan Unit'" 
                     class="cursor-pointer rounded-2xl border-2 p-6 md:p-8 transition-all duration-300 hover:shadow-md flex flex-col items-center text-center relative group"
                     :class="selectedCategory === 'Usulan Unit' ? 'border-orange-500 bg-orange-50/30' : 'border-slate-200 bg-white hover:border-slate-300'">
                    
                    <div class="absolute top-4 right-4 w-6 h-6 rounded-full border flex items-center justify-center transition-colors duration-300"
                         :class="selectedCategory === 'Usulan Unit' ? 'bg-orange-500 border-orange-500 text-white' : 'border-slate-300 text-transparent'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>

                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 transition-colors duration-300"
                         :class="selectedCategory === 'Usulan Unit' ? 'bg-orange-100 text-orange-600' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200'">
                        <!-- Icon: Building/Office/Unit -->
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-slate-800 mb-2">Usulan Unit</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Jalur pendaftaran beasiswa yang diajukan berdasarkan usulan resmi dari masing-masing unit kerja instansi.
                    </p>
                </div>

                <!-- CARD 2: Manajemen Talenta -->
                <div @click="selectedCategory = 'Manajemen Talenta'" 
                     class="cursor-pointer rounded-2xl border-2 p-6 md:p-8 transition-all duration-300 hover:shadow-md flex flex-col items-center text-center relative group"
                     :class="selectedCategory === 'Manajemen Talenta' ? 'border-orange-500 bg-orange-50/30' : 'border-slate-200 bg-white hover:border-slate-300'">
                    
                    <div class="absolute top-4 right-4 w-6 h-6 rounded-full border flex items-center justify-center transition-colors duration-300"
                         :class="selectedCategory === 'Manajemen Talenta' ? 'bg-orange-500 border-orange-500 text-white' : 'border-slate-300 text-transparent'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>

                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 transition-colors duration-300"
                         :class="selectedCategory === 'Manajemen Talenta' ? 'bg-orange-100 text-orange-600' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200'">
                        <!-- Icon: Star/Badge/Talent -->
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-slate-800 mb-2">Manajemen Talenta</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Jalur pendaftaran khusus untuk kandidat yang termasuk dalam program pengembangan kepemimpinan dan manajemen talenta instansi.
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-slate-100">
                <a href="{{ route('pendaftaran.index') }}" class="w-full sm:w-auto bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-8 rounded-xl transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Batal
                </a>
                <button type="submit" 
                        :disabled="!selectedCategory" 
                        class="w-full sm:w-auto text-white font-bold py-3.5 px-10 rounded-xl transition flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg"
                        :class="selectedCategory ? 'bg-orange-500 hover:bg-orange-600 shadow-orange-200' : 'bg-slate-400 shadow-transparent'">
                    Lanjutkan ke Pendaftaran
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
