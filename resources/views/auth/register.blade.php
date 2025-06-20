<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Flatform</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f3e9dc 0%, #c8b6a6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .register-card {
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

        .btn-register {
            background: linear-gradient(135deg, #a83232 0%, #800000 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(128, 0, 0, 0.3);
        }

        .password-strength {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            margin-top: 5px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak {
            background: #dc3545;
        }

        .strength-medium {
            background: #ffc107;
        }

        .strength-strong {
            background: #28a745;
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
                <div class="register-card">
                    <div class="row g-0">
                        <!-- Logo Section -->
                        <div class="col-lg-5">
                            <div class="logo-section d-flex flex-column justify-content-center h-100">
                                <div>
                                    <i class="fas fa-box-open fa-4x mb-3"></i>
                                    <h1 class="logo-title">Flatform UMKM</h1>
                                    <p class="mb-0">Mulai desain kemasan impian Anda</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Section -->
                        <div class="col-lg-7">
                            <div class="form-section">
                                <h2 class="mb-4 text-center">Buat Akun Baru</h2>


                                {{-- Menampilkan validasi error --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form id="registerForm" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="firstName" class="form-label">Nama Depan</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0">
                                                    <i class="fas fa-user text-muted"></i>
                                                </span>
                                                <input type="text" class="form-control border-start-0" id="firstName"
                                                    name="first_name" placeholder="Nama depan" required
                                                    value="{{ old('first_name') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="lastName" class="form-label">Nama Belakang</label>
                                            <input type="text" class="form-control" id="lastName" name="last_name"
                                                placeholder="Nama belakang" required value="{{ old('last_name') }}">
                                        </div>
                                    </div>



                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-envelope text-muted"></i>
                                            </span>
                                            <input type="email" class="form-control border-start-0" id="email"
                                                name="email" placeholder="email@example.com" required
                                                value="{{ old('email') }}">
                                        </div>
                                        <div class="form-text" id="emailFeedback"></div>
                                    </div>



                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-lock text-muted"></i>
                                            </span>
                                            <input type="password" class="form-control border-start-0" id="password"
                                                name="password" placeholder="Minimal 8 karakter" required>
                                            <button class="btn btn-outline-secondary border-start-0" type="button"
                                                id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="password-strength">
                                            <div class="password-strength-bar" id="strengthBar"></div>
                                        </div>
                                        <small class="form-text text-muted" id="strengthText">Password harus minimal 8
                                            karakter</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-lock text-muted"></i>
                                            </span>
                                            <input type="password" class="form-control border-start-0"
                                                id="confirmPassword" name="password_confirmation"
                                                placeholder="Ulangi password" required>
                                        </div>
                                        <div class="form-text" id="passwordMatch"></div>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                                        <label class="form-check-label" for="agreeTerms">
                                            Saya setuju dengan <a href="#" class="text-decoration-none">Syarat &
                                                Ketentuan</a> dan <a href="#"
                                                class="text-decoration-none">Kebijakan Privasi</a>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-register btn-primary w-100 mb-3">
                                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                                    </button>
                                </form>


                                <div class="text-center">
                                    <p class="mb-0">Sudah punya akun?
                                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Masuk di
                                            sini</a>
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

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');

            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^A-Za-z0-9]/)) strength++;

            strengthBar.style.width = (strength * 20) + '%';

            if (strength < 2) {
                strengthBar.className = 'password-strength-bar strength-weak';
                strengthText.textContent = 'Password lemah';
                strengthText.className = 'form-text text-danger';
            } else if (strength < 4) {
                strengthBar.className = 'password-strength-bar strength-medium';
                strengthText.textContent = 'Password sedang';
                strengthText.className = 'form-text text-warning';
            } else {
                strengthBar.className = 'password-strength-bar strength-strong';
                strengthText.textContent = 'Password kuat';
                strengthText.className = 'form-text text-success';
            }
        });

        // Confirm password checker
        document.getElementById('confirmPassword').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            const feedback = document.getElementById('passwordMatch');

            if (confirmPassword === '') {
                feedback.textContent = '';
                return;
            }

            if (password === confirmPassword) {
                feedback.textContent = 'Password cocok';
                feedback.className = 'form-text text-success';
            } else {
                feedback.textContent = 'Password tidak cocok';
                feedback.className = 'form-text text-danger';
            }
        });

        // Email validation
        document.getElementById('email').addEventListener('blur', function() {
            const email = this.value;
            const feedback = document.getElementById('emailFeedback');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email === '') {
                feedback.textContent = '';
                return;
            }

            if (emailRegex.test(email)) {
                feedback.textContent = 'Format email valid';
                feedback.className = 'form-text text-success';
            } else {
                feedback.textContent = 'Format email tidak valid';
                feedback.className = 'form-text text-danger';
            }
        });
    </script>
</body>

</html>
