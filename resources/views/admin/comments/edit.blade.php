@extends('layouts.admin')

@section('title', 'Chỉnh sửa bình luận')

@section('page-title', 'Chỉnh sửa bình luận')

@section('page-actions')
<a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Quay lại
</a>
@endsection

@section('admin-content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">Thông tin bình luận</h5>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <div class="d-flex align-items-center mb-3">
                <div class="me-3">
                    @if($comment->user->avatar)
                        <img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="{{ $comment->user->name }}" class="rounded-circle" width="50" height="50">
                    @else
                        <div class="avatar-label rounded-circle bg-{{ ['primary','success','warning','info','danger'][($comment->user->id % 5)] }} text-white" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div>
                    <h5 class="mb-0">{{ $comment->user->name }}</h5>
                    <p class="text-muted mb-0">{{ $comment->user->email }}</p>
                    <small class="text-muted">
                        <i class="far fa-clock"></i> Đăng lúc: {{ $comment->created_at->format('d/m/Y H:i:s') }}
                    </small>
                </div>
            </div>
            
            <div class="mb-3">
                <p class="mb-1"><strong>Bình luận trên bài viết:</strong></p>
                <div class="alert alert-light">
                    <a href="{{ route('news.detail', $comment->news->id) }}" target="_blank" class="text-decoration-none">
                        <i class="fas fa-newspaper me-1"></i> {{ $comment->news->title }}
                    </a>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung bình luận <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content', $comment->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label d-block">Trạng thái</label>
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="status" id="status-pending" value="pending" {{ old('status', $comment->status) == 'pending' ? 'checked' : '' }}>
                    <label class="btn btn-outline-warning" for="status-pending">
                        <i class="fas fa-clock"></i> Chờ duyệt
                    </label>
                    
                    <input type="radio" class="btn-check" name="status" id="status-approved" value="approved" {{ old('status', $comment->status) == 'approved' ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="status-approved">
                        <i class="fas fa-check"></i> Đã duyệt
                    </label>
                    
                    <input type="radio" class="btn-check" name="status" id="status-rejected" value="rejected" {{ old('status', $comment->status) == 'rejected' ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="status-rejected">
                        <i class="fas fa-ban"></i> Từ chối
                    </label>
                </div>
                @error('status')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <hr>
            
            <div class="d-flex justify-content-between">
                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật bình luận
                    </button>
                    <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </div>
                
                <button type="button" class="btn btn-danger btn-delete" data-url="{{ route('admin.comments.destroy', $comment->id) }}">
                    <i class="fas fa-trash"></i> Xóa bình luận
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            var deleteUrl = $(this).data('url');
            
            Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Bạn không thể khôi phục lại bình luận sau khi xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa bình luận',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form xóa
                    var form = $('<form method="POST" action="' + deleteUrl + '"></form>');
                    form.append('@csrf');
                    form.append('@method("DELETE")');
                    $('body').append(form);
                    form.submit();
                }
            });
        });
    });
</script>
@endsection@extends('layouts.admin')

@section('title', 'Chỉnh sửa bình luận')

@section('page-title', 'Chỉnh sửa bình luận')

@section('page-actions')
<a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Quay lại
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">Thông tin bình luận</h5>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <div class="d-flex align-items-center mb-3">
                <div class="me-3">
                    @if($comment->user->avatar)
                        <img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="{{ $comment->user->name }}" class="rounded-circle" width="50" height="50">
                    @else
                        <div class="avatar-label rounded-circle bg-{{ ['primary','success','warning','info','danger'][($comment->user->id % 5)] }} text-white" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div>
                    <h5 class="mb-0">{{ $comment->user->name }}</h5>
                    <p class="text-muted mb-0">{{ $comment->user->email }}</p>
                    <small class="text-muted">
                        <i class="far fa-clock"></i> Đăng lúc: {{ $comment->created_at->format('d/m/Y H:i:s') }}
                    </small>
                </div>
            </div>
            
            <div class="mb-3">
                <p class="mb-1"><strong>Bình luận trên bài viết:</strong></p>
                <div class="alert alert-light">
                    <a href="{{ route('news.detail', $comment->news->id) }}" target="_blank" class="text-decoration-none">
                        <i class="fas fa-newspaper me-1"></i> {{ $comment->news->title }}
                    </a>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung bình luận <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content', $comment->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label d-block">Trạng thái</label>
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="status" id="status-pending" value="pending" {{ old('status', $comment->status) == 'pending' ? 'checked' : '' }}>
                    <label class="btn btn-outline-warning" for="status-pending">
                        <i class="fas fa-clock"></i> Chờ duyệt
                    </label>
                    
                    <input type="radio" class="btn-check" name="status" id="status-approved" value="approved" {{ old('status', $comment->status) == 'approved' ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="status-approved">
                        <i class="fas fa-check"></i> Đã duyệt
                    </label>
                    
                    <input type="radio" class="btn-check" name="status" id="status-rejected" value="rejected" {{ old('status', $comment->status) == 'rejected' ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="status-rejected">
                        <i class="fas fa-ban"></i> Từ chối
                    </label>
                </div>
                @error('status')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            
            <hr>
            
            <div class="d-flex justify-content-between">
                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật bình luận
                    </button>
                    <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </div>
                
                <button type="button" class="btn btn-danger btn-delete" data-url="{{ route('admin.comments.destroy', $comment->id) }}">
                    <i class="fas fa-trash"></i> Xóa bình luận
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            var deleteUrl = $(this).data('url');
            
            Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Bạn không thể khôi phục lại bình luận sau khi xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa bình luận',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form xóa
                    var form = $('<form method="POST" action="' + deleteUrl + '"></form>');
                    form.append('@csrf');
                    form.append('@method("DELETE")');
                    $('body').append(form);
                    form.submit();
                }
            });
        });
    });
</script>
@endsection