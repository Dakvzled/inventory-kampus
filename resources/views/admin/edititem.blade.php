<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .card { border: none; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .nav-tabs .nav-link { color: #6c757d; border: none; padding: 1rem 1.5rem; font-weight: 500; }
        .nav-tabs .nav-link:hover { color: #0d6efd; background: rgba(13, 110, 253, 0.05); border-radius: 5px 5px 0 0; }
        .nav-tabs .nav-link.active { color: #0d6efd; border-bottom: 3px solid #0d6efd; background: transparent; font-weight: bold; }
        .current-img { max-width: 150px; border-radius: 8px; border: 1px solid #ddd; padding: 5px; }
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewcategory') }}">View Category</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.additem') }}">Add Item</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.viewitem') }}">View Item</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.borrowings') }}">Requests</a></li>
                </ul>
            </div>

            <div class="card-body p-4 bg-white rounded-bottom">
                
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="fw-bold text-secondary">Edit Item: {{ $item->item_name }}</h5>
                </div>

                <form action="{{ route('admin.updateitem', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Item Name</label>
                                <input type="text" class="form-control" name="item_name" value="{{ $item->item_name }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Quantity</label>
                                    <input type="number" class="form-control" name="item_quantity" value="{{ $item->item_quantity }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Category</label>
                                    <select class="form-select" name="category_name" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->category_name }}" 
                                                {{ $item->category_name == $category->category_name ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Update Image (Opsional)</label>
                                <input type="file" class="form-control" name="item_image">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                            </div>
                        </div>

                        <div class="col-md-4 text-center">
                            <label class="form-label fw-bold d-block">Current Image</label>
                            @if($item->item_image)
                                <img src="{{ asset('item_images/' . $item->item_image) }}" class="current-img mb-2" alt="Current Image">
                                <p class="small text-muted">{{ $item->item_image }}</p>
                            @else
                                <div class="p-4 bg-light border rounded text-muted">No Image</div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('admin.viewitem') }}" class="btn btn-secondary px-4">
                            <i class="fa-solid fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fa-solid fa-save me-2"></i>Save Changes
                        </button>
                    </div>

                </form>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>