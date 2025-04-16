@extends('layouts.admin')

@section('title', 'Chi tiết người dùng')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.users.index') }}">Người dùng</a>
    </li>
@endsection

@section('page-title', 'Thông tin người dùng: ' . $user->name)

@section('page-actions')
    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
        <i class="fas fa-edit me-1"></i> Chỉnh sửa
    </a>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">
        <i class="fas fa-arrow-left me-1"></i> Quay lại
    </a>
@endsection

@section('admin-content')
<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center pt-5 pb-4">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" 
                         class="rounded-circle mb-3 img-thumbnail shadow-sm" width="150" height="150">
                @else
                    <div class="avatar-placeholder rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center bg-light">
                        <i class="fas fa-user-circle display-1 text-secondary"></i>
                    </div>
                @endif
                <h5 class="fw-bold">{{ $user->name }}</h5>
                <p class="text-muted mb-2">
                    @if($user->role == 'admin')
                        <span class="badge bg-danger">Quản trị viên</span>
                    @elseif($user->role == 'editor')
                        <span class="badge bg-primary">Biên tập viên</span>
                    @else
                        <span class="badge bg-secondary">Người dùng</span>
                    @endif
                </p>
                <p class="text-muted mb-3">
                    <i class="fas fa-clock me-1"></i> Tham gia: {{ $user->created_at->format('d/m/Y') }}
                </p>
                <div class="d-flex justify-content-center gap-2">
                    <a href="mailto:{{ $user->email }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-envelope me-1"></i> Email
                    </a>
                    @if($user->id != auth()->id())
                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete" 
                                data-url="{{ route('admin.users.destroy', $user->id) }}">
                            <i class="fas fa-trash-alt me-1"></i> Xóa
                        </button>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-light py-3">
                <h5 class="card-title mb-0">Thông tin tài khoản</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between px-0 py-3">
                        <span class="text-muted"><i class="fas fa-envelope me-2"></i> Email</span>
                        <span>{{ $user->email }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-3">
                        <span class="text-muted"><i class="fas fa-phone me-2"></i> Điện thoại</span>
                        <span>{{ $user->phone ?? 'Chưa cập nhật' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-3">
                        <span class="text-muted"><i class="fas fa-calendar-alt me-2"></i> Ngày sinh</span>
                        <span>{{ $user->birthday ? date('d/m/Y', strtotime($user->birthday)) : 'Chưa cập nhật' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-3">
                        <span class="text-muted"><i class="fas fa-venus-mars me-2"></i> Giới tính</span>
                        <span>
                            @if($user->gender == 'male')
                                Nam
                            @elseif($user->gender == 'female')
                                Nữ
                            @else
                                Chưa cập nhật
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-3">
                        <span class="text-muted"><i class="fas fa-check-circle me-2"></i> Trạng thái</span>
                        <span>
                            @if($user->email_verified_at)
                                <span class="badge bg-success">Đã xác thực</span>
                            @else
                                <span class="badge bg-warning text-dark">Chưa xác thực</span>
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-3">
                        <span class="text-muted"><i class="fas fa-shield-alt me-2"></i> Quyền hạn</span>
                        <span>
                            @if($user->role == 'admin')
                                <span class="badge bg-danger">Quản trị viên</span>
                            @elseif($user->role == 'editor')
                                <span class="badge bg-primary">Biên tập viên</span>
                            @else
                                <span class="badge bg-secondary">Người dùng</span>
                            @endif
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-light py-3">
                <h5 class="card-title mb-0">Hoạt động gần đây</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center px-3 py-3">
                        <div>
                            <i class="fas fa-sign-in-alt text-primary me-2"></i>
                            <span>Đăng nhập</span>
                        </div>
                        <span class="text-muted small">{{ now()->subDays(rand(0, 3))->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center px-3 py-3">
                        <div>
                            <i class="fas fa-user-edit text-success me-2"></i>
                            <span>Cập nhật thông tin</span>
                        </div>
                        <span class="text-muted small">{{ now()->subDays(rand(4, 7))->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center px-3 py-3">
                        <div>
                            <i class="fas fa-comment-alt text-info me-2"></i>
                            <span>Bình luận mới</span>
                        </div>
                        <span class="text-muted small">{{ now()->subDays(rand(8, 10))->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-primary-subtle rounded-circle me-3">
                                <i class="fas fa-newspaper text-primary"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 fw-bold">{{ $newsCount ?? 0 }}</h3>
                                <p class="mb-0">Bài viết</p>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">Số lượng bài viết người dùng đã đăng trên hệ thống</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-success-subtle rounded-circle me-3">
                                <i class="fas fa-comments text-success"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 fw-bold">{{ $commentCount ?? 0 }}</h3>
                                <p class="mb-0">Bình luận</p>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">Số lượng bình luận người dùng đã đăng trên hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Biểu đồ hoạt động -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light py-3">
                <h5 class="card-title mb-0">Thống kê hoạt động</h5>
            </div>
            <div class="card-body">
                <canvas id="userActivityChart" height="250"></canvas>
            </div>
        </div>
        
        <!-- Bài viết gần đây -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Bài viết gần đây</h5>
                @if(isset($recentNews) && count($recentNews) > 0)
                <a href="#" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                @endif
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Loại tin</th>
                                <th>Ngày đăng</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentNews ?? [] as $news)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.news.edit', $news->id) }}">{{ $news->title }}</a>
                                </td>
                                <td>{{ $news->category->name ?? 'Không có' }}</td>
                                <td>{{ $news->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($news->status == 'published')
                                        <span class="badge bg-success">Đã xuất bản</span>
                                    @else
                                        <span class="badge bg-secondary">Bản nháp</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="fas fa-newspaper text-muted me-2"></i>
                                    Người dùng chưa đăng bài viết nào
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Bình luận gần đây -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Bình luận gần đây</h5>
                @if(isset($recentComments) && count($recentComments) > 0)
                <a href="#" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                @endif
            </div>
            <div class="card-body p-0">
                @forelse($recentComments ?? [] as $comment)
                <div class="p-3 border-bottom">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <span class="fw-bold">{{ $comment->news->title ?? 'Bài viết không tồn tại' }}</span>
                        </div>
                        <div class="text-muted small">{{ $comment->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <p class="mb-2">{{ $comment->content }}</p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fas fa-edit me-1"></i> Sửa
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete" 
                                data-url="{{ route('admin.comments.destroy', $comment->id) }}">
                            <i class="fas fa-trash-alt me-1"></i> Xóa
                        </button>
                    </div>
                </div>
                @empty
                <div class="p-4 text-center">
                    <i class="fas fa-comments text-muted me-2"></i>
                    <p class="mb-0">Người dùng chưa đăng bình luận nào</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
@parent
<style>
    .avatar-placeholder {
        width: 150px;
        height: 150px;
        background-color: #f8f9fa;
    }
    
    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.1);
    }
    
    .bg-success-subtle {
        background-color: rgba(25, 135, 84, 0.1);
    }
    
    .list-group-item {
        transition: all 0.2s;
    }
    
    .list-group-item:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>
@endsection

@section('scripts')
@parent
<script>
    // Biểu đồ hoạt động người dùng
    $(document).ready(function() {
        const ctx = document.getElementById('userActivityChart').getContext('2d');
        const months = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'];
        
        // Dữ liệu giả lập - trong thực tế sẽ lấy từ backend
        const commentsData = Array.from({length: 12}, () => Math.floor(Math.random() * 10));
        const postsData = Array.from({length: 12}, () => Math.floor(Math.random() * 5));
        
        const userActivityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Bình luận',
                        data: commentsData,
                        borderColor: '#36b9cc',
                        backgroundColor: 'rgba(54, 185, 204, 0.1)',
                        borderWidth: 2,
                        pointBackgroundColor: '#36b9cc',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Bài viết',
                        data: postsData,
                        borderColor: '#4e73df',
                        backgroundColor: 'rgba(78, 115, 223, 0.1)',
                        borderWidth: 2,
                        pointBackgroundColor: '#4e73df',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
@endsection