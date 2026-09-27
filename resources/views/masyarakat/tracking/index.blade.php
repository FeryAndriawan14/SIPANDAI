@extends('layouts.masyarakat')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Tracking Status Berkas Permohonan</h2>
                    <p class="text-slate-600 text-sm">Berikut adalah daftar pengajuan berkas layanan Anda.</p>
                </div>

                <!-- Form Filter / Pencarian -->
                <form action="{{ route('masyarakat.tracking.index') }}" method="GET" class="flex items-center gap-2">
                    <div class="relative w-full md:w-64">
                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari Tiket / Layanan..."
                            class="w-full pl-3 pr-8 py-2 border border-slate-300 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">

                        @if(request('search'))
                        <a href="{{ route('masyarakat.tracking.index') }}" class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs font-bold" title="Reset Pencarian">
                            ✕
                        </a>
                        @endif
                    </div>
                    <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-lg text-sm font-semibold shadow-sm transition">
                        Cari
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-700">
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">No. Tiket</th>
                            <th class="py-3 px-4">Jenis Layanan</th>
                            <th class="py-3 px-4">Tanggal Pengajuan</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permohonans as $index => $item)
                        <tr class="border-b border-slate-100 text-slate-600 hover:bg-slate-50 transition">
                            <td class="py-3 px-4">{{ $permohonans->firstItem() + $index }}</td>
                            <td class="py-3 px-4 font-mono font-semibold text-slate-700">{{ $item->nomor_tiket }}</td>
                            <td class="py-3 px-4">{{ $item->jenisLayanan->nama_layanan ?? 'Layanan Tidak Ditemukan' }}</td>
                            <td class="py-3 px-4">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                            <td class="py-3 px-4">
                                @php
                                $statusValue = $item->status instanceof \BackedEnum ? $item->status->value : (string) $item->status;

                                $statusClass = match(strtolower($statusValue)) {
                                'selesai' => 'bg-emerald-100 text-emerald-700',
                                'ditolak' => 'bg-rose-100 text-rose-700',
                                default => 'bg-amber-100 text-amber-700',
                                };
                                @endphp
                                <span class="px-3 py-1 {{ $statusClass }} rounded-full text-xs font-semibold">
                                    {{ ucfirst($statusValue) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('masyarakat.tracking.show', $item->id) }}" class="text-sky-600 hover:underline font-medium text-sm">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400 italic">
                                @if(request('search'))
                                Data permohonan dengan kata kunci "<span class="font-semibold">{{ request('search') }}</span>" tidak ditemukan.
                                @else
                                Belum ada riwayat pengajuan permohonan berkas.
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginasi bergaya Showing X to Y of Z results -->
            @if ($permohonans->hasPages() || $permohonans->total() > 0)
            <div class="mt-6 pt-4 border-t border-slate-200/60 flex flex-col sm:flex-row items-center justify-between gap-4">
                <!-- Teks Info Hasil -->
                <div class="text-sm text-slate-600">
                    Showing
                    <span class="font-medium text-slate-800">{{ $permohonans->firstItem() ?? 0 }}</span>
                    to
                    <span class="font-medium text-slate-800">{{ $permohonans->lastItem() ?? 0 }}</span>
                    of
                    <span class="font-medium text-slate-800">{{ $permohonans->total() }}</span>
                    results
                </div>

                <!-- Navigasi Halaman Berbentuk Grup Tombol Berpetak -->
                <div class="inline-flex rounded-lg border border-slate-200 overflow-hidden shadow-sm">
                    {{-- Tombol Previous --}}
                    @if ($permohonans->onFirstPage())
                    <span class="px-3 py-1.5 text-slate-300 bg-white cursor-not-allowed border-r border-slate-200 flex items-center justify-center select-none">
                        &lsaquo;
                    </span>
                    @else
                    <a href="{{ $permohonans->previousPageUrl() }}" class="px-3 py-1.5 text-slate-600 bg-white hover:bg-slate-50 border-r border-slate-200 transition flex items-center justify-center">
                        &lsaquo;
                    </a>
                    @endif

                    {{-- Link Nomor Halaman --}}
                    @foreach ($permohonans->getUrlRange(1, $permohonans->lastPage()) as $page => $url)
                    @if ($page == $permohonans->currentPage())
                    <span class="px-3 py-1.5 text-sky-600 font-semibold bg-white border-r border-slate-200 select-none flex items-center justify-center">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $url }}" class="px-3 py-1.5 text-slate-600 bg-white hover:bg-slate-50 border-r border-slate-200 transition flex items-center justify-center">
                        {{ $page }}
                    </a>
                    @endif
                    @endforeach

                    {{-- Tombol Next --}}
                    @if ($permohonans->hasMorePages())
                    <a href="{{ $permohonans->nextPageUrl() }}" class="px-3 py-1.5 text-slate-600 bg-white hover:bg-slate-50 transition flex items-center justify-center">
                        &rsaquo;
                    </a>
                    @else
                    <span class="px-3 py-1.5 text-slate-300 bg-white cursor-not-allowed flex items-center justify-center select-none">
                        &rsaquo;
                    </span>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection