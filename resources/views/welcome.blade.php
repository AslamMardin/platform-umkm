<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platform Desain Kemasan UMKM</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #800000 0%, #4b0000 100%);
        }

        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #a83232 0%, #800000 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 1rem;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #a83232 0%, #800000 100%);
            border: none;
            transition: transform 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #a83232 0%, #800000 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .mockup-preview {
            max-width: 300px;
            height: 200px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .custom-img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-box-open me-2"></i>UMKM UNASMAN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-4">
                    <li class="nav-item">
                        <a class="nav-link" href="#beranda">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>

                    <li class="nav-item">
                    </li>
                </ul>
                {{-- ✅ Auth-aware Buttons --}}
                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-columns me-2"></i>Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">
                                    <i class="fas fa-user me-2"></i>Profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-cog me-2"></i>Ubah Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirmLogout();">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-gradient text-white">Daftar</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero-section gradient-bg text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-1">
                        Desain Kemasan Produk UMKM anda Jadi Mudah!
                    </h1>
                    <span id="typed" class="d-block"></span>
                    <div class="d-flex gap-3 mb-5 mt-2">
                        <a href="{{ route('template') }}" class="btn btn-light btn-lg px-4">
                            <i class="fas fa-eye me-2"></i> Lihat Template
                        </a>

                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <img src="{{ asset('storage/img/kotak-brand.png') }}" alt="Kotak Brand"
                            class="img-fluid custom-img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Fitur Unggulan Platform ini</h2>
                <p class="text-muted">Semua yang Anda butuhkan untuk membuat kemasan yang menarik</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <h5 class="fw-bold">banyak Template</h5>
                    <p class="text-muted">Berbagai pilihan mockup kemasan nasi kotak dengan angle dan style berbeda</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h5 class="fw-bold">Kustomisasi</h5>
                    <p class="text-muted">Kamu bisa Upload logo, tambah text, atur warna, ukuran dan posisi sesuai
                        keinginan</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-font"></i>
                    </div>
                    <h5 class="fw-bold">Pilihan Font</h5>
                    <p class="text-muted">Berbagai jenis font untuk memberikan karakter unik pada brand Anda</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <h5 class="fw-bold">Multi Format Export</h5>
                    <p class="text-muted">Export hasil desain dalam format PNG, JPG, atau PDF sesuai kebutuhan</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-save"></i>
                    </div>
                    <h5 class="fw-bold">Save Project</h5>
                    <p class="text-muted">Simpan dan edit kembali desain Anda kapan saja tanpa kehilangan progress</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h5 class="fw-bold">Gratis dan berbayar</h5>
                    <p class="text-muted">Pemakaian template terbatas</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 gradient-bg text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Siap Membuat Kemasan yang Menawan?</h2>
            <p class="lead mb-4">Bergabung di UMKM UNASMAN yang sudah dipercaya</p>
            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5">
                Gabung Sekarang - Gratis!
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="bg-dark text-white py-5">
        <center>

            <h5 class="fw-bold mb-3">
                <i class="fas fa-box-open me-2"></i>Platform UMKM
            </h5>
        </center>

    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        var typed = new Typed('#typed', {
            strings: ['Selamat datang!', 'Desain kemasan di sini!', 'Mudah dan praktis!'],
            typeSpeed: 50,
            backSpeed: 30,
            loop: true
        });
    </script>
</body>

</html>
