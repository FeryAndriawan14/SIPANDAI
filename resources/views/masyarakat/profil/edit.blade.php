@extends('layouts.masyarakat')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <!-- Header Section -->
            <div class="mb-8 pb-6 border-b border-slate-100">
                <h2 class="text-xl font-bold text-slate-800">Pengaturan Profil Akun</h2>
                <p class="text-sm text-slate-500 mt-1">Perbarui informasi data diri, foto profil, dan kata sandi akun Anda.</p>
            </div>

            <!-- Flash Message -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <!-- Form Edit Profil -->
            <form action="{{ route('masyarakat.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Section Foto Profil -->
                <div class="mb-6 pb-6 border-b border-slate-100">
                    <label class="block text-sm font-medium text-slate-700 mb-3">Foto Profil</label>
                    <div class="flex items-center gap-6">
                        <div class="shrink-0">
                            @if($user->avatar)
                            <img id="preview-foto" class="h-20 w-20 object-cover rounded-full border-2 border-slate-200 shadow-sm" src="{{ asset('storage/' . $user->avatar) }}" alt="Foto Profil">
                            @else
                            <div id="preview-placeholder" class="h-20 w-20 rounded-full bg-sky-100 text-sky-600 font-bold text-2xl flex items-center justify-center border-2 border-slate-200 shadow-sm">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <img id="preview-foto" class="h-20 w-20 object-cover rounded-full border-2 border-slate-200 shadow-sm hidden" alt="Preview Foto">
                            @endif
                        </div>
                        <div>
                            <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/jpg" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 transition cursor-pointer">
                            <span class="text-xs text-slate-400 mt-1 block">Format: JPG, JPEG, PNG (Maksimal 2MB)</span>
                            @error('avatar')
                            <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
                        @error('name')
                        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
                        @error('email')
                        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">NIK (Nomor Induk Kependudukan)</label>
                        <input type="text" value="{{ $user->nik ?? '-' }}" class="w-full border-slate-200 bg-slate-50 rounded-xl shadow-sm text-slate-500 cursor-not-allowed" disabled>
                        <span class="text-xs text-slate-400 mt-1 block">NIK tidak dapat diubah secara mandiri.</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nomor Handphone / WhatsApp</label>
                        <input type="text" value="{{ $user->no_hp ?? '-' }}" class="w-full border-slate-200 bg-slate-50 rounded-xl shadow-sm text-slate-500 cursor-not-allowed" disabled>
                    </div>
                </div>
        </div>
    </div>
</div>

<!-- Script Instant Preview Gambar -->
<script>
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewFoto = document.getElementById('preview-foto');
                const previewPlaceholder = document.getElementById('preview-placeholder');

                previewFoto.src = e.target.result;
                previewFoto.classList.remove('hidden');

                if (previewPlaceholder) {
                    previewPlaceholder.classList.add('hidden');
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection