@extends('layouts.app')

@section('content')
<div class="container">
    @auth
    <!-- Giao diện khi ĐÃ ĐĂNG NHẬP -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);">
                <div class="card-body p-4 text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-1">Chào mừng trở lại, {{ auth()->user()->name }}!</h3>
                            <p class="mb-0 opacity-75">
                                <i class="fas fa-calendar-alt me-2"></i>Hôm nay là 
                                {{ \Illuminate\Support\Str::title(\Carbon\Carbon::now()->locale('vi')->translatedFormat('l, d/m/Y')) }}
                            </p>                            
                        </div>
                        <div class="bg-white rounded-circle p-3 shadow" style="width: 70px; height: 70px;">
                            <i class="fas fa-wallet text-gradient-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-2 border-top border-white-25">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-user-tag fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="d-block opacity-75">Vai trò</small>
                                        <strong>{{ auth()->user()->isAdmin() ? 'Quản trị viên' : 'Khách hàng' }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-calendar-check fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="d-block opacity-75">Tham gia từ</small>
                                        <strong>{{ auth()->user()->created_at->format('d/m/Y') }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-bell fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="d-block opacity-75">Thông báo</small>
                                        <strong>3 mới</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Phần thống kê chính -->
    <div class="row mb-4">
        <!-- Tổng chi tiêu -->
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0 overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title text-muted mb-2">Tổng chi tiêu</h5>
                            <h3 class="fw-bold mb-0">2.500.000 ₫</h3>
                            <small class="text-muted">Tổng số tiền đã chi tiêu</small>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-money-bill-wave text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top">
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i> 12.5% so với tháng trước
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tháng này -->
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0 overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title text-muted mb-2">Tháng này</h5>
                            <h3 class="fw-bold mb-0">1.200.000 ₫</h3>
                            <small class="text-muted">Chi tiêu trong tháng hiện tại</small>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="fas fa-chart-line text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top">
                        <small class="text-danger">
                            <i class="fas fa-arrow-down me-1"></i> 8.3% so với tháng trước
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh mục -->
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0 overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title text-muted mb-2">Danh mục</h5>
                            <h3 class="fw-bold mb-0">5 danh mục</h3>
                            <small class="text-muted">Danh mục đang hoạt động</small>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="fas fa-tags text-info fs-4"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top">
                        <div class="d-flex align-items-center">
                            <div class="progress flex-grow-1" style="height: 6px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 75%;"></div>
                            </div>
                            <small class="text-muted ms-2">75% sử dụng</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Phần biểu đồ và chi tiêu gần đây -->
    <div class="row">
        <!-- Biểu đồ chi tiêu -->
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Biểu đồ chi tiêu</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Năm 2023
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">2023</a></li>
                                <li><a class="dropdown-item" href="#">2022</a></li>
                                <li><a class="dropdown-item" href="#">2021</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="expenseChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        <!-- Chi tiêu gần đây -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Chi tiêu gần đây</h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                    </div>
                    
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-utensils text-danger"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Ăn uống</h6>
                                    <small class="text-muted">Hôm nay, 12:30</small>
                                </div>
                                <div class="text-danger fw-bold">500.000 ₫</div>
                            </div>
                        </div>
                        
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-car text-warning"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Di chuyển</h6>
                                    <small class="text-muted">Hôm nay, 08:15</small>
                                </div>
                                <div class="text-warning fw-bold">300.000 ₫</div>
                            </div>
                        </div>
                        
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-film text-info"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Giải trí</h6>
                                    <small class="text-muted">Hôm qua, 20:00</small>
                                </div>
                                <div class="text-info fw-bold">200.000 ₫</div>
                            </div>
                        </div>
                        
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-shopping-bag text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Mua sắm</h6>
                                    <small class="text-muted">Hôm qua, 15:45</small>
                                </div>
                                <div class="text-success fw-bold">200.000 ₫</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Giao diện khi CHƯA ĐĂNG NHẬP -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <i class="fas fa-wallet text-primary" style="font-size: 4rem;"></i>
                    </div>
                    <h2 class="fw-bold mb-3">Quản lý chi tiêu cá nhân</h2>
                    <p class="text-muted mb-4">
                        Theo dõi và quản lý chi tiêu của bạn một cách dễ dàng và hiệu quả. 
                        Bắt đầu ngay để kiểm soát tài chính tốt hơn!
                    </p>
                    
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3">
                            <i class="fas fa-sign-in-alt me-2"></i> Đăng nhập
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">
                            <i class="fas fa-user-plus me-2"></i> Đăng ký
                        </a>
                    </div>
                    
                    <div class="mt-5">
                        <h5 class="mb-3">Tại sao chọn chúng tôi?</h5>
                        <div class="row text-start">
                            <div class="col-md-4 mb-3">
                                <div class="d-flex">
                                    <div class="me-3 text-primary">
                                        <i class="fas fa-chart-pie fa-2x"></i>
                                    </div>
                                    <div>
                                        <h6>Thống kê trực quan</h6>
                                        <p class="text-muted small">Biểu đồ và báo cáo chi tiết giúp bạn hiểu rõ chi tiêu</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex">
                                    <div class="me-3 text-primary">
                                        <i class="fas fa-bell fa-2x"></i>
                                    </div>
                                    <div>
                                        <h6>Nhắc nhở thông minh</h6>
                                        <p class="text-muted small">Cảnh báo khi chi tiêu vượt ngân sách</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex">
                                    <div class="me-3 text-primary">
                                        <i class="fas fa-mobile-alt fa-2x"></i>
                                    </div>
                                    <div>
                                        <h6>Mọi lúc mọi nơi</h6>
                                        <p class="text-muted small">Truy cập trên mọi thiết bị, đồng bộ dữ liệu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth
</div>
@endsection

@section('scripts')
@auth
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo biểu đồ
        var chartDom = document.getElementById('expenseChart');
        var myChart = echarts.init(chartDom);
        
        var option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                formatter: '{b}<br/>{a}: {c} ₫'
            },
            legend: {
                data: ['Chi tiêu'],
                right: 10,
                top: 0
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: {
                type: 'category',
                data: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7'],
                axisLine: {
                    lineStyle: {
                        color: '#e0e0e0'
                    }
                },
                axisLabel: {
                    color: '#6c757d'
                }
            },
            yAxis: {
                type: 'value',
                axisLabel: {
                    formatter: '{value} ₫',
                    color: '#6c757d'
                },
                axisLine: {
                    show: false
                },
                splitLine: {
                    lineStyle: {
                        color: '#f1f1f1'
                    }
                }
            },
            series: [
                {
                    name: 'Chi tiêu',
                    type: 'bar',
                    data: [1200000, 1500000, 1800000, 2100000, 1900000, 2300000, 2500000],
                    itemStyle: {
                        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                            { offset: 0, color: '#6a11cb' },
                            { offset: 1, color: '#2575fc' }
                        ]),
                        borderRadius: [4, 4, 0, 0]
                    },
                    emphasis: {
                        itemStyle: {
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                { offset: 0, color: '#2575fc' },
                                { offset: 1, color: '#6a11cb' }
                            ])
                        }
                    },
                    barWidth: '60%'
                }
            ]
        };
        
        myChart.setOption(option);
        
        // Xử lý resize window
        window.addEventListener('resize', function() {
            myChart.resize();
        });
    });
</script>
@endauth
@endsection