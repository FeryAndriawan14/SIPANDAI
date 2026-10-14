@extends('layouts.operator')

@section('content')
<div class="min-h-screen bg-slate-900 text-slate-100 p-6 rounded-2xl shadow-2xl border border-slate-800">
    <div class="max-w-4xl mx-auto bg-slate-800/80 p-8 rounded-2xl border border-slate-700 space-y-6">

        <!-- Header & Navigasi -->
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">Kelola Permohonan: <span class="text-sky-400">{{ $permohonan->nomor_tiket }}</span></h2>
            <a href="{{ route('operator.dashboard') }}" class="text-sm bg-slate-700 hover:bg-slate-600 px-4 py-2 rounded-xl transition">Kembali</a>
        </div>

        <!-- Informasi Detail Pemohon -->
        <div class="grid grid-cols-2 gap-4 text-sm bg-slate-900/50 p-4 rounded-xl border border-slate-700/50">
            <div><strong class="text-slate-400">NIK:</strong> {{ $permohonan->nik_pemohon }}</div>
            <div><strong class="text-slate-400">Nama:</strong> {{ $permohonan->nama_pemohon }}</div>
            <div><strong class="text-slate-400">Layanan:</strong> {{ $permohonan->jenisLayanan->nama_layanan ?? '-' }}</div>
            <div><strong class="text-slate-400">Tanggal Pengajuan:</strong> {{ $permohonan->created_at ? $permohonan->created_at->format('d M Y, H:i') : '-' }} WIB</div>
            <div class="col-span-2"><strong class="text-slate-400">Catatan Pemohon:</strong> {{ $permohonan->detail_permohonan }}</div>
        </div>

        <!-- Dokumen yang Dilampirkan -->
        <div>
            <h3 class="font-bold text-md mb-3 text-slate-200">Dokumen yang Dilampirkan Pemohon:</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @if($permohonan->berkas_kk)
                <div class="p-3 bg-slate-900/60 rounded-xl border border-slate-700">
                    <span class="text-xs text-slate-400 block mb-1">Berkas / KTP / KK</span>
                    <a href="{{ asset('storage/' . $permohonan->berkas_kk) }}" target="_blank" class="text-sky-400 hover:underline text-sm font-semibold">Lihat Berkas &rarr;</a>
                </div>
                @endif

                @if($permohonan->berkas_pengantar)
                <div class="p-3 bg-slate-900/60 rounded-xl border border-slate-700">
                    <span class="text-xs text-slate-400 block mb-1">Surat Pengantar RT/RW</span>
                    <a href="{{ asset('storage/' . $permohonan->berkas_pengantar) }}" target="_blank" class="text-sky-400 hover:underline text-sm font-semibold">Lihat Berkas &rarr;</a>
                </div>
                @endif

                @if($permohonan->berkas_pendukung)
                <div class="p-3 bg-slate-900/60 rounded-xl border border-slate-700">
                    <span class="text-xs text-slate-400 block mb-1">Berkas Pendukung / Akta / Ijazah</span>
                    <a href="{{ asset('storage/' . $permohonan->berkas_pendukung) }}" target="_blank" class="text-sky-400 hover:underline text-sm font-semibold">Lihat Berkas &rarr;</a>
                </div>
                @endif

                @if($permohonan->berkas_nikah)
                <div class="p-3 bg-slate-900/60 rounded-xl border border-slate-700">
                    <span class="text-xs text-slate-400 block mb-1">Buku Nikah / Akta Perkawinan</span>
                    <a href="{{ asset('storage/' . $permohonan->berkas_nikah) }}" target="_blank" class="text-sky-400 hover:underline text-sm font-semibold">Lihat Berkas &rarr;</a>
                </div>
                @endif

                @if($permohonan->berkas_pernyataan)
                <div class="p-3 bg-slate-900/60 rounded-xl border border-slate-700">
                    <span class="text-xs text-slate-400 block mb-1">Surat Pernyataan</span>
                    <a href="{{ asset('storage/' . $permohonan->berkas_pernyataan) }}" target="_blank" class="text-sky-400 hover:underline text-sm font-semibold">Lihat Berkas &rarr;</a>
                </div>
                @endif
            </div>
        </div>

        @php
        $statusValue = is_object($permohonan->status) && property_exists($permohonan->status, 'value')
        ? $permohonan->status->value
        : (string) $permohonan->status;
        $statusLower = strtolower($statusValue);
        @endphp

        <!-- KONDISI 1: Jika Status Masih Menunggu -->
        @if($statusLower == 'menunggu')
        <div class="bg-slate-900/80 p-6 rounded-2xl border border-slate-700">
            <h3 class="font-bold text-md mb-4 text-sky-400">Form Keputusan Verifikasi Awal</h3>
            <form action="{{ route('operator.permohonan.update', $permohonan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-300 mb-1">Keputusan</label>
                    <select name="status" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-sm text-white" required>
                        <option value="Disetujui">Setujui Permohonan</option>
                        <option value="Ditolak">Tolak</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-300 mb-1">Catatan / Alasan (Opsional jika ditolak)</label>
                    <textarea name="catatan_operator" rows="3" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-sm text-white" placeholder="Tuliskan catatan atau kekurangan berkas di sini...">{{ $permohonan->catatan_operator }}</textarea>
                </div>

                <button type="submit" class="w-full bg-sky-600 hover:bg-sky-500 text-white font-semibold py-3 rounded-xl transition shadow-lg">Simpan Keputusan Verifikasi</button>
            </form>
        </div>

        <!-- KONDISI 2: Jika Sudah Disetujui -->
        @elseif($statusLower == 'disetujui')
        <div class="bg-emerald-950/40 border border-emerald-500/30 p-6 rounded-2xl space-y-4">
            <div class="flex items-center gap-3">
                <span class="text-2xl">✅</span>
                <div>
                    <h3 class="font-bold text-emerald-400 text-md">Permohonan Telah Disetujui</h3>
                    <p class="text-xs text-emerald-200/70">Berkas telah divalidasi pada {{ $permohonan->updated_at ? $permohonan->updated_at->format('d M Y, H:i') : '-' }} WIB. Silakan unggah dokumen hasil jadi (e-Dokumen/PDF) dan ubah status menjadi selesai.</p>
                </div>
            </div>

            <form action="{{ route('operator.permohonan.update', $permohonan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="status" value="Selesai">

                <!-- Input Upload Berkas Hasil Jadi -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-300 mb-1">Upload Dokumen Hasil Jadi (PDF / Gambar - Opsional)</label>
                    <input type="file" name="berkas_hasil_jadi" class="w-full border border-slate-700 bg-slate-900 rounded-xl p-2.5 text-sm text-slate-300" accept=".pdf,.jpg,.jpeg,.png">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-300 mb-1">Catatan Tambahan untuk Pengambilan Dokumen (Opsional)</label>
                    <textarea name="catatan_operator" rows="2" class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-sm text-white" placeholder="Contoh: Dokumen jadi dan bisa diambil di kantor desa jam 08.00 - 14.00 WIB...">{{ $permohonan->catatan_operator }}</textarea>
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-3 rounded-xl transition shadow-lg">Tandai Dokumen Selesai (Dokumen Jadi)</button>
            </form>
        </div>

        <!-- KONDISI 3: Jika Status Sudah Selesai atau Ditolak -->
        @else
        <div class="bg-slate-900/60 p-6 rounded-2xl border border-slate-700 text-center space-y-3">
            <p class="text-sm text-slate-400">Permohonan ini sudah diproses dengan status akhir:</p>
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $statusLower == 'selesai' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-rose-500/20 text-rose-300 border border-rose-500/30' }}">
                {{ ucfirst($statusValue) }}
            </span>
            <p class="text-xs text-slate-400">
                Diproses pada: <strong class="text-slate-200">{{ $permohonan->updated_at ? $permohonan->updated_at->format('d M Y, H:i') : '-' }} WIB</strong>
            </p>

            @if($permohonan->berkas_hasil_jadi)
            <div class="mt-2">
                <a href="{{ asset('storage/' . $permohonan->berkas_hasil_jadi) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-sky-600 hover:bg-sky-500 text-white text-xs font-bold rounded-xl transition">
                    📥 Download Dokumen Hasil Jadi
                </a>
            </div>
            @endif

            @if($permohonan->catatan_operator)

            @endif
        </div>
        @endif

    </div>
</div>
@endsection