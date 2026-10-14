<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permohonan;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ArsipController extends Controller
{
    // Menampilkan daftar arsip milik user yang login
    public function index()
    {
        $arsips = Permohonan::where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->latest()
            ->paginate(5); // Menampilkan 10 data per halaman

        return view('masyarakat.arsip.index', compact('arsips'));
    }

    // Fungsi untuk mengunduh dokumen arsip
    public function download($id): StreamedResponse
    {
        $permohonan = Permohonan::where('user_id', Auth::id())->findOrFail($id);

        // Diperbaiki: Menggunakan kolom berkas_hasil_jadi sesuai database
        $filePath = $permohonan->berkas_hasil_jadi;

        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File dokumen hasil jadi tidak ditemukan di server.');
        }

        return Storage::disk('public')->download($filePath);
    }
}
