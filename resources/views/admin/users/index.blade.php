@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('page-title', 'Quản lý người dùng')

@section('page-actions')
<a href="{{ route('admin.users.create') }}" class="btn btn-success">
    <i class="fas fa-user-plus"></i> Thêm người dùng
</a>
@endsection

@section('admin-content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">Danh sách người dùng</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover data-table">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th width="250">Thông tin</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Ngày tham gia</th>
                        <th width="180">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle" width="40" height="40">
                                    @else
                                        <div class="avatar-label rounded-circle bg-{{ ['primary','success','warning','info','danger'][($user->id % 5)] }} text-white" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-comment-dots me-1"></i> {{ $user->comments_count }} bình luận
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge bg-danger">Quản trị viên</span>
                            @else
                                <span class="badge bg-primary">Người dùng</span>
                            @endif
                        </td>
                        <td>
                            @if($user->active)
                                <span class="badge bg-success">Đang hoạt động</span>
                            @else
                                <span class="badge bg-secondary">Chưa kích hoạt</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Chi tiết
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                @if($user->id != auth()->id())
                                    <button class="btn btn-sm btn-danger btn-delete" data-url="{{ route('admin.users.destroy', $user->id) }}">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        // Check if DataTable is already initialized on this table
        if (!$.fn.DataTable.isDataTable('.data-table')) {
            // Initialize DataTable with more options
            $('.data-table').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/vi.json' },
                pageLength: 25,
                order: [[6, 'desc']], // Sort by creation date
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
                columnDefs: [
                    {orderable: false, targets: [7]} // Disable sorting on action column
                ]
            });
        }
    });
</script>
@endsection