@extends('layouts.app')

@section('title', 'Dashboard Rantai Pasok - MyYOGYA')

@section('content')
  <!-- Main Content -->
  <div class="flex-grow-1 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-semibold">Stok Barang</h2>
      <button class="btn btn-outline-dark"><i class="fa fa-user"></i></button>
    </div>

    <!-- Card Table -->
    <div class="card p-3 table-card">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <button class="btn btn-green btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahStok">
            <i class="fa fa-plus me-1"></i> Stok
          </button>
          <button class="btn btn-delete btn-sm ms-2"><i class="fa fa-trash me-1"></i> Delete</button>
        </div>
        <div>
          <button class="btn btn-outline-secondary btn-sm me-2"><i class="fa fa-filter me-1"></i> Filters</button>
          <button class="btn btn-outline-primary btn-sm"><i class="fa fa-download me-1"></i> Export</button>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Tanggal</th>
              <th>ID Produk</th>
              <th>Kategori</th>
              <th>Jumlah</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Harga Beli</th>
              <th>Harga Jual</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2025-08-13</td>
              <td>0001</td>
              <td>01</td>
              <td>100</td>
              <td>Indomie</td>
              <td>Dus</td>
              <td>2.500</td>
              <td>3.000</td>
              <td><i class="fa fa-ellipsis-v"></i></td>
            </tr>
            <tr>
              <td>2025-08-13</td>
              <td>0002</td>
              <td>01</td>
              <td>100</td>
              <td>Sabun</td>
              <td>Dus</td>
              <td>2.500</td>
              <td>3.000</td>
              <td><i class="fa fa-ellipsis-v"></i></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Stok -->
<div class="modal fade" id="modalTambahStok" tabindex="-1" aria-labelledby="modalTambahStokLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahStokLabel">Tambah Stok Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Tanggal</label>
          <input type="date" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">ID Produk</label>
          <input type="text" class="form-control" placeholder="Masukkan ID Produk">
        </div>
        <div class="mb-3">
          <label class="form-label">ID Kategori</label>
          <input type="text" class="form-control" placeholder="Masukkan ID Kategori">
        </div>
        <div class="mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" class="form-control" placeholder="Masukkan Jumlah">
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Barang</label>
          <input type="text" class="form-control" placeholder="Masukkan Nama Barang">
        </div>
        <div class="mb-3">
          <label class="form-label">Satuan</label>
          <input type="text" class="form-control" placeholder="Masukkan Satuan">
        </div>
        <div class="mb-3">
          <label class="form-label">Harga Beli</label>
          <input type="number" class="form-control" placeholder="Masukkan Harga Beli">
        </div>
        <div class="mb-3">
          <label class="form-label">Harga Jual</label>
          <input type="number" class="form-control" placeholder="Masukkan Harga Jual">
        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-green">Simpan</button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection