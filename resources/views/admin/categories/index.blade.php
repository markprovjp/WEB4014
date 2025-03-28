@extends('layouts.admin')

@section('title', 'Quản lý loại tin')

@section('page-title', 'Quản lý loại tin')

@section('page-actions')
<a href="{{ route('admin.categories.create') }}" class="btn btn-success">
    <i class="fas fa-plus-circle"></i> Thêm loại tin
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
                        <th>Tên loại tin</th>
                        <th>Slug</th>
                        <th>Số bài viết</th>
                        <th width="200">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->news_count }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <button class="btn btn-sm btn-danger btn-delete" data-url="{{ route('admin.categories.destroy', $category->id) }}">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection