<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Yogya Toserba')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <!-- Top Bar -->
            <div class="flex items-center justify-between py-2 text-sm text-gray-600 border-b">
                <div class="flex items-center space-x-4">
                    <span>📞 Customer Service: 0800-1-500-500</span>
                    <span>📧 info@yogyatoserba.com</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('pelanggan.login') }}" class="hover:text-blue-600">Masuk</a>
                    <span>|</span>
                    <a href="{{ route('pelanggan.register') }}" class="hover:text-blue-600">Daftar</a>
                </div>
            </div>
            
            <!-- Main Header -->
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-blue-600">
                    🏪 Yogya Toserba
                </a>
                
                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl mx-8">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Cari produk, merek, atau kategori..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 text-white px-4 py-1 rounded">
                            🔍
                        </button>
                    </div>
                </div>
                
                <!-- Cart & User -->
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-gray-600 hover:text-blue-600">
                        🛒
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                    </button>
                    <button class="p-2 text-gray-600 hover:text-blue-600">
                        👤
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="bg-blue-600 text-white">
            <div class="container mx-auto px-4">
                <div class="flex items-center space-x-8 py-3">
                    <a href="{{ route('dashboard') }}" class="hover:bg-blue-700 px-3 py-2 rounded">🏠 Beranda</a>
                    
                    <!-- Dropdown Kategori -->
                    <div class="relative group">
                        <button class="hover:bg-blue-700 px-3 py-2 rounded flex items-center">
                            📂 Kategori
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-1 w-64 bg-white text-black shadow-lg rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="{{ route('kategori.elektronik') }}" class="block px-4 py-2 hover:bg-gray-100">📱 Elektronik</a>
                                <a href="{{ route('kategori.fashion') }}" class="block px-4 py-2 hover:bg-gray-100">👕 Fashion</a>
                                <a href="{{ route('kategori.makanan-minuman') }}" class="block px-4 py-2 hover:bg-gray-100">🍔 Makanan & Minuman</a>
                                <a href="{{ route('kategori.kesehatan-kecantikan') }}" class="block px-4 py-2 hover:bg-gray-100">💄 Kesehatan & Kecantikan</a>
                                <a href="{{ route('kategori.rumah-tangga') }}" class="block px-4 py-2 hover:bg-gray-100">🏠 Rumah Tangga</a>
                                <a href="{{ route('kategori.olahraga') }}" class="block px-4 py-2 hover:bg-gray-100">⚽ Olahraga</a>
                                <a href="{{ route('kategori.otomotif') }}" class="block px-4 py-2 hover:bg-gray-100">🚗 Otomotif</a>
                                <a href="{{ route('kategori.buku') }}" class="block px-4 py-2 hover:bg-gray-100">📚 Buku & Alat Tulis</a>
                                <a href="{{ route('kategori.perawatan') }}" class="block px-4 py-2 hover:bg-gray-100">🧴 Perawatan Pribadi</a>
                            </div>
                        </div>
                    </div>
                    
                    <a href="#" class="hover:bg-blue-700 px-3 py-2 rounded">🔥 Promo</a>
                    <a href="#" class="hover:bg-blue-700 px-3 py-2 rounded">⭐ Terlaris</a>
                    <a href="#" class="hover:bg-blue-700 px-3 py-2 rounded">📞 Bantuan</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Yogya Toserba</h3>
                    <p class="text-gray-300 mb-4">Toko serba ada terpercaya dengan produk berkualitas dan pelayanan terbaik untuk keluarga Indonesia.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-400 hover:text-blue-300">📘</a>
                        <a href="#" class="text-blue-400 hover:text-blue-300">📷</a>
                        <a href="#" class="text-blue-400 hover:text-blue-300">🐦</a>
                    </div>
                </div>
                
                <!-- Customer Service -->
                <div>
                    <h4 class="font-semibold mb-4">Layanan Pelanggan</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-white">Cara Berbelanja</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                
                <!-- About -->
                <div>
                    <h4 class="font-semibold mb-4">Tentang Kami</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Profil Perusahaan</a></li>
                        <li><a href="#" class="hover:text-white">Karir</a></li>
                        <li><a href="#" class="hover:text-white">Blog</a></li>
                        <li><a href="#" class="hover:text-white">Investor</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <div class="space-y-2 text-gray-300">
                        <p>📞 0800-1-500-500</p>
                        <p>📧 info@yogyatoserba.com</p>
                        <p>📍 Jl. Malioboro No. 123, Yogyakarta</p>
                        <p>🕒 24 Jam (CS Online)</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; 2025 Yogya Toserba. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Simple cart functionality
        function addToCart(productId) {
            // Add to cart logic here
            alert('Produk berhasil ditambahkan ke keranjang!');
        }
    </script>
</body>
</html>
