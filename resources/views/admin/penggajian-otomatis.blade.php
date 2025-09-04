@extends('layouts.navbar_admin')

@section('title', 'Penggajian Otomatis - MyYOGYA')

@section('content')
    <style>
        /* Main Content Layout */
        .main-content {
            margin-left: 250px;
            padding: 25px 35px;
            background: #f8fafc;
            min-height: 100vh;
            width: calc(100% - 250px);
        }

        @media (min-width: 769px) {
            .main-content {
                margin-left: 250px;
                width: calc(100% - 250px);
            }
        }

        /* Dark Mode Support */
        body.dark-mode .main-content {
            background: #1a1d29;
        }

        /* Dashboard Container */
        .dashboard-container {
            background: #f8fafc;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body.dark-mode .dashboard-container {
            background: #1a1d29;
        }

        /* Header Section */
        .page-header {
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
            color: white;
            padding: 30px 35px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
        }

        .page-header h1 {
            font-size: 2.2rem;
            font-weight: bold;
            margin: 0;
            color: white;
        }

        .page-header p {
            font-size: 1rem;
            opacity: 0.9;
            margin: 8px 0 0 0;
            color: white;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            text-align: center;
        }

        body.dark-mode .stat-card {
            background: #2a2d3f;
            border-color: #3a3d4a;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #f26b37, #e55827);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            margin: 0 auto 15px auto;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #f26b37;
            margin-bottom: 8px;
        }

        body.dark-mode .stat-number {
            color: #ff7849;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 10px;
        }

        body.dark-mode .stat-label {
            color: #94a3b8;
        }

        /* Card Components */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            margin-bottom: 25px;
        }

        body.dark-mode .card {
            background: #2a2d3f;
            border-color: #3a3d4a;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            padding: 20px 25px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        body.dark-mode .card-header {
            background: #1f2937;
            border-bottom-color: #374151;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        body.dark-mode .card-title {
            color: #f1f5f9;
        }

        .card-body {
            padding: 25px;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            margin-bottom: 25px;
        }

        body.dark-mode .filter-section {
            background: #2a2d3f;
            border-color: #3a3d4a;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 15px;
            align-items: end;
        }

        @media (max-width: 768px) {
            .filter-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-label {
            margin-bottom: 5px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #64748b;
            display: block;
        }

        body.dark-mode .form-label {
            color: #e2e8f0;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 0.9rem;
            height: 42px;
            transition: all 0.2s ease;
            color: #1f2937;
        }

        .form-control:focus {
            border-color: #f26b37;
            box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25);
            outline: none;
        }

        body.dark-mode .form-control {
            background: #374151;
            border-color: #4b5563;
            color: #e2e8f0;
        }

        .btn-action {
            background: #f26b37;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            height: 42px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .btn-action:hover {
            background: #e55827;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3);
        }

        .btn-success {
            background: #10b981;
        }

        .btn-success:hover {
            background: #059669;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-danger {
            background: #ef4444;
        }

        .btn-danger:hover {
            background: #dc2626;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* Table Styles */
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
            border-collapse: collapse;
        }

        .table th {
            background: #f8fafc;
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border: none;
            border-bottom: 2px solid #e5e7eb;
            font-size: 0.85rem;
        }

        body.dark-mode .table th {
            background: #1f2937;
            color: #d1d5db;
            border-bottom-color: #374151;
        }

        .table td {
            padding: 15px 12px;
            border: none;
            border-bottom: 1px solid #f1f5f9;
            color: #374151;
            font-size: 0.9rem;
            vertical-align: middle;
        }

        body.dark-mode .table td {
            color: #d1d5db;
            border-bottom-color: #374151;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        body.dark-mode .table tbody tr:hover {
            background: #1f2937;
        }

        /* Status Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            display: inline-block;
            min-width: 70px;
            text-align: center;
        }

        .badge-pending {
            background: #fef3c7;
            color: #f59e0b;
        }

        .badge-approved {
            background: #dbeafe;
            color: #2563eb;
        }

        .badge-paid {
            background: #dcfce7;
            color: #15803d;
        }

        body.dark-mode .badge-pending {
            background: #92400e;
            color: #fef3c7;
        }

        body.dark-mode .badge-approved {
            background: #1e40af;
            color: #dbeafe;
        }

        body.dark-mode .badge-paid {
            background: #065f46;
            color: #dcfce7;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }
        }
    </style>

    <div class="dashboard-container">
        <!-- Header Section -->
        <div class="page-header">
            <h1><i class="fas fa-robot me-3"></i>Sistem Penggajian Otomatis</h1>
            <p>Generate dan kelola gaji karyawan secara otomatis berdasarkan kehadiran dan jabatan</p>
        </div>

        <!-- Stats Section -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-label">Total Karyawan</div>
                <div class="stat-number">{{ $stats['total_karyawan'] }}</div>
                <small style="color: #3b82f6; font-size: 0.8rem;">
                    <i class="fas fa-user-tie"></i> Aktif
                </small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-label">Pending</div>
                <div class="stat-number">{{ $stats['total_gaji_pending'] }}</div>
                <small style="color: #f59e0b; font-size: 0.8rem;">
                    <i class="fas fa-hourglass-half"></i> Menunggu
                </small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-label">Approved</div>
                <div class="stat-number">{{ $stats['total_gaji_approved'] }}</div>
                <small style="color: #2563eb; font-size: 0.8rem;">
                    <i class="fas fa-thumbs-up"></i> Disetujui
                </small>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-label">Dibayar</div>
                <div class="stat-number">{{ $stats['total_gaji_paid'] }}</div>
                <small style="color: #15803d; font-size: 0.8rem;">
                    <i class="fas fa-check-double"></i> Selesai
                </small>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form method="GET" action="{{ route('admin.penggajian-otomatis') }}">
                <div class="filter-grid">
                    <!-- Periode -->
                    <div class="form-group">
                        <label for="periode" class="form-label">
                            <i class="fas fa-calendar me-1"></i>Periode Gaji
                        </label>
                        <input type="month" id="periode" name="periode" class="form-control"
                            value="{{ $periode }}">
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status" class="form-label">
                            <i class="fas fa-filter me-1"></i>Status
                        </label>
                        <select id="status" name="status" class="form-control">
                            <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semua Status</option>
                            <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="paid" {{ $status == 'paid' ? 'selected' : '' }}>Dibayar</option>
                        </select>
                    </div>

                    <!-- Filter Button -->
                    <div class="form-group">
                        <button type="submit" class="btn-action">
                            <i class="fas fa-search"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Generate Section -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-cogs"></i>
                    Generate Gaji Otomatis
                </h5>
                <div style="display: flex; gap: 10px;">
                    <button onclick="generateGaji()" class="btn-action">
                        <i class="fas fa-magic"></i>
                        Generate Gaji
                    </button>
                    <a href="{{ route('admin.jabatan-gaji') }}" class="btn-action" style="text-decoration: none;">
                        <i class="fas fa-user-tie"></i>
                        Kelola Jabatan
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Cara Kerja Sistem:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Sistem akan menghitung gaji berdasarkan jabatan dan kehadiran karyawan</li>
                        <li>Gaji pokok dibagi berdasarkan jumlah hari kerja dalam sebulan</li>
                        <li>Bonus kehadiran diberikan per hari hadir</li>
                        <li>Potongan diberikan jika tidak mencapai minimal hari kerja</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Gaji Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-list"></i>
                    Daftar Gaji - {{ date('F Y', strtotime($periode . '-01')) }}
                </h5>
                <div style="display: flex; gap: 10px;">
                    <button onclick="bulkApprove()" class="btn-success" style="display: none;" id="bulkApproveBtn">
                        <i class="fas fa-check"></i>
                        Approve Terpilih
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if ($gajiList->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">
                                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                                    </th>
                                    <th>Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Kehadiran</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Bonus</th>
                                    <th>Potongan</th>
                                    <th>Total Gaji</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gajiList as $gaji)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="selectItem" value="{{ $gaji->id_gaji }}"
                                                onchange="toggleBulkAction()">
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center;">
                                                <div
                                                    style="width: 35px; height: 35px; background: linear-gradient(135deg, #f26b37, #e55827); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 10px; font-size: 0.8rem;">
                                                    {{ substr($gaji->karyawan->nama, 0, 2) }}
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600;">{{ $gaji->karyawan->nama }}</div>
                                                    <small style="color: #64748b;">ID:
                                                        {{ $gaji->karyawan->id_karyawan }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                style="font-weight: 600;">{{ $gaji->karyawan->jabatan->nama_jabatan ?? 'Tidak Ada' }}</span>
                                        </td>
                                        <td>
                                            <div style="font-weight: 600;">
                                                {{ $gaji->total_hari_hadir }}/{{ $gaji->total_hari_kerja }}</div>
                                            <small style="color: #64748b;">hari</small>
                                        </td>
                                        <td>
                                            <div style="color: #10b981; font-weight: 700;">Rp
                                                {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</div>
                                        </td>
                                        <td>
                                            <div style="color: #3b82f6; font-weight: 700;">Rp
                                                {{ number_format($gaji->tunjangan, 0, ',', '.') }}</div>
                                        </td>
                                        <td>
                                            <div style="color: #8b5cf6; font-weight: 700;">Rp
                                                {{ number_format($gaji->bonus, 0, ',', '.') }}</div>
                                        </td>
                                        <td>
                                            <div style="color: #ef4444; font-weight: 700;">Rp
                                                {{ number_format($gaji->potongan_absen, 0, ',', '.') }}</div>
                                        </td>
                                        <td>
                                            <div style="color: #10b981; font-weight: 700; font-size: 1rem;">Rp
                                                {{ number_format($gaji->total_gaji, 0, ',', '.') }}</div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $gaji->status }}">{{ strtoupper($gaji->status) }}</span>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 5px;">
                                                @if ($gaji->status == 'pending')
                                                    <button onclick="approveGaji({{ $gaji->id_gaji }})"
                                                        class="btn-success" style="padding: 6px 10px; font-size: 0.8rem;">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                @endif
                                                @if ($gaji->status == 'approved')
                                                    <button onclick="markAsPaid({{ $gaji->id_gaji }})" class="btn-action"
                                                        style="padding: 6px 10px; font-size: 0.8rem;">
                                                        <i class="fas fa-money-bill"></i>
                                                    </button>
                                                @endif
                                                <a href="{{ route('admin.penggajian-detail', $gaji->id_gaji) }}"
                                                    class="btn-action"
                                                    style="padding: 6px 10px; font-size: 0.8rem; text-decoration: none;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div style="margin-top: 20px;">
                        {{ $gajiList->appends(request()->query())->links() }}
                    </div>
                @else
                    <div style="text-align: center; padding: 40px;">
                        <i class="fas fa-inbox" style="font-size: 3rem; color: #64748b; margin-bottom: 15px;"></i>
                        <h4 style="color: #64748b;">Belum Ada Data Gaji</h4>
                        <p style="color: #64748b;">Klik tombol "Generate Gaji" untuk membuat gaji otomatis.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function generateGaji() {
            const periode = document.getElementById('periode').value + '-01';

            if (confirm('Apakah Anda yakin ingin generate gaji untuk periode ini?')) {
                fetch('{{ route('admin.penggajian-otomatis.generate') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            periode: periode
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat generate gaji');
                    });
            }
        }

        function approveGaji(id) {
            if (confirm('Approve gaji ini?')) {
                fetch(`/admin/penggajian-otomatis/approve/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    });
            }
        }

        function markAsPaid(id) {
            if (confirm('Tandai sebagai sudah dibayar?')) {
                fetch(`/admin/penggajian-otomatis/pay/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    });
            }
        }

        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.selectItem');

            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });

            toggleBulkAction();
        }

        function toggleBulkAction() {
            const checkboxes = document.querySelectorAll('.selectItem:checked');
            const bulkBtn = document.getElementById('bulkApproveBtn');

            if (checkboxes.length > 0) {
                bulkBtn.style.display = 'flex';
            } else {
                bulkBtn.style.display = 'none';
            }
        }

        function bulkApprove() {
            const checkboxes = document.querySelectorAll('.selectItem:checked');
            const ids = Array.from(checkboxes).map(cb => cb.value);

            if (ids.length === 0) {
                alert('Pilih minimal satu gaji');
                return;
            }

            if (confirm(`Approve ${ids.length} gaji terpilih?`)) {
                fetch('{{ route('admin.penggajian-otomatis.approve') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            ids: ids
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    });
            }
        }
    </script>

@endsection
