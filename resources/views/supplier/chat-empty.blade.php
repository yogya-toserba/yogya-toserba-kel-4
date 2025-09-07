@extends('supplier.layout')

@section('title', 'Chat Gudang')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-comments me-2"></i>
                        Chat Gudang
                    </h5>
                </div>
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum Ada Percakapan</h4>
                        <p class="text-muted">
                            Anda belum memiliki percakapan dengan tim gudang.<br>
                            Percakapan akan muncul ketika ada komunikasi terkait pengiriman produk.
                        </p>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Informasi:</strong><br>
                                Chat akan otomatis dibuat ketika ada transaksi atau komunikasi yang memerlukan koordinasi dengan tim gudang.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
