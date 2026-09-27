<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permohonan;
use App\Enums\StatusPermohonan;
use App\Models\JenisLayanan;
use Illuminate\Support\Str;

class PermohonanController extends Controller
{
    /**
     * Tampilkan form permohonan layanan baru.
     */
    public function create()
    {
        $jenisLayanans = JenisLayanan::all();
        return view('masyarakat.permohonan.create', compact('jenisLayanans'));
    }

    /**
     * Simpan data permohonan ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Teks Utama
        // 1. Validasi Input Teks Utama
        $request->validate([
            'jenis_layanan_id'  => 'required|exists:jenis_layanans,id',
            'nik_pemohon'       => 'required|string|size:16', // Ubah max:16 jadi size:16 agar pas
            'nama_pemohon'      => 'required|string|max:255',
            'detail_permohonan' => 'required|string',
        ]);

        // === TAMBAHAN: VALIDASI USIA MINIMAL 17 TAHUN BERDASARKAN NIK ===
        $nik = $request->nik_pemohon;
        // Ambil substring tanggal lahir dari NIK (format: DDMMYY di indeks ke-6 s/d 11)
        $tglStr = substr($nik, 6, 2);
        $blnStr = substr($nik, 8, 2);
        $thnStr = substr($nik, 10, 2);

        // Aturan NIK Dukcapil: Jika tanggal > 40, berarti perempuan (kurangi 40)
        $tgl = (int)$tglStr;
        if ($tgl > 40) {
            $tgl -= 40;
        }

        // Tentukan abad (00-29 diasumsikan tahun 2000-an, 30-99 diasumsikan tahun 1900-an)
        $thnFull = ($thnStr <= 30) ? 2000 + (int)$thnStr : 1900 + (int)$thnStr;

        // Buat objek tanggal lahir dan hitung selisih dengan hari ini
        try {
            $tanggalLahir = \Carbon\Carbon::createFromDate($thnFull, (int)$blnStr, $tgl);
            $usia = $tanggalLahir->age;

            if ($usia < 17) {
                return back()->withInput()->withErrors([
                    'nik_pemohon' => 'Maaf, usia pemohon berdasarkan NIK belum genap 17 tahun (Usia saat ini: ' . $usia . ' tahun). Pembuatan KTP minimal berusia 17 tahun.'
                ]);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'nik_pemohon' => 'Format tanggal lahir pada NIK tidak valid. Mohon periksa kembali NIK Anda.'
            ]);
        }
        // ==============================================================

        $user = Auth::user();
        $nomorTiket = 'TIKET-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        // 2. Persiapan Data Dasar untuk Database
        $data = [
            'nomor_tiket'       => $nomorTiket,
            'user_id'           => $user->id,
            'jenis_layanan_id'  => $request->jenis_layanan_id,
            'nik_pemohon'       => $request->nik_pemohon,
            'nama_pemohon'      => $request->nama_pemohon,
            'detail_permohonan' => $request->detail_permohonan,
            'status'            => StatusPermohonan::Menunggu, // <-- DIPERBAIKI: Menggunakan Enum Case
            'catatan_operator'  => null,
            'berkas_kk'         => null,
            'berkas_pengantar'  => null,
            'berkas_pendukung'  => null,
            'berkas_nikah'      => null,
            'berkas_pernyataan' => null,
        ];

        // Ambil nama layanan berdasarkan ID yang dipilih di database
        $layanan = JenisLayanan::find($request->jenis_layanan_id);
        $namaLayanan = strtolower($layanan->nama_layanan ?? '');

        // 3. Validasi & Pemetaan Berkas Berdasarkan Layanan Kependudukan
        if (str_contains($namaLayanan, 'ktp') || str_contains($namaLayanan, 'identitas')) {
            $request->validate([
                'ktp_berkas_kk'        => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'ktp_berkas_pengantar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'berkas_pendukung'     => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $data['berkas_kk']         = $request->file('ktp_berkas_kk')->store('berkas_permohonan', 'public');
            $data['berkas_pengantar']  = $request->file('ktp_berkas_pengantar')->store('berkas_permohonan', 'public');
            $data['berkas_pendukung']  = $request->file('berkas_pendukung')->store('berkas_permohonan', 'public');
        } elseif (str_contains($namaLayanan, 'kartu keluarga') || str_contains($namaLayanan, 'kk')) {
            $request->validate([
                'kk_berkas_pengantar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'berkas_nikah'        => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'kk_berkas_kk'        => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $data['berkas_pengantar'] = $request->file('kk_berkas_pengantar')->store('berkas_permohonan', 'public');
            $data['berkas_nikah']     = $request->file('berkas_nikah')->store('berkas_permohonan', 'public');
            $data['berkas_kk']        = $request->file('kk_berkas_kk')->store('berkas_permohonan', 'public');
        } elseif (str_contains($namaLayanan, 'domisili')) {
            $request->validate([
                'domisili_berkas_ktp'       => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'domisili_berkas_pengantar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'berkas_pernyataan'         => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $data['berkas_kk']         = $request->file('domisili_berkas_ktp')->store('berkas_permohonan', 'public');
            $data['berkas_pengantar']  = $request->file('domisili_berkas_pengantar')->store('berkas_permohonan', 'public');
            $data['berkas_pernyataan'] = $request->file('berkas_pernyataan')->store('berkas_permohonan', 'public');
        }

        // 4. Simpan ke Database
        Permohonan::create($data);

        // 5. Redirect ke dashboard dengan pesan sukses
        return redirect()->route('masyarakat.dashboard')
            ->with('success', 'Permohonan layanan kependudukan berhasil diajukan! Nomor Tiket Anda: ' . $nomorTiket);
    }
}
