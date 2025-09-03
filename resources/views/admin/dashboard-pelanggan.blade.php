@extends('layouts.navbar_admin')

@section('title', 'Analisis Pelanggan - MyYOGYA Admin')

@section('content')
<style>
.pelanggan-header {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    padding: 35px 40px;
    border-radius: 15px;
    margin-bottom: 35px;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}

.pelanggan-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
    margin-bottom: 35px;
}

.pelanggan-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.pelanggan-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.pelanggan-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    margin-bottom: 15px;
}

.pelanggan-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
}

.pelanggan-label {
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

<!-- Pelanggan Header -->
<div class="pelanggan-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-users me-3"></i>Analisis Pelanggan</h1>
            <p>Monitor dan analisis data pelanggan secara mendalam</p>
        </div>
        <div class="text-end">
            <small>{{ date('l, d F Y') }}</small>
        </div>
    </div>
</div>

<!-- Pelanggan Statistics -->
<div class="pelanggan-stats">
    <div class="pelanggan-card">
        <div class="pelanggan-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="pelanggan-number">{{ number_format($totalPelanggan) }}</div>
        <div class="pelanggan-label">Total Pelanggan</div>
    </div>

    <div class="pelanggan-card">
        <div class="pelanggan-icon">
            <i class="fas fa-user-plus"></i>
        </div>
        <div class="pelanggan-number">{{ number_format($pelangganBulanIni) }}</div>
        <div class="pelanggan-label">Pelanggan Baru Bulan Ini</div>
    </div>

    <div class="pelanggan-card">
        <div class="pelanggan-icon">
            <i class="fas fa-user-check"></i>
        </div>
        <div class="pelanggan-number">{{ number_format($pelangganAktif) }}</div>
        <div class="pelanggan-label">Pelanggan Aktif</div>
    </div>
</div>

<!-- Pelanggan Table -->
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-list me-2"></i>Pelanggan Terbaru</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelangganTerbaru as $pelanggan)
                    <tr>
                        <td>#{{ $pelanggan->id_pelanggan }}</td>
                        <td>{{ $pelanggan->nama_pelanggan }}</td>
                        <td>{{ $pelanggan->email }}</td>
                        <td>{{ $pelanggan->no_telp ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($pelanggan->created_at)->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data pelanggan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
