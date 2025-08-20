<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pilihan Produk Elektronik - Shopee Style</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 10px; /* padding dikurangi supaya muat */
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        z-index: 1000;
        flex-wrap: wrap; /* biar bisa turun kalau layar sempit */
        box-sizing: border-box; /* supaya padding gak bikin overflow */
    }

    .nav-buttons {
        display: flex;
        gap: 8px;
        flex-shrink: 0; /* tombol gak mengecil */
    }

    .navbar .logo {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .navbar .logo img {
        height: 40px;
    }

    .navbar .logo-text {
        font-size: 20px;
        font-weight: bold;
        color: #f15a24;
    }

    .search-bar {
        flex: 1;
        margin: 0 20px;
        display: flex;
        align-items: center;
        background: white;
        border-radius: 30px;
        border: 2px solid #f15a24;
        overflow: hidden;
    }

    .search-bar input {
        flex: 1;
        border: none;
        padding: 10px 15px;
        font-size: 14px;
        outline: none;
    }

    .search-bar button {
        background: #f15a24;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-outline {
        border: 2px solid #f15a24;
        color: #f15a24;
        background: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: bold;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-outline:hover {
        background: #f15a24;
        color: white;
    }

    .btn-fill {
        background: #f15a24;
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: bold;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-fill:hover {
        background: #d94a1d;
    }

    /* Konten */
    .content {
        margin-top: 90px; /* kasih jarak dari navbar */
        padding: 20px;
    }

    .product-container {
    display: grid;
    grid-template-columns: repeat(6, 1fr); /* 6 kolom */
    gap: 16px;
    }

    .product-card {
        background: #fff;
        border-radius: 8px;
        position: relative;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.2s;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-card img {
        width: 100%;
        height: 200px; /* gambar lebih tinggi */
        object-fit: cover;
    }

    .product-info {
        padding: 10px;
    }

    .product-title {
        font-size: 14px;
        height: 40px;
        overflow: hidden;
    }

    .price-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .price-original {
        font-size: 12px;
        text-decoration: line-through;
        color: #888;
    }

    .price-discount {
        color: #e91e63;
        font-weight: bold;
        font-size: 15px;
    }

    .sold-count {
        font-size: 12px;
        color: #666;
    }

    .discount-label {
    position: absolute;
    top: 8px;
    right: 8px;
    background: #e91e63;
    color: white;
    font-size: 13px;
    font-weight: bold;
    padding: 4px 8px;
    border-radius: 4px;
    }

</style>

<body>
    <!-- Navbar -->


    <div class="navbar">
        <div class="logo">
            <img src="{{ asset('image/logo_yogya.png') }}" alt="Lampu LED">
            <span class="logo-text">MyYOGYA</span>
        </div>

        <form class="search-bar">
            <input type="text" placeholder="Cari produk, kategori, atau brand favorit Anda...">
            <button type="submit">&#10140;</button>
        </form>

        <div class="nav-buttons">
            <a href="#" class="btn-outline">Masuk</a>
            <a href="#" class="btn-fill">Daftar</a>
        </div>
    </div>

    <!-- Produk -->
    <div class="content">
        <div class="product-container">
            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>
            
            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
