<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyYOGYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            display: flex;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            background-color: #fff;
        }

        .input {
            border-radius: 12px;
            height: 50px;
            padding: 10px 20px;
            border: 1px solid #ced4da;
        }

        .login-left {
            background-color: #F26B37;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            padding: 40px;
        }

        .login-right {
            flex: 1;
            padding: 60px 40px;
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
            pointer-events: none;
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
            /* tetap abu */
            outline: none;
            box-shadow: none !important;
            /* hilangkan border biru glow */
        }

        .input:focus+.form-label,
        .input:not(:placeholder-shown)+.form-label {
            top: 0;
            font-size: 0.75rem;
            color: #6c757d;
            /* tetap abu-abu */
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
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="login-card">
            <!-- Left Side -->
            <div class="login-left text-center">
                <h2 class="mb-4" style="font-family: Montserrat; "><b>MyYOGYA</b></h2>
                <img src="{{ asset('image/shopping.png') }}" alt="Illustration" class="img-fluid"
                    style="max-height: 300px;">
            </div>

            <!-- Right Side -->
            <div class="login-right">
                <div class="text-center mb-4">
                    <img src="{{ asset('image/logo_yogya.png') }}" alt="Yogya Logo" height="100">
                    <h2 class="mt-2" style="color : #F26B37;">AyoMasuk</h4>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="" method="POST">
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

                <!-- Garis pembatas -->
                <div class="d-flex align-items-center my-3">
                    <hr class="flex-grow-1">
                    <span class="mx-2 text-muted">atau</span>
                    <hr class="flex-grow-1">
                </div>

                <!-- Tombol Login Google -->
                <a href="" class="btn btn-outline-danger w-100 mb-3"
                    style="border-radius: 12px; height: 50px; padding: 10px;">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="24"
                        class="me-2">
                    Masuk dengan Google
                </a>


                <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="">Daftar disini!</a></small>
                </div>
            </div>
        </div>
    </div>
</body>

</html>