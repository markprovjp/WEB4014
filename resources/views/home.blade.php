@extends('layouts.app')

@section('title', 'Trang chủ')

@section('main-content')
    <h2 class="mb-3">Tin nổi bật</h2>
    <div class="row">
        @foreach ($featuredNews as $news)
            <div class="col-md-6 mb-3">
                <div class="card">
                    @if ($news->thumbnail)
                        <img src="{{ asset('storage/' . $news->thumbnail) }}" class="card-img-top" alt="{{ $news->title }}">
                    @endif
                    <div class="card-body">
                        <h5><a href="{{ route('news.detail', $news->id) }}">{{ $news->title }}</a></h5>
                        <p class="text-muted">Lượt xem: {{ $news->views }} | Ngày: {{ $news->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h2 class="mb-3 mt-4">Tin mới nhất</h2>
    <div class="row">
        @foreach ($latestNews as $news)
            <div class="col-md-6 mb-3">
                <div class="card">
                    @if ($news->thumbnail)
                        <img src="{{ asset('storage/' . $news->thumbnail) }}" class="card-img-top" alt="{{ $news->title }}">
                    @endif
                    <div class="card-body">
                        <h5><a href="{{ route('news.detail', $news->id) }}">{{ $news->title }}</a></h5>
                        <p class="text-muted">Lượt xem: {{ $news->views }} | Ngày: {{ $news->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection