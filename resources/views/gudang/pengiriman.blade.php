@extends('layouts.app')

@section('title', 'Dashboard Rantai Pasok - MyYOGYA')

@section('content')
  <!-- Main Content -->
  <div class="flex-grow-1 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-semibold">Pengiriman Barang</h2>
      <button class="btn btn-outline-dark"><i class="fa fa-user"></i></button>
    </div>

    <!-- Tabel Pengiriman Barang -->
    <div class="card p-3">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Daftar Pengiriman</h5>
        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalPengiriman">
          <i class="fa fa-plus me-1"></i> Buat Pengiriman
        </button>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered data-table">
          <thead class="table-light">
            <tr>
              <th>Tanggal</th>
              <th>Cabang Tujuan</th>
              <th>Kode Pengiriman</th>
              <th>Jumlah Barang</th>
              <th>Supir</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2025-08-07</td>
              <td>Cabang Cikoneng</td>
              <td>PKM20250807-001</td>
              <td>250</td>
              <td>Budi Santoso</td>
              <td><span class="badge bg-success badge-status">Terkirim</span></td>
              <td>
                <div class="d-flex gap-2">
                  <button class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i> Detail</button>
                  <button class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> Edit</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Pengiriman -->
<div class="modal fade" id="modalPengiriman" tabindex="-1" aria-labelledby="modalPengirimanLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="modalPengirimanLabel">Tambah Pengiriman Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Tanggal Pengiriman</label>
          <input type="date" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Cabang Tujuan</label>
          <input type="text" class="form-control" placeholder="Masukkan nama cabang">
        </div>
        <div class="mb-3">
          <label class="form-label">Kode Pengiriman</label>
          <input type="text" class="form-control" placeholder="Masukkan kode pengiriman">
        </div>
        <div class="mb-3">
          <label class="form-label">Jumlah Barang</label>
          <input type="number" class="form-control" placeholder="Masukkan jumlah barang">
        </div>
        <div class="mb-3">
          <label class="form-label">Supir</label>
          <input type="text" class="form-control" placeholder="Masukkan nama supir">
        </div>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select class="form-select">
            <option value="Terkirim">Terkirim</option>
            <option value="Proses">Proses</option>
            <option value="Dibatalkan">Dibatalkan</option>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection