@extends('layouts.navbar_admin')

@section('title', 'Dashboard Pelanggan - MyYOGYA')

@section('page-title', 'Dashboard Pelanggan')

@section('content')
<style>
/* Yogya Brand Colors */
:root {
    --yogya-orange: #FF6B35;
    --yogya-orange-dark: #E55A2B;
    --yogya-orange-light: #FF8A5C;
}

.pelanggan-header {
    background: linear-gradient(135deg, var(--yogya-orange) 0%, var(--yogya-orange-dark) 100%);
    color: white;
    padding: 35px 40px;
    border-radius: 15px;
    margin-bottom: 35px;
    box-shadow: 0 6px 20px rgba(255, 107, 53, 0.3);
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
    border-top: 3px solid var(--yogya-orange);
}

.pelanggan-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.15);
}

.pelanggan-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, var(--yogya-orange), var(--yogya-orange-dark));
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

<!-- Dashboard Content in Two Columns -->
<div class="row">
    <div class="col-lg-8">
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
                                <td>{{ $pelanggan->nomer_telepon ?? '-' }}</td>
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
    </div>
    
    <div class="col-lg-4">
        <!-- Produk Terlaris -->
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-fire me-2"></i>Produk Terlaris</h5>
                <small class="text-muted">Berdasarkan total penjualan</small>
            </div>
            <div class="card-body">
                @forelse($produkTerlaris as $index => $produk)
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <span class="badge 
                            @if($index == 0) bg-warning
                            @elseif($index == 1) bg-secondary  
                            @elseif($index == 2) badge-bronze
                            @else bg-light text-dark
                            @endif
                            me-2">
                            {{ $index + 1 }}
                        </span>
                        <div>
                            <div class="fw-semibold">{{ $produk->nama_barang }}</div>
                            <small class="text-muted">{{ $produk->nama_kategori }}</small>
                            <div class="small text-success">
                                {{ number_format($produk->total_terjual) }} terjual
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold text-primary">Rp {{ number_format($produk->harga_jual) }}</div>
                        <small class="text-muted">{{ $produk->jumlah_transaksi }} transaksi</small>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-3">
                    <i class="fas fa-box-open fa-2x mb-2"></i>
                    <p>Belum ada data penjualan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
.badge-bronze {
    background-color: #CD7F32;
    color: white;
}
</style>
@endsection
