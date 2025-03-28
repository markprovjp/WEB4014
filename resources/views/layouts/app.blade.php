@extends('layouts.base')

@section('title')
    @yield('page-title', 'Tin tức')
@endsection

@section('styles')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('header')
    <header>
        <div class="bg-primary text-white py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h1 class="h3 mb-0">WEB4014 - Tin Tức</h1>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ route('news.search') }}" method="GET" class="d-flex ms-auto" style="max-width: 450px;">
                            <input type="text" name="keyword" class="form-control me-2" placeholder="Tìm kiếm tin tức..." required>
                            <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                                <i class="fas fa-home"></i> Trang chủ
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
                                <a href="{{ route('login') }}" class="nav-link"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    @if(Auth::user()->is_admin)
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Quản trị</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    @endif
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
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @yield('main-content')
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-chart-line"></i> Tin xem nhiều</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach ($popularNews ?? [] as $news)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('news.detail', $news->id) }}" class="text-decoration-none text-dark">
                                        {{ $news->title }}
                                    </a>
                                    <span class="badge bg-primary rounded-pill">{{ $news->views }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @yield('sidebar')
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Về chúng tôi</h5>
                    <p>WEB4014 - Trang tin tức cập nhật những thông tin mới nhất và chính xác nhất.</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên kết nhanh</h5>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-white">Trang chủ</a></li>
                        <li><a href="#" class="text-white">Liên hệ</a></li>
                        <li><a href="#" class="text-white">Điều khoản sử dụng</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Kết nối với chúng tôi</h5>
                    <div class="d-flex gap-3 fs-4">
                        <a href="#" class="text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">© 2025 WEB4014. Bản quyền thuộc về trang tin tức WEB4014.</p>
            </div>
        </div>
    </footer>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection