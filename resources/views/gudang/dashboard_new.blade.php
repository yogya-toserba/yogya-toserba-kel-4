@extends('layouts.appGudang')

@section('title', 'Dashboard Rantai Pasok - MyYOGYA')

@section('content')
<style>
/* Modern Dashboard Styles - Same as Permintaan */
.dashboard-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 25px 30px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
}

.dashboard-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
}

.dashboard-header p {
    font-size: 1rem;
    opacity: 0.9;
    margin: 8px 0 0 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-left: 4px solid #f26b37;
    transition: transform 0.3s ease;
}

body.dark-mode .stat-card {
    background: #2a2d3f;
    border-left-color: #f26b37;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: #f26b37;
    margin-bottom: 5px;
}

.stat-label {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 500;
}

body.dark-mode .stat-label {
    color: #94a3b8;
}

.modern-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #f1f5f9;
    margin-bottom: 25px;
}

body.dark-mode .modern-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.card-header-modern {
    padding: 20px 25px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

body.dark-mode .card-header-modern {
    border-bottom-color: #3a3d4a;
}

.card-title-modern {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

body.dark-mode .card-title-modern {
    color: #e2e8f0;
}

/* Chart Container Styles */
.charts-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    margin-bottom: 25px;
}

@media (max-width: 768px) {
    .charts-container {
        grid-template-columns: 1fr;
    }
}

/* Activity Feed Styles - Fixed Dark Mode */
.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px;
    background: #f8fafc;
    border-radius: 10px;
    margin-bottom: 15px;
}

body.dark-mode .activity-item {
    background: #252837 !important;
}

.activity-icon {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 5px;
    font-size: 0.95rem;
}

body.dark-mode .activity-title {
    color: #e2e8f0 !important;
}

.activity-description {
    color: #64748b;
    font-size: 0.9rem;
    margin-bottom: 5px;
}

body.dark-mode .activity-description {
    color: #94a3b8 !important;
}

.activity-time {
    color: #94a3b8;
    font-size: 0.8rem;
}

body.dark-mode .activity-time {
    color: #64748b !important;
}

/* Activity Icon Colors */
.activity-icon.success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
}

.activity-icon.danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.activity-icon.warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .card-header-modern {
        padding: 15px 20px;
        flex-direction: column;
        gap: 10px;
    }
}
</style>

<div class="dashboard-container">
    <!-- Header Section -->
    <div class="dashboard-header">
        <h2>Dashboard Rantai Pasok</h2>
        <p>Kelola operasional gudang MyYOGYA dengan efisien dan terintegrasi</p>
    </div>

    <!-- Stats Section -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ ($totalStok ?? 0) }}</div>
            <div class="stat-label">Total Stok Barang</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ ($barangMasuk ?? 0) }}</div>
            <div class="stat-label">Barang Masuk (30d)</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ number_format($barangKeluar ?? 0) }}</div>
            <div class="stat-label">Barang Keluar</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ ($akurasi ?? 0) }}%</div>
            <div class="stat-label">Akurasi Pengiriman</div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-container">
        <div class="modern-card">
            <div class="card-header-modern">
                <h5 class="card-title-modern">
                    <i class="fas fa-chart-line" style="color: #f26b37; margin-right: 10px;"></i>
                    Tren Permintaan Bulanan
                </h5>
            </div>
            <div style="padding: 20px 25px;">
                <div class="chart-placeholder">
                    <canvas id="trenChart" style="width: 100%; height: 280px;"></canvas>
                </div>
            </div>
        </div>

        <div class="modern-card">
            <div class="card-header-modern">
                <h5 class="card-title-modern">
                    <i class="fas fa-chart-pie" style="color: #f26b37; margin-right: 10px;"></i>
                    Distribusi Stok per Kategori
                </h5>
            </div>
            <div style="padding: 20px 25px;">
                <div class="chart-placeholder">
                    <canvas id="kategoriChart" style="width: 100%; height: 280px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Feed -->
    <div class="modern-card">
        <div class="card-header-modern">
            <h5 class="card-title-modern">
                <i class="fas fa-history" style="color: #f26b37; margin-right: 10px;"></i>
                Aktivitas Terbaru
            </h5>
        </div>
        <div style="padding: 20px 25px;">
            <div class="activity-item">
                <div class="activity-icon success">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Barang Masuk</div>
                    <div class="activity-description">50 unit Smartphone Galaxy S24 diterima dari supplier</div>
                    <div class="activity-time">2 menit lalu</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon danger">
                    <i class="fas fa-minus"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Pengiriman</div>
                    <div class="activity-description">25 unit Laptop MacBook dikirim ke Cabang Jakarta</div>
                    <div class="activity-time">15 menit lalu</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Stok Rendah</div>
                    <div class="activity-description">Mouse Wireless Logitech tersisa 5 unit</div>
                    <div class="activity-time">1 jam lalu</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart Configuration
const primaryColor = '#f26b37';
const secondaryColor = '#e55827';
const accentColor = '#ffb366';

// Tren Chart
const trenCtx = document.getElementById('trenChart');
if (trenCtx) {
    new Chart(trenCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Permintaan',
                data: [150, 200, 180, 220, 250, 280],
                borderColor: primaryColor,
                backgroundColor: accentColor + '20',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#e2e8f0'
                    }
                },
                x: {
                    grid: {
                        color: '#e2e8f0'
                    }
                }
            }
        }
    });
}

// Kategori Chart
const kategoriCtx = document.getElementById('kategoriChart');
if (kategoriCtx) {
    // Data from server-side
    const kategoriData = @json($kategoriDistribusi ?? []);
    const labels = kategoriData.length ? kategoriData.map(i => i.kategori) : ['Elektronik', 'Fashion', 'Makanan', 'Peralatan', 'Lainnya'];
    const dataValues = kategoriData.length ? kategoriData.map(i => i.total) : [30,25,20,15,10];

    new Chart(kategoriCtx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: dataValues,
                backgroundColor: [
                    primaryColor,
                    secondaryColor,
                    accentColor,
                    '#94a3b8',
                    '#64748b'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
}
</script>
@endsection
