<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .card { border: none; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .nav-tabs .nav-link { color: #6c757d; border: none; padding: 1rem 1.5rem; font-weight: 500; }
        .nav-tabs .nav-link:hover { color: #0d6efd; background: rgba(13, 110, 253, 0.05); border-radius: 5px 5px 0 0; }
        .nav-tabs .nav-link.active { color: #0d6efd; border-bottom: 3px solid #0d6efd; background: transparent; font-weight: bold; }
        
        /* WARNA STATUS BADGE */
        .badge-pending { background-color: #ffc107; color: #000; }  /* Kuning */
        .badge-approved { background-color: #198754; color: #fff; } /* Hijau */
        .badge-returned { background-color: #0d6efd; color: #fff; } /* Biru */
        .badge-rejected { background-color: #dc3545; color: #fff; } /* Merah (BARU) */
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-header bg-white pt-4 pb-0 border-bottom-0">
                <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                    <h4 class="fw-bold text-primary mb-0"><i class="fa-solid fa-layer-group me-2"></i>Admin Inventory</h4>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2 text-dark fw-bold">Halo, {{ Auth::user()->name ?? 'Admin' }}</span>
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width: 35px; height: 35px;"><i class="fa-solid fa-user text-primary"></i></div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser1">
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.addcategory') }}">Add Category</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewcategory') }}">View Category</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.additem') }}">Add Item</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewitem') }}">View Item</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.borrowings') }}">Requests</a></li>
                </ul>
            </div>

            <div class="card-body p-4 bg-white rounded-bottom">
                <h5 class="fw-bold text-secondary mb-4">Daftar Pengajuan Peminjaman</h5>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle border-bottom">
                        <thead class="table-light">
                            <tr>
                                <th>Peminjam</th>
                                <th>Detail Barang</th>
                                <th>Jadwal Pinjam</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($borrowings as $b)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                            <i class="fa-solid fa-user text-secondary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $b->user->name }}</div>
                                            <small class="text-muted">{{ $b->user->email }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="fw-bold">{{ $b->item->item_name }}</span><br>
                                    <small class="text-muted">Jml: {{ $b->amount }} unit</small>
                                </td>

                                <td>
                                    <small class="d-block text-muted">Pinjam: {{ $b->start_date }}</small>
                                    <small class="d-block text-danger">Kembali: {{ $b->return_date }}</small>
                                </td>

                                <td>
                                    @if($b->status == 'pending')
                                        <span class="badge badge-pending px-3 py-2">Menunggu</span>
                                    @elseif($b->status == 'approved')
                                        <span class="badge badge-approved px-3 py-2">Sedang Dipinjam</span>
                                    @elseif($b->status == 'rejected')
                                        <span class="badge badge-rejected px-3 py-2">Ditolak</span>
                                    @else
                                        <span class="badge badge-returned px-3 py-2">Dikembalikan</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($b->status == 'pending')
                                        <div class="d-flex justify-content-center gap-1">
                                            <form action="{{ route('admin.approve', $b->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-success btn-sm" onclick="return confirm('Setujui peminjaman ini?')">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.reject', $b->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Tolak pengajuan ini? Stok akan dikembalikan.')">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </form>
                                        </div>

                                    @elseif($b->status == 'approved')
                                        <form action="{{ route('admin.return', $b->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-primary btn-sm" onclick="return confirm('Barang sudah dikembalikan?')">
                                                <i class="fa-solid fa-box-archive me-1"></i> Selesai
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small"><i class="fa-solid fa-lock"></i> Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data peminjaman.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>