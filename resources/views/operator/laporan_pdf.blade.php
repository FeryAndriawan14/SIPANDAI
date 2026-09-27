<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi SIPANDAI</title>
    <style>
        /* Reset & Page Setup */
        @page {
            margin: 1.5cm 2cm;
            size: A4 portrait;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11pt;
            color: #1e293b;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        /* Kop Surat Header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #0f172a;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo-container {
            width: 75px;
            height: 75px;
            display: inline-block;
        }

        .logo {
            width: 75px;
            height: auto;
            max-height: 75px;
            object-fit: contain;
        }

        .header-text {
            text-align: center;
        }

        .header-text h2 {
            margin: 0;
            font-size: 14pt;
            text-transform: uppercase;
            font-weight: bold;
            color: #0f172a;
        }

        .header-text h3 {
            margin: 2px 0;
            font-size: 12pt;
            font-weight: bold;
            color: #2563eb;
        }

        .header-text p {
            margin: 0;
            font-size: 8pt;
            color: #64748b;
        }

        /* Judul Laporan */
        .title-container {
            text-align: center;
            margin-bottom: 25px;
        }

        .title-container h4 {
            margin: 0;
            font-size: 12pt;
            text-transform: uppercase;
            text-decoration: underline;
            color: #0f172a;
        }

        .title-container p {
            margin: 3px 0 0 0;
            font-size: 9pt;
            color: #64748b;
        }

        /* Summary Cards Table Grid */
        .summary-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px 0;
            margin-bottom: 25px;
            margin-left: -10px;
            margin-right: -10px;
        }

        .card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
        }

        .card .card-title {
            font-size: 7.5pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #64748b;
            display: block;
            margin-bottom: 6px;
        }

        .card .card-value {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
        }

        /* Color Utility classes for PDF */
        .text-blue {
            color: #2563eb;
        }

        .text-emerald {
            color: #059669;
        }

        .text-rose {
            color: #e11d48;
        }

        .text-amber {
            color: #d97706;
        }

        /* Tabel Detail */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #cbd5e1;
            padding: 8px 12px;
            text-align: left;
            font-size: 9.5pt;
        }

        .data-table th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8.5pt;
        }

        .data-table td.center,
        .data-table th.center {
            text-align: center;
        }

        .data-table td.right,
        .data-table th.right {
            text-align: right;
        }

        .data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        /* Area Tanda Tangan */
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .footer-table td {
            vertical-align: top;
            font-size: 9.5pt;
        }

        .signature-box {
            text-align: center;
            float: right;
            width: 220px;
        }

        .signature-space {
            height: 65px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
            margin: 0;
        }

        .signature-title {
            color: #64748b;
            font-size: 8.5pt;
            margin: 2px 0 0 0;
        }
    </style>
</head>

<body>

    <!-- Kop Surat Header -->
    <table class="header-table">
        <tr>
            <td style="width: 15%; text-align: center;">
                <div class="logo-container">
                    @php
                    $logoPath = public_path('images/logo.png');
                    @endphp

                    @if(file_exists($logoPath))
                    <!-- Jika file logo fisik tersedia di public/images/logo.png -->
                    <img src="{{ $logoPath }}" class="logo" alt="Logo SIPANDAI">
                    @else
                    <!-- Fallback Logo SVG jika file gambar belum diunggah -->
                    <svg class="logo" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="45" fill="#2563EB" />
                        <path d="M30 40 L50 25 L70 40 L70 70 L30 70 Z" fill="#FFFFFF" opacity="0.9" />
                        <path d="M42 50 L58 50 L58 70 L42 70 Z" fill="#2563EB" />
                        <circle cx="50" cy="38" r="5" fill="#2563EB" />
                    </svg>
                    @endif
                </div>
            </td>
            <td class="header-text" style="width: 85%;">
                <h2>Pemerintah Daerah Layanan Publik</h2>
                <h3>SISTEM INFORMASI PELAYANAN DAERAH (SIPANDAI)</h3>
                <p>Jl. Jendral Sudirman No. 123, Komplek Perkantoran Pemda | Email: support@sipandai.go.id</p>
            </td>
        </tr>
    </table>

    <!-- Judul Dokumen -->
    <div class="title-container">
        <h4>LAPORAN REKAPITULASI PERMOHONAN LAYANAN</h4>
        <p>Dicetak Pada: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY - HH:mm') }} WIB</p>
    </div>

    <!-- Cards Summary statistik -->
    <table class="summary-table">
        <tr>
            <td style="width: 25%;">
                <div class="card">
                    <span class="card-title">Total Permohonan</span>
                    <p class="card-value text-blue">{{ $totalPermohonan }}</p>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="card">
                    <span class="card-title">Disetujui / Selesai</span>
                    <p class="card-value text-emerald">{{ $totalDisetujui }}</p>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="card">
                    <span class="card-title">Ditolak</span>
                    <p class="card-value text-rose">{{ $totalDitolak }}</p>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="card">
                    <span class="card-title">Menunggu Verifikasi</span>
                    <p class="card-value text-amber">{{ $totalPending }}</p>
                </div>
            </td>
        </tr>
    </table>

    <!-- Tabel Rincian Persentase Data -->
    <table class="data-table">
        <thead>
            <tr>
                <th class="center" style="width: 8%;">No</th>
                <th>Status Permohonan</th>
                <th class="center" style="width: 25%;">Jumlah Berkas</th>
                <th class="right" style="width: 25%;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center">1</td>
                <td><strong>Disetujui / Selesai</strong></td>
                <td class="center">{{ $totalDisetujui }}</td>
                <td class="right">
                    {{ $totalPermohonan > 0 ? number_format(($totalDisetujui / $totalPermohonan) * 100, 1) : 0 }}%
                </td>
            </tr>
            <tr>
                <td class="center">2</td>
                <td><strong>Ditolak</strong></td>
                <td class="center">{{ $totalDitolak }}</td>
                <td class="right">
                    {{ $totalPermohonan > 0 ? number_format(($totalDitolak / $totalPermohonan) * 100, 1) : 0 }}%
                </td>
            </tr>
            <tr>
                <td class="center">3</td>
                <td><strong>Menunggu Verifikasi</strong></td>
                <td class="center">{{ $totalPending }}</td>
                <td class="right">
                    {{ $totalPermohonan > 0 ? number_format(($totalPending / $totalPermohonan) * 100, 1) : 0 }}%
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr style="background-color: #f1f5f9; font-weight: bold;">
                <td colspan="2" class="center">TOTAL SELURUH PERMOHONAN</td>
                <td class="center">{{ $totalPermohonan }}</td>
                <td class="right">100%</td>
            </tr>
        </tfoot>
    </table>

    <!-- Tanda Tangan Operator / Pejabat -->
    <table class="footer-table">
        <tr>
            <td style="width: 60%;"></td>
            <td style="width: 40%;">
                <div class="signature-box">
                    <p>Kota Admin, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}</p>
                    <p style="margin-top: -5px;">Petugas Operator Layanan,</p>
                    <div class="signature-space"></div>
                    <p class="signature-name">{{ auth()->user()->name ?? 'Operator SIPANDAI' }}</p>
                    <p class="signature-title">NIP. {{ auth()->user()->nip ?? '19880101 202012 1 001' }}</p>
                </div>
            </td>
        </tr>
    </table>

</body>

</html>