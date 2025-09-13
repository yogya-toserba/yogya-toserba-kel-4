<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Fashion Products
            [
                'name' => 'Kemeja Formal Pria Premium Cotton',
                'description' => 'Kemeja formal premium dengan bahan 100% katun berkualitas tinggi. Desain slim fit yang elegan, cocok untuk acara formal maupun kantor. Tersedia dalam berbagai ukuran dan warna. Mudah dirawat dan tahan lama.',
                'price' => 299000,
                'original_price' => 399000,
                'discount_percentage' => 25,
                'image' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80',
                    'https://images.unsplash.com/photo-1621072156002-e2fccdc0b176?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'https://images.unsplash.com/photo-1583743814966-8936f37f536c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                ],
                'category' => 'fashion',
                'subcategory' => 'pakaian-pria',
                'rating' => 4.7,
                'reviews_count' => 156,
                'stock' => 50,
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'colors' => ['Putih', 'Biru', 'Hitam', 'Abu-abu'],
                'features' => [
                    'Kualitas Premium',
                    'Bahan 100% Katun',
                    'Slim Fit Design',
                    'Mudah Dirawat',
                    'Garansi Resmi'
                ]
            ],
            [
                'name' => 'Dress Wanita Elegant Korean Style',
                'description' => 'Dress wanita dengan gaya Korean yang elegan dan trendy. Bahan berkualitas premium yang nyaman digunakan sehari-hari. Model A-line yang flattering untuk semua bentuk tubuh.',
                'price' => 159000,
                'original_price' => 219000,
                'discount_percentage' => 27,
                'image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                ],
                'category' => 'fashion',
                'subcategory' => 'pakaian-wanita',
                'rating' => 4.8,
                'reviews_count' => 243,
                'stock' => 30,
                'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
                'colors' => ['Pink', 'Putih', 'Hitam', 'Navy'],
                'features' => [
                    'Korean Style Design',
                    'A-line Cut',
                    'Premium Material',
                    'Comfortable Fit',
                    'Trendy & Elegant'
                ]
            ],
            [
                'name' => 'Sepatu Sneakers Pria Casual Sport',
                'description' => 'Sepatu sneakers pria dengan teknologi cushioning terdepan untuk kenyamanan maksimal. Sol anti-slip dan breathable material. Cocok untuk olahraga ringan dan aktivitas sehari-hari.',
                'price' => 449000,
                'original_price' => null,
                'discount_percentage' => null,
                'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                ],
                'category' => 'fashion',
                'subcategory' => 'sepatu',
                'rating' => 4.6,
                'reviews_count' => 189,
                'stock' => 25,
                'sizes' => ['39', '40', '41', '42', '43', '44'],
                'colors' => ['Hitam', 'Putih', 'Abu-abu', 'Navy'],
                'features' => [
                    'Cushioning Technology',
                    'Anti-slip Sole',
                    'Breathable Material',
                    'Casual & Sport Design',
                    'Comfortable Padding'
                ]
            ],
            [
                'name' => 'Tas Wanita Kulit Premium',
                'description' => 'Tas wanita dengan bahan kulit premium berkualitas tinggi. Desain elegan dan modern dengan kompartemen yang praktis. Cocok untuk acara formal maupun casual.',
                'price' => 329000,
                'original_price' => 429000,
                'discount_percentage' => 23,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                ],
                'category' => 'fashion',
                'subcategory' => 'tas-dan-dompet',
                'rating' => 4.9,
                'reviews_count' => 98,
                'stock' => 15,
                'sizes' => ['Small', 'Medium', 'Large'],
                'colors' => ['Hitam', 'Coklat', 'Navy', 'Abu-abu'],
                'features' => [
                    'Kulit Premium',
                    'Desain Elegan',
                    'Multi Kompartemen',
                    'Tahan Lama',
                    'Cocok Segala Acara'
                ]
            ],

            // Elektronik Products
            [
                'name' => 'Smartphone Android Flagship 256GB',
                'description' => 'Smartphone flagship dengan performa tinggi, kamera profesional, dan baterai tahan lama. Cocok untuk gaming, fotografi, dan produktivitas.',
                'price' => 8999000,
                'original_price' => 9999000,
                'discount_percentage' => 10,
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                ],
                'category' => 'elektronik',
                'subcategory' => 'smartphone',
                'rating' => 4.8,
                'reviews_count' => 567,
                'stock' => 15,
                'sizes' => ['128GB', '256GB', '512GB'],
                'colors' => ['Hitam', 'Putih', 'Biru', 'Pink'],
                'features' => [
                    '256GB Storage',
                    '12GB RAM',
                    'Triple Camera 108MP',
                    '5000mAh Battery',
                    '5G Ready'
                ]
            ],

            // Makanan Products  
            [
                'name' => 'Kopi Arabica Premium 250gr',
                'description' => 'Kopi arabica premium dengan cita rasa yang khas dan aroma yang menggugah selera. Dipanen dari kebun kopi terbaik di Indonesia.',
                'price' => 125000,
                'original_price' => 150000,
                'discount_percentage' => 17,
                'image' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                ],
                'category' => 'makanan',
                'subcategory' => 'minuman',
                'rating' => 4.9,
                'reviews_count' => 234,
                'stock' => 100,
                'sizes' => ['250gr', '500gr', '1kg'],
                'colors' => null,
                'features' => [
                    '100% Arabica',
                    'Single Origin',
                    'Medium Roast',
                    'Premium Quality',
                    'Fresh Roasted'
                ]
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}