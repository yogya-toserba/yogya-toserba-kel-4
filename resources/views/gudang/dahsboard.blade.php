@extends('layouts.app')

@section('title', 'Dashboard Rantai Pasok - MyYOGYA')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-semibold">Dashboard Rantai Pasok</h2>
    <button class="btn btn-outline-dark"><i class="fa fa-user"></i></button>
  </div>

  {{-- Filter --}}
  <div class="filter-box mb-4">
    <form class="row g-3 align-items-center">
      <div class="col-auto">
        <label for="startDate" class="fw-semibold">Dari</label>
      </div>
      <div class="col-auto">
        <input type="date" class="form-control" id="startDate">
      </div>
      <div class="col-auto">
        <label for="endDate" class="fw-semibold">Sampai</label>
      </div>
      <div class="col-auto">
        <input type="date" class="form-control" id="endDate">
      </div>
      <div class="col-auto">
        <button type="button" class="btn btn-primary"><i class="fa fa-filter me-1"></i> Filter</button>
      </div>
    </form>
  </div>

  {{-- Summary Cards --}}
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="card-summary bg-primary-custom">
        <div class="d-flex align-items-center">
          <i class="fa fa-cubes fa-2x me-3"></i>
          <div>
            <h6 class="mb-0">Stok Barang</h6>
            <small>23.400 Unit</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-summary bg-success-custom">
        <div class="d-flex align-items-center">
          <i class="fa fa-box-open fa-2x me-3"></i>
          <div>
            <h6 class="mb-0">Barang Masuk</h6>
            <small>12.500 Unit</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-summary bg-danger-custom">
        <div class="d-flex align-items-center">
          <i class="fa fa-dolly fa-2x me-3"></i>
          <div>
            <h6 class="mb-0">Barang Keluar</h6>
            <small>8.300 Unit</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-summary bg-warning-custom">
        <div class="d-flex align-items-center">
          <i class="fa fa-clock fa-2x me-3"></i>
          <div>
            <h6 class="mb-0">Pesanan Tepat Waktu</h6>
            <small>96%</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Grafik --}}
  <div class="row g-3 mb-4">
    <div class="col-md-6">
      <div class="card p-3 shadow-sm">
        <h5 class="mb-3">Grafik Permintaan per Bulan</h5>
        <canvas id="chartPermintaan"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-3 shadow-sm">
        <h5 class="mb-3">Grafik Barang Masuk per Bulan</h5>
        <canvas id="chartBarangMasuk"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-3 shadow-sm">
        <h5 class="mb-3">Grafik Barang Keluar per Bulan</h5>
        <canvas id="chartBarangKeluar"></canvas>
      </div>
    </div>
  </div>

  
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Grafik Permintaan
  new Chart(document.getElementById('chartPermintaan'), {
    type: 'line',
    data: {
      labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
      datasets: [{
        label: 'Permintaan',
        data: [120, 150, 180, 160, 200, 220, 250, 230, 210, 240, 260, 300],
        borderColor: '#00A9F6',
        fill: true,
        backgroundColor: 'rgba(0,169,246,0.2)'
      }]
    }
  });

  // Grafik Barang Masuk
  new Chart(document.getElementById('chartBarangMasuk'), {
    type: 'bar',
    data: {
      labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
      datasets: [{
        label: 'Barang Masuk',
        data: [500, 600, 700, 650, 800, 900, 850, 950, 1000, 1100, 1200, 1300],
        backgroundColor: '#07BEFC'
      }]
    }
  });

  // Grafik Barang Keluar
  new Chart(document.getElementById('chartBarangKeluar'), {
    type: 'bar',
    data: {
      labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
      datasets: [{
        label: 'Barang Keluar',
        data: [400, 550, 600, 620, 700, 850, 800, 870, 950, 1000, 1100, 1150],
        backgroundColor: '#FF6384'
      }]
    }
  });
</script>
@endpush
