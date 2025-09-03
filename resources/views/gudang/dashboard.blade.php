@extends('layouts.appGudang')

@section('title', 'Dashboard Rantai Pasok - MyYOGYA')

@section('content')
<style>
/* RESET ALL CONFLICTS */
.main-content {
    margin-left: 280px !important;
    padding: 20px 25px !important;
    background: #f8fafc !important;
}

/* Dark Mode Support */
body.dark-mode .main-content {
    background: #1a1d29 !important;
}

/* FORCE NEW DASHBOARD STYLES */
.new-dashboard {
    background: #f8fafc !important;
    min-height: 100vh !important;
    padding: 20px !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
}

body.dark-mode .new-dashboard {
    background: #1a1d29 !important;
}

.new-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
    color: white !important;
    padding: 30px !important;
    border-radius: 15px !important;
    margin-bottom: 30px !important;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3) !important;
}

.new-header h1 {
    font-size: 2.5rem !important;
    font-weight: bold !important;
    margin: 0 !important;
    color: white !important;
}

.new-header p {
    font-size: 1.1rem !important;
    opacity: 0.9 !important;
    margin: 10px 0 0 0 !important;
    color: white !important;
}

.new-stats {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
    gap: 20px !important;
    margin-bottom: 30px !important;
}

.new-stat-card {
    background: white !important;
    padding: 25px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    position: relative !important;
    transition: transform 0.3s ease !important;
}

body.dark-mode .new-stat-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-stat-card:hover {
    transform: translateY(-5px) !important;
}

.new-stat-card::before {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    height: 4px !important;
    background: linear-gradient(90deg, #f26b37, #e55827) !important;
    border-radius: 15px 15px 0 0 !important;
}

.new-stat-number {
    font-size: 2.5rem !important;
    font-weight: bold !important;
    color: #1e293b !important;
    margin: 15px 0 5px 0 !important;
}

body.dark-mode .new-stat-number {
    color: #e2e8f0 !important;
}

.new-stat-label {
    color: #64748b !important;
    font-weight: 500 !important;
    font-size: 1rem !important;
}

body.dark-mode .new-stat-label {
    color: #94a3b8 !important;
}

.new-stat-icon {
    width: 50px !important;
    height: 50px !important;
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border-radius: 12px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
    font-size: 1.3rem !important;
    float: right !important;
}

.new-charts {
    display: grid !important;
    grid-template-columns: 2fr 1fr !important;
    gap: 30px !important;
}

.new-card {
    background: white !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden !important;
}

body.dark-mode .new-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-card-header {
    padding: 20px 25px !important;
    background: #f8fafc !important;
    border-bottom: 1px solid #e2e8f0 !important;
}

body.dark-mode .new-card-header {
    background: #252837 !important;
    border-bottom-color: #3a3d4a !important;
}

.new-card-title {
    font-size: 1.2rem !important;
    font-weight: bold !important;
    color: #1e293b !important;
    margin: 0 !important;
}

body.dark-mode .new-card-title {
    color: #e2e8f0 !important;
}

.new-card-body {
    padding: 25px !important;
}

body.dark-mode .new-card-body {
    color: #e2e8f0 !important;
}

.chart-placeholder {
    height: 300px !important;
    background: #f8fafc !important;
    border-radius: 10px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: #64748b !important;
    font-size: 1.1rem !important;
    border: 2px dashed #e2e8f0 !important;
}

body.dark-mode .chart-placeholder {
    background: #1a1d29 !important;
    color: #94a3b8 !important;
    border-color: #3a3d4a !important;
}

@media (max-width: 1200px) {
    .main-content {
        margin-left: 0 !important;
    }
    
    .new-charts {
        grid-template-columns: 1fr !important;
    }
}

/* Quick Actions Dark Mode Support */
.quick-action-btn {
    background: #f8fafc !important;
    padding: 20px !important;
    border-radius: 12px !important;
    text-align: center !important;
    text-decoration: none !important;
    color: #1e293b !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    display: block !important;
}

body.dark-mode .quick-action-btn {
    background: #252837 !important;
    color: #e2e8f0 !important;
}

.quick-action-btn:hover {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    color: white !important;
}

.quick-action-icon {
    width: 40px !important;
    height: 40px !important;
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border-radius: 8px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
    margin: 0 auto 10px !important;
}

.quick-actions-grid {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 15px !important;
}

@media (max-width: 768px) {
    .new-stats {
        grid-template-columns: 1fr !important;
    }
    
    .new-header h1 {
        font-size: 2rem !important;
    }
}
</style>

<div class="new-dashboard">
    <!-- Header -->
    <div class="new-header">
        <h1>Dashboard Rantai Pasok</h1>
        <p>Kelola operasional gudang MyYOGYA dengan efisien dan terintegrasi</p>
    </div>

    <!-- Stats -->
    <div class="new-stats">
        <div class="new-stat-card">
            <div class="new-stat-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <div class="new-stat-number">{{ number_format($totalStok ?? 0) }}</div>
            <div class="new-stat-label">Total Stok Barang</div>
        </div>

        <div class="new-stat-card">
            <div class="new-stat-icon">
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="new-stat-number">{{ number_format($barangMasuk ?? 0) }}</div>
            <div class="new-stat-label">Barang Masuk (30d)</div>
        </div>

        <div class="new-stat-card">
            <div class="new-stat-icon">
                <i class="fas fa-arrow-up"></i>
            </div>
            <div class="new-stat-number">{{ number_format($barangKeluar ?? 0) }}</div>
            <div class="new-stat-label">Barang Keluar</div>
        </div>

        <div class="new-stat-card">
            <div class="new-stat-icon">
                <i class="fas fa-target"></i>
            </div>
            <div class="new-stat-number">{{ ($akurasi ?? 0) }}%</div>
            <div class="new-stat-label">Akurasi Pengiriman</div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="new-charts">
        <!-- Left Column - Charts -->
        <div>
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-chart-line" style="color: #f26b37; margin-right: 10px;"></i>
                        Tren Permintaan Bulanan
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="chart-placeholder">
                        <canvas id="trenChart" style="width: 100%; height: 280px;"></canvas>
                    </div>
                </div>
            </div>

            <div class="new-card" style="margin-top: 20px;">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-chart-pie" style="color: #f26b37; margin-right: 10px;"></i>
                        Distribusi Stok per Kategori
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="chart-placeholder">
                        <canvas id="kategoriChart" style="width: 100%; height: 280px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Quick Actions & Activity -->
        <div>
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-bolt" style="color: #f26b37; margin-right: 10px;"></i>
                        Quick Actions
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="quick-actions-grid">
                        <a href="#" class="quick-action-btn">
                            <div class="quick-action-icon">
                                <i class="fas fa-plus"></i>
                            </div>
                            Tambah Stok
                        </a>
                        
                        <a href="#" class="quick-action-btn">
                            <div class="quick-action-icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            Proses Kirim
                        </a>
                        
                        <a href="#" class="quick-action-btn">
                            <div class="quick-action-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            Cari Barang
                        </a>
                        
                        <a href="#" class="quick-action-btn">
                            <div class="quick-action-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            Audit Stok
                        </a>
                    </div>
                </div>
            </div>

            <div class="new-card" style="margin-top: 20px;">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-history" style="color: #f26b37; margin-right: 10px;"></i>
                        Aktivitas Terbaru
                    </div>
                </div>
                <div class="new-card-body">
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        <div style="display: flex; align-items: flex-start; gap: 15px; padding: 15px; background: #f8fafc; border-radius: 10px;">
                            <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg, #22c55e, #16a34a); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.9rem;">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #1e293b; margin-bottom: 5px; font-size: 0.95rem;">Barang Masuk</div>
                                <div style="color: #64748b; font-size: 0.9rem; margin-bottom: 5px;">50 unit Smartphone Galaxy S24 diterima dari supplier</div>
                                <div style="color: #94a3b8; font-size: 0.8rem;">2 menit lalu</div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: flex-start; gap: 15px; padding: 15px; background: #f8fafc; border-radius: 10px;">
                            <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg, #ef4444, #dc2626); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.9rem;">
                                <i class="fas fa-minus"></i>
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #1e293b; margin-bottom: 5px; font-size: 0.95rem;">Pengiriman</div>
                                <div style="color: #64748b; font-size: 0.9rem; margin-bottom: 5px;">25 unit Laptop MacBook dikirim ke Cabang Jakarta</div>
                                <div style="color: #94a3b8; font-size: 0.8rem;">15 menit lalu</div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: flex-start; gap: 15px; padding: 15px; background: #f8fafc; border-radius: 10px;">
                            <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.9rem;">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #1e293b; margin-bottom: 5px; font-size: 0.95rem;">Stok Rendah</div>
                                <div style="color: #64748b; font-size: 0.9rem; margin-bottom: 5px;">Mouse Wireless Logitech tersisa 5 unit</div>
                                <div style="color: #94a3b8; font-size: 0.8rem;">1 jam lalu</div>
                            </div>
                        </div>
                    </div>
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
