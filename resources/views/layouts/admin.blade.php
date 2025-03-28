@extends('layouts.base')

@section('title', 'Quản trị WEB4014')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('main-class', '')

@section('header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 px-0 bg-dark position-fixed h-100" id="sidebar">
                <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark h-100">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <i class="fas fa-newspaper fs-4 me-2"></i>
                        <span class="fs-4">WEB4014 Admin</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt me-2"></i> Tổng quan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="nav-link text-white {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                <i class="fas fa-list me-2"></i> Quản lý loại tin
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.news.index') }}" class="nav-link text-white {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                                <i class="fas fa-newspaper me-2"></i> Quản lý tin tức
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white"><i class="fas fa-comments me-2"></i> Quản lý bình luận</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white"><i class="fas fa-users me-2"></i> Quản lý người dùng</a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2 fs-5"></i> <strong>{{ Auth::user()->name }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="{{ route('home') }}">Về trang chủ</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-lg-10 ms-auto py-3" id="main-content">
                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                    <div class="container-fluid">
                        <button class="btn btn-dark" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <span class="nav-link"><i class="fas fa-calendar-alt"></i> {{ date('d/m/Y') }}</span>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('page-title', 'Quản trị hệ thống')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">@yield('page-actions')</div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('admin-content')
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-vi-VN.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarToggle').on('click', function() {
                $('#sidebar').toggleClass('d-none d-md-block');
                $('#main-content').toggleClass('col-md-9 col-lg-10 col-md-12 col-lg-12');
            });

            $('.data-table').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/vi.json' },
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tất cả"]]
            });

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
                ]
            });

            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var deleteUrl = $(this).data('url');
                $('#delete-form').attr('action', deleteUrl);
                $('#deleteModal').modal('show');
            });
        });
    </script>

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
@endsection