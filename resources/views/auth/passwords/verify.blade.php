@extends('layouts.app')

@section('title', 'Xác minh mã khôi phục mật khẩu')

@section('main-content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Xác minh mã khôi phục mật khẩu</h4>
                </div>

                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.verify.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Địa chỉ Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="token" class="form-label">Mã xác nhận</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input id="token" type="text" class="form-control @error('token') is-invalid @enderror" 
                                       name="token" required>
                            </div>
                            @error('token')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text mt-2">
                                Vui lòng nhập mã xác nhận đã được gửi đến email của bạn.
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check-circle"></i> Xác minh mã
                            </button>
                        </div>
                        
                        <div class="mt-3 text-center">
                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                <i class="fas fa-envelope"></i> Gửi lại mã xác nhận
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection