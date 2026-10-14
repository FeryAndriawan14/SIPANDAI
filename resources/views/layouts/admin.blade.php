<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPANDAI - Sistem Informasi Pelayanan Publik</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- OVERLAY UNTUK MOBILE SAAT SIDEBAR BUKA -->
    <div
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-30 bg-slate-900/50 backdrop-blur-sm md:hidden"
        x-transition.opacity>
    </div>

    <!-- SIDEBAR KIRI (TEMA MERAH & PUTIH - TERANG) -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed md:translate-x-0 inset-y-0 left-0 w-64 bg-white border-r border-slate-200 flex flex-col justify-between z-40 h-screen shadow-xl transition-transform duration-300 ease-in-out">
        <div>
            <!-- Logo Brand -->
            <div class="h-20 flex items-center justify-between px-6 border-b border-slate-200 bg-red-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-red-600 to-rose-500 flex items-center justify-center shadow-lg shadow-red-600/30 font-extrabold text-white text-lg">
                        S
                    </div>
                    <div>
                        <span class="font-extrabold text-base tracking-wider text-slate-950 block">SIPANDAI</span>
                    </div>
                </div>
                <!-- Tombol Close untuk Mobile -->
                <button @click="sidebarOpen = false" class="md:hidden text-slate-500 hover:text-slate-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Menu Navigasi Utama -->
            <div class="px-4 py-6 space-y-1.5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white shadow-lg shadow-red-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.users*') ? 'bg-red-600 text-white shadow-lg shadow-red-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Manajemen Pengguna
                </a>
                <a href="{{ route('admin.layanan') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.layanan') ? 'bg-red-600 text-white shadow-lg shadow-red-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Konfigurasi Layanan
                </a>
                <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.profile*') ? 'bg-red-600 text-white shadow-lg shadow-red-600/30' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profil Saya
                </a>

                <!-- Tombol Keluar -->
                <form action="{{ route('logout') }}" method="POST" class="w-full pt-1">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition text-slate-600 hover:bg-rose-50 hover:text-rose-600 group">
                        <svg class="w-5 h-5 shrink-0 text-slate-400 group-hover:text-rose-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- KONTEN UTAMA KANAN -->
    <div class="flex-1 flex flex-col min-w-0 bg-slate-100 md:ml-64">
        <!-- Top Navbar -->
        <header class="h-20 bg-white border-b border-slate-200 px-6 flex items-center justify-between sticky top-0 z-10 shadow-sm">
            <div class="flex items-center gap-4">
                <!-- Tombol Hamburger untuk Mobile -->
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="text-xs md:text-sm text-slate-600 font-semibold truncate">Sistem Informasi Pelayanan Publik Aspiratif & Inovatif</span>
            </div>
            <div class="flex items-center gap-3">
            </div>
        </header>

        <!-- Area Konten Dinamis -->
        <main class="flex-1 p-4 md:p-8 bg-slate-100">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 text-center py-4 text-xs text-slate-500 font-medium">
            &copy; 2026 SIPANDAI. All rights reserved.
        </footer>
    </div>

</body>

</html>