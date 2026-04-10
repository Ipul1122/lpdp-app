@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold text-slate-800 mb-8">Ikhtisar Pendaftaran</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 border-l-4 border-l-slate-800">
            <p class="text-slate-500 text-sm font-semibold mb-1">Total Pendaftar Keseluruhan</p>
            <h3 class="text-4xl font-black text-slate-800">{{ $totalPendaftar }}</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 border-l-4 border-l-amber-400">
            <p class="text-slate-500 text-sm font-semibold mb-1">Menunggu Review (Pending)</p>
            <h3 class="text-4xl font-black text-amber-500">{{ $totalPending }}</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 border-l-4 border-l-green-500">
            <p class="text-slate-500 text-sm font-semibold mb-1">Berkas Diterima</p>
            <h3 class="text-4xl font-black text-green-500">{{ $totalDiterima }}</h3>
        </div>
    </div>
</div>
@endsection