@extends('layout')
@section('tieudetrang')
    {{ $tin->TieuDe }}
@endsection
@section('noidung')
    <div class="article-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang chủ</a></li>
                <li class="breadcrumb-item">
                    <a href="/loai/{{ $tin->idLT }}" class="text-decoration-none">
                        {{ DB::table('loaiTin')->where('id', $tin->idLT)->value('tenLoai') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $tin->TieuDe }}</li>
            </ol>
        </nav>
        
        <!-- Article Header -->
        <div class="article-header">
            <h1 class="article-title mb-3">{{ $tin->TieuDe }}</h1>
            <div class="article-meta d-flex align-items-center mb-4">
                <div class="me-3">
                    <i class="far fa-calendar-alt text-muted me-1"></i>
                    <span>{{ date('d/m/Y H:i', strtotime($tin->Ngay)) }}</span>
                </div>
                <div class="me-3">
                    <i class="far fa-folder text-muted me-1"></i>
                    <a href="/loai/{{ $tin->idLT }}" class="category-link">
                        {{ DB::table('loaiTin')->where('id', $tin->idLT)->value('tenLoai') }}
                    </a>
                </div>
            </div>
            
            <div class="article-summary mb-4">
                {{ $tin->TomTat }}
            </div>
        </div>
        
        <!-- Article Content -->
        <div class="article-content">
            <div class="content-body">
                {!! $tin->Content !!}
            </div>
        </div>
        
        <!-- Related Articles -->
        <div class="related-articles mt-5">
            <h3 class="related-title mb-4">Bài viết liên quan</h3>
            
            <div class="row">
                @foreach(DB::table('tin')
                    ->where('idLT', $tin->idLT)
                    ->where('id', '!=', $tin->id)
                    ->orderBy('Ngay', 'desc')
                    ->limit(4)
                    ->get() as $related)
                    <div class="col-md-6 mb-4">
                        <div class="card related-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="/tin/{{ $related->id }}" class="text-decoration-none related-link">
                                        {{ $related->TieuDe }}
                                    </a>
                                </h5>
                                <div class="small text-muted">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ date('d/m/Y', strtotime($related->Ngay)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('custom_css')
<style>
    .article-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .article-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #212529;
    }
    
    .article-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    .category-link {
        color: #0d6efd;
        text-decoration: none;
    }
    
    .article-summary {
        font-size: 1.1rem;
        font-weight: 500;
        color: #495057;
        padding: 1rem 1.5rem;
        background-color: #f8f9fa;
        border-left: 4px solid #0d6efd;
        border-radius: 0 4px 4px 0;
    }
    
    .content-body {
        font-size: 1.05rem;
        line-height: 1.7;
    }
    
    .content-body img {
        max-width: 100%;
        height: auto;
        margin: 1.5rem 0;
        border-radius: 5px;
    }
    
    .content-body p {
        margin-bottom: 1.5rem;
    }
    
    .related-title {
        position: relative;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #dee2e6;
    }
    
    .related-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -1px;
        width: 80px;
        height: 3px;
        background-color: #0d6efd;
    }
    
    .related-card {
        height: 100%;
        transition: transform 0.2s;
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .related-card:hover {
        transform: translateY(-3px);
    }
    
    .related-link {
        color: #333;
    }
    
    .related-link:hover {
        color: #0d6efd;
    }
</style>
@endsection