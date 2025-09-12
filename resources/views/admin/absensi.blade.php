@extends('layouts.navbar_admin')

@section('title', 'Manajemen Absensi - MyYOGYA')

@section('content')
    <style>
        /* CSS VARIABLES FOR CONSISTENCY WITH PENGGAJIAN */
        :root {
            --table-bg: #ffffff;
            --table-text: #1e293b;
            --table-header-bg: #f8fafc;
            --table-border: #e2e8f0;
        }

        /* Modern Absensi Styles */
        .absensi-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 25px 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .absensi-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .absensi-header p {
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
            border-left: 4px solid #28a745;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: #28a745;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.95rem;
            color: #6c757d;
            font-weight: 500;
        }

        .stat-icon {
            font-size: 2.5rem;
            color: #28a745;
            opacity: 0.7;
            float: right;
            margin-top: -10px;
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
            border: none !important;
        }

        .modern-table th {
            background: #f8fafc !important;
            background-color: #f8fafc !important;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #1e293b !important;
            border: none !important;
            border-bottom: none !important;
        }

        .modern-table td {
            padding: 15px;
            border: none !important;
            border-bottom: none !important;
            color: #1e293b !important;
            background: #ffffff !important;
            background-color: #ffffff !important;
        }

        .modern-table tbody tr {
            background: #ffffff !important;
            background-color: #ffffff !important;
            border: none !important;
        }

        .modern-table tbody tr:hover {
            background: #f1f5f9 !important;
            background-color: #f1f5f9 !important;
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

        /* Override semua kemungkinan warna gelap di table */
        .modern-table,
        .modern-table tbody,
        .modern-table thead,
        .modern-table tr,
        .modern-table td,
        .modern-table th {
            background: #ffffff !important;
            color: #374151 !important;
            border: none !important;
            border-bottom: none !important;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;
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

        /* Pastikan container juga putih dan tanpa border */
        .table-responsive {
            background: #ffffff !important;
            border: none !important;
        }

        /* Hilangkan semua garis putih secara agresif */
        .modern-table,
        .modern-table *,
        .modern-table th,
        .modern-table td,
        .modern-table tr,
        .modern-table thead,
        .modern-table tbody {
            border: none !important;
            border-top: none !important;
            border-bottom: none !important;
            border-left: none !important;
            border-right: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Hilangkan garis pada thead khususnya */
        .modern-table thead {
            border-collapse: collapse !important;
        }

        .modern-table thead th {
            border: 0 !important;
            border-width: 0 !important;
            border-style: none !important;
        }

        /* Override Bootstrap table classes yang mungkin menambah border */
        .table,
        .table th,
        .table td,
        .table thead th {
            border: none !important;
            border-top: none !important;
            border-bottom: none !important;
        }

        /* FORCE WHITE TABLE - OVERRIDE ALL - SAMA SEPERTI PENGGAJIAN */
        .table,
        .table *,
        .table-responsive,
        .table thead,
        .table tbody,
        .table tr,
        .table th,
        .table td,
        .modern-table,
        .modern-table *,
        .modern-table thead,
        .modern-table tbody,
        .modern-table tr,
        .modern-table th,
        .modern-table td {
            background: #ffffff !important;
            background-color: #ffffff !important;
            color: #1e293b !important;
            border-color: #e2e8f0 !important;
            border: none !important;
            border-top: none !important;
            border-bottom: none !important;
            border-left: none !important;
            border-right: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .table thead th,
        .modern-table thead th {
            background: #f8fafc !important;
            background-color: #f8fafc !important;
            color: #1e293b !important;
        }

        .table tbody tr:hover,
        .modern-table tbody tr:hover {
            background: #f1f5f9 !important;
            background-color: #f1f5f9 !important;
        }

        /* ULTIMATE BORDER REMOVAL - SUPER AGGRESSIVE */
        * {
            border-collapse: collapse !important;
        }

        .modern-table,
        .modern-table *,
        .table,
        .table *,
        .table-responsive,
        .table-responsive * {
            border: 0 !important;
            border-width: 0 !important;
            border-style: none !important;
            border-color: transparent !important;
            border-top: 0 !important;
            border-bottom: 0 !important;
            border-left: 0 !important;
            border-right: 0 !important;
            outline: 0 !important;
            outline-width: 0 !important;
            outline-style: none !important;
            box-shadow: none !important;
            border-spacing: 0 !important;
            border-collapse: collapse !important;
        }

        /* Override any possible Bootstrap or framework borders */
        .table-bordered,
        .table-bordered th,
        .table-bordered td,
        .border,
        .border-top,
        .border-bottom,
        .border-left,
        .border-right {
            border: none !important;
            border-width: 0 !important;
        }

        /* Make sure table cells have no separation */
        .modern-table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
        }

        .modern-table th,
        .modern-table td {
            border-spacing: 0 !important;
            padding: 15px !important;
            margin: 0 !important;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-hadir {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-terlambat {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-izin {
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .status-alpha {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .btn-modern {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: 2px solid #28a745;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
            color: white;
            background: linear-gradient(135deg, #20c997, #17a2b8);
            border-color: #20c997;
        }

        .btn-outline-modern {
            background: transparent;
            color: #28a745;
            border: 2px solid #28a745;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline-modern:hover {
            background: #28a745;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
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
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            outline: none;
        }

        .form-label-modern {
            color: #374151;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .time-badge {
            background: #e9ecef;
            color: #495057;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 12px;
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

    <div class="absensi-container">
        <!-- Header Section -->
        <div class="absensi-header">
            <h2>Manajemen Absensi Karyawan</h2>
            <p>Monitor dan kelola kehadiran karyawan MyYOGYA secara real-time</p>
        </div>

        <!-- Stats Section -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">156</div>
                <div class="stat-label">Hadir Hari Ini</div>
                <i class="fas fa-user-check stat-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-number">23</div>
                <div class="stat-label">Terlambat</div>
                <i class="fas fa-clock stat-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-number">8</div>
                <div class="stat-label">Izin/Sakit</div>
                <i class="fas fa-calendar-times stat-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-number">4</div>
                <div class="stat-label">Alpha</div>
                <i class="fas fa-user-times stat-icon"></i>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-grid">
                <div>
                    <label class="form-label-modern">Tanggal</label>
                    <input type="date" class="form-control form-control-modern" value="{{ date('Y-m-d') }}">
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
                        <option>Hadir</option>
                        <option>Terlambat</option>
                        <option>Izin</option>
                        <option>Alpha</option>
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

        <!-- Absensi Table -->
        <div class="modern-card">
            <div class="card-header-modern">
                <h5 class="card-title-modern">
                    <i class="fas fa-users" style="color: #28a745; margin-right: 10px;"></i>
                    Daftar Absensi Karyawan
                </h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-modern">
                        <i class="fas fa-download"></i>
                        Export Excel
                    </button>
                    <button class="btn btn-outline-modern">
                        <i class="fas fa-sync-alt"></i>
                        Refresh
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Karyawan</th>
                            <th>Cabang</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Total Kerja</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar">AS</div>
                                    <div>
                                        <div class="fw-semibold">Andi Setiawan</div>
                                        <small class="text-muted">ID: EMP001</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">Yogyakarta Pusat</div>
                                <small class="text-muted">Kasir</small>
                            </td>
                            <td>
                                <div class="time-badge">08:00</div>
                            </td>
                            <td>
                                <div class="time-badge">17:00</div>
                            </td>
                            <td>
                                <div class="fw-bold text-success">9 jam</div>
                            </td>
                            <td>
                                <span class="status-badge status-hadir">Hadir</span>
                            </td>
                            <td>
                                <span class="text-muted">-</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar">SP</div>
                                    <div>
                                        <div class="fw-semibold">Sari Pertiwi</div>
                                        <small class="text-muted">ID: EMP002</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">Solo</div>
                                <small class="text-muted">Admin</small>
                            </td>
                            <td>
                                <div class="time-badge">08:30</div>
                            </td>
                            <td>
                                <div class="time-badge">17:30</div>
                            </td>
                            <td>
                                <div class="fw-bold text-warning">9 jam</div>
                            </td>
                            <td>
                                <span class="status-badge status-terlambat">Terlambat</span>
                            </td>
                            <td>
                                <span class="text-muted">Terlambat 30 menit</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar">BW</div>
                                    <div>
                                        <div class="fw-semibold">Budi Wijaya</div>
                                        <small class="text-muted">ID: EMP003</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">Semarang</div>
                                <small class="text-muted">Security</small>
                            </td>
                            <td>
                                <div class="time-badge">-</div>
                            </td>
                            <td>
                                <div class="time-badge">-</div>
                            </td>
                            <td>
                                <div class="fw-bold text-info">0 jam</div>
                            </td>
                            <td>
                                <span class="status-badge status-izin">Izin</span>
                            </td>
                            <td>
                                <span class="text-muted">Sakit</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar">LM</div>
                                    <div>
                                        <div class="fw-semibold">Linda Maharani</div>
                                        <small class="text-muted">ID: EMP004</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">Magelang</div>
                                <small class="text-muted">Kasir</small>
                            </td>
                            <td>
                                <div class="time-badge">-</div>
                            </td>
                            <td>
                                <div class="time-badge">-</div>
                            </td>
                            <td>
                                <div class="fw-bold text-danger">0 jam</div>
                            </td>
                            <td>
                                <span class="status-badge status-alpha">Alpha</span>
                            </td>
                            <td>
                                <span class="text-muted">Tidak hadir tanpa keterangan</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar">RH</div>
                                    <div>
                                        <div class="fw-semibold">Rudi Hermawan</div>
                                        <small class="text-muted">ID: EMP005</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">Yogyakarta Pusat</div>
                                <small class="text-muted">Manager</small>
                            </td>
                            <td>
                                <div class="time-badge">07:45</div>
                            </td>
                            <td>
                                <div class="time-badge">18:00</div>
                            </td>
                            <td>
                                <div class="fw-bold text-success">10.25 jam</div>
                            </td>
                            <td>
                                <span class="status-badge status-hadir">Hadir</span>
                            </td>
                            <td>
                                <span class="text-muted">Lembur 1.25 jam</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan 1 - 5 dari 191 karyawan
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
        </div>
    </div>

    <script>
        // Auto refresh setiap 30 detik
        setInterval(function() {
            // Simulasi update data real-time
            console.log('Refreshing attendance data...');
        }, 30000);

        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterButton = document.querySelector('.btn-modern');
            filterButton.addEventListener('click', function() {
                // Implementasi filter
                console.log('Filtering attendance data...');
            });
        });
    </script>
@endsection
