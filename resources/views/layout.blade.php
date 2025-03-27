<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tieudetrang', 'Trang tin tức')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .main-header {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            padding: 1rem 0;
            color: white;
        }
        
        .site-title {
            font-weight: 700;
            margin: 0;
        }
        
        .site-description {
            opacity: 0.8;
            margin: 0;
        }
        
        .navbar {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            padding: 0.5rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
        }
        
        .nav-link {
            font-weight: 500;
            padding: 0.8rem 1.2rem !important;
            transition: color 0.2s;
        }
        
        .nav-link:hover {
            color: #0d6efd !important;
        }
        
        .nav-link.active {
            color: #0d6efd !important;
            border-bottom: 2px solid #0d6efd;
        }
        
        .main-content {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin: 2rem 0;
        }
        
        .footer {
            background-color: #343a40;
            color: rgba(255, 255, 255, 0.6);
            padding: 2.5rem 0;
        }
        
        .footer h5 {
            color: #fff;
            margin-bottom: 1.2rem;
            font-weight: 600;
        }
        
        .footer-bottom {
            background-color: #212529;
            padding: 1rem 0;
            color: rgba(255, 255, 255, 0.4);
        }
    </style>
    
    @yield('custom_css')
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container py-3">
            <h1 class="site-title">Tin Tức Online</h1>
            <p class="site-description">Cập nhật tin tức mới nhất</p>
        </div>
    </header>
    
    <!-- Navigation -->
    @include('menu')
    
    <!-- Main Content -->
    <div class="container">
        <div class="main-content">
            @yield('noidung')
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Về chúng tôi</h5>
                    <p>Website tin tức cung cấp thông tin mới nhất, chính xác và đa dạng trên nhiều lĩnh vực.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Danh mục</h5>
                    <ul class="list-unstyled">
                        @foreach(DB::table('loaiTin')->where('AnHien', 1)->limit(5)->get() as $lt)
                            <li class="mb-2">
                                <a href="/loai/{{ $lt->id }}" class="text-light text-decoration-none opacity-75 hover-opacity-100">
                                    {{ $lt->tenLoai }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Đường ABC, TP. XYZ</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> (012) 345-6789</li>
                        <li><i class="fas fa-envelope me-2"></i> info@example.com</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} Tin Tức Online. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('custom_js')
</body>
</html>