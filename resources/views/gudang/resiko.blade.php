@extends('layouts.appGudanng')

@section('title', 'Analisis Risiko - MyYOGYA')

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
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
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

/* Table Section */
.table-section {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.2);
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f1f5f9;
}

.table-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

/* Modern Table */
.modern-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(0,0,0,0.05);
}

.modern-table thead {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
}

.modern-table th {
    padding: 18px 20px;
    text-align: left;
    font-weight: 600;
    color: white;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
}

.modern-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #f1f5f9;
    color: #374151;
    font-size: 0.95rem;
    vertical-align: middle;
}

.modern-table tbody tr {
    transition: all 0.2s ease;
}

.modern-table tbody tr:hover {
    background-color: #f8fafc;
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.modern-table tbody tr:last-child td {
    border-bottom: none;
}

/* Risk Level Badges */
.risk-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.risk-tinggi {
    background: #f87171 !important;
    color: #7f1d1d !important;
}

.risk-sedang {
    background: #fbbf24 !important;
    color: #92400e !important;
}

.risk-rendah {
    background: #34d399 !important;
    color: #064e3b !important;
}

/* Button Styles */
.btn {
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    cursor: pointer;
    font-size: 0.95rem;
}

.btn-primary {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    border: 2px solid #f26b37;
    font-weight: 600;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(242, 107, 55, 0.3);
    border-color: #e55827;
    color: white;
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

body.dark-mode .table-section {
    background: #252837;
    border-color: #3a3d4a;
}

body.dark-mode .table-title {
    color: #ffffff;
}

body.dark-mode .modern-table {
    background: #252837;
}

body.dark-mode .modern-table td {
    border-color: #3a3d4a;
    color: #ffffff;
    background-color: #1e2139;
}

body.dark-mode .modern-table tbody tr:hover {
    background-color: #2a2d47;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .table-header {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
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
            <i class="fas fa-shield-alt"></i>
            Analisis Risiko Rantai Pasok
        </h1>
        <p class="subtitle">Identifikasi dan mitigasi risiko operasional MyYOGYA</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-number">8</div>
            <div class="stat-label">Risiko Tinggi</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="stat-number">15</div>
            <div class="stat-label">Risiko Sedang</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number">23</div>
            <div class="stat-label">Risiko Rendah</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="stat-number">12</div>
            <div class="stat-label">Mitigasi Aktif</div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-section">
        <div class="table-header">
            <h2 class="table-title">Daftar Risiko</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahRisikoModal">
                <i class="fas fa-plus"></i>
                Tambah Risiko
            </button>
        </div>
        
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Risiko</th>
                        <th>Dampak</th>
                        <th>Probabilitas</th>
                        <th>Level</th>
                        <th>Rencana Mitigasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-semibold">1</td>
                        <td><span class="fw-bold">Keterlambatan Pengiriman</span></td>
                        <td>Menurunnya stok toko, kehilangan penjualan</td>
                        <td>75%</td>
                        <td><span class="risk-badge risk-tinggi">Tinggi</span></td>
                        <td>Menambah armada logistik, backup supplier</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">2</td>
                        <td><span class="fw-bold">Kualitas Barang Buruk</span></td>
                        <td>Keluhan pelanggan, retur produk</td>
                        <td>45%</td>
                        <td><span class="risk-badge risk-sedang">Sedang</span></td>
                        <td>Pemeriksaan QC ketat, audit supplier</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">3</td>
                        <td><span class="fw-bold">Kenaikan Harga Pemasok</span></td>
                        <td>Biaya operasional naik, margin turun</td>
                        <td>25%</td>
                        <td><span class="risk-badge risk-rendah">Rendah</span></td>
                        <td>Negosiasi kontrak jangka panjang</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">4</td>
                        <td><span class="fw-bold">Gangguan Sistem IT</span></td>
                        <td>Operasional terhenti, data loss</td>
                        <td>65%</td>
                        <td><span class="risk-badge risk-tinggi">Tinggi</span></td>
                        <td>Backup sistem, redundansi server</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">5</td>
                        <td><span class="fw-bold">Bencana Alam</span></td>
                        <td>Kerusakan gudang, gangguan distribusi</td>
                        <td>15%</td>
                        <td><span class="risk-badge risk-rendah">Rendah</span></td>
                        <td>Asuransi, lokasi gudang tersebar</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Risiko -->
<div class="modal fade" id="tambahRisikoModal" tabindex="-1" aria-labelledby="tambahRisikoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahRisikoModalLabel">Tambah Risiko Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis_risiko" class="form-label">Jenis Risiko</label>
                                <input type="text" class="form-control" id="jenis_risiko" placeholder="Masukkan jenis risiko">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="probabilitas" class="form-label">Probabilitas (%)</label>
                                <input type="number" class="form-control" id="probabilitas" placeholder="0-100" min="0" max="100">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dampak" class="form-label">Dampak</label>
                        <textarea class="form-control" id="dampak" rows="3" placeholder="Jelaskan dampak yang mungkin terjadi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="mitigasi" class="form-label">Rencana Mitigasi</label>
                        <textarea class="form-control" id="mitigasi" rows="3" placeholder="Jelaskan rencana mitigasi risiko"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="level_risiko" class="form-label">Level Risiko</label>
                        <select class="form-control" id="level_risiko">
                            <option value="">Pilih Level Risiko</option>
                            <option value="rendah">Rendah</option>
                            <option value="sedang">Sedang</option>
                            <option value="tinggi">Tinggi</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection