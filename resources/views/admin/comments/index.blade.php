@extends('layouts.admin')

@section('title', 'Quản lý bình luận')

@section('page-title', 'Quản lý bình luận')

@section('page-actions')
<div class="btn-group" role="group">
    <a href="{{ route('admin.comments.index') }}" class="btn {{ !request('status') ? 'btn-primary' : 'btn-outline-primary' }}">
        <i class="fas fa-list"></i> Tất cả
    </a>
    <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}" class="btn {{ request('status') == 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">
        <i class="fas fa-clock"></i> Chờ duyệt
    </a>
    <a href="{{ route('admin.comments.index', ['status' => 'approved']) }}" class="btn {{ request('status') == 'approved' ? 'btn-success' : 'btn-outline-success' }}">
        <i class="fas fa-check"></i> Đã duyệt
    </a>
    <a href="{{ route('admin.comments.index', ['status' => 'rejected']) }}" class="btn {{ request('status') == 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}">
        <i class="fas fa-ban"></i> Đã từ chối
    </a>
</div>
@endsection

@section('admin-content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Danh sách bình luận</h5>
        <span class="badge bg-secondary">Tổng: {{ $comments->total() }} bình luận</span>
    </div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            @forelse($comments as $comment)
            <div class="list-group-item p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3">
                            @if($comment->user->avatar)
                                <img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="{{ $comment->user->name }}" class="rounded-circle" width="40" height="40">
                            @else
                                <div class="avatar-label rounded-circle bg-{{ ['primary','success','warning','info','danger'][($comment->user->id % 5)] }} text-white" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="fw-bold">{{ $comment->user->name }}</div>
                            <small class="text-muted">
                                <i class="far fa-clock me-1"></i> {{ $comment->created_at->diffForHumans() }}
                                <i class="fas fa-newspaper ms-2 me-1"></i> 
                                <a href="{{ route('news.detail', $comment->news->id) }}" target="_blank" class="text-decoration-none">
                                    {{ Str::limit($comment->news->title, 35) }}
                                </a>
                            </small>
                        </div>
                    </div>
                    <div>
                        @if($comment->status == 'pending')
                            <span class="badge bg-warning">Chờ duyệt</span>
                        @elseif($comment->status == 'approved')
                            <span class="badge bg-success">Đã duyệt</span>
                        @elseif($comment->status == 'rejected')
                            <span class="badge bg-danger">Từ chối</span>
                        @endif
                    </div>
                </div>
                <div class="comment-content border-start border-3 ps-3 mb-2" style="border-color: #ddd !important;">
                    {{ $comment->content }}
                </div>
                <div class="d-flex justify-content-end">
                    <div class="btn-group">
                        @if($comment->status != 'approved')
                        <button class="btn btn-sm btn-success btn-approve" data-id="{{ $comment->id }}">
                            <i class="fas fa-check"></i> Duyệt
                        </button>
                        @endif
                        
                        @if($comment->status != 'rejected')
                        <button class="btn btn-sm btn-warning btn-reject" data-id="{{ $comment->id }}">
                            <i class="fas fa-ban"></i> Từ chối
                        </button>
                        @endif
                        
                        <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <button class="btn btn-sm btn-danger btn-delete" data-url="{{ route('admin.comments.destroy', $comment->id) }}">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="list-group-item p-4 text-center">
                <i class="fas fa-comment-slash fs-1 text-muted mb-3"></i>
                <p>Không có bình luận nào</p>
            </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer bg-white">
        {{ $comments->links() }}
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(document).ready(function() {
        // Xử lý duyệt bình luận
        $('.btn-approve').click(function() {
            const commentId = $(this).data('id');
            const row = $(this).closest('.list-group-item');
            
            $.ajax({
                url: `{{ url('admin/comments') }}/${commentId}/approve`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: response.message || 'Bình luận đã được duyệt!'
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function(xhr) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Có lỗi xảy ra, vui lòng thử lại.'
                    });
                }
            });
        });
        
        // Xử lý từ chối bình luận
        $('.btn-reject').click(function() {
            const commentId = $(this).data('id');
            const row = $(this).closest('.list-group-item');
            
            $.ajax({
                url: `{{ url('admin/comments') }}/${commentId}/reject`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: response.message || 'Bình luận đã bị từ chối!'
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function(xhr) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Có lỗi xảy ra, vui lòng thử lại.'
                    });
                }
            });
        });
    });
</script>
@endsection