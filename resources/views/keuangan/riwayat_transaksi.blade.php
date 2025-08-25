@extends('layouts.app')

@section('title', 'Riwayat Transaksi - MyYOGYA')
@section('page_title', 'Riwayat Transaksi')

@section('content')

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Riwayat Transaksi</h5>

        <!-- Filter Pencarian -->
        <div class="row mb-4">
            <div class="col-md-3">
                <label class="form-label">Dari Tanggal:</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Sampai Tanggal:</label>
                <input type="date" class="form-control">
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
