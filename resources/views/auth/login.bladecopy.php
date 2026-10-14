@extends('layouts.auth')

@section('content')
<div class="bg-white border border-slate-200/80 p-8 rounded-2xl shadow-xl shadow-slate-200/50">
    <div class="text-center mb-6">
        <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center shadow-md shadow-blue-500/20 font-extrabold text-white text-xl mx-auto mb-3">
            S
        </div>
        <h2 class="text-2xl font-bold tracking-tight text-slate-900">Masuk ke Portal SIPANDAI</h2>
        <p class="text-slate-500 text-xs mt-1">Sistem Informasi Pelayanan Publik Aspiratif & Inovatif</p>
    </div>

    @if($errors->any())
    <div class="bg-rose-50 border border-rose-200 text-rose-600 p-3 mb-4 rounded-xl text-sm font-medium">
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium text-xs text-slate-700 mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-slate-50/50 border border-slate-300 rounded-xl p-3 text-slate-900 text-sm focus:outline-none focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/10 transition">
        </div>

        <div>
            <label class="block font-medium text-xs text-slate-700 mb-1.5">Kata Sandi (Password)</label>
            <div class="relative">
                <input type="password" id="password" name="password" required class="w-full bg-slate-50/50 border border-slate-300 rounded-xl p-3 pr-10 text-slate-900 text-sm focus:outline-none focus:border-blue-600 focus:bg-white focus:ring-2 focus:ring-blue-600/10 transition">

                <!-- Tombol Icon Mata -->
                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                    <!-- Icon Mata Terbuka (Default) -->
                    <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <!-- Icon Mata Dicoret (Hidden by default) -->
                    <svg id="eye-off-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold text-sm shadow-lg shadow-blue-600/20 transition">
            Masuk
        </button>
    </form>

    <div class="mt-6 text-center text-xs text-slate-500 border-t border-slate-100 pt-4">
        <p class="font-medium text-slate-600">Gunakan akun demo seeder:</p>
        <p class="mt-1">Admin: <code class="text-slate-800 bg-slate-100 px-1.5 py-0.5 rounded font-mono">fery.andriawan14@gmail.com</code></p>
        <p class="mt-1">Operator: <code class="text-slate-800 bg-slate-100 px-1.5 py-0.5 rounded font-mono">fery.andryawan1@gmail.com</code></p>
        <p class="mt-2">Password untuk semua: <code class="text-slate-800 bg-slate-100 px-1.5 py-0.5 rounded font-mono">password123</code></p>
    </div>
</div>
<!-- Footer Copyright -->
<div class="mt-6 pt-4 border-t border-slate-100 text-center">
    <p class="text-[11px] text-slate-400 font-medium">&copy; 2026 Fery Andriawan. All rights reserved.</p>
</div>
</div>
<!-- Skrip JavaScript untuk Toggle Password -->
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeOffIcon = document.getElementById('eye-off-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeOffIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeOffIcon.classList.add('hidden');
        }
    }
</script>
@endsection