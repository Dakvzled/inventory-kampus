<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .card { border: none; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        
        /* Style Tabs sama seperti Admin */
        .nav-tabs .nav-link { color: #6c757d; border: none; padding: 1rem 1.5rem; font-weight: 500; }
        .nav-tabs .nav-link:hover { color: #0d6efd; background: rgba(13, 110, 253, 0.05); border-radius: 5px 5px 0 0; }
        .nav-tabs .nav-link.active { color: #0d6efd; border-bottom: 3px solid #0d6efd; background: transparent; font-weight: bold; }

        /* Style Kartu Gradient (Sama seperti Admin) */
        .card-stat { border: none; border-radius: 10px; color: white; transition: transform 0.3s; }
        .card-stat:hover { transform: translateY(-5px); }
        .card-stat .icon-bg { position: absolute; right: 15px; bottom: 15px; font-size: 3.5rem; opacity: 0.2; }
        
        .bg-gradient-primary { background: linear-gradient(135deg, #4e73df, #224abe); }
        .bg-gradient-info { background: linear-gradient(135deg, #36b9cc, #258391); } /* Warna Cyan */
        .bg-gradient-warning { background: linear-gradient(135deg, #f6c23e, #dda20a); }
    </style>
</head>
<body>

    <div class="container mt-5 mb-5">
        <div class="card">
            
            <div class="card-header bg-white pt-4 pb-0 border-bottom-0">
                <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                    <h4 class="fw-bold text-primary mb-0"><i class="fa-solid fa-graduation-cap me-2"></i>Portal Mahasiswa</h4>
                    
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2 text-dark fw-bold">Halo, {{ Auth::user()->name }}</span>
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width: 35px; height: 35px;">
                                <i class="fa-solid fa-user text-primary"></i>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser1">
                            <li><h6 class="dropdown-header">User Account</h6></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user-gear me-2 text-muted"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-right-from-bracket me-2"></i>Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <ul class="nav nav-tabs card-header-tabs" style="margin-bottom: -1px;">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('user.dashboard') }}">Dashboard Saya</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.catalog') }}">Katalog Peminjaman</a></li>
                </ul>
            </div>

            <div class="card-body p-4 bg-white rounded-bottom">
                
                <h5 class="text-secondary mb-4">Status Peminjaman Anda</h5>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card card-stat bg-gradient-primary h-100 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-uppercase mb-1 opacity-75">Barang Tersedia</h6>
                                    <h2 class="display-6 fw-bold mb-0">{{ $availableItems ?? 0 }}</h2>
                                </div>
                                <i class="fa-solid fa-box-open icon-bg"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-stat bg-gradient-warning h-100 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-uppercase mb-1 opacity-75">Sedang Dipinjam</h6>
                                    <h2 class="display-6 fw-bold mb-0">0</h2>
                                </div>
                                <i class="fa-solid fa-clock icon-bg"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-stat bg-gradient-info h-100 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-uppercase mb-1 opacity-75">Riwayat</h6>
                                    <h2 class="display-6 fw-bold mb-0">0</h2>
                                </div>
                                <i class="fa-solid fa-history icon-bg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-light border mt-4 d-flex align-items-center shadow-sm">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-info"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Panduan Peminjaman</h6>
                        <small class="text-muted">Untuk meminjam barang, silakan klik menu <b>Katalog Peminjaman</b> di atas, pilih barang, dan klik tombol Pinjam.</small>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>