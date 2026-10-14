<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\JenisLayanan;

class PermohonanController extends Controller
{
    // Menampilkan Dashboard Operator & Antrean Permohonan
    public function index()
    {
        $permohonans = Permohonan::with(['user', 'jenisLayanan'])
            ->latest()
            ->paginate(5);

        // Perhitungan statistik dinamis yang sudah diperbaiki
        $pendingCount  = Permohonan::where('status', 'Menunggu')->count();
        $approvedCount = Permohonan::whereIn('status', ['Disetujui', 'Selesai'])->count();
        $rejectedCount = Permohonan::where('status', 'Ditolak')->count();

        return view('operator.dashboard', compact('permohonans', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    // Menampilkan Halaman Detail & Verifikasi Berkas Permohonan
    public function show($id)
    {
        $permohonan = Permohonan::with(['user', 'jenisLayanan'])->findOrFail($id);
        return view('operator.permohonan.show', compact('permohonan'));
    }

    // Memproses Status Verifikasi (Setuju / Tolak / Selesai + Berkas Hasil Jadi)
    public function update(Request $request, $id)
    {
        $request->validate([
            'status'            => 'required|in:Disetujui,Ditolak,Selesai',
            'catatan_operator'  => 'nullable|string',
            'berkas_hasil_jadi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $permohonan = Permohonan::findOrFail($id);

        $dataUpdate = [
            'status'           => $request->status,
            'catatan_operator' => $request->catatan_operator,
        ];

        if ($request->hasFile('berkas_hasil_jadi')) {
            $dataUpdate['berkas_hasil_jadi'] = $request->file('berkas_hasil_jadi')->store('berkas_permohonan', 'public');
        }

        $permohonan->update($dataUpdate);

        return redirect()->route('operator.dashboard')
            ->with('success', 'Status permohonan dan dokumen berhasil diperbarui!');
    }

    // Menampilkan Riwayat Verifikasi
    public function riwayat(Request $request)
    {
        $query = Permohonan::with(['user', 'jenisLayanan'])
            ->whereIn('status', ['Disetujui', 'Ditolak', 'Selesai']);

        // 1. Filter Pencarian Keyword (No Tiket atau Nama Pemohon)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_tiket', 'like', "%{$search}%")
                    ->orWhere('nama_pemohon', 'like', "%{$search}%");
            });
        }

        // 2. Filter Berdasarkan Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Filter Berdasarkan Jenis Layanan
        if ($request->filled('jenis_layanan_id')) {
            $query->where('jenis_layanan_id', $request->jenis_layanan_id);
        }

        // Eksekusi query & pertahankan parameter URL query string saat paginasi
        $riwayats = $query->latest()->paginate(5)->withQueryString();

        // Ambil daftar layanan untuk dropdown filter
        $layans = JenisLayanan::select('id', 'nama_layanan')->get();

        return view('operator.riwayat', compact('riwayats', 'layans'));
    }

    // Menampilkan Rekapitulasi & Laporan Kinerja
    public function laporan()
    {
        $totalPermohonan = Permohonan::count();
        $totalDisetujui  = Permohonan::whereIn('status', ['Disetujui', 'Selesai'])->count();
        $totalDitolak    = Permohonan::where('status', 'Ditolak')->count();
        $totalPending    = Permohonan::where('status', 'Menunggu')->count();

        return view('operator.laporan', compact('totalPermohonan', 'totalDisetujui', 'totalDitolak', 'totalPending'));
    }
    public function cetakPdf()
    {
        $totalPermohonan = Permohonan::count();
        $totalDisetujui  = Permohonan::whereIn('status', ['Disetujui', 'Selesai'])->count();
        $totalDitolak    = Permohonan::where('status', 'Ditolak')->count();
        $totalPending    = Permohonan::where('status', 'Menunggu')->count();

        $pdf = Pdf::loadView('operator.laporan_pdf', compact(
            'totalPermohonan',
            'totalDisetujui',
            'totalDitolak',
            'totalPending'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('Laporan-SIPANDAI-' . date('Y-m-d') . '.pdf');
    }
}
