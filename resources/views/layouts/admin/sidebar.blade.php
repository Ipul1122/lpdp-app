<div x-show="sidebarOpen" 
     @click="sidebarOpen = false"
     x-transition.opacity
     style="display: none;"
     class="md:hidden fixed inset-0 bg-slate-900/50 z-30 backdrop-blur-sm">
</div>

<aside class="w-20 bg-slate-900 flex flex-col items-center py-6 shadow-xl z-40 shrink-0 absolute inset-y-0 left-0 md:relative h-full transition-transform duration-300 ease-in-out"
       :class="{'translate-x-0': sidebarOpen, '-translate-x-full md:translate-x-0': !sidebarOpen}">
    
    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center text-white font-bold text-xl mb-10 shadow-lg shadow-orange-500/30">
        L
    </div>

    <nav class="flex flex-col gap-4 w-full px-3">
        <a href="{{ route('admin.dashboard') }}" 
           class="w-full aspect-square rounded-xl flex items-center justify-center transition-all group relative {{ Request::is('admin/dashboard') ? 'bg-slate-800 text-orange-500' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span class="absolute left-16 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none whitespace-nowrap">Dashboard</span>
        </a>

        <a href="{{ route('admin.pendaftar.index') }}" 
            class="w-full aspect-square rounded-xl flex items-center justify-center transition-all group relative {{ request()->routeIs('admin.pendaftar.index') ? 'bg-slate-800 text-orange-500' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            
            <span class="absolute left-16 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none whitespace-nowrap z-50 shadow-md">
                Data Pendaftar
            </span>
        </a>

        <a href="{{ route('admin.pendaftar.infoPendaftar') }}" 
        class="w-full aspect-square rounded-xl flex items-center justify-center transition-all group relative {{ request()->routeIs('admin.pendaftar.infoPendaftar') ? 'bg-slate-800 text-orange-500' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"></path>
            </svg>
            
            <span class="absolute left-16 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none whitespace-nowrap z-50 shadow-md">
                Info Akun
            </span>
        </a>
    </nav>
</aside>