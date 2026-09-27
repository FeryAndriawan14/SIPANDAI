<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permohonan;
use App\Models\JenisLayanan;
use App\Enums\StatusPermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\AuditReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Menampilkan Halaman Dashboard Utama Admin dengan Data Dinamis dari Database
    public function index()
    {
        $totalPengguna = User::count();
        $totalLayananAktif = JenisLayanan::count();

        // Hitung permohonan berdasarkan masing-masing status
        $permohonanMasuk = Permohonan::where('status', StatusPermohonan::Menunggu)->count();
        $layananDisetujui = Permohonan::where('status', StatusPermohonan::Disetujui)->count();
        $layananSelesai = Permohonan::where('status', StatusPermohonan::Selesai)->count();
        $layananDitolak = Permohonan::where('status', StatusPermohonan::Ditolak)->count();

        $totalPermohonan = Permohonan::count();

        $statistik = [
            'total_pengguna'    => $totalPengguna,
            'permohonan_masuk'  => $permohonanMasuk,
            'layanan_disetujui' => $layananDisetujui,
            'layanan_selesai'   => $layananSelesai,
            'layanan_ditolak'   => $layananDitolak,
            'layanan_aktif'     => $totalLayananAktif,
            'total_permohonan'  => $totalPermohonan,
        ];

        // Mengelompokkan jumlah permohonan berdasarkan statusnya dari database
        $chartStatus = Permohonan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $users = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('statistik', 'users', 'chartStatus'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Kata sandi berhasil diperbarui!');
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'no_hp'  => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function users(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(3)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'search'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'nik'   => 'nullable|string|max:20',
            'no_hp' => 'nullable|string|max:15',
            'role'  => 'required|string|in:admin,operator,warga,masyarakat',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'nik'   => $request->nik,
            'no_hp' => $request->no_hp,
            'role'  => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        if ((int) Auth::id() === (int) $user->id) {
            return redirect()->route('admin.users')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus dari sistem.');
    }

    public function layanan()
    {
        $layanan = JenisLayanan::latest()->paginate(10);
        return view('admin.layanan', compact('layanan'));
    }

    public function storeLayanan(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'persyaratan'  => 'required|string',
        ]);

        JenisLayanan::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
            'persyaratan'  => $request->persyaratan,
        ]);

        return redirect()->route('admin.layanan')->with('success', 'Jenis layanan berhasil ditambahkan.');
    }

    public function destroyLayanan($id)
    {
        $layanan = JenisLayanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('admin.layanan')->with('success', 'Jenis layanan berhasil dihapus.');
    }

    public function downloadAuditReport()
    {
        $filename = 'laporan-audit-sipandai-' . date('Y-m-d-His') . '.xlsx';

        return Excel::download(new AuditReportExport, $filename);
    }
}
