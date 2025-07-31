<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register - MyYOGYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .container-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }
        .card-container {
            width: 900px;
            height: 600px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            display: flex;
            transition: transform 0.6s ease-in-out;
        }
        .login-left, .login-right {
            flex: 1;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-left {
            background-color: #F26B37;
            color: white;
            align-items: center;
            text-align: center;
        }
        .login-left img {
            max-height: 300px;
        }
        .form-wrapper {
            width: 100%;
        }
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-label {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: #6c757d;
            transition: all 0.2s ease;
            background-color: white;
            padding: 0 4px;
        }
        .input {
            border-radius: 12px;
            height: 50px;
            padding: 10px 20px;
            border: 1px solid #ced4da;
            box-shadow: none !important;
        }
        .input:focus {
            border-color: #ced4da !important;
            outline: none;
            box-shadow: none !important;
        }
        .input:focus + .form-label,
        .input:not(:placeholder-shown) + .form-label {
            top: 0;
            font-size: 0.75rem;
            color: #6c757d;
        }
        .btn-login {
            background-color: #f1592a;
            color: white;
            border-radius: 12px;
            height: 50px;
        }
        .btn-login:hover {
            background-color: #e6531f;
            color: white;
        }

        /* Transisi slider */
        .card-container.register-active {
            transform: translateX(-100%);
        }

        .form-section {
            flex: 1;
            transition: opacity 0.3s ease;
        }

        .register-section, .login-section {
            min-width: 100%;
        }
    </style>
</head>
<body>

<div class="container-wrapper">
    <div class="card-container" id="card-container">
        <!-- Login Section -->
        <div class="form-section login-section">
            <div class="login-left text-center">
                <h2 class="mb-4" style="font-family: Montserrat;"><b>MyYOGYA</b></h2>
                <img src="{{ asset('image/shopping.png') }}" alt="Illustration" class="img-fluid">
            </div>
            <div class="login-right">
                <div class="text-center mb-4">
                    <img src="{{ asset('image/logo_yogya.png') }}" alt="Yogya Logo" height="100">
                    <h2 class="mt-2" style="color : #F26B37;">AyoMasuk</h2>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="username" class="form-control input" placeholder=" " required>
                        <label class="form-label">Email</label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control input" placeholder=" " required>
                        <label class="form-label">Password</label>
                    </div>
                    <button type="submit" class="btn btn-login w-100">Masuk</button>
                </form>
                <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="#" onclick="toggleForm()">Daftar disini!</a></small>
                </div>
            </div>
        </div>

        <!-- Register Section -->
        <div class="form-section register-section">
            <div class="login-left text-center">
                <h2 class="mb-4" style="font-family: Montserrat;"><b>Daftar</b></h2>
                <img src="{{ asset('image/shopping.png') }}" alt="Illustration" class="img-fluid">
            </div>
            <div class="login-right">
                <div class="text-center mb-4">
                    <img src="{{ asset('image/logo_yogya.png') }}" alt="Yogya Logo" height="100">
                    <h2 class="mt-2" style="color : #F26B37;">Buat Akun</h2>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control input" placeholder=" " required>
                        <label class="form-label">Nama Lengkap</label>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control input" placeholder=" " required>
                        <label class="form-label">Email</label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control input" placeholder=" " required>
                        <label class="form-label">Password</label>
                    </div>
                    <button type="submit" class="btn btn-login w-100">Daftar</button>
                </form>
                <div class="text-center mt-3">
                    <small>Sudah punya akun? <a href="#" onclick="toggleForm()">Masuk disini!</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleForm() {
        const card = document.getElementById('card-container');
        card.classList.toggle('register-active');
    }
</script>

</body>
</html>
