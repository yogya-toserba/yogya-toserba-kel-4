# 🏪 Sistem Manajemen Yogya Toserba

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.0+-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

**Sistem Informasi Manajemen Toko Retail Modern**  
_Tugas Akhir Kelompok 4_

[📖 Dokumentasi Lengkap](docs/COMPLETE_DOCUMENTATION.md) •
[🚀 Quick Start](#quick-start) •
[📱 Demo](#demo) •
[👥 Tim](#tim-pengembang)

</div>

---

## 🎯 Overview

MyYOGYA adalah sistem manajemen toko retail modern dengan fitur lengkap untuk:

-   🔐 **Multi-role Authentication** (Admin, Gudang, Pelanggan)
-   📦 **Product & Inventory Management**
-   💰 **Transaction & POS System**
-   📱 **Customer Portal dengan Manual System**
-   ❌ **Custom Error Pages dengan Animasi**

## 🚀 Quick Start

### Prerequisites

-   PHP 8.2+
-   Composer
-   Node.js & npm
-   MySQL/SQLite

### Installation

```bash
# Clone repository
git clone https://github.com/yogya-toserba/yogya-toserba-kel-4.git
cd yogya-toserba-kel-4

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan db:seed

# Build assets & start server
npm run build
php artisan serve
```

## 📱 Demo

### 🌐 Access URLs

-   **Main App**: http://localhost:8000
-   **Admin Dashboard**: http://localhost:8000/admin/login
-   **Gudang System**: http://localhost:8000/gudang/login
-   **Customer Manual**: http://localhost:8000/pelanggan/manual

### 🎮 Test Accounts

```
Admin: admin@yogya.com / password
Gudang: gudang@yogya.com / password
```

## ✨ Key Features

### 🔐 Authentication System

-   Multi-role login dengan validation real-time
-   Password toggle dan phone number validation
-   Secure session management

### 📱 Customer Portal

-   Manual sistem lengkap dengan FAQ
-   Bantuan IT support
-   Kontak admin directory
-   Responsive design dengan animasi smooth

### ❌ Error Handling

-   Custom error pages (404, 403, 405, 500)
-   Consistent styling dengan floating animations
-   Auto-refresh untuk server errors

### 🎨 UI/UX

-   Modern design dengan animasi CSS
-   Floating product icons
-   Responsive grid layouts
-   Interactive particle effects

## 📁 Project Structure

```
yogya-toserba-kel-4/
├── 📁 app/                    # Laravel application core
├── 📁 resources/views/        # Blade templates
│   ├── 📁 pelanggan/         # Customer portal
│   ├── 📁 errors/            # Custom error pages
│   └── 📁 admin/             # Admin dashboard
├── 📁 public/css/            # Compiled stylesheets
├── 📁 database/              # Migrations & seeders
├── 📁 docs/                  # 📖 Documentation
│   ├── COMPLETE_DOCUMENTATION.md  # 📚 Full documentation
│   ├── 📁 reports/           # Development reports
│   ├── 📁 setup-scripts/     # Database setup files
│   └── 📁 test-files/        # Testing utilities
└── 📁 routes/                # Application routes
```

## 📖 Documentation

-   **[📚 Complete Documentation](docs/COMPLETE_DOCUMENTATION.md)** - Dokumentasi lengkap proyek
-   **[📊 Development Reports](docs/reports/)** - Laporan pengembangan dan bug fixes
-   **[🔧 Setup Scripts](docs/setup-scripts/)** - Script setup database dan migrasi
-   **[🧪 Test Files](docs/test-files/)** - File testing dan debugging

## 👥 Tim Pengembang

**Kelompok 4** - Sistem Informasi

-   **Project Manager**: [Nama]
-   **Backend Developer**: [Nama]
-   **Frontend Developer**: [Nama]
-   **UI/UX Designer**: [Nama]
-   **Database Administrator**: [Nama]

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/nama-fitur`)
3. Commit changes (`git commit -am 'Add some feature'`)
4. Push to branch (`git push origin feature/nama-fitur`)
5. Create Pull Request

## 📞 Support

-   **Email**: kelompok4@yogyatoserba.com
-   **GitHub Issues**: [Create Issue](https://github.com/yogya-toserba/yogya-toserba-kel-4/issues)
-   **Documentation**: [Read Docs](docs/COMPLETE_DOCUMENTATION.md)

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

<div align="center">

**🏪 MyYOGYA - Sistem Manajemen Toko Retail Modern**

_Made with ❤️ by Kelompok 4_

[![GitHub stars](https://img.shields.io/github/stars/yogya-toserba/yogya-toserba-kel-4.svg?style=social&label=Star)](https://github.com/yogya-toserba/yogya-toserba-kel-4)
[![GitHub forks](https://img.shields.io/github/forks/yogya-toserba/yogya-toserba-kel-4.svg?style=social&label=Fork)](https://github.com/yogya-toserba/yogya-toserba-kel-4/fork)

</div>
