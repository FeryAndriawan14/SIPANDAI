@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto py-6 space-y-6">

    <!-- Header Judul -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Profil Administrator</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola informasi identitas akun dan keamanan kata sandi Anda.</p>
        </div>
        <div class="flex items-center gap-2">
        </div>
    </div>

    <!-- Alert Notifikasi Sukses -->
    @if(session('success'))
    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-3 shadow-sm">
        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- Alert Notifikasi Error Validasi -->
    @if ($errors->any())
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold space-y-1 shadow-sm">
        @foreach ($errors->all() as $error)
        <p class="flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-rose-600 inline-block"></span>
            {{ $error }}
        </p>
        @endforeach
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Kolom Kiri: Ringkasan Kartu Profil -->
        <div class="space-y-6">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 p-6 text-center relative overflow-hidden">
                <!-- Aksen Background atas -->
                <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-tr from-red-600 to-rose-500"></div>

                <!-- Avatar Profil -->
                <div class="relative mt-8 inline-block">
                    <div class="w-24 h-24 rounded-2xl bg-white border-4 border-white shadow-xl flex items-center justify-center font-black text-3xl mx-auto overflow-hidden">
                        @if(Auth::user()->avatar)
                        <!-- Foto Hasil Unggahan User -->
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                        @else
                        <!-- Default Foto dari folder public/images -->
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar" class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>

                <!-- Informasi Singkat -->
                <div class="mt-4">
                    <h2 class="text-lg font-bold text-slate-900 truncate">{{ Auth::user()->name }}</h2>
                    <p class="text-xs text-slate-500 truncate mt-0.5">{{ Auth::user()->email }}</p>

                    <div class="mt-4 inline-block px-3 py-1 rounded-xl bg-slate-100 text-slate-700 font-bold text-xs uppercase tracking-wider border border-slate-200">
                        {{ Auth::user()->role ?? 'Administrator' }}
                    </div>
                </div>

                <!-- Garis Pemisah -->
                <hr class="my-6 border-slate-100">

                <!-- Meta Info Pendukung -->
                <div class="text-left space-y-3">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-400 font-medium">Terdaftar Sejak</span>
                        <span class="text-slate-700 font-semibold">
                            {{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '-' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-slate-400 font-medium">Status Akun</span>
                        <span class="text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-md">Aktif</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Form Update Profil & Password -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Form Update Informasi Profil & Foto -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 p-6 sm:p-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Informasi Pribadi</h3>
                        <p class="text-xs text-slate-500">Perbarui foto profil, nama, email, dan nomor kontak Anda.</p>
                    </div>
                </div>

                <!-- Ditambahkan enctype="multipart/form-data" untuk unggah file -->
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Input Input File Unggah Foto Profil -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Unggah Foto Profil Baru</label>
                        <input type="file" name="avatar" accept="image/png, image/jpeg, image/jpg"
                            class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-600 hover:file:bg-red-100 transition cursor-pointer border border-slate-200 rounded-xl bg-slate-50/50">
                        <p class="text-[11px] text-slate-400 mt-1">Format yang didukung: JPG, JPEG, PNG (Maksimal 2MB).</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-medium text-slate-800 focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition bg-slate-50/50">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-medium text-slate-800 focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition bg-slate-50/50">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Nomor HP -->
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Nomor Telepon / WhatsApp</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', Auth::user()->no_hp) }}"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-medium text-slate-800 focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition bg-slate-50/50">
                        </div>

                        <!-- NIK -->
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">NIK</label>
                            <input type="text" value="{{ Auth::user()->nik ?? '-' }}" disabled
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-medium text-slate-400 bg-slate-100 cursor-not-allowed">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Form Ubah Password -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 p-6 sm:p-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Keamanan & Sandi</h3>
                        <p class="text-xs text-slate-500">Pastikan akun Anda menggunakan kata sandi yang aman.</p>
                    </div>
                </div>

                <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Kata Sandi Saat Ini</label>
                        <input type="password" name="current_password" placeholder="••••••••" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-medium text-slate-800 focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition bg-slate-50/50">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                            <input type="password" name="password" placeholder="••••••••" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-medium text-slate-800 focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition bg-slate-50/50">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Konfirmasi Sandi Baru</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-medium text-slate-800 focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition bg-slate-50/50">
                        </div>
                    </div>



            </div>

        </div>
    </div>
    @endsection