<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPANDAI - Panel Operator & Verifikasi</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- OVERLAY GELAP SAAT SIDEBAR MUNCUL DI MOBILE -->
    <div x-show="sidebarOpen"
        @click="sidebarOpen = false"
        x-transition.opacity
        class="fixed inset-0 bg-slate-900/50 z-30 md:hidden"></div>

    <!-- SIDEBAR KIRI OPERATOR (RESPONSIF MOBILE & DESKTOP) -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed md:static inset-y-0 left-0 w-64 bg-white border-r border-slate-200 flex flex-col justify-between transition-transform duration-300 ease-in-out md:translate-x-0 h-screen z-40 shadow-xl md:shadow-none">
        <div>
            <!-- Logo Brand Operator -->
            <div class="h-20 flex items-center justify-between px-6 border-b border-slate-200 bg-emerald-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-600/30 font-extrabold text-white text-lg">
                        O
                    </div>
                    <div>
                        <span class="font-extrabold text-base tracking-wider text-slate-950 block">SIPANDAI</span>
                        <span class="text-[10px] text-emerald-600 font-bold tracking-widest uppercase">Panel Operator</span>
                    </div>
                </div>
                <!-- Tombol Tutup Sidebar khusus Mobile -->
                <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-slate-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Menu Navigasi Operator -->
            <div class="px-4 py-6 space-y-1.5 overflow-y-auto max-h-[calc(100vh-13rem)]">

                <!-- Verifikasi Berkas Masuk -->
                <a href="{{ route('operator.dashboard') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('operator.dashboard') || request()->routeIs('operator.permohonan.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Verifikasi Berkas Masuk
                </a>

                <!-- Riwayat Verifikasi -->
                <a href="{{ route('operator.riwayat') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('operator.riwayat') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Riwayat Verifikasi
                </a>

                <!-- Rekapitulasi Laporan -->
                <a href="{{ route('operator.laporan') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('operator.laporan') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Rekapitulasi Laporan
                </a>
                <a href="{{ route('operator.profil.edit') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('operator.profil.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Pengaturan Akun
                </a>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-rose-50 hover:text-rose-600 transition border border-transparent hover:border-rose-200 shadow-sm">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
    </aside>

    <!-- KONTEN UTAMA KANAN -->
    <div class="flex-1 flex flex-col min-w-0 bg-slate-100">
        <!-- Top Navbar -->
        <header class="h-20 bg-white border-b border-slate-200 px-4 sm:px-6 flex items-center justify-between sticky top-0 z-20 shadow-sm">
            <div class="flex items-center gap-3">
                <!-- Tombol Hamburger khusus Mobile -->
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-slate-600 hover:text-slate-900 focus:outline-none p-2 rounded-xl hover:bg-slate-100 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="text-xs sm:text-sm text-slate-600 font-semibold truncate">SIPANDAI - Sistem Validasi & Verifikasi Layanan Publik</span>
            </div>
            <div class="flex items-center gap-3">
            </div>
        </header>

        <!-- Area Konten Dinamis -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 bg-slate-100 overflow-x-auto">
            <!-- Flash Message / SweetAlert Integration -->
            @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        confirmButtonColor: '#059669',
                        confirmButtonText: 'OK',
                        background: '#ffffff',
                        color: '#1e293b'
                    });
                });
            </script>
            @endif

            @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: "{{ session('error') }}",
                        confirmButtonColor: '#e11d48',
                        confirmButtonText: 'Tutup',
                        background: '#ffffff',
                        color: '#1e293b'
                    });
                });
            </script>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 text-center py-4 text-xs text-slate-500 font-medium">
            &copy; 2026 SIPANDAI (Sistem Informasi Pelayanan Publik Aspiratif & Inovatif). All rights reserved.
        </footer>
    </div>

</body>

</html>