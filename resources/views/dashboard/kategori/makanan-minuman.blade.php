@extends('layouts.app')

@section('title', 'Makanan & Minuman - Yogya Toserba')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Kategori -->
    <div class="mb-8">
        <nav class="text-sm breadcrumbs mb-4">
            <ul class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600">Home</a></li>
                <li class="before:content-['/'] before:mx-2">Makanan & Minuman</li>
            </ul>
        </nav>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Makanan & Minuman</h1>
        <p class="text-gray-600">Produk makanan dan minuman segar berkualitas untuk keluarga</p>
    </div>

    <!-- Filter & Sort -->
    <div class="bg-white rounded-lg shadow-sm border p-4 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-4">
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option>Semua Kategori</option>
                    <option>Makanan Instan</option>
                    <option>Snack & Cemilan</option>
                    <option>Minuman</option>
                    <option>Bumbu & Rempah</option>
                    <option>Beras & Biji-bijian</option>
                </select>
                
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option>Urutkan</option>
                    <option>Harga Terendah</option>
                    <option>Harga Tertinggi</option>
                    <option>Terpopuler</option>
                    <option>Terbaru</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <!-- Sample Products -->
        @foreach([
            [
                'name' => 'Indomie Mi Ayam Bawang 5 Pcs',
                'price' => 'Rp 12.500',
                'original_price' => 'Rp 15.000',
                'discount' => '17%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Indomie',
                'rating' => 4.8,
                'reviews' => 1245
            ],
            [
                'name' => 'Teh Botol Sosro 500ml',
                'price' => 'Rp 4.500',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Teh+Botol',
                'rating' => 4.6,
                'reviews' => 892
            ],
            [
                'name' => 'Beras Premium 5kg',
                'price' => 'Rp 65.000',
                'original_price' => 'Rp 75.000',
                'discount' => '13%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Beras+5kg',
                'rating' => 4.7,
                'reviews' => 456
            ],
            [
                'name' => 'Aqua Botol 600ml 24 Pcs',
                'price' => 'Rp 48.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Aqua+24pcs',
                'rating' => 4.9,
                'reviews' => 678
            ],
            [
                'name' => 'Chitato Rasa Sapi Panggang',
                'price' => 'Rp 8.500',
                'original_price' => 'Rp 10.000',
                'discount' => '15%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Chitato',
                'rating' => 4.5,
                'reviews' => 234
            ],
            [
                'name' => 'Kopi Kapal Api Special Mix',
                'price' => 'Rp 18.500',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kopi+Mix',
                'rating' => 4.6,
                'reviews' => 345
            ]
        ] as $product)
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden group hover:shadow-lg transition-all duration-300">
            <div class="relative">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-48 object-cover">
                @if($product['discount'])
                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-{{ $product['discount'] }}</span>
                @endif
                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-50">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="p-4">
                <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $product['name'] }}</h3>
                
                <div class="flex items-center mb-2">
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= floor($product['rating']) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600 ml-2">({{ $product['reviews'] }})</span>
                </div>
                
                <div class="mb-3">
                    <span class="text-lg font-bold text-blue-600">{{ $product['price'] }}</span>
                    @if($product['original_price'])
                    <span class="text-sm text-gray-500 line-through ml-2">{{ $product['original_price'] }}</span>
                    @endif
                </div>
                
                <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                    Tambah ke Keranjang
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        <nav class="flex space-x-2">
            <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">Previous</button>
            <button class="px-3 py-2 bg-blue-600 text-white rounded-lg">1</button>
            <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">2</button>
            <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">3</button>
            <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">Next</button>
        </nav>
    </div>
</div>
@endsection
