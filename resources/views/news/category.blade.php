@extends('layouts.app')
@section('title', $category->name)
@section('main-content')
    <h2>{{ $category->name }}</h2>
    @foreach ($news as $item)
       <div class="card">
        @if ($item->thumbnail)
            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="card-img-top w-100"  alt="{{ $item->title }}">
        @endif
        <div class="card-body">
            <h1>{{ $item->title }}</h1>
            <p class="text-muted">Lượt xem: {{ $item->views }} | Ngày đăng: {{ $item->created_at->format('d/m/Y H:i') }}</p>
            <p>{{ $item->description }}</p>
            <div>{!! nl2br(e($item->content)) !!}</div>
        </div>
    </div>
    @endforeach
@endsection