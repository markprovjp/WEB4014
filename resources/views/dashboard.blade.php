@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">Bảng điều khiển</div>
        <div class="card-body">
            <h1>Chào mừng, {{ auth()->user()->name }}!</h1>
            <p>Vai trò: {{ auth()->user()->role }}</p>
            @if(!auth()->user()->isAdmin())
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Tổng chi tiêu</h5>
                                <p class="card-text text-success">2.500.000 VNĐ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Tháng này</h5>
                                <p class="card-text text-primary">1.200.000 VNĐ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Danh mục</h5>
                                <p class="card-text text-info">5 danh mục đang hoạt động</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
