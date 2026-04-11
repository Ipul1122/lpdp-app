<div x-show="sidebarOpen" 
     @click="sidebarOpen = false"
     x-transition.opacity
     style="display: none;"
     class="md:hidden fixed inset-0 bg-slate-900/50 z-40 backdrop-blur-sm">
</div>

<aside class="w-20 bg-white border-r border-slate-200 h-screen fixed left-0 top-0 flex flex-col items-center py-6 z-50 transition-transform duration-300 ease-in-out md:translate-x-0"
       :class="{'translate-x-0 shadow-2xl': sidebarOpen, '-translate-x-full': !sidebarOpen}">
    
    <a href="{{ route('dashboard') }}" class="mb-10">
        <div class="w-10 h-10 flex items-center justify-center">
            <svg class="w-8 h-8 text-orange-500" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C12 2 7 7 7 12C7 14.76 9.24 17 12 17C14.76 17 17 14.76 17 12C17 7 12 2 12 2ZM12 22C8.13 22 5 18.87 5 15C5 12.44 6.37 10.2 8.41 8.92C8.15 9.87 8 10.91 8 12C8 16.42 11.58 20 16 20C14.91 21.24 13.53 22 12 22Z" />
            </svg>
        </div>
    </a>
    
    

    <nav class="flex flex-col space-y-4 w-full px-3">
        
        <a href="{{ route('dashboard') }}" 
           class="w-full aspect-square rounded-2xl flex items-center justify-center transition-all duration-200 
           {{ Request::is('dashboard') ? 'bg-orange-500 text-white shadow-md shadow-orange-200' : 'text-slate-400 hover:bg-orange-50 hover:text-orange-500' }}"
           title="Beranda">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </a>

        <a href="{{ route('pendaftaran.index') }}" 
           class="w-full aspect-square rounded-2xl flex items-center justify-center transition-all duration-200 text-slate-400 hover:bg-orange-50 hover:text-orange-500"
           title="Pendaftaran">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </a>

        <a href="{{route('riwayat.index')}}" 
           class="w-full aspect-square rounded-2xl flex items-center justify-center transition-all duration-200 text-slate-400 hover:bg-orange-50 hover:text-orange-500"
           title="Riwayat">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </a>

    </nav>
</aside>