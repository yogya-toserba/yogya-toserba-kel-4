@extends('layouts.navbar_admin')

@section('title', 'Laporan Keuangan')
@section('page-title', 'Laporan Keuangan')

@section('content')
<!-- Quick Access to Financial Report -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-lg bg-gradient-primary text-white">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="card-title mb-2">
                            <i class="fas fa-chart-line me-2"></i>Laporan Keuangan Real-Time
                        </h3>
                        <p class="card-text mb-3 opacity-75">
                            Akses langsung ke laporan keuangan lengkap dengan data penjualan, pendapatan, pengeluaran, dan analisis laba rugi yang tersambung dengan database.
                        </p>
                        <a href="{{ route('admin.laporan.keuangan') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-external-link-alt me-2"></i>Buka Laporan Keuangan
                        </a>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-chart-pie fa-5x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Financial Overview Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-money-bill-wave fa-2x text-success"></i>
                </div>
                <h4 class="text-success mb-1">
                    Rp {{ number_format(\App\Models\Transaksi::whereMonth('tanggal_transaksi', now()->month)->sum('total_belanja'), 0, ',', '.') }}
                </h4>
                <small class="text-muted">Total Pendapatan Bulan Ini</small>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-wallet fa-2x text-danger"></i>
                </div>
                <h4 class="text-danger mb-1">
                    Rp {{ number_format(\App\Models\Gaji::whereMonth('created_at', now()->month)->sum('jumlah_gaji'), 0, ',', '.') }}
                </h4>
                <small class="text-muted">Total Pengeluaran Gaji</small>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-chart-line fa-2x text-primary"></i>
                </div>
                <h4 class="text-primary mb-1">
                    {{ \App\Models\Transaksi::whereDate('tanggal_transaksi', today())->count() }}
                </h4>
                <small class="text-muted">Transaksi Hari Ini</small>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-percentage fa-2x text-warning"></i>
                </div>
                @php
                    $pendapatan = \App\Models\Transaksi::whereMonth('tanggal_transaksi', now()->month)->sum('total_belanja');
                    $pengeluaran = \App\Models\Gaji::whereMonth('created_at', now()->month)->sum('jumlah_gaji');
                    $labaRugi = $pendapatan - $pengeluaran;
                @endphp
                <h4 class="mb-1 {{ $labaRugi >= 0 ? 'text-success' : 'text-danger' }}">
                    Rp {{ number_format($labaRugi, 0, ',', '.') }}
                </h4>
                <small class="text-muted">{{ $labaRugi >= 0 ? 'Laba' : 'Rugi' }} Bulan Ini</small>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions & Top Products -->
<div class="row g-4 mb-4">
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-receipt me-2"></i>Transaksi Terbaru
                </h5>
                <a href="{{ route('admin.laporan.keuangan') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>ID Transaksi</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Transaksi::latest()->take(5)->get() as $transaksi)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d/m/Y H:i') }}</td>
                                    <td>#{{ $transaksi->id_transaksi }}</td>
                                    <td class="text-success fw-bold">Rp {{ number_format($transaksi->total_belanja, 0, ',', '.') }}</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Tidak ada transaksi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="fas fa-star me-2"></i>Produk Terlaris
                </h6>
            </div>
            <div class="card-body">
                @php
                    $produkTerlaris = \App\Models\DetailTransaksi::join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
                        ->select('stok_produk.nama_barang', \DB::raw('SUM(detail_transaksi.jumlah_barang) as total_terjual'))
                        ->groupBy('stok_produk.nama_barang', 'stok_produk.id_produk')
                        ->orderByDesc('total_terjual')
                        ->take(5)
                        ->get();
                @endphp
                <div class="list-group list-group-flush">
                    @forelse($produkTerlaris as $index => $produk)
                        <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-primary rounded-pill me-2">{{ $index + 1 }}</span>
                                <small>{{ Str::limit($produk->nama_barang, 20) }}</small>
                            </div>
                            <span class="badge bg-light text-dark">{{ $produk->total_terjual }} unit</span>
                        </div>
                    @empty
                        <div class="text-center text-muted">
                            <i class="fas fa-box-open fa-2x mb-2"></i>
                            <p class="small">Belum ada data penjualan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
}

.card:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
}

.list-group-item:last-child {
    border-bottom: none !important;
}

.table td {
    vertical-align: middle;
}

.badge {
    font-size: 0.75em;
}

.fa-2x {
    opacity: 0.8;
}

.card-header {
    background: rgba(0,0,0,0.02);
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.btn:hover {
    transform: translateY(-1px);
    transition: all 0.2s ease;
}
</style>
@endsection
