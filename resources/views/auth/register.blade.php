<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .auth-wrapper {
            max-width: 450px;
            width: 100%;
            margin: auto;
        }

        .auth-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: none;
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .auth-logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: #4c57b6;
            text-decoration: none;
        }

        .auth-logo i {
            margin-right: 10px;
            color: #6c5ce7;
        }

        .card-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            border: 1px solid #e5e5e5;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.1);
            border-color: #6c5ce7;
        }

        .input-group-text {
            background: #f8f9fa;
            border-radius: 8px 0 0 8px;
            border-right: none;
        }

        .form-control {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }

        .btn-primary {
            background-color: #6c5ce7;
            border-color: #6c5ce7;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(108, 92, 231, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: #5a4fcf;
            border-color: #5a4fcf;
            transform: translateY(-1px);
            box-shadow: 0 7px 14px rgba(108, 92, 231, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }

        .auth-link {
            color: #6c5ce7;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }

        .auth-link:hover {
            color: #5a4fcf;
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            color: #919aa3;
            margin: 1.5rem 0;
        }

        .divider::before, .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e5e5e5;
        }

        .divider span {
            padding: 0 1rem;
        }

        .social-btn {
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
            border: 1px solid #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 10px;
            color: #555;
        }

        .social-btn i {
            margin-right: 10px;
        }

        .social-btn.google {
            background: #fff;
        }

        .social-btn.google:hover {
            background: #f8f9fa;
        }

        .social-btn.google i {
            color: #ea4335;
        }
        
        .is-invalid {
            border-color: #dc3545;
        }
        
        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body class="text-center">
    <div class="auth-wrapper">
        <div class="card auth-card">
            <div class="card-header text-center">
                <a href="/" class="auth-logo">
                    <i class="fas fa-wallet"></i> Expense Tracker
                </a>
            </div>
            <div class="card-body">
                <h4 class="mb-4">Tạo tài khoản mới</h4>
                
                <form method="POST" action="{{ route('register') }}" class="needs-validation">
                    @csrf
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Họ và tên" value="{{ old('name') }}" required autofocus>
                        </div>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                placeholder="Email" value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                placeholder="Mật khẩu" required>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password_confirmation" class="form-control" 
                                placeholder="Xác nhận mật khẩu" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-user-plus me-2"></i> Đăng Ký
                        </button>
                    </div>
                </form>
                
                <div class="divider">
                    <span>hoặc đăng ký với</span>
                </div>
                
                <a href="#" class="social-btn google mb-3">
                    <i class="fab fa-google"></i> Google
                </a>

                <p class="mt-4 text-muted">
                    Đã có tài khoản? <a href="{{ route('login') }}" class="auth-link">Đăng nhập</a>
                </p>
            </div>
        </div>
        
        <p class="mt-4 text-white">
            &copy; {{ date('Y') }} Expense Tracker. Mọi quyền được bảo lưu.
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>