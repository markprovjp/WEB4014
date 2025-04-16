@extends('layouts.admin')

@section('title', 'Tổng quan')

@section('page-title', 'Tổng quan hệ thống')

@section('styless')
<style>
    .stats-card {
        transition: all 0.3s ease;
        border-radius: 0.75rem;
        overflow: hidden;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .stats-card .card-body {
        padding: 1.5rem;
    }
    
    .stats-card .card-footer {
        background: rgba(0,0,0,0.1);
        border-top: none;
        padding: 0.75rem 1.5rem;
    }
    
    .stats-card i.stats-icon {
        opacity: 0.4;
        transition: all 0.3s ease;
    }
    
    .stats-card:hover i.stats-icon {
        opacity: 0.6;
        transform: scale(1.1);
    }
    
    .chart-container {
        position: relative;
        height: 300px;
    }
    
    .data-card {
        border-radius: 0.75rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        transition: all 0.3s ease;
    }
    
    .data-card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .data-card .card-header {
        border-radius: 0.75rem 0.75rem 0 0;
        padding: 1rem 1.5rem;
        border-bottom: none;
    }
    
    .list-group-item {
        padding: 0.75rem 1.25rem;
        border-left: none;
        border-right: none;
        border-color: rgba(0, 0, 0, 0.05);
        transition: all 0.2s;
    }
    
    .list-group-item:hover {
        background-color: #f8f9fc;
    }
    
    .badge-pill {
        padding-right: 1rem;
        padding-left: 1rem;
    }
    
    .table > thead > tr > th {
        border-top: none;
        border-bottom-width: 1px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    
    .article-link {
        color: #4e73df;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .article-link:hover {
        color: #224abe;
        text-decoration: none;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #1cc88a, #13855c);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #f6c23e, #dda20a);
    }
    
    .bg-gradient-danger {
        background: linear-gradient(135deg, #e74a3b, #be2617);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #36b9cc, #258391);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .fade-in-up {
        animation: fadeInUp 0.5s forwards;
    }
</style>
@endsection

@section('admin-content')
<!-- Dashboard Stats Overview -->
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-gradient-primary h-100 stats-card fade-in-up" style="animation-delay: 0s;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-1 text-white-50">Tin tức</h6>
                        <h2 class="mb-0 font-weight-bold">{{ $newsCount }}</h2>
                    </div>
                    <i class="fas fa-newspaper fa-3x stats-icon"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.news.index') }}" class="text-white text-decoration-none small">
                    <i class="fas fa-clipboard-list fa-fw mr-1"></i> Xem chi tiết
                </a>
                <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-gradient-success h-100 stats-card fade-in-up" style="animation-delay: 0.1s;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-1 text-white-50">Loại tin</h6>
                        <h2 class="mb-0 font-weight-bold">{{ $categoryCount }}</h2>
                    </div>
                    <i class="fas fa-list fa-3x stats-icon"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.categories.index') }}" class="text-white text-decoration-none small">
                    <i class="fas fa-clipboard-list fa-fw mr-1"></i> Xem chi tiết
                </a>
                <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-gradient-warning h-100 stats-card fade-in-up" style="animation-delay: 0.2s;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-1 text-white-50">Người dùng</h6>
                        <h2 class="mb-0 font-weight-bold">{{ $userCount }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x stats-icon"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.users.index') }}" class="text-white text-decoration-none small">
                    <i class="fas fa-clipboard-list fa-fw mr-1"></i> Xem chi tiết
                </a>
                <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-gradient-danger h-100 stats-card fade-in-up" style="animation-delay: 0.3s;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-1 text-white-50">Bình luận</h6>
                        <h2 class="mb-0 font-weight-bold">{{ $commentCount }}</h2>
                    </div>
                    <i class="fas fa-comments fa-3x stats-icon"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.comments.index') }}" class="text-white text-decoration-none small">
                    <i class="fas fa-clipboard-list fa-fw mr-1"></i> Xem chi tiết
                </a>
                <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Latest News Table -->
    <div class="col-md-8 mb-4">
        <div class="card data-card shadow-sm">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-newspaper mr-2"></i>Tin tức mới nhất
                </h5>
                <a href="{{ route('admin.news.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-eye"></i> Xem tất cả
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">Tiêu đề</th>
                                <th class="border-0">Loại tin</th>
                                <th class="border-0">Ngày tạo</th>
                                <th class="border-0">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestNews as $news)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.news.edit', $news->id) }}" class="article-link d-block text-truncate" style="max-width: 300px;" title="{{ $news->title }}">
                                        {{ $news->title }}
                                    </a>
                                </td>
                                <td>
                                    @if($news->category)
                                        <span class="badge bg-light text-dark">{{ $news->category->name }}</span>
                                    @else
                                        <span class="badge bg-secondary">Không có</span>
                                    @endif
                                </td>
                                <td>{{ $news->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($news->status == 'published')
                                        <span class="badge bg-success text-white">Đã xuất bản</span>
                                    @else
                                        <span class="badge bg-secondary text-white">Bản nháp</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-info-circle mr-1"></i> Không có tin tức nào
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- News By Category -->
    <div class="col-md-4 mb-4">
        <div class="card data-card shadow-sm h-100">
            <div class="card-header bg-gradient-success text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-pie mr-2"></i>Phân bố tin tức theo loại
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($newsByCategory as $category)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="fas fa-folder text-primary mr-2"></i>
                            {{ $category->name }}
                        </span>
                        <span class="badge bg-primary text-white rounded-pill">{{ $category->count }}</span>
                    </div>
                    @empty
                    <div class="list-group-item text-center py-4">
                        <div class="text-muted">
                            <i class="fas fa-info-circle mr-1"></i> Không có dữ liệu
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Registration Chart -->
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card data-card shadow-sm">
            <div class="card-header bg-gradient-info text-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-bar mr-2"></i>Thống kê người dùng đăng ký theo tháng ({{ date('Y') }})
                </h5>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-light active" id="chartTypeBar">
                        <i class="fas fa-chart-bar"></i>
                    </button>
                    <button type="button" class="btn btn-outline-light" id="chartTypeLine">
                        <i class="fas fa-chart-line"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="userRegistrationChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-vi-VN.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Biểu đồ đăng ký người dùng
        var ctx = document.getElementById('userRegistrationChart').getContext('2d');
        var chartData = {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: 'Người dùng đăng ký',
                data: [
                    {{ $usersByMonth[1] ?? 0 }}, {{ $usersByMonth[2] ?? 0 }}, {{ $usersByMonth[3] ?? 0 }},
                    {{ $usersByMonth[4] ?? 0 }}, {{ $usersByMonth[5] ?? 0 }}, {{ $usersByMonth[6] ?? 0 }},
                    {{ $usersByMonth[7] ?? 0 }}, {{ $usersByMonth[8] ?? 0 }}, {{ $usersByMonth[9] ?? 0 }},
                    {{ $usersByMonth[10] ?? 0 }}, {{ $usersByMonth[11] ?? 0 }}, {{ $usersByMonth[12] ?? 0 }}
                ],
                backgroundColor: 'rgba(54, 185, 204, 0.7)',
                borderColor: 'rgba(54, 185, 204, 1)',
                borderWidth: 2,
                borderRadius: 5,
                tension: 0.3
            }]
        };
        
        var chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    cornerRadius: 5,
                    displayColors: false
                }
            }
        };
        
        var userChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: chartOptions
        });
        
        // Chuyển đổi kiểu biểu đồ
        $('#chartTypeBar').click(function() {
            $(this).addClass('active');
            $('#chartTypeLine').removeClass('active');
            userChart.destroy();
            userChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: chartOptions
            });
        });
        
        $('#chartTypeLine').click(function() {
            $(this).addClass('active');
            $('#chartTypeBar').removeClass('active');
            userChart.destroy();
            userChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: chartOptions
            });
        });
    });
</script>
@endsection