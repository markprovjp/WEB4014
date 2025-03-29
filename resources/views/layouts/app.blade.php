@extends('layouts.base')

@section('title')
    @yield('page-title', 'Tin tức')
@endsection

@section('styles')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1a73e8;
            --secondary-color: #0d47a1;
            --accent-color: #e65100;
            --text-dark: #212121;
            --text-light: #f5f5f5;
            --bg-light: #f9f9f9;
            --bg-dark: #1f2937;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-dark);
            background-color: var(--bg-light);
        }
        
        /* Header styling */
        .top-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .site-title {
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .main-nav {
            background-color: #fff;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        }
        
        .main-nav .navbar-nav .nav-link {
            color: var(--text-dark);
            font-weight: 500;
            padding: 1rem 1.2rem;
            transition: all 0.3s;
            position: relative;
        }
        
        .main-nav .navbar-nav .nav-link:hover,
        .main-nav .navbar-nav .nav-link.active {
            color: var(--primary-color);
        }
        
        .main-nav .navbar-nav .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 1.2rem;
            right: 1.2rem;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        /* Search bar */
        .search-bar {
            position: relative;
            max-width: 500px;
        }
        
        .search-bar input {
            border-radius: 30px;
            padding-left: 1rem;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        
        .search-bar input:focus {
            box-shadow: 0 2px 15px rgba(0,0,0,0.2);
        }
        
        .search-bar button {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            border-radius: 0 30px 30px 0;
            background-color: var(--primary-color);
            color: white;
            border: none;
            width: 50px;
        }
        
        /* News card */
        .news-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        }
        
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .news-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        
        .news-card .card-body {
            padding: 1.5rem;
        }
        
        .news-card .card-title {
            font-weight: 700;
            margin-bottom: 0.75rem;
        }
        
        .news-card .card-text {
            color: #666;
            margin-bottom: 1rem;
        }
        
        .news-card .card-footer {
            background-color: transparent;
            border-top: 1px solid rgba(0,0,0,0.05);
            padding: 1rem 1.5rem;
        }
        
        /* Category badge */
        .category-badge {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            padding: 0.35rem 0.75rem;
            border-radius: 30px;
            font-size: 0.8rem;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .category-badge:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        /* Popular news */
        .popular-news {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        }
        
        .popular-news .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            padding: 1rem 1.5rem;
        }
        
        .popular-news .list-group-item {
            border-left: none;
            border-right: none;
            padding: 1rem 1.5rem;
            transition: all 0.3s;
        }
        
        .popular-news .list-group-item:hover {
            background-color: rgba(0,0,0,0.02);
        }
        
        .popular-news .badge {
            font-weight: 500;
            padding: 0.5rem 0.75rem;
        }
        
        /* Footer */
        footer {
            background-color: var(--bg-dark);
            color: var(--text-light);
            padding: 3rem 0 1.5rem;
        }
        
        footer h5 {
            font-weight: 700;
            margin-bottom: 1.2rem;
            position: relative;
            display: inline-block;
        }
        
        footer h5:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 30px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        footer a {
            transition: all 0.3s;
            text-decoration: none;
        }
        
        footer a:hover {
            color: var(--primary-color) !important;
            padding-left: 5px;
        }
        
        footer .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.1);
            transition: all 0.3s;
            margin-right: 10px;
        }
        
        footer .social-links a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        /* User dropdown */
        .user-dropdown .dropdown-menu {
            border: none;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            border-radius: 10px;
            padding: 0.5rem;
        }
        
        .user-dropdown .dropdown-item {
            padding: 0.6rem 1rem;
            border-radius: 5px;
            transition: all 0.2s;
        }
        
        .user-dropdown .dropdown-item:hover {
            background-color: rgba(26, 115, 232, 0.1);
            color: var(--primary-color);
        }
        
        .user-dropdown .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }
        
        /* Hot badge */
        .hot-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--accent-color);
            color: white;
            padding: 0.3rem 0.6rem;
            border-radius: 5px;
            font-size: 0.75rem;
            font-weight: 700;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
    </style>
@endsection

@section('header')
    <header>
        <!-- Top header with logo and search -->
        <div class="top-header text-white py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <a href="/" class="text-decoration-none text-white">
                            <h1 class="h3 mb-0 site-title d-flex align-items-center">
                                <i class="fas fa-newspaper me-2"></i> WEB4014 NEWS
                            </h1>
                        </a>
                    </div>
                    <div class="col-lg-5 mt-3 mt-lg-0">
                        <form action="{{ route('news.search') }}" method="GET" class="search-bar ms-auto">
                            <input type="text" name="keyword" class="form-control form-control-lg" placeholder="Tìm kiếm tin tức..." required>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="col-lg-3 d-flex justify-content-end mt-3 mt-lg-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-none d-lg-flex social-links">
                                <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                            </div>
                            <div class="vr d-none d-lg-block bg-white opacity-25 mx-2" style="height: 25px;"></div>
                            <span class="d-none d-lg-inline">
                                <i class="fas fa-calendar-alt me-1"></i> {{ date('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main navigation -->
        <nav class="navbar navbar-expand-lg main-nav sticky-top py-0">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                                <i class="fas fa-home me-1"></i> Trang chủ
                            </a>
                        </li>
                        @foreach ($categories ?? [] as $category)
                            <li class="nav-item">
                                <a href="{{ route('category.news', $category->id) }}"
                                   class="nav-link {{ request()->is('category/'.$category->id) ? 'active' : '' }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">
                                    <i class="fas fa-sign-in-alt me-1"></i> Đăng nhập
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">
                                    <i class="fas fa-user-plus me-1"></i> Đăng ký
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown user-dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" 
                                             class="rounded-circle me-2" width="30" height="30">
                                    @else
                                        <i class="fas fa-user-circle me-2 fs-5"></i>
                                    @endif
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    @if(Auth::user()->isAdmin())
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt"></i> Quản trị
                                        </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="fas fa-user"></i> Tài khoản
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('profile.comments') }}">
                                        <i class="fas fa-comments"></i> Bình luận của tôi
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
@endsection

@section('content')
    <div class="container my-4">
        <!-- Breaking news section for homepage -->
        @if(request()->is('/'))
            <div class="breaking-news mb-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white py-2">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-danger me-2">TIN MỚI</span>
                            <h5 class="mb-0">Tin tức mới nhất</h5>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="swiper breaking-news-swiper">
                            <div class="swiper-wrapper">
                                @foreach($latestNews ?? [] as $news)
                                    <div class="swiper-slide p-3">
                                        <div class="d-flex align-items-center">
                                            @if($news->thumbnail)
                                                <img src="{{ asset('storage/' . $news->thumbnail) }}" 
                                                    alt="{{ $news->title }}" class="rounded me-3" 
                                                    style="width: 100px; height: 70px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 100px; height: 70px;">
                                                    <i class="fas fa-newspaper text-secondary fs-3"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <a href="{{ route('news.detail', $news->id) }}" class="text-decoration-none">
                                                    <h6 class="mb-1">{{ $news->title }}</h6>
                                                </a>
                                                <div class="small text-muted">
                                                    <i class="far fa-clock me-1"></i> {{ $news->created_at->diffForHumans() }}
                                                    <i class="far fa-eye ms-2 me-1"></i> {{ $news->views }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                @yield('main-content')
            </div>
            <div class="col-lg-4">
                <!-- Popular news sidebar -->
                <div class="card popular-news mb-4" data-aos="fade-left">
                    <div class="card-header text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-chart-line me-2"></i>Tin xem nhiều</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($popularNews ?? [] as $index => $news)
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="me-3 d-flex align-items-center">
                                            <span class="badge bg-primary rounded-circle">{{ $index + 1 }}</span>
                                        </div>
                                        <div>
                                            <a href="{{ route('news.detail', $news->id) }}" class="text-decoration-none text-dark fw-medium">
                                                {{ $news->title }}
                                            </a>
                                            <div class="small text-muted mt-1">
                                                <i class="far fa-eye me-1"></i> {{ $news->views }} lượt xem
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Categories widget -->
                <div class="card mb-4 shadow-sm" data-aos="fade-up">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-list me-2"></i>Chuyên mục</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($categories ?? [] as $category)
                                <a href="{{ route('category.news', $category->id) }}" class="category-badge">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                @yield('sidebar')
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5>Về chúng tôi</h5>
                    <p>WEB4014 News - Trang tin tức chuyên nghiệp cung cấp thông tin chính xác, kịp thời và đa dạng về mọi lĩnh vực.</p>
                    <div class="social-links mt-4">
                        <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h5>Danh mục</h5>
                    <ul class="list-unstyled">
                                             @foreach($categories->take(5) as $category)
                            <li class="mb-2">
                                <a href="{{ route('category.news', $category->id) }}" class="text-white">
                                    <i class="fas fa-angle-right me-2"></i> {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h5>Liên kết</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/" class="text-white"><i class="fas fa-angle-right me-2"></i> Trang chủ</a></li>
                        <li class="mb-2"><a href="#" class="text-white"><i class="fas fa-angle-right me-2"></i> Giới thiệu</a></li>
                        <li class="mb-2"><a href="#" class="text-white"><i class="fas fa-angle-right me-2"></i> Liên hệ</a></li>
                        <li class="mb-2"><a href="#" class="text-white"><i class="fas fa-angle-right me-2"></i> Điều khoản</a></li>
                        <li class="mb-2"><a href="#" class="text-white"><i class="fas fa-angle-right me-2"></i> Quyền riêng tư</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h5>Liên hệ</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> 123 Đường Tin Tức, Quận Báo Chí, TP. Thông Tin</li>
                        <li class="mb-2"><i class="fas fa-phone-alt me-2"></i> (024) 1234 5678</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@web4014news.com</li>
                    </ul>
                    <div class="mt-4">
                        <form action="#" method="POST" class="d-flex">
                            <input type="email" class="form-control me-2" placeholder="Email của bạn" required>
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </form>
                        <small class="text-light mt-2 d-block">Đăng ký nhận bản tin của chúng tôi</small>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-3 opacity-25">
            <div class="text-center">
                <p class="mb-2">© 2025 WEB4014 News. Bản quyền thuộc về trang tin tức WEB4014.</p>
                <div class="small">
                    <a href="#" class="text-white me-3">Điều khoản sử dụng</a>
                    <a href="#" class="text-white me-3">Chính sách bảo mật</a>
                    <a href="#" class="text-white">Liên hệ quảng cáo</a>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });
        
        // Initialize Swiper for breaking news
        if (document.querySelector('.breaking-news-swiper')) {
            const breakingNewsSwiper = new Swiper('.breaking-news-swiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    992: {
                        slidesPerView: 2,
                    },
                }
            });
        }
        
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const mainNav = document.querySelector('.main-nav');
            if (window.scrollY > 10) {
                mainNav.classList.add('shadow-sm');
            } else {
                mainNav.classList.remove('shadow-sm');
            }
        });
    </script>
@endsection