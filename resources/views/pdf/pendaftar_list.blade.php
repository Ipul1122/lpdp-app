<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laporan Data Pendaftar TUBEL - {{ now()->format('d-m-Y') }}</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<link rel="icon" type="image/png" href="{{ asset('storage/lpdp-icon.png') }}">
	<style>
		@media print {
			.no-print {
				display: none !important;
			}
			body {
				background-color: white !important;
				color: black !important;
			}
			.print-card {
				border: none !important;
				box-shadow: none !important;
				padding: 0 !important;
			}
			.page-break {
				page-break-before: always;
			}
		}
	</style>
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased p-4 sm:p-8">

	<!-- Top Action Bar (Hidden on Print) -->
	<div class="max-w-6xl mx-auto mb-6 no-print flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
		<a href="{{ route('admin.pendaftar.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition">
			<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
			Kembali ke Manajemen Pendaftar
		</a>
		<button onclick="window.print()" class="px-5 py-2.5 bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-orange-100 flex items-center gap-2">
			<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
			Cetak / Simpan PDF
		</button>
	</div>

	<!-- Main Printable Content -->
	<div class="max-w-6xl mx-auto bg-white border border-slate-200 rounded-3xl p-8 sm:p-12 shadow-sm print-card">
		
		<!-- Header Kop Surat -->
		<div class="flex items-center justify-between border-b-4 border-double border-slate-900 pb-6 mb-8">
			<div class="flex items-center gap-4">
				<div class="w-14 h-14 bg-white border border-slate-100 rounded-2xl flex items-center justify-center p-2 shadow-sm no-print">
					<img src="{{ asset('storage/lpdp-icon.png') }}" alt="Logo" class="w-12 h-12 object-contain">
				</div>
				<div>
					<h1 class="text-2xl font-black tracking-tight text-slate-900">TUBEL<span class="text-orange-500">App</span></h1>
					<p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Laporan Hasil Seleksi & Pendaftaran Beasiswa Tugas Belajar</p>
				</div>
			</div>
			<div class="text-right">
				<span class="inline-block px-3 py-1 bg-slate-100 text-slate-800 font-bold text-xs rounded-full border border-slate-200">
					LAPORAN PENDAFTAR
				</span>
				<span class="block text-xs text-slate-500 font-bold mt-2">
					Tanggal Cetak: {{ now()->translatedFormat('d F Y') }}
				</span>
			</div>
		</div>

		<div>
			<h2 class="text-center font-bold text-lg text-slate-900 mb-6 uppercase tracking-wider">Daftar Pendaftar Beasiswa Tugas Belajar (TUBEL)</h2>

			<div class="overflow-x-auto">
				<table class="w-full text-left border-collapse text-xs">
					<thead>
						<tr class="border-b border-slate-300 bg-slate-100 font-bold text-slate-700">
							<th class="py-3 px-2 text-center border border-slate-300 w-8">No</th>
							<th class="py-3 px-2 border border-slate-300">ID Reg</th>
							<th class="py-3 px-2 border border-slate-300">Nama Lengkap</th>
							<th class="py-3 px-2 border border-slate-300">Program</th>
							<th class="py-3 px-2 border border-slate-300">Kategori</th>
							<th class="py-3 px-2 border border-slate-300">Unit Kerja</th>
							<th class="py-3 px-2 border border-slate-300">Universitas Tujuan</th>
							<th class="py-3 px-2 text-center border border-slate-300">Status</th>
							<th class="py-3 px-2 border border-slate-300">Tanggal Submit</th>
						</tr>
					</thead>
					<tbody class="text-slate-800">
						@forelse($pendaftars as $index => $p)
							<tr class="border-b border-slate-200 hover:bg-slate-50">
								<td class="py-2.5 px-2 text-center border border-slate-200 font-medium">{{ $index + 1 }}</td>
								<td class="py-2.5 px-2 border border-slate-200 font-bold">REG-{{ str_pad($p->user_id, 5, '0', STR_PAD_LEFT) }}</td>
								<td class="py-2.5 px-2 border border-slate-200 font-semibold text-slate-900">{{ $p->nama ?? '-' }}</td>
								<td class="py-2.5 px-2 border border-slate-200 capitalize">{{ $p->program_beasiswa ?? '-' }}</td>
								<td class="py-2.5 px-2 border border-slate-200 font-medium text-orange-600">{{ $p->kategori ?? '-' }}</td>
								<td class="py-2.5 px-2 border border-slate-200">{{ $p->industri?->unit_kerja ?? '-' }}</td>
								<td class="py-2.5 px-2 border border-slate-200 font-medium">{{ $p->universitas?->nama_universitas ?? '-' }}</td>
								<td class="py-2.5 px-2 text-center border border-slate-200">
									@php
										$statusClass = match($p->status) {
											'pending' => 'text-amber-700 bg-amber-50 font-bold px-2 py-0.5 rounded-full border border-amber-200',
											'diterima' => 'text-green-700 bg-green-50 font-bold px-2 py-0.5 rounded-full border border-green-200',
											'ditolak'  => 'text-red-700 bg-red-50 font-bold px-2 py-0.5 rounded-full border border-red-200',
											default    => 'text-slate-700 bg-slate-50 font-bold px-2 py-0.5 rounded-full border border-slate-200',
										};
									@endphp
									<span class="{{ $statusClass }} uppercase text-[10px]">{{ $p->status }}</span>
								</td>
								<td class="py-2.5 px-2 border border-slate-200 whitespace-nowrap">{{ $p->submitted_at ? $p->submitted_at->translatedFormat('d-m-Y H:i') : '-' }}</td>
							</tr>
						@empty
							<tr>
								<td colspan="9" class="text-center py-6 border border-slate-200 text-slate-500 italic">Tidak ada data pendaftar yang sesuai filter.</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>

			<!-- Laporan Footer Penandatangan -->
			<div class="pt-16 mt-8 flex justify-between items-start text-xs">
				<div>
					<span class="block text-slate-400 font-bold uppercase">Total Pendaftar</span>
					<p class="font-bold text-slate-800 text-lg mt-1">{{ count($pendaftars) }} Orang</p>
				</div>
				<div class="text-center w-64">
					<p class="text-slate-600 font-semibold mb-20">Administrator Sistem,</p>
					<div class="border-b border-slate-400 w-full mx-auto"></div>
					<p class="font-bold text-slate-800 mt-2">Tim Penilai TUBELApp</p>
					<p class="text-slate-500">NIP. _____________________</p>
				</div>
			</div>

		</div>

	</div>

	<!-- Automatically open print dialog -->
	<script>
		window.onload = function() {
			setTimeout(function() {
				window.print();
			}, 500);
		};
	</script>
</body>
</html>
