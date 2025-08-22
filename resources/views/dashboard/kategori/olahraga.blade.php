@extends('layouts.app')

@section('title', 'Olahraga - Yogya Toserba')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Kategori -->
    <div class="mb-8">
        <nav class="text-sm breadcrumbs mb-4">
            <ul class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600">Home</a></li>
                <li class="before:content-['/'] before:mx-2">Olahraga</li>
            </ul>
        </nav>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Olahraga</h1>
        <p class="text-gray-600">Perlengkapan olahraga untuk gaya hidup aktif dan sehat</p>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach([
            [
                'name' => 'Matras Yoga Anti Slip',
                'price' => 'Rp 89.000',
                'original_price' => 'Rp 120.000',
                'discount' => '26%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Yoga+Mat',
                'rating' => 4.6,
                'reviews' => 245
            ],
            [
                'name' => 'Dumbell Set 5kg',
                'price' => 'Rp 199.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Dumbell',
                'rating' => 4.7,
                'reviews' => 167
            ],
            [
                'name' => 'Sepatu Running Profesional',
                'price' => 'Rp 389.000',
                'original_price' => 'Rp 450.000',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Running+Shoes',
                'rating' => 4.8,
                'reviews' => 134
            ]
        ] as $product)
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden group hover:shadow-lg transition-all duration-300">
            <div class="relative">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-48 object-cover">
                @if($product['discount'])
                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-{{ $product['discount'] }}</span>
                @endif
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
</div>
@endsection
