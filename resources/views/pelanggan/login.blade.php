<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Yogya Toserba</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --yogya-red: #F26B37;
      --yogya-blue: #00539B;
      --label-bg: #fff;
    }

    body {
      background: white;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      width: 100%;
      padding: 15px;
      max-width: 420px;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      padding: 2rem;
    }

    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .login-header img {
      height: 60px;
      margin-bottom: 1rem;
    }

    .login-title {
      color: var(--yogya-blue);
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .btn-login {
      background: var(--yogya-red);
      border: none;
      color: white;
      padding: 0.8rem;
      border-radius: 8px;
      font-weight: 500;
      width: 100%;
      margin-top: 1rem;
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      background: #f1581cff;
      transform: translateY(-1px);
      color: white;
    }

    .form-floating {
      position: relative;
      margin-bottom: 1.5rem;
    }

    .form-floating > .form-control {
      height: calc(3.5rem + 2px);
      padding: 1.5rem 0.75rem 0.5rem;
      border: 1px solid #ced4da;
      border-radius: 8px;
      transition: all 0.2s ease;
    }

    .form-floating > .form-control:focus {
      border-color: var(--yogya-blue);
      outline: none;
    }

    .form-floating > label {
      position: absolute;
      top: 0;
      left: 0;
      padding: 1rem 0.75rem;
      transition: all 0.3s ease;
      color: #6c757d;
      pointer-events: none;
      background-color: transparent;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
      transform: scale(0.85) translateY(-0.6rem) translateX(0.5rem);
      background: var(--label-bg);
      padding: 0 0.25rem;
      color: var(--yogya-blue);
    }

    /* Effect to hide only the part of border behind the label */
    .form-floating > label::before {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0.25rem;
      height: 1px;
      width: 100%;
      background: var(--label-bg);
      z-index: -1;
      transition: 0.2s;
    }

    .form-floating > .form-control:focus ~ label::before,
    .form-floating > .form-control:not(:placeholder-shown) ~ label::before {
      width: 70%;
    }

    .form-check-input:checked {
      background-color: var(--yogya-blue);
      border-color: var(--yogya-blue);
    }

    .invalid-feedback {
      margin-top: -0.5rem;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <img src="{{ asset('image/logo_yogya.png') }}" alt="Yogya Logo" style="mix-blend-mode: multiply;">
        <h4 class="login-title">Admin Login</h4>
        <p class="text-muted">Please login to access admin panel</p>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf

        <div class="form-floating mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" 
                 id="email" name="email" placeholder="Email Address" 
                 value="{{ old('email') }}" required autofocus>
          <label for="email">Email Address</label>
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-floating mb-3">
          <input type="password" class="form-control @error('password') is-invalid @enderror" 
                 id="password" name="password" placeholder="Password" required>
          <label for="password">Password</label>
          @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-check mb-3">
          <input type="checkbox" class="form-check-input" id="remember" name="remember">
          <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn btn-login">Login</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
