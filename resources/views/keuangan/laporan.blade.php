@extends('layouts.app')

@section('title', 'Laporan Keuangan - MyYOGYA')
@section('page_title', 'Laporan Keuangan')

@section('content')

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Laporan Keuangan</h5>

        <!-- Filter Laporan -->
        <div class="row mb-4">
            <div class="col-md-3">
                <label class="form-label">Jenis Laporan:</label>
                <select class="form-select">
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
