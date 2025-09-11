@extends('layouts.appGudang')

@section('title', 'Dashboard Rantai Pasok - MyYOGYA')

@section('content')
<div class="content">
    <h2>⚠️ Analisis Risiko Rantai Pasok</h2>

    <div class="card shadow mt-3">
        <div class="card-header text-white" style="background-color:#00A9F6;">Daftar Risiko</div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead style="background-color:#87E8FF;">
                    <tr>
                        <th>No</th>
                        <th>Jenis Risiko</th>
                        <th>Dampak</th>
                        <th>Probabilitas</th>
                        <th>Rencana Mitigasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>Keterlambatan Pengiriman</td><td>Menurunnya stok toko</td><td>Tinggi</td><td>Menambah armada logistik</td></tr>
                    <tr><td>2</td><td>Kualitas Barang Buruk</td><td>Keluhan pelanggan</td><td>Sedang</td><td>Pemeriksaan QC ketat</td></tr>
                    <tr><td>3</td><td>Kenaikan Harga Pemasok</td><td>Biaya operasional naik</td><td>Rendah</td><td>Negosiasi kontrak jangka panjang</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection