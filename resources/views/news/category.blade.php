@extends('layouts.app')
@section('title', $category->name)
@section('main-content')
    <h2>{{ $category->name }}</h2>
    @foreach ($news as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5><a href="{{ route('news.detail', $item->id) }}">{{ $item->title }}</a></h5>
                <p>Lượt xem: {{ $item->views }} | Ngày đăng: {{ $item->created_at }}</p>
            </div>
        </div>
    @endforeach
@endsection