@extends('layouts.admin')

@section('title', 'Buku Besar - MyYOGYA')
@section('page_title', 'Buku Besar')

@section('page_header')
<h1><i class="fas fa-book me-3"></i>Buku Besar</h1>
<p class="lead">Kelola dan pantau seluruh transaksi keuangan perusahaan</p>
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
    
    .summary-card {
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        color: white;
        font-weight: 600;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    
    .summary-card h6 {
        font-size: 0.9rem;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.9;
    }
    
    .summary-card .amount {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
    }
    
    .bg-success-gradient {
        background: linear-gradient(135deg, #28a745, #20c997);
    }
    
    .bg-danger-gradient {
        background: linear-gradient(135deg, #dc3545, #e74c3c);
    }
    
    .bg-warning-gradient {
        background: linear-gradient(135deg, #ffc107, #ff8c00);
        color: #212529 !important;
    }
    
    .bg-primary-gradient {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    
    .badge-success-custom {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
</style>
@endpush

@section('content')
<div class="card-custom">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-filter me-2"></i>Filter Data Transaksi</h5>
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
                    <label class="form-label fw-bold">Metode Pembayaran:</label>
                    <select class="form-select">
                        <option value="">Semua Metode</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="ewallet">E-Wallet</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-filter w-100">
                        <i class="fas fa-search me-2"></i>Filter Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabel Buku Besar -->
        <div class="table-responsive">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-2"></i>No Transaksi</th>
                        <th><i class="fas fa-calendar me-2"></i>Tanggal</th>
                        <th><i class="fas fa-money-bill-wave me-2"></i>Uang Bayar</th>
                        <th><i class="fas fa-hand-holding-usd me-2"></i>Uang Kembali</th>
                        <th><i class="fas fa-credit-card me-2"></i>Metode Pembayaran</th>
                        <th><i class="fas fa-check-circle me-2"></i>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=1; $i<=10; $i++)
                        <tr>
                            <td><strong>100{{ $i }}/120825</strong></td>
                            <td>{{ date('d M Y', strtotime('2025-08-'.rand(10,25))) }}</td>
                            <td><strong class="text-success">Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}</strong></td>
                            <td><strong class="text-warning">Rp {{ number_format(rand(0, 50000), 0, ',', '.') }}</strong></td>
                            <td>
                                @php 
                                    $methods = ['Cash', 'Transfer Bank', 'E-Wallet', 'Kartu Kredit'];
                                    $method = $methods[array_rand($methods)];
                                @endphp
                                <span class="badge bg-secondary">{{ $method }}</span>
                            </td>
                            <td>
                                <span class="badge-success-custom">
                                    <i class="fas fa-check me-1"></i>Berhasil
                                </span>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="card-custom">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-chart-line me-2"></i>Ringkasan Keuangan</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="summary-card bg-success-gradient">
                    <h6><i class="fas fa-arrow-up me-2"></i>Total Debit</h6>
                    <p class="amount">Rp 100.000.000</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-card bg-danger-gradient">
                    <h6><i class="fas fa-arrow-down me-2"></i>Total Kredit</h6>
                    <p class="amount">Rp 10.000.000</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-card bg-warning-gradient">
                    <h6><i class="fas fa-wallet me-2"></i>Saldo Awal</h6>
                    <p class="amount">Rp 0</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-card bg-primary-gradient">
                    <h6><i class="fas fa-coins me-2"></i>Saldo Akhir</h6>
                    <p class="amount">Rp 90.000.000</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
