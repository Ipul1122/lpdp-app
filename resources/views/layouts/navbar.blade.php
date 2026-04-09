<header class="h-20 bg-white border-b border-slate-100 ml-20 flex items-center justify-between px-8 sticky top-0 z-30">
    
    <div>
        <h1 class="text-xl font-semibold text-slate-800">
            @yield('title', 'Beranda')
        </h1>
    </div>

    <div class="relative" x-data="{ open: false }">
        
        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 hover:bg-slate-50 p-2 rounded-xl transition cursor-pointer border border-transparent hover:border-slate-100">
            
            @php
                $name = Auth::check() ? Auth::user()->name : 'User Default';
                $words = explode(' ', $name);
                $initials = count($words) >= 2 
                    ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1)) 
                    : strtoupper(substr($name, 0, 2));
            @endphp

            <div class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center bg-white text-slate-600 font-bold text-sm shrink-0">
                {{ $initials }}
            </div>

            <div class="flex flex-col text-left">
                <span class="text-sm font-semibold text-slate-800 leading-tight">
                    {{ $name }}
                </span>
                <span class="text-xs text-slate-500">
                    Pendaftar
                </span>
            </div>

            <svg class="w-4 h-4 text-slate-400 ml-1 transition-transform duration-200" 
                 :class="{'rotate-180': open}" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="open" 
             x-transition.opacity.duration.200ms
             style="display: none;"
             class="absolute right-0 top-full mt-1 w-48 bg-white border border-slate-100 rounded-xl shadow-lg py-2 z-50">
            
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-600 font-semibold hover:bg-red-50 flex items-center gap-3 transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Keluar Aplikasi
                </button>
            </form>

        </div>
    </div>
</header>