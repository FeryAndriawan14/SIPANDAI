@extends('layouts.auth')

@section('content')
<!-- Load Google reCAPTCHA JS API -->
{!! htmlScriptTagJsApi() !!}

<div class="bg-white/90 backdrop-blur-2xl border border-slate-200/80 p-8 sm:p-10 rounded-3xl shadow-2xl shadow-indigo-950/15 relative overflow-hidden">
    <!-- Aksen Glow Ambient Background -->
    <div class="absolute -right-24 -top-24 w-60 h-60 bg-gradient-to-br from-indigo-500/15 to-violet-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -left-24 -bottom-24 w-60 h-60 bg-gradient-to-tr from-blue-500/15 to-cyan-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10">
        <!-- Header Brand Premium -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-violet-600 flex items-center justify-center shadow-xl shadow-indigo-600/30 text-white mx-auto mb-4 ring-4 ring-indigo-50 transform hover:scale-105 transition duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900">Portal SIPANDAI</h2>
            <p class="text-indigo-600 font-semibold text-[10px] tracking-wider uppercase mt-1">Sistem Informasi Pelayanan Publik Aspiratif & Inovatif</p>
        </div>

        <!-- Banner Visual Tematik -->
        <div class="mb-6 relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-indigo-950 to-blue-950 p-5 text-white shadow-lg border border-indigo-800/50">
            <div class="absolute right-0 top-0 translate-x-4 -translate-y-4 w-32 h-32 bg-blue-500/20 rounded-full blur-2xl pointer-events-none"></div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shrink-0 shadow-inner">
                    <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <span class="inline-block px-2.5 py-0.5 rounded-full bg-indigo-500/30 text-indigo-300 text-[10px] font-bold tracking-widest uppercase border border-indigo-400/30 mb-1">Government Tech</span>
                    <h2 class="text-xs font-bold text-slate-100 uppercase tracking-wide leading-snug">Transformasi Digital</h2>
                    <p class="text-[11px] text-slate-300 mt-0.5 font-light leading-relaxed">Verifikasi permohonan aman, cepat dan transparan.</p>
                </div>
            </div>
        </div>

        @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-600 p-3.5 mb-6 rounded-2xl text-xs font-bold flex items-center gap-2 shadow-sm animate-shake">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block font-normal text-xs text-slate-600 tracking-wide mb-2">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="w-full bg-slate-50/80 border border-slate-300 rounded-2xl py-3.5 pl-11 pr-4 text-slate-900 text-sm font-medium focus:outline-none focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block font-normal text-xs text-slate-600 tracking-wide">Kata Sandi (Password)</label>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" id="password" name="password" required placeholder="••••••••" class="w-full bg-slate-50/80 border border-slate-300 rounded-2xl py-3.5 pl-11 pr-12 text-slate-900 text-sm font-medium focus:outline-none focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 transition">

                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                        <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg id="eye-off-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Checkbox Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2.5 cursor-pointer group">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/20 focus:ring-offset-0 transition cursor-pointer">
                    <span class="text-xs font-medium text-slate-600 group-hover:text-slate-900 transition">Ingat Saya</span>
                </label>
            </div>

            <!-- Widget Google reCAPTCHA -->
            <div class="flex justify-center my-4">
                {!! htmlFormSnippet() !!}
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-600 hover:from-blue-700 hover:via-indigo-700 hover:to-violet-700 text-white py-4 rounded-2xl font-bold text-sm shadow-xl shadow-indigo-600/30 transform hover:-translate-y-0.5 transition-all duration-200">
                Masuk
            </button>
        </form>

        <!-- Footer Copyright -->
        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-400 font-medium">
                &copy; 2026 <span class="text-slate-700 font-bold">Fery Andriawan</span>. All rights reserved.
            </p>
            <p class="text-[10px] text-indigo-600/80 font-semibold tracking-wider uppercase mt-1">Enterprise Grade Security Protocol</p>
        </div>
    </div>
</div>

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