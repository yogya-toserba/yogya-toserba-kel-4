@extends('layouts.navbar_admin')

@section('title', 'Input Gaji Karyawan - MyYOGYA')

@section('content')
    <style>
        /* Modern Input Gaji Styles */
        .input-gaji-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 25px 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .input-gaji-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .input-gaji-header p {
            margin: 8px 0 0 0;
            font-size: 1rem;
            opacity: 0.9;
        }

        .modern-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 25px;
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .modern-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .card-header-modern {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid #dee2e6;
            padding: 20px 25px;
            border-radius: 12px 12px 0 0;
        }

        .gaji-info-alert {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border: 1px solid #2196f3;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .struktur-gaji-item {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .struktur-gaji-item:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }
    </style>

    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="input-gaji-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2><i class="fas fa-plus-circle"></i> Input Gaji Karyawan</h2>
                    <p>Tambahkan data gaji untuk karyawan dengan gaji otomatis sesuai jabatan</p>
                </div>
                <a href="{{ route('admin.penggajian') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="modern-card">
            <div class="card-header-modern">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-edit text-primary"></i> Form Input Gaji
                </h5>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.penggajian.store') }}" method="POST" id="gajiForm">
                    @csrf

                    <div class="row">
                        <!-- Pilih Karyawan -->
                        <div class="col-md-6 mb-3">
                            <label for="id_karyawan" class="form-label fw-semibold">Pilih Karyawan <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="id_karyawan" name="id_karyawan" required>
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach ($karyawan as $k)
                                    <option value="{{ $k->id_karyawan }}" data-divisi="{{ $k->divisi }}"
                                        {{ old('id_karyawan') == $k->id_karyawan ? 'selected' : '' }}>
                                        {{ $k->nama }} - {{ $k->divisi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Periode Gaji -->
                        <div class="col-md-6 mb-3">
                            <label for="periode" class="form-label fw-semibold">Periode Gaji <span
                                    class="text-danger">*</span></label>
                            <input type="month" class="form-control" id="periode" name="periode"
                                value="{{ old('periode', date('Y-m')) }}" required>
                        </div>
                    </div>

                    <!-- Info Divisi dan Gaji Standar -->
                    <div class="row" id="infoDiv" style="display: none;">
                        <div class="col-md-12 mb-3">
                            <div class="gaji-info-alert">
                                <h6 class="fw-semibold text-primary"><i class="fas fa-info-circle"></i> Informasi Jabatan
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Divisi:</strong> <span id="divisiText"
                                                class="badge bg-secondary">-</span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-0"><strong>Gaji Standar:</strong> <span id="gajiStandarText"
                                                class="text-success fw-bold">-</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Gaji Pokok -->
                        <div class="col-md-6 mb-3">
                            <label for="gaji_pokok" class="form-label fw-semibold">Gaji Pokok <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok"
                                    value="{{ old('gaji_pokok') }}" min="0" required>
                            </div>
                            <small class="text-muted"><i class="fas fa-magic"></i> Akan otomatis terisi sesuai
                                jabatan</small>
                        </div>

                        <!-- Tunjangan -->
                        <div class="col-md-6 mb-3">
                            <label for="tunjangan" class="form-label fw-semibold">Tunjangan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="tunjangan" name="tunjangan"
                                    value="{{ old('tunjangan', 0) }}" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Bonus -->
                        <div class="col-md-6 mb-3">
                            <label for="bonus" class="form-label fw-semibold">Bonus</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="bonus" name="bonus"
                                    value="{{ old('bonus', 0) }}" min="0">
                            </div>
                        </div>

                        <!-- Potongan -->
                        <div class="col-md-6 mb-3">
                            <label for="potongan" class="form-label fw-semibold">Potongan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="potongan" name="potongan"
                                    value="{{ old('potongan', 0) }}" min="0">
                            </div>
                        </div>
                    </div>

                    <!-- Total Gaji -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jumlah_gaji" class="form-label fw-semibold">Total Gaji <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control bg-light" id="jumlah_gaji" name="jumlah_gaji"
                                    value="{{ old('jumlah_gaji') }}" readonly required>
                            </div>
                            <small class="text-muted"><i class="fas fa-calculator"></i> Dihitung otomatis: Gaji Pokok +
                                Tunjangan + Bonus - Potongan</small>
                        </div>

                        <!-- Keterangan -->
                        <div class="col-md-6 mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                                placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.penggajian') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan Gaji
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Struktur Gaji Reference -->
        <div class="modern-card">
            <div class="card-header-modern">
                <h6 class="mb-0 fw-bold">
                    <i class="fas fa-chart-bar text-info"></i> Referensi Struktur Gaji Berdasarkan Jabatan
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    @foreach ($strukturGaji as $divisi => $gaji)
                        <div class="col-md-3 mb-3">
                            <div class="struktur-gaji-item">
                                <div class="fw-bold text-dark">{{ $divisi }}</div>
                                <div class="text-success fw-semibold mt-1">
                                    {{ \App\Services\GajiService::formatCurrency($gaji) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const karyawanSelect = document.getElementById('id_karyawan');
            const gajiPokokInput = document.getElementById('gaji_pokok');
            const tunjanganInput = document.getElementById('tunjangan');
            const bonusInput = document.getElementById('bonus');
            const potonganInput = document.getElementById('potongan');
            const totalGajiInput = document.getElementById('jumlah_gaji');
            const infoDiv = document.getElementById('infoDiv');
            const divisiText = document.getElementById('divisiText');
            const gajiStandarText = document.getElementById('gajiStandarText');

            // Struktur gaji dari server
            const strukturGaji = @json($strukturGaji);

            // Function untuk menghitung total gaji
            function hitungTotalGaji() {
                const gajiPokok = parseFloat(gajiPokokInput.value) || 0;
                const tunjangan = parseFloat(tunjanganInput.value) || 0;
                const bonus = parseFloat(bonusInput.value) || 0;
                const potongan = parseFloat(potonganInput.value) || 0;

                const total = gajiPokok + tunjangan + bonus - potongan;
                totalGajiInput.value = total;
            }

            // Event listener untuk perubahan karyawan
            karyawanSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                if (this.value) {
                    const divisi = selectedOption.getAttribute('data-divisi');
                    const gajiStandar = strukturGaji[divisi] || 3500000;

                    // Tampilkan info divisi dengan animasi
                    divisiText.textContent = divisi;
                    gajiStandarText.textContent = 'Rp ' + gajiStandar.toLocaleString('id-ID');
                    infoDiv.style.display = 'block';
                    infoDiv.style.opacity = '0';
                    setTimeout(() => {
                        infoDiv.style.opacity = '1';
                        infoDiv.style.transition = 'opacity 0.3s ease';
                    }, 100);

                    // Set gaji pokok sesuai divisi
                    gajiPokokInput.value = gajiStandar;

                    // Hitung ulang total
                    hitungTotalGaji();
                } else {
                    infoDiv.style.display = 'none';
                    gajiPokokInput.value = '';
                    totalGajiInput.value = '';
                }
            });

            // Event listeners untuk perhitungan otomatis
            [gajiPokokInput, tunjanganInput, bonusInput, potonganInput].forEach(input => {
                input.addEventListener('input', hitungTotalGaji);
            });

            // Initial calculation if values already exist
            hitungTotalGaji();

            // Form validation
            document.getElementById('gajiForm').addEventListener('submit', function(e) {
                if (!karyawanSelect.value) {
                    e.preventDefault();
                    alert('Silakan pilih karyawan terlebih dahulu!');
                    karyawanSelect.focus();
                    return false;
                }

                if (!totalGajiInput.value || totalGajiInput.value <= 0) {
                    e.preventDefault();
                    alert('Total gaji harus lebih dari 0!');
                    gajiPokokInput.focus();
                    return false;
                }
            });
        });
    </script>

@endsection
