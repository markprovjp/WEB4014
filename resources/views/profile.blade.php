@extends('layouts.app')

@section('title', 'Trang cá nhân - ' . Auth::user()->name)

@section('styles')
@parent
<style>
    .profile-header {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #fff;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    .avatar-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #adb5bd;
        border: 5px solid #fff;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    .nav-pills .nav-link {
        border-radius: 5px;
        padding: 0.75rem 1.25rem;
        margin-bottom: 0.5rem;
        transition: all 0.3s;
        display: flex;
        align-items: center;
    }
    
    .nav-pills .nav-link:not(.active):hover {
        background-color: rgba(26, 115, 232, 0.1);
    }
    
    .nav-pills .nav-link i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }
    
    .tab-content {
        background-color: #fff;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }
    
    .form-control, .form-select {
        border-radius: 5px;
        padding: 0.75rem 1rem;
    }
    
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
</style>
@endsection

@section('main-content')
<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header d-flex align-items-center" data-aos="fade-up">
        <div class="me-4">
            @if (Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="profile-avatar">
            @else
                <div class="avatar-placeholder">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif
        </div>
        <div>
            <h2 class="mb-1">{{ Auth::user()->name }}</h2>
            <p class="text-muted mb-2">
                <i class="fas fa-envelope me-2"></i>{{ Auth::user()->email }}
            </p>
            <div>
                <span class="badge bg-{{ Auth::user()->role === 'admin' ? 'danger' : 'primary' }} me-2">
                    <i class="fas fa-{{ Auth::user()->role === 'admin' ? 'shield-alt' : 'user' }} me-1"></i>
                    {{ Auth::user()->role === 'admin' ? 'Quản trị viên' : 'Người dùng' }}
                </span>
                <span class="badge bg-{{ Auth::user()->active ? 'success' : 'warning' }}">
                    <i class="fas fa-{{ Auth::user()->active ? 'check-circle' : 'clock' }} me-1"></i>
                    {{ Auth::user()->active ? 'Đã kích hoạt' : 'Chưa kích hoạt' }}
                </span>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4" data-aos="fade-right">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active" id="account-tab" data-bs-toggle="tab" href="#account">
                        <i class="fas fa-user"></i> Thông tin tài khoản
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="security-tab" data-bs-toggle="tab" href="#security">
                        <i class="fas fa-lock"></i> Bảo mật
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="comments-tab" data-bs-toggle="tab" href="#comments">
                        <i class="fas fa-comments"></i> Bình luận của tôi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="notifications-tab" data-bs-toggle="tab" href="#notifications">
                        <i class="fas fa-bell"></i> Thông báo
                    </a>
                </li>
                @if (Auth::user()->role === 'admin')
                <li class="nav-item mt-3">
                    <a class="nav-link bg-danger text-white" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Quản trị hệ thống
                    </a>
                </li>
                @endif
            </ul>
        </div>
        
        <!-- Tab Content -->
        <div class="col-lg-9" data-aos="fade-left">
            <div class="tab-content">
                <!-- Account Tab -->
                <div class="tab-pane fade show active" id="account">
                    <h4 class="mb-4">Thông tin tài khoản</h4>
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label d-block">Ảnh đại diện</label>
                                    <div class="text-center mb-3">
                                        @if (Auth::user()->avatar)
                                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                                alt="{{ Auth::user()->name }}" 
                                                class="img-fluid rounded-circle mb-2" 
                                                style="width: 150px; height: 150px; object-fit: cover;">
                                        @else
                                            <div class="avatar-placeholder mx-auto mb-2" style="width: 150px; height: 150px; font-size: 4rem;">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar">
                                    <div class="form-text">Chọn ảnh có kích thước không quá 2MB</div>
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    @if (Auth::user()->avatar)
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_avatar" id="remove_avatar">
                                        <label class="form-check-label" for="remove_avatar">
                                            Xóa ảnh đại diện
                                        </label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Cập nhật thông tin
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Security Tab -->
                <div class="tab-pane fade" id="security">
                    <h4 class="mb-4">Bảo mật tài khoản</h4>
                    
                    @if (session('password_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('password_success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('profile.change-password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-key me-2"></i>Đổi mật khẩu
                            </button>
                        </div>
                    </form>
                    
                    <hr class="my-4">
                    
                    <h5 class="mb-3">Hoạt động đăng nhập gần đây</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Thời gian</th>
                                    <th>Thiết bị</th>
                                    <th>Địa chỉ IP</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ now()->format('d/m/Y H:i') }}</td>
                                    <td>{{ request()->header('User-Agent') }}</td>
                                    <td>{{ request()->ip() }}</td>
                                    <td><span class="badge bg-success">Thành công</span></td>
                                </tr>
                                <!-- Thêm dữ liệu giả để demo -->
                                {{-- <tr>
                                    <td>{{ now()->subDays(2)->format('d/m/Y H:i') }}</td>
                                    <td>Mozilla/5.0 (iPhone; CPU iPhone OS 15_0)</td>
                                    <td>192.168.1.xxx</td>
                                    <td><span class="badge bg-success">Thành công</span></td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Comments Tab -->
                <div class="tab-pane fade" id="comments">
                    <h4 class="mb-4">Bình luận của tôi</h4>
                    
                    @if(isset($comments) && $comments->count() > 0)
                        <div class="list-group">
                            @foreach($comments as $comment)
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">
                                            <i class="far fa-clock me-1"></i> {{ $comment->created_at->diffForHumans() }}
                                        </small>
                                        <span class="badge bg-{{ $comment->status == 'approved' ? 'success' : ($comment->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ $comment->status == 'approved' ? 'Đã duyệt' : ($comment->status == 'pending' ? 'Chờ duyệt' : 'Từ chối') }}
                                        </span>
                                    </div>
                                    <div class="mb-2">{{ $comment->content }}</div>
                                    <small>
                                        <a href="{{ route('news.detail', $comment->news->id) }}" class="text-decoration-none">
                                            <i class="fas fa-newspaper me-1"></i> {{ $comment->news->title }}
                                        </a>
                                    </small>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-3">
                            {{ $comments->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center py-4">
                            <i class="fas fa-comment-slash fs-3 mb-3"></i>
                            <p class="mb-0">Bạn chưa có bình luận nào.</p>
                        </div>
                    @endif
                </div>
                
                <!-- Notifications Tab -->
                <div class="tab-pane fade" id="notifications">
                    <h4 class="mb-4">Cài đặt thông báo</h4>
                    
                    <form action="{{ route('profile.notifications') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="list-group mb-4">
                            <div class="list-group-item">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="email_news" name="notifications[email_news]" checked>
                                    <label class="form-check-label" for="email_news">Nhận email khi có tin tức mới</label>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="email_comments" name="notifications[email_comments]" checked>
                                    <label class="form-check-label" for="email_comments">Nhận email khi có người phản hồi bình luận</label>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="email_account" name="notifications[email_account]" checked>
                                    <label class="form-check-label" for="email_account">Nhận email về thay đổi tài khoản</label>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="email_marketing" name="notifications[email_marketing]">
                                    <label class="form-check-label" for="email_marketing">Nhận email quảng cáo và khuyến mãi</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        // Xử lý tab từ URL hash
        let hash = window.location.hash;
        if (hash) {
            $('.nav-link[href="'+hash+'"]').tab('show');
        }
        
        // Cập nhật URL khi chuyển tab
        $('.nav-link').on('click', function() {
            window.location.hash = $(this).attr('href');
        });
        
        // Preview avatar khi chọn file
        $("#avatar").change(function() {
            if (this.files && this.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    if ($('.profile-avatar').length) {
                        $('.profile-avatar').attr('src', e.target.result);
                    } else {
                        $('.avatar-placeholder').replaceWith('<img src="' + e.target.result + '" class="profile-avatar" alt="Avatar preview">');
                    }
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Khi checkbox xóa avatar được chọn
        $("#remove_avatar").change(function() {
            if($(this).is(":checked")) {
                $("#avatar").prop('disabled', true);
            } else {
                $("#avatar").prop('disabled', false);
            }
        });
    });
</script>
@endsection