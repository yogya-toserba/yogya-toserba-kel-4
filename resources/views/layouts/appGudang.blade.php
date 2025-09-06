<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard Rantai Pasok - MyYOGYA')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <!-- Bootstrap JS dipindah ke footer -->
  

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

    /* Dark mode table styling */
    body.dark-mode .table {
      background-color: #2a2d3f !important;
      color: #e2e8f0 !important;
    }

    body.dark-mode .table th {
      background-color: #374151 !important;
      color: #d1d5db !important;
      border-color: #3a3d4a !important;
    }

    body.dark-mode .table td {
      color: #e2e8f0 !important;
      border-color: #3a3d4a !important;
    }

    body.dark-mode .table-light {
      background-color: #374151 !important;
    }

    body.dark-mode .table-hover tbody tr:hover {
      background-color: #4b5563 !important;
      color: #f3f4f6 !important;
    }

    body.dark-mode .card-header {
      background-color: #374151 !important;
      color: #d1d5db !important;
      border-bottom-color: #3a3d4a !important;
    }

    /* Dark mode text colors */
    body.dark-mode h1, body.dark-mode h2, body.dark-mode h3, 
    body.dark-mode h4, body.dark-mode h5, body.dark-mode h6 {
      color: #e2e8f0 !important;
    }

    body.dark-mode p, body.dark-mode span, body.dark-mode div {
      color: #d1d5db !important;
    }

    body.dark-mode .text-muted {
      color: #9ca3af !important;
    }

    body.dark-mode .fw-semibold, body.dark-mode strong {
      color: #e2e8f0 !important;
    }

    /* Action Dropdown Styling */
    .action-dropdown {
      position: relative;
      display: inline-block;
    }

    .action-dropdown-btn {
      background: #f8fafc !important;
      border: 1px solid #e2e8f0 !important;
      border-radius: 6px !important;
      padding: 6px 8px !important;
      color: #64748b !important;
      font-size: 14px !important;
      cursor: pointer !important;
      transition: all 0.2s ease !important;
      position: relative !important;
      z-index: 10 !important;
    }

    .action-dropdown-btn:hover {
      background: #f1f5f9 !important;
      border-color: #cbd5e1 !important;
      color: #475569 !important;
    }

    .action-dropdown-btn:focus {
      outline: none !important;
      box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5) !important;
    }

    body.dark-mode .action-dropdown-btn {
      background: #374151 !important;
      border-color: #4b5563 !important;
      color: #9ca3af !important;
    }

    body.dark-mode .action-dropdown-btn:hover {
      background: #4b5563 !important;
      border-color: #6b7280 !important;
      color: #d1d5db !important;
    }

    .action-dropdown-menu {
      position: absolute;
      top: 100%;
      right: 0;
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      min-width: 120px;
      z-index: 9999 !important;
      display: none;
    }

    body.dark-mode .action-dropdown-menu {
      background: #374151;
      border-color: #4b5563;
    }

    .action-dropdown-item {
      display: block;
      padding: 8px 12px;
      color: #374151;
      text-decoration: none;
      font-size: 0.875rem;
      transition: background-color 0.2s ease;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
    }

    .action-dropdown-item:hover {
      background: #f8fafc;
      color: #1e293b;
    }

    body.dark-mode .action-dropdown-item {
      color: #d1d5db;
    }

    body.dark-mode .action-dropdown-item:hover {
      background: #4b5563;
      color: #f3f4f6;
    }

    .action-dropdown-item.view-item {
      color: #059669;
    }

    .action-dropdown-item.edit-item {
      color: #2563eb;
    }

    .action-dropdown-item.delete-item {
      color: #dc2626;
    }

    /* Badge styling for dark mode */
    body.dark-mode .badge.bg-light {
      background-color: #4b5563 !important;
      color: #d1d5db !important;
      border-color: #6b7280 !important;
    }

    body.dark-mode .text-dark {
      color: #e2e8f0 !important;
    }

    /* Footer styling for dark mode */
    body.dark-mode .card-footer {
      background-color: #374151 !important;
      color: #d1d5db !important;
      border-top-color: #3a3d4a !important;
    }

    /* Dark mode for tables */
    body.dark-mode .table {
      background-color: #2a2d3f !important;
      color: #e2e8f0 !important;
    }

    body.dark-mode .table th {
      background-color: #374151 !important;
      color: #9ca3af !important;
      border-color: #3a3d4a !important;
    }

    body.dark-mode .table td {
      background-color: #2a2d3f !important;
      color: #e2e8f0 !important;
      border-color: #3a3d4a !important;
    }

    body.dark-mode .table-light {
      background-color: #374151 !important;
    }

    body.dark-mode .table-hover tbody tr:hover {
      background-color: #3a3d4a !important;
      color: #f3f4f6 !important;
    }

    /* Dark mode for cards header */
    body.dark-mode .card-header {
      background-color: #374151 !important;
      border-color: #3a3d4a !important;
      color: #e2e8f0 !important;
    }

    body.dark-mode .card-header.bg-white {
      background-color: #374151 !important;
    }

    /* Dark mode for filter box */
    body.dark-mode .filter-box {
      background-color: #2a2d3f !important;
      border-color: #3a3d4a !important;
      color: #e2e8f0 !important;
    }

    /* Dark mode for form controls */
    body.dark-mode .form-control,
    body.dark-mode .form-select {
      background-color: #374151 !important;
      border-color: #4b5563 !important;
      color: #e2e8f0 !important;
    }

    body.dark-mode .form-control:focus,
    body.dark-mode .form-select:focus {
      background-color: #374151 !important;
      border-color: #f26b37 !important;
      color: #e2e8f0 !important;
      box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
    }

    body.dark-mode .form-control::placeholder {
      color: #9ca3af !important;
    }

    /* Dark mode for badges */
    body.dark-mode .badge {
      color: #1f2937 !important;
    }

    /* Dark mode for buttons */
    body.dark-mode .btn-outline-primary {
      border-color: #f26b37 !important;
      color: #f26b37 !important;
    }

    body.dark-mode .btn-outline-primary:hover {
      background-color: #f26b37 !important;
      border-color: #f26b37 !important;
      color: white !important;
    }

    body.dark-mode .btn-outline-success {
      border-color: #10b981 !important;
      color: #10b981 !important;
    }

    body.dark-mode .btn-outline-success:hover {
      background-color: #10b981 !important;
      border-color: #10b981 !important;
      color: white !important;
    }

    body.dark-mode .btn-outline-info {
      border-color: #0ea5e9 !important;
      color: #0ea5e9 !important;
    }

    body.dark-mode .btn-outline-info:hover {
      background-color: #0ea5e9 !important;
      border-color: #0ea5e9 !important;
      color: white !important;
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

    body.dark-mode .data-table th { 
      background-color: #374151 !important; 
      color: #9ca3af !important;
    }
    
    .data-table tr:hover { 
      background-color: #f9f9f9; 
    }

    body.dark-mode .data-table tr:hover { 
      background-color: #3a3d4a !important; 
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

    /* Dark mode for modals */
    body.dark-mode .modal-content {
      background-color: #2a2d3f !important;
      border-color: #3a3d4a !important;
      color: #e2e8f0 !important;
    }

    body.dark-mode .modal-header {
      background-color: #f26b37 !important;
      border-bottom-color: #3a3d4a !important;
    }

    body.dark-mode .modal-body {
      background-color: #2a2d3f !important;
    }

    body.dark-mode .form-control,
    body.dark-mode .form-select {
      background-color: #374151 !important;
      border-color: #4b5563 !important;
      color: #e2e8f0 !important;
    }

    body.dark-mode .form-control:focus,
    body.dark-mode .form-select:focus {
      background-color: #374151 !important;
      border-color: #f26b37 !important;
      color: #e2e8f0 !important;
      box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
    }

    body.dark-mode .form-control::placeholder {
      color: #9ca3af !important;
    }

    body.dark-mode .form-label {
      color: #e2e8f0 !important;
    }

    body.dark-mode .btn-light {
      background-color: #4b5563 !important;
      border-color: #6b7280 !important;
      color: #e2e8f0 !important;
    }

    body.dark-mode .btn-light:hover {
      background-color: #6b7280 !important;
      border-color: #9ca3af !important;
      color: #f3f4f6 !important;
    }

    /* Dropdown action styles */
    .action-dropdown {
      position: relative;
      display: inline-block;
    }

    .action-dropdown-btn {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 6px;
      padding: 6px 8px;
      color: #64748b;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .action-dropdown-btn:hover {
      background: #f1f5f9;
      border-color: #cbd5e1;
      color: #475569;
    }

    body.dark-mode .action-dropdown-btn {
      background: #374151;
      border-color: #4b5563;
      color: #9ca3af;
    }

    body.dark-mode .action-dropdown-btn:hover {
      background: #4b5563;
      border-color: #6b7280;
      color: #d1d5db;
    }

    .action-dropdown-menu {
      position: absolute;
      top: 100%;
      right: 0;
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      min-width: 140px;
      z-index: 9999;
      display: none;
    }

    body.dark-mode .action-dropdown-menu {
      background: #374151;
      border-color: #4b5563;
    }

    .action-dropdown-item {
      display: block;
      padding: 8px 12px;
      color: #374151;
      text-decoration: none;
      font-size: 0.875rem;
      transition: background-color 0.2s ease;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
    }

    .action-dropdown-item:hover {
      background: #f8fafc;
      color: #1e293b;
    }

    body.dark-mode .action-dropdown-item {
      color: #d1d5db;
    }

    body.dark-mode .action-dropdown-item:hover {
      background: #4b5563;
      color: #f3f4f6;
    }

    .action-dropdown-item.view-item {
      color: #059669;
    }

    .action-dropdown-item.edit-item {
      color: #2563eb;
    }

    .action-dropdown-item.delete-item {
      color: #dc2626;
    }

    body.dark-mode .badge {
      color: #e2e8f0 !important;
    }

    body.dark-mode .bg-light {
      background-color: #374151 !important;
      border-color: #4b5563 !important;
    }

    body.dark-mode .text-dark {
      color: #e2e8f0 !important;
    }

    body.dark-mode .text-muted {
      color: #9ca3af !important;
    }

    body.dark-mode .card-footer {
      background-color: #2a2d3f !important;
      border-color: #3a3d4a !important;
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

    /* Chat Badge Styling */
    .chat-badge {
      position: absolute;
      top: -5px;
      right: -8px;
      background: #dc3545;
      color: white;
      border-radius: 50%;
      min-width: 18px;
      height: 18px;
      font-size: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      z-index: 10;
      border: 2px solid #ffffff;
    }

    .nav-icon {
      position: relative;
    }

    body.dark-mode .chat-badge {
      border-color: #2a2d3f;
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
  
  <!-- jQuery - REQUIRED for chat functionality -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  @stack('scripts')

</body>
</html>
