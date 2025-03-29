<!-- filepath: c:\xampp\htdocs\expense-tracker\resources\views\auth\login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Expense Tracker</title>
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
            max-width: 400px;
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
        
        .form-check-input:checked {
            background-color: #6c5ce7;
            border-color: #6c5ce7;
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
                <h4 class="mb-4">Đăng nhập</h4>
                
                @if (session('status'))
                    <div class="alert alert-success mb-3">
                        {{ session('status') }}
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="alert alert-danger mb-3">
                        {{ session('error') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                placeholder="Email" value="{{ old('email') }}" required autofocus>
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
                    
                    <div class="row mb-3">
                        <div class="col-6 text-start">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Ghi nhớ
                                </label>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="auth-link">
                                    Quên mật khẩu?
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-2"></i> Đăng Nhập
                        </button>
                    </div>
                </form>
                
                <div class="divider">
                    <span>hoặc đăng nhập với</span>
                </div>
                
                <a href="#" class="social-btn google mb-3">
                    <i class="fab fa-google"></i> Google
                </a>

                <p class="mt-4 text-muted">
                    Chưa có tài khoản? <a href="{{ route('register') }}" class="auth-link">Đăng ký</a>
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