@extends('layouts.appGudanng')

@section('title', 'Dashboard Rantai Pasok - MyYOGYA')

@section('content')
<div class="content">
    <h2>🏭 Data Pemasok</h2>

    <!-- Tombol Tambah -->
    <button class="btn text-white mt-2" style="background-color:#07BEFC;" data-bs-toggle="modal" data-bs-target="#tambahPemasokModal">
        + Pemasok
    </button>

    <!-- Card Tabel -->
    <div class="card shadow mt-3">
        <div class="card-header text-white" style="background-color:#00A9F6;">Daftar Pemasok</div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead style="background-color:#87E8FF;">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemasok</th>
                        <th>Alamat</th>
                        <th>Kontak</th>
                        <th>Produk Utama</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>PT Maju Jaya</td><td>Bandung</td><td>08123456789</td><td>Beras</td></tr>
                    <tr><td>2</td><td>CV Sejahtera</td><td>Jakarta</td><td>08234567890</td><td>Gula</td></tr>
                    <tr><td>3</td><td>UD Makmur</td><td>Surabaya</td><td>08345678901</td><td>Minyak Goreng</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Pemasok -->
<div class="modal fade" id="tambahPemasokModal" tabindex="-1" aria-labelledby="tambahPemasokLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00A9F6; color:white;">
                <h5 class="modal-title" id="tambahPemasokLabel">Tambah Pemasok Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    @csrf
                    <div class="mb-3">
                        <label>Nama Pemasok</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kontak</label>
                        <input type="text" name="kontak" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Produk Utama</label>
                        <input type="text" name="produk" class="form-control" required>
                    </div>
                    <button type="submit" class="btn text-white" style="background-color:#07BEFC;">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
