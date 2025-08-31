<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard Rantai Pasok - MyYOGYA')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body { 
      background-color: #f5f7fa; 
      font-family: 'Segoe UI', sans-serif; 
      margin: 0; 
      padding: 0; 
    }
    
    /* UPDATED SIDEBAR STYLES */
    .main-content { 
      margin-left: 280px !important; /* Updated to match new sidebar width */
      padding: 20px 25px !important; /* Better content padding */
      min-height: 100vh;
      background: #f8fafc !important;
      transition: all 0.3s ease;
    }

    /* Dark mode support */
    body.dark-mode .main-content {
      background: #1a1d29 !important;
    }

    body.dark-mode {
      background-color: #1a1d29;
      color: #e2e8f0;
    }

    /* Dark mode for dashboard elements */
    body.dark-mode .card {
      background-color: #2a2d3f !important;
      border-color: #3a3d4a !important;
      color: #e2e8f0 !important;
    }

    body.dark-mode .bg-white {
      background-color: #2a2d3f !important;
    }

    body.dark-mode .text-dark {
      color: #e2e8f0 !important;
    }

    body.dark-mode .border {
      border-color: #3a3d4a !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 80px !important;
        padding: 15px 20px !important;
      }
    }
    
    .filter-box { 
      background: white; 
      padding: 15px; 
      border-radius: 8px; 
      box-shadow: 0 2px 8px rgba(0,0,0,0.05); 
    }
    
    .card-summary { 
      border: none; 
      border-radius: 12px; 
      padding: 15px; 
      color: white; 
      box-shadow: 0 2px 10px rgba(0,0,0,0.08); 
      transition: 0.3s; 
    }
    
    .card-summary:hover { 
      transform: translateY(-3px); 
    }
    
    .bg-primary-custom { 
      background-color: #07BEFC; 
    }
    
    .bg-success-custom { 
      background-color: #4caf50; 
    }
    
    .bg-danger-custom { 
      background-color: #f44336; 
    }
    
    .bg-warning-custom { 
      background-color: #ff9800; 
    }
    
    .data-table th { 
      background-color: #fafafa; 
    }
    
    .data-table tr:hover { 
      background-color: #f9f9f9; 
    }

    .btn-green {
      background-color: #4CAF50;
      color: white;
      border: none;
    }
    
    .btn-green:hover {
      background-color: #45a049;
    }
    
    .btn-delete {
      background-color: #f44336;
      color: white;
      border: none;
    }
    
    .btn-delete:hover {
      background-color: #d32f2f;
    }
    
    th {
      white-space: nowrap;
    }

    /* Enhanced Content Layout */
    .content-wrapper {
      max-width: 100%;
      margin: 0 auto;
      padding: 0;
    }

    .page-header {
      background: white;
      border-radius: 10px;
      padding: 20px 25px;
      margin-bottom: 25px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      border-left: 4px solid #f26b37;
    }

    body.dark-mode .page-header {
      background: #2a2d3f;
      color: #e2e8f0;
      border-left-color: #f26b37;
    }

    .page-title {
      font-size: 24px;
      font-weight: 600;
      margin: 0;
      color: #2c3e50;
    }

    body.dark-mode .page-title {
      color: #e2e8f0;
    }

    .card {
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      border: 1px solid #e3e6f0;
    }

    /* RESPONSIVE SIDEBAR */
    @media (max-width: 1200px) {
      .main-content {
        margin-left: 0 !important;
        padding: 15px !important;
      }
      
      .page-header {
        padding: 15px 20px;
        margin-bottom: 20px;
      }
      
      .page-title {
        font-size: 20px;
      }
    }
  </style>
  
  @stack('styles')
</head>
<body>

  @include('layouts.sidebar')

  <div class="main-content">
    @yield('content')
  </div>
     @stack('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
