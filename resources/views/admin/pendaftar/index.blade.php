@extends('layouts.admin.app')
@section('title', 'Data Pendaftar')

@section('content')
<div class="max-w-6xl mx-auto pb-20">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Data Pendaftar</h1>
            <p class="text-slate-500 text-sm mt-1">Review berkas dan tentukan status kelulusan pendaftar beasiswa.</p>
        </div>
        
        <div class="flex bg-slate-200 p-1 rounded-xl">
            <a href="?filter=baru" class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ $filterActive == 'baru' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Baru</a>
            <a href="?filter=pengajuan_ulang" class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ $filterActive == 'pengajuan_ulang' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Revisi</a>
            <a href="?filter=disetujui" class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ $filterActive == 'disetujui' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Diterima</a>
            <a href="?filter=ditolak" class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ $filterActive == 'ditolak' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Ditolak</a>
        </div>
    </div>

    <div class="space-y-6">
        @forelse($pendaftars as $p)
            @php
                $phone = $p->no_telp;
                if(str_starts_with($phone, '0')) $phone = '62' . substr($phone, 1);
                $msgTerima = "Selamat, nama anda " . $p->nama . " diterima beasiswa " . ucfirst($p->program_beasiswa) . ".";
            @endphp

            <div x-data="{ detailOpen: false }" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden transition-all duration-300 hover:border-slate-300">
                
                <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 cursor-pointer bg-slate-50 hover:bg-slate-100 transition" @click="detailOpen = !detailOpen">
                    
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-lg shrink-0">
                            {{ strtoupper(substr($p->nama, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-slate-800">{{ $p->nama }}</h3>
                            <div class="flex items-center gap-2 mt-1 text-xs font-medium">
                                <span class="text-orange-600 bg-orange-100 px-2 py-0.5 rounded capitalize">{{ $p->program_beasiswa }}</span>
                                <span class="text-slate-500">ID: REG-{{ str_pad($p->user_id, 5, '0', STR_PAD_LEFT) }}</span>
                                @if($p->is_pengajuan_ulang) <span class="text-blue-600 bg-blue-100 px-2 py-0.5 rounded">🔄 Revisi Berkas</span> @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between md:justify-end gap-6 w-full md:w-auto">
                        <div class="text-left md:text-right">
                            <span class="block text-xs text-slate-400 mb-1">Status Pendaftaran</span>
                            @php
                                $statusColor = match($p->status) {
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'diterima' => 'bg-green-100 text-green-700',
                                    'ditolak'  => 'bg-red-100 text-red-700',
                                    default    => 'bg-slate-100 text-slate-700',
                                };
                            @endphp
                            <span class="{{ $statusColor }} px-3 py-1 rounded-full text-xs font-bold capitalize">{{ $p->status }}</span>
                        </div>
                        <button type="button" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-50 transition">
                            <svg :class="{'rotate-180': detailOpen}" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>
                </div>

                <div x-show="detailOpen" x-transition style="display: none;" class="p-6 border-t border-slate-200 bg-white space-y-4">
                    
                    @if($p->status === 'ditolak' && $p->catatan)
                        <div class="bg-red-50 border border-red-100 text-red-700 p-4 rounded-xl mb-4 text-sm">
                            <b>Riwayat Penolakan Admin:</b> {{ $p->catatan }}
                        </div>
                    @endif

                    <div x-data="{ tab1: true }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab1 = !tab1" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">1</span> Data Pribadi & KTP</span>
                            <svg :class="{'rotate-180': tab1}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab1" class="p-5 border-t border-slate-100 text-sm grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div><span class="block text-slate-400 text-xs mb-1">NIK</span><p class="font-semibold text-slate-800">{{ $p->nik }}</p></div>
                            <div><span class="block text-slate-400 text-xs mb-1">Nama</span><p class="font-semibold text-slate-800">{{ $p->nama }}</p></div>
                            <div><span class="block text-slate-400 text-xs mb-1">TTL</span><p class="font-semibold text-slate-800">{{ $p->tempat_tglLahir }}</p></div>
                            <div><span class="block text-slate-400 text-xs mb-1">Telepon/WA</span><p class="font-semibold text-slate-800">{{ $p->no_telp }}</p></div>
                            <div class="col-span-2"><span class="block text-slate-400 text-xs mb-1">Alamat</span><p class="font-semibold text-slate-800">{{ $p->alamat }}, RT {{ $p->rt }}/RW {{ $p->rw }}, {{ $p->kelurahan }}, {{ $p->kecamatan }}</p></div>
                            <div class="col-span-2">
                                <span class="block text-slate-400 text-xs mb-1">Dokumen KTP</span>
                                @if($p->foto_ktp) <a href="{{ asset('storage/' . $p->foto_ktp) }}" target="_blank" class="text-blue-600 hover:underline font-semibold flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Lihat Foto KTP</a> @else <span class="text-red-500">Tidak ada</span> @endif
                            </div>
                        </div>
                    </div>

                    <div x-data="{ tab2: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab2 = !tab2" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">2</span> Industri / Pendukung</span>
                            <svg :class="{'rotate-180': tab2}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab2" style="display:none;" class="p-5 border-t border-slate-100 text-sm grid grid-cols-1 md:grid-cols-3 gap-4">
                            @if($p->industri)
                                <div><span class="block text-slate-400 text-xs mb-1">Nama Instansi</span><p class="font-semibold text-slate-800">{{ $p->industri->nama_instansi ?? '-' }}</p></div>
                                <div><span class="block text-slate-400 text-xs mb-1">Pekerjaan</span><p class="font-semibold text-slate-800">{{ $p->industri->pekerjaan ?? '-' }}</p></div>
                                <div><span class="block text-slate-400 text-xs mb-1">Status Pegawai</span><p class="font-semibold text-slate-800">{{ $p->industri->status_kepegawaian ?? '-' }}</p></div>
                                <div class="col-span-3">
                                    <span class="block text-slate-400 text-xs mb-1">Surat Izin Instansi</span>
                                    @if($p->industri->surat_izin) <a href="{{ asset('storage/' . $p->industri->surat_izin) }}" target="_blank" class="text-blue-600 hover:underline font-semibold flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg> Buka Surat Izin</a> @else <span class="text-slate-500">Tidak dilampirkan</span> @endif
                                </div>
                            @else <p class="text-slate-500 italic col-span-3">Data belum diisi.</p> @endif
                        </div>
                    </div>

                    <div x-data="{ tab3: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab3 = !tab3" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">3</span> Universitas Tujuan</span>
                            <svg :class="{'rotate-180': tab3}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab3" style="display:none;" class="p-5 border-t border-slate-100 text-sm grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($p->universitas)
                                <div><span class="block text-slate-400 text-xs mb-1">Universitas</span><p class="font-semibold text-slate-800">{{ $p->universitas->nama_universitas ?? '-' }}</p></div>
                                <div><span class="block text-slate-400 text-xs mb-1">Program Studi</span><p class="font-semibold text-slate-800">{{ $p->universitas->program_studi ?? '-' }}</p></div>
                                <div>
                                    <span class="block text-slate-400 text-xs mb-1">LoA / Bukti Lulus</span>
                                    @if($p->universitas->loa) <a href="{{ asset('storage/' . $p->universitas->loa) }}" target="_blank" class="text-blue-600 hover:underline font-semibold inline-flex items-center gap-1">📄 Lihat Dokumen LoA</a> @else <span class="text-slate-500">-</span> @endif
                                </div>
                                <div>
                                    <span class="block text-slate-400 text-xs mb-1">KHS / Bukti IPK</span>
                                    @if($p->universitas->khs_ipk) <a href="{{ asset('storage/' . $p->universitas->khs_ipk) }}" target="_blank" class="text-blue-600 hover:underline font-semibold inline-flex items-center gap-1">📄 Lihat KHS/IPK</a> @else <span class="text-slate-500">-</span> @endif
                                </div>
                            @else <p class="text-slate-500 italic col-span-2">Data belum diisi.</p> @endif
                        </div>
                    </div>

                    <div x-data="{ tab4: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab4 = !tab4" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">4</span> Profil / Biodata</span>
                            <svg :class="{'rotate-180': tab4}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab4" style="display:none;" class="p-5 border-t border-slate-100 text-sm space-y-4">
                            @if($p->biodata)
                                <div><span class="block text-slate-400 text-xs mb-1">Deskripsi Diri</span><p class="font-medium text-slate-700 whitespace-pre-wrap">{{ $p->biodata->deskripsi_diri ?? '-' }}</p></div>
                                <div><span class="block text-slate-400 text-xs mb-1">Prestasi</span><p class="font-medium text-slate-700 whitespace-pre-wrap">{{ $p->biodata->prestasi ?? '-' }}</p></div>
                            @else <p class="text-slate-500 italic">Data belum diisi.</p> @endif
                        </div>
                    </div>

                    <div x-data="{ tab5: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab5 = !tab5" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">5</span> Surat Rekomendasi</span>
                            <svg :class="{'rotate-180': tab5}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab5" style="display:none;" class="p-5 border-t border-slate-100 text-sm">
                            @if($p->rekomendasi)
                                <p class="mb-2"><b>Perekomendasi:</b> {{ $p->rekomendasi->nama_perekomendasi ?? '-' }} ({{ $p->rekomendasi->jabatan_perekomendasi ?? '-' }} - {{ $p->rekomendasi->instansi_perekomendasi ?? '-' }})</p>
                                @if($p->rekomendasi->file_rekomendasi) <a href="{{ asset('storage/' . $p->rekomendasi->file_rekomendasi) }}" target="_blank" class="text-blue-600 hover:underline font-semibold inline-flex items-center gap-1">📄 Lihat Surat Rekomendasi</a> @endif
                            @else <p class="text-slate-500 italic">Data belum diisi.</p> @endif
                        </div>
                    </div>

                    <div x-data="{ tab6: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="tab6 = !tab6" class="w-full px-5 py-3 bg-slate-50 flex justify-between items-center outline-none">
                            <span class="font-bold text-sm text-slate-700"><span class="bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded text-xs mr-2">6</span> Essay Kontribusi</span>
                            <svg :class="{'rotate-180': tab6}" class="w-4 h-4 text-slate-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="tab6" style="display:none;" class="p-5 border-t border-slate-100 text-sm">
                            @if($p->essay)
                                <div class="bg-slate-50 p-4 rounded-xl leading-relaxed whitespace-pre-wrap font-medium text-slate-700 max-h-60 overflow-y-auto">{{ $p->essay->essay_kontribusi }}</div>
                            @else <p class="text-slate-500 italic">Data belum diisi.</p> @endif
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-slate-200 flex flex-col md:flex-row justify-end items-center gap-4 bg-slate-50 p-4 rounded-xl">
                        <span class="text-sm font-semibold text-slate-600">Tentukan Status Pendaftar:</span>
                        
                        <form id="form-status-{{ $p->id }}" action="{{ route('admin.pendaftar.updateStatus', $p->id) }}" method="POST" class="flex gap-2 w-full md:w-auto">
                            @csrf
                            
                            <button type="button" onclick="konfirmasiTolak('{{ $p->id }}', '{{ $phone }}', '{{ addslashes($p->nama) }}', '{{ ucfirst($p->program_beasiswa) }}')" 
                                    class="flex-1 md:flex-none px-6 py-2.5 rounded-xl flex items-center justify-center gap-2 bg-white border-2 border-red-500 text-red-600 hover:bg-red-50 transition font-bold text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Tolak Berkas
                            </button>

                            <button type="submit" name="status" value="diterima" 
                                    onclick="window.open('https://wa.me/{{ $phone }}?text={{ urlencode($msgTerima) }}', '_blank');" 
                                    class="flex-1 md:flex-none px-6 py-2.5 rounded-xl flex items-center justify-center gap-2 bg-green-600 text-white hover:bg-green-700 transition font-bold text-sm shadow-lg shadow-green-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                Terima & Luluskan
                            </button>
                        </form>
                    </div>

                </div> </div>
        @empty
            <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-500">
                <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Belum ada pendaftar pada kategori ini.
            </div>
        @endforelse
    </div>

</div>

<script>
    function konfirmasiTolak(pendaftarId, phone, nama, program) {
        Swal.fire({
            title: 'Tolak Berkas & Beri Catatan',
            html: `
                <p class="text-sm text-slate-500 mb-3">Tulis alasan penolakan untuk <b>${nama}</b> agar mereka bisa memperbaiki di tahap revisi:</p>
                <textarea id="catatanTolak" class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-red-500 outline-none resize-none text-sm" rows="3" placeholder="Contoh: File KHS buram, mohon upload ulang PDF yang jelas..."></textarea>
            `,
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Tolak & Kirim Notif',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const catatan = document.getElementById('catatanTolak').value;
                if (!catatan) Swal.showValidationMessage('Catatan alasan tidak boleh kosong!');
                return catatan;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let catatan = result.value;
                let form = document.getElementById('form-status-' + pendaftarId);
                
                let inputCatatan = document.createElement('input');
                inputCatatan.type = 'hidden';
                inputCatatan.name = 'catatan';
                inputCatatan.value = catatan;
                form.appendChild(inputCatatan);
                
                let inputStatus = document.createElement('input');
                inputStatus.type = 'hidden';
                inputStatus.name = 'status';
                inputStatus.value = 'ditolak';
                form.appendChild(inputStatus);

                let waText = `Mohon maaf, berkas pendaftaran beasiswa ${program} atas nama ${nama} *DITOLAK/DIKEMBALIKAN*.\n\n*Catatan Revisi dari Admin:*\n${catatan}\n\nSilakan login ke sistem untuk melakukan revisi pada tahap yang bersangkutan.`;
                window.open('https://wa.me/' + phone + '?text=' + encodeURIComponent(waText), '_blank');

                form.submit();
            }
        });
    }
</script>
@endsection