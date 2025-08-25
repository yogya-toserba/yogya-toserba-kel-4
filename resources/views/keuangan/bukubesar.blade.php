@extends('layouts.app')

@section('title', 'Buku Besar - MyYOGYA')
@section('page_title', 'Buku Besar')

@section('content')

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Buku Besar</h5>

        <!-- Filter Tanggal -->
        <div class="row mb-4">
            <div class="col-md-3">
                <label class="form-label">Dari Tanggal:</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Sampai Tanggal:</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary w-100">Filter</button>
            </div>
        </div>

        <!-- Tabel Buku Besar -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No Transaksi</th>
                        <th>Tanggal</th>
                        <th>Uang Bayar</th>
                        <th>Uang Kembali</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=1; $i<=10; $i++)
                        <tr>
                            <td>100{{ $i }}/120825</td>
                            <td>2025-08-12</td>
                            <td>Rp100.000</td>
                            <td>Rp5.000</td>
                            <td>Cash</td>
                            <td>
                                <span class="badge bg-success">Berhasil</span>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Ringkasan Saldo -->
        <div class="mt-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="p-3 bg-success text-white rounded">
                        <strong>Total Debit</strong>
                        <p class="mb-0">Rp100.000.000</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-danger text-white rounded">
                        <strong>Total Kredit</strong>
                        <p class="mb-0">Rp10.000.000</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-warning text-dark rounded">
                        <strong>Saldo Awal</strong>
                        <p class="mb-0">Rp0</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-primary text-white rounded">
                        <strong>Saldo Akhir</strong>
                        <p class="mb-0">Rp90.000.000</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
