@extends('layouts.admin.app')

@section('title', 'Data Pendaftar')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Manajemen Data Pendaftar</h1>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-sm text-slate-500">
                    <th class="py-4 px-6 font-semibold">No. Reg</th>
                    <th class="py-4 px-6 font-semibold">Nama Lengkap</th>
                    <th class="py-4 px-6 font-semibold">Program</th>
                    <th class="py-4 px-6 font-semibold">Tanggal Daftar</th>
                    <th class="py-4 px-6 font-semibold">Status Saat Ini</th>
                    <th class="py-4 px-6 font-semibold text-center">Aksi Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                @forelse($pendaftars as $p)
                <tr class="hover:bg-slate-50 transition">
                    <td class="py-4 px-6 font-medium text-slate-900">REG-{{ str_pad($p->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td class="py-4 px-6">
                        <div class="font-bold">{{ $p->nama }}</div>
                        <div class="text-xs text-slate-500">NIK: {{ $p->nik }}</div>
                    </td>
                    <td class="py-4 px-6 capitalize">{{ $p->program_beasiswa }}</td>
                    <td class="py-4 px-6">{{ $p->created_at->format('d M Y') }}</td>
                    <td class="py-4 px-6">
                        @php
                            $color = match($p->status) {
                                'pending' => 'bg-amber-100 text-amber-700',
                                'diproses' => 'bg-blue-100 text-blue-700',
                                'diterima' => 'bg-green-100 text-green-700',
                                'ditolak'  => 'bg-red-100 text-red-700',
                                default    => 'bg-slate-100 text-slate-700',
                            };
                        @endphp
                        <span class="{{ $color }} px-3 py-1 rounded-full text-xs font-bold capitalize">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <form action="{{ route('admin.pendaftar.updateStatus', $p->id) }}" method="POST" class="flex justify-center gap-2">
                            @csrf
                            <button type="submit" name="status" value="diproses" title="Tandai Sedang Diproses"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </button>
                            <button type="submit" name="status" value="diterima" title="Terima Pendaftar"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center bg-green-50 text-green-600 hover:bg-green-600 hover:text-white transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                            <button type="submit" name="status" value="ditolak" title="Tolak Pendaftar"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-slate-500">Belum ada data pendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection