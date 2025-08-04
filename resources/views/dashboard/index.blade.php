 <style>
      body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff7e6;
        }
        .navbar {
            background: #ff9800;
            color: #fff;
            padding: 16px 32px;
            font-size: 1.5em;
            font-weight: bold;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            background: #ff9800;
            color: #fff;
            width: 220px;
            padding-top: 32px;
            min-height: 100vh;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 12px 24px;
            margin-bottom: 8px;
            transition: background 0.2s;
        }
        .sidebar a:hover {
            background: #ffa726;
        }
        .main {
            flex: 1;
            padding: 40px;
        }
        .cards {
            display: flex;
            gap: 24px;
            margin-top: 24px;
        }
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(255,152,0,0.15);
            flex: 1;
            padding: 24px;
            text-align: center;
        }
        .card-title {
            background: #ff9800;
            color: #fff;
            padding: 8px 0;
            border-radius: 6px 6px 0 0;
            font-size: 1.1em;
            margin-bottom: 16px;
        }
        .card-value {
            font-size: 2em;
            color: #ff9800;
            font-weight: bold;
        }
 </style> 
 <div class="navbar">Dashboard Admin</div>
    <div class="container">
        <div class="sidebar">
            <a href="#">Home</a>
            <a href="#">Data User</a>
            <a href="#">Transaksi</a>
            <a href="#">Laporan</a>
            <a href="#">Logout</a>
        </div>
        <div class="main">
            <h2>Selamat Datang, Admin!</h2>
            <div class="cards">
                <div class="card">
                    <div class="card-title">Total User</div>
                    <div class="card-value">120</div>
                </div>
                <div class="card">
                    <div class="card-title">Transaksi Hari Ini</div>
                    <div class="card-value">35</div>
                </div>
                <div class="card">
                    <div class="card-title">Pendapatan</div>
                    <div class="card-value">Rp 5.000.000</div>
                </div>
            </div>
            <!-- Tambahkan konten dashboard lainnya di sini -->
        </div>
    </div>