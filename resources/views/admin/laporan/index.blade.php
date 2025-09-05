<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Yogya Toserba</title>
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
                        <h1 class="text-xl font-semibold text-gray-900">Laporan Sistem</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <!-- Dashboard Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Laporan Keuangan -->
                    <a href="{{ route('admin.laporan.keuangan') }}"
                        class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                        <i class="fas fa-chart-line text-white"></i>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Laporan Keuangan
                                        </dt>
                                        <dd class="text-lg font-medium text-gray-900">
                                            Pendapatan & Pengeluaran
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Laporan Gaji -->
                    <a href="{{ route('admin.laporan.gaji') }}"
                        class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                        <i class="fas fa-money-bill-wave text-white"></i>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Laporan Gaji
                                        </dt>
                                        <dd class="text-lg font-medium text-gray-900">
                                            Detail & Statistik Gaji
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Laporan Absensi -->
                    <a href="{{ route('admin.laporan.absensi') }}"
                        class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                        <i class="fas fa-calendar-check text-white"></i>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Laporan Absensi
                                        </dt>
                                        <dd class="text-lg font-medium text-gray-900">
                                            Kehadiran Karyawan
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Laporan Karyawan -->
                    <a href="{{ route('admin.laporan.karyawan') }}"
                        class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                        <i class="fas fa-users text-white"></i>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Laporan Karyawan
                                        </dt>
                                        <dd class="text-lg font-medium text-gray-900">
                                            Data Karyawan
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                            Ringkasan Laporan
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="text-center">
                                <i class="fas fa-file-alt text-3xl text-blue-500 mb-2"></i>
                                <p class="text-sm text-gray-600">Total Laporan</p>
                                <p class="text-2xl font-bold text-gray-900">4</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-calendar text-3xl text-green-500 mb-2"></i>
                                <p class="text-sm text-gray-600">Periode Aktif</p>
                                <p class="text-2xl font-bold text-gray-900">{{ date('M Y') }}</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-download text-3xl text-purple-500 mb-2"></i>
                                <p class="text-sm text-gray-600">Format Export</p>
                                <p class="text-2xl font-bold text-gray-900">CSV, Excel</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Help Section -->
                <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">
                                Panduan Laporan
                            </h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li><strong>Laporan Keuangan:</strong> Melihat pendapatan dari transaksi dan
                                        pengeluaran gaji</li>
                                    <li><strong>Laporan Gaji:</strong> Detail penggajian per periode dan jabatan</li>
                                    <li><strong>Laporan Absensi:</strong> Data kehadiran dan ketidakhadiran karyawan
                                    </li>
                                    <li><strong>Laporan Karyawan:</strong> Informasi lengkap data karyawan aktif dan
                                        non-aktif</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
