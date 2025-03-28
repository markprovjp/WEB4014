@extends('layouts.app')

@section('title', 'Quên mật khẩu')

@section('main-content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Khôi phục mật khẩu</h4>
                </div>

                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Địa chỉ Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text mt-2">
                                Chúng tôi sẽ gửi mã xác nhận đến email của bạn.
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Gửi mã xác nhận
                            </button>
                            
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-left"></i> Quay lại đăng nhập
                            </a>
                        </div>
                    </form>
                </div>
                                <div class="mt-3 text-center">
                    <p>Đã nhận được mã xác nhận? 
                        <a href="{{ route('password.verify') }}" class="text-decoration-none">
                            Nhập mã xác nhận
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection