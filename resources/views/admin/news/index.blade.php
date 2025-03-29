@extends('layouts.admin')

@section('title', 'Quản lý tin tức')

@section('page-title', 'Quản lý tin tức')

@section('page-actions')
<a href="{{ route('admin.news.create') }}" class="btn btn-success">
    <i class="fas fa-plus-circle"></i> Thêm tin tức
</a>
@endsection

@section('admin-content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover data-table">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Tiêu đề</th>
                        <th>Loại tin</th>
                        <th>Slug</th>
                        <th>Lượt xem</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th width="200">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="img-thumbnail me-2" width="50">
                                @endif
                                <span>{{ $item->title }}</span>
                            </div>
                            @if($item->hot)
                                <span class="badge bg-danger">HOT</span>
                            @endif
                        </td>
                        <td>{{ $item->category->name ?? 'Không có' }}</td>
                        <td><small class="text-muted">{{ $item->slug }}</small></td>
                        <td>{{ $item->views }}</td>
                        <td>
                            @if($item->status == 'published')
                                <span class="badge bg-success">Đã xuất bản</span>
                            @else
                                <span class="badge bg-secondary">Bản nháp</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <button class="btn btn-sm btn-danger btn-delete" data-url="{{ route('admin.news.destroy', $item->id) }}">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                                @if($item->status == 'published')
                                    <a href="{{ route('news.detail', $item->id) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
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
        // Destroy any existing DataTable instance
        var table = $('.data-table').DataTable();
        if ($.fn.DataTable.isDataTable('.data-table')) {
            table.destroy();
        }
        
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
    });
</script>
@endsection