<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Admin Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #eef2f3 0%, #8e9eab 100%); /* Gradient Abu-abu kebiruan */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-login {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header-login {
            background-color: #0d6efd; /* Warna Primary Bootstrap */
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-bottom: none;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }
        .form-control {
            border-left: none;
            padding-left: 0;
        }
        .btn-login {
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }
        /* Animasi Masuk */
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                
                <div class="card card-login fade-in">
                    
                    <div class="card-header-login">
                        <i class="fa-solid fa-key fa-3x mb-2"></i>
                        <h4 class="fw-bold mb-0">Lupa Password?</h4>
                        <p class="small mb-0 opacity-75">Kami akan membantu Anda meresetnya</p>
                    </div>

                    <div class="card-body p-4 bg-white">
                        
                        <p class="text-muted small mb-4 text-center">
                            Masukkan alamat email Anda di bawah ini dan kami akan mengirimkan tautan untuk mereset password Anda.
                        </p>

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show small" role="alert">
                                <i class="fa-solid fa-check-circle me-1"></i> {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger small" role="alert">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-secondary">Email Address</label>
                                <div class="input-group border rounded">
                                    <span class="input-group-text bg-white border-0"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control border-0" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-login">
                                    KIRIM LINK RESET <i class="fa-solid fa-paper-plane ms-2"></i>
                                </button>
                            </div>

                        </form>
                    </div>
                    
                    <div class="card-footer bg-light text-center py-3 border-0">
                        <a href="{{ route('login') }}" class="text-decoration-none small fw-bold text-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Login
                        </a>
                    </div>

                </div>
                
                <div class="text-center mt-3">
                    <small class="text-muted text-white-50">&copy; {{ date('Y') }} Inventory System</small>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>