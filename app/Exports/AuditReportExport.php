<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AuditReportExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithColumnFormatting
{
    public function collection()
    {
        return User::all();
    }

    // Pemetaan data per baris (NIK dan No HP diberi tanda petik atau dikirim sebagai string)
    public function map($user): array
    {
        return [
            $user->id,
            // Tambahkan spasi kosong atau string agar Excel membacanya sebagai teks murni
            (string) ' ' . ($user->nik ?? '-'),
            $user->name,
            $user->email,
            (string) ' ' . ($user->no_hp ?? '-'),
            strtoupper($user->role),
            $user->created_at ? $user->created_at->format('d-m-Y H:i:s') : '-'
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIK',
            'Nama Lengkap',
            'Email',
            'No. HP',
            'Role / Peran',
            'Tanggal Terdaftar'
        ];
    }

    // Memaksa kolom NIK (B) dan No HP (E) menggunakan format teks
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Styling untuk Baris Header (Baris 1)
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'],
                    'size' => 11,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '1E293B'], // Warna Slate-800
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ],
            // Memberikan border ke seluruh tabel data
            'A1:G' . ($sheet->getHighestRow()) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'CBD5E1'],
                    ],
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ]
            ],
        ];
    }
}
