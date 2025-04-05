<div>
    <p>chào bạn 
        <?= Auth::user()->name ?>
    </p>
    <h4>đây là 
        trang download chỉ dành cho người đã đăng nhập
    </h4>
    {{-- thoát --}}
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Đăng xuất</button>
    </form>
</div>
