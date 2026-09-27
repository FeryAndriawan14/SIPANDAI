@extends('layouts.operator')

@section('content')
<style>
    /* Custom Glow & Modern Dashboard Styles */
    .glass-card {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(51, 65, 85, 0.6);
    }

    .status-btn {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .status-btn.active {
        background-color: rgba(51, 65, 85, 0.9);
        border-color: rgba(148, 163, 184, 0.5);
        box-shadow: 0 4px 14px -2px rgba(0, 0, 0, 0.4);
    }

    .kpi-card {
        background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%);
    }

    /* CSS Khusus Mode Cetak (Print) */
    @media print {

        .no-print,
        nav,
        sidebar,
        header {
            display: none !important;
        }

        body,
        div,
        .min-h-screen {
            background-color: #ffffff !important;
            color: #000000 !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
        }

        .card-print {
            border: 1px solid #cbd5e1 !important;
            background-color: #f8fafc !important;
            color: #0f172a !important;
        }

        .text-blue-400,
        .text-emerald-400,
        .text-rose-400,
        .text-amber-400,
        .print-text {
            color: #0f172a !important;
        }
    }
</style>

<div class="min-h-screen bg-slate-900 text-slate-100 p-6 rounded-2xl shadow-2xl border border-slate-800 space-y-6">

    <!-- Top Action Banner -->
    <div class="glass-card p-6 rounded-2xl flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <h3 class="text-xl font-extrabold text-slate-100 tracking-tight">Executive Analytics & Laporan Layanan</h3>
            </div>
            <p class="text-slate-400 text-xs sm:text-sm">Monitoring permohonan real-time & efisiensi operasional SIPANDAI.</p>
        </div>

        <div class="no-print shrink-0 flex items-center gap-3">
            <button onclick="downloadChartImage()" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-semibold text-xs px-3.5 py-2.5 rounded-xl shadow-lg transition">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Export Chart
            </button>
            <a href="{{ route('operator.laporan.pdf') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-lg transition duration-200 hover:shadow-emerald-900/40">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Download PDF
            </a>

        </div>
    </div>

    <!-- Kotak Statistik Utama (4 Card KPI) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="card-print kpi-card p-5 rounded-2xl border border-slate-700/60 relative overflow-hidden group hover:border-blue-500/50 transition">
            <div class="flex justify-between items-start">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Total Permohonan</span>
                <span class="p-2 bg-blue-500/10 text-blue-400 rounded-xl"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg></span>
            </div>
            <h3 class="text-3xl font-black mt-2 text-blue-400 tracking-tight">{{ $totalPermohonan ?? 0 }}</h3>
            <p class="text-[11px] text-slate-400 mt-1">Seluruh berkas masuk</p>
        </div>

        <div class="card-print kpi-card p-5 rounded-2xl border border-slate-700/60 relative overflow-hidden group hover:border-emerald-500/50 transition">
            <div class="flex justify-between items-start">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Disetujui / Selesai</span>
                <span class="p-2 bg-emerald-500/10 text-emerald-400 rounded-xl"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg></span>
            </div>
            <h3 class="text-3xl font-black mt-2 text-emerald-400 tracking-tight">{{ $totalDisetujui ?? 0 }}</h3>
            <p class="text-[11px] text-emerald-400/80 mt-1">Layanan terterbitkan</p>
        </div>

        <div class="card-print kpi-card p-5 rounded-2xl border border-slate-700/60 relative overflow-hidden group hover:border-rose-500/50 transition">
            <div class="flex justify-between items-start">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Ditolak</span>
                <span class="p-2 bg-rose-500/10 text-rose-400 rounded-xl"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg></span>
            </div>
            <h3 class="text-3xl font-black mt-2 text-rose-400 tracking-tight">{{ $totalDitolak ?? 0 }}</h3>
            <p class="text-[11px] text-rose-400/80 mt-1">Tidak memenuhi syarat</p>
        </div>

        <div class="card-print kpi-card p-5 rounded-2xl border border-slate-700/60 relative overflow-hidden group hover:border-amber-500/50 transition">
            <div class="flex justify-between items-start">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Menunggu Verifikasi</span>
                <span class="p-2 bg-amber-500/10 text-amber-400 rounded-xl"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg></span>
            </div>
            <h3 class="text-3xl font-black mt-2 text-amber-400 tracking-tight">{{ $totalPending ?? 0 }}</h3>
            <p class="text-[11px] text-amber-400/80 mt-1">Dalam proses pemeriksaan</p>
        </div>
    </div>

    <!-- Main Analytics Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Interactive Chart (2 Kolom) -->
        <div class="lg:col-span-2 card-print glass-card p-6 rounded-2xl border border-slate-700/60 shadow-xl flex flex-col justify-between">
            <div>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div>
                        <h4 class="text-base font-bold text-slate-100">Visualisasi & Sebaran Status</h4>
                        <p class="text-slate-400 text-xs">Pilih mode grafik atau filter segmen untuk analisis mendalam</p>
                    </div>

                    <div class="no-print flex items-center gap-2">
                        <!-- Switcher Type (Donut vs Bar) -->
                        <div class="flex items-center bg-slate-900/80 p-1 rounded-xl border border-slate-700/50">
                            <button onclick="changeChartType('doughnut')" id="type-doughnut" class="p-1.5 rounded-lg text-slate-300 hover:text-white bg-slate-800" title="Donut Chart">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                </svg>
                            </button>
                            <button onclick="changeChartType('bar')" id="type-bar" class="p-1.5 rounded-lg text-slate-400 hover:text-white" title="Bar Chart">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Segment Quick Highlight -->
                        <div class="flex items-center gap-1 bg-slate-900/80 p-1 rounded-xl border border-slate-700/50">
                            <button onclick="highlightSegment(null)" class="status-btn active px-2.5 py-1 rounded-lg text-xs font-medium text-slate-300" id="btn-all">Semua</button>
                            <button onclick="highlightSegment(0)" class="status-btn px-2.5 py-1 rounded-lg text-xs font-medium text-emerald-400" id="btn-0">Selesai</button>
                            <button onclick="highlightSegment(1)" class="status-btn px-2.5 py-1 rounded-lg text-xs font-medium text-rose-400" id="btn-1">Ditolak</button>
                            <button onclick="highlightSegment(2)" class="status-btn px-2.5 py-1 rounded-lg text-xs font-medium text-amber-400" id="btn-2">Pending</button>
                        </div>
                    </div>
                </div>

                <!-- Donut Canvas Area -->
                <div class="w-full max-w-xs mx-auto relative flex items-center justify-center my-4" style="height: 270px;">
                    <canvas id="laporanChart"></canvas>

                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none text-center" id="centerBadge">
                        <span class="text-4xl font-black text-slate-100 tracking-tight transition-all duration-300 print-text" id="centerValue">
                            {{ $totalPermohonan ?? 0 }}
                        </span>
                        <span class="text-[10px] uppercase tracking-widest text-slate-400 font-bold mt-1 transition-all duration-300 print-text" id="centerLabel">
                            Total Layanan
                        </span>
                        <span class="text-[11px] font-semibold text-emerald-400 mt-0.5 opacity-0 transition-opacity duration-300" id="centerSub">
                            0%
                        </span>
                    </div>
                </div>
            </div>

            <!-- Footer Badge -->
            <div class="pt-4 border-t border-slate-700/50 flex items-center justify-between text-xs text-slate-400">

            </div>
        </div>

        <!-- Performance & SLA Panel (1 Kolom) -->
        @php
        $total = ($totalDisetujui ?? 0) + ($totalDitolak ?? 0) + ($totalPending ?? 0);
        $pctSelesai =$total > 0 ? round((($totalDisetujui ?? 0) / $total) * 100, 1) : 0;
        $pctDitolak =$total > 0 ? round((($totalDitolak ?? 0) / $total) * 100, 1) : 0;
        $pctPending =$total > 0 ? round((($totalPending ?? 0) / $total) * 100, 1) : 0;
        $slaRate = $total > 0 ? round((($totalDisetujui + $totalDitolak) /$total) * 100, 1) : 0;
        @endphp

        <div class="card-print glass-card p-6 rounded-2xl border border-slate-700/60 shadow-xl flex flex-col justify-between space-y-6">
            <div>
                <h4 class="text-base font-bold text-slate-100 mb-1">Performa & Rasio SLA</h4>
                <p class="text-slate-400 text-xs mb-5">Efisiensi penyelesaian berkas masuk</p>

                <!-- SLA Metric Card -->
                <div class="p-4 rounded-xl bg-slate-900/60 border border-slate-700/50 mb-5">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-semibold text-slate-300">SLA Compliance Rate</span>
                        <span class="text-xs font-bold text-emerald-400">{{ $slaRate }}%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $slaRate }}%"></div>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-2">Tingkat responsivitas berkas diproses (Selesai/Ditolak) vs Total Masuk.</p>
                </div>

                <!-- Detailed Breakdown Bars -->
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span class="text-slate-300 flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Disetujui</span>
                            <span class="text-emerald-400 font-bold">{{ $pctSelesai }}%</span>
                        </div>
                        <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $pctSelesai }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span class="text-slate-300 flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-rose-500"></span> Ditolak</span>
                            <span class="text-rose-400 font-bold">{{ $pctDitolak }}%</span>
                        </div>
                        <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-rose-500 rounded-full" style="width: {{ $pctDitolak }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span class="text-slate-300 flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-500"></span> Menunggu</span>
                            <span class="text-amber-400 font-bold">{{ $pctPending }}%</span>
                        </div>
                        <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-500 rounded-full" style="width: {{ $pctPending }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Insight Summary Box -->
            <div class="p-3.5 bg-slate-900/80 rounded-xl border border-slate-700/50 text-center">
                <span class="text-[11px] uppercase tracking-wider text-slate-400 font-semibold">Kesimpulan Analisis</span>
                <p class="text-xs font-bold text-slate-200 mt-0.5">
                    @if($pctPending > 30)
                    <span class="text-amber-400">Antrean Verifikasi Perlu Perhatian ({{ $pctPending }}%)</span>
                    @else
                    <span class="text-emerald-400">Proses Alur Kerja Berjalan Lancar</span>
                    @endif
                </p>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
    let myChartInstance = null;
    let currentChartType = 'doughnut';

    const rawData = {
        disetujui: Number("{{ $totalDisetujui ?? 0 }}") || 0,
        ditolak: Number("{{ $totalDitolak ?? 0 }}") || 0,
        pending: Number("{{ $totalPending ?? 0 }}") || 0,
        total: Number("{{ $totalPermohonan ?? 0 }}") || 0
    };

    function renderChart(type = 'doughnut') {
        const canvas = document.getElementById('laporanChart');
        const badgeContainer = document.getElementById('centerBadge');
        if (!canvas) return;

        currentChartType = type;

        // Sembunyikan badge tengah jika berubah ke mode Bar Chart
        if (type === 'bar') {
            badgeContainer.style.display = 'none';
        } else {
            badgeContainer.style.display = 'flex';
        }

        const isDataEmpty = rawData.total === 0;
        const chartData = isDataEmpty ? [1, 0, 0] : [rawData.disetujui, rawData.ditolak, rawData.pending];

        const ctx = canvas.getContext('2d');

        // Color Gradients
        const emeraldGrad = ctx.createLinearGradient(0, 0, 0, 200);
        emeraldGrad.addColorStop(0, '#10b981');
        emeraldGrad.addColorStop(1, '#047857');

        const roseGrad = ctx.createLinearGradient(0, 0, 0, 200);
        roseGrad.addColorStop(0, '#f43f5e');
        roseGrad.addColorStop(1, '#be123c');

        const amberGrad = ctx.createLinearGradient(0, 0, 0, 200);
        amberGrad.addColorStop(0, '#f59e0b');
        amberGrad.addColorStop(1, '#b45309');

        const bgColors = [emeraldGrad, roseGrad, amberGrad];

        if (myChartInstance) myChartInstance.destroy();

        const config = {
            type: type,
            data: {
                labels: ['Disetujui', 'Ditolak', 'Menunggu'],
                datasets: [{
                    label: 'Jumlah Permohonan',
                    data: chartData,
                    backgroundColor: bgColors,
                    borderWidth: type === 'doughnut' ? 4 : 0,
                    borderColor: '#1e293b',
                    borderRadius: type === 'bar' ? 6 : 8,
                    spacing: type === 'doughnut' ? 3 : 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: type === 'doughnut' ? '75%' : 0,
                animation: {
                    duration: 800,
                    easing: 'easeOutQuart'
                },
                scales: type === 'bar' ? {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#334155'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                } : {},
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#94a3b8',
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 16,
                            font: {
                                size: 11,
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        enabled: type === 'bar',
                        external: type === 'doughnut' ? function(context) {
                            const centerVal = document.getElementById('centerValue');
                            const centerLbl = document.getElementById('centerLabel');
                            const centerSub = document.getElementById('centerSub');

                            if (context.tooltip.opacity === 0) {
                                centerVal.innerText = rawData.total;
                                centerVal.className = "text-4xl font-black text-slate-100 tracking-tight transition-all duration-300 print-text";
                                centerLbl.innerText = "Total Layanan";
                                centerSub.classList.add('opacity-0');
                                return;
                            }

                            const dataIndex = context.tooltip.dataPoints[0].dataIndex;
                            const val = context.tooltip.dataPoints[0].raw;
                            const lbl = context.chart.data.labels[dataIndex];
                            const pct = rawData.total > 0 ? ((val / rawData.total) * 100).toFixed(1) : 0;

                            const colors = ['text-emerald-400', 'text-rose-400', 'text-amber-400'];

                            centerVal.innerText = val;
                            centerVal.className = `text-4xl font-black ${colors[dataIndex]} tracking-tight transition-all duration-300 print-text`;
                            centerLbl.innerText = lbl;
                            centerSub.innerText = `${pct}% dari Total`;
                            centerSub.classList.remove('opacity-0');
                        } : null
                    }
                }
            }
        };

        myChartInstance = new Chart(ctx, config);
    }

    function changeChartType(type) {
        document.getElementById('type-doughnut').classList.toggle('bg-slate-800', type === 'doughnut');
        document.getElementById('type-bar').classList.toggle('bg-slate-800', type === 'bar');
        renderChart(type);
    }

    function highlightSegment(index) {
        document.querySelectorAll('.status-btn').forEach(btn => btn.classList.remove('active'));

        if (index === null) {
            document.getElementById('btn-all').classList.add('active');
            myChartInstance.setActiveElements([]);
        } else {
            document.getElementById(`btn-${index}`).classList.add('active');
            myChartInstance.setActiveElements([{
                datasetIndex: 0,
                index: index
            }]);
        }
        myChartInstance.update();
    }

    function downloadChartImage() {
        const canvas = document.getElementById('laporanChart');
        const imageURI = canvas.toDataURL('image/png');
        const link = document.createElement('a');
        link.download = 'Laporan-SIPANDAI-Chart.png';
        link.href = imageURI;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    if (document.readyState === "complete" || document.readyState === "interactive") {
        renderChart();
    } else {
        document.addEventListener("DOMContentLoaded", () => renderChart());
    }
</script>
@endsection