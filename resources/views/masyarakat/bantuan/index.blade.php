@extends('layouts.masyarakat')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <!-- Header Section -->
            <div class="mb-8 pb-6 border-b border-slate-100">
                <h2 class="text-xl font-bold text-slate-800">Pusat Bantuan & FAQ</h2>
                <p class="text-sm text-slate-500 mt-1">Temukan jawaban atas pertanyaan umum seputar layanan publik SIPANDAI.</p>
            </div>

            <!-- FAQ List -->
            <div class="space-y-4">
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 text-sm mb-1">1. Bagaimana cara mengajukan permohonan layanan baru?</h3>
                    <p class="text-sm text-slate-600">Anda dapat membuka menu <span class="font-semibold text-sky-600">Permohonan Layanan</span>, pilih jenis layanan yang Anda butuhkan, lalu unggah dokumen persyaratan yang diminta sebelum menekan tombol ajukan.</p>
                </div>

                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 text-sm mb-1">2. Berapa lama proses verifikasi berkas permohonan?</h3>
                    <p class="text-sm text-slate-600">Proses verifikasi biasanya memakan waktu 1 hingga 2 hari kerja. Anda dapat memantau status secara berkala melalui menu <span class="font-semibold text-sky-600">Tracking Berkas</span>.</p>
                </div>

                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 text-sm mb-1">3. Di mana saya bisa mendownload dokumen yang sudah selesai?</h3>
                    <p class="text-sm text-slate-600">Dokumen yang telah disetujui dan selesai dapat diunduh langsung melalui menu <span class="font-semibold text-sky-600">Arsip Dokumen</span>.</p>
                </div>
            </div>

            <!-- Kontak Support -->
            <div class="mt-8 p-6 bg-sky-50 rounded-2xl border border-sky-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <h4 class="font-bold text-sky-900">Butuh bantuan lebih lanjut?</h4>
                    <p class="text-xs text-sky-700 mt-0.5">Hubungi tim layanan pelanggan kami melalui kontak resmi instansi.</p>
                </div>
                <!-- Menggunakan nomor WhatsApp: 628986343641 -->
                <a href="https://wa.me/628986343641" target="_blank" class="px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-sky-600/20 transition">
                    Hubungi via WhatsApp
                </a>
            </div>

        </div>
    </div>
</div>
@endsection