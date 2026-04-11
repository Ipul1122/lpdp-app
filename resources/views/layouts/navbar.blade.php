<header class="h-20 bg-white border-b border-slate-100 flex items-center justify-between px-4 md:px-8 sticky top-0 z-30">
    
    <div class="flex items-center gap-3">
        <button @click="sidebarOpen = !sidebarOpen" 
                class="md:hidden p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-orange-100 hover:text-orange-500 transition focus:outline-none">
            
            <svg x-show="!sidebarOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            
            <svg x-show="sidebarOpen" style="display: none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>

        </button>

        <h1 class="text-lg md:text-xl font-semibold text-slate-800 truncate">
            @yield('title', 'Beranda')
        </h1>
    </div>

    <div class="flex items-center gap-4 md:gap-6">

        @php
            $userProfile = Auth::check() ? Auth::user()->userProfile : null;
            $hasRejection = $userProfile && $userProfile->status === 'ditolak';
        @endphp

        <div class="relative" x-data="{ notifOpen: false }">
            <button @click="notifOpen = !notifOpen" @click.away="notifOpen = false" class="relative p-2 text-slate-400 hover:text-blue-600 transition block">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                @if($hasRejection)
                    <span class="absolute top-1 right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border border-white"></span>
                    </span>
                @endif
            </button>

            <div x-show="notifOpen" 
                 x-transition.opacity.duration.200ms
                 style="display: none;"
                 class="absolute right-0 top-full mt-2 w-80 bg-white border border-slate-200 rounded-xl shadow-lg py-2 z-50">
                <div class="px-4 py-2 border-b border-slate-100 flex justify-between items-center">
                    <span class="font-bold text-slate-700 text-sm">Notifikasi</span>
                </div>
                
                @if($hasRejection && $userProfile->catatan)
                    <div class="p-4 bg-red-50 border-l-4 border-red-500 hover:bg-red-100 transition cursor-pointer">
                        <p class="text-sm font-semibold text-red-800">Pengajuan Ditolak</p>
                        <p class="text-xs text-red-600 mt-1">Berkas pendaftaran Anda belum memenuhi syarat.</p>
                        <div class="mt-2 bg-white p-2 rounded border border-red-200">
                            <span class="text-xs font-semibold text-slate-600 block">Catatan Admin:</span>
                            <p class="text-xs text-slate-700 italic">"{{ $userProfile->catatan }}"</p>
                        </div>
                        <a href="{{ route('pendaftaran.create') }}" class="mt-3 inline-block text-xs font-medium bg-red-600 text-white px-3 py-1.5 rounded shadow-sm hover:bg-red-700">Revisi Pendaftaran</a>
                    </div>
                @else
                    <div class="px-4 py-6 text-center">
                        <p class="text-sm text-slate-500">Tidak ada notifikasi baru</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="h-8 w-px bg-slate-200"></div>

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
    </div>
</header>