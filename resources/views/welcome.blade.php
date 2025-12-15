<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Inventaris Kampus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            /* Warna Biru Akademik/Institusi yang lebih formal */
            --primary-color: #003366; 
            --secondary-color: #d4a017; /* Aksen Emas/Kuning Kampus */
            --dark-overlay: rgba(0, 30, 60, 0.85); 
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        /* === Navbar Styling === */
        .navbar {
            transition: all 0.4s ease-in-out;
            padding: 1rem 0;
            background: transparent;
        }
        .navbar-scrolled {
            background-color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            padding: 0.8rem 0;
        }
        .navbar-brand {
            font-family: 'Merriweather', serif; /* Font Serif biar kesan akademis */
            font-weight: 700;
            font-size: 1.3rem;
            color: white !important;
            letter-spacing: 0.5px;
        }
        .nav-link {
            font-weight: 500;
            color: rgba(255,255,255,0.8) !important;
            transition: all 0.3s;
        }
        .nav-link:hover {
            color: var(--secondary-color) !important;
        }
        .navbar-toggler-icon {
            filter: invert(1);
        }

        /* === Hero Section === */
        .hero-section {
            position: relative;
            /* Gambar Background Gedung Kampus / Perpustakaan */
            background: linear-gradient(var(--dark-overlay), var(--dark-overlay)), 
                        url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding-top: 80px;
        }

        .hero-logo {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border: 2px solid rgba(255,255,255,0.2);
        }

        .hero-title {
            font-family: 'Merriweather', serif;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.3;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.8);
            max-width: 700px;
            margin: 0 auto 2.5rem;
            font-weight: 300;
        }

        /* === Buttons === */
        .btn-portal {
            padding: 0.8rem 2.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 4px; /* Sudut lebih kotak untuk kesan formal */
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-primary-campus {
            background-color: var(--secondary-color);
            color: #002244;
            border: none;
        }
        .btn-primary-campus:hover {
            background-color: #bfa12f;
            color: #001122;
            transform: translateY(-2px);
        }
        .btn-outline-campus {
            border: 1px solid rgba(255,255,255,0.6);
            color: white;
            background: rgba(0,0,0,0.2);
        }
        .btn-outline-campus:hover {
            background-color: white;
            color: var(--primary-color);
        }

        /* === Info Cards (Modul Sistem) === */
        .info-section {
            padding: 80px 0;
            background-color: white;
        }
        .section-header {
            margin-bottom: 50px;
            text-align: center;
        }
        .section-header h3 {
            font-family: 'Merriweather', serif;
            color: var(--primary-color);
            font-weight: 700;
        }
        .section-header .divider {
            width: 60px;
            height: 3px;
            background-color: var(--secondary-color);
            margin: 15px auto;
        }
        
        .info-card {
            padding: 30px;
            border: 1px solid #eee;
            border-radius: 8px;
            transition: all 0.3s;
            height: 100%;
            background: #fff;
        }
        .info-card:hover {
            box-shadow: 0 10px 30px rgba(0,51,102,0.1);
            transform: translateY(-5px);
            border-bottom: 3px solid var(--secondary-color);
        }
        .info-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        .info-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        .info-text {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* === Footer === */
        footer {
            background: var(--primary-color);
            color: rgba(255,255,255,0.7);
            padding: 25px 0;
            font-size: 0.85rem;
            border-top: 4px solid var(--secondary-color);
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 2rem; }
            .hero-section { padding-top: 60px; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fa-solid fa-graduation-cap me-2"></i>Campus Inventory Management
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary-campus btn-sm px-4 fw-bold shadow-sm">Dashboard Admin</a>
                            </li>
                        @else
                            <li class="nav-item me-2">
                                <span class="text-white-50 small me-2">Petugas / Admin?</span>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-outline-campus btn-sm px-4">Login Portal</a>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            
            <div class="hero-logo">
                <i class="fa-solid fa-building-columns fa-2x"></i>
            </div>

            <h1 class="hero-title">
                Sistem Informasi <br> Inventaris Kampus
            </h1>
            <p class="hero-subtitle">
                Portal terpadu pengelolaan aset, sarana, dan prasarana universitas. <br>
                Silakan login untuk mengakses data inventaris.
            </p>

            <div class="d-flex gap-3 justify-content-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-portal btn-primary-campus">
                            <i class="fa-solid fa-gauge-high me-2"></i>Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-portal btn-primary-campus">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Masuk Sistem
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-portal btn-outline-campus">
                                Daftar Akun
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

        </div>
        
        <div style="position: absolute; bottom: 0; left: 0; width: 100%; overflow: hidden; line-height: 0;">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 50px;">
                <path d="M1200 120L0 16.48V0h1200v120z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <section class="info-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h3>Lingkup Pengelolaan</h3>
                <div class="divider"></div>
                <p class="text-muted">Modul utama dalam sistem manajemen aset universitas.</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-card text-center">
                        <div class="info-icon">
                            <i class="fa-solid fa-microscope"></i>
                        </div>
                        <h5 class="info-title">Aset Laboratorium</h5>
                        <p class="info-text">Pencatatan alat-alat praktikum, bahan habis pakai, dan jadwal pemeliharaan alat lab.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="info-card text-center">
                        <div class="info-icon">
                            <i class="fa-solid fa-chair"></i>
                        </div>
                        <h5 class="info-title">Sarana Kelas</h5>
                        <p class="info-text">Inventarisasi meja, kursi, proyektor, dan kelengkapan ruang kuliah untuk menunjang KBM.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="info-card text-center">
                        <div class="info-icon">
                            <i class="fa-solid fa-file-contract"></i>
                        </div>
                        <h5 class="info-title">Laporan & Audit</h5>
                        <p class="info-text">Rekapitulasi jumlah aset, kondisi barang (Baik/Rusak), dan pelaporan untuk audit kampus.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container text-center">
            <p class="mb-1 fw-bold">Unit Pengelola Aset</p>
            <p class="mb-0 small opacity-75">&copy; {{ date('Y') }} Sistem Informasi Inventaris Kampus. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 800 });

        // Efek Navbar berubah warna saat scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>
</body>
</html>