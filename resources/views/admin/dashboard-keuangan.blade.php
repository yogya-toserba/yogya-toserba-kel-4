@extends('layouts.navbar_admin')

@section('title', 'Analisis Keuangan - MyYOGYA Admin')

@section('page-title', 'Analisis Keuangan')
@section('page-subtitle', 'Monitor pendapatan, transaksi, dan performa keuangan bisnis')

@section('content')
<style>
/* Yogya Brand Colors */
:root {
    --yogya-green: #4CAF50;
    --yogya-green-dark: #388E3C;
    --yogya-green-light: #66BB6A;
}

.keuangan-header {
    background: linear-gradient(135deg, var(--yogya-green) 0%, var(--yogya-green-dark) 100%);
    color: white;
    padding: 35px 40px;
    border-radius: 15px;
    margin-bottom: 35px;
    box-shadow: 0 6px 20px rgba(76, 175, 80, 0.3);
}

.keuangan-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
    margin-bottom: 35px;
}

.keuangan-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    border-top: 3px solid var(--yogya-green);
}

.keuangan-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(76, 175, 80, 0.15);
}

.keuangan-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, var(--yogya-green), var(--yogya-green-dark));
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    margin-bottom: 15px;
}

.keuangan-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
}

.keuangan-label {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 500;
}

@media (max-width: 768px) {
    .main-content {
        margin-left: 0 !important;
        width: 100% !important;
        padding: 20px !important;
    }
}
</style>

<!-- Keuangan Header -->
<div class="keuangan-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-chart-pie me-3"></i>Analisis Keuangan</h1>
            <p>Monitor pendapatan, transaksi, dan performa keuangan bisnis</p>
        </div>
        <div class="text-end">
            <small>{{ date('l, d F Y') }}</small>
        </div>
    </div>
</div>

<!-- Keuangan Statistics -->
<div class="keuangan-stats">
    <div class="keuangan-card">
        <div class="keuangan-icon">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="keuangan-number">Rp {{ number_format($pendapatanHariIni) }}</div>
        <div class="keuangan-label">Pendapatan Hari Ini</div>
    </div>

    <div class="keuangan-card">
        <div class="keuangan-icon">
            <i class="fas fa-calendar-month"></i>
        </div>
        <div class="keuangan-number">Rp {{ number_format($pendapatanBulanIni) }}</div>
        <div class="keuangan-label">Pendapatan Bulan Ini</div>
    </div>

    <div class="keuangan-card">
        <div class="keuangan-icon">
            <i class="fas fa-calendar-year"></i>
        </div>
        <div class="keuangan-number">Rp {{ number_format($pendapatanTahunIni) }}</div>
        <div class="keuangan-label">Pendapatan Tahun Ini</div>
    </div>

    <div class="keuangan-card">
        <div class="keuangan-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="keuangan-number">{{ number_format($transaksiHariIni) }}</div>
        <div class="keuangan-label">Transaksi Hari Ini</div>
    </div>
</div>

<!-- Chart and Tables -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5>Grafik Pendapatan (7 Hari Terakhir)</h5>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Transaksi Terbaru</h5>
            </div>
            <div class="card-body">
                @forelse($transaksiTerbaru as $transaksi)
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <div>
                        <div style="font-weight: 600;">{{ $transaksi->nama_pelanggan }}</div>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</small>
                    </div>
                    <span class="badge bg-success">Rp {{ number_format($transaksi->total_belanja) }}</span>
                </div>
                @empty
                <p class="text-muted">Belum ada transaksi</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Pendapatan',
                data: {!! json_encode($chartData) !!},
                borderColor: 'var(--yogya-green)',
                backgroundColor: 'rgba(76, 175, 80, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'var(--yogya-green)',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection
