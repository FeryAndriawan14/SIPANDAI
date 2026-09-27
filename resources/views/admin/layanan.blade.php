@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-white text-slate-800 p-6 rounded-3xl shadow-sm border border-slate-200/80">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 border-b border-slate-100 pb-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Konfigurasi Jenis Layanan Publik</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola daftar layanan, deskripsi, dan persyaratan dokumen.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="bg-white hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-xl text-sm font-semibold border border-slate-200 shadow-sm transition">← Kembali ke Dashboard</a>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm font-semibold shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form Tambah Layanan -->
        <div class="bg-slate-50 border border-slate-200/80 p-6 rounded-2xl h-fit shadow-sm">
            <h3 class="text-lg font-bold mb-4 text-slate-900">Tambah Layanan Baru</h3>
            <form action="{{ route('admin.layanan.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wide">Nama Layanan</label>
                    <input type="text" name="nama_layanan" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-blue-600 transition" placeholder="Contoh: Pembuatan Akta Kelahiran">
                </div>
                <div class="mb-4">
                    <label class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wide">Deskripsi Singkat</label>
                    <textarea name="deskripsi" required rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-blue-600 transition" placeholder="Jelaskan detail layanan..."></textarea>
                </div>
                <div class="mb-6">
                    <label class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wide">Persyaratan Dokumen</label>
                    <input type="text" name="persyaratan" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-blue-600 transition" placeholder="KTP, KK, Surat Pengantar">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl text-sm transition shadow-sm">Simpan Layanan</button>
            </form>
        </div>

        <!-- Tabel Daftar Layanan -->
        <div class="lg:col-span-2 bg-slate-50 border border-slate-200/80 p-6 rounded-2xl shadow-sm">
            <h3 class="text-lg font-bold mb-4 text-slate-900">Daftar Layanan Publik Aktif</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-700">
                    <thead class="bg-slate-100 text-slate-500 uppercase text-xs font-bold tracking-wider">
                        <tr>
                            <th class="p-3 rounded-l-xl">Nama Layanan</th>
                            <th class="p-3">Deskripsi</th>
                            <th class="p-3">Persyaratan</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200/60">
                        @forelse($layanan as $item)
                        <tr class="hover:bg-slate-100/50 transition">
                            <td class="p-3 font-bold text-slate-900">{{ $item->nama_layanan }}</td>
                            <td class="p-3 text-slate-600 text-xs">{{ $item->deskripsi }}</td>
                            <td class="p-3 text-slate-600 text-xs font-mono">{{ $item->persyaratan }}</td>
                            <td class="p-3 text-center">

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-slate-500 text-sm">Belum ada jenis layanan yang terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-200/60">
                {{ $layanan->links() }}
            </div>
        </div>
    </div>
</div>
@endsection