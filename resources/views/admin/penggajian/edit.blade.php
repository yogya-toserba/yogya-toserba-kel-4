@extends('layouts.navbar_admin')

@section('title', 'Edit Gaji Karyawan')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Gaji Karyawan</h1>
            <a href="{{ route('admin.penggajian') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Data Gaji</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.penggajian.update', $gaji->id_gaji) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                                        <input type="text" class="form-control" id="nama_karyawan"
                                            value="{{ $gaji->karyawan->nama ?? 'N/A' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="periode_gaji" class="form-label">Periode Gaji</label>
                                        <input type="text" class="form-control" id="periode_gaji"
                                            value="{{ Carbon\Carbon::createFromFormat('Y-m', $gaji->periode_gaji)->format('F Y') }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                                        <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok"
                                            value="{{ $gaji->gaji_pokok }}" min="0" step="1000" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tunjangan" class="form-label">Tunjangan</label>
                                        <input type="number" class="form-control" id="tunjangan" name="tunjangan"
                                            value="{{ $gaji->tunjangan }}" min="0" step="1000">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="bonus" class="form-label">Bonus</label>
                                        <input type="number" class="form-control" id="bonus" name="bonus"
                                            value="{{ $gaji->bonus }}" min="0" step="1000">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="potongan" class="form-label">Potongan</label>
                                        <input type="number" class="form-control" id="potongan" name="potongan"
                                            value="{{ $gaji->potongan }}" min="0" step="1000">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                                        <select class="form-select" id="status_pembayaran" name="status_pembayaran">
                                            <option value="pending"
                                                {{ $gaji->status_pembayaran == 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="paid"
                                                {{ $gaji->status_pembayaran == 'paid' ? 'selected' : '' }}>Dibayar</option>
                                            <option value="cancelled"
                                                {{ $gaji->status_pembayaran == 'cancelled' ? 'selected' : '' }}>Dibatalkan
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jumlah_gaji" class="form-label">Total Gaji</label>
                                        <input type="text" class="form-control" id="jumlah_gaji" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $gaji->keterangan }}</textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.penggajian') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Info Karyawan</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td>{{ $gaji->id_karyawan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan:</strong></td>
                                <td>{{ $gaji->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Divisi:</strong></td>
                                <td>{{ $gaji->karyawan->divisi ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $gaji->karyawan->email ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gajiPokok = document.getElementById('gaji_pokok');
            const tunjangan = document.getElementById('tunjangan');
            const bonus = document.getElementById('bonus');
            const potongan = document.getElementById('potongan');
            const jumlahGaji = document.getElementById('jumlah_gaji');

            function hitungTotal() {
                const gp = parseInt(gajiPokok.value) || 0;
                const tj = parseInt(tunjangan.value) || 0;
                const bn = parseInt(bonus.value) || 0;
                const pt = parseInt(potongan.value) || 0;

                const total = gp + tj + bn - pt;
                jumlahGaji.value = 'Rp ' + total.toLocaleString('id-ID');
            }

            // Event listeners
            gajiPokok.addEventListener('input', hitungTotal);
            tunjangan.addEventListener('input', hitungTotal);
            bonus.addEventListener('input', hitungTotal);
            potongan.addEventListener('input', hitungTotal);

            // Hitung total saat load
            hitungTotal();
        });
    </script>
@endsection
