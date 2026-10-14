<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Autentikasi Login Berdasarkan Role
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'recaptcha',
        ], [
            'g-recaptcha-response.recaptcha' => 'Harap konfirmasi bahwa Anda bukan robot.',
            'g-recaptcha-response.required' => 'Wajib melakukan verifikasi reCAPTCHA.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember'); // Mengambil nilai checkbox 'remember'

        // Auth::attempt menerima parameter kedua berupa boolean untuk Remember Me
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Arahkan ke dashboard masing-masing role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'operator') {
                return redirect()->route('operator.dashboard');
            } else {
                return redirect()->route('masyarakat.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
