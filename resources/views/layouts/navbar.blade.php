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
            
            // Generate Initials
            $name = Auth::check() ? Auth::user()->name : 'User Default';
            $words = explode(' ', $name);
            $initials = count($words) >= 2 
                ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1)) 
                : strtoupper(substr($name, 0, 2));

            // Query Dynamic Notifications
            $userNotifications = Auth::check() 
                ? \App\Models\Notification::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get()
                : collect();
            $unreadCount = Auth::check()
                ? \App\Models\Notification::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->count()
                : 0;
        @endphp

        <div class="relative flex items-center justify-center h-full" x-data="{ notifOpen: false }">
            <button @click="notifOpen = !notifOpen" @click.away="notifOpen = false" class="relative p-2 rounded-full text-slate-400 hover:bg-slate-50 hover:text-orange-500 transition focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                
                @if($unreadCount > 0)
                    <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center text-[10px] font-bold text-white bg-orange-500 rounded-full border border-white">
                        {{ $unreadCount }}
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
                 
                <div class="px-5 py-3 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                    <span class="font-bold text-slate-700 text-sm">Notifikasi</span>
                    @if($unreadCount > 0)
                        <form action="{{ route('notifikasi.markAllRead') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-orange-500 hover:text-orange-600 font-semibold cursor-pointer">Tandai Dibaca</button>
                        </form>
                    @endif
                </div>
                
                <div class="max-h-96 overflow-y-auto divide-y divide-slate-50">
                    @if($userNotifications->isNotEmpty())
                        @foreach($userNotifications as $notif)
                            <div class="p-4 hover:bg-slate-50 transition cursor-default flex gap-3 {{ !$notif->is_read ? 'bg-orange-50/20' : '' }}">
                                <div class="shrink-0 w-8 h-8 rounded-lg flex items-center justify-center 
                                    {{ $notif->type === 'approved' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">
                                    @if($notif->type === 'approved')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs font-bold text-slate-800">{{ $notif->title }}</p>
                                    <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">{{ $notif->message }}</p>
                                    <span class="text-[10px] text-slate-400 mt-1 block">{{ $notif->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="p-3 bg-slate-50 border-t border-slate-100 text-center">
                            <a href="{{ route('notifikasi.index') }}" class="text-xs font-bold text-slate-600 hover:text-orange-500 transition block">
                                Lihat Semua Notifikasi
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

                <a href="{{ route('profile.index') }}" class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 transition bg-slate-50 hover:bg-indigo-50 px-3 py-2 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profil Saya
                </a>
                
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