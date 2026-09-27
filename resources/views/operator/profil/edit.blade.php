@extends('layouts.operator')

@section('content')
<div class="min-h-screen bg-slate-900 text-slate-100 p-6 rounded-2xl shadow-2xl border border-slate-800 space-y-6">
    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-emerald-950 via-teal-950 to-slate-900 p-6 sm:p-8 rounded-2xl shadow-xl border border-emerald-700/60 relative overflow-hidden">
        <div class="z-10">
            <span class="bg-emerald-500/30 text-emerald-300 text-xs font-bold px-3 py-1 rounded-full border border-emerald-400/40">Pengaturan Akun</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold mt-2 tracking-tight text-white">Profil Petugas Verifikator</h1>
            <p class="text-slate-300 text-xs sm:text-sm mt-1">Perbarui informasi identitas akun, foto profil, dan kata sandi login Anda di sini.</p>
        </div>
    </div>

    <!-- Notifikasi Berhasil Disimpan -->
    @if(session('success'))
    <div class="bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 px-5 py-4 rounded-xl text-sm font-semibold flex items-center gap-3 shadow-lg">
        <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- Form Pengaturan Profil -->
    <div class="bg-slate-800/60 backdrop-blur border border-slate-700/60 p-6 sm:p-8 rounded-2xl shadow-lg">
        <form action="{{ route('operator.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Section Foto Profil -->
            <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-700">
                <div class="relative group">
                    <img id="avatar-preview"
                        src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0d9488&color=fff' }}"
                        alt="Foto Profil"
                        class="w-24 h-24 rounded-full object-cover border-4 border-emerald-500/40 shadow-md">
                </div>

                <div class="space-y-2 text-center sm:text-left">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300">Foto Profil</label>
                    <input type="file" name="avatar" id="avatar-input" accept="image/*" class="hidden" onchange="previewImage(event)">

                    <button type="button" onclick="document.getElementById('avatar-input').click()"
                        class="bg-slate-700 hover:bg-slate-600 text-slate-200 px-4 py-2 rounded-xl text-xs font-semibold border border-slate-600 transition">
                        Pilih Foto Baru
                    </button>
                    <p class="text-[11px] text-slate-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>

                    @error('avatar')
                    <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-slate-100 text-sm focus:outline-none focus:border-emerald-500 transition">
                    @error('name')
                    <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Alamat Email -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-slate-100 text-sm focus:outline-none focus:border-emerald-500 transition">
                    @error('email')
                    <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <hr class="border-slate-700">

            <div class="space-y-4">
                <h3 class="text-sm font-bold text-slate-200">Ubah Kata Sandi (Opsional)</h3>
                <p class="text-xs text-slate-400">Kosongkan bagian ini jika Anda tidak ingin mengganti kata sandi lama Anda.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kata Sandi Baru -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Kata Sandi Baru</label>
                        <input type="password" name="password" placeholder="Minimal 6 karakter"
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-slate-100 text-sm focus:outline-none focus:border-emerald-500 transition">
                        @error('password')
                        <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Konfirmasi Kata Sandi -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi baru"
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-slate-100 text-sm focus:outline-none focus:border-emerald-500 transition">
                    </div>
                </div>
            </div>


    </div>
</div>

<script>
    // Preview gambar saat dipilah tanpa reload
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection