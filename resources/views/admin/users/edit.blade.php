@extends('layouts.admin')

@section('title', 'Chỉnh sửa người dùng')

@section('page-title', 'Chỉnh sửa người dùng')

@section('page-actions')
<a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Quay lại
</a>
@endsection

@section('admin-content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <div class="mb-3">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="avatar-label rounded-circle bg-{{ ['primary','success','warning','info','danger'][($user->id % 5)] }} mx-auto" style="width: 150px; height: 150px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 64px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="text-muted">{{ $user->email }}</p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }} p-2">
                        <i class="fas fa-{{ $user->role == 'admin' ? 'user-shield' : 'user' }} me-1"></i>
                        {{ $user->role == 'admin' ? 'Quản trị viên' : 'Người dùng' }}
                    </span>
                    
                    <span class="badge bg-{{ $user->active ? 'success' : 'secondary' }} p-2">
                        <i class="fas fa-{{ $user->active ? 'check-circle' : 'times-circle' }} me-1"></i>
                        {{ $user->active ? 'Đang hoạt động' : 'Chưa kích hoạt' }}
                    </span>
                </div>
                
                <div class="border-top pt-3">
                    <div class="row text-center">
                        <div class="col">
                            <h6>{{ $user->comments->count() }}</h6>
                            <small class="text-muted">Bình luận</small>
                        </div>
                        <div class="col">
                            <h6>{{ $user->created_at->format('d/m/Y') }}</h6>
                            <small class="text-muted">Ngày tham gia</small>
                        </div>
                        <div class="col">
                            <h6>{{ $user->id }}</h6>
                            <small class="text-muted">ID</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Thông tin người dùng</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Tên người dùng <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Mật khẩu</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            <div class="form-text">Để trống nếu không muốn đổi mật khẩu</div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="password_confirmation" class="col-sm-3 col-form-label">Xác nhận mật khẩu</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="role" class="col-sm-3 col-form-label">Vai trò <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Người dùng</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="avatar" class="col-sm-3 col-form-label">Ảnh đại diện</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar">
                            <div class="form-text">Chấp nhận file JPG, PNG, GIF. Tối đa 1MB</div>
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if($user->avatar)
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="remove_avatar" name="remove_avatar" value="1">
                                <label class="form-check-label" for="remove_avatar">
                                    Xóa ảnh đại diện hiện tại
                                </label>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', $user->active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">
                                    Tài khoản đang hoạt động
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Cập nhật
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Hủy
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection