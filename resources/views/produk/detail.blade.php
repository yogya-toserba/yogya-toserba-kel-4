@extends('layouts.app')

@section('title', 'Detail Produk - MyYOGYA')

@section('content')
<!-- Product Detail Header -->
<div class="product-detail-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('kategori.fashion') }}">Fashion</a>
            <span class="mx-2">/</span>
            <span id="productName">Detail Produk</span>
        </nav>
    </div>
</div>

<div class="container">
    <div class="product-detail-container">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6">
                <div class="product-images">
                    <!-- Main Image -->
                    <div class="main-image">
                        <img id="mainProductImage" src="" alt="" class="img-fluid">
                        <div class="image-zoom-overlay">
                            <i class="fas fa-search-plus"></i>
                        </div>
                    </div>
                    
                    <!-- Thumbnail Images -->
                    <div class="thumbnail-images">
                        <div class="thumbnail active" data-image="">
                            <img src="" alt="">
                        </div>
                        <div class="thumbnail" data-image="">
                            <img src="" alt="">
                        </div>
                        <div class="thumbnail" data-image="">
                            <img src="" alt="">
                        </div>
                        <div class="thumbnail" data-image="">
                            <img src="" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="product-info-detail">
                    <!-- Product Title & Rating -->
                    <div class="product-header">
                        <h1 id="productTitle" class="product-title"></h1>
                        <div class="product-meta">
                            <div class="rating-section">
                                <div class="stars" id="productStars">
                                    <!-- Stars will be populated by JavaScript -->
                                </div>
                                <span class="rating-text">(<span id="productRating">4.7</span>) | <span id="productReviews">156</span> ulasan | <span id="productSold">2.3k</span> terjual</span>
                            </div>
                            <div class="product-sku">
                                SKU: <span id="productSku">FASH-001</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Price Section -->
                    <div class="price-section">
                        <div class="current-price">
                            <span id="currentPrice">Rp 299.000</span>
                            <span id="originalPrice" class="original-price">Rp 399.000</span>
                            <span id="discountBadge" class="discount-badge">25% OFF</span>
                        </div>
                        <div class="price-savings">
                            Hemat <span id="savingsAmount">Rp 100.000</span>
                        </div>
                    </div>
                    
                    <!-- Product Description -->
                    <div class="product-description">
                        <h6>Deskripsi Produk</h6>
                        <p id="productDescription">
                            Kemeja formal premium dengan bahan cotton berkualitas tinggi. Cocok untuk acara formal maupun kasual. 
                            Tersedia dalam berbagai ukuran dan warna. Nyaman dipakai seharian dan mudah perawatannya.
                        </p>
                    </div>
                    
                    <!-- Product Variants -->
                    <div class="product-variants">
                        <!-- Size Selection -->
                        <div class="variant-group">
                            <label class="variant-label">Ukuran:</label>
                            <div class="size-options">
                                <input type="radio" name="size" id="size-xs" value="XS" class="btn-check">
                                <label class="btn btn-outline-secondary size-btn" for="size-xs">XS</label>
                                
                                <input type="radio" name="size" id="size-s" value="S" class="btn-check">
                                <label class="btn btn-outline-secondary size-btn" for="size-s">S</label>
                                
                                <input type="radio" name="size" id="size-m" value="M" class="btn-check" checked>
                                <label class="btn btn-outline-secondary size-btn" for="size-m">M</label>
                                
                                <input type="radio" name="size" id="size-l" value="L" class="btn-check">
                                <label class="btn btn-outline-secondary size-btn" for="size-l">L</label>
                                
                                <input type="radio" name="size" id="size-xl" value="XL" class="btn-check">
                                <label class="btn btn-outline-secondary size-btn" for="size-xl">XL</label>
                                
                                <input type="radio" name="size" id="size-xxl" value="XXL" class="btn-check">
                                <label class="btn btn-outline-secondary size-btn" for="size-xxl">XXL</label>
                            </div>
                            <div class="size-guide">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#sizeGuideModal">
                                    <i class="fas fa-ruler me-1"></i>Panduan Ukuran
                                </a>
                            </div>
                        </div>
                        
                        <!-- Color Selection -->
                        <div class="variant-group">
                            <label class="variant-label">Warna:</label>
                            <div class="color-options">
                                <input type="radio" name="color" id="color-black" value="Hitam" class="btn-check">
                                <label class="btn color-btn" for="color-black" style="background-color: #000000;" title="Hitam"></label>
                                
                                <input type="radio" name="color" id="color-white" value="Putih" class="btn-check" checked>
                                <label class="btn color-btn" for="color-white" style="background-color: #ffffff; border: 2px solid #ddd;" title="Putih"></label>
                                
                                <input type="radio" name="color" id="color-red" value="Merah" class="btn-check">
                                <label class="btn color-btn" for="color-red" style="background-color: #dc3545;" title="Merah"></label>
                                
                                <input type="radio" name="color" id="color-blue" value="Biru" class="btn-check">
                                <label class="btn color-btn" for="color-blue" style="background-color: #0d6efd;" title="Biru"></label>
                                
                                <input type="radio" name="color" id="color-green" value="Hijau" class="btn-check">
                                <label class="btn color-btn" for="color-green" style="background-color: #198754;" title="Hijau"></label>
                                
                                <input type="radio" name="color" id="color-navy" value="Navy" class="btn-check">
                                <label class="btn color-btn" for="color-navy" style="background-color: #1e3a8a;" title="Navy"></label>
                            </div>
                            <div class="selected-color">
                                Warna terpilih: <span id="selectedColorName">Putih</span>
                            </div>
                        </div>
                        
                        <!-- Quantity Selection -->
                        <div class="variant-group">
                            <label class="variant-label">Jumlah:</label>
                            <div class="quantity-selector">
                                <button type="button" class="btn btn-outline-secondary quantity-btn" onclick="decreaseQuantity()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" id="quantity" class="form-control quantity-input" value="1" min="1" max="10">
                                <button type="button" class="btn btn-outline-secondary quantity-btn" onclick="increaseQuantity()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="stock-info">
                                <i class="fas fa-check-circle text-success"></i>
                                Stok tersedia: <span id="stockCount">20</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button class="btn btn-primary btn-add-to-cart" onclick="addToCart()">
                            <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                        </button>
                        <button class="btn btn-success btn-buy-now" onclick="buyNow()">
                            <i class="fas fa-bolt me-2"></i>Beli Sekarang
                        </button>
                        <button class="btn btn-outline-danger btn-wishlist" onclick="toggleWishlist()">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    
                    <!-- Product Features -->
                    <div class="product-features">
                        <div class="feature-item">
                            <i class="fas fa-truck text-primary"></i>
                            <span>Gratis Ongkir</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-undo text-success"></i>
                            <span>14 Hari Retur</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-shield-alt text-info"></i>
                            <span>Garansi Resmi</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-medal text-warning"></i>
                            <span>Original 100%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Product Details Tabs -->
        <div class="product-tabs mt-5">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">
                        Deskripsi Lengkap
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                        Ulasan (<span id="reviewCount">156</span>)
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab">
                        Pengiriman
                    </button>
                </li>
            </ul>
            
            <div class="tab-content" id="productTabsContent">
                <!-- Description Tab -->
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    <div class="description-content">
                        <h6>Detail Produk</h6>
                        <div class="product-specs">
                            <div class="spec-row">
                                <span class="spec-label">Material:</span>
                                <span class="spec-value">100% Cotton Premium</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Berat:</span>
                                <span class="spec-value">200 gram</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Kategori:</span>
                                <span class="spec-value">Fashion Pria</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Brand:</span>
                                <span class="spec-value">MyYOGYA Premium</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Perawatan:</span>
                                <span class="spec-value">Machine Wash, Low Heat</span>
                            </div>
                        </div>
                        
                        <h6 class="mt-4">Deskripsi</h6>
                        <p>
                            Kemeja formal premium yang sempurna untuk berbagai kesempatan. Dibuat dari bahan cotton berkualitas tinggi yang memberikan kenyamanan maksimal sepanjang hari. 
                            Desain yang elegan dan modern membuatnya cocok untuk acara formal maupun kasual.
                        </p>
                        <ul>
                            <li>Bahan cotton premium yang breathable</li>
                            <li>Cutting yang presisi untuk fit yang sempurna</li>
                            <li>Warna yang tidak mudah pudar</li>
                            <li>Mudah dirawat dan tidak mudah kusut</li>
                            <li>Tersedia dalam berbagai ukuran</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <div class="reviews-content">
                        <div class="review-summary">
                            <div class="rating-overview">
                                <div class="rating-score">
                                    <span class="score">4.7</span>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <p>dari 156 ulasan</p>
                                </div>
                                <div class="rating-breakdown">
                                    <div class="rating-bar">
                                        <span>5★</span>
                                        <div class="bar"><div class="fill" style="width: 75%"></div></div>
                                        <span>117</span>
                                    </div>
                                    <div class="rating-bar">
                                        <span>4★</span>
                                        <div class="bar"><div class="fill" style="width: 15%"></div></div>
                                        <span>23</span>
                                    </div>
                                    <div class="rating-bar">
                                        <span>3★</span>
                                        <div class="bar"><div class="fill" style="width: 7%"></div></div>
                                        <span>11</span>
                                    </div>
                                    <div class="rating-bar">
                                        <span>2★</span>
                                        <div class="bar"><div class="fill" style="width: 2%"></div></div>
                                        <span>3</span>
                                    </div>
                                    <div class="rating-bar">
                                        <span>1★</span>
                                        <div class="bar"><div class="fill" style="width: 1%"></div></div>
                                        <span>2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="reviews-list">
                            <!-- Sample Review -->
                            <div class="review-item">
                                <div class="reviewer-info">
                                    <div class="avatar">A</div>
                                    <div class="details">
                                        <h6>Ahmad Rizki</h6>
                                        <div class="review-meta">
                                            <div class="stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="date">2 hari yang lalu</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-content">
                                    <p>Kualitas sangat bagus, bahan adem dan nyaman dipakai. Ukuran sesuai dengan size chart. Pengiriman cepat dan packaging rapi. Recommended!</p>
                                    <div class="review-images">
                                        <img src="/image/review1.jpg" alt="Review" class="review-img">
                                        <img src="/image/review2.jpg" alt="Review" class="review-img">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- More reviews would be here -->
                        </div>
                    </div>
                </div>
                
                <!-- Shipping Tab -->
                <div class="tab-pane fade" id="shipping" role="tabpanel">
                    <div class="shipping-content">
                        <div class="shipping-info">
                            <h6>Informasi Pengiriman</h6>
                            <div class="shipping-methods">
                                <div class="method">
                                    <i class="fas fa-truck text-primary"></i>
                                    <div>
                                        <h6>Reguler (2-3 hari)</h6>
                                        <p>Gratis untuk pembelian minimal Rp 100.000</p>
                                    </div>
                                </div>
                                <div class="method">
                                    <i class="fas fa-shipping-fast text-success"></i>
                                    <div>
                                        <h6>Express (1 hari)</h6>
                                        <p>Rp 15.000 - Garansi sampai hari yang sama</p>
                                    </div>
                                </div>
                                <div class="method">
                                    <i class="fas fa-motorcycle text-warning"></i>
                                    <div>
                                        <h6>Same Day (3-6 jam)</h6>
                                        <p>Rp 25.000 - Khusus area Jabodetabek</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Products -->
        <div class="related-products mt-5">
            <h4 class="section-title mb-4">Produk Serupa</h4>
            <div class="row" id="relatedProductsContainer">
                <!-- Related products will be populated by JavaScript -->
            </div>
        </div>
    </div>
</div>

<!-- Size Guide Modal -->
<div class="modal fade" id="sizeGuideModal" tabindex="-1" aria-labelledby="sizeGuideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sizeGuideModalLabel">Panduan Ukuran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="size-chart">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Ukuran</th>
                                <th>Lingkar Dada (cm)</th>
                                <th>Panjang Baju (cm)</th>
                                <th>Lingkar Pinggang (cm)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>XS</td>
                                <td>86-90</td>
                                <td>66</td>
                                <td>74-78</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>90-94</td>
                                <td>68</td>
                                <td>78-82</td>
                            </tr>
                            <tr>
                                <td>M</td>
                                <td>94-98</td>
                                <td>70</td>
                                <td>82-86</td>
                            </tr>
                            <tr>
                                <td>L</td>
                                <td>98-102</td>
                                <td>72</td>
                                <td>86-90</td>
                            </tr>
                            <tr>
                                <td>XL</td>
                                <td>102-106</td>
                                <td>74</td>
                                <td>90-94</td>
                            </tr>
                            <tr>
                                <td>XXL</td>
                                <td>106-110</td>
                                <td>76</td>
                                <td>94-98</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Product Detail Styles */
.product-detail-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 60px 0 40px;
    margin-bottom: 40px;
}

.product-detail-container {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
}

/* Product Images */
.product-images {
    position: sticky;
    top: 120px;
}

.main-image {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 20px;
    background: #f8f9fa;
}

.main-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.main-image:hover img {
    transform: scale(1.1);
}

.image-zoom-overlay {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.image-zoom-overlay:hover {
    background: rgba(0, 0, 0, 0.9);
    transform: scale(1.1);
}

.thumbnail-images {
    display: flex;
    gap: 10px;
    overflow-x: auto;
}

.thumbnail {
    flex-shrink: 0;
    width: 80px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.thumbnail.active {
    border-color: #f26b37;
}

.thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Product Info */
.product-info-detail {
    padding-left: 30px;
}

.product-header {
    margin-bottom: 25px;
}

.product-title {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
    line-height: 1.3;
}

.product-meta {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.rating-section {
    display: flex;
    align-items: center;
    gap: 15px;
}

.stars {
    color: #f39c12;
    font-size: 1.1rem;
}

.rating-text {
    color: #7f8c8d;
    font-size: 0.95rem;
}

.product-sku {
    color: #95a5a6;
    font-size: 0.9rem;
}

/* Price Section */
.price-section {
    background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
}

.current-price {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 8px;
}

.current-price #currentPrice {
    font-size: 2.5rem;
    font-weight: 800;
    color: #e74c3c;
}

.original-price {
    font-size: 1.2rem;
    color: #95a5a6;
    text-decoration: line-through;
}

.discount-badge {
    background: #e74c3c;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
}

.price-savings {
    color: #27ae60;
    font-weight: 600;
    font-size: 1.1rem;
}

/* Product Description */
.product-description {
    margin-bottom: 30px;
}

.product-description h6 {
    font-weight: 600;
    margin-bottom: 12px;
    color: #2c3e50;
}

.product-description p {
    color: #5a6c7d;
    line-height: 1.6;
}

/* Product Variants */
.product-variants {
    margin-bottom: 30px;
}

.variant-group {
    margin-bottom: 25px;
}

.variant-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 12px;
    display: block;
}

/* Size Options */
.size-options {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 10px;
}

.size-btn {
    min-width: 55px;
    border-radius: 8px !important;
    font-weight: 600;
    transition: all 0.3s ease;
}

.size-btn:hover {
    background: #f26b37;
    border-color: #f26b37;
    color: white;
}

.btn-check:checked + .size-btn {
    background: #f26b37 !important;
    border-color: #f26b37 !important;
    color: white !important;
}

.size-guide a {
    color: #f26b37;
    text-decoration: none;
    font-size: 0.9rem;
}

.size-guide a:hover {
    text-decoration: underline;
}

/* Color Options */
.color-options {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 10px;
}

.color-btn {
    width: 45px;
    height: 45px;
    border-radius: 50% !important;
    border: 3px solid transparent !important;
    transition: all 0.3s ease;
    position: relative;
}

.color-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.btn-check:checked + .color-btn {
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.3);
}

.selected-color {
    font-size: 0.9rem;
    color: #5a6c7d;
}

/* Quantity Selector */
.quantity-selector {
    display: flex;
    align-items: center;
    gap: 0;
    max-width: 160px;
    margin-bottom: 10px;
}

.quantity-btn {
    width: 45px;
    height: 45px;
    border-radius: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity-btn:first-child {
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
}

.quantity-btn:last-child {
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
}

.quantity-input {
    border-radius: 0;
    text-align: center;
    width: 70px;
    border-left: 0;
    border-right: 0;
    height: 45px;
}

.quantity-input:focus {
    box-shadow: none;
    border-color: #f26b37;
}

.stock-info {
    font-size: 0.9rem;
    color: #27ae60;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 15px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.btn-add-to-cart {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    border: none;
    padding: 15px 30px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1.1rem;
    flex: 1;
    min-width: 200px;
    transition: all 0.3s ease;
}

.btn-add-to-cart:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(242, 107, 55, 0.3);
}

.btn-buy-now {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    border: none;
    padding: 15px 30px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1.1rem;
    flex: 1;
    min-width: 200px;
    transition: all 0.3s ease;
}

.btn-buy-now:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
}

.btn-wishlist {
    width: 55px;
    height: 55px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.btn-wishlist:hover {
    background: #e74c3c;
    color: white;
    border-color: #e74c3c;
}

.btn-wishlist.active {
    background: #e74c3c;
    color: white;
    border-color: #e74c3c;
}

.btn-wishlist.active i {
    font-weight: 900;
}

/* Product Features */
.product-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    font-weight: 500;
}

.feature-item i {
    font-size: 1.1rem;
}

/* Product Tabs */
.product-tabs {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
}

.nav-tabs {
    border-bottom: 2px solid #f1f3f4;
}

.nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 600;
    padding: 15px 25px;
    border-radius: 0;
    transition: all 0.3s ease;
}

.nav-tabs .nav-link:hover {
    color: #f26b37;
    border-bottom: 2px solid #f26b37;
}

.nav-tabs .nav-link.active {
    color: #f26b37;
    background: none;
    border-bottom: 2px solid #f26b37;
}

.tab-content {
    padding: 30px 0;
}

/* Description Content */
.description-content h6 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 20px;
}

.product-specs {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 25px;
}

.spec-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #e9ecef;
}

.spec-row:last-child {
    border-bottom: none;
}

.spec-label {
    font-weight: 600;
    color: #5a6c7d;
}

.spec-value {
    color: #2c3e50;
}

/* Reviews Content */
.review-summary {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
}

.rating-overview {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 30px;
    align-items: center;
}

.rating-score {
    text-align: center;
}

.rating-score .score {
    font-size: 3rem;
    font-weight: 700;
    color: #f39c12;
}

.rating-score .stars {
    font-size: 1.5rem;
    margin: 10px 0;
}

.rating-breakdown {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.rating-bar {
    display: flex;
    align-items: center;
    gap: 10px;
}

.rating-bar span:first-child {
    min-width: 30px;
    color: #f39c12;
    font-weight: 600;
}

.rating-bar span:last-child {
    min-width: 30px;
    color: #6c757d;
    font-size: 0.9rem;
}

.bar {
    flex: 1;
    height: 8px;
    background: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
}

.bar .fill {
    height: 100%;
    background: #f39c12;
    transition: width 0.3s ease;
}

.review-item {
    padding: 20px 0;
    border-bottom: 1px solid #f1f3f4;
}

.reviewer-info {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.reviewer-info .avatar {
    width: 50px;
    height: 50px;
    background: #f26b37;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.review-meta {
    display: flex;
    align-items: center;
    gap: 10px;
}

.review-meta .stars {
    font-size: 0.9rem;
}

.review-meta .date {
    color: #6c757d;
    font-size: 0.85rem;
}

.review-images {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.review-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.review-img:hover {
    transform: scale(1.1);
}

/* Shipping Content */
.shipping-methods {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.method {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
}

.method i {
    font-size: 2rem;
}

.method h6 {
    margin-bottom: 5px;
    color: #2c3e50;
}

.method p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

/* Responsive */
@media (max-width: 768px) {
    .product-detail-container {
        padding: 20px;
    }
    
    .product-info-detail {
        padding-left: 0;
        margin-top: 30px;
    }
    
    .product-title {
        font-size: 1.5rem;
    }
    
    .current-price #currentPrice {
        font-size: 2rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn-add-to-cart,
    .btn-buy-now {
        min-width: auto;
        width: 100%;
    }
    
    .rating-overview {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .product-features {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>
@endpush

@push('scripts')
<script>
// Global variables
let currentProduct = {};
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Get product data from URL parameters
function getProductFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    const productData = {
        id: urlParams.get('id') || '1',
        name: urlParams.get('name') || 'Kemeja Formal Pria Premium Cotton',
        price: parseInt(urlParams.get('price')?.replace(/[^\d]/g, '')) || 299000,
        originalPrice: parseInt(urlParams.get('originalPrice')?.replace(/[^\d]/g, '')) || 399000,
        image: urlParams.get('image') || '/image/kategori/fashion/kemeja_formal.png',
        rating: parseFloat(urlParams.get('rating')) || 4.7,
        reviews: parseInt(urlParams.get('reviews')) || 156
    };
    
    return productData;
}

// Initialize product page
function initializeProduct() {
    currentProduct = getProductFromURL();
    
    // Update page content
    document.getElementById('productName').textContent = currentProduct.name;
    document.getElementById('productTitle').textContent = currentProduct.name;
    document.getElementById('mainProductImage').src = currentProduct.image;
    document.getElementById('mainProductImage').alt = currentProduct.name;
    document.getElementById('currentPrice').textContent = formatCurrency(currentProduct.price);
    document.getElementById('originalPrice').textContent = formatCurrency(currentProduct.originalPrice);
    document.getElementById('productRating').textContent = currentProduct.rating;
    document.getElementById('productReviews').textContent = currentProduct.reviews;
    document.getElementById('reviewCount').textContent = currentProduct.reviews;
    
    // Calculate discount
    const discount = Math.round(((currentProduct.originalPrice - currentProduct.price) / currentProduct.originalPrice) * 100);
    document.getElementById('discountBadge').textContent = `${discount}% OFF`;
    
    // Calculate savings
    const savings = currentProduct.originalPrice - currentProduct.price;
    document.getElementById('savingsAmount').textContent = formatCurrency(savings);
    
    // Update stars
    updateStars(currentProduct.rating);
    
    // Update thumbnails
    updateThumbnails();
    
    // Update page title
    document.title = `${currentProduct.name} - MyYOGYA`;
}

// Update star rating display
function updateStars(rating) {
    const starsContainer = document.getElementById('productStars');
    starsContainer.innerHTML = '';
    
    for (let i = 1; i <= 5; i++) {
        const star = document.createElement('i');
        if (i <= Math.floor(rating)) {
            star.className = 'fas fa-star';
        } else if (i <= rating) {
            star.className = 'fas fa-star-half-alt';
        } else {
            star.className = 'far fa-star';
        }
        starsContainer.appendChild(star);
    }
}

// Update thumbnail images
function updateThumbnails() {
    const thumbnails = document.querySelectorAll('.thumbnail');
    const images = [
        currentProduct.image,
        currentProduct.image.replace('.png', '_2.png'),
        currentProduct.image.replace('.png', '_3.png'),
        currentProduct.image.replace('.png', '_4.png')
    ];
    
    thumbnails.forEach((thumbnail, index) => {
        const img = thumbnail.querySelector('img');
        img.src = images[index];
        img.alt = currentProduct.name;
        thumbnail.setAttribute('data-image', images[index]);
        
        // Add error handling for missing images
        img.onerror = function() {
            this.src = currentProduct.image; // Fallback to main image
        };
        
        thumbnail.addEventListener('click', function() {
            document.getElementById('mainProductImage').src = this.getAttribute('data-image');
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
}

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount).replace('IDR', 'Rp');
}

// Quantity functions
function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    const maxValue = parseInt(quantityInput.max);
    
    if (currentValue < maxValue) {
        quantityInput.value = currentValue + 1;
    }
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    const minValue = parseInt(quantityInput.min);
    
    if (currentValue > minValue) {
        quantityInput.value = currentValue - 1;
    }
}

// Color selection handler
document.addEventListener('DOMContentLoaded', function() {
    const colorInputs = document.querySelectorAll('input[name="color"]');
    colorInputs.forEach(input => {
        input.addEventListener('change', function() {
            document.getElementById('selectedColorName').textContent = this.value;
        });
    });
});

// Add to cart function
function addToCart() {
    const selectedSize = document.querySelector('input[name="size"]:checked')?.value;
    const selectedColor = document.querySelector('input[name="color"]:checked')?.value;
    const quantity = parseInt(document.getElementById('quantity').value);
    
    if (!selectedSize || !selectedColor) {
        showToast('Silakan pilih ukuran dan warna terlebih dahulu', 'error');
        return;
    }
    
    const cartItem = {
        id: currentProduct.id,
        name: currentProduct.name,
        price: currentProduct.price,
        image: currentProduct.image,
        size: selectedSize,
        color: selectedColor,
        quantity: quantity,
        addedAt: new Date().toISOString()
    };
    
    // Check if item already exists
    const existingItemIndex = cart.findIndex(item => 
        item.id === currentProduct.id && 
        item.size === selectedSize && 
        item.color === selectedColor
    );
    
    if (existingItemIndex > -1) {
        cart[existingItemIndex].quantity += quantity;
    } else {
        cart.push(cartItem);
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartBadge();
    showToast('Produk berhasil ditambahkan ke keranjang!', 'success');
}

// Buy now function
function buyNow() {
    addToCart();
    setTimeout(() => {
        window.location.href = '/keranjang';
    }, 1000);
}

// Toggle wishlist
function toggleWishlist() {
    const btn = document.querySelector('.btn-wishlist');
    btn.classList.toggle('active');
    
    if (btn.classList.contains('active')) {
        btn.innerHTML = '<i class="fas fa-heart"></i>';
        showToast('Produk ditambahkan ke wishlist', 'success');
    } else {
        btn.innerHTML = '<i class="far fa-heart"></i>';
        showToast('Produk dihapus dari wishlist', 'info');
    }
}

// Update cart badge
function updateCartBadge() {
    const cartBadge = document.querySelector('.cart-badge');
    if (cartBadge) {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartBadge.textContent = totalItems;
    }
}

// Toast notification
function showToast(message, type = 'success') {
    const bgClass = type === 'success' ? 'bg-success' : type === 'error' ? 'bg-danger' : 'bg-info';
    const icon = type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle';
    
    const toastHtml = `
        <div class="toast align-items-center text-white ${bgClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas ${icon} me-2"></i>${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;
    
    let toastContainer = document.getElementById('toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
        toastContainer.style.zIndex = '9999';
        document.body.appendChild(toastContainer);
    }
    
    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
    
    const toastElement = toastContainer.lastElementChild;
    const toast = new bootstrap.Toast(toastElement, {
        autohide: true,
        delay: 3000
    });
    toast.show();
    
    toastElement.addEventListener('hidden.bs.toast', function() {
        toastElement.remove();
    });
}

// Initialize page when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initializeProduct();
    updateCartBadge();
});
</script>
@endpush
