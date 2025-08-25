@extends('layouts.app')

@section('title', 'Dashboard Rantai Pasok - MyYOGYA')

@section('content')
<div class="flex-grow-1 p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-semibold">Permintaan dari Cabang</h2>
    <button class="btn btn-outline-dark"><i class="fa fa-user"></i></button>
  </div>

  <!-- Tabel Permintaan Masuk dari Cabang -->
  <div class="card p-3 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="mb-0">Daftar Permintaan Masuk</h5>
      <button class="btn btn-sm btn-outline-primary"><i class="fa fa-refresh me-1"></i> Refresh</button>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>ID Permintaan</th>
            <th>ID Cabang</th>
            <th>Nama Cabang</th>
            <th>Tanggal Permintaan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>REQ001</td>
            <td>CB001</td>
            <td>Cabang Bandung</td>
            <td>2025-08-07</td>
            <td>
              <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal1">
                <i class="fa fa-eye"></i> Detail
              </button>
            </td>
          </tr>
          <!-- Tambah baris sesuai data dari controller -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal1" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Permintaan - REQ001</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- Info Cabang -->
        <table class="table table-bordered mb-4">
          <tr>
            <th style="width:200px;">ID Permintaan</th>
            <td>REQ001</td>
          </tr>
          <tr>
            <th>ID Cabang</th>
            <td>CB001</td>
          </tr>
          <tr>
            <th>Nama Cabang</th>
            <td>Cabang Bandung</td>
          </tr>
          <tr>
            <th>Alamat Cabang</th>
            <td>Jl. Soekarno Hatta No.123, Bandung</td>
          </tr>
          <tr>
            <th>Tanggal Permintaan</th>
            <td>2025-08-07</td>
          </tr>
        </table>

        <!-- Tabel Produk -->
        <h6 class="fw-semibold">Daftar Produk yang Diminta</h6>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="table-light">
              <tr>
                <th>Produk</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Prioritas</th>
                <th>Catatan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>PRD001</td>
                <td>Minyak Goreng</td>
                <td>Sembako</td>
                <td>100</td>
                <td>Liter</td>
                <td><span class="badge bg-danger">Tinggi</span></td>
                <td>Permintaan mendesak karena stok cabang menipis</td>
              </tr>
              <tr>
                <td>PRD002</td>
                <td>Beras Premium</td>
                <td>Sembako</td>
                <td>50</td>
                <td>Kg</td>
                <td><span class="badge bg-warning text-dark">Sedang</span></td>
                <td>Untuk persiapan stok minggu depan</td>
              </tr>
              <!-- Tambahkan produk lain jika ada -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success"><i class="fa fa-check me-1"></i> Terima</button>
        <button class="btn btn-danger"><i class="fa fa-times me-1"></i> Tolak</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
