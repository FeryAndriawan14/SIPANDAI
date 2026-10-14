@extends('layouts.admin')

@section('content')
<div class="space-y-8 pb-12 font-sans text-slate-800 dark:text-slate-100 flex flex-col min-h-screen justify-between">

    <div class="space-y-8">
        <!-- ========================================== -->
        <!-- 1. HERO WELCOME BANNER (ULTRA ENTERPRISE)  -->
        <!-- ========================================== -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-rose-950 p-8 md:p-10 shadow-2xl border border-slate-800/80 text-white">
            <div class="absolute -right-10 -top-20 w-96 h-96 bg-rose-600/20 rounded-full blur-[110px] pointer-events-none animate-pulse"></div>
            <div class="absolute right-1/3 -bottom-24 w-80 h-80 bg-red-500/10 rounded-full blur-[90px] pointer-events-none"></div>
            <div class="absolute left-10 -top-10 w-60 h-60 bg-indigo-600/15 rounded-full blur-[80px] pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-3">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30 backdrop-blur-md shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-rose-400 animate-ping"></span>
                            SPBE Executive Command Center
                        </span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-800/80 text-slate-300 border border-slate-700/60 shadow-inner">

                    </div>

                    @php
                    $hour = now()->hour;
                    if ($hour >= 3 && $hour < 11) {
                        $greeting='Selamat Pagi' ;
                        $icon='🌅' ;
                        } elseif ($hour>= 11 && $hour < 15) {
                            $greeting='Selamat Siang' ;
                            $icon='☀️' ;
                            } elseif ($hour>= 15 && $hour < 18) {
                                $greeting='Selamat Sore' ;
                                $icon='🌆' ;
                                } else {
                                $greeting='Selamat Malam' ;
                                $icon='🌙' ;
                                }
                                @endphp

                                <h1 class="text-3xl md:text-4xl font-black tracking-tight text-white">
                                {{ $greeting }}, <span class="bg-gradient-to-r from-rose-400 via-red-300 to-amber-200 bg-clip-text text-transparent">{{ Auth::user()->name }}</span> {{ $icon }}
                                </h1>
                                <p class="text-slate-300 text-sm md:text-base max-w-2xl font-normal leading-relaxed">
                                    Pusat kendali ekosistem digital pelayanan publik. Pantau statistik performa secara *real-time*, analisis beban sistem, dan kelola manajemen operasional terpadu.
                                </p>
                </div>

                <!-- Live Server Clock Widget -->
                <div class="flex items-center gap-4 bg-slate-900/80 backdrop-blur-2xl p-4 rounded-2xl border border-slate-700/80 shadow-2xl shrink-0">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-rose-600 to-red-500 text-white flex items-center justify-center font-bold text-xl shadow-lg shadow-rose-900/40">
                        🕒
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="text-[11px] uppercase tracking-wider text-slate-400 font-bold">Waktu Server Live</span>
                        </div>
                        <span class="text-base font-black text-slate-100 tracking-wide">{{ now()->format('d M Y') }} • {{ now()->format('H:i') }} WIB</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 2. METRIC CARDS (INTERACTIVE & GLOWING)    -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">

            <!-- Card 1: Total Pengguna -->
            <div class="group relative bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-5 rounded-3xl shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-indigo-500/10 rounded-full blur-xl group-hover:bg-indigo-500/25 transition-all"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block">Total Pengguna</span>
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1 tracking-tight">{{ number_format($statistik['total_pengguna']) }}</h3>
                    </div>
                    <div class="p-3 bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 rounded-2xl border border-indigo-100 dark:border-indigo-800/50 group-hover:scale-110 transition-transform shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between text-xs font-semibold">
                    <span class="text-emerald-600 flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Terdaftar
                    </span>
                    <span class="text-slate-400 font-normal">Sistem SPBE</span>
                </div>
            </div>

            <!-- Card 2: Permohonan Masuk -->
            <div class="group relative bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-5 rounded-3xl shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-amber-500/10 rounded-full blur-xl group-hover:bg-amber-500/25 transition-all"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block">Permohonan Masuk</span>
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1 tracking-tight">{{ number_format($statistik['permohonan_masuk']) }}</h3>
                    </div>
                    <div class="p-3 bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 rounded-2xl border border-amber-100 dark:border-amber-800/50 group-hover:scale-110 transition-transform shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between text-xs font-semibold">
                    <span class="text-amber-600 flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span> Menunggu
                    </span>
                    <span class="text-slate-400 font-normal">Antrean Operator</span>
                </div>
            </div>

            <!-- Card 3: Layanan Disetujui -->
            <div class="group relative bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-5 rounded-3xl shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-blue-500/10 rounded-full blur-xl group-hover:bg-blue-500/25 transition-all"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block">Sedang Diproses</span>
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1 tracking-tight">{{ number_format($statistik['layanan_disetujui']) }}</h3>
                    </div>
                    <div class="p-3 bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 rounded-2xl border border-blue-100 dark:border-blue-800/50 group-hover:scale-110 transition-transform shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between text-xs font-semibold">
                    <span class="text-blue-600 flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Disetujui
                    </span>
                    <span class="text-slate-400 font-normal">Tahap Operasional</span>
                </div>
            </div>

            <!-- Card 4: Layanan Selesai -->
            <div class="group relative bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-5 rounded-3xl shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-emerald-500/10 rounded-full blur-xl group-hover:bg-emerald-500/25 transition-all"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block">Layanan Selesai</span>
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1 tracking-tight">{{ number_format($statistik['layanan_selesai']) }}</h3>
                    </div>
                    <div class="p-3 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 rounded-2xl border border-emerald-100 dark:border-emerald-800/50 group-hover:scale-110 transition-transform shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between text-xs font-semibold">
                    <span class="text-emerald-600 flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Dokumen Terbit
                    </span>
                    <span class="text-slate-400 font-normal">Verified</span>
                </div>
            </div>

            <!-- Card 5: Jenis Layanan Aktif -->
            <div class="group relative bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-5 rounded-3xl shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-rose-500/10 rounded-full blur-xl group-hover:bg-rose-500/25 transition-all"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block">Jenis Layanan</span>
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1 tracking-tight">{{ number_format($statistik['layanan_aktif']) }}</h3>
                    </div>
                    <div class="p-3 bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 rounded-2xl border border-rose-100 dark:border-rose-800/50 group-hover:scale-110 transition-transform shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-between text-xs font-semibold">
                    <span class="text-rose-600 flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-rose-500"></span> Katalog Aktif
                    </span>
                    <span class="text-slate-400 font-normal">Layanan Publik</span>
                </div>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- 3. ADVANCED VISUALIZATION (APEXCHARTS)    -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Main Interactive Spline Area Chart (2 Column) -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-4 rounded-2xl shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-5 border-b border-slate-100 dark:border-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-rose-50 dark:bg-rose-950/50 text-rose-600 rounded-2xl border border-rose-100 dark:border-rose-900/40">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">Tren Permohonan Layanan</h3>
                                <p class="text-xs text-slate-500">Analisis beban volume permohonan masuk</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-slate-50 dark:bg-slate-800/50 p-2.5 px-4 rounded-2xl border border-slate-200/60 dark:border-slate-700/60">
                            <div class="text-right">
                                <span class="text-[10px] text-slate-400 font-bold uppercase block tracking-wider">Total Volume</span>
                                <span class="text-base font-black text-slate-900 dark:text-white">{{ number_format($statistik['total_permohonan']) }} <span class="text-xs font-normal text-slate-500">Berkas</span></span>
                            </div>
                            <div class="h-7 w-px bg-slate-200 dark:bg-slate-700"></div>
                            <div class="text-right">
                                <span class="text-[10px] text-slate-400 font-bold uppercase block tracking-wider">Completion Rate</span>
                                @php
                                $rate = $statistik['total_permohonan'] > 0 ? round(($statistik['layanan_selesai'] / $statistik['total_permohonan']) * 100, 1) : 0;
                                @endphp
                                <span class="text-base font-black text-emerald-600 dark:text-emerald-400">{{ $rate }}%</span>
                            </div>
                        </div>
                    </div>


                    <div id="apexSplineChart" class="w-full h-50"></div>
                </div>
            </div>

            <!-- Radial Semi-Gauge & Modern Breakdown (1 Column) -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-4 rounded-2xl shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4 pb-4 border-b border-slate-100 dark:border-slate-800">
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">Status Distribution</h3>
                            <p class="text-xs text-slate-500">Rasio persentase status permohonan</p>
                        </div>
                    </div>

                    <div id="apexDonutChart" class="w-full h-50 flex items-center justify-center"></div>
                    <div class="grid grid-cols-2 gap-2.5 mt-2">
                        <div class="p-2.5 rounded-2xl bg-amber-50/60 dark:bg-amber-950/20 border border-amber-100 dark:border-amber-900/30 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Menunggu</span>
                            </div>
                            <span class="text-xs font-black text-amber-700 dark:text-amber-400">{{ $statistik['permohonan_masuk'] }}</span>
                        </div>

                        <div class="p-2.5 rounded-2xl bg-blue-50/60 dark:bg-blue-950/20 border border-blue-100 dark:border-blue-900/30 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Disetujui</span>
                            </div>
                            <span class="text-xs font-black text-blue-700 dark:text-blue-400">{{ $statistik['layanan_disetujui'] }}</span>
                        </div>

                        <div class="p-2.5 rounded-2xl bg-emerald-50/60 dark:bg-emerald-950/20 border border-emerald-100 dark:border-emerald-900/30 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Selesai</span>
                            </div>
                            <span class="text-xs font-black text-emerald-700 dark:text-emerald-400">{{ $statistik['layanan_selesai'] }}</span>
                        </div>

                        <div class="p-2.5 rounded-2xl bg-rose-50/60 dark:bg-rose-950/20 border border-rose-100 dark:border-rose-900/30 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Ditolak</span>
                            </div>
                            <span class="text-xs font-black text-rose-700 dark:text-rose-400">{{ $statistik['layanan_ditolak'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- 4. QUICK ACTIONS & RECENT USERS PANEL     -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Control Panel (2 Column) -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 p-8 rounded-3xl shadow-sm">
                <div class="flex items-center gap-3.5 mb-3">
                    <div class="w-10 h-10 rounded-2xl bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 flex items-center justify-center font-bold border border-rose-200/60 dark:border-rose-900/40 shadow-sm">
                        ⚙️
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">Pusat Kendali Administrasi</h3>
                        <p class="text-xs text-slate-500">Kelola akses, pengaturan layanan, dan laporan audit</p>
                    </div>
                </div>

                <p class="text-slate-600 dark:text-slate-400 text-sm mb-6 max-w-2xl leading-relaxed">
                    Manajemen akun pengguna sistem, atur katalog jenis layanan publik yang aktif, dan unduh laporan audit aktivitas keamanan sistem dalam format Excel secara berkala.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.users') }}" class="group bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-white px-6 py-3.5 rounded-2xl font-bold text-sm transition-all duration-200 shadow-lg shadow-rose-600/25 flex items-center gap-2.5 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 text-white/80 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Manajemen Pengguna
                    </a>

                    <a href="{{ route('admin.layanan') }}" class="group bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-100 px-6 py-3.5 rounded-2xl font-bold text-sm transition-all duration-200 border border-slate-200/80 dark:border-slate-700 flex items-center gap-2.5 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 text-slate-500 dark:text-slate-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Konfigurasi Layanan
                    </a>

                    <a href="{{ route('admin.audit.download') }}" class="group bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-100 px-6 py-3.5 rounded-2xl font-bold text-sm transition-all duration-200 border border-slate-200/80 dark:border-slate-700 flex items-center gap-2.5 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 text-rose-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Unduh Audit Report
                    </a>
                </div>
            </div>

            <!-- Bagian Latest Registrations Panel -->
            <div class="space-y-3">
                @forelse($users as $u)
                <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-slate-800 to-slate-900 text-white font-bold text-xs flex items-center justify-center uppercase shadow-md">
                            {{ substr($u->name, 0, 2) }}
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-800 dark:text-slate-100">{{ $u->name }}</p>
                            <p class="text-[10px] text-slate-400">{{ $u->email }}</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 uppercase">
                        {{ $u->role }}
                    </span>
                </div>
                @empty
                <p class="text-xs text-slate-400 text-center py-4">Belum ada pengguna terdaftar.</p>
                @endforelse
            </div>
        </div>
    </div>



</div>

<!-- ========================================== -->
<!-- APEXCHARTS CDN & SCRIPT ENGINE             -->
<!-- ========================================== -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rawChartData = @json($chartStatus);

        const labels = Object.keys(rawChartData).map(status => {
            return status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
        });
        const dataValues = Object.values(rawChartData);

        const palette = ['#f59e0b', '#3b82f6', '#10b981', '#f43f5e', '#8b5cf6', '#6366f1'];

        // 1. APEX SPLINE AREA CHART
        const splineOptions = {
            series: [{
                name: 'Permohonan Masuk',
                data: dataValues
            }],
            chart: {
                type: 'area',
                height: 260,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#e11d48'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3.5
            },
            markers: {
                size: 5,
                colors: ['#ffffff'],
                strokeColors: '#e11d48',
                strokeWidth: 3,
                hover: {
                    size: 8
                }
            },
            xaxis: {
                categories: labels,
                labels: {
                    style: {
                        colors: '#64748b',
                        fontSize: '11px',
                        fontWeight: 600
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#64748b',
                        fontSize: '11px'
                    },
                    formatter: (val) => Math.floor(val)
                }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4,
                padding: {
                    top: 10,
                    right: 10,
                    bottom: 0,
                    left: 10
                }
            },
            tooltip: {
                theme: 'dark',
                y: {
                    formatter: (val) => `${val} Permohonan`
                }
            }
        };

        const splineChart = new ApexCharts(document.querySelector("#apexSplineChart"), splineOptions);
        splineChart.render();

        // 2. APEX SEMI-DONUT GAUGE CHART
        const donutOptions = {
            series: dataValues,
            labels: labels,
            chart: {
                type: 'donut',
                height: 260,
                fontFamily: 'Inter, sans-serif'
            },
            colors: palette,
            plotOptions: {
                pie: {
                    startAngle: -90,
                    endAngle: 90,
                    offsetY: 10,
                    donut: {
                        size: '78%',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '12px',
                                color: '#64748b',
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '22px',
                                fontWeight: 'bold',
                                color: '#0f172a',
                                offsetY: -2
                            },
                            total: {
                                show: true,
                                label: 'Total Volume',
                                color: '#64748b',
                                formatter: function(w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                }
                            }
                        }
                    }
                }
            },
            grid: {
                padding: {
                    bottom: -80
                }
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            tooltip: {
                theme: 'dark'
            }
        };

        const donutChart = new ApexCharts(document.querySelector("#apexDonutChart"), donutOptions);
        donutChart.render();
    });
</script>
@endsection