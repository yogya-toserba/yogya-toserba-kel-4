<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard Rantai Pasok - MyYOGYA')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body { background-color: #f5f7fa; font-family: 'Segoe UI', sans-serif; }
    .sidebar { height: 100vh; background: linear-gradient(180deg, #f44336, #ff7043); color: white; position: fixed; width: 175px; }
    .sidebar h4 { font-weight: bold; margin-bottom: 30px; }
    .sidebar a { color: white; text-decoration: none; display: block; padding: 12px 15px; border-radius: 6px; margin-bottom: 8px; transition: background 0.3s; }
    .sidebar a:hover, .sidebar a.active { background-color: rgba(255, 255, 255, 0.15); }
    .main-content { margin-left: 240px; padding: 20px; }
    .filter-box { background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    .card-summary { border: none; border-radius: 12px; padding: 15px; color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); transition: 0.3s; }
    .card-summary:hover { transform: translateY(-3px); }
    .bg-primary-custom { background-color: #07BEFC; }
    .bg-success-custom { background-color: #4caf50; }
    .bg-danger-custom { background-color: #f44336; }
    .bg-warning-custom { background-color: #ff9800; }
    .data-table th { background-color: #fafafa; }
    .data-table tr:hover { background-color: #f9f9f9; }

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
  </style>
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
