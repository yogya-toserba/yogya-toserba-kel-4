@extends('layouts.karyawan')

@section('title', 'Sistem Absensi Karyawan')

@push('styles')
    <style>
        .search-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .karyawan-info {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            margin: 0 auto 20px;
        }

        .action-buttons {
            gap: 15px;
        }

        .btn-absen {
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 15px;
            transition: all 0.3s ease;
            min-width: 150px;
        }

        .btn-absen:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .status-info {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .riwayat-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px;
            margin-top: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            font-weight: 600;
        }

        .badge-status {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-hadir {
            background-color: #d4edda;
            color: #155724;
        }

        .status-alfa {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-izin {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-sakit {
            background-color: #e2e3e5;
            color: #383d41;
        }
    </style>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Welcome Section -->
            <div class="text-center text-white mb-4">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="fas fa-clock me-3"></i>Sistem Absensi Karyawan
                </h1>
                <p class="lead">Silakan masukkan ID atau nama Anda untuk melakukan absensi</p>
            </div>

            <!-- Search Karyawan -->
            <div class="search-card">
                <h5 class="text-center mb-4">
                    <i class="fas fa-search me-2"></i>Cari Data Karyawan
                </h5>
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" id="searchKaryawan"
                        placeholder="Masukkan ID Karyawan atau Nama..." autocomplete="off">
                    <button class="btn btn-primary" type="button" id="btnCari">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                </div>
                <div id="searchResults" class="mt-3"></div>
            </div>

            <!-- Info Karyawan -->
            <div class="karyawan-info" id="karyawanInfo">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <div class="avatar" id="karyawanAvatar">AB</div>
                    </div>
                    <div class="col-md-9">
                        <h4 id="karyawanNama" class="fw-bold mb-2">-</h4>
                        <p class="mb-1"><strong>ID:</strong> <span id="karyawanId">-</span></p>
                        <p class="mb-1"><strong>Jabatan:</strong> <span id="karyawanJabatan">-</span></p>
                        <p class="mb-3"><strong>Divisi:</strong> <span id="karyawanDivisi">-</span></p>

                        <!-- Current Time Display -->
                        <div class="clock-display" id="mainClock"></div>
                        <div class="date-display" id="currentDate"></div>
                    </div>
                </div>
            </div>

            <!-- Status Absensi Hari Ini -->
            <div class="status-info" id="statusInfo">
                <h5 class="text-center mb-4">
                    <i class="fas fa-calendar-day me-2"></i>Status Absensi Hari Ini
                </h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="status-card">
                            <div class="status-icon status-checkin">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <h6>Check In</h6>
                            <p id="jamMasuk" class="fw-bold">--:--</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="status-card">
                            <div class="status-icon status-checkout">
                                <i class="fas fa-sign-out-alt"></i>
                            </div>
                            <h6>Check Out</h6>
                            <p id="jamKeluar" class="fw-bold">--:--</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="status-card">
                            <div class="status-icon status-break">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h6>Durasi Kerja</h6>
                            <p id="durasiKerja" class="fw-bold">-- jam</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center action-buttons d-none" id="actionButtons">
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <button class="btn btn-success btn-absen" id="btnCheckIn">
                        <i class="fas fa-sign-in-alt me-2"></i>Check In
                    </button>
                    <button class="btn btn-danger btn-absen" id="btnCheckOut">
                        <i class="fas fa-sign-out-alt me-2"></i>Check Out
                    </button>
                    <button class="btn btn-info btn-absen" id="btnRiwayat">
                        <i class="fas fa-history me-2"></i>Lihat Riwayat
                    </button>
                </div>
            </div>

            <!-- Riwayat Absensi -->
            <div class="riwayat-section" id="riwayatSection">
                <h5 class="mb-4">
                    <i class="fas fa-history me-2"></i>Riwayat Absensi Bulan Ini
                </h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Status</th>
                                <th>Durasi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="riwayatTable">
                            <!-- Data will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Keterangan -->
    <div class="modal fade" id="keteranganModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Keterangan Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="keteranganText" rows="3" placeholder="Masukkan keterangan (opsional)..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnKonfirmasi">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let selectedKaryawan = null;
        let currentAction = null;

        // Update main clock
        function updateMainClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            const dateString = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            $('#mainClock').text(timeString);
            $('#currentDate').text(dateString);
        }

        setInterval(updateMainClock, 1000);
        updateMainClock();

        // Search karyawan
        $('#searchKaryawan, #btnCari').on('keypress click', function(e) {
            if (e.type === 'keypress' && e.which !== 13) return;

            const search = $('#searchKaryawan').val().trim();
            if (search.length < 2) {
                $('#searchResults').html('<div class="alert alert-warning">Masukkan minimal 2 karakter</div>');
                return;
            }

            $.get('{{ route('karyawan.cari') }}', {
                    search: search
                })
                .done(function(response) {
                    if (response.success && response.data.length > 0) {
                        let html = '<div class="list-group">';
                        response.data.forEach(function(karyawan) {
                            html += `
                        <a href="#" class="list-group-item list-group-item-action select-karyawan"
                           data-id="${karyawan.id_karyawan}"
                           data-nama="${karyawan.nama}"
                           data-jabatan="${karyawan.jabatan ? karyawan.jabatan.nama_jabatan : 'N/A'}"
                           data-divisi="${karyawan.divisi || 'N/A'}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">${karyawan.nama}</h6>
                                    <small>ID: ${karyawan.id_karyawan} | ${karyawan.jabatan ? karyawan.jabatan.nama_jabatan : 'N/A'}</small>
                                </div>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                    `;
                        });
                        html += '</div>';
                        $('#searchResults').html(html);
                    } else {
                        $('#searchResults').html(
                        '<div class="alert alert-info">Karyawan tidak ditemukan</div>');
                    }
                })
                .fail(function() {
                    $('#searchResults').html(
                        '<div class="alert alert-danger">Terjadi kesalahan saat mencari data</div>');
                });
        });

        // Select karyawan
        $(document).on('click', '.select-karyawan', function(e) {
            e.preventDefault();

            selectedKaryawan = {
                id: $(this).data('id'),
                nama: $(this).data('nama'),
                jabatan: $(this).data('jabatan'),
                divisi: $(this).data('divisi')
            };

            // Update UI
            $('#karyawanAvatar').text(selectedKaryawan.nama.substring(0, 2).toUpperCase());
            $('#karyawanNama').text(selectedKaryawan.nama);
            $('#karyawanId').text(selectedKaryawan.id);
            $('#karyawanJabatan').text(selectedKaryawan.jabatan);
            $('#karyawanDivisi').text(selectedKaryawan.divisi);

            // Show karyawan info
            $('#karyawanInfo').slideDown();
            $('#actionButtons').removeClass('d-none');

            // Load status hari ini
            loadStatusHariIni();
        });

        // Load status hari ini
        function loadStatusHariIni() {
            if (!selectedKaryawan) return;

            $.get('{{ route('karyawan.absensi.status') }}', {
                    id_karyawan: selectedKaryawan.id
                })
                .done(function(response) {
                    if (response.success) {
                        const data = response.data;

                        // Update status display
                        if (data.absensi) {
                            $('#jamMasuk').text(data.absensi.jam_masuk ?
                                new Date('2000-01-01 ' + data.absensi.jam_masuk).toLocaleTimeString('id-ID', {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                }) :
                                '--:--');
                            $('#jamKeluar').text(data.absensi.jam_keluar ?
                                new Date('2000-01-01 ' + data.absensi.jam_keluar).toLocaleTimeString('id-ID', {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                }) :
                                '--:--');
                            $('#durasiKerja').text(data.absensi.durasi_kerja_jam ?
                                data.absensi.durasi_kerja_jam + ' jam' :
                                '-- jam');
                        }

                        // Update button states
                        $('#btnCheckIn').prop('disabled', data.sudah_checkin);
                        $('#btnCheckOut').prop('disabled', !data.sudah_checkin || data.sudah_checkout);

                        $('#statusInfo').slideDown();
                    }
                });
        }

        // Check In
        $('#btnCheckIn').click(function() {
            if (!selectedKaryawan) return;

            currentAction = 'checkin';
            $('#keteranganModal .modal-title').text('Check In - Keterangan');
            $('#keteranganModal').modal('show');
        });

        // Check Out
        $('#btnCheckOut').click(function() {
            if (!selectedKaryawan) return;

            currentAction = 'checkout';
            $('#keteranganModal .modal-title').text('Check Out - Keterangan');
            $('#keteranganModal').modal('show');
        });

        // Konfirmasi absensi
        $('#btnKonfirmasi').click(function() {
            if (!selectedKaryawan || !currentAction) return;

            const keterangan = $('#keteranganText').val();
            const url = currentAction === 'checkin' ?
                '{{ route('karyawan.absensi.checkin') }}' :
                '{{ route('karyawan.absensi.checkout') }}';

            $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Memproses...');

            $.post(url, {
                    id_karyawan: selectedKaryawan.id,
                    keterangan: keterangan
                })
                .done(function(response) {
                    $('#keteranganModal').modal('hide');

                    if (response.success) {
                        alert('✅ ' + response.message);
                        loadStatusHariIni(); // Refresh status
                    } else {
                        alert('❌ ' + response.message);
                    }
                })
                .fail(function() {
                    alert('❌ Terjadi kesalahan saat memproses absensi');
                })
                .always(function() {
                    $('#btnKonfirmasi').prop('disabled', false).text('Konfirmasi');
                    $('#keteranganText').val('');
                    currentAction = null;
                });
        });

        // Lihat riwayat
        $('#btnRiwayat').click(function() {
            if (!selectedKaryawan) return;

            $.get('{{ route('karyawan.absensi.riwayat') }}', {
                    id_karyawan: selectedKaryawan.id
                })
                .done(function(response) {
                    if (response.success) {
                        let html = '';
                        response.data.riwayat.forEach(function(item) {
                            const tanggal = new Date(item.tanggal).toLocaleDateString('id-ID');
                            const jamMasuk = item.jam_masuk ?
                                new Date('2000-01-01 ' + item.jam_masuk).toLocaleTimeString('id-ID', {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                }) :
                                '--:--';
                            const jamKeluar = item.jam_keluar ?
                                new Date('2000-01-01 ' + item.jam_keluar).toLocaleTimeString('id-ID', {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                }) :
                                '--:--';

                            let statusClass = 'status-hadir';
                            if (item.status.toLowerCase().includes('alfa') || item.status.toLowerCase()
                                .includes('alpa')) {
                                statusClass = 'status-alfa';
                            } else if (item.status.toLowerCase().includes('izin')) {
                                statusClass = 'status-izin';
                            } else if (item.status.toLowerCase().includes('sakit')) {
                                statusClass = 'status-sakit';
                            }

                            html += `
                        <tr>
                            <td>${tanggal}</td>
                            <td>${jamMasuk}</td>
                            <td>${jamKeluar}</td>
                            <td><span class="badge-status ${statusClass}">${item.status}</span></td>
                            <td>${item.durasi_kerja_jam ? item.durasi_kerja_jam + ' jam' : '--'}</td>
                            <td>${item.keterangan || '--'}</td>
                        </tr>
                    `;
                        });

                        $('#riwayatTable').html(html);
                        $('#riwayatSection').slideDown();
                    }
                });
        });
    </script>
@endpush
