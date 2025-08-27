@extends('layouts.atmin')

@section('title', 'Riwayat Transaksi - MyYOGYA')
@section('page_title', 'Riwayat Transaksi')

@section('page_header')
<h1><i class="fas fa-history me-3"></i>Riwayat Transaksi</h1>
<p class="lead">Lacak dan kelola semua transaksi yang telah terjadi</p>
@endsection

@section('content')

<div class="card-custom">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-search me-2"></i>Filter & Pencarian Transaksi</h5>
    </div>
    <div class="card-body">

        <!-- Filter Pencarian -->
        <div class="row mb-4" style="background: var(--light-bg); padding: 20px; border-radius: 12px;">
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
                <select class="form-control">
                    <option value="">Semua Status</option>
                    <option value="berhasil">Berhasil</option>
                    <option value="pending">Pending</option>
                    <option value="gagal">Gagal</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn w-100" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white; font-weight: 600;">
                    <i class="fas fa-filter me-2"></i>Filter Data
                </button>
            </div>
        </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Metode Pembayaran:</label>
                <select class="form-select">
                    <option value="">Semua</option>
                    <option value="Cash">Cash</option>
                    <option value="Transfer">Transfer</option>
                    <option value="QRIS">QRIS</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary w-100">Filter</button>
            </div>
        </div>

        <!-- Tabel Riwayat Transaksi -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No Transaksi</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Jumlah</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=1; $i<=10; $i++)
                        <tr>
                            <td>TRX-2025-0{{ $i }}</td>
                            <td>2025-08-14</td>
                            <td>Pelanggan {{ $i }}</td>
                            <td>Rp{{ number_format(150000 + ($i * 10000), 0, ',', '.') }}</td>
                            <td>{{ $i % 2 == 0 ? 'Cash' : 'QRIS' }}</td>
                            <td>
                                @if($i % 2 == 0)
                                    <span class="badge bg-success">Berhasil</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">Detail</a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav class="mt-3">
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link">Sebelumnya</a>
                </li>
                <li class="page-item active">
                    <a class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link">Berikutnya</a>
                </li>
            </ul>
        </nav>

    </div>
</div>

@endsection
