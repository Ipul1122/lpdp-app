<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-8 shrink-0 z-10">
    
    <div class="flex items-center gap-3">
        <button @click="sidebarOpen = !sidebarOpen" 
                class="md:hidden p-2 -ml-2 rounded-lg text-slate-500 hover:bg-slate-100 transition focus:outline-none">
            
            <svg x-show="!sidebarOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            
            <svg x-show="sidebarOpen" style="display: none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </button>

        <h2 class="font-bold text-slate-700 truncate">Administrator Panel</h2>
    </div>
    
    <div class="flex items-center gap-4 md:gap-6">
        <div class="h-8 w-px bg-slate-200 hidden md:block"></div>

        <div class="flex items-center gap-4">
            <span class="text-sm text-slate-500 font-medium hidden md:block">{{ Auth::guard('admin')->user()->name }}</span>
            
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </div>
</header>