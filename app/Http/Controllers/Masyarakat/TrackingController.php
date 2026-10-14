<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    /**
     * Menampilkan daftar seluruh permohonan masyarakat dengan pencarian & paginasi
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $permohonans = Permohonan::with('jenisLayanan')
            ->where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nomor_tiket', 'like', "%{$search}%")
                        ->orWhereHas('jenisLayanan', function ($qLayanan) use ($search) {
                            $qLayanan->where('nama_layanan', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('masyarakat.tracking.index', compact('permohonans', 'search'));
    }

    /**
     * Menampilkan detail satu permohonan berdasarkan ID
     */
    public function show($id)
    {
        $permohonan = Permohonan::with('jenisLayanan')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('masyarakat.tracking.show', compact('permohonan'));
    }
}
