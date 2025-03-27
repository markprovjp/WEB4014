@extends('layout')
@section('tieudetrang')
    {{ DB::table('loaiTin')->where('id', $idLT)->value('tenLoai') }}
@endsection
@section('noidung')
    <div class="category-header mb-4">
        <h1 class="display-5">{{ DB::table('loaiTin')->where('id', $idLT)->value('tenLoai') }}</h1>
        <div class="category-line"></div>
    </div>
    
    <div class="row news-container">
        @forelse ($tintrongloai as $tin)
            <div class="col-md-6 mb-4">
                <div class="card news-card h-100">
                    <div class="card-body">
                        <h3 class="card-title mb-3">
                            <a href="/tin/{{ $tin->id }}" class="text-decoration-none news-title">{{ $tin->TieuDe }}</a>
                        </h3>
                        <p class="card-text news-summary">{{ $tin->TomTat }}</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="/tin/{{ $tin->id }}" class="btn btn-outline-primary btn-sm read-more-btn">
                            Đọc tiếp <i class="fas fa-angle-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="empty-state">
                    <i class="fas fa-newspaper fa-3x mb-3 text-muted"></i>
                    <h3>Không có bài viết nào</h3>
                    <p class="text-muted">Hiện chưa có bài viết nào trong danh mục này.</p>
                </div>
            </div>
        @endforelse
    </div>
@endsection

@section('custom_css')
<style>
    .category-header {
        position: relative;
        margin-bottom: 2rem;
    }
    
    .category-line {
        height: 4px;
        width: 60px;
        background-color: #0d6efd;
        margin-top: 12px;
    }
    
    .news-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        border: none;
    }
    
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .news-title {
        color: #333;
        font-weight: 600;
    }
    
    .news-title:hover {
        color: #0d6efd;
    }
    
    .news-summary {
        color: #666;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .read-more-btn {
        font-size: 0.85rem;
        padding: 0.25rem 0.75rem;
    }
    
    .empty-state {
        padding: 40px;
        color: #6c757d;
    }
</style>
@endsection