<?php

namespace App\Models;

use App\Models\Permohonan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class JenisLayanan extends Model
{
    use HasFactory;

    protected $table = 'jenis_layanans'; // Sesuaikan dengan nama tabel di database Anda

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'persyaratan',
    ];

    // Relasi balik ke Permohonan (Opsional, untuk memanggil data permohonan dari jenis layanan)
    public function permohonans()
    {
        return $this->hasMany(Permohonan::class, 'jenis_layanan_id');
    }
}
