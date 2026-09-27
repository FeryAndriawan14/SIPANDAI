<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPANDAI - Portal Layanan Publik Masyarakat</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- SweetAlert2 CDN (Dipasang di Head agar siap digunakan kapan saja) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen flex">

    <!-- SIDEBAR KIRI MASYARAKAT -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between hidden md:flex sticky top-0 h-screen z-20 shadow-lg">
        <div>
            <!-- Logo Brand -->
            <div class="h-20 flex items-center px-6 border-b border-slate-200 bg-sky-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-600 to-blue-600 flex items-center justify-center shadow-lg shadow-sky-600/30 font-extrabold text-white text-lg">
                        S
                    </div>
                    <div>
                        <span class="font-extrabold text-base tracking-wider text-slate-950 block">SIPANDAI</span>
                        <span class="text-[10px] text-sky-600 font-bold tracking-widest uppercase">Portal Masyarakat</span>
                    </div>
                </div>
            </div>

            <!-- Menu Navigasi Full & Siap Pakai -->
            <div class="px-4 py-6 space-y-1.5 overflow-y-auto max-h-[calc(100vh-13rem)]">
                <p class="px-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2"></p>

                <!-- Dashboard Saya -->
                <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('masyarakat.dashboard') ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard Saya
                </a>

                <!-- Buat Permohonan Layanan Baru -->
                <a href="{{ route('masyarakat.permohonan.create') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('masyarakat.permohonan.*') ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Ajukan Layanan Baru
                </a>

                <!-- Tracking Berkas -->
                <a href="{{ route('masyarakat.tracking.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('masyarakat.tracking.*') ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Tracking Berkas
                </a>

                <!-- Arsip Dokumen Saya -->
                <a href="{{ route('masyarakat.arsip.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('masyarakat.arsip.*') ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    Arsip Dokumen Saya
                </a>

                <p class="px-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider mt-6 mb-2">Bantuan & Akun</p>

                <!-- Pusat Bantuan & FAQ -->
                <a href="{{ route('masyarakat.bantuan.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('masyarakat.bantuan.*') ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pusat Bantuan & FAQ
                </a>

                <!-- Pengaturan Akun -->
                <a href="{{ route('masyarakat.profil.edit') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('masyarakat.profil.*') ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
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
        <header class="h-20 bg-white border-b border-slate-200 px-6 flex items-center justify-between sticky top-0 z-10 shadow-sm">
            <div class="flex items-center gap-4">
                <span class="text-sm text-slate-600 font-semibold">Portal Layanan Mandiri Masyarakat SIPANDAI</span>
            </div>
            <div class="flex items-center gap-3">


            </div>
        </header>

        <!-- Area Konten Dinamis -->
        <main class="flex-1 p-8 bg-slate-100">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 text-center py-4 text-xs text-slate-500 font-medium">
            &copy; 2026 SIPANDAI (Sistem Informasi Pelayanan Publik Aspiratif & Inovatif). All rights reserved.
        </footer>
    </div>

</body>

</html>