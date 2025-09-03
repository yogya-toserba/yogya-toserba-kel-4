@extends('layouts.navbar_admin')

@section('title', 'Analisis Barang - MyYOGYA Admin')

@section('content')
<style>
.barang-header {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    padding: 35px 40px;
    border-radius: 15px;
    margin-bottom: 35px;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.barang-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
    margin-bottom: 35px;
}

.barang-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.barang-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.barang-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    margin-bottom: 15px;
}

.barang-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
}

.barang-label {
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

<!-- Barang Header -->
<div class="barang-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-boxes me-3"></i>Analisis Barang</h1>
            <p>Kelola inventori, stok, dan performa produk</p>
        </div>
        <div class="text-end">
            <small>{{ date('l, d F Y') }}</small>
        </div>
    </div>
</div>

<!-- Barang Statistics -->
<div class="barang-stats">
    <div class="barang-card">
        <div class="barang-icon">
            <i class="fas fa-box"></i>
        </div>
        <div class="barang-number">{{ number_format($totalProduk) }}</div>
        <div class="barang-label">Total Produk</div>
    </div>

    <div class="barang-card">
        <div class="barang-icon">
            <i class="fas fa-warehouse"></i>
        </div>
        <div class="barang-number">{{ number_format($totalStok) }}</div>
        <div class="barang-label">Total Stok</div>
    </div>

    <div class="barang-card">
        <div class="barang-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="barang-number">{{ number_format($stokMenipis) }}</div>
        <div class="barang-label">Stok Menipis</div>
    </div>

    <div class="barang-card">
        <div class="barang-icon">
            <i class="fas fa-tag"></i>
        </div>
        <div class="barang-number">{{ $kategoriTerbanyak ?? 'N/A' }}</div>
        <div class="barang-label">Kategori Terbanyak</div>
    </div>
</div>

<!-- Stok Menipis Table -->
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-exclamation-triangle me-2"></i>Produk dengan Stok Menipis</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produkStokMenipis as $produk)
                    <tr>
                        <td>{{ $produk->nama_barang }}</td>
                        <td>{{ $produk->nama_kategori }}</td>
                        <td>
                            <span class="badge bg-{{ $produk->stok < 5 ? 'danger' : 'warning' }}">
                                {{ $produk->stok }}
                            </span>
                        </td>
                        <td>Rp {{ number_format($produk->harga_jual) }}</td>
                        <td>
                            @if($produk->stok < 5)
                                <span class="badge bg-danger">Kritis</span>
                            @else
                                <span class="badge bg-warning">Rendah</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Semua produk memiliki stok yang cukup</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
