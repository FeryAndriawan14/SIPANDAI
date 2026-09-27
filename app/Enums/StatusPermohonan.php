<?php

namespace App\Enums;

enum StatusPermohonan: string
{
    case Menunggu = 'Menunggu';
    case Disetujui = 'Disetujui';
    case Ditolak = 'Ditolak';
    case Selesai = 'Selesai';
}
