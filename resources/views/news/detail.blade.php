@extends('layouts.app')
@section('title', $news->title)
@section('main-content')
    <div class="card">
        @if ($news->image)
            <img src="{{ asset('' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}">
        @endif
        <div class="card-body">
            <h1>{{ $news->title }}</h1>
            <p class="text-muted">Lượt xem: {{ $news->views }} | Ngày đăng: {{ $news->created_at->format('d/m/Y H:i') }}</p>
            <p>{{ $news->description }}</p>
            <div>{!! nl2br(e($news->content)) !!}</div>
        </div>
    </div>

    <h3 class="mt-4">Bình luận</h3>
    @if ($comments->isEmpty())
        <p>Chưa có bình luận nào.</p>
    @else
        @foreach ($comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <p>{{ $comment->content }}</p>
                    <small>Đăng bởi: {{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @endforeach
    @endif

    @auth
        <form action="{{ route('comment.store') }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="3" placeholder="Viết bình luận..." required></textarea>
            </div>
            <input type="hidden" name="news_id" value="{{ $news->id }}">
            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
        </form>
    @else
        <p class="mt-3">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận.</p>
    @endauth
@endsection