<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Barang - Portal Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .item-card { transition: transform 0.3s; border: none; border-radius: 10px; overflow: hidden; }
        .item-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .item-img { height: 200px; object-fit: cover; width: 100%; }
        .nav-link { color: #6c757d; }
        .nav-link.active { color: #0d6efd; font-weight: bold; border-bottom: 2px solid #0d6efd; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#"><i class="fa-solid fa-graduation-cap me-2"></i>Portal Mahasiswa</a>
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted">Halo, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item"><a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard Saya</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('user.catalog') }}">Katalog Peminjaman</a></li>
        </ul>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h4 class="mb-4 fw-bold text-secondary">Katalog Barang Kampus</h4>

        <div class="row g-4">
            @forelse($items as $item)
            <div class="col-md-3 col-sm-6">
                <div class="card item-card shadow-sm h-100">
                    <img src="{{ asset('item_images/' . $item->item_image) }}" class="item-img" alt="{{ $item->item_name }}">
                    
                    <div class="card-body">
                        <span class="badge bg-info text-dark bg-opacity-25 mb-2">{{ $item->category_name ?? 'Umum' }}</span>
                        <h5 class="card-title fw-bold mb-1">{{ $item->item_name }}</h5>
                        <p class="text-muted small mb-3">
                            Stok Tersedia: <span class="fw-bold text-dark">{{ $item->item_quantity }}</span>
                        </p>

                        <div class="d-grid">
                            @if($item->item_quantity > 0)
                                <button type="button" class="btn btn-primary btn-sm rounded-pill w-100" data-bs-toggle="modal" data-bs-target="#pinjamModal{{ $item->id }}">
                                    <i class="fa-solid fa-hand-holding-hand me-1"></i> Ajukan Pinjam
                                </button>
                            @else
                                <button class="btn btn-secondary btn-sm rounded-pill w-100" disabled>
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="pinjamModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Form Peminjaman Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('user.pinjam', $item->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 text-center">
                                    <h5 class="text-primary">{{ $item->item_name }}</h5>
                                    <small class="text-muted">Sisa Stok: {{ $item->item_quantity }}</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Jumlah Barang</label>
                                    <input type="number" name="amount" class="form-control" min="1" max="{{ $item->item_quantity }}" value="1" required>
                                    <small class="text-muted">Maksimal: {{ $item->item_quantity }} item</small>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-bold">Mulai Pinjam</label>
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-bold">Sampai Tanggal</label>
                                        <input type="date" name="return_date" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted">
                    <i class="fa-solid fa-box-open fa-3x mb-3"></i>
                    <p>Belum ada barang yang tersedia untuk dipinjam.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>