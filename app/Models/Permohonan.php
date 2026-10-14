<?php

namespace App\Models;

use App\Enums\StatusPermohonan;
use Illuminate\Database\Eloquent\Model;
use App\Models\RiwayatStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permohonan extends Model
{
    protected $fillable = [
        'id',
        'nomor_tiket',
        'user_id',
        'jenis_layanan_id',
        'nik_pemohon',
        'nama_pemohon',
        'detail_permohonan',
        'berkas_kk',          // Kolom baru
        'berkas_pengantar',   // Kolom baru
        'berkas_pendukung',   // Kolom baru
        'status',
        'catatan_operator',
        'berkas_nikah',       // Kolom baru
        'berkas_pernyataan',  // Kolom baru
        'berkas_hasil_jadi',
    ];

    protected $casts = [
        'status' => StatusPermohonan::class,


    ];

    // Relasi ke User (Masyarakat yang mengajukan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Jenis Layanan
    public function jenisLayanan(): BelongsTo
    {
        return $this->belongsTo(JenisLayanan::class, 'jenis_layanan_id');
    }
    // Relasi ke Riwayat Status
    public function riwayatStatus(): HasMany
    {
        return $this->hasMany(RiwayatStatus::class)->latest();
    }
}
