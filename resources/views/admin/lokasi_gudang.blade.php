<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Gudang - Yogya Toserba</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-gray-900">Lokasi Gudang</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>Tambah Gudang
                        </button>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                            <i class="fas fa-map-marker-alt mr-2"></i>Lihat Peta
                        </button>
                        <button class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">
                            <i class="fas fa-download mr-2"></i>Export
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <!-- Statistik Gudang -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-warehouse text-2xl text-blue-500"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total Gudang</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ $stats['total_gudang'] }}
                                            lokasi</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-2xl text-green-500"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Gudang Aktif</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ $stats['gudang_aktif'] }}
                                            lokasi</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-times-circle text-2xl text-red-500"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Gudang Non-aktif</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ $stats['gudang_nonaktif'] }}
                                            lokasi</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-boxes text-2xl text-yellow-500"></i>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Kapasitas Total</dt>
                                        <dd class="text-lg font-medium text-gray-900">
                                            {{ number_format($stats['kapasitas_total'], 0, ',', '.') }} m³</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart Distribusi per Cabang -->
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Distribusi Gudang per Cabang</h3>
                        <canvas id="cabangChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Filter dan Search -->
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex space-x-4">
                            <div class="flex-1">
                                <input type="text" id="searchInput" placeholder="Cari nama gudang atau alamat..."
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <select id="statusFilter"
                                    class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Status</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Non-aktif</option>
                                </select>
                            </div>
                            <div>
                                <select id="cabangFilter"
                                    class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Cabang</option>
                                    @foreach ($gudangByCabang as $cabang)
                                        <option value="{{ $cabang['cabang'] }}">{{ $cabang['cabang'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid Cards Gudang -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    @forelse($gudangList as $gudang)
                        <div class="bg-white shadow rounded-lg overflow-hidden gudang-card"
                            data-nama="{{ strtolower($gudang->nama_gudang) }}" data-status="{{ $gudang->status }}"
                            data-cabang="{{ $gudang->nama_cabang }}">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-warehouse text-2xl text-blue-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $gudang->nama_gudang }}
                                            </h3>
                                            <p class="text-sm text-gray-500">ID: {{ $gudang->id_gudang }}</p>
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full {{ $gudang->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($gudang->status) }}
                                    </span>
                                </div>

                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt text-gray-400 w-4 h-4"></i>
                                        <span
                                            class="ml-2 text-sm text-gray-600">{{ $gudang->alamat ?? 'Alamat tidak tersedia' }}</span>
                                    </div>

                                    <div class="flex items-center">
                                        <i class="fas fa-building text-gray-400 w-4 h-4"></i>
                                        <span
                                            class="ml-2 text-sm text-gray-600">{{ $gudang->nama_cabang ?? 'Pusat' }}</span>
                                    </div>

                                    <div class="flex items-center">
                                        <i class="fas fa-boxes text-gray-400 w-4 h-4"></i>
                                        <span class="ml-2 text-sm text-gray-600">Kapasitas:
                                            {{ number_format($gudang->kapasitas ?? 0, 0, ',', '.') }} m³</span>
                                    </div>

                                    @if ($gudang->deskripsi)
                                        <div class="flex items-start">
                                            <i class="fas fa-info-circle text-gray-400 w-4 h-4 mt-0.5"></i>
                                            <span class="ml-2 text-sm text-gray-600">{{ $gudang->deskripsi }}</span>
                                        </div>
                                    @endif

                                    @if ($gudang->telepon)
                                        <div class="flex items-center">
                                            <i class="fas fa-phone text-gray-400 w-4 h-4"></i>
                                            <span class="ml-2 text-sm text-gray-600">{{ $gudang->telepon }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-6 flex space-x-3">
                                    <button
                                        class="flex-1 bg-blue-600 text-white px-3 py-2 rounded-md text-sm hover:bg-blue-700">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </button>
                                    <button
                                        class="flex-1 bg-yellow-600 text-white px-3 py-2 rounded-md text-sm hover:bg-yellow-700">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <button
                                        class="bg-gray-600 text-white px-3 py-2 rounded-md text-sm hover:bg-gray-700">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <i class="fas fa-warehouse text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Tidak ada data gudang</p>
                        </div>
                    @endforelse
                </div>

                <!-- Tabel Detail Gudang -->
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Lokasi Gudang</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200" id="gudangTable">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Gudang</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Cabang</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Alamat</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kapasitas</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Telepon</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($gudangList as $gudang)
                                        <tr class="gudang-row" data-nama="{{ strtolower($gudang->nama_gudang) }}"
                                            data-status="{{ $gudang->status }}"
                                            data-cabang="{{ $gudang->nama_cabang }}">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $gudang->id_gudang }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $gudang->nama_gudang }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $gudang->nama_cabang ?? 'Pusat' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $gudang->alamat ?? 'Alamat tidak tersedia' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ number_format($gudang->kapasitas ?? 0, 0, ',', '.') }} m³
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $gudang->telepon ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold rounded-full {{ $gudang->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ ucfirst($gudang->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <button class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="text-yellow-600 hover:text-yellow-900">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="text-green-600 hover:text-green-900">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan per Cabang -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Ringkasan per Cabang</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($gudangByCabang as $cabang)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $cabang['cabang'] }}</h4>
                                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                            {{ $cabang['jumlah'] }} gudang
                                        </span>
                                    </div>
                                    <div class="space-y-1">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Gudang Aktif:</span>
                                            <span
                                                class="text-green-600 font-medium">{{ $cabang['gudang_aktif'] }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Total Kapasitas:</span>
                                            <span
                                                class="text-gray-900 font-medium">{{ number_format($cabang['kapasitas_total'], 0, ',', '.') }}
                                                m³</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Chart Distribusi per Cabang
        const ctx = document.getElementById('cabangChart').getContext('2d');
        const cabangChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($gudangByCabang as $cabang)
                        '{{ $cabang['cabang'] }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Jumlah Gudang',
                    data: [
                        @foreach ($gudangByCabang as $cabang)
                            {{ $cabang['jumlah'] }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' gudang';
                            }
                        }
                    }
                }
            }
        });

        // Filter dan Search functionality
        document.getElementById('searchInput').addEventListener('keyup', filterGudang);
        document.getElementById('statusFilter').addEventListener('change', filterGudang);
        document.getElementById('cabangFilter').addEventListener('change', filterGudang);

        function filterGudang() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const statusValue = document.getElementById('statusFilter').value;
            const cabangValue = document.getElementById('cabangFilter').value;

            // Filter cards
            const cards = document.querySelectorAll('.gudang-card');
            cards.forEach(card => {
                const nama = card.getAttribute('data-nama');
                const status = card.getAttribute('data-status');
                const cabang = card.getAttribute('data-cabang');

                let showCard = true;

                // Filter by search
                if (searchValue && !nama.includes(searchValue)) {
                    showCard = false;
                }

                // Filter by status
                if (statusValue && status !== statusValue) {
                    showCard = false;
                }

                // Filter by cabang
                if (cabangValue && cabang !== cabangValue) {
                    showCard = false;
                }

                card.style.display = showCard ? '' : 'none';
            });

            // Filter table rows
            const rows = document.querySelectorAll('.gudang-row');
            rows.forEach(row => {
                const nama = row.getAttribute('data-nama');
                const status = row.getAttribute('data-status');
                const cabang = row.getAttribute('data-cabang');

                let showRow = true;

                // Filter by search
                if (searchValue && !nama.includes(searchValue)) {
                    showRow = false;
                }

                // Filter by status
                if (statusValue && status !== statusValue) {
                    showRow = false;
                }

                // Filter by cabang
                if (cabangValue && cabang !== cabangValue) {
                    showRow = false;
                }

                row.style.display = showRow ? '' : 'none';
            });
        }
    </script>
</body>

</html>
