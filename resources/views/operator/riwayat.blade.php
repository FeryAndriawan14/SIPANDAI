@extends('layouts.operator')

@section('content')
<div class="min-h-screen bg-slate-900 text-slate-100 p-6 rounded-2xl shadow-2xl border border-slate-800 space-y-6">
    <!-- Header Banner -->
    <div class="bg-slate-800/60 backdrop-blur border border-slate-700/60 p-6 rounded-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-100 mb-1">Riwayat Verifikasi Berkas</h3>
            <p class="text-slate-400 text-xs sm:text-sm">Daftar permohonan masyarakat yang telah selesai atau ditinjau sebelumnya.</p>
        </div>
    </div>

    <!-- Form Filter & Search Section -->
    <div class="bg-slate-800/60 backdrop-blur border border-slate-700/60 p-4 sm:p-5 rounded-2xl">
        <form action="{{ route('operator.riwayat') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

            <!-- Input Search -->
            <div>
                <label class="block text-slate-400 text-[11px] font-semibold uppercase tracking-wider mb-1.5">Pencarian</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No. Tiket / Nama..."
                        class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-3.5 py-2 text-xs text-slate-200 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition">
                </div>
            </div>

            <!-- Select Status -->
            <div>
                <label class="block text-slate-400 text-[11px] font-semibold uppercase tracking-wider mb-1.5">Status Akhir</label>
                <select name="status" class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-3.5 py-2 text-xs text-slate-200 focus:outline-none focus:border-blue-500 transition">
                    <option value="">-- Semua Status --</option>
                    <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <!-- Select Jenis Layanan -->
            <div>
                <label class="block text-slate-400 text-[11px] font-semibold uppercase tracking-wider mb-1.5">Jenis Layanan</label>
                <select name="jenis_layanan_id" class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-3.5 py-2 text-xs text-slate-200 focus:outline-none focus:border-blue-500 transition">
                    <option value="">-- Semua Layanan --</option>
                    @foreach($layans as $layanan)
                    <option value="{{ $layanan->id }}" {{ request('jenis_layanan_id') == $layanan->id ? 'selected' : '' }}>
                        {{ $layanan->nama_layanan }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Aksi Filter & Reset -->
            <div class="flex items-end gap-2 sm:col-span-2 lg:col-span-1">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-500 text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 shrink-0 block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <span>Filter</span>
                </button>

                @if(request()->hasAny(['search', 'status', 'jenis_layanan_id']))
                <a href="{{ route('operator.riwayat') }}" class="bg-slate-700 hover:bg-slate-600 text-slate-300 font-semibold text-xs py-2.5 px-4 rounded-xl transition flex items-center justify-center shrink-0" title="Reset Filter">
                    Reset
                </a>
                @endif
            </div>

        </form>
    </div>

    <!-- Tabel Riwayat -->
    <div class="bg-slate-800/60 backdrop-blur border border-slate-700/60 rounded-2xl overflow-hidden p-6 space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300 min-w-[700px]">
                <thead class="bg-slate-700/50 text-slate-400 uppercase text-[11px] border-b border-slate-700/60">
                    <tr>
                        <th class="p-4 font-semibold text-center rounded-l-xl w-12">No.</th>
                        <th class="p-4 font-semibold">No. Tiket</th>
                        <th class="p-4 font-semibold">Nama Pemohon</th>
                        <th class="p-4 font-semibold">Jenis Layanan</th>
                        <th class="p-4 font-semibold">Status Akhir</th>
                        <th class="p-4 font-semibold">Catatan Operator</th>
                        <th class="p-4 font-semibold text-center rounded-r-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/40">
                    @forelse($riwayats as $index => $item)
                    @php
                    $statusVal = is_object($item->status) && isset($item->status->value) ? $item->status->value : $item->status;
                    @endphp
                    <tr class="hover:bg-slate-700/30 transition">
                        <!-- Nomor Urut Dinamis Berdasar Paginasi -->
                        <td class="p-4 text-center text-slate-400 font-medium">
                            {{ $riwayats->firstItem() ? $riwayats->firstItem() + $index : $loop->iteration }}
                        </td>
                        <td class="p-4 font-mono text-blue-400 font-medium">{{ $item->nomor_tiket }}</td>
                        <td class="p-4 font-medium text-slate-200">{{ $item->nama_pemohon }}</td>
                        <td class="p-4">{{ $item->jenisLayanan->nama_layanan ?? 'Layanan Umum' }}</td>
                        <td class="p-4">
                            <span class="text-xs px-2.5 py-1 rounded-full border font-medium 
                                @if($statusVal == 'Disetujui') bg-emerald-500/10 text-emerald-400 border-emerald-500/20
                                @elseif($statusVal == 'Selesai') bg-sky-500/10 text-sky-400 border-sky-500/20
                                @else bg-rose-500/10 text-rose-400 border-rose-500/20 @endif">
                                {{ $statusVal }}
                            </span>
                        </td>
                        <td class="p-4 text-slate-400 text-xs">{{ $item->catatan_operator ?? '-' }}</td>
                        <td class="p-4 text-center">
                            <a href="{{ route('operator.permohonan.show', $item->id) }}" class="inline-block bg-slate-700 hover:bg-slate-600 text-slate-200 px-3 py-1.5 rounded-lg text-xs font-semibold transition">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-500 text-sm">
                            Tidak ada data riwayat yang sesuai dengan kriteria filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($riwayats->hasPages())
        <div class="pt-4 border-t border-slate-700/60">
            {{ $riwayats->links() }}
        </div>
        @endif
    </div>
</div>
@endsection