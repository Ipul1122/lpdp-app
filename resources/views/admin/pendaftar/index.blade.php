@extends('layouts.admin.app')

@section('title', 'Data Pendaftar')

@section('content')
<div class="max-w-full mx-auto">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Manajemen Data Pendaftar</h1>

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.pendaftar.index') }}" 
           class="px-4 py-2 text-sm font-semibold rounded-xl transition border {{ !request('filter') ? 'bg-orange-500 text-white border-orange-500 shadow-md' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
            Semua Pendaftar
        </a>
        <a href="{{ route('admin.pendaftar.index', ['filter' => 'pengajuan_ulang']) }}" 
           class="px-4 py-2 text-sm font-semibold rounded-xl transition border {{ request('filter') == 'pengajuan_ulang' ? 'bg-orange-500 text-white border-orange-500 shadow-md' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
            Pengajuan Ulang
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-sm text-slate-500">
                        <th class="py-4 px-6 font-semibold">Data Pribadi</th>
                        <th class="py-4 px-6 font-semibold">Alamat Domisili</th>
                        <th class="py-4 px-6 font-semibold">Profil Tambahan</th>
                        <th class="py-4 px-6 font-semibold">Program & Berkas</th>
                        <th class="py-4 px-6 font-semibold text-center">Status & Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($pendaftars as $p)
                    <tr class="hover:bg-slate-50 transition">
                        
                        <td class="py-4 px-6 align-top">
                            <div class="font-bold text-slate-900 text-base mb-1">
                                {{ $p->nama }}
                                
                                {{-- Badge Penanda Pengajuan Ulang --}}
                                @if($p->is_pengajuan_ulang)
                                    <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 text-purple-700 border border-purple-200 align-middle">
                                        Pengajuan Ulang
                                    </span>
                                @endif
                            </div>
                            <div class="flex flex-col gap-0.5 text-xs text-slate-500">
                                <span><strong class="text-slate-600">ID:</strong> REG-{{ str_pad($p->user_id, 5, '0', STR_PAD_LEFT) }}</span>
                                <span><strong class="text-slate-600">NIK:</strong> {{ $p->nik }}</span>
                                <span><strong class="text-slate-600">TTL:</strong> {{ $p->tempat_tglLahir }}</span>
                                <span><strong class="text-slate-600">WA:</strong> {{ $p->no_telp }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-6 align-top">
                            <div class="font-medium text-slate-800 mb-1 truncate max-w-[200px]" title="{{ $p->alamat }}">
                                {{ $p->alamat }}
                            </div>
                            <div class="flex flex-col gap-0.5 text-xs text-slate-500">
                                <span>RT {{ str_pad($p->rt, 3, '0', STR_PAD_LEFT) }} / RW {{ str_pad($p->rw, 3, '0', STR_PAD_LEFT) }}</span>
                                <span>Kel. {{ $p->kelurahan }}</span>
                                <span>Kec. {{ $p->kecamatan }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-6 align-top">
                            <div class="flex flex-col gap-1 text-xs text-slate-600">
                                <span><strong>Agama:</strong> {{ $p->agama }}</span>
                                <span><strong>Status:</strong> {{ $p->status_perkawinan }}</span>
                                <span class="truncate max-w-[150px]" title="{{ $p->pekerjaan }}"><strong>Kerja:</strong> {{ $p->pekerjaan }}</span>
                                <span><strong>Warga:</strong> {{ $p->kewarganegaraan }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-6 align-top">
                            <div class="font-bold text-slate-800 capitalize mb-2">Beasiswa {{ $p->program_beasiswa }}</div>
                            @if($p->foto_ktp)
                                <a href="{{ asset('storage/' . $p->foto_ktp) }}"  class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg transition border border-blue-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Cek Foto KTP
                                </a>
                            @else
                                <span class="text-xs text-red-500 italic">KTP Tidak Ada</span>
                            @endif
                        </td>

                        <td class="py-4 px-6 align-top text-center">
                            @php
                                $color = match($p->status) {
                                    'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                    'diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                    'diterima' => 'bg-green-100 text-green-700 border-green-200',
                                    'ditolak'  => 'bg-red-100 text-red-700 border-red-200',
                                    default    => 'bg-slate-100 text-slate-700 border-slate-200',
                                };
                                
                                // Format nomor WA (Ubah 0 jadi 62)
                                $phone = $p->no_telp;
                                if(str_starts_with($phone, '0')) {
                                    $phone = '62' . substr($phone, 1);
                                }
                                
                                // Pesan WA Diterima
                                $msgTerima = "Selamat, nama anda " . $p->nama . " diterima beasiswa " . ucfirst($p->program_beasiswa) . ".";
                            @endphp

                            <div class="mb-3">
                                <span class="{{ $color }} px-3 py-1 rounded-full text-xs font-bold capitalize border inline-block">
                                    {{ $p->status }}
                                </span>
                                
                                @if($p->status === 'ditolak' && $p->catatan)
                                    <div class="mt-2 text-[10px] text-red-600 font-medium bg-red-50 p-2 rounded-lg border border-red-100 text-left max-w-[200px] mx-auto leading-relaxed whitespace-normal">
                                        <span class="font-bold block mb-0.5">Catatan Penolakan:</span>
                                        {{ $p->catatan }}
                                    </div>
                                @endif
                            </div>

                            <form id="form-status-{{ $p->id }}" action="{{ route('admin.pendaftar.updateStatus', $p->id) }}" method="POST" class="flex justify-center gap-1.5">
                                @csrf
                                
                                <button type="submit" name="status" value="diterima" title="Terima & Kirim WA" 
                                        onclick="window.open('https://wa.me/{{ $phone }}?text={{ urlencode($msgTerima) }}', '_blank');" 
                                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 text-green-600 hover:bg-green-600 hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                                
                                <button type="button" title="Tolak & Tulis Catatan WA" 
                                        onclick="konfirmasiTolak('{{ $p->id }}', '{{ $phone }}', '{{ addslashes($p->nama) }}', '{{ ucfirst($p->program_beasiswa) }}')" 
                                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 text-red-600 hover:bg-red-600 hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-slate-500">Belum ada pendaftar masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function konfirmasiTolak(pendaftarId, phone, nama, program) {
        let selectedCatatan = null;
        
        Swal.fire({
            title: 'Tolak & Beri Catatan',
            html: `
                <p class="text-sm text-slate-700 font-semibold mb-4 text-left">Pilih alasan penolakan untuk <b>${nama}</b>:</p>
                <div class="space-y-2 text-left">
                    <label class="flex items-center p-3 border-2 border-slate-200 rounded-lg cursor-pointer hover:border-red-300 hover:bg-red-50 transition" onclick="selectCatatan('KTP buram', event)">
                        <input type="radio" name="catatanPreset" value="KTP buram" class="w-4 h-4 text-red-600">
                        <span class="ml-3 text-sm font-medium text-slate-700">KTP buram</span>
                    </label>
                    <label class="flex items-center p-3 border-2 border-slate-200 rounded-lg cursor-pointer hover:border-red-300 hover:bg-red-50 transition" onclick="selectCatatan('Data tidak valid', event)">
                        <input type="radio" name="catatanPreset" value="Data tidak valid" class="w-4 h-4 text-red-600">
                        <span class="ml-3 text-sm font-medium text-slate-700">Data tidak valid</span>
                    </label>
                </div>
                <div class="mt-4 mb-3 flex items-center gap-2">
                    <div class="flex-1 h-px bg-slate-300"></div>
                    <span class="text-xs text-slate-500 font-semibold">ATAU</span>
                    <div class="flex-1 h-px bg-slate-300"></div>
                </div>
                <p class="text-sm text-slate-700 font-semibold mb-2 text-left">Tulis catatan custom:</p>
                <textarea id="catatanTolak" class="w-full px-4 py-3 border-2 border-slate-300 rounded-xl focus:ring-2 focus:ring-red-500 outline-none resize-none text-sm" rows="3" placeholder="Contoh: Transkrip nilai tidak lengkap..."></textarea>
            `,
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Tolak & Kirim WA',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const textarea = document.getElementById('catatanTolak').value;
                const selectedRadio = document.querySelector('input[name="catatanPreset"]:checked');
                
                let catatan = null;
                if (selectedRadio && selectedRadio.value) {
                    catatan = selectedRadio.value;
                } else if (textarea) {
                    catatan = textarea;
                }
                
                if (!catatan) {
                    Swal.showValidationMessage('Pilih salah satu opsi atau tulis catatan custom!');
                }
                return catatan;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let catatan = result.value;
                let form = document.getElementById('form-status-' + pendaftarId);
                
                // Tambahkan catatan ke form secara dinamis
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

                // Buat pesan WA dinamis termasuk catatan admin
                let waText = `Mohon maaf, nama anda ${nama} ditolak untuk beasiswa ${program}.\n\nCatatan dari Admin: ${catatan}`;
                
                // Buka tab WhatsApp
                window.open('https://wa.me/' + phone + '?text=' + encodeURIComponent(waText), '_blank');

                // Submit data ke Laravel
                form.submit();
            }
        });
    }
    
    function selectCatatan(value, event) {
        // Uncheck semua radio button
        document.querySelectorAll('input[name="catatanPreset"]').forEach(radio => {
            radio.checked = false;
        });
        // Check radio button yang sesuai
        event.currentTarget.querySelector('input[name="catatanPreset"]').checked = true;
        // Clear textarea jika ada opsi preset yang dipilih
        document.getElementById('catatanTolak').value = '';
    }
</script>
@endsection