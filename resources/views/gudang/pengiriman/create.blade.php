@extends('layouts.appGudang')

@section('title', 'Tambah Pengiriman - MyYOGYA Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1><i class="fas fa-plus-circle me-2"></i>Tambah Pengiriman Baru</h1>
            <p class="mb-0">Buat pengiriman produk ke cabang atau tujuan lainnya</p>
        </div>
        <div class="actions d-flex gap-2">
            <a href="{{ route('gudang.pengiriman.index') }}" class="btn btn-orange btn-lg shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Form Section -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="new-card">
                <div class="new-card-header">
                    <h5 class="mb-0 new-card-title">
                        <i class="fas fa-edit" style="color: #f26b37; margin-right: 10px;"></i>
                        Informasi Pengiriman
                    </h5>
                </div>
                <div class="new-card-body p-4">
                    <form action="{{ route('gudang.pengiriman.store') }}" method="POST" id="pengirimanForm">
                        @csrf
                        
                        <div class="row">
                            <!-- Nama Produk -->
                            <div class="col-md-6 mb-3">
                                <label for="id_produk" class="form-label fw-medium">
                                    Produk (Stok Gudang) <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('id_produk') is-invalid @enderror" 
                                        id="id_produk" name="id_produk" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach($produkList as $produk)
                                        <option value="{{ $produk->id_produk }}" {{ old('id_produk') == $produk->id_produk ? 'selected' : '' }}>
                                            {{ $produk->nama_produk }} — Tersisa: {{ $produk->jumlah }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tujuan -->
                            <div class="col-md-6 mb-3">
                                <label for="tujuan" class="form-label fw-medium">
                                    Tujuan Pengiriman <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('tujuan') is-invalid @enderror" 
                                       id="tujuan" 
                                       name="tujuan" 
                                       value="{{ old('tujuan') }}"
                                       placeholder="Contoh: Cabang Malioboro, Gudang Regional Yogya"
                                       required>
                                @error('tujuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Jumlah -->
                            <div class="col-md-6 mb-3">
                                <label for="jumlah" class="form-label fw-medium">
                                    Jumlah (pcs) <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control @error('jumlah') is-invalid @enderror" 
                                       id="jumlah" 
                                       name="jumlah" 
                                       value="{{ old('jumlah') }}"
                                       min="1"
                                       placeholder="Masukkan jumlah produk"
                                       required>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal Kirim -->
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_kirim" class="form-label fw-medium">
                                    Tanggal Kirim <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control @error('tanggal_kirim') is-invalid @enderror" 
                                       id="tanggal_kirim" 
                                       name="tanggal_kirim" 
                                       value="{{ old('tanggal_kirim', date('Y-m-d')) }}"
                                       required>
                                @error('tanggal_kirim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Status -->
                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label fw-medium">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="dikirim" {{ old('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 pt-3 border-top">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Pengiriman
                            </button>
                            <a href="{{ route('gudang.pengiriman.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Form validation
    $('#pengirimanForm').on('submit', function(e) {
        var isValid = true;
        var firstInvalidField = null;

        // Reset previous validation states
        $('.is-invalid').removeClass('is-invalid');

        // Validate required fields
        $('input[required], select[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                if (!firstInvalidField) {
                    firstInvalidField = $(this);
                }
                isValid = false;
            }
        });

        // Validate jumlah
        var jumlah = parseInt($('#jumlah').val());
        if (jumlah && jumlah < 1) {
            $('#jumlah').addClass('is-invalid');
            if (!firstInvalidField) {
                firstInvalidField = $('#jumlah');
            }
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            if (firstInvalidField) {
                firstInvalidField.focus();
            }
            Swal.fire({
                title: 'Perhatian!',
                text: 'Mohon lengkapi semua field yang wajib diisi',
                icon: 'warning'
            });
        }
    });

    // Show validation errors
    @if($errors->any())
        Swal.fire({
            title: 'Terjadi Kesalahan!',
            html: '<ul style="text-align: left;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            icon: 'error'
        });
    @endif

    // Real-time validation
    $('input[required], select[required]').on('blur change', function() {
        if ($(this).val()) {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).removeClass('is-valid');
        }
    });

    // Number input validation
    $('#jumlah').on('input', function() {
        var value = parseInt($(this).val());
        if (value && value >= 1) {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else if ($(this).val()) {
            $(this).removeClass('is-valid').addClass('is-invalid');
        }
    });

    // Update max jumlah berdasarkan stok yang dipilih
    $('#id_produk').on('change', function() {
        var selected = $(this).find('option:selected').text();
        var match = selected.match(/Tersisa: (\d+)/);
        if (match) {
            var stok = parseInt(match[1]);
            $('#jumlah').attr('max', stok);
        } else {
            $('#jumlah').removeAttr('max');
        }
    }).trigger('change');
});
</script>
@endpush
@endsection
