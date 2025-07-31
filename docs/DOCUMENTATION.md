# 📚 MyYOGYA Authentication System Documentation

## 🎯 Overview

MyYOGYA adalah sistem autentikasi modern untuk platform e-commerce dengan animasi produk toserba, validasi nomor HP Indonesia, dan password toggle functionality.

## 🚀 Key Features

### 🔐 **Authentication**

-   **Login/Register Pages** dengan floating labels dan validasi real-time
-   **Password Toggle** dengan Font Awesome icons
-   **Phone Number Validation** untuk format Indonesia (+62)

### ✨ **Visual Design**

-   **Product Icon Animations** - Animasi ikon produk toserba (🍎🐟🥛🍞🧀🥚🍌🥕🛒🍚🍕🧻🧴🍜🥤🍪🧽)
-   **Random Movement Patterns** - Gerakan acak dengan smooth infinity loops
-   **Responsive Design** - Optimal di semua ukuran layar

## 🛠️ Technical Stack

**Frontend:** HTML5, CSS3, JavaScript ES6, Bootstrap 5.3.0, Font Awesome 6.0.0  
**Backend:** Laravel Framework, Blade Templates  
**Fonts:** Montserrat (Google Fonts)

## 📋 File Structure

```
yogya-toserba-kel-4/
├── resources/views/pelanggan/
│   ├── login.blade.php          # Login page dengan product animations
│   └── register.blade.php       # Register page dengan matching animations
├── public/css/pelanggan/
│   └── register.css            # Styling dengan keyframes animations
├── public/image/
│   ├── logo_yogya.png          # Company logo
│   └── shopping.png            # Illustration
└── docs/
    └── DOCUMENTATION.md        # This documentation
```

## 🎨 Design System

### **Color Palette**

```css
Primary Orange: #F26B37
Secondary Orange: #E55827
Background: #ffffff
Text: #495057
Border: #e9ecef
```

### **Typography**

```css
Font: 'Montserrat', sans-serif
Weights: 300, 400, 500, 600, 700
Base Size: 0.85rem - 0.9rem
```

## 🎭 Animation System

### **Product Icon Animations**

Sistem menggunakan emoji produk toserba untuk menciptakan animasi yang engaging:

```css
/* Product Icons: 🍎🐟🥛🍞🧀🥚🍌🥕🛒🍚🍕🧻🧴🍜🥤🍪🧽 */

/* Random Movement Pattern */
@keyframes float {
    0% {
        transform: translate(-50%, -50%) rotate(0deg) scale(1);
        opacity: 0.8;
    }
    25% {
        transform: translate(-60%, -40%) rotate(120deg) scale(0.95);
        opacity: 1;
    }
    50% {
        transform: translate(-70%, -30%) rotate(270deg) scale(0.85);
        opacity: 0.7;
    }
    75% {
        transform: translate(-25%, -70%) rotate(320deg) scale(1.35);
        opacity: 1;
    }
    100% {
        transform: translate(-50%, -50%) rotate(480deg) scale(1);
        opacity: 0.8;
    }
}

/* Smooth Infinity Implementation */
animation: float 37s infinite linear both, wave 23s infinite ease-in-out both;
```

### **Key Features**

-   **Multi-layer animations** dengan timing asinkron (37s, 23s, 43s, 17s)
-   **Random movement patterns** dengan 9 keyframe points
-   **Smooth infinity loops** menggunakan `animation-fill-mode: both`
-   **Synchronized login/register** pages untuk konsistensi visual

## 🔧 Key Components

### **Phone Number Validation**

```javascript
// Format: +62 812-3456-7890
// Prevents starting with 0 after +62
// Auto-formatting with hyphens
```

### **Password Toggle**

```javascript
function togglePassword(inputName) {
    const input = document.querySelector(`input[name="${inputName}"]`);
    // Toggle between password/text type with Font Awesome icons
}
```

### **Floating Labels**

```css
.floating-label-text {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    /* Material Design inspired animations */
}
```

## 📱 Responsive Design

```css
/* Mobile First Approach */
@media (max-width: 992px) {
    .register-card {
        flex-direction: column;
    }
}
@media (max-width: 480px) {
    .form-control {
        height: 36px;
    }
}
```

## � Installation & Setup

```bash
# Clone repository
git clone https://github.com/yogya-toserba/yogya-toserba-kel-4.git
cd yogya-toserba-kel-4

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Run development server
php artisan serve
```

## 📊 Browser Support

✅ Chrome 90+ | Firefox 88+ | Safari 14+ | Edge 90+ | Mobile Browsers

---

**Version:** 1.0.0 | **Updated:** July 31, 2025  
**Features:** Product Icon Animations, Random Movement Patterns, Phone Validation, Password Toggle
