<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - View Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { border: none; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.05); }
        .nav-tabs .nav-link { color: #495057; border: none; padding: 1rem 1.5rem; font-weight: 500; }
        .nav-tabs .nav-link.active { color: #0d6efd; border-bottom: 3px solid #0d6efd; background: transparent; font-weight: bold; }
        .nav-tabs .nav-link:hover { color: #0d6efd; }
        .table-action-btn { transition: all 0.2s; }
        .table-action-btn:hover { transform: scale(1.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-box-open me-2"></i>Admin Inventory</a>
            <div class="d-flex text-white align-items-center">
                <span class="me-2">Halo, Admin</span>
                <i class="fa-solid fa-circle-user fa-lg"></i>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <div class="card-header bg-white pt-0 pb-0 border-bottom-0">
                <ul class="nav nav-tabs card-header-tabs" style="margin-bottom: -1px;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.addcategory') }}">Add Category</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.viewcategory') }}">View Category</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.additem') }}">Add Item</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('admin.viewitem') }}">View Item</a>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title fw-bold text-primary mb-0">List of All Items</h5>
                    <a href="{{ route('admin.additem') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                        <i class="fa-solid fa-plus me-1"></i> Add New Data
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center py-3" width="5%">No</th>
                                <th class="py-3" width="25%">Item Name</th>
                                <th class="text-center py-3" width="15%">Image</th>
                                <th class="text-center py-3" width="15%">Quantity</th>
                                <th class="text-center py-3" width="20%">Category</th>
                                <th class="text-center py-3" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $key => $data)
                            <tr>
                                <td class="text-center text-muted fw-bold">{{ $key + 1 }}</td>
                                
                                <td class="fw-bold text-dark">{{ $data->item_name }}</td>
                                
                                <td class="text-center">
                                    <div class="p-1 border rounded bg-white d-inline-block">
                                        <img src="{{ asset('item_images/' . $data->item_image) }}" 
                                             alt="Img" 
                                             style="width: 50px; height: 50px; object-fit: cover; display: block;">
                                    </div>
                                </td>
                                
                                <td class="text-center">
                                    <span class="badge bg-secondary rounded-pill">{{ $data->item_quantity }} pcs</span>
                                </td>
                                
                                <td class="text-center">
                                    <span class="badge bg-info text-dark bg-opacity-25 border border-info px-3">
                                        {{ $data->category_name }}
                                    </span>
                                </td>
                                
                                <td class="text-center">
                                    <a href="#" class="btn btn-light btn-sm text-warning table-action-btn me-1" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    
                                    <a href="{{ route('admin.deleteitem', $data->id) }}" 
                                       class="btn btn-light btn-sm text-danger table-action-btn"
                                       onclick="return confirm('Hapus item {{ $data->item_name }}?');" 
                                       title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="60" class="mb-3 opacity-50">
                                    <br>Data barang masih kosong.
                                </td>
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