@extends('layouts.admin')

@section('title', 'Tổng quan')

@section('page-title', 'Tổng quan hệ thống')

@section('admin-content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Tin tức</h6>
                        <h2 class="mb-0">{{ $newsCount }}</h2>
                    </div>
                    <i class="fas fa-newspaper fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.news.index') }}" class="text-white text-decoration-none">Xem chi tiết</a>
                <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Loại tin</h6>
                        <h2 class="mb-0">{{ $categoryCount }}</h2>
                    </div>
                    <i class="fas fa-list fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.categories.index') }}" class="text-white text-decoration-none">Xem chi tiết</a>
                <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Người dùng</h6>
                        <h2 class="mb-0">{{ $userCount }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.users.index') }}" class="text-white text-decoration-none">Xem chi tiết</a>
                <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-danger h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Bình luận</h6>
                        <h2 class="mb-0">{{ $commentCount }}</h2>
                    </div>
                    <i class="fas fa-comments fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.comments.index') }}" class="text-white text-decoration-none">Xem chi tiết</a>
                <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Tin tức mới nhất</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Loại tin</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestNews as $news)
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
                                <td colspan="4" class="text-center">Không có tin tức nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">Phân bố tin tức theo loại</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @forelse($newsByCategory as $category)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $category->name }}
                        <span class="badge bg-primary rounded-pill">{{ $category->count }}</span>
                    </div>
                    @empty
                    <div class="list-group-item">Không có dữ liệu</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">Thống kê người dùng đăng ký theo tháng ({{ date('Y') }})</h5>
            </div>
            <div class="card-body">
                <canvas id="userRegistrationChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Biểu đồ đăng ký người dùng
    var ctx = document.getElementById('userRegistrationChart').getContext('2d');
    var userChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: 'Người dùng đăng ký',
                data: [
                    {{ $usersByMonth[1] ?? 0 }}, {{ $usersByMonth[2] ?? 0 }}, {{ $usersByMonth[3] ?? 0 }},
                    {{ $usersByMonth[4] ?? 0 }}, {{ $usersByMonth[5] ?? 0 }}, {{ $usersByMonth[6] ?? 0 }},
                    {{ $usersByMonth[7] ?? 0 }}, {{ $usersByMonth[8] ?? 0 }}, {{ $usersByMonth[9] ?? 0 }},
                    {{ $usersByMonth[10] ?? 0 }}, {{ $usersByMonth[11] ?? 0 }}, {{ $usersByMonth[12] ?? 0 }}
                ],
                backgroundColor: 'rgba(23, 162, 184, 0.7)',
                borderColor: 'rgba(23, 162, 184, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection