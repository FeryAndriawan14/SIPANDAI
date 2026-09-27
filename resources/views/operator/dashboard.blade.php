@extends('layouts.operator')

@section('content')
<div class="space-y-6">
    <!-- Header Operator Banner -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-gradient-to-r from-emerald-950 via-teal-950 to-slate-900 p-6 sm:p-8 rounded-2xl shadow-xl border border-emerald-700/60 relative overflow-hidden">
        <div class="z-10">
            <h1 class="text-2xl sm:text-3xl font-extrabold mt-2 tracking-tight text-white">Halo, {{ Auth::user()->name }} 🛡️</h1>
            <p class="text-slate-300 text-xs sm:text-sm mt-1">Silakan tinjau dan verifikasi berkas permohonan masyarakat yang masuk dengan teliti.</p>
        </div>
    </div>

    <!-- Statistik Pekerjaan Operator (Dinamis) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
        <div class="bg-slate-800 border border-slate-600 p-6 rounded-2xl shadow-lg">
            <span class="text-slate-300 text-xs font-semibold uppercase tracking-wider">Permohonan Menunggu</span>
            <h3 class="text-3xl font-black mt-2 text-amber-400 tracking-wide">{{ $pendingCount }}</h3>
            <p class="text-xs text-slate-400 mt-1 font-medium">Perlu tindakan verifikasi hari ini</p>
        </div>
        <div class="bg-slate-800 border border-slate-600 p-6 rounded-2xl shadow-lg">
            <span class="text-slate-300 text-xs font-semibold uppercase tracking-wider">Disetujui / Selesai</span>
            <h3 class="text-3xl font-black mt-2 text-emerald-400 tracking-wide">{{ $approvedCount }}</h3>
            <p class="text-xs text-slate-400 mt-1 font-medium">Dokumen telah divalidasi</p>
        </div>
        <div class="bg-slate-800 border border-slate-600 p-6 rounded-2xl shadow-lg">
            <span class="text-slate-300 text-xs font-semibold uppercase tracking-wider">Ditolak</span>
            <h3 class="text-3xl font-black mt-2 text-rose-400 tracking-wide">{{ $rejectedCount }}</h3>
            <p class="text-xs text-slate-400 mt-1 font-medium">Catatan dikirim ke pemohon</p>
        </div>
    </div>

    <!-- Antrean Permohonan Terbaru -->
    <div class="bg-slate-800 border border-slate-600 p-6 rounded-2xl shadow-lg">
        <h3 class="text-lg font-bold text-white mb-4">Daftar Antrean Berkas Masuk</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-200 min-w-[700px]">
                <thead class="bg-slate-700/80 text-slate-200 uppercase text-xs border-b border-slate-600">
                    <tr>
                        <th class="p-3.5 font-bold rounded-l-xl text-center w-12">No.</th>
                        <th class="p-3.5 font-bold">No. Tiket</th>
                        <th class="p-3.5 font-bold">Nama Pemohon</th>
                        <th class="p-3.5 font-bold">Jenis Layanan</th>
                        <th class="p-3.5 font-bold">Status</th>
                        <th class="p-3.5 font-bold rounded-r-xl text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($permohonans as $item)
                    @php
                    $st = is_object($item->status) && isset($item->status->value) ? $item->status->value : $item->status;
                    @endphp
                    <tr class="hover:bg-slate-700/50 transition">
                        <!-- Nomor selalu dimulai dari 1 di tiap halaman -->
                        <td class="p-3.5 text-center text-slate-400 font-medium">
                            {{ $loop->iteration }}
                        </td>
                        <td class="p-3.5 font-mono text-cyan-400 font-bold">{{ $item->nomor_tiket }}</td>
                        <td class="p-3.5 font-semibold text-white">{{ $item->nama_pemohon }}</td>
                        <td class="p-3.5 text-slate-300 font-medium">{{ $item->jenisLayanan->nama_layanan ?? 'Layanan Umum' }}</td>
                        <td class="p-3.5">
                            <span class="text-xs px-3 py-1 rounded-full font-bold border 
                            @if($st == 'Menunggu') bg-amber-500/20 text-amber-300 border-amber-500/40
                            @elseif($st == 'Disetujui') bg-emerald-500/20 text-emerald-300 border-emerald-500/40
                            @elseif($st == 'Selesai') bg-sky-500/20 text-sky-300 border-sky-500/40
                            @else bg-rose-500/20 text-rose-300 border-rose-500/40 @endif">
                                {{ $st }}
                            </span>
                        </td>
                        <td class="p-3.5 text-center">
                            <a href="{{ route('operator.permohonan.show', $item->id) }}" class="inline-block bg-emerald-600 hover:bg-emerald-500 text-white px-3.5 py-1.5 rounded-lg text-xs font-bold shadow transition">Verifikasi</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-slate-400 font-medium">Belum ada permohonan layanan yang masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($permohonans->hasPages())
        <div class="pt-4 border-t border-slate-700/60">
            {{ $permohonans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection