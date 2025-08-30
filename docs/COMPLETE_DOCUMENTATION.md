# 🏪 Sistem Manajemen Yogya Toserba - Dokumentasi Lengkap

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.0+-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

**Sistem Informasi Manajemen Toko Retail Modern**  
_Tugas Akhir Kelompok 4_

</div>

---

## 📋 Daftar Isi

1. [🎯 Overview](#overview)
2. [🚀 Fitur Utama](#fitur-utama)
3. [🛠️ Technical Stack](#technical-stack)
4. [📁 Struktur Proyek](#struktur-proyek)
5. [💾 Database](#database)
6. [🔐 Authentication System](#authentication-system)
7. [🎨 UI/UX Features](#uiux-features)
8. [📱 Manual System](#manual-system)
9. [❌ Error Pages](#error-pages)
10. [🔧 Instalasi](#instalasi)
11. [👥 Tim Pengembang](#tim-pengembang)
12. [📊 Status Proyek](#status-proyek)
13. [🐛 Bug Fixes & Updates](#bug-fixes--updates)

---

## 🎯 Overview

MyYOGYA adalah sistem manajemen toko retail modern yang dirancang khusus untuk Yogya Toserba. Sistem ini menyediakan solusi lengkap untuk manajemen produk, stok, transaksi, dan customer service dengan interface yang modern dan user-friendly.

### 🎨 Design Philosophy

-   **Modern & Clean**: Interface yang bersih dengan animasi smooth
-   **User-Centric**: Fokus pada pengalaman pengguna yang intuitif
-   **Responsive**: Optimal di semua device (desktop, tablet, mobile)
-   **Accessibility**: Mendukung keyboard navigation dan screen readers

---

## 🚀 Fitur Utama

### 🔐 **Authentication & Authorization**

-   ✅ Multi-role authentication (Admin, Gudang, Pelanggan)
-   ✅ Login/Register dengan validasi real-time
-   ✅ Password toggle functionality
-   ✅ Phone number validation (format Indonesia +62)
-   ✅ Session management yang aman

### 📦 **Product Management**

-   ✅ CRUD operations untuk produk
-   ✅ Category management
-   ✅ Stock tracking per cabang
-   ✅ Bulk import/export

### 🏪 **Store Management**

-   ✅ Multi-branch support
-   ✅ Inventory management
-   ✅ Stock transfer antar cabang
-   ✅ Real-time stock monitoring

### 💰 **Transaction System**

-   ✅ Point of Sale (POS)
-   ✅ Customer loyalty points
-   ✅ Transaction history
-   ✅ Sales reporting

### 📱 **Customer Portal**

-   ✅ Manual sistem pelanggan
-   ✅ Bantuan IT support
-   ✅ Kontak admin directory
-   ✅ FAQ dengan accordion interface

### ❌ **Error Handling**

-   ✅ Custom error pages (404, 403, 405, 500)
-   ✅ Consistent styling dengan animasi
-   ✅ Auto-refresh untuk server errors

---

## 🛠️ Technical Stack

### **Backend Framework**

-   **Laravel 12.x** - PHP Framework
-   **PHP 8.2+** - Server-side language
-   **MySQL 8.0+** - Database management
-   **SQLite** - Development database

### **Frontend Technologies**

-   **HTML5 & CSS3** - Markup dan styling
-   **JavaScript ES6** - Client-side scripting
-   **Blade Templates** - Laravel templating engine
-   **TailwindCSS** - Utility-first CSS framework
-   **Bootstrap 5.3.0** - Component library

### **UI/UX Libraries**

-   **Font Awesome 6.0.0** - Icon library
-   **Google Fonts (Montserrat)** - Typography
-   **CSS Animations** - Smooth transitions dan effects

### **Development Tools**

-   **Vite** - Build tool dan hot reload
-   **Composer** - PHP dependency management
-   **npm** - Node package manager

---

## 📁 Struktur Proyek

```
yogya-toserba-kel-4/
├── 📁 app/
│   ├── 📁 Http/Controllers/    # Controllers untuk routing logic
│   ├── 📁 Models/             # Eloquent models untuk database
│   └── 📁 Exceptions/         # Custom exception handlers
├── 📁 resources/
│   ├── 📁 views/
│   │   ├── 📁 pelanggan/      # Customer portal views
│   │   ├── 📁 errors/         # Custom error pages
│   │   ├── 📁 admin/          # Admin dashboard views
│   │   └── 📁 gudang/         # Warehouse management views
│   └── 📁 css/               # Stylesheets
├── 📁 public/
│   ├── 📁 css/               # Compiled CSS
│   ├── 📁 js/                # JavaScript files
│   └── 📁 image/             # Static images
├── 📁 database/
│   ├── 📁 migrations/        # Database schema
│   └── 📁 seeders/           # Sample data
├── 📁 routes/                # Application routes
└── 📁 docs/                  # Project documentation
```

---

## 💾 Database

### 📊 **Database Schema**

#### **Users & Authentication**

```sql
- users (id, name, email, phone, password, role)
- admins (id, username, password, role, cabang_id)
- pelanggans (id, nama, email, phone, poin, created_at)
```

#### **Product Management**

```sql
- products (id, nama, kategori, harga, stok, cabang_id)
- categories (id, nama, deskripsi)
- stok_gudang_pusat (id, produk_id, jumlah)
```

#### **Store Management**

```sql
- cabangs (id, nama, alamat, telepon, manager)
- gudangs (id, nama, lokasi, kapasitas)
```

#### **Transaction System**

```sql
- transaksis (id, pelanggan_id, cabang_id, total, tanggal)
- detail_transaksis (id, transaksi_id, produk_id, quantity, harga)
```

### 🔄 **Database Operations**

-   ✅ Automatic migrations
-   ✅ Seeders untuk sample data
-   ✅ Foreign key constraints
-   ✅ Indexed columns untuk performance

### 🛠️ **Setup Scripts & Debugging Tools**

#### **Database Setup & Debugging**

```php
// docs/setup-scripts/debug_database.php
// Database connectivity checker dengan comprehensive logging
- Test koneksi ke database utama
- Verify table existence dan structure
- Check migration status
- Debug seeder operations
```

#### **Data Fix Utilities**

```php
// docs/setup-scripts/fix_shift_data.php
// Shift data creation dan management tools
- Create sample shift schedules
- Fix shift assignment conflicts
- Update work schedule data
- Validate shift constraints
```

#### **Testing Utilities**

```php
// docs/test-files/test_karyawan_form.php
// Employee form testing dan validation
- Test form data insertion
- Validate employee information
- Debug form submission issues
- Check database constraints
```

### 📋 **Development Files Organization**

```
docs/
├── setup-scripts/          # Database setup dan utilities
│   ├── debug_database.php  # Database connectivity checker
│   ├── fix_shift_data.php  # Shift data management
│   └── [other setup files]
├── test-files/             # Testing utilities
│   ├── test_karyawan_form.php    # Employee form testing
│   └── [other test files]
└── reports/                # Project documentation
    ├── ADDITIONAL_CLEANUP_REPORT.md
    ├── DASHBOARD_CLEANUP_REPORT.md
    └── [other reports]
```

---

## 🔐 Authentication System

### 🚪 **Login System**

```php
// Multi-role authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/gudang/login', [GudangController::class, 'login']);
```

### 🛡️ **Authorization Middleware**

```php
// Role-based access control
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});
```

### ✨ **Features**

-   **Real-time Validation**: Form validation dengan feedback langsung
-   **Password Toggle**: Show/hide password dengan smooth animation
-   **Phone Validation**: Format Indonesia (+62) dengan auto-formatting
-   **Remember Me**: Persistent login sessions
-   **Logout Confirmation**: Confirmation dialog sebelum logout

---

## 🎨 UI/UX Features

### 🎭 **Animations & Effects**

#### **Product Icon Animations**

```css
/* Floating product icons */
.product-icon {
    animation: float 6s ease-in-out infinite;
    animation-delay: var(--delay);
}

@keyframes float {
    0%,
    100% {
        transform: translateY(0px) rotate(0deg);
    }
    25% {
        transform: translateY(-20px) rotate(90deg);
    }
    50% {
        transform: translateY(-40px) rotate(180deg);
    }
    75% {
        transform: translateY(-20px) rotate(270deg);
    }
}
```

#### **Form Interactions**

```css
/* Floating labels */
.form-group.focused label {
    transform: translateY(-20px) scale(0.8);
    color: var(--primary-color);
}

/* Button hover effects */
.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
}
```

### 🎨 **Color Scheme**

```css
:root {
    --primary-color: #f26b37; /* Yogya Orange */
    --primary-dark: #e55827; /* Dark Orange */
    --secondary-color: #6c757d; /* Gray */
    --success-color: #28a745; /* Green */
    --danger-color: #dc3545; /* Red */
    --warning-color: #ffc107; /* Yellow */
}
```

---

## 📱 Manual System

### 📖 **Customer Manual Portal**

#### **File Locations**

```
resources/views/pelanggan/
├── manual.blade.php          # Main manual page
├── bantuan-it.blade.php      # IT support page
└── kontak-admin.blade.php    # Admin contact directory
```

#### **Unified Styling**

```css
/* Manual.css - Unified stylesheet */
public/css/pelanggan/manual.css
```

### 🎯 **Features**

#### **Navigation System**

-   ✅ Sidebar navigation dengan smooth scroll
-   ✅ Quick links antar halaman
-   ✅ Breadcrumb navigation

#### **FAQ System**

```javascript
// Accordion FAQ dengan smooth animations
.faq-item.active .faq-answer {
    max-height: 300px;
    opacity: 1;
    transform: translateY(0);
}
```

#### **Responsive Grid Layout**

```css
/* 3-3 Grid system */
.feature-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}
```

### 📋 **Content Sections**

1. **Panduan Berbelanja** - Step-by-step shopping guide
2. **Sistem Poin** - Loyalty points explanation
3. **Metode Pembayaran** - Payment methods
4. **Kebijakan Toko** - Store policies
5. **FAQ** - Frequently asked questions
6. **Kontak Support** - Contact information

---

## ❌ Error Pages

### 🎨 **Consistent Design System**

All error pages (404, 403, 405, 500) menggunakan design yang identik:

#### **Visual Elements**

```css
/* Gradient background */
background: linear-gradient(
    135deg,
    var(--primary-color) 0%,
    var(--primary-dark) 100%
);

/* Floating shapes dengan FontAwesome icons */
.floating-shapes .shape {
    opacity: 0.08;
    animation: float-shapes 20s ease-in-out infinite;
}
```

#### **Error Page Features**

-   ✅ **Loading animations** dengan spinner
-   ✅ **Floating background shapes** dengan retail icons
-   ✅ **Particle effects** yang interactive
-   ✅ **Auto-refresh** pada 500 errors (30 detik countdown)
-   ✅ **Keyboard shortcuts** (ESC untuk back, Enter untuk home)
-   ✅ **Quick navigation links** ke manual, bantuan, kontak

#### **Error Types**

```php
// Handler.php - Exception handling
if ($exception instanceof NotFoundHttpException) {
    return response()->view('errors.404', [], 404);
}
if ($exception instanceof AccessDeniedHttpException) {
    return response()->view('errors.403', [], 403);
}
if ($exception instanceof MethodNotAllowedHttpException) {
    return response()->view('errors.405', [], 405);
}
```

---

## 🔧 Instalasi

### 📋 **Prerequisites**

-   PHP 8.2+
-   Composer
-   Node.js & npm
-   MySQL 8.0+ atau SQLite

### ⚡ **Quick Setup**

1. **Clone Repository**

```bash
git clone https://github.com/yogya-toserba/yogya-toserba-kel-4.git
cd yogya-toserba-kel-4
```

2. **Install Dependencies**

```bash
composer install
npm install
```

3. **Environment Setup**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Setup**

```bash
php artisan migrate
php artisan db:seed
```

5. **Build Assets**

```bash
npm run build
```

6. **Start Development Server**

```bash
php artisan serve
```

### 🌐 **Access URLs**

-   **Main App**: http://localhost:8000
-   **Admin Login**: http://localhost:8000/admin/login
-   **Gudang Login**: http://localhost:8000/gudang/login
-   **Manual System**: http://localhost:8000/pelanggan/manual

---

## 👥 Tim Pengembang

### 🎓 **Kelompok 4**

-   **Project Manager**: [Nama]
-   **Backend Developer**: [Nama]
-   **Frontend Developer**: [Nama]
-   **UI/UX Designer**: [Nama]
-   **Database Administrator**: [Nama]

### 📞 **Contact**

-   **Email**: kelompok4@yogyatoserba.com
-   **GitHub**: https://github.com/yogya-toserba/yogya-toserba-kel-4

---

## 📊 Status Proyek

### ✅ **Completed Features**

-   [x] Authentication system (Multi-role)
-   [x] Database schema dan migrations
-   [x] Admin dashboard
-   [x] Gudang management system
-   [x] Customer manual portal
-   [x] Error handling system
-   [x] Responsive UI/UX
-   [x] API endpoints
-   [x] Form validations
-   [x] Session management
-   [x] Documentation organization
-   [x] Development tools setup
-   [x] Testing utilities
-   [x] Debug scripts

### 🚧 **In Progress**

-   [ ] Advanced reporting system
-   [ ] Email notifications
-   [ ] API documentation
-   [ ] Performance optimization

### 🎯 **Future Enhancements**

-   [ ] Mobile app
-   [ ] Real-time notifications
-   [ ] Advanced analytics
-   [ ] Third-party integrations

---

## 🐛 Bug Fixes & Updates

### 📝 **Recent Updates**

#### **v1.0.4 - Complete Documentation Organization**

-   ✅ Organized all scattered development files
-   ✅ Created structured docs/ folder hierarchy
-   ✅ Moved debug scripts to setup-scripts/
-   ✅ Categorized test files to test-files/
-   ✅ Consolidated reports to reports/
-   ✅ Updated comprehensive documentation

#### **v1.0.3 - Error Pages Unification**

-   ✅ Unified styling untuk semua error pages
-   ✅ Added particle effects dan animations
-   ✅ Implemented auto-refresh untuk 500 errors
-   ✅ Added keyboard shortcuts

#### **v1.0.2 - Manual System Enhancement**

-   ✅ Unified manual.css stylesheet
-   ✅ FAQ accordion dengan smooth animations
-   ✅ Responsive 3-3 grid layout
-   ✅ Content completion untuk semua sections

#### **v1.0.1 - Database Structure Fix**

-   ✅ Fixed foreign key constraints
-   ✅ Updated migration files
-   ✅ Added proper indexing
-   ✅ Optimized query performance

#### **v1.0.0 - Initial Release**

-   ✅ Core authentication system
-   ✅ Basic CRUD operations
-   ✅ Admin dan gudang dashboards
-   ✅ Customer portal foundation

### 🔧 **Known Issues**

-   **Performance**: Large dataset queries perlu optimization
-   **Browser**: IE11 support terbatas untuk CSS animations
-   **Mobile**: Some animations perlu fine-tuning di iOS Safari

### 📞 **Bug Reporting**

Jika menemukan bug, silakan buat issue di GitHub repository atau contact tim development.

---

<div align="center">

**🏪 MyYOGYA - Sistem Manajemen Toko Retail Modern**

_Made with ❤️ by Kelompok 4_

</div>
