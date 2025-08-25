@extends('layouts.appGudanng')

@section('title', 'Dashboard Rantai Pasok - MyYOGYA')

@section('content')
<div class="content">
    <h2 class="mb-4">📦 Inventori Gudang</h2>

    <!-- Ringkasan Stok -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white" style="background-color:#00A9F6;">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <h3>120</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white" style="background-color:#07BEFC;">
                <div class="card-body">
                    <h5 class="card-title">Stok Tersedia</h5>
                    <h3>95</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-dark" style="background-color:#87E8FF;">
                <div class="card-body">
                    <h5 class="card-title">Stok Menipis</h5>
                    <h3>15</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Stok Kosong</h5>
                    <h3>10</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Inventori -->
    <div class="card shadow">
        <div class="card-header text-white" style="background-color:#00A9F6;">
            Daftar Inventori
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
                <thead style="background-color:#87E8FF;">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Lokasi Gudang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Beras Premium</td>
                        <td>Sembako</td>
                        <td>50</td>
                        <td>Gudang A</td>
                        <td><span class="badge bg-success">Aman</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Minyak Goreng 1L</td>
                        <td>Sembako</td>
                        <td>5</td>
                        <td>Gudang B</td>
                        <td><span class="badge bg-warning text-dark">Menipis</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Gula Pasir</td>
                        <td>Sembako</td>
                        <td>0</td>
                        <td>Gudang A</td>
                        <td><span class="badge bg-danger">Kosong</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

