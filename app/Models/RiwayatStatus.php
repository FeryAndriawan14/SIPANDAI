<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatStatus extends Model
{
    protected $fillable = [
        'permohonan_id',
        'user_id',
        'status_awal',
        'status_akhir',
        'catatan',
    ];

    // Relasi ke Permohonan
    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class);
    }

    // Relasi ke User (Petugas/Admin yang mengubah status)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
