@extends('layouts.app')
@section('title', 'Pendaftaran - Tahap 2')

@section('content')
<div class="max-w-5xl mx-auto mb-10">
    
    @include('pendaftaran.components.stepper', ['step' => 2])

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <form id="step-form" action="{{ route('pendaftaran.step2.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                {{-- Unit Kerja --}}
                @if(isset($userProfile) && in_array($userProfile->program_beasiswa, ['magister', 'dokter']))
                    @php
                        $isMagister = ($userProfile->program_beasiswa === 'magister');
                        $biroList = $isMagister ? [
                            'BIRO UMUM',
                            'BIRO PERSIDANGAN I',
                            'BIRO PROTOKOL DAN HUBUNGAN MASYARAKAT'
                        ] : [
                            'BIRO HUKUM DAN PENGADUAN MASYARAKAT'
                        ];

                        $bagianList = $isMagister ? [
                            'BAGIAN SEKRETARIAT WAKIL KETUA BIDANG INDUSTRI DAN PEMBANGUNAN',
                            'BAGIAN PENERBITAN',
                            'BAGIAN SEKRETARIAT KERJA SAMA ORGANISASI INTERNASIONAL',
                            'BAGIAN PEMBENTUKAN PRODUK HUKUM',
                            'BAGIAN MEDIA CETAK DAN MEDIA SOSIAL',
                            'BAGIAN TELEVISI DAN RADIO PARLEMEN',
                            'BAGIAN PERENCANAAN',
                            'BAGIAN ADMINISTRASI INSPEKTORAT UTAMA',
                            'BAGIAN HUBUNGAN MASYARAKAT DAN PENGELOLAAN MUSEUM',
                            'BAGIAN PENGADAAN BARANG/JASA',
                            'BAGIAN ORGANISASI DAN TATA LAKSANA',
                            'BAGIAN SEKRETARIAT MAHKAMAH KEHORMATAN DEWAN',
                            'BAGIAN SEKRETARIAT KERJA SAMA BILATERAL',
                            'BAGIAN SEKRETARIAT KERJA SAMA ORGANISASI REGIONAL',
                            'BAGIAN SEKRETARIAT KOMISI III',
                            'BAGIAN GEDUNG DAN INSTALASI',
                            'BAGIAN SEKRETARIAT KOMISI IV',
                            'BAGIAN MANAJEMEN KINERJA DAN INFORMASI ASN',
                            'BAGIAN PROTOKOL',
                            'BAGIAN RISALAH',
                            'BAGIAN TATA USAHA PIMPINAN SEKRETARIAT JENDERAL'
                        ] : [
                            'BAGIAN HUBUNGAN MASYARAKAT DAN PENGELOLAAN MUSEUM',
                            'BAGIAN TATA USAHA PIMPINAN SEKRETARIAT JENDERAL',
                            'BAGIAN SEKRETARIAT KOMISI III',
                            'BAGIAN MANAJEMEN KINERJA DAN INFORMASI ASN',
                            'BAGIAN PENGADUAN MASYARAKAT',
                            'BAGIAN ADMINISTRASI BARANG MILIK NEGARA'
                        ];

                        $pusatList = $isMagister ? [
                            'PUSAT TEKNOLOGI INFORMASI',
                            'PUSAT PERANCANGAN UNDANG-UNDANG BIDANG EKONOMI, KEUANGAN, INDUSTRI, PEMBANGUNAN, DAN KESEJAHTERAAN RAKYAT',
                            'PUSAT PEMANTAUAN PELAKSANAAN UNDANG-UNDANG',
                            'PUSAT ANALISIS ANGGARAN DAN AKUNTABILITAS KEUANGAN NEGARA',
                            'PUSAT PERANCANGAN UNDANG-UNDANG BIDANG POLITIK, HUKUM, DAN HAK ASASI MANUSIA',
                            'PUSAT ANALISIS KEPARLEMENAN'
                        ] : [
                            'PUSAT ANALISIS ANGGARAN DAN AKUNTABILITAS KEUANGAN NEGARA',
                            'PUSAT ANALISIS KEPARLEMENAN',
                            'PUSAT PERANCANGAN UNDANG-UNDANG BIDANG POLITIK, HUKUM, DAN HAK ASASI MANUSIA',
                            'PUSAT PEMANTAUAN PELAKSANAAN UNDANG-UNDANG',
                            'PUSAT PERANCANGAN UNDANG-UNDANG BIDANG EKONOMI, KEUANGAN, INDUSTRI, PEMBANGUNAN, DAN KESEJAHTERAAN RAKYAT'
                        ];

                        $inspektoratList = $isMagister ? [
                            'INSPEKTORAT I',
                            'INSPEKTORAT II',
                            'BIDANG TATA KELOLA TEKNOLOGI INFORMASI',
                            'BIDANG SISTEM INFORMASI DAN INFRASTRUKTUR TEKNOLOGI INFORMASI'
                        ] : [
                            'INSPEKTORAT II',
                            'BIDANG PENGEMBANGAN KOMPETENSI TEKNIS'
                        ];

                        // Define theme colors dynamically (Magister = Emerald, Dokter Spesialis = Indigo)
                        $theme = $isMagister ? [
                            'badge' => 'bg-emerald-100 text-emerald-800',
                            'selected_container' => 'bg-emerald-50/70 border-emerald-200',
                            'selected_text' => 'text-emerald-800',
                            'selected_title' => 'text-emerald-500',
                            'icon_bg' => 'bg-emerald-100 text-emerald-600',
                            'group_border' => 'border-emerald-300/80 bg-emerald-50/5',
                            'group_text' => 'text-emerald-950 font-bold',
                            'dot' => 'bg-emerald-500',
                            'btn_active' => 'bg-emerald-50 border-emerald-400 text-emerald-700 font-semibold shadow-sm',
                            'icon_color' => 'text-emerald-600',
                            'header_bg' => 'bg-emerald-50/20'
                        ] : [
                            'badge' => 'bg-indigo-100 text-indigo-800',
                            'selected_container' => 'bg-indigo-50/70 border-indigo-200',
                            'selected_text' => 'text-indigo-800',
                            'selected_title' => 'text-indigo-500',
                            'icon_bg' => 'bg-indigo-100 text-indigo-600',
                            'group_border' => 'border-indigo-300/80 bg-indigo-50/5',
                            'group_text' => 'text-indigo-950 font-bold',
                            'dot' => 'bg-indigo-500',
                            'btn_active' => 'bg-indigo-50 border-indigo-400 text-indigo-700 font-semibold shadow-sm',
                            'icon_color' => 'text-indigo-600',
                            'header_bg' => 'bg-indigo-50/20'
                        ];
                    @endphp

                    <div class="md:col-span-2" x-data="{ 
                        activeTab: null,
                        selectedValue: {{ json_encode(old('unit_kerja', $industri?->unit_kerja ?? '')) }},
                        biroList: {{ json_encode($biroList) }},
                        bagianList: {{ json_encode($bagianList) }},
                        pusatList: {{ json_encode($pusatList) }},
                        inspektoratList: {{ json_encode($inspektoratList) }},
                        isBiroSelected() {
                            return this.biroList.includes((this.selectedValue || '').toUpperCase());
                        },
                        isBagianSelected() {
                            return this.bagianList.includes((this.selectedValue || '').toUpperCase());
                        },
                        isPusatSelected() {
                            return this.pusatList.includes((this.selectedValue || '').toUpperCase());
                        },
                        isInspektoratSelected() {
                            return this.inspektoratList.includes((this.selectedValue || '').toUpperCase());
                        },
                        init() {
                            const storageKey = 'draft_step_{{ $step }}_user_{{ Auth::id() }}';
                            const savedData = localStorage.getItem(storageKey);
                            if (savedData) {
                                const dataObj = JSON.parse(savedData);
                                if (dataObj && dataObj.unit_kerja) {
                                    this.selectedValue = dataObj.unit_kerja;
                                }
                            }
                        },
                        selectOption(val) {
                            this.selectedValue = val;
                            this.$refs.unitKerjaInput.value = val;
                            // Trigger input event to update localStorage draft
                            this.$refs.unitKerjaInput.dispatchEvent(new Event('input', { bubbles: true }));
                            // Auto-collapse accordion
                            this.activeTab = null;
                        }
                    }">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Unit Kerja <span class="text-red-500">*</span></label>
                        
                        <!-- Display Selected Value Container (Enhanced UX Information) -->
                        <div class="mb-5">
                            <div class="flex items-center gap-4 px-5 py-4 rounded-2xl border transition-all duration-300 shadow-sm"
                                 :class="selectedValue ? '{{ $theme['selected_container'] }}' : 'bg-slate-50 border-slate-200'">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-colors duration-300"
                                     :class="selectedValue ? '{{ $theme['icon_bg'] }}' : 'bg-slate-200 text-slate-400'">
                                    <template x-if="selectedValue">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </template>
                                    <template x-if="!selectedValue">
                                        <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </template>
                                </div>
                                <div class="flex-1">
                                    <div class="text-[10px] font-bold tracking-wider uppercase" :class="selectedValue ? '{{ $theme['selected_title'] }}' : 'text-slate-400'">
                                        Status Pemilihan Unit Kerja
                                    </div>
                                    <div class="text-sm font-extrabold transition-all duration-300" :class="selectedValue ? '{{ $theme['selected_text'] }}' : 'text-slate-500'" x-text="selectedValue ? 'Terpilih: ' + selectedValue : 'Belum ada unit kerja yang terpilih. Silakan buka kategori dan pilih salah satu di bawah.'"></div>
                                </div>
                            </div>
                            <input type="hidden" name="unit_kerja" x-ref="unitKerjaInput" value="{{ old('unit_kerja', $industri?->unit_kerja) }}" required>
                        </div>

                        <!-- Accordion Groups -->
                        <div class="space-y-3">
                            
                            <!-- Category: Biro -->
                            <div class="border rounded-xl overflow-hidden shadow-sm transition duration-300"
                                 :class="isBiroSelected() ? '{{ $theme['group_border'] }}' : (activeTab === 'biro' ? 'border-slate-300' : 'border-slate-200')">
                                <button type="button" @click="activeTab = activeTab === 'biro' ? null : 'biro'" 
                                        class="w-full flex items-center justify-between px-5 py-4 bg-white text-left font-semibold text-slate-700 hover:bg-slate-50 transition"
                                        :class="isBiroSelected() ? '{{ $theme['header_bg'] }}' : ''">
                                    <span class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full transition-colors duration-300" :class="isBiroSelected() ? '{{ $theme['dot'] }}' : 'bg-slate-300'"></span>
                                        <span :class="isBiroSelected() ? '{{ $theme['group_text'] }}' : ''">Biro</span>
                                        <template x-if="isBiroSelected()">
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $theme['badge'] }}">
                                                ✓ Terpilih
                                            </span>
                                        </template>
                                    </span>
                                    <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" :class="{'rotate-180': activeTab === 'biro'}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div x-show="activeTab === 'biro'" x-collapse class="border-t border-slate-100 bg-slate-50/50 p-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($biroList as $item)
                                            <button type="button" @click="selectOption('{{ $item }}')"
                                                    class="w-full text-left px-4 py-3 rounded-lg text-sm transition-all duration-200 border flex items-center justify-between"
                                                    :class="(selectedValue || '').toUpperCase() === '{{ $item }}' ? '{{ $theme['btn_active'] }}' : 'bg-white border-slate-200 hover:border-slate-300 text-slate-600 hover:bg-slate-50'">
                                                <span>{{ $item }}</span>
                                                <svg x-show="(selectedValue || '').toUpperCase() === '{{ $item }}'" class="w-4 h-4 {{ $theme['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Category: Bagian -->
                            <div class="border rounded-xl overflow-hidden shadow-sm transition duration-300"
                                 :class="isBagianSelected() ? '{{ $theme['group_border'] }}' : (activeTab === 'bagian' ? 'border-slate-300' : 'border-slate-200')">
                                <button type="button" @click="activeTab = activeTab === 'bagian' ? null : 'bagian'" 
                                        class="w-full flex items-center justify-between px-5 py-4 bg-white text-left font-semibold text-slate-700 hover:bg-slate-50 transition"
                                        :class="isBagianSelected() ? '{{ $theme['header_bg'] }}' : ''">
                                    <span class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full transition-colors duration-300" :class="isBagianSelected() ? '{{ $theme['dot'] }}' : 'bg-slate-300'"></span>
                                        <span :class="isBagianSelected() ? '{{ $theme['group_text'] }}' : ''">Bagian</span>
                                        <template x-if="isBagianSelected()">
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $theme['badge'] }}">
                                                ✓ Terpilih
                                            </span>
                                        </template>
                                    </span>
                                    <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" :class="{'rotate-180': activeTab === 'bagian'}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div x-show="activeTab === 'bagian'" x-collapse class="border-t border-slate-100 bg-slate-50/50 p-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($bagianList as $item)
                                            <button type="button" @click="selectOption('{{ $item }}')"
                                                    class="w-full text-left px-4 py-3 rounded-lg text-sm transition-all duration-200 border flex items-center justify-between"
                                                    :class="(selectedValue || '').toUpperCase() === '{{ $item }}' ? '{{ $theme['btn_active'] }}' : 'bg-white border-slate-200 hover:border-slate-300 text-slate-600 hover:bg-slate-50'">
                                                <span>{{ $item }}</span>
                                                <svg x-show="(selectedValue || '').toUpperCase() === '{{ $item }}'" class="w-4 h-4 {{ $theme['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Category: Pusat -->
                            <div class="border rounded-xl overflow-hidden shadow-sm transition duration-300"
                                 :class="isPusatSelected() ? '{{ $theme['group_border'] }}' : (activeTab === 'pusat' ? 'border-slate-300' : 'border-slate-200')">
                                <button type="button" @click="activeTab = activeTab === 'pusat' ? null : 'pusat'" 
                                        class="w-full flex items-center justify-between px-5 py-4 bg-white text-left font-semibold text-slate-700 hover:bg-slate-50 transition"
                                        :class="isPusatSelected() ? '{{ $theme['header_bg'] }}' : ''">
                                    <span class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full transition-colors duration-300" :class="isPusatSelected() ? '{{ $theme['dot'] }}' : 'bg-slate-300'"></span>
                                        <span :class="isPusatSelected() ? '{{ $theme['group_text'] }}' : ''">Pusat</span>
                                        <template x-if="isPusatSelected()">
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $theme['badge'] }}">
                                                ✓ Terpilih
                                            </span>
                                        </template>
                                    </span>
                                    <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" :class="{'rotate-180': activeTab === 'pusat'}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div x-show="activeTab === 'pusat'" x-collapse class="border-t border-slate-100 bg-slate-50/50 p-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($pusatList as $item)
                                            <button type="button" @click="selectOption('{{ $item }}')"
                                                    class="w-full text-left px-4 py-3 rounded-lg text-sm transition-all duration-200 border flex items-center justify-between"
                                                    :class="(selectedValue || '').toUpperCase() === '{{ $item }}' ? '{{ $theme['btn_active'] }}' : 'bg-white border-slate-200 hover:border-slate-300 text-slate-600 hover:bg-slate-50'">
                                                <span>{{ $item }}</span>
                                                <svg x-show="(selectedValue || '').toUpperCase() === '{{ $item }}'" class="w-4 h-4 {{ $theme['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Category: Inspektorat & Bidang -->
                            <div class="border rounded-xl overflow-hidden shadow-sm transition duration-300"
                                 :class="isInspektoratSelected() ? '{{ $theme['group_border'] }}' : (activeTab === 'inspektorat' ? 'border-slate-300' : 'border-slate-200')">
                                <button type="button" @click="activeTab = activeTab === 'inspektorat' ? null : 'inspektorat'" 
                                        class="w-full flex items-center justify-between px-5 py-4 bg-white text-left font-semibold text-slate-700 hover:bg-slate-50 transition"
                                        :class="isInspektoratSelected() ? '{{ $theme['header_bg'] }}' : ''">
                                    <span class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full transition-colors duration-300" :class="isInspektoratSelected() ? '{{ $theme['dot'] }}' : 'bg-slate-300'"></span>
                                        <span :class="isInspektoratSelected() ? '{{ $theme['group_text'] }}' : ''">Inspektorat & Bidang</span>
                                        <template x-if="isInspektoratSelected()">
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $theme['badge'] }}">
                                                ✓ Terpilih
                                            </span>
                                        </template>
                                    </span>
                                    <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" :class="{'rotate-180': activeTab === 'inspektorat'}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div x-show="activeTab === 'inspektorat'" x-collapse class="border-t border-slate-100 bg-slate-50/50 p-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($inspektoratList as $item)
                                            <button type="button" @click="selectOption('{{ $item }}')"
                                                    class="w-full text-left px-4 py-3 rounded-lg text-sm transition-all duration-200 border flex items-center justify-between"
                                                    :class="(selectedValue || '').toUpperCase() === '{{ $item }}' ? '{{ $theme['btn_active'] }}' : 'bg-white border-slate-200 hover:border-slate-300 text-slate-600 hover:bg-slate-50'">
                                                <span>{{ $item }}</span>
                                                <svg x-show="(selectedValue || '').toUpperCase() === '{{ $item }}'" class="w-4 h-4 {{ $theme['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @else
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Unit Kerja <span class="text-red-500">*</span></label>
                        <input type="text" name="unit_kerja" value="{{ old('unit_kerja', $industri?->unit_kerja) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Direktorat Jenderal Pendidikan Tinggi">
                    </div>
                @endif

                {{-- Jabatan --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $industri?->jabatan) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm" placeholder="Contoh: Peneliti Ahli Muda / Staf Administrasi">
                </div>

                {{-- Golongan --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Golongan <span class="text-red-500">*</span></label>
                    <select name="golongan" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                        <option value="">Pilih Golongan</option>
                        @foreach(['I/a', 'I/b', 'I/c', 'I/d', 'II/a', 'II/b', 'II/c', 'II/d', 'III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'IV/b', 'IV/c', 'IV/d', 'IV/e', 'Non-PNS'] as $gol)
                            <option value="{{ $gol }}" {{ old('golongan', $industri?->golongan) == $gol ? 'selected' : '' }}>{{ $gol }}</option>
                        @endforeach
                    </select>
                </div>





                {{-- Tanggal Pensiun --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Pensiun (Bulan & Tahun) <span class="text-red-500">*</span></label>
                    <input type="month" name="tanggal_pensiun" value="{{ old('tanggal_pensiun', $industri?->tanggal_pensiun) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none transition text-sm">
                </div>
            </div>

            <div class="flex justify-between mt-8 pt-6 border-t border-slate-100">
                <a href="{{ route('pendaftaran.step1') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg> Kembali
                </a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-orange-200 flex items-center gap-2">
                    Simpan & Lanjut Tahap 3 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('step-form');
        const storageKey = 'draft_step_{{ $step }}_user_{{ Auth::id() }}';

        // 1. KEMBALIKAN DATA DARI LOCALSTORAGE
        const savedData = localStorage.getItem(storageKey);
        if (savedData) {
            const dataObj = JSON.parse(savedData);
            for (const key in dataObj) {
                const input = form.elements[key];
                if (input && input.type !== 'file' && dataObj[key] !== undefined && dataObj[key] !== null) {
                    input.value = dataObj[key];
                }
            }
        }

        // 2. SIMPAN DRAFT SAAT MENGETIK
        form.addEventListener('input', function(e) {
            if(e.target.type !== 'file' && e.target.name) {
                const formData = new FormData(form);
                const obj = {};
                formData.forEach((value, key) => {
                    if (key !== '_token' && typeof value === 'string') {
                        obj[key] = value;
                    }
                });
                localStorage.setItem(storageKey, JSON.stringify(obj));
            }
        });

        // 3. BERSIHKAN LOCALSTORAGE SAAT SUBMIT
        form.addEventListener('submit', function() {
            localStorage.removeItem(storageKey);
        });

    });
</script>
@endsection