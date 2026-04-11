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
            
            // Generate Initials
            $name = Auth::check() ? Auth::user()->name : 'User Default';
            $words = explode(' ', $name);
            $initials = count($words) >= 2 
                ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1)) 
                : strtoupper(substr($name, 0, 2));
        @endphp

        <div class="relative flex items-center justify-center h-full" x-data="{ notifOpen: false }">
            <button @click="notifOpen = !notifOpen" @click.away="notifOpen = false" class="relative p-2 rounded-full text-slate-400 hover:bg-slate-50 hover:text-blue-600 transition focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                
                @if($hasRejection)
                    <span class="absolute top-1 right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-white"></span>
                    </span>
                @endif
            </button>

            <div x-show="notifOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-1"
                 style="display: none;"
                 class="absolute right-[-60px] sm:right-0 top-full mt-3 w-72 sm:w-80 bg-white border border-slate-100 rounded-2xl shadow-xl z-50 overflow-hidden">
                 
                <div class="px-5 py-3 border-b border-slate-100 bg-slate-50">
                    <span class="font-bold text-slate-700 text-sm">Notifikasi</span>
                </div>
                
                <div class="max-h-96 overflow-y-auto">
                    @if($hasRejection && $userProfile->catatan)
                        <div class="p-5 border-l-4 border-red-500 hover:bg-slate-50 transition cursor-default">
                            <p class="text-sm font-bold text-slate-800">Pengajuan Ditolak</p>
                            <p class="text-xs text-slate-500 mt-1">Berkas pendaftaran Anda belum memenuhi syarat.</p>
                            
                            <div class="mt-3 bg-red-50 p-3 rounded-lg border border-red-100">
                                <span class="text-xs font-bold text-red-800 block mb-1">Catatan Admin:</span>
                                <p class="text-xs text-red-600 leading-relaxed">"{{ $userProfile->catatan }}"</p>
                            </div>
                            
                            <a href="{{ route('pendaftaran.create') }}" class="mt-4 flex items-center justify-center gap-2 w-full text-xs font-bold bg-slate-800 text-white px-4 py-2 rounded-lg shadow hover:bg-slate-900 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Revisi Berkas
                            </a>
                        </div>
                    @else
                        <div class="px-4 py-8 flex flex-col items-center justify-center text-center">
                            <svg class="w-12 h-12 text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <p class="text-sm font-medium text-slate-500">Belum ada notifikasi</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>

        <div class="relative flex items-center justify-center h-full" x-data="{ profileOpen: false }">
            
            <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" class="focus:outline-none flex items-center justify-center rounded-full ring-2 ring-transparent hover:ring-slate-200 transition-all duration-200">
                <div class="w-10 h-10 rounded-full bg-slate-800 text-white font-bold text-sm flex items-center justify-center shadow-sm">
                    {{ $initials }}
                </div>
            </button>

            <div x-show="profileOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-1"
                 style="display: none;"
                 class="absolute right-0 top-full mt-3 w-56 bg-white border border-slate-100 rounded-2xl shadow-xl z-50 overflow-hidden divide-y divide-slate-50">
                
                <div class="px-5 py-4 bg-slate-50">
                    <p class="text-sm font-bold text-slate-800 truncate" title="{{ $name }}">{{ $name }}</p>
                    <p class="text-xs text-orange-500 font-semibold mt-0.5">Pendaftar</p>
                </div>
                
                <div class="p-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-600 font-semibold rounded-xl hover:bg-red-50 flex items-center gap-3 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Keluar Aplikasi
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</header>