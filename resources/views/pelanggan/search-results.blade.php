@extends('layouts.customer')

@section('title', 'Hasil Pencarian - ' . $query)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-search me-2"></i>
                        Hasil Pencarian untuk: "{{ $query }}"
                    </h4>
                </div>
                <div class="card-body">
                    @if(count($results) > 0)
                        <div class="row">
                            @foreach($results as $product)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card product-card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->nama_barang }}</h5>
                                            <p class="card-text">
                                                <strong>Harga:</strong> Rp {{ number_format($product->harga, 0, ',', '.') }}<br>
                                                <strong>Stok:</strong> {{ $product->stok }}
                                            </p>
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fas fa-shopping-cart me-1"></i>Tambah ke Keranjang
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada hasil ditemukan</h5>
                            <p class="text-muted">Coba gunakan kata kunci yang berbeda</p>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
