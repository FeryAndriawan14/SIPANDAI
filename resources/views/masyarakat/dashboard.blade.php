@extends('layouts.masyarakat')

@section('content')
<div class="space-y-8 pb-10">
    <!-- Header Banner Masyarakat -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-white via-sky-50/60 to-slate-50 p-8 md:p-10 shadow-xl border border-sky-100">
        <div class="absolute -right-16 -top-16 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-1/3 -bottom-20 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <div class="flex flex-wrap items-center gap-2.5 mb-4">
                    <span class="inline-flex items-center gap-1.5 bg-sky-100 text-sky-700 text-xs font-bold px-4 py-1.5 rounded-full border border-sky-200 uppercase tracking-wider shadow-sm">
                        👤 Portal Pemohon Layanan Publik
                    </span>
                </div>

                @php
                $hour = now()->hour;
                if ($hour >= 3 && $hour < 11) {
                    $greeting='Selamat Pagi' ;
                    } elseif ($hour>= 11 && $hour < 15) {
                        $greeting='Selamat Siang' ;
                        } elseif ($hour>= 15 && $hour < 18) {
                            $greeting='Selamat Sore' ;
                            } else {
                            $greeting='Selamat Malam' ;
                            }
                            @endphp

                            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-slate-900">
                            {{ $greeting }}, <span class="bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">{{ Auth::user()->name }}</span> 👋
                            </h1>
                            <p class="text-slate-600 text-sm md:text-base mt-2 max-w-2xl font-normal leading-relaxed">
                                Ajukan permohonan layanan publik dengan mudah, cepat, dan pantau status perkembangannya secara langsung dari dashboard Anda.
                            </p>
            </div>

            <div class="flex items-center gap-3 bg-white/85 backdrop-blur-md p-3.5 rounded-2xl border border-slate-200 shadow-lg shrink-0">
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center font-bold text-lg border border-sky-200">
                    🕒
                </div>
                <div>
                    <span class="text-xs text-slate-500 block font-medium">Waktu Sistem Server</span>
                    <span class="text-sm font-bold text-slate-900">{{ now()->format('d M Y, H:i') }} WIB</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick CTA Ajukan Layanan Baru -->
    <div class="bg-gradient-to-r from-red-600 to-rose-600 p-8 rounded-3xl shadow-xl flex flex-col sm:flex-row justify-between items-center text-white relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative z-10 mb-4 sm:mb-0">
            <h3 class="text-2xl font-black tracking-tight">Butuh Pengurusan Dokumen Baru?</h3>
            <p class="text-red-100 text-sm mt-1 max-w-xl">Pilih jenis layanan publik yang Anda butuhkan dan unggah persyaratan dengan cepat langsung melalui perangkat Anda.</p>
        </div>
        <a href="{{ route('masyarakat.permohonan.create') }}" class="relative z-10 bg-white text-red-600 hover:bg-slate-100 px-6 py-3.5 rounded-2xl font-bold text-sm shadow-lg transition-all duration-200 hover:-translate-y-0.5 shrink-0 inline-block text-center">
            + Buat Permohonan Baru
        </a>
    </div>

    <!-- Riwayat Pengajuan Saya -->
    <div class="bg-white border border-slate-200/80 p-8 rounded-3xl shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-lg font-bold text-slate-800">Riwayat Pengajuan Terbaru</h3>
                <p class="text-slate-500 text-xs mt-1">Daftar tiket dan status tracking permohonan yang telah Anda kirimkan ke sistem.</p>
            </div>
            <span class="bg-slate-100 text-slate-600 text-xs font-bold px-3 py-1.5 rounded-xl border border-slate-200">Status Aktif</span>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-slate-200">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 uppercase text-xs tracking-wider font-bold border-b border-slate-200">
                    <tr>
                        <th class="p-4 text-center w-12">No.</th>
                        <th class="p-4">No. Tiket</th>
                        <th class="p-4">Layanan</th>
                        <th class="p-4">Tanggal Pengajuan</th>
                        <th class="p-4">Status Terkini</th>
                        <th class="p-4 text-center">Detail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($permohonans as $item)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <!-- Nomor urut sederhana yang kompatibel dengan simplePaginate -->
                        <td class="p-4 text-center font-medium text-slate-500">
                            {{ $loop->iteration }}
                        </td>
                        <td class="p-4 font-mono text-sky-600 font-bold">{{ $item->nomor_tiket }}</td>
                        <td class="p-4 font-bold text-slate-900">{{ $item->jenisLayanan->nama_layanan ?? 'Layanan Umum' }}</td>
                        <td class="p-4 text-slate-500 text-xs">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                        <td class="p-4">
                            @php
                            $statusValue = is_object($item->status) && property_exists($item->status, 'value')
                            ? $item->status->value
                            : (string) $item->status;

                            $statusLower = strtolower($statusValue);

                            $statusClass = match($statusLower) {
                            'selesai' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                            'ditolak' => 'bg-rose-50 text-rose-600 border-rose-200',
                            default => 'bg-amber-50 text-amber-600 border-amber-200',
                            };
                            @endphp
                            <span class="{{ $statusClass }} text-xs px-3 py-1 rounded-lg border uppercase font-black tracking-wider inline-block">
                                {{ ucfirst($statusValue) }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            <a href="{{ route('masyarakat.tracking.show', $item->id) }}" class="text-red-600 hover:text-red-700 font-bold text-xs hover:underline inline-block">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400 italic">
                            Belum ada riwayat pengajuan permohonan dokumen. Silakan buat permohonan baru di atas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tombol Prev & Next (Simple Pagination) -->
        <div class="mt-4 pt-4 border-t border-slate-200/60 flex items-center justify-between">
            <div>
                @if ($permohonans->onFirstPage())
                <span class="px-4 py-2 bg-slate-100 text-slate-400 text-xs font-bold rounded-xl border border-slate-200 cursor-not-allowed inline-block">
                    &laquo; Previous
                </span>
                @else
                <a href="{{ $permohonans->previousPageUrl() }}" class="px-4 py-2 bg-white text-slate-700 hover:bg-slate-50 hover:text-sky-600 text-xs font-bold rounded-xl border border-slate-200 shadow-sm transition inline-block">
                    &laquo; Previous
                </a>
                @endif
            </div>

            <div>
                @if ($permohonans->hasMorePages())
                <a href="{{ $permohonans->nextPageUrl() }}" class="px-4 py-2 bg-white text-slate-700 hover:bg-slate-50 hover:text-sky-600 text-xs font-bold rounded-xl border border-slate-200 shadow-sm transition inline-block">
                    Next &raquo;
                </a>
                @else
                <span class="px-4 py-2 bg-slate-100 text-slate-400 text-xs font-bold rounded-xl border border-slate-200 cursor-not-allowed inline-block">
                    Next &raquo;
                </span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection