@extends('layouts.app')
@section('title', 'Tìm kiếm: ' . $keyword)
@section('main-content')
    <h2>Kết quả tìm kiếm cho: "{{ $keyword }}"</h2>
    @if ($news->isEmpty())
        <p class="text-muted">Không tìm thấy tin tức nào phù hợp.</p>
    @else
        <div class="row">
            @foreach ($news as $item)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        @if ($item->image)
                            <img src="{{ asset('' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}">
                        @endif
                        <div class="card-body">
                            <h5><a href="{{ route('news.detail', $item->id) }}">{{ $item->title }}</a></h5>
                            <p class="text-muted">Lượt xem: {{ $item->views }} | Ngày: {{ $item->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection