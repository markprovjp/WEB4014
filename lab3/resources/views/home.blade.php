@extends('layout')
@section('tieudetrang')
    Trang chủ tin tức
@endsection
@section('noidung')
    <!-- Featured Articles -->
    <section class="featured-articles mb-5">
        <h2 class="section-title mb-4">Tin nổi bật</h2>
        
        <div class="row">
            @php
                $featuredArticles = DB::table('tin')
                    ->where('AnHien', 1)
                    ->where('TinNoiBat', 1)
                    ->orderBy('Ngay', 'desc')
                    ->limit(3)
                    ->get();
            @endphp
            
            @foreach($featuredArticles as $featured)
                <div class="col-md-4 mb-4">
                    <div class="card featured-card h-100">
                        <img src="{{ $featured->urlHinh ?? 'https://via.placeholder.com/600x400' }}" class="card-img-top" alt="{{ $featured->TieuDe }}">
                        <div class="card-body">
                            <div class="card-category small mb-2">
                                <a href="/loai/{{ $featured->idLT }}" class="text-primary text-decoration-none">
                                    {{ DB::table('loaiTin')->where('id', $featured->idLT)->value('tenLoai') }}
                                </a>
                            </div>
                            <h3 class="card-title">
                                <a href="/tin/{{ $featured->id }}" class="text-decoration-none text-dark featured-link">
                                    {{ $featured->TieuDe }}
                                </a>
                            </h3>
                            <p class="card-text">{{ Str::limit($featured->TomTat, 100) }}</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ date('d/m/Y', strtotime($featured->Ngay)) }}
                                </span>
                                <a href="/tin/{{ $featured->id }}" class="btn btn-sm btn-outline-primary">Đọc tiếp</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    
    <!-- Latest News by Category -->
    <section class="latest-by-category">
        @php
            $categories = DB::table('loaiTin')
                ->where('AnHien', 1)
                ->orderBy('ThuTu', 'asc')
                ->limit(3)
                ->get();
        @endphp
        
        @foreach($categories as $category)
            <div class="category-section mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="section-title mb-0">{{ $category->tenLoai }}</h2>
                    <a href="/loai/{{ $category->id }}" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                </div>
                
                <div class="row">
                    @php
                        $categoryNews = DB::table('tin')
                            ->where('idLT', $category->id)
                            ->where('AnHien', 1)
                            ->orderBy('Ngay', 'desc')
                            ->limit(4)
                            ->get();
                    @endphp
                    
                    @foreach($categoryNews as $news)
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card news-card h-100">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="/tin/{{ $news->id }}" class="text-decoration-none text-dark news-link">
                                            {{ $news->TieuDe }}
                                        </a>
                                    </h4>
                                    <p class="card-text small">{{ Str::limit($news->TomTat, 80) }}</p>
                                </div>
                                <div class="card-footer bg-white border-0 pt-0">
                                    <small class="text-muted">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ date('d/m/Y', strtotime($news->Ngay)) }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
@endsection

@section('custom_css')
<style>
    .section-title {
        position: relative;
        padding-bottom: 0.5rem;
        font-weight: 700;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 3px;
        background-color: #0d6efd;
    }
    
    .featured-card {
        border: none;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    
    .featured-card:hover {
        transform: translateY(-5px);
    }
    
    .featured-link:hover {
        color: #0d6efd !important;
    }
    
    .featured-card .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    
    .news-card {
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: all 0.2s;
    }
    
    .news-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .news-link:hover {
        color: #0d6efd !important;
    }
    
    @media (max-width: 767.98px) {
        .featured-card .card-img-top {
            height: 160px;
        }
    }
</style>
@endsection