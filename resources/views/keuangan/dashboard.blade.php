@extends('layouts.atmin')

@section('title', 'Dashboard Keuangan - MyYOGYA Admin')
@section('page_title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- KPI Cards Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="kpi-card">
                <div class="kpi-icon text-primary">
                    <i class="fas fa-chart-line fa-3x"></i>
                </div>
                <h5>{{ 'Rp ' . number_format($totalPendapatan, 0, ',', '.') }}</h5>
                <p>Total Pendapatan</p>
                <small>Semua waktu</small>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="kpi-card">
                <div class="kpi-icon text-success">
                    <i class="fas fa-calendar-day fa-3x"></i>
                </div>
                <h5>{{ 'Rp ' . number_format($pendapatanHariIni, 0, ',', '.') }}</h5>
                <p>Pendapatan Hari Ini</p>
                <small>{{ now()->format('d M Y') }}</small>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="kpi-card">
                <div class="kpi-icon text-info">
                    <i class="fas fa-calendar-alt fa-3x"></i>
                </div>
                <h5>{{ 'Rp ' . number_format($pendapatanBulanIni, 0, ',', '.') }}</h5>
                <p>Pendapatan Bulan Ini</p>
                <small>{{ now()->format('M Y') }}</small>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="kpi-card">
                <div class="kpi-icon text-warning">
                    <i class="fas fa-shopping-cart fa-3x"></i>
                </div>
                <h5>{{ $produkTerlaris->count() }}</h5>
                <p>Produk Terlaris</p>
                <small>Top performers</small>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Pendapatan Per Kategori -->
        <div class="col-xl-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Pendapatan Per Kategori
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="kategoriChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Produk Terlaris -->
        <div class="col-xl-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-star me-2"></i>Produk Terlaris
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Terjual</th>
                                    <th>Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produkTerlaris->take(5) as $produk)
                                <tr>
                                    <td>{{ $produk->nama_barang }}</td>
                                    <td><span class="badge bg-primary">{{ $produk->nama_kategori }}</span></td>
                                    <td>{{ number_format($produk->total_terjual) }}</td>
                                    <td>{{ 'Rp ' . number_format($produk->total_pendapatan, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Analysis -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-analytics me-2"></i>Analisis Detail Kategori
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Kategori</th>
                                    <th>Total Pendapatan</th>
                                    <th>Unit Terjual</th>
                                    <th>Jumlah Produk</th>
                                    <th>Rata-rata per Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendapatanPerKategori as $kategori)
                                <tr>
                                    <td><strong>{{ $kategori->nama_kategori }}</strong></td>
                                    <td>{{ 'Rp ' . number_format($kategori->total_pendapatan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($kategori->total_unit) }}</td>
                                    <td>{{ $kategori->jumlah_produk }}</td>
                                    <td>{{ 'Rp ' . number_format($kategori->total_pendapatan / max($kategori->jumlah_produk, 1), 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart untuk Pendapatan Per Kategori
const kategoriData = @json($pendapatanPerKategori);
const kategoriLabels = kategoriData.map(item => item.nama_kategori);
const kategoriValues = kategoriData.map(item => item.total_pendapatan);

const ctx = document.getElementById('kategoriChart').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: kategoriLabels,
        datasets: [{
            data: kategoriValues,
            backgroundColor: [
                '#f26b37', '#d7263d', '#22c55e', '#3b82f6', '#8b5cf6',
                '#f59e0b', '#06b6d4', '#ec4899', '#10b981', '#6366f1'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endpush
@endsection