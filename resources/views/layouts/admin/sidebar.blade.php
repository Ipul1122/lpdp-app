<aside class="w-20 bg-slate-900 flex flex-col items-center py-6 shadow-xl z-20 shrink-0">
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
           class="w-full aspect-square rounded-xl flex items-center justify-center transition-all group relative {{ Request::is('admin/pendaftar*') ? 'bg-slate-800 text-orange-500' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <span class="absolute left-16 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none whitespace-nowrap">Data Pendaftar</span>
        </a>
    </nav>
</aside>