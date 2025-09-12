@extends('layouts.navbar_admin')

@section('title', 'Manajemen Penggajian - MyYOGYA')

@section('content')
    <style>
        /* Modern Penggajian Styles */
        .penggajian-header {
            background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
            color: white;
            padding: 25px 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }

        .penggajian-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .penggajian-header p {
            font-size: 1rem;
            opacity: 0.9;
            margin: 8px 0 0 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.1), rgba(111, 66, 193, 0.1));
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 5px;
            position: relative;
        }

        .stat-label {
            font-size: 0.95rem;
            color: #6c757d;
            font-weight: 500;
            position: relative;
        }

        .stat-icon {
            font-size: 2.5rem;
            color: #007bff;
            opacity: 0.7;
            float: right;
            margin-top: -10px;
            position: relative;
        }

        .modern-card {
            background: #ffffff !important;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 25px;
        }

        .card-header-modern {
            background: #ffffff !important;
            padding: 20px 25px;
            border-bottom: 2px solid #dee2e6;
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .card-title-modern {
            font-size: 1.3rem;
            font-weight: 700;
            color: #495057;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff !important;
        }

        .modern-table th {
            background: #ffffff !important;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #495057 !important;
            border: none;
            border-bottom: 2px solid #dee2e6;
        }

        .modern-table td {
            padding: 15px;
            border: none;
            border-bottom: 1px solid #f1f5f9;
            color: #374151 !important;
            background: #ffffff !important;
        }

        .modern-table tbody tr {
            background: #ffffff !important;
        }

        .modern-table tbody tr:hover {
            background: #f8f9fa !important;
        }

        /* Memastikan semua elemen di dalam table berwarna putih */
        .modern-table * {
            background-color: inherit !important;
        }

        .modern-table .fw-semibold,
        .modern-table .text-muted,
        .modern-table .salary-amount {
            color: inherit !important;
        }

        .modern-table .profile-avatar {
            background: #007bff !important;
            color: white !important;
        }

        /* Override semua kemungkinan warna hitam di table */
        .modern-table,
        .modern-table tbody,
        .modern-table thead,
        .modern-table tr,
        .modern-table td,
        .modern-table th {
            background: #ffffff !important;
            color: #374151 !important;
        }

        .modern-table .text-dark {
            color: #374151 !important;
        }

        /* Pastikan tidak ada background gelap */
        .modern-table .bg-dark,
        .modern-table .bg-black,
        .modern-table .table-dark {
            background: #ffffff !important;
            color: #374151 !important;
        }

        /* CSS kuat untuk memaksa table putih */
        .table-white,
        .table-white thead,
        .table-white tbody,
        .table-white tr,
        .table-white th,
        .table-white td {
            background-color: #ffffff !important;
            background: #ffffff !important;
            color: #374151 !important;
            border-color: #dee2e6 !important;
        }

        .table-white thead th {
            background-color: #f8f9fa !important;
            background: #f8f9fa !important;
            color: #495057 !important;
            border-bottom: 2px solid #dee2e6 !important;
        }

        /* Override Bootstrap table dark classes */
        .table-dark,
        .table-dark th,
        .table-dark td,
        .table-dark thead th {
            background-color: #ffffff !important;
            background: #ffffff !important;
            color: #374151 !important;
        }

        /* Pastikan container juga putih */
        .table-responsive {
            background: #ffffff !important;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-paid {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-pending {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-processing {
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .salary-amount {
            font-size: 1.1rem;
            font-weight: 700;
            color: #28a745;
        }

        .btn-modern {
            background: linear-gradient(135deg, #007bff, #6f42c1);
            color: white;
            border: 2px solid #007bff;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
            color: white;
            background: linear-gradient(135deg, #6f42c1, #e83e8c);
            border-color: #6f42c1;
        }

        .btn-outline-modern {
            background: transparent;
            color: #007bff;
            border: 2px solid #007bff;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline-modern:hover {
            background: #007bff;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .form-control-modern {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .form-control-modern:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        .form-label-modern {
            color: #374151;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .filter-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            align-items: end;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #007bff, #6f42c1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 12px;
        }

        .overtime-badge {
            background: #ffeaa7;
            color: #856404;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .card-header-modern {
                padding: 15px 20px;
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>

    <div class="penggajian-container">
        <!-- Header Section -->
        <div class="penggajian-header">
            <h2>Manajemen Penggajian Karyawan</h2>
            <p>Kelola dan proses gaji karyawan MyYOGYA dengan sistem terintegrasi</p>
        </div>

        <!-- Stats Section -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">Rp 485.2M</div>
                <div class="stat-label">Total Gaji Bulan Ini</div>
                <i class="fas fa-money-bill-wave stat-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-number">189</div>
                <div class="stat-label">Sudah Dibayar</div>
                <i class="fas fa-check-circle stat-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-number">23</div>
                <div class="stat-label">Pending Approval</div>
                <i class="fas fa-clock stat-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-number">Rp 23.5M</div>
                <div class="stat-label">Bonus & Lembur</div>
                <i class="fas fa-star stat-icon"></i>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-grid">
                <div>
                    <label class="form-label-modern">Periode</label>
                    <select class="form-control form-control-modern">
                        <option>Agustus 2025</option>
                        <option>Juli 2025</option>
                        <option>Juni 2025</option>
                        <option>Mei 2025</option>
                    </select>
                </div>
                <div>
                    <label class="form-label-modern">Cabang</label>
                    <select class="form-control form-control-modern">
                        <option>Semua Cabang</option>
                        <option>Yogyakarta Pusat</option>
                        <option>Solo</option>
                        <option>Semarang</option>
                        <option>Magelang</option>
                    </select>
                </div>
                <div>
                    <label class="form-label-modern">Status</label>
                    <select class="form-control form-control-modern">
                        <option>Semua Status</option>
                        <option>Sudah Dibayar</option>
                        <option>Pending</option>
                        <option>Diproses</option>
                    </select>
                </div>
                <div>
                    <label class="form-label-modern">&nbsp;</label>
                    <button class="btn btn-modern w-100 form-control-modern" style="height: 48px;">
                        <i class="fas fa-search"></i>
                        Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Penggajian Table -->
        <div class="modern-card">
            <div class="card-header-modern">
                <h5 class="card-title-modern">
                    <i class="fas fa-calculator" style="color: #007bff; margin-right: 10px;"></i>
                    Daftar Penggajian Karyawan - Agustus 2025
                </h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-modern">
                        <i class="fas fa-credit-card"></i>
                        Proses Pembayaran
                    </button>
                    <button class="btn btn-outline-modern">
                        <i class="fas fa-download"></i>
                        Export Slip Gaji
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-white modern-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input">
                            </th>
                            <th>Karyawan</th>
                            <th>Cabang</th>
                            <th>Gaji Pokok</th>
                            <th>Kehadiran</th>
                            <th>Lembur</th>
                            <th>Potongan</th>
                            <th>Total Gaji</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar">AS</div>
                                    <div>
                                        <div class="fw-semibold">Andi Setiawan</div>
                                        <small class="text-muted">ID: EMP001 • Manager</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">Yogyakarta Pusat</div>
                            </td>
                            <td>
                                <div class="salary-amount">Rp 8,500,000</div>
                            </td>
                            <td>
                                <div class="fw-semibold text-success">22/22</div>
                                <small class="text-muted">100%</small>
                            </td>
                            <td>
                                <div class="fw-semibold">15.5 jam</div>
                                <div class="overtime-badge">+Rp 387,500</div>
                            </td>
                            <td>
                                <div class="text-danger">-Rp 425,000</div>
                                <small class="text-muted">BPJS, Pajak</small>
                            </td>
                            <td>
                                <div class="salary-amount fw-bold">Rp 8,462,500</div>
                            </td>
                            <td>
                                <span class="status-badge status-paid">Dibayar</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar">SP</div>
                                    <div>
                                        <div class="fw-semibold">Sari Pertiwi</div>
                                        <small class="text-muted">ID: EMP002 • Admin</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">Solo</div>
                            </td>
                            <td>
                                <div class="salary-amount">Rp 4,500,000</div>
                            </td>
                            <td>
                                <div class="fw-semibold text-warning">20/22</div>
                                <small class="text-muted">91%</small>
                            </td>
                            <td>
                                <div class="fw-semibold">8 jam</div>
                                <div class="overtime-badge">+Rp 163,636</div>
                            </td>
                            <td>
                                <div class="text-danger">-Rp 225,000</div>
                                <small class="text-muted">BPJS, Pajak</small>
                            </td>
                            <td>
                                <div class="salary-amount fw-bold">Rp 4,438,636</div>
                            </td>
                            <td>
                                <span class="status-badge status-pending">Pending</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar">BW</div>
                                    <div>
                                        <div class="fw-semibold">Budi Wijaya</div>
                                        <small class="text-muted">ID: EMP003 • Security</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">Semarang</div>
                            </td>
                            <td>
                                <div class="salary-amount">Rp 3,800,000</div>
                            </td>
                            <td>
                                <div class="fw-semibold text-success">22/22</div>
                                <small class="text-muted">100%</small>
                            </td>
                            <td>
                                <div class="fw-semibold">12 jam</div>
                                <div class="overtime-badge">+Rp 207,273</div>
                            </td>
                            <td>
                                <div class="text-danger">-Rp 190,000</div>
                                <small class="text-muted">BPJS, Pajak</small>
                            </td>
                            <td>
                                <div class="salary-amount fw-bold">Rp 3,817,273</div>
                            </td>
                            <td>
                                <span class="status-badge status-processing">Diproses</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-info">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar">LM</div>
                                    <div>
                                        <div class="fw-semibold">Linda Maharani</div>
                                        <small class="text-muted">ID: EMP004 • Kasir</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">Magelang</div>
                            </td>
                            <td>
                                <div class="salary-amount">Rp 3,200,000</div>
                            </td>
                            <td>
                                <div class="fw-semibold text-danger">18/22</div>
                                <small class="text-muted">82%</small>
                            </td>
                            <td>
                                <div class="fw-semibold">5 jam</div>
                                <div class="overtime-badge">+Rp 72,727</div>
                            </td>
                            <td>
                                <div class="text-danger">-Rp 160,000</div>
                                <small class="text-muted">BPJS, Pajak</small>
                            </td>
                            <td>
                                <div class="salary-amount fw-bold">Rp 3,112,727</div>
                            </td>
                            <td>
                                <span class="status-badge status-paid">Dibayar</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar">RH</div>
                                    <div>
                                        <div class="fw-semibold">Rudi Hermawan</div>
                                        <small class="text-muted">ID: EMP005 • Supervisor</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">Yogyakarta Pusat</div>
                            </td>
                            <td>
                                <div class="salary-amount">Rp 6,500,000</div>
                            </td>
                            <td>
                                <div class="fw-semibold text-success">22/22</div>
                                <small class="text-muted">100%</small>
                            </td>
                            <td>
                                <div class="fw-semibold">20 jam</div>
                                <div class="overtime-badge">+Rp 590,909</div>
                            </td>
                            <td>
                                <div class="text-danger">-Rp 325,000</div>
                                <small class="text-muted">BPJS, Pajak</small>
                            </td>
                            <td>
                                <div class="salary-amount fw-bold">Rp 6,765,909</div>
                            </td>
                            <td>
                                <span class="status-badge status-pending">Pending</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="row">
            <div class="col-md-8">
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan 1 - 5 dari 212 karyawan
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            <li class="page-item active">
                                <span class="page-link">1</span>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Bulk Actions -->
                <div class="modern-card">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Aksi Massal</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success btn-sm">
                                <i class="fas fa-check-double"></i>
                                Approve Semua
                            </button>
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-credit-card"></i>
                                Proses Pembayaran
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-file-export"></i>
                                Export Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Select all functionality
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.querySelector('thead input[type="checkbox"]');
            const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');

            selectAllCheckbox.addEventListener('change', function() {
                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
                updateBulkActionsVisibility();
            });

            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkActionsVisibility);
            });

            function updateBulkActionsVisibility() {
                const checkedBoxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
                const bulkActions = document.querySelector('.modern-card .card-body');

                if (checkedBoxes.length > 0) {
                    bulkActions.style.opacity = '1';
                } else {
                    bulkActions.style.opacity = '0.7';
                }
            }
        });

        // Filter functionality
        document.querySelector('.btn-modern').addEventListener('click', function() {
            console.log('Filtering salary data...');
        });
    </script>
@endsection
