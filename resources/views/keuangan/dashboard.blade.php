@extends('layouts.atmin')

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
                    <h5>Rp 22.000.000</h5>
                    <p>Saldo</p>
                    <small>Per Agustus 2025</small>
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
                    <h5>Rp 22.000.000</h5>
                    <p>Laba Kotor</p>
                    <small>Per Agustus 2025</small>
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
                    <h5>Rp 22.000.000</h5>
                    <p>Keuntungan</p>
                    <small>Per Agustus 2025</small>
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
                    <h5>Rp 22.000.000</h5>
                    <p>Kerugian</p>
                    <small>Per Agustus 2025</small>
                </div>
                <div class="kpi-icon">
                    <i class="fas fa-arrow-down fa-2x" style="color: #dc3545; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grafik Pendapatan -->
<div class="card-custom mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-chart-area me-2"></i>Pendapatan Tahun Ini</h5>
    </div>
    <div class="card-body">
        <canvas id="incomeChart" height="100"></canvas>
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
    const ctx = document.getElementById('incomeChart').getContext('2d');
    const incomeChart = new Chart(ctx, {
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
</script>

@endsection
