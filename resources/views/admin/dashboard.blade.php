@extends('layouts.navbar_admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="alert" style="background: rgba(34,197,94,.1); color:#065f46; border:1px solid rgba(34,197,94,.2);">
                    <i class="fas fa-check-circle me-2"></i>Selamat datang di dashboard admin.
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted">Total Produk</div>
                                <div class="fs-3 fw-bold">128</div>
                            </div>
                            <div class="text-success"><i class="fas fa-box fa-2x"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted">Pesanan Hari Ini</div>
                                <div class="fs-3 fw-bold">42</div>
                            </div>
                            <div class="text-primary"><i class="fas fa-shopping-cart fa-2x"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted">Pengguna</div>
                                <div class="fs-3 fw-bold">1,245</div>
                            </div>
                            <div class="text-warning"><i class="fas fa-users fa-2x"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection