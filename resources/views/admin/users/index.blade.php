@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-white text-slate-800 p-6 rounded-3xl shadow-sm border border-slate-200/80 space-y-6">

    <!-- Header Judul -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-100 pb-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Pengguna SIPANDAI</h1>
            <p class="text-sm text-slate-500 mt-1">Daftar seluruh akun yang terdaftar dalam sistem.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="bg-white hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-xl text-sm font-semibold border border-slate-200 shadow-sm transition">← Kembali ke Dashboard</a>
        </div>
    </div>

    <!-- Notifikasi Sukses/Gagal -->
    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-3 shadow-sm">
        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold flex items-center gap-3 shadow-sm">
        <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        {{ session('error') }}
    </div>
    @endif

    <!-- Container Utama Tabel -->
    <div class="bg-slate-50 border border-slate-200/80 p-6 rounded-2xl shadow-sm space-y-4">

        <!-- Form Filtering / Pencarian Data -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <form action="{{ route('admin.users') }}" method="GET" class="w-full sm:w-auto flex items-center gap-2">
                <div class="relative w-full sm:w-80">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari NIK, Nama, Email, Role..."
                        class="w-full pl-9 pr-4 py-2 text-sm bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition shadow-sm" />
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition shadow-sm shrink-0">
                    Cari
                </button>
                @if(request('search'))
                <a href="{{ route('admin.users') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-3 py-2 rounded-xl text-sm font-semibold transition shrink-0">
                    Reset
                </a>
                @endif
            </form>
        </div>

        <!-- Tabel Data -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-100 text-slate-500 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="p-3 rounded-l-xl text-center w-12">No.</th>
                        <th class="p-3">NIK</th>
                        <th class="p-3">Nama Lengkap</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">No. HP</th>
                        <th class="p-3">Role</th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/60">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-100/50 transition">
                        <!-- Nomor berlanjut sesuai halaman paginasi -->
                        <td class="p-3 text-center font-medium text-slate-500">
                            {{ $users->firstItem() + $loop->index }}
                        </td>
                        <td class="p-3 font-mono text-xs text-slate-500">{{ $user->nik ?? '-' }}</td>
                        <td class="p-3 font-bold text-slate-900">{{ $user->name }}</td>
                        <td class="p-3 text-slate-600">{{ $user->email }}</td>
                        <td class="p-3 text-slate-500">{{ $user->no_hp ?? '-' }}</td>
                        <td class="p-3">
                            <span class="bg-red-50 text-red-600 text-xs px-3 py-1 rounded-full border border-red-200 uppercase font-bold tracking-wide">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="p-3 text-center flex items-center justify-center gap-2">
                            <!-- Tombol Edit -->


                            <!-- Tombol Hapus -->

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-slate-400 italic font-medium">
                            @if(request('search'))
                            Tidak ditemukan data pengguna dengan kata kunci "<span class="font-bold text-slate-600">{{ request('search') }}</span>".
                            @else
                            Belum ada data pengguna yang terdaftar.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Area Paginasi Custom Prev & Next -->
        <div class="mt-4 pt-4 border-t border-slate-200/60 flex items-center justify-between gap-4">
            <!-- Informasi Jumlah Data -->
            <p class="text-xs text-slate-500">
                Menampilkan <span class="font-bold text-slate-800">{{ $users->firstItem() ?? 0 }}</span>
                sampai <span class="font-bold text-slate-800">{{ $users->lastItem() ?? 0 }}</span>
                dari <span class="font-bold text-slate-800">{{ $users->total() }}</span> pengguna
            </p>

            <!-- Tombol Prev & Next -->
            <div class="inline-flex items-center gap-2">
                {{-- Tombol Previous --}}
                @if ($users->onFirstPage())
                <span class="px-3 py-1.5 text-xs font-semibold text-slate-400 bg-slate-100 border border-slate-200 rounded-xl cursor-not-allowed">
                    ← Prev
                </span>
                @else
                <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1.5 text-xs font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl shadow-sm transition">
                    ← Prev
                </a>
                @endif

                {{-- Indikator Halaman Saat Ini --}}
                <span class="text-xs font-semibold text-slate-600 px-2">
                    Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}
                </span>

                {{-- Tombol Next --}}
                @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1.5 text-xs font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl shadow-sm transition">
                    Next →
                </a>
                @else
                <span class="px-3 py-1.5 text-xs font-semibold text-slate-400 bg-slate-100 border border-slate-200 rounded-xl cursor-not-allowed">
                    Next →
                </span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection