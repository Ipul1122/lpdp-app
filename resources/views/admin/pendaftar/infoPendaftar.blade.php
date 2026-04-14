@extends('layouts.admin.app')
@section('title', 'Informasi Akun Pendaftar')

@section('content')
<div class="max-w-7xl mx-auto pb-20">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Informasi Akun Pendaftar</h1>
            <p class="text-slate-500 text-sm mt-1">Daftar lengkap akun pengguna yang telah terdaftar di sistem beserta data kontaknya.</p>
        </div>
        
        <a href="{{ route('admin.pendaftar.index') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-4 py-2 rounded-xl text-sm font-bold transition shadow-sm shrink-0">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Berkas
        </a>
    </div>

    <form action="{{ route('admin.pendaftar.infoPendaftar') }}" method="GET" class="mb-6 flex flex-col md:flex-row gap-3">
        
        <div class="relative flex-1">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama, email, atau telepon..." 
                   class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none text-sm transition-all shadow-sm">
        </div>

        <select name="filter" class="border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none text-sm text-slate-600 bg-white shadow-sm cursor-pointer md:w-56">
            <option value="">Semua Pendaftar</option>
            <option value="lengkap" {{ ($filter ?? '') == 'lengkap' ? 'selected' : '' }}>Sudah Isi Profil</option>
            <option value="belum_lengkap" {{ ($filter ?? '') == 'belum_lengkap' ? 'selected' : '' }}>Belum Isi Profil</option>
        </select>

        <div class="flex gap-2">
            <button type="submit" class="bg-slate-800 text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-slate-700 transition shadow-sm flex items-center justify-center min-w-[100px]">
                Cari
            </button>
            
            @if(!empty($search) || !empty($filter))
                <a href="{{ route('admin.pendaftar.infoPendaftar') }}" class="bg-slate-100 text-slate-500 border border-slate-200 px-4 py-3 rounded-xl text-sm font-bold hover:bg-slate-200 hover:text-slate-700 transition shadow-sm flex items-center justify-center shrink-0" title="Reset Pencarian">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
            @endif
        </div>
    </form>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-sm">
                        <th class="py-4 px-6 font-semibold text-slate-600 whitespace-nowrap">No. REG</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 whitespace-nowrap">Nama Lengkap</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 whitespace-nowrap">Email (Akun Login)</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 whitespace-nowrap">No. Telepon / WA</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 whitespace-nowrap">Password</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-6 font-bold text-slate-800">
                                REG-{{ str_pad($user->reg_id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-4 px-6">
                                @if($user->nama)
                                    <span class="font-medium text-slate-700">{{ $user->nama }}</span>
                                @else
                                    <span class="text-amber-500 italic text-xs bg-amber-50 px-2 py-1 rounded">Belum isi profil</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-slate-600">
                                <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:underline flex items-center gap-1 w-max">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td class="py-4 px-6 text-slate-600">
                                @if($user->no_telp)
                                    @php
                                        $phone = $user->no_telp;
                                        if(str_starts_with($phone, '0')) $phone = '62' . substr($phone, 1);
                                    @endphp
                                    <a href="https://wa.me/{{ $phone }}" target="_blank" class="text-green-600 hover:underline flex items-center gap-1 font-medium w-max">
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        {{ $user->no_telp }}
                                    </a>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="bg-slate-100 text-slate-500 px-2 py-1 rounded text-xs flex items-center gap-1 w-max cursor-help" title="Password dienkripsi demi keamanan">
                                    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    Terenskripsi
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 px-6 text-center text-slate-500">
                                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                @if(!empty($search) || !empty($filter))
                                    Tidak ada pendaftar yang cocok dengan pencarian Anda.
                                @else
                                    Belum ada pendaftar di sistem.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-slate-100 bg-slate-50">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection