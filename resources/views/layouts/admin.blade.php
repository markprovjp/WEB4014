@extends('layouts.base')

@section('title', 'Quản trị WEB4014')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
            --topbar-height: 60px;
            --primary-color: #4e73df;
            --primary-dark: #3a56b7;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --secondary-color: #858796;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }
        
        body {
            background-color: #f8f9fc;
        }
        
        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            transition: all 0.3s;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            overflow-y: auto;
        }
        
        #sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        #sidebar .sidebar-brand {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            background: rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        #sidebar .sidebar-brand-text {
            transition: opacity 0.3s;
        }
        
        #sidebar.collapsed .sidebar-brand-text {
            opacity: 0;
            display: none;
        }
        
        #sidebar .nav-item {
            position: relative;
            margin-bottom: 0.25rem;
        }
        
        #sidebar .nav-item .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            white-space: nowrap;
            overflow: hidden;
        }
        
        #sidebar .nav-item .nav-link i {
            font-size: 0.85rem;
            margin-right: 0.75rem;
            width: 1.2rem;
            text-align: center;
            transition: all 0.3s;
        }
        
        #sidebar .nav-item .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }
        
        #sidebar .nav-item .nav-link.active {
            color: #fff;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.15);
        }
        
        #sidebar .nav-item .nav-link.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: #fff;
        }
        
        #sidebar.collapsed .nav-item .nav-link {
            padding: 1rem;
            justify-content: center;
        }
        
        #sidebar.collapsed .nav-item .nav-link span {
            display: none;
        }
        
        #sidebar.collapsed .nav-item .nav-link i {
            margin-right: 0;
            font-size: 1.1rem;
        }
        
        /* Main Content */
        #main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
            min-height: 100vh;
        }
        
        #main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        /* Topbar */
        .topbar {
            height: var(--topbar-height);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            background-color: white;
            z-index: 99;
        }
        
        .topbar .navbar-brand {
            display: none;
            width: 0;
            opacity: 0;
            transition: all 0.3s;
        }
        
        #main-content.expanded .topbar .navbar-brand {
            display: block;
            width: auto;
            opacity: 1;
        }
        
        .topbar .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .topbar .dropdown-toggle::after {
            display: none;
        }
        
        .user-dropdown .dropdown-menu {
            width: 18rem;
            padding: 0;
        }
        
        .user-dropdown .dropdown-menu .dropdown-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }
        
        .user-dropdown .dropdown-divider {
            margin: 0;
        }
        
        .user-dropdown .dropdown-item {
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
        }
        
        .user-dropdown .dropdown-item i {
            width: 1.5rem;
            text-align: center;
            margin-right: 0.5rem;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
        }
        
        .card .card-header[class*="bg-"] {
            border-radius: 0.5rem 0.5rem 0 0;
        }
        
        /* Data Tables Customization */
        .dataTables_wrapper .dataTables_length, 
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.375rem 0.75rem;
            margin: 0 0.25rem;
            border: 1px solid #e3e6f0;
            border-radius: 0.25rem;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white !important;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--light-color);
            border-color: #e3e6f0;
            color: var(--dark-color) !important;
        }
        
        /* Dashboard cards */
        .stat-card {
            border-left: 0.25rem solid;
            border-radius: 0.5rem;
        }
        
        .stat-card.primary {
            border-left-color: var(--primary-color);
        }
        
        .stat-card.success {
            border-left-color: var(--success-color);
        }
        
        .stat-card.info {
            border-left-color: var(--info-color);
        }
        
        .stat-card.warning {
            border-left-color: var(--warning-color);
        }
        
        .stat-card.danger {
            border-left-color: var(--danger-color);
        }
        
        .stat-card .icon {
            font-size: 2rem;
            opacity: 0.3;
        }
        
        /* Utility */
        .bg-gradient-primary {
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
        }
        
        .bg-gradient-success {
            background: linear-gradient(180deg, #1cc88a 10%, #13855c 100%);
        }
        
        .bg-gradient-info {
            background: linear-gradient(180deg, #36b9cc 10%, #258391 100%);
        }
        
        .bg-gradient-warning {
            background: linear-gradient(180deg, #f6c23e 10%, #dda20a 100%);
        }
        
        .bg-gradient-danger {
            background: linear-gradient(180deg, #e74a3b 10%, #be2617 100%);
        }
        
        .dropdown-menu {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: none;
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fc;
        }
        
        /* Page heading */
        .page-header {
            margin-bottom: 1.5rem;
        }
        
        .page-header .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0.5rem;
        }
        
        /* Form controls */
        .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        /* Buttons */
        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            padding: 0;
            border-radius: 50%;
        }
        
        .btn-icon-sm {
            width: 2rem;
            height: 2rem;
        }
        
        /* Footer */
        footer.sticky-footer {
            padding: 1.5rem 0;
            position: relative;
            margin-top: auto;
        }
    </style>
    @yield('styles')
@endsection

@section('main-class', '')

@section('header')
    <!-- Modal xác nhận xóa -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa mục này? Hành động này không thể hoàn tác.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar">
            <div class="sidebar-brand py-2">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-white d-flex align-items-center">
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">WEB4014 Admin</div>
                </a>
            </div>
            
            <hr class="sidebar-divider my-0">
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                
                <hr class="sidebar-divider">
                
                <div class="sidebar-heading px-3 py-2 text-uppercase text-white-50 small">
                    <span>Quản lý nội dung</span>
                </div>
                
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-list"></i>
                        <span>Loại tin tức</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-newspaper"></i>
                        <span>Tin tức</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.comments.index') }}" class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-comments"></i>
                        <span>Bình luận</span>
                    </a>
                </li>
                
                <hr class="sidebar-divider">
                
                <div class="sidebar-heading px-3 py-2 text-uppercase text-white-50 small">
                    <span>Quản lý người dùng</span>
                </div>
                
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Người dùng</span>
                    </a>
                </li>
                
                <hr class="sidebar-divider d-none d-md-block">
                
                <div class="text-center d-none d-md-inline mt-3">
                    <button class="btn btn-circle btn-light" id="sidebarToggle">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
            </ul>
        </div>
        
        <!-- Content Wrapper -->
        <div id="main-content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand topbar mb-4 static-top shadow-sm">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                
                <a class="navbar-brand d-md-none" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-newspaper mr-2"></i> WEB4014
                </a>
                
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow d-flex align-items-center">
                        <span class="mr-3 d-none d-lg-inline text-gray-600">
                            <i class="fas fa-calendar-alt mr-1"></i> {{ date('d/m/Y') }}
                        </span>
                    </li>
                    
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600">{{ Auth::user()->name }}</span>
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                     class="img-profile rounded-circle" width="32" height="32">
                            @else
                                <i class="fas fa-user-circle fa-fw text-gray-600 fa-lg"></i>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in user-dropdown">
                            <div class="dropdown-header">
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small>{{ Auth::user()->email }}</small>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('home') }}">
                                <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                Trang chủ
                            </a>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Hồ sơ
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đăng xuất
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            
            <!-- Main Content -->
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4 page-header">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                                </li>
                                <!-- Add dynamic breadcrumbs here via individual views -->
                                @yield('breadcrumbs')
                                <li class="breadcrumb-item active" aria-current="page">
                                    @yield('page-title', 'Quản trị hệ thống')
                                </li>
                            </ol>
                        </nav>
                        <h1 class="h3 mb-0 text-gray-800">@yield('page-title', 'Quản trị hệ thống')</h1>
                    </div>
                    <div>
                        @yield('page-actions')
                    </div>
                </div>
                
                @if(session('success') || session('error') || session('info') || session('warning'))
                    <div class="row">
                        <div class="col-12">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            @if(session('info'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <i class="fas fa-info-circle mr-2"></i> {{ session('info') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            @if(session('warning'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('warning') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                
                @yield('admin-content')
            </div>
            
            <!-- Footer -->
            <footer class="sticky-footer bg-white mt-5">
                <div class="container">
                    <div class="copyright text-center">
                        <span>Copyright &copy; WEB4014 News Admin 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-vi-VN.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Định nghĩa Toast notification global
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        
        $(document).ready(function() {
            // Toggle sidebar
            $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
                e.preventDefault();
                $("#sidebar").toggleClass("collapsed");
                $("#main-content").toggleClass("expanded");
                
                // Change the icon direction
                if ($("#sidebar").hasClass("collapsed")) {
                    $("#sidebarToggle i").removeClass("fa-chevron-left").addClass("fa-chevron-right");
                } else {
                    $("#sidebarToggle i").removeClass("fa-chevron-right").addClass("fa-chevron-left");
                }
            });
            
            // DataTables
            if ($('.data-table').length && !$.fn.DataTable.isDataTable('.data-table')) {
                $('.data-table').DataTable({
                    language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/vi.json' },
                    pageLength: 10,
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tất cả"]],
                    responsive: true
                });
            }
            
            // Summernote
            $('.summernote').summernote({
                height: 300,
                lang: 'vi-VN',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        for(let i = 0; i < files.length; i++) {
                            uploadImage(files[i], this);
                        }
                    }
                }
            });
            
            // Image upload for Summernote
            function uploadImage(file, editor) {
                let formData = new FormData();
                formData.append('image', file);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                
                $.ajax({
                    url: "{{ route('admin.upload.image') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $(editor).summernote('insertImage', response.url);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        Toast.fire({
                            icon: 'error',
                            title: 'Lỗi tải lên hình ảnh'
                        });
                    }
                });
            }
            
            // Delete confirmation
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                let deleteUrl = $(this).data('url');
                
                Swal.fire({
                    title: 'Xác nhận xóa',
                    text: 'Bạn có chắc chắn muốn xóa mục này? Hành động này không thể hoà// filepath: c:\xampp\htdocs\WEB4014\resources\views\layouts\admin.blade.php
@extends('layouts.base')

@section('title', 'Quản trị WEB4014')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
            --topbar-height: 60px;
            --primary-color: #4e73df;
            --primary-dark: #3a56b7;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --secondary-color: #858796;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }
        
        body {
            background-color: #f8f9fc;
        }
        
        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            transition: all 0.3s;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            overflow-y: auto;
        }
        
        #sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        #sidebar .sidebar-brand {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            background: rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        #sidebar .sidebar-brand-text {
            transition: opacity 0.3s;
        }
        
        #sidebar.collapsed .sidebar-brand-text {
            opacity: 0;
            display: none;
        }
        
        #sidebar .nav-item {
            position: relative;
            margin-bottom: 0.25rem;
        }
        
        #sidebar .nav-item .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            white-space: nowrap;
            overflow: hidden;
        }
        
        #sidebar .nav-item .nav-link i {
            font-size: 0.85rem;
            margin-right: 0.75rem;
            width: 1.2rem;
            text-align: center;
            transition: all 0.3s;
        }
        
        #sidebar .nav-item .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }
        
        #sidebar .nav-item .nav-link.active {
            color: #fff;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.15);
        }
        
        #sidebar .nav-item .nav-link.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: #fff;
        }
        
        #sidebar.collapsed .nav-item .nav-link {
            padding: 1rem;
            justify-content: center;
        }
        
        #sidebar.collapsed .nav-item .nav-link span {
            display: none;
        }
        
        #sidebar.collapsed .nav-item .nav-link i {
            margin-right: 0;
            font-size: 1.1rem;
        }
        
        /* Main Content */
        #main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
            min-height: 100vh;
        }
        
        #main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        /* Topbar */
        .topbar {
            height: var(--topbar-height);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            background-color: white;
            z-index: 99;
        }
        
        .topbar .navbar-brand {
            display: none;
            width: 0;
            opacity: 0;
            transition: all 0.3s;
        }
        
        #main-content.expanded .topbar .navbar-brand {
            display: block;
            width: auto;
            opacity: 1;
        }
        
        .topbar .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .topbar .dropdown-toggle::after {
            display: none;
        }
        
        .user-dropdown .dropdown-menu {
            width: 18rem;
            padding: 0;
        }
        
        .user-dropdown .dropdown-menu .dropdown-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }
        
        .user-dropdown .dropdown-divider {
            margin: 0;
        }
        
        .user-dropdown .dropdown-item {
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
        }
        
        .user-dropdown .dropdown-item i {
            width: 1.5rem;
            text-align: center;
            margin-right: 0.5rem;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
        }
        
        .card .card-header[class*="bg-"] {
            border-radius: 0.5rem 0.5rem 0 0;
        }
        
        /* Data Tables Customization */
        .dataTables_wrapper .dataTables_length, 
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.375rem 0.75rem;
            margin: 0 0.25rem;
            border: 1px solid #e3e6f0;
            border-radius: 0.25rem;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white !important;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--light-color);
            border-color: #e3e6f0;
            color: var(--dark-color) !important;
        }
        
        /* Dashboard cards */
        .stat-card {
            border-left: 0.25rem solid;
            border-radius: 0.5rem;
        }
        
        .stat-card.primary {
            border-left-color: var(--primary-color);
        }
        
        .stat-card.success {
            border-left-color: var(--success-color);
        }
        
        .stat-card.info {
            border-left-color: var(--info-color);
        }
        
        .stat-card.warning {
            border-left-color: var(--warning-color);
        }
        
        .stat-card.danger {
            border-left-color: var(--danger-color);
        }
        
        .stat-card .icon {
            font-size: 2rem;
            opacity: 0.3;
        }
        
        /* Utility */
        .bg-gradient-primary {
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
        }
        
        .bg-gradient-success {
            background: linear-gradient(180deg, #1cc88a 10%, #13855c 100%);
        }
        
        .bg-gradient-info {
            background: linear-gradient(180deg, #36b9cc 10%, #258391 100%);
        }
        
        .bg-gradient-warning {
            background: linear-gradient(180deg, #f6c23e 10%, #dda20a 100%);
        }
        
        .bg-gradient-danger {
            background: linear-gradient(180deg, #e74a3b 10%, #be2617 100%);
        }
        
        .dropdown-menu {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: none;
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fc;
        }
        
        /* Page heading */
        .page-header {
            margin-bottom: 1.5rem;
        }
        
        .page-header .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0.5rem;
        }
        
        /* Form controls */
        .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        /* Buttons */
        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            padding: 0;
            border-radius: 50%;
        }
        
        .btn-icon-sm {
            width: 2rem;
            height: 2rem;
        }
        
        /* Footer */
        footer.sticky-footer {
            padding: 1.5rem 0;
            position: relative;
            margin-top: auto;
        }
    </style>
    @yield('styles')
@endsection

@section('main-class', '')

@section('header')
    <!-- Modal xác nhận xóa -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa mục này? Hành động này không thể hoàn tác.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar">
            <div class="sidebar-brand py-2">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-white d-flex align-items-center">
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">WEB4014 Admin</div>
                </a>
            </div>
            
            <hr class="sidebar-divider my-0">
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                
                <hr class="sidebar-divider">
                
                <div class="sidebar-heading px-3 py-2 text-uppercase text-white-50 small">
                    <span>Quản lý nội dung</span>
                </div>
                
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-list"></i>
                        <span>Loại tin tức</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-newspaper"></i>
                        <span>Tin tức</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.comments.index') }}" class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-comments"></i>
                        <span>Bình luận</span>
                    </a>
                </li>
                
                <hr class="sidebar-divider">
                
                <div class="sidebar-heading px-3 py-2 text-uppercase text-white-50 small">
                    <span>Quản lý người dùng</span>
                </div>
                
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Người dùng</span>
                    </a>
                </li>
                
                <hr class="sidebar-divider d-none d-md-block">
                
                <div class="text-center d-none d-md-inline mt-3">
                    <button class="btn btn-circle btn-light" id="sidebarToggle">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
            </ul>
        </div>
        
        <!-- Content Wrapper -->
        <div id="main-content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand topbar mb-4 static-top shadow-sm">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                
                <a class="navbar-brand d-md-none" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-newspaper mr-2"></i> WEB4014
                </a>
                
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow d-flex align-items-center">
                        <span class="mr-3 d-none d-lg-inline text-gray-600">
                            <i class="fas fa-calendar-alt mr-1"></i> {{ date('d/m/Y') }}
                        </span>
                    </li>
                    
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600">{{ Auth::user()->name }}</span>
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                     class="img-profile rounded-circle" width="32" height="32">
                            @else
                                <i class="fas fa-user-circle fa-fw text-gray-600 fa-lg"></i>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in user-dropdown">
                            <div class="dropdown-header">
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small>{{ Auth::user()->email }}</small>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('home') }}">
                                <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                Trang chủ
                            </a>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Hồ sơ
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đăng xuất
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            
            <!-- Main Content -->
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4 page-header">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                                </li>
                                <!-- Add dynamic breadcrumbs here via individual views -->
                                @yield('breadcrumbs')
                                <li class="breadcrumb-item active" aria-current="page">
                                    @yield('page-title', 'Quản trị hệ thống')
                                </li>
                            </ol>
                        </nav>
                        <h1 class="h3 mb-0 text-gray-800">@yield('page-title', 'Quản trị hệ thống')</h1>
                    </div>
                    <div>
                        @yield('page-actions')
                    </div>
                </div>
                
                @if(session('success') || session('error') || session('info') || session('warning'))
                    <div class="row">
                        <div class="col-12">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            @if(session('info'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <i class="fas fa-info-circle mr-2"></i> {{ session('info') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            @if(session('warning'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('warning') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                
                @yield('admin-content')
            </div>
            
            <!-- Footer -->
            <footer class="sticky-footer bg-white mt-5">
                <div class="container">
                    <div class="copyright text-center">
                        <span>Copyright &copy; WEB4014 News Admin 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-vi-VN.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Định nghĩa Toast notification global
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        
        $(document).ready(function() {
            // Toggle sidebar
            $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
                e.preventDefault();
                $("#sidebar").toggleClass("collapsed");
                $("#main-content").toggleClass("expanded");
                
                // Change the icon direction
                if ($("#sidebar").hasClass("collapsed")) {
                    $("#sidebarToggle i").removeClass("fa-chevron-left").addClass("fa-chevron-right");
                } else {
                    $("#sidebarToggle i").removeClass("fa-chevron-right").addClass("fa-chevron-left");
                }
            });
            
            // DataTables
            if ($('.data-table').length && !$.fn.DataTable.isDataTable('.data-table')) {
                $('.data-table').DataTable({
                    language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/vi.json' },
                    pageLength: 10,
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tất cả"]],
                    responsive: true
                });
            }
            
            // Summernote
            $('.summernote').summernote({
                height: 300,
                lang: 'vi-VN',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        for(let i = 0; i < files.length; i++) {
                            uploadImage(files[i], this);
                        }
                    }
                }
            });
            
            // Image upload for Summernote
            function uploadImage(file, editor) {
                let formData = new FormData();
                formData.append('image', file);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                
                $.ajax({
                    url: "{{ route('admin.upload.image') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $(editor).summernote('insertImage', response.url);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        Toast.fire({
                            icon: 'error',
                            title: 'Lỗi tải lên hình ảnh'
                        });
                    }
                });
            }
            
            // Delete confirmation
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                let deleteUrl = $(this).data('url');
                
                Swal.fire({
                    title: 'Xác nhận xóa',
                    text: 'Bạn có chắc chắn muốn xóa mục này? Hành động này không thể hoàn tác.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận xóa',
                    cancelButtonText: 'Hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form').attr('action', deleteUrl).submit();
                    }
                });
            });
            
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
            
            // Enable tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    @yield('scripts')
@endsection