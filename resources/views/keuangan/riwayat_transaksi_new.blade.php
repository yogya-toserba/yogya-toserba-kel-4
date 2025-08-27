@extends('layouts.atmin')

@section('title', 'Riwayat Transaksi - MyYOGYA')
@section('page_title', 'Riwayat Transaksi')

@section('page_header')
<h1><i class="fas fa-history me-3"></i>Riwayat Transaksi</h1>
<p class="lead">Lacak dan kelola semua transaksi yang telah terjadi</p>
@endsection

@push('styles')
<style>
    .filter-section {
        background: var(--light-bg);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid var(--border-color);
    }
    
    .filter-section .form-control, .filter-section .form-select {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 12px 15px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .filter-section .form-control:focus, .filter-section .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(242, 107, 55, 0.25);
    }
    
    .btn-filter {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(242, 107, 55, 0.4);
        color: white;
    }
    
    .table-custom {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .table-custom thead th {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
        padding: 18px 15px;
        border: none;
    }
    
    .table-custom tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
        font-weight: 500;
    }
    
    .table-custom tbody tr:hover {
        background-color: rgba(242, 107, 55, 0.05);
        transition: all 0.3s ease;
    }
    
    .badge-custom {
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    
    .badge-success-custom {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
    }
    
    .badge-warning-custom {
        background: linear-gradient(135deg, #ffc107, #ff8c00);
        color: #212529;
    }
    
    .badge-danger-custom {
        background: linear-gradient(135deg, #dc3545, #e74c3c);
        color: white;
    }
    
    .btn-detail {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 0.8rem;
    }
    
    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(23, 162, 184, 0.4);
        color: white;
    }
</style>
@endpush

@section('content')
<div class="card-custom">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-search me-2"></i>Filter & Pencarian Transaksi</h5>
    </div>
    <div class="card-body">
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label fw-bold">Dari Tanggal:</label>
                    <input type="date" class="form-control" value="{{ date('Y-m-01') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Sampai Tanggal:</label>
                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Status:</label>
                    <select class="form-select">
                        <option value="">Semua Status</option>
                        <option value="berhasil">Berhasil</option>
                        <option value="pending">Pending</option>
                        <option value="gagal">Gagal</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-filter w-100">
                        <i class="fas fa-filter me-2"></i>Filter Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabel Riwayat Transaksi -->
        <div class="table-responsive">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-2"></i>No Transaksi</th>
                        <th><i class="fas fa-calendar me-2"></i>Tanggal</th>
                        <th><i class="fas fa-user me-2"></i>Nama Pelanggan</th>
                        <th><i class="fas fa-money-bill-wave me-2"></i>Jumlah</th>
                        <th><i class="fas fa-credit-card me-2"></i>Metode Pembayaran</th>
                        <th><i class="fas fa-check-circle me-2"></i>Status</th>
                        <th><i class="fas fa-cog me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=1; $i<=12; $i++)
                        <tr>
                            <td><strong>TRX-2025-0{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}</strong></td>
                            <td>{{ date('d M Y', strtotime('2025-08-'.rand(10,25))) }}</td>
                            <td>Pelanggan {{ $i }}</td>
                            <td><strong class="text-success">Rp{{ number_format(150000 + ($i * 10000), 0, ',', '.') }}</strong></td>
                            <td>
                                @php 
                                    $methods = ['Cash', 'Transfer Bank', 'QRIS', 'E-Wallet'];
                                    $method = $methods[array_rand($methods)];
                                @endphp
                                <span class="badge bg-secondary">{{ $method }}</span>
                            </td>
                            <td>
                                @if($i % 3 == 0)
                                    <span class="badge-success-custom badge-custom">
                                        <i class="fas fa-check me-1"></i>Berhasil
                                    </span>
                                @elseif($i % 3 == 1)
                                    <span class="badge-warning-custom badge-custom">
                                        <i class="fas fa-clock me-1"></i>Pending
                                    </span>
                                @else
                                    <span class="badge-danger-custom badge-custom">
                                        <i class="fas fa-times me-1"></i>Gagal
                                    </span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-detail">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </button>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                        <i class="fas fa-chevron-left me-1"></i>Previous
                    </a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        Next<i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="kpi-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="text-success">156</h5>
                    <p>Transaksi Berhasil</p>
                    <small>Bulan ini</small>
                </div>
                <div class="kpi-icon">
                    <i class="fas fa-check-circle fa-2x" style="color: #28a745; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="text-warning">23</h5>
                    <p>Transaksi Pending</p>
                    <small>Menunggu konfirmasi</small>
                </div>
                <div class="kpi-icon">
                    <i class="fas fa-clock fa-2x" style="color: #ffc107; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="text-danger">8</h5>
                    <p>Transaksi Gagal</p>
                    <small>Perlu tindakan</small>
                </div>
                <div class="kpi-icon">
                    <i class="fas fa-times-circle fa-2x" style="color: #dc3545; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="kpi-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 style="color: var(--primary-color);">Rp 45.2M</h5>
                    <p>Total Transaksi</p>
                    <small>Bulan ini</small>
                </div>
                <div class="kpi-icon">
                    <i class="fas fa-money-bill-wave fa-2x" style="color: var(--primary-color); opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
