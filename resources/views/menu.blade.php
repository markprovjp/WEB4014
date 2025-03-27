<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="/">
        <i class="fas fa-newspaper text-primary me-2"></i>
        Tin Tức Online
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">
              <i class="fas fa-home me-1"></i> Trang chủ
            </a>
          </li>
          @foreach(DB::table('loaitin')->where('AnHien', 1)->orderBy('thuTu', 'asc')->get() as $lt)
          <li class="nav-item">
            <a class="nav-link {{ request()->is('loai/'.$lt->id) ? 'active' : '' }}" href="/loai/{{ $lt->id }}">
              <i class="fas fa-list-alt me-1"></i> {{ $lt->tenLoai }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
</nav>