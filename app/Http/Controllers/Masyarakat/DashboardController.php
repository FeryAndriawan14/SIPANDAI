<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // Pengecekan role langsung di dalam method
        if ($user->role !== 'masyarakat') {
            abort(403, 'Akses ditolak. Halaman ini khusus untuk masyarakat.');
        }

        // Mengambil data permohonan dengan Simple Pagination (5 item per halaman)
        $permohonans = Permohonan::with('jenisLayanan')
            ->where('user_id', $user->id)
            ->latest()
            ->simplePaginate(1); // <--- Diubah dari take(5)->get() ke simplePaginate(5)

        return view('masyarakat.dashboard', compact('permohonans'));
    }
}
