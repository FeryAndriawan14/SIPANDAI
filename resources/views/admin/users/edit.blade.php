@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white text-slate-800 p-8 rounded-3xl shadow-sm border border-slate-200/80">
    <div class="flex justify-between items-center mb-6 border-b border-slate-100 pb-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Edit Data Pengguna</h1>
            <p class="text-slate-500 text-sm mt-1">Perbarui informasi akun untuk {{ $user->name }}.</p>
        </div>
        <a href="{{ route('admin.users') }}" class="bg-white hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-xl text-sm font-semibold border border-slate-200 shadow-sm transition">← Kembali</a>
    </div>

    @if ($errors->any())
    <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-xl text-sm font-semibold shadow-sm">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Lengkap -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
            </div>

            <!-- NIK -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">NIK</label>
                <input type="text" name="nik" value="{{ old('nik', $user->nik) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
            </div>

            <!-- No HP -->
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nomor HP / WhatsApp</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
            </div>
        </div>

        <!-- Role -->
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Hak Akses Role</label>
            <select name="role" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
                <option value="warga" {{ $user->role == 'warga' ? 'selected' : '' }}>Masyarakat</option>
                <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.users') }}" class="bg-white hover:bg-slate-50 text-slate-700 px-6 py-3 rounded-xl text-sm font-semibold border border-slate-200 shadow-sm transition">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-semibold shadow-sm transition">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection