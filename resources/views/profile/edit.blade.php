<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .card { border: none; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .nav-tabs .nav-link { color: #6c757d; border: none; padding: 1rem 1.5rem; font-weight: 500; }
        .nav-tabs .nav-link:hover { color: #0d6efd; background: rgba(13, 110, 253, 0.05); border-radius: 5px 5px 0 0; }
        
        /* Dropdown Profile */
        .dropdown-toggle::after { vertical-align: middle; }
    </style>
</head>
<body>

    <div class="container mt-5 mb-5">
        <div class="card">
            
            <div class="card-header bg-white pt-4 pb-0 border-bottom-0">
                <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                    
                    <h4 class="fw-bold text-primary mb-0">
                        <i class="fa-solid fa-layer-group me-2"></i>Admin Inventory
                    </h4>

                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2 text-dark fw-bold">Halo, {{ Auth::user()->name ?? 'Admin' }}</span>
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width: 35px; height: 35px;">
                                <i class="fa-solid fa-user text-primary"></i>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser1">
                            <li><h6 class="dropdown-header">User Account</h6></li>
                            <li><a class="dropdown-item active" href="#"><i class="fa-solid fa-user-gear me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>Log Out
                                    </button>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewitem') }}">View Item</a></li>
                </ul>
            </div>

            <div class="card-body p-5 bg-white rounded-bottom">
                
                <h4 class="mb-4 fw-bold text-secondary"><i class="fa-solid fa-user-pen me-2"></i>Profile Information</h4>
                
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check-circle me-2"></i>Profile updated successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-8">
                        
                        <form method="post" action="{{ route('profile.update') }}" class="mb-5">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary px-4 fw-bold">
                                <i class="fa-solid fa-save me-2"></i>Save Changes
                            </button>
                        </form>

                        <hr class="my-5">

                        <h5 class="mb-3 fw-bold text-secondary"><i class="fa-solid fa-key me-2"></i>Update Password</h5>
                        
                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Password updated successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-bold">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="current-password">
                                @error('current_password', 'updatePassword') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                                @error('password', 'updatePassword') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-warning fw-bold text-dark">
                                <i class="fa-solid fa-lock me-2"></i>Update Password
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>