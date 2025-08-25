@extends('layouts.app')

@section('title', 'Dashboard - MyYOGYA')
@section('page_title', 'Dashboard')

@section('content')

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="kpi-card kpi-green">
            <h5>Rp 22.000.000</h5>
            <p>Saldo</p>
            <small>Per Agustus 2025</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card kpi-blue">
            <h5>Rp 22.000.000</h5>
            <p>Laba Kotor</p>
            <small>Per Agustus 2025</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card kpi-yellow">
            <h5>Rp 22.000.000</h5>
            <p>Keuntungan</p>
            <small>Per Agustus 2025</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card kpi-red">
            <h5>Rp 22.000.000</h5>
            <p>Kerugian</p>
            <small>Per Agustus 2025</small>
        </div>
    </div>
</div>

<!-- Grafik Pendapatan -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Pendapatan Tahun Ini</h5>
        <canvas id="incomeChart" height="100"></canvas>
    </div>
</div>

<!-- Produk Terlaris -->
<div class="card">
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
