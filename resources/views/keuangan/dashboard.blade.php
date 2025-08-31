@extends('layouts.admin')

@section('title', 'Dashboard Keuangan - MyYOGYA')
@section('page_title', 'Dashboard')

@section('page_header')
<h1><i class="fas fa-tachometer-alt me-3"></i>Dashboard Keuangan</h1>
<p class="lead">Overview kinerja keuangan dan transaksi MyYOGYA</p>
@endsection

@section('content')

<!-- KPI Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="kpi-card kpi-green">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h5>
                    <p>Total Pendapatan</p>
                    <small>Semua waktu</small>
                </div>
                <div class="kpi-icon">
                    <i class="fas fa-wallet fa-2x" style="color: #28a745; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card kpi-blue">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5>Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h5>
                    <p>Pendapatan Bulan Ini</p>
                    <small>{{ now()->format('F Y') }}</small>
                </div>
                <div class="kpi-icon">
                    <i class="fas fa-chart-line fa-2x" style="color: #007bff; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card kpi-yellow">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5>Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h5>
                    <p>Pendapatan Hari Ini</p>
                    <small>{{ now()->format('d M Y') }}</small>
                </div>
                <div class="kpi-icon">
                    <i class="fas fa-arrow-up fa-2x" style="color: #ffc107; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card kpi-red">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5>{{ $pendapatanPerKategori->count() }}</h5>
                    <p>Kategori Aktif</p>
                    <small>Kategori dengan penjualan</small>
                </div>
                <div class="kpi-icon">
                    <i class="fas fa-tags fa-2x" style="color: #dc3545; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row untuk Grafik dan Produk Terlaris -->
<div class="row g-4 mb-4">
    <!-- Grafik Pendapatan -->
    <div class="col-lg-8">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-chart-area me-2"></i>Pendapatan per Kategori</h5>
            </div>
            <div class="card-body">
                @if($pendapatanPerKategori->count() > 0)
                    <canvas id="categoryChart" height="80"></canvas>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-chart-pie fa-2x text-muted mb-2"></i>
                        <p class="text-muted">Belum ada data pendapatan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Produk Terlaris (berdasarkan pendapatan) -->
    <div class="col-lg-4">
        @include('components.produk-terlaris-card', [
            'produkTerlaris' => $produkTerlaris,
            'title' => 'Produk Menguntungkan',
            'limit' => 6,
            'showPrice' => true,
            'showRevenue' => true,
            'showActions' => true,
            'showDetailButton' => true,
            'showRefreshButton' => false,
            'showPeriod' => false,
            'maxWidth' => '150px',
            'emptyMessage' => 'Belum ada data penjualan',
            'showSeedButton' => false,
            'showLoading' => false,
            'includeScript' => true
        ])
    </div>
</div>

<!-- Pendapatan per Kategori Table -->
<div class="card-custom mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-table me-2"></i>Breakdown Pendapatan per Kategori</h5>
    </div>
    <div class="card-body">
        @if($pendapatanPerKategori->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Kategori</th>
                            <th>Total Pendapatan</th>
                            <th>Unit Terjual</th>
                            <th>Jumlah Produk</th>
                            <th>Rata-rata per Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendapatanPerKategori as $kategori)
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark">{{ $kategori->nama_kategori }}</span>
                                </td>
                                <td>
                                    <span class="text-success fw-semibold">
                                        Rp {{ number_format($kategori->total_pendapatan, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>{{ number_format($kategori->total_unit) }}</td>
                                <td>{{ $kategori->jumlah_produk }} produk</td>
                                <td>
                                    Rp {{ number_format($kategori->total_unit > 0 ? $kategori->total_pendapatan / $kategori->total_unit : 0, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-table fa-2x text-muted mb-2"></i>
                <p class="text-muted">Belum ada data kategori</p>
            </div>
        @endif
    </div>
</div>

<!-- Grafik Pendapatan Lama (disembunyikan) -->
<div class="card-custom mb-4 d-none">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-chart-area me-2"></i>Pendapatan Tahun Ini</h5>
    </div>
    <div class="card-body">
        <canvas id="incomeChart" height="100"></canvas>
    </div>
</div>
</div>

<!-- Produk Terlaris -->
<div class="card-custom">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-fire me-2"></i>Produk Terlaris</h5>
    </div>
    <div class="card-body">
        <h5 class="card-title mb-3">Produk Terlaris</h5>
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Varian</th>
                        <th>Ukuran</th>
                        <th>Harga</th>
                        <th>Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Indomie Goreng</td>
                        <td>Original</td>
                        <td>85gr</td>
                        <td>Rp3.250</td>
                        <td>600 bks</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Beras Ramos</td>
                        <td>Original</td>
                        <td>5kg</td>
                        <td>Rp65.000</td>
                        <td>320 bks</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Bimoli</td>
                        <td>Original</td>
                        <td>1L</td>
                        <td>Rp32.000</td>
                        <td>300 bks</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
@if($pendapatanPerKategori->count() > 0)
    // Category Revenue Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: [
                @foreach($pendapatanPerKategori as $kategori)
                    '{{ $kategori->nama_kategori }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($pendapatanPerKategori as $kategori)
                        {{ $kategori->total_pendapatan }},
                    @endforeach
                ],
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
                    '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF', '#4BC0C0'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        font: { size: 12 },
                        generateLabels: function(chart) {
                            const data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map((label, index) => {
                                    const value = data.datasets[0].data[index];
                                    const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    
                                    return {
                                        text: `${label} (${percentage}%)`,
                                        fillStyle: data.datasets[0].backgroundColor[index],
                                        strokeStyle: data.datasets[0].backgroundColor[index],
                                        pointStyle: 'circle',
                                        hidden: false,
                                        index: index
                                    };
                                });
                            }
                            return [];
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: Rp ${value.toLocaleString('id-ID')} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
@endif

// Legacy income chart (hidden but kept for compatibility)
const incomeCtx = document.getElementById('incomeChart');
if (incomeCtx) {
    const incomeChart = new Chart(incomeCtx.getContext('2d'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pendapatan',
                data: [25, 40, 35, 28, 34, 45, 30, 50, 32, 38, 29, 48],
                fill: true,
                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                borderColor: '#28a745',
                borderWidth: 2,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
}
</script>

@endsection
