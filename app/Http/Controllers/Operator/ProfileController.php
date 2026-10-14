<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class ProfileController extends Controller
{
    // Menampilkan halaman edit profil operator
    public function edit()
    {
        return view('operator.profil.edit');
    }

    // Memproses pembaruan data profil, foto & password
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Upload Foto Profil
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada dan file-nya eksis di storage
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Simpan foto baru ke folder storage/app/public/avatars
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('operator.profil.edit')->with('success', 'Pengaturan akun berhasil diperbarui!');
    }
}
