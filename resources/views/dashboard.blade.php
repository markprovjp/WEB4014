@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">Dashboard</div>
        <div class="card-body">
            <h1>Welcome, {{ auth()->user()->name }}!</h1>
            <p>Role: {{ auth()->user()->role }}</p>
            @if(!auth()->user()->isAdmin())
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Total Expenses</h5>
                                <p class="card-text text-success">2,500,000 VNĐ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">This Month</h5>
                                <p class="card-text text-primary">1,200,000 VNĐ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Categories</h5>
                                <p class="card-text text-info">5 Active</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection