@extends('layouts.appGudanng')

@section('title', 'Dashboard Rantai Pasok - MyYOGYA')

@section('content')
<style>
/* Modern Layout */
body {
    background: #ffffff;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 30px;
    border-radius: 20px;
    margin-bottom: 30px;
    box-shadow: 0 8px 32px rgba(242, 107, 55, 0.3);
}

.page-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 15px;
}

.page-header .subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-top: 8px;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 -8px 32px rgba(0,0,0,0.08);
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 48px rgba(0,0,0,0.12);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    margin-bottom: 15px;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin: 10px 0 5px 0;
}

.stat-label {
    color: #64748b;
    font-size: 0.95rem;
    font-weight: 500;
}

/* Cards Grid */
.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.dashboard-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 -8px 32px rgba(0,0,0,0.08);
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.3s ease;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 48px rgba(0,0,0,0.12);
}

.card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.card-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.card-content {
    color: #64748b;
    font-size: 0.95rem;
    line-height: 1.6;
}

/* Dark Mode Support */
body.dark-mode {
    background: #0f172a;
    color: #e2e8f0;
}

body.dark-mode .page-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
}

body.dark-mode .stat-card {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

body.dark-mode .stat-number {
    color: #ffffff;
}

body.dark-mode .stat-label {
    color: #94a3b8;
}

body.dark-mode .dashboard-card {
    background: #252837;
    border-color: #3a3d4a;
}

body.dark-mode .card-title {
    color: #ffffff;
}

body.dark-mode .card-content {
    color: #94a3b8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .cards-grid {
        grid-template-columns: 1fr;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
}
</style>

<div class="content">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="fas fa-tachometer-alt"></i>
            Dashboard Rantai Pasok
        </h1>
        <p class="subtitle">Kelola operasional gudang MyYOGYA dengan efisien dan terintegrasi</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                <i class="fas fa-boxes"></i>
            </div>
            <div class="stat-number">23,456</div>
            <div class="stat-label">Total Stok Barang</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                <i class="fas fa-truck"></i>
            </div>
            <div class="stat-number">342</div>
            <div class="stat-label">Pengiriman Hari Ini</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="stat-number">18</div>
            <div class="stat-label">Permintaan Pending</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-number">5</div>
            <div class="stat-label">Alert Stok Rendah</div>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="cards-grid">
        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-icon" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="card-title">Analisis Performa</h3>
            </div>
            <div class="card-content">
                Pantau kinerja operasional gudang secara real-time dengan metrics yang akurat dan laporan detail.
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-icon" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <h3 class="card-title">Otomasi Proses</h3>
            </div>
            <div class="card-content">
                Sistem otomatis untuk reorder, alert stok minimum, dan koordinasi antar cabang yang efisien.
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="card-title">Manajemen Risiko</h3>
            </div>
            <div class="card-content">
                Identifikasi dan mitigasi risiko operasional dengan sistem peringatan dini yang terintegrasi.
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-icon" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                    <i class="fas fa-network-wired"></i>
                </div>
                <h3 class="card-title">Integrasi Sistem</h3>
            </div>
            <div class="card-content">
                Koneksi seamless dengan semua cabang dan sistem POS untuk sinkronisasi data real-time.
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                    <i class="fas fa-bell"></i>
                </div>
                <h3 class="card-title">Notifikasi Cerdas</h3>
            </div>
            <div class="card-content">
                Dapatkan alert penting seperti stok rendah, pengiriman terlambat, dan update status real-time.
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <div class="card-icon" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="card-title">Kolaborasi Tim</h3>
            </div>
            <div class="card-content">
                Platform kolaborasi untuk tim gudang, logistik, dan manajemen dengan role-based access.
            </div>
        </div>
    </div>
</div>
@endsection
