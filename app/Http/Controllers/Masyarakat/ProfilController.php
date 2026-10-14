<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('masyarakat.profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi input form
        $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required'   => 'Nama lengkap wajib diisi.',
            'email.required'  => 'Alamat email wajib diisi.',
            'email.unique'    => 'Email ini sudah terdaftar oleh pengguna lain.',
            'avatar.image'    => 'Berkas harus berupa gambar.',
            'avatar.mimes'    => 'Format gambar yang diperbolehkan hanya JPEG, PNG, dan JPG.',
            'avatar.max'      => 'Ukuran gambar maksimal 2MB.',
            'password.min'    => 'Kata sandi minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        // Siapkan data dasar yang akan di-update
        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // Proses upload avatar jika ada berkas baru
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada di storage
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Simpan avatar baru ke folder 'avatars' pada disk 'public'
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        // Jika kolom password diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Simpan perubahan ke database
        $user->update($data);

        return redirect()->route('masyarakat.profil.edit')->with('success', 'Profil dan informasi akun berhasil diperbarui!');
    }
}
