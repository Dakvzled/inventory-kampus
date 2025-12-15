<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .card { border: none; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .nav-tabs .nav-link { color: #6c757d; border: none; padding: 1rem 1.5rem; font-weight: 500; }
        .nav-tabs .nav-link:hover { color: #0d6efd; background: rgba(13, 110, 253, 0.05); border-radius: 5px 5px 0 0; }
        .nav-tabs .nav-link.active { color: #0d6efd; border-bottom: 3px solid #0d6efd; background: transparent; font-weight: bold; }
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.addcategory') }}">Add Category</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.viewcategory') }}">View Category</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.additem') }}">Add Item</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewitem') }}">View Item</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.borrowings') }}">Requests</a></li>
                </ul>
            </div>
            <div class="card-body p-4 bg-white rounded-bottom">
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="fw-bold text-secondary">Manage Categories</h5>
                    <a href="{{ route('admin.addcategory') }}" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm"><i class="fa-solid fa-plus me-1"></i> Add New</a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-bottom">
                        <thead class="table-light">
                            <tr><th>ID</th><th>Category Name</th><th class="text-center">Action</th></tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td class="fw-bold">{{ $category->category_name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.updatecategory', $category->id) }}" class="btn btn-warning btn-sm text-dark me-1 shadow-sm"><i class="fa-solid fa-pen"></i> Update</a>
                                    <a href="{{ route('admin.deletecategory', $category->id) }}" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Hapus kategori ini?')"><i class="fa-solid fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>