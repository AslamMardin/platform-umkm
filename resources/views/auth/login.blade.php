<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DesainKemas</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #800000 0%, #4b0000 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .logo-section {
            background: linear-gradient(135deg, #a83232 0%, #800000 100%);
            color: white;
            padding: 3rem 0;
            text-align: center;
        }

        .logo-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .form-section {
            padding: 3rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #a83232;
            box-shadow: 0 0 0 0.2rem rgba(168, 50, 50, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, #a83232 0%, #800000 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(128, 0, 0, 0.3);
        }

        .divider {
            text-align: center;
            margin: 2rem 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #dee2e6;
        }

        .divider span {
            background: white;
            padding: 0 1rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="login-card">
                    <div class="row g-0">
                        <!-- Logo Section -->
                        <div class="col-lg-5">
                            <div class="logo-section d-flex flex-column justify-content-center h-100">
                                <div>
                                    <i class="fas fa-box-open fa-4x mb-3"></i>
                                    <h1 class="logo-title">UMKM Pekkabata</h1>
                                    <p class="mb-0">Platform Desain Kemasan untuk UMKM</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Section -->
                        <div class="col-lg-7">
                            <div class="form-section">
                                <h2 class="mb-4 text-center">Masuk ke Akun Anda</h2>

                                {{-- Tampilkan error login jika ada --}}
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                {{-- Tampilkan validasi error --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}" id="loginForm">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-envelope text-muted"></i>
                                            </span>
                                            <input type="email" class="form-control border-start-0" id="email"
                                                name="email" placeholder="Masukkan email Anda" required
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-lock text-muted"></i>
                                            </span>
                                            <input type="password" class="form-control border-start-0" id="password"
                                                name="password" placeholder="Masukkan password Anda" required>
                                            <button class="btn btn-outline-secondary border-start-0" type="button"
                                                id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                                        <label class="form-check-label" for="rememberMe">
                                            Ingat saya
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-login btn-primary w-100 mb-3">
                                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                    </button>
                                </form>



                                <div class="text-center">
                                    <p class="mb-0">Belum punya akun?
                                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Daftar
                                            sekarang</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>
