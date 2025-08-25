<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyYOGYA - Belanja Online Terpercaya')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    
    <style>
        /* Category specific styles */
        .category-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 80px 0 60px;
            margin-bottom: 50px;
            position: relative;
            overflow: hidden;
        }
        
        .category-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }
        
        .category-header .container {
            position: relative;
            z-index: 1;
        }
        
        .category-header h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            font-weight: 700;
        }
        
        .category-header .lead {
            font-size: 1.25rem;
            opacity: 0.95;
            max-width: 600px;
            line-height: 1.6;
        }
        
        .breadcrumb-custom {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 12px 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .breadcrumb-custom a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .breadcrumb-custom a:hover {
            color: white;
            text-decoration: underline;
        }
        
        .filter-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            padding: 32px;
            margin-bottom: 50px;
            border: 1px solid rgba(242, 107, 55, 0.1);
        }
        
        .filter-section .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 14px 18px;
            font-weight: 500;
            font-size: 14px;
            transition: var(--transition);
            background-color: #f8f9fa;
            color: #495057;
        }
        
        .filter-section .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(242, 107, 55, 0.25);
            background-color: white;
            outline: none;
        }
        
        .filter-section .form-select:hover {
            border-color: var(--primary-color);
            background-color: white;
        }
        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 32px;
            margin-bottom: 60px;
        }
        
        .product-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(242, 107, 55, 0.1);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
            border-color: var(--primary-color);
        }
        
        .product-image {
            position: relative;
            overflow: hidden;
            height: 220px;
            background: #f8f9fa;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        
        .discount-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
            z-index: 2;
        }
        
        .wishlist-btn {
            position: absolute;
            top: 16px;
            right: 16px;
            background: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            opacity: 0;
            transition: all 0.3s ease;
            color: #6c757d;
            z-index: 2;
        }
        
        .product-card:hover .wishlist-btn {
            opacity: 1;
            transform: scale(1.1);
        }
        
        .wishlist-btn:hover {
            background: var(--primary-color);
            color: white;
        }
        
        .product-info {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
            min-height: 42px;
        }
        
        .product-rating {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .stars {
            color: #ffc107;
            margin-right: 8px;
            font-size: 14px;
        }
        
        .review-count {
            font-size: 12px;
            color: var(--text-light);
            font-weight: 500;
        }
        
        .product-price {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .current-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .original-price {
            font-size: 14px;
            color: var(--text-light);
            text-decoration: line-through;
            font-weight: 500;
        }
        
        .add-to-cart-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            margin-top: auto;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .add-to-cart-btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), #d63c20);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(242, 107, 55, 0.4);
        }
        
        .pagination-custom {
            display: flex;
            justify-content: center;
            margin-top: 60px;
        }
        
        .pagination-custom .page-link {
            color: var(--primary-color);
            border: 2px solid var(--border-color);
            margin: 0 4px;
            border-radius: 12px;
            padding: 12px 18px;
            font-weight: 600;
            transition: all 0.3s ease;
            background: white;
        }
        
        .pagination-custom .page-link:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .pagination-custom .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
        }
        
        .pagination-custom .page-item.disabled .page-link {
            color: var(--text-light);
            background: #f8f9fa;
            border-color: var(--border-color);
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .category-header {
                padding: 60px 0 40px;
            }
            
            .category-header h1 {
                font-size: 2.5rem;
            }
            
            .filter-section {
                padding: 20px;
            }
            
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 20px;
            }
            
            .filter-section .row .col-md-3 {
                margin-bottom: 15px;
            }
        }
        
        @media (max-width: 576px) {
            .category-header h1 {
                font-size: 2rem;
            }
            
            .product-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .filter-section {
                padding: 16px;
            }
            
            .product-info {
                padding: 16px;
            }
        }
        
        /* Loading Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .product-card {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        .product-card:nth-child(1) { animation-delay: 0.1s; }
        .product-card:nth-child(2) { animation-delay: 0.2s; }
        .product-card:nth-child(3) { animation-delay: 0.3s; }
        .product-card:nth-child(4) { animation-delay: 0.4s; }
        .product-card:nth-child(5) { animation-delay: 0.5s; }
        .product-card:nth-child(6) { animation-delay: 0.6s; }
        
        /* Footer Styles */
        .footer-custom {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            padding: 60px 0 20px;
            position: relative;
            overflow: hidden;
        }

        .footer-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .footer-custom .container {
            position: relative;
            z-index: 1;
        }

        .footer-brand h5 {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        .footer-brand p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin-bottom: 0;
        }
        
        .footer-title {
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 0.5rem;
        }
        
        .footer-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.95rem;
        }
        
        .footer-link:hover {
            color: white;
            text-decoration: underline;
        }
        
        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }
        
        .footer-social a:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-2px);
        }
        
        .footer-divider {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 3rem 0 1.5rem;
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin: 0;
        }
        
        /* Maps styling */
        .maps-container {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            overflow: hidden;
            border: 3px solid rgba(242, 107, 55, 0.2);
            transition: all 0.3s ease;
        }
        
        .maps-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            border-color: rgba(242, 107, 55, 0.4);
        }
        
        .copyright {
            color: #95a5a6;
            font-size: 14px;
            margin: 0;
        }
        
        /* Footer Responsive */
        @media (max-width: 768px) {
            .footer-custom {
                padding: 40px 0 20px;
            }
            
            .footer-brand {
                text-align: center;
            }
            
            .footer-social {
                text-align: center;
            }
        }
        
        /* Enhanced Search Container */
        .search-container {
            width: 100%;
            max-width: 100%;
            position: relative;
            padding: 0 15px;
        }

        .search-wrapper, .search-box {
            position: relative;
            display: flex;
            background: var(--white);
            border-radius: 25px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
            border: 2px solid rgba(242, 107, 55, 0.1);
            transition: var(--transition);
            overflow: hidden;
            height: 50px;
            width: 100%;
        }

        .search-wrapper:hover, .search-box:hover {
            box-shadow: 0 5px 20px rgba(242, 107, 55, 0.12);
            border-color: rgba(242, 107, 55, 0.25);
            transform: translateY(-1px);
        }

        .search-wrapper:focus-within, .search-box:focus-within {
            border-color: var(--primary-color);
            box-shadow: 0 6px 25px rgba(242, 107, 55, 0.2);
            transform: translateY(-2px);
        }

        .search-input {
            border: none;
            padding: 14px 18px;
            font-size: 14px;
            flex: 1;
            background: transparent;
            color: var(--text-dark);
            font-weight: 500;
            border-radius: 25px 0 0 25px;
        }

        .search-input:focus {
            outline: none;
            box-shadow: none;
        }

        .search-input::placeholder {
            color: var(--text-light);
            font-weight: 400;
        }

        .search-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: var(--white);
            padding: 0 18px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            width: 50px;
            border-radius: 0 25px 25px 0;
        }

        .search-btn:hover {
            background: linear-gradient(135deg, var(--secondary-color), #d04119);
            transform: scale(1.02);
        }
        
        .search-icon-left {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 16px;
            z-index: 2;
        }
        
        /* Enhanced Navbar Styling - Same as Dashboard */
        .navbar {
            background: white !important;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08) !important;
            padding: 15px 0;
            border-bottom: 1px solid rgba(242, 107, 55, 0.1);
        }
        
        .navbar-brand {
            padding: 0;
            text-decoration: none !important;
        }
        
        .navbar-brand:hover {
            text-decoration: none !important;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .navbar-brand img {
            height: 45px !important;
            max-height: 45px;
            width: auto;
            object-fit: contain;
        }
        
        .brand-info {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }
        
        .brand-text {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }
        
        .brand-tagline {
            font-size: 12px;
            color: var(--text-light);
            font-weight: 500;
            margin: 0;
        }
        
        /* Search Container - Same as Dashboard */
        .search-container {
            max-width: 600px;
            width: 100%;
            position: relative;
        }
        
        .search-box {
            position: relative;
            background: white;
            border-radius: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 2px solid rgba(242, 107, 55, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .search-box:hover,
        .search-box:focus-within {
            border-color: var(--primary-color);
            box-shadow: 0 6px 30px rgba(242, 107, 55, 0.2);
            transform: translateY(-2px);
        }
        
        .search-icon-left {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            z-index: 3;
            font-size: 16px;
        }
        
        .search-input {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: none;
            outline: none;
            font-size: 15px;
            font-weight: 500;
            color: var(--text-dark);
            background: transparent;
            font-family: 'Montserrat', sans-serif;
        }
        
        .search-input::placeholder {
            color: var(--text-light);
            font-weight: 400;
        }
        
        .search-btn {
            position: absolute;
            right: 6px;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 20px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .search-btn:hover {
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 4px 15px rgba(242, 107, 55, 0.4);
        }
        
        .search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            margin-top: 8px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            z-index: 1000;
        }
        
        .suggestion-tag {
            background: rgba(242, 107, 55, 0.1);
            color: var(--primary-color);
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .suggestion-tag:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }
        
        <!-- Cart and User Actions */
        .nav-icon-wrapper {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(242, 107, 55, 0.08);
            transition: all 0.3s ease;
            border: 1px solid rgba(242, 107, 55, 0.15);
            min-width: 45px;
            min-height: 45px;
        }
        
        .nav-icon-wrapper:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
            border-color: var(--primary-color);
        }
        
        .nav-icon-wrapper i {
            color: var(--primary-color);
            font-size: 16px;
            transition: color 0.3s ease;
        }
        
        .nav-icon-wrapper:hover i {
            color: white;
        }
        
        .cart-badge, .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(242, 107, 55, 0.3);
        }
        
        /* Enhanced Navbar Actions */
        .navbar-actions {
            gap: 15px;
        }
        
        .profile-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: rgba(242, 107, 55, 0.08);
            border-radius: 25px;
            border: 1px solid rgba(242, 107, 55, 0.15);
            transition: all 0.3s ease;
        }
        
        .profile-info:hover {
            background: rgba(242, 107, 55, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(242, 107, 55, 0.2);
        }
        
        .avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }
        
        .user-details {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        
        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            line-height: 1.2;
        }
        
        .user-status {
            font-size: 11px;
            color: var(--primary-color);
            font-weight: 500;
        }
        
        .btn-nav-outline {
            padding: 8px 16px;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-nav-outline:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
        }
        
        .btn-nav-primary {
            padding: 8px 16px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-nav-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(242, 107, 55, 0.4);
            color: white;
        }
        
        /* Animation classes */
        .bounce {
            animation: bounce 2s infinite;
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                transform: translate3d(0, 0, 0);
            }
            40%, 43% {
                animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                transform: translate3d(0, -8px, 0);
            }
            70% {
                animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                transform: translate3d(0, -4px, 0);
            }
            90% {
                transform: translate3d(0, -2px, 0);
            }
        }
        
        /* Remove logo hover effect */
        .navbar-brand img {
            transition: none !important;
        }
        
        .navbar-brand:hover img {
            transform: none !important;
        }
        
        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 8px 0;
            margin-top: 8px;
        }
        
        .dropdown-item {
            padding: 12px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            color: var(--text-dark);
            border-radius: 8px;
            margin: 2px 8px;
        }
        
        .dropdown-item:hover {
            background: var(--primary-color) !important;
            color: white !important;
            transform: translateX(5px);
            box-shadow: 0 2px 10px rgba(242, 107, 55, 0.3);
        }
        
        .dropdown-item:focus {
            background: var(--primary-color) !important;
            color: white !important;
        }
        
        .dropdown-item i {
            width: 20px;
        }
        
        /* Category Navigation Enhancement */
        .category-nav {
            background: var(--light-bg) !important;
            padding: 12px 0 !important;
            border-bottom: 1px solid var(--border-color) !important;
        }
        
        .category-nav .btn-link {
            font-weight: 600 !important;
            text-decoration: none !important;
        }
        
        .category-nav .dropdown-menu {
            border: none;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 8px 0;
        }
        
        .category-nav .dropdown-item {
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: var(--text-dark);
            border-radius: 8px;
            margin: 2px 8px;
        }
        
        .category-nav .dropdown-item:hover {
            background: var(--primary-color) !important;
            color: white !important;
            transform: translateX(8px);
            box-shadow: 0 3px 12px rgba(242, 107, 55, 0.4);
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <!-- Navbar (same as Dashboard) -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <div class="logo-container">
                    <img src="{{ asset('image/logo_yogya.png') }}" alt="MyYOGYA" height="45">
                    <div class="brand-info">
                        <span class="brand-text">MyYOGYA</span>
                        <span class="brand-tagline">Belanja Pintar</span>
                    </div>
                 </div>
            </a>

            <!-- Search Bar -->
            <div class="search-container mx-auto">
                <div class="search-box">
                    <div class="search-icon-left">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" class="form-control search-input" placeholder="Cari produk, kategori, atau brand favorit Anda...">
                    <button class="search-btn">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                <div class="search-suggestions">
                    <span class="suggestion-tag">Elektronik</span>
                    <span class="suggestion-tag">Fashion</span>
                    <span class="suggestion-tag">Makanan</span>
                </div>
            </div>

            <!-- User Actions -->
            <div class="navbar-actions d-flex align-items-center">
                @auth
                    <!-- Logged in user -->
                    <div class="nav-item dropdown me-3">
                        <a class="nav-link notification-link" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge pulse">3</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu notification-dropdown">
                            <li><h6 class="dropdown-header">
                                <i class="fas fa-bell me-2"></i>Notifikasi Terbaru
                            </h6></li>
                            <li><a class="dropdown-item" href="#">
                                <div class="notification-item">
                                    <i class="fas fa-shipping-fast text-success"></i>
                                    <span>Pesanan Anda sedang dikirim</span>
                                </div>
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <div class="notification-item">
                                    <i class="fas fa-bolt text-warning"></i>
                                    <span>Flash Sale dimulai dalam 1 jam</span>
                                </div>
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <div class="notification-item">
                                    <i class="fas fa-gift text-primary"></i>
                                    <span>Voucher baru tersedia</span>
                                </div>
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center fw-bold" href="#">Lihat Semua Notifikasi</a></li>
                        </ul>
                    </div>

                    <div class="nav-item me-3">
                        <a class="nav-link cart-link" href="#">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-badge bounce">2</span>
                            </div>
                        </a>
                    </div>

                    <div class="nav-item dropdown">
                        <a class="nav-link profile-link" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="profile-info">
                                <div class="avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="user-details">
                                    <span class="user-name">{{ $user ? $user->name : 'User' }}</span>
                                    <span class="user-status">Premium Member</span>
                                </div>
                                <i class="fas fa-chevron-down ms-2"></i>
                            </div>
                        </a>
                        <ul class="dropdown-menu profile-dropdown">
                            <li class="dropdown-header">
                                <div class="profile-header">
                                    <div class="avatar-large">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $user ? $user->name : 'User' }}</h6>
                                        <small class="text-muted">Premium Member</small>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile Saya</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-box me-2"></i>Pesanan Saya</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-heart me-2"></i>Wishlist</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-wallet me-2"></i>Dompet Digital</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('pelanggan.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Guest user -->
                    <div class="nav-item me-2">
                        <a href="{{ route('pelanggan.login') }}" class="btn btn-nav-outline">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('pelanggan.register') }}" class="btn btn-nav-primary">
                            <i class="fas fa-user-plus me-2"></i>Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Category Navigation -->
    <div class="category-nav" style="background: var(--light-bg); padding: 12px 0; border-bottom: 1px solid var(--border-color);">
        <div class="container">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard') }}" class="me-4 text-decoration-none" style="color: var(--text-dark);">
                    <i class="fas fa-home"></i> Beranda
                </a>
                
                <div class="dropdown me-4">
                    <button class="btn btn-link dropdown-toggle p-0 text-decoration-none" style="color: var(--primary-color);" data-bs-toggle="dropdown">
                        <i class="fas fa-th-grid"></i> Kategori
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('kategori.elektronik') }}">📱 Elektronik</a></li>
                        <li><a class="dropdown-item" href="{{ route('kategori.fashion') }}">👕 Fashion</a></li>
                        <li><a class="dropdown-item" href="{{ route('kategori.makanan-minuman') }}">🍔 Makanan & Minuman</a></li>
                        <li><a class="dropdown-item" href="{{ route('kategori.kesehatan-kecantikan') }}">💄 Kesehatan & Kecantikan</a></li>
                        <li><a class="dropdown-item" href="{{ route('kategori.rumah-tangga') }}">🏠 Rumah Tangga</a></li>
                        <li><a class="dropdown-item" href="{{ route('kategori.olahraga') }}">⚽ Olahraga</a></li>
                        <li><a class="dropdown-item" href="{{ route('kategori.otomotif') }}">🚗 Otomotif</a></li>
                        <li><a class="dropdown-item" href="{{ route('kategori.buku') }}">📚 Buku & Alat Tulis</a></li>
                        <li><a class="dropdown-item" href="{{ route('kategori.perawatan') }}">🧴 Perawatan Pribadi</a></li>
                    </ul>
                </div>
                
                <a href="#" class="me-4 text-decoration-none" style="color: var(--text-dark);">🔥 Promo</a>
                <a href="#" class="me-4 text-decoration-none" style="color: var(--text-dark);">⭐ Terlaris</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-custom mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        <h5 class="mb-2">MyYOGYA</h5>
                        <p>Platform belanja online terpercaya dengan ribuan produk berkualitas dan pelayanan terbaik untuk kepuasan Anda.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Tentang Kami</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('tentang') }}" class="footer-link">Tentang MyYOGYA</a></li>
                        <li><a href="#" class="footer-link">Karir</a></li>
                        <li><a href="#" class="footer-link">Press Release</a></li>
                        <li><a href="#" class="footer-link">Investor Relations</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Layanan</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('layanan') }}" class="footer-link">Bantuan</a></li>
                        <li><a href="{{ route('cara-belanja') }}" class="footer-link">Cara Belanja</a></li>
                        <li><a href="{{ route('pengiriman') }}" class="footer-link">Pengiriman</a></li>
                        <li><a href="{{ route('metode-pembayaran') }}" class="footer-link">Metode Pembayaran</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Kebijakan</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('syarat-ketentuan') }}" class="footer-link">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('kebijakan-privasi') }}" class="footer-link">Kebijakan Privasi</a></li>
                        <li><a href="#" class="footer-link">Kebijakan Return</a></li>
                        <li><a href="#" class="footer-link">Hak Kekayaan Intelektual</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Ikuti Kami</h6>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/toserbayogyaciamis57/" target="_blank" rel="noopener" title="Facebook Toserba YOGYA Ciamis" aria-label="Facebook" class="social-link me-3">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.google.com/maps?q=Jl.%20Perintis%20Kemerdekaan%20No.57%2C%20Ciamis%2C%20Kec.%20Ciamis%2C%20Kabupaten%20Ciamis%2C%20Jawa%20Barat%2046211%2C%20Indonesia" target="_blank" rel="noopener" title="Lihat lokasi di Google Maps (Jl. Perintis Kemerdekaan No.57, Ciamis · +62 265 777779)" aria-label="Lokasi" class="social-link me-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </a>
                        <a href="https://www.instagram.com/yogya_ciamis/reels/" target="_blank" rel="noopener" title="Instagram YOGYA Ciamis" aria-label="Instagram" class="social-link me-3">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/ToserbaYOGYA" target="_blank" rel="noopener" title="YouTube Toserba YOGYA" aria-label="YouTube" class="social-link">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="row">
                <div class="col-md-6">
                    <p class="footer-text">&copy; 2025 MyYOGYA. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="footer-text">Made from Selenium in Indonesia</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>