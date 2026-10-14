@extends('layouts.masyarakat')

@section('content')
<div class="max-w-5xl mx-auto space-y-6 pb-12">

    <!-- Top Navigation & Action -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-sky-600 bg-sky-50 px-3 py-1 rounded-full border border-sky-100 mb-2">
                📂 Detail Tracking Berkas
            </span>
            <h1 class="text-2xl font-black tracking-tight text-slate-900">
                {{ $permohonan->jenisLayanan->nama_layanan ?? 'Layanan Kependudukan' }}
            </h1>
        </div>
        <a href="{{ route('masyarakat.tracking.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-xl border border-slate-200 shadow-sm transition-all">
            ← Kembali ke Riwayat
        </a>
    </div>

    <!-- Main Card Container -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden">

        <!-- Header Ticket Banner -->
        <div class="bg-slate-900 text-white p-6 md:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-sky-500/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 space-y-1">
                <span class="text-xs font-medium text-slate-400 uppercase tracking-widest">Nomor Tiket Pengajuan</span>
                <div class="font-mono text-xl md:text-2xl font-black tracking-wider text-sky-400">
                    {{ $permohonan->nomor_tiket }}
                </div>
            </div>

            <div class="relative z-10">
                @php
                $statusValue = is_object($permohonan->status) && property_exists($permohonan->status, 'value')
                ? $permohonan->status->value
                : (string) $permohonan->status;

                $statusLower = strtolower($statusValue);

                $statusClass = match($statusLower) {
                'selesai', 'disetujui' => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
                'ditolak' => 'bg-rose-500/20 text-rose-300 border-rose-500/30',
                default => 'bg-amber-500/20 text-amber-300 border-amber-500/30',
                };
                @endphp
                <span class="text-xs font-medium text-slate-400 uppercase tracking-widest block mb-1">Status Saat Ini</span>
                <span class="{{ $statusClass }} text-xs px-4 py-1.5 rounded-full border uppercase font-black tracking-wider inline-block">
                    {{ ucfirst($statusValue) }}
                </span>
            </div>
        </div>

        <!-- Content Body -->
        <div class="p-6 md:p-8 space-y-8">

            <!-- Grid Informasi Pemohon & Berkas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-5 bg-slate-50/70 rounded-2xl border border-slate-100 space-y-4">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Informasi Pemohon</h3>
                    <div>
                        <span class="text-xs text-slate-500 block">Nama Lengkap</span>
                        <span class="text-sm font-bold text-slate-900">{{ $permohonan->nama_pemohon }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-500 block">NIK Pemohon</span>
                        <span class="text-sm font-mono font-bold text-slate-900">{{ $permohonan->nik_pemohon }}</span>
                    </div>
                </div>

                <div class="p-5 bg-slate-50/70 rounded-2xl border border-slate-100 space-y-4">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Waktu & Keterangan</h3>
                    <div>
                        <span class="text-xs text-slate-500 block">Tanggal Pengajuan</span>
                        <span class="text-sm font-bold text-slate-900">{{ $permohonan->created_at ? $permohonan->created_at->format('d M Y, H:i') : '-' }} WIB</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-500 block">Detail Permohonan</span>
                        <span class="text-sm font-medium text-slate-700 line-clamp-2">{{ $permohonan->detail_permohonan }}</span>
                    </div>
                </div>
            </div>

            <!-- Catatan Operator (Jika Ada) -->
            @if($permohonan->catatan_operator)
            <div class="p-5 bg-amber-50/60 border border-amber-200/80 rounded-2xl flex items-start gap-3">
                <span class="text-xl">💡</span>
                <div>
                    <h4 class="text-xs font-black text-amber-800 uppercase tracking-wider mb-1">Catatan Khusus dari Operator</h4>
                    <p class="text-xs md:text-sm text-amber-900 leading-relaxed">{{ $permohonan->catatan_operator }}</p>
                </div>
            </div>
            @endif

            <!-- Timeline Proses Modern -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-6">Timeline Perkembangan</h3>

                <div class="space-y-6 border-l-2 border-slate-200 ml-3 pl-6">
                    <!-- Step 1 -->
                    <div class="relative">
                        <div class="absolute -left-[31px] top-0.5 w-3.5 h-3.5 rounded-full bg-sky-600 ring-4 ring-white"></div>
                        <h4 class="text-sm font-bold text-slate-900">Pengajuan Berkas Masuk</h4>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $permohonan->created_at ? $permohonan->created_at->format('d M Y, H:i') : '-' }} WIB</p>
                        <p class="text-xs text-slate-600 mt-1">Sistem berhasil memvalidasi kelengkapan awal dan tiket permohonan diterbitkan.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative">
                        <div class="absolute -left-[31px] top-0.5 w-3.5 h-3.5 rounded-full {{ in_array($statusLower, ['selesai', 'disetujui']) ? 'bg-emerald-600' : ($statusLower == 'ditolak' ? 'bg-rose-600' : 'bg-amber-500 animate-pulse') }} ring-4 ring-white"></div>
                        <h4 class="text-sm font-bold text-slate-900">
                            @if($statusLower == 'selesai') Permohonan Selesai
                            @elseif($statusLower == 'disetujui') Permohonan Disetujui Operator
                            @elseif($statusLower == 'ditolak') Permohonan Ditolak
                            @else Verifikasi & Validasi Operator
                            @endif
                        </h4>
                        <p class="text-xs text-slate-400 mt-0.5">
                            @if(in_array($statusLower, ['selesai', 'disetujui', 'ditolak']))
                            {{ $permohonan->updated_at ? $permohonan->updated_at->format('d M Y, H:i') : '-' }} WIB
                            @else
                            Dalam antrean pemeriksaan petugas
                            @endif
                        </p>
                        <p class="text-xs text-slate-600 mt-1">
                            @if($statusLower == 'selesai')
                            Dokumen telah selesai diproses dan siap diambil atau diunduh.
                            @elseif($statusLower == 'disetujui')
                            Permohonan Anda telah resmi disetujui oleh operator pada {{ $permohonan->updated_at ? $permohonan->updated_at->format('d M Y, H:i') : '-' }} WIB.
                            @elseif($statusLower == 'ditolak')
                            Mohon perhatikan catatan operator untuk melakukan perbaikan dokumen.
                            @else
                            Petugas instansi sedang memeriksa keabsahan berkas persyaratan yang Anda unggah.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection