@extends('layouts.navbar_admin')

@section('title', 'Manajemen Absensi - MyYOGYA')

@section('content')
<style>
/* GLOBAL OVERRIDE - FORCE EXACT DASHBOARD LAYOUT */
* {
    box-sizing: border-box !important;
}

/* RESET ALL CONFLICTS - EXACT MATCH WITH DASHBOARD */
.main-content {
    margin-left: 250px !important;
    padding: 25px 35px !important;
    background: #f8fafc !important;
    min-height: 100vh !important;
    width: calc(100% - 250px) !important;
    box-sizing: border-box !important;
    position: relative !important;
    overflow-x: hidden !important;
}

/* Ensure no parent container interferes */
@media (min-width: 769px) {
    .main-content {
        margin-left: 250px !important;
        width: calc(100% - 250px) !important;
    }
}

/* Remove any extra padding or margin that might conflict */
.main-content > * {
    max-width: 100% !important;
}

/* Dark Mode Support */
body.dark-mode .main-content {
    background: #1a1d29 !important;
}

/* FORCE NEW DASHBOARD STYLES */
.new-absensi {
    background: #f8fafc !important;
    min-height: 100vh !important;
    padding: 0 !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    overflow-x: hidden !important;
    width: 100% !important;
}

body.dark-mode .new-absensi {
    background: #1a1d29 !important;
}

.new-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
    color: white !important;
    padding: 35px 40px !important;
    border-radius: 15px !important;
    margin-bottom: 35px !important;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3) !important;
    position: relative !important;
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
    margin-bottom: 30px !important;
}

.new-stat-card {
    background: white !important;
    padding: 25px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    transition: all 0.3s ease !important;
    position: relative !important;
    overflow: hidden !important;
    text-align: center !important;
}

body.dark-mode .new-stat-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-stat-card:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

body.dark-mode .new-stat-card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.4) !important;
}

.new-stat-icon {
    width: 60px !important;
    height: 60px !important;
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
    border-radius: 15px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 20px !important;
    margin-bottom: 15px !important;
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3) !important;
    margin: 0 auto 15px auto !important;
    color: white !important;
}

.new-stat-number {
    font-size: 2.3rem !important;
    font-weight: bold !important;
    color: #1e293b !important;
    margin: 12px 0 8px 0 !important;
    line-height: 1.2 !important;
}

body.dark-mode .new-stat-number {
    color: #e2e8f0 !important;
}

.new-stat-label {
    color: #64748b !important;
    font-weight: 500 !important;
    font-size: 0.9rem !important;
    line-height: 1.3 !important;
}

body.dark-mode .new-stat-label {
    color: #94a3b8 !important;
}

.new-stat-change {
    font-size: 0.75rem !important;
    font-weight: 600 !important;
    margin-top: 8px !important;
    padding: 4px 8px !important;
    border-radius: 12px !important;
    display: inline-block !important;
    text-align: center !important;
}

.change-positive {
    background: #dcfce7 !important;
    color: #15803d !important;
}

.change-neutral {
    background: #e0f2fe !important;
    color: #0277bd !important;
}

.change-warning {
    background: #fef3c7 !important;
    color: #d97706 !important;
}

.change-danger {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

/* Cards */
.new-card {
    background: white !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
}

body.dark-mode .new-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-card:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.new-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
    padding: 20px 25px !important;
    border-bottom: 1px solid #e2e8f0 !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
}

body.dark-mode .new-card-header {
    background: linear-gradient(135deg, #1f2937 0%, #374151 100%) !important;
    border-bottom-color: #4b5563 !important;
}

.new-card-title {
    font-size: 1.25rem !important;
    font-weight: 600 !important;
    color: #1e293b !important;
    margin: 0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

body.dark-mode .new-card-title {
    color: #e2e8f0 !important;
}

.new-card-title i {
    color: #f26b37 !important;
}

.new-card-body {
    padding: 25px !important;
}

/* Search and Filter */
.search-filter-bar {
    background: white !important;
    padding: 25px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    margin-bottom: 30px !important;
    border: 1px solid #e2e8f0 !important;
}

body.dark-mode .search-filter-bar {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
}
</style>

<div class="new-absensi">
    <!-- Header Section -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1><i class="fas fa-clock me-3"></i>Manajemen Absensi</h1>
                <p>Kelola absensi karyawan MyYOGYA dengan mudah</p>
            </div>
            <div style="text-align: right;">
                <div id="realTimeClock" style="font-weight: 600; color: white; font-size: 1rem; margin-bottom: 5px;"></div>
                <small style="opacity: 0.8;">Senin, 1 September 2025</small>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="new-stat-number">245</div>
                <div class="new-stat-label">Hadir</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-check"></i> Hari Ini
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="new-stat-number">12</div>
                <div class="new-stat-label">Terlambat</div>
                <div class="new-stat-change change-warning">
                    <i class="fas fa-exclamation-triangle"></i> Peringatan
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-file-medical"></i>
                </div>
                <div class="new-stat-number">8</div>
                <div class="new-stat-label">Izin</div>
                <div class="new-stat-change change-neutral">
                    <i class="fas fa-info-circle"></i> Disetujui
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="new-stat-number">3</div>
                <div class="new-stat-label">Alpha</div>
                <div class="new-stat-change change-danger">
                    <i class="fas fa-times"></i> Tidak Hadir
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="search-filter-bar">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Cabang</label>
                <select class="form-control">
                    <option>Semua Cabang</option>
                    <option>Yogyakarta Pusat</option>
                    <option>Solo</option>
                    <option>Semarang</option>
                    <option>Magelang</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select class="form-control">
                    <option>Semua Status</option>
                    <option>Hadir</option>
                    <option>Terlambat</option>
                    <option>Izin</option>
                    <option>Alpha</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <button class="btn btn-primary w-100" style="background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border: none; padding: 8px;">
                    <i class="fas fa-search me-2"></i>Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Absensi Table -->
    <div class="new-card">
        <div class="new-card-header">
            <div class="new-card-title">
                <i class="fas fa-table"></i>
                Daftar Absensi Karyawan
            </div>
        </div>
        <div class="new-card-body">
            <div class="table-responsive">
                <table class="table table-sm table-fixed">
                    <thead style="background: white;">
                        <tr>
                            <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Karyawan</th>
                            <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Cabang</th>
                            <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Jam Masuk</th>
                            <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Jam Keluar</th>
                            <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Total Kerja</th>
                            <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Status</th>
                            <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Keterangan</th>
                            <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <div class="d-flex align-items-center">
                                    <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 10px;">AS</div>
                                    <div>
                                        <strong style="color: #1e293b;">Andi Setiawan</strong>
                                        <br><small style="color: #64748b;">ID: EMP001</small>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <strong style="color: #1e293b;">Yogyakarta Pusat</strong>
                                <br><small style="color: #64748b;">Kasir</small>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">08:00</span>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">17:00</span>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <strong style="color: #15803d;">9 jam</strong>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Hadir</span>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <small style="color: #64748b;">Tepat waktu</small>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px; text-align: center;">
                                <button class="btn btn-sm" style="background: none; border: none; color: #64748b; padding: 4px;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <div class="d-flex align-items-center">
                                    <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 10px;">SW</div>
                                    <div>
                                        <strong style="color: #1e293b;">Sari Wulandari</strong>
                                        <br><small style="color: #64748b;">ID: EMP002</small>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <strong style="color: #1e293b;">Solo</strong>
                                <br><small style="color: #64748b;">Admin</small>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">08:15</span>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">17:05</span>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <strong style="color: #15803d;">8.8 jam</strong>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Terlambat</span>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px;">
                                <small style="color: #64748b;">Terlambat 15 menit</small>
                            </td>
                            <td style="font-size: 0.85rem; padding: 12px 8px; text-align: center;">
                                <button class="btn btn-sm" style="background: none; border: none; color: #64748b; padding: 4px;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Real time clock
function updateClock() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('id-ID', {
        hour12: false,
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    const clockElement = document.getElementById('realTimeClock');
    if (clockElement) {
        clockElement.textContent = timeString + ' WIB';
    }
}

// Update clock every second
setInterval(updateClock, 1000);
updateClock(); // Initial call
</script>

@endsection
