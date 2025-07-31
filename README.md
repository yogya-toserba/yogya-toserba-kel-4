# 🏪 Sistem Manajemen Yogya Toserba

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.0+-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

**Sistem Informasi Manajemen Toko Retail Modern**  
_Tugas Akhir Kelompok 4_

[📖 Dokumentasi](docs/DOCUMENTATION.md) •
[🚀 Instalasi](#instalasi) •
[👥 Tim](#tim-pengembang) •
[📝 Fitur](#fitur-utama)

</div>

---

## 📋 Deskripsi Proyek

Sistem Manajemen Yogya Toserba adalah aplikasi web modern yang dirancang untuk mengelola operasional toko retail secara komprehensif. Aplikasi ini dikembangkan menggunakan **Laravel 12** dengan teknologi terdepan untuk memberikan pengalaman pengguna yang optimal dan performa yang handal.

### ✨ **Fitur Terbaru v2.0.0**

-   � **Enhanced Authentication UI** - Login/Register dengan animasi produk toserba
-   🔄 **Random Animation System** - Gerakan acak dan smooth infinity loops
-   📱 **Indonesian Phone Validation** - Format +62 dengan auto-formatting
-   👁️ **Password Toggle** - Show/hide password dengan icon yang responsif
-   🎯 **Floating Labels** - Material Design inspired form interactions

### �🎯 Tujuan Proyek

-   🏢 **Digitalisasi Operasional**: Mengotomatisasi proses bisnis toko retail
-   📊 **Manajemen Data**: Mengelola inventory, penjualan, dan customer dengan efisien
-   📈 **Analytics & Reporting**: Menyediakan laporan dan analisis bisnis real-time
-   🔐 **Keamanan Data**: Implementasi sistem keamanan yang robust
-   📱 **User Experience**: Interface yang intuitif dan responsive dengan animasi modern

---

## 👥 Tim Pengembang

<div align="center">

### **Kelompok 4** | 7 Anggota

</div>

| No  | Nama Lengkap                 | NIM       | Role                            | Kontribusi                              |
| --- | ---------------------------- | --------- | ------------------------------- | --------------------------------------- |
| 1️⃣  | **Muhammad Fikri Haikal**    | 232410560 | 🏛️ **Project Manager**          | Koordinasi tim, planning, dokumentasi   |
| 2️⃣  | **Nabil Cahyadi**            | 232410564 | 🔧 **Backend Developer**        | API development, database design        |
| 3️⃣  | **Mahesa Putra Faturrohman** | 232410555 | 🎨 **Frontend Developer**       | UI/UX implementation, responsive design |
| 4️⃣  | **VIkri Alva Pratama**       | 232410574 | 🗄️ **Database Administrator**   | Database optimization, data modeling    |
| 5️⃣  | **Erfan Eka Maulana**        | [NIM]     | 🎯 **UI/UX Designer**           | Design system, user experience          |
| 6️⃣  | **Yazdi Prayogi Apriana**    | 232410576 | 🧪 **Quality Assurance**        | Testing, bug tracking, quality control  |
| 7️⃣  | **Ikmal Suryana Putra**      | 232410552 | 📚 **Documentation Specialist** | Technical writing, user guides          |

---

## � Teknologi & Stack

### **Backend Framework**

-   **Laravel 12** - PHP framework modern dengan arsitektur MVC
-   **PHP 8.2+** - Server-side programming language
-   **Composer** - Dependency management

### **Frontend Technologies**

-   **Blade Template Engine** - Laravel's templating system
-   **TailwindCSS 3.0+** - Utility-first CSS framework
-   **Alpine.js** - Lightweight JavaScript framework
-   **Vite** - Next generation frontend tooling

### **Database & Storage**

-   **MySQL 8.0+** - Primary database
-   **Redis** - Caching and session storage
-   **Laravel Eloquent ORM** - Database abstraction layer

### **Development Tools**

-   **Laravel Artisan** - Command-line interface
-   **Laravel Mix/Vite** - Asset compilation
-   **Laravel Sail** - Docker development environment
-   **PHPUnit** - Unit testing framework

---

## 🚀 Instalasi & Setup

### **Prasyarat**

```bash
PHP >= 8.2
Composer >= 2.0
Node.js >= 18.0
MySQL >= 8.0
```

### **Langkah Instalasi**

1. **Clone Repository**

    ```bash
    git clone https://github.com/username/yogya-toserba-kel-4.git
    cd yogya-toserba-kel-4
    ```

2. **Install Dependencies**

    ```bash
    # Install PHP dependencies
    composer install

    # Install Node.js dependencies
    npm install
    ```

3. **Environment Setup**

    ```bash
    # Copy environment file
    cp .env.example .env

    # Generate application key
    php artisan key:generate
    ```

4. **Database Configuration**

    ```bash
    # Edit .env file dengan konfigurasi database
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=yogya_toserba
    DB_USERNAME=root
    DB_PASSWORD=

    # Run migrations
    php artisan migrate

    # Seed database (optional)
    php artisan db:seed
    ```

5. **Build Assets**

    ```bash
    # Development
    npm run dev

    # Production
    npm run build
    ```

6. **Start Development Server**

    ```bash
    php artisan serve
    ```

    Aplikasi akan berjalan di: `http://localhost:8000`

---

## 📝 Fitur Utama

### � **Manajemen Toko**

-   Dashboard analytics dengan real-time data
-   Multi-store management support
-   Branch performance tracking

### 📦 **Inventory Management**

-   Product catalog management
-   Stock tracking & alerts
-   Supplier management
-   Purchase order system

### 💰 **Point of Sale (POS)**

-   Fast checkout system
-   Multiple payment methods
-   Receipt printing
-   Discount & promotion management

### 👥 **Customer Management**

-   Customer database
-   Loyalty program
-   Customer analytics
-   Communication tools

### 📊 **Reporting & Analytics**

-   Sales reports (daily, weekly, monthly)
-   Inventory reports
-   Customer behavior analytics
-   Financial reports
-   Export to PDF/Excel

### 👤 **User Management**

-   Role-based access control
-   Staff management
-   Activity logging
-   Permission management

### ⚙️ **System Features**

-   Multi-language support
-   Responsive design
-   Data backup & restore
-   System configuration

---

## 📖 Dokumentasi

### **API Documentation**

-   [API Reference](docs/api.md)
-   [Authentication](docs/auth.md)
-   [Endpoints](docs/endpoints.md)

### **User Guides**

-   [Admin Guide](docs/admin-guide.md)
-   [Cashier Guide](docs/cashier-guide.md)
-   [Manager Guide](docs/manager-guide.md)

### **Development**

-   [Setup Guide](docs/setup.md)
-   [Coding Standards](docs/coding-standards.md)
-   [Contributing](docs/contributing.md)

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

---

## 📁 Struktur Proyek

```
yogya-toserba-kel-4/
├── app/                    # Core application
│   ├── Http/Controllers/   # Controllers
│   ├── Models/            # Eloquent models
│   ├── Services/          # Business logic
│   └── ...
├── config/                # Configuration files
├── database/              # Migrations & seeders
├── public/                # Public assets
├── resources/             # Views, CSS, JS
├── routes/                # Route definitions
├── storage/               # File storage
├── tests/                 # Test files
├── .env.example          # Environment template
├── composer.json         # PHP dependencies
├── package.json          # Node.js dependencies
└── README.md             # This file
```

---

## 🤝 Kontribusi

Kami menyambut kontribusi dari semua anggota tim. Silakan ikuti panduan berikut:

1. Fork repository ini
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademik - Tugas Akhir Kelompok 4.

---

## 📞 Kontak & Support

-   **Project Repository**: https://github.com/yogya-toserba/yogya-toserba-kel-4
-   **Documentation**: [📚 Dokumentasi Lengkap](docs/DOCUMENTATION.md)
-   **Issue Tracker**: [Issues Link]

---

## 📖 Dokumentasi

### **Dokumentasi Teknis**

Untuk informasi teknis lengkap tentang sistem autentikasi, komponen, dan implementasi, silakan lihat:

➡️ **[📚 Dokumentasi Lengkap](docs/DOCUMENTATION.md)**

Dokumentasi mencakup:

-   🔐 **Authentication System** - Login & Register dengan fitur canggih
-   📱 **Phone Validation** - Validasi nomor HP Indonesia dengan auto-formatting
-   ✨ **Visual Design** - Floating labels, particle animations, dan responsive design
-   🛠️ **Technical Stack** - Laravel, Bootstrap, CSS3, JavaScript ES6
-   🎨 **Design System** - Color palette, typography, spacing system
-   🔧 **Component Details** - Password toggle, phone formatting, animasi
-   📱 **Responsive Design** - Mobile-first approach dengan breakpoints
-   🔒 **Security Features** - Input validation, XSS prevention, CSRF protection
-   🚀 **Performance** - Optimasi CSS, JavaScript, dan loading performance

### **Quick Links**

-   [🎯 Overview & Features](docs/DOCUMENTATION.md#-overview)
-   [🛠️ Technical Stack](docs/DOCUMENTATION.md#️-technical-stack)
-   [🎨 Design System](docs/DOCUMENTATION.md#-design-system)
-   [🔧 Component Details](docs/DOCUMENTATION.md#-component-details)
-   [🎭 Animation System](docs/DOCUMENTATION.md#-animation-system)
-   [📱 Responsive Design](docs/DOCUMENTATION.md#-responsive-design)
-   [🔒 Security Features](docs/DOCUMENTATION.md#-security-features)

---

<div align="center">

**🏪 Yogya Toserba Management System**  
_Dikembangkan dengan ❤️ oleh Kelompok 4_

**Laravel 12** | **2025**

</div>
