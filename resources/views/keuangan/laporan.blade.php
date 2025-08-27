@extends('layouts.atmin')

@section('title', 'Laporan Keuangan - MyYOGYA')
@section('page_title', 'Laporan Keuangan')

@section('page_header')
<h1><i class="fas fa-chart-line me-3"></i>Laporan Keuangan</h1>
<p class="lead">Generate dan analisis laporan keuangan perusahaan</p>
@endsection

@section('content')

<div class="card-custom">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-file-alt me-2"></i>Generator Laporan Keuangan</h5>
    </div>
    <div class="card-body">

        <!-- Filter Laporan -->
        <div class="row mb-4" style="background: var(--light-bg); padding: 25px; border-radius: 12px; border: 1px solid var(--border-color);">
            <div class="col-md-3">
                <label class="form-label fw-bold">Jenis Laporan:</label>
                <select class="form-select" style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-weight: 500;">
                    <option value="">Pilih Laporan</option>
                    <option value="neraca">Neraca</option>
                    <option value="laba_rugi">Laporan Laba Rugi</option>
                    <option value="arus_kas">Laporan Arus Kas</option>
                    <option value="ekuitas">Perubahan Ekuitas</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Periode:</label>
                <input type="month" class="form-control">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary w-100">Tampilkan</button>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-success w-100">Export PDF</button>
            </div>
        </div>

        <!-- Tabel Laporan -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Keterangan</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Kas</td>
                        <td>Rp50.000.000</td>
                        <td>-</td>
                        <td>Rp50.000.000</td>
                    </tr>
                    <tr>
                        <td>Piutang Usaha</td>
                        <td>Rp20.000.000</td>
                        <td>-</td>
                        <td>Rp70.000.000</td>
                    </tr>
                    <tr>
                        <td>Pendapatan Penjualan</td>
                        <td>-</td>
                        <td>Rp80.000.000</td>
                        <td>-Rp10.000.000</td>
                    </tr>
                    <tr>
                        <td>Beban Operasional</td>
                        <td>Rp5.000.000</td>
                        <td>-</td>
                        <td>-Rp15.000.000</td>
                    </tr>
                </tbody>
                <tfoot class="table-secondary">
                    <tr>
                        <th>Total</th>
                        <th>Rp75.000.000</th>
                        <th>Rp80.000.000</th>
                        <th>Rp5.000.000</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>

@endsection
