@extends('layouts.appGudang')

@section('title', 'Dashboard Rantai Pasok - MyYOGYA')

@section('content')
<div class="content">
    <h2>🚚 Data Logistik</h2>

    <div class="card shadow mt-3">
        <div class="card-header text-white" style="background-color:#00A9F6;">Daftar Pengiriman</div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead style="background-color:#87E8FF;">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                        <th>Jumlah Barang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>2025-08-10</td><td>Toko A</td><td>120</td><td><span class="badge bg-success">Dikirim</span></td></tr>
                    <tr><td>2</td><td>2025-08-12</td><td>Toko B</td><td>80</td><td><span class="badge bg-warning text-dark">Dalam Proses</span></td></tr>
                    <tr><td>3</td><td>2025-08-13</td><td>Toko C</td><td>0</td><td><span class="badge bg-danger">Tertunda</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection