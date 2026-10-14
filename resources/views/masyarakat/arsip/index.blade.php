@extends('layouts.masyarakat')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Arsip Dokumen Selesai</h2>
                    <p class="text-sm text-slate-500 mt-1">Lihat dan unduh hasil dokumen pelayanan publik Anda yang telah disetujui dan diterbitkan.</p>
                </div>
                <div class="bg-sky-50 text-sky-700 px-4 py-2 rounded-xl text-sm font-semibold border border-sky-100">
                    Total Arsip: <span class="font-bold">{{ $arsips->total() }} Dokumen</span>
                </div>
            </div>

            <!-- Flash Message -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-sm font-medium">
                {{ session('error') }}
            </div>
            @endif

            <!-- Tabel Arsip Profesional -->
            <div class="overflow-x-auto rounded-xl border border-slate-200">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-700 text-xs uppercase tracking-wider">
                            <th class="py-3.5 px-4 font-bold">No</th>
                            <th class="py-3.5 px-4 font-bold">Nomor Tiket / Layanan</th>
                            <th class="py-3.5 px-4 font-bold">Tanggal Selesai</th>
                            <th class="py-3.5 px-4 font-bold">Status</th>
                            <th class="py-3.5 px-4 font-bold text-center">Aksi Dokumen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                        @forelse($arsips as $index => $item)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-4 px-4 font-medium text-slate-800">{{ $arsips->firstItem() + $index }}</td>
                            <td class="py-4 px-4">
                                <span class="font-bold text-slate-900 block">{{ $item->jenisLayanan->nama_layanan ?? 'Layanan Publik' }}</span>
                                <span class="text-xs text-slate-400">Tiket: {{ $item->nomor_tiket }}</span>
                            </td>
                            <td class="py-4 px-4 text-slate-500">{{ $item->updated_at ? $item->updated_at->format('d M Y, H:i') : '-' }}</td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-semibold border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai
                                </span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <div class="inline-flex items-center justify-center gap-2">
                                    @if($item->berkas_hasil_jadi)
                                    <!-- Tombol Lihat / Preview di Tab Baru -->
                                    <a href="{{ asset('storage/' . $item->berkas_hasil_jadi) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-700 hover:bg-slate-800 text-white rounded-xl text-xs font-semibold shadow-md transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat
                                    </a>

                                    <!-- Tombol Unduh File -->
                                    <a href="{{ route('masyarakat.arsip.download', $item->id) }}" class="inline-flex items-center gap-1.5 px-3 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-sky-600/20 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Unduh
                                    </a>
                                    @else
                                    <span class="text-xs text-slate-400 italic">File belum diunggah operator</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400 text-sm">
                                Belum ada arsip dokumen yang selesai.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Bagian Pagination -->
            @if($arsips->hasPages())
            <div class="mt-6">
                {{ $arsips->links() }}
            </div>
            @endif

        </div>
    </div>
</div>
@endsection