<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div>
   <h1>Danh sách tin </h1>
    <a href="{{ route('tin.them') }}" class="btn btn-primary">Thêm tin</a>
    @If(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @elseIf(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
   @foreach ($listTin as $item) 
    <div class="card mb-3">
        <div class="card-header">
            <h2>{{ $item->tieuDe }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Tóm tắt:</strong> {{ $item->tomTat }}</p>
            <p><strong>Nội dung:</strong> {{ $item->noiDung }}</p>
            <p><strong>Ngày đăng:</strong> {{ $item->ngayDang }}</p>
                                                         <p><strong>Hình ảnh:</strong> 
                                            @if($item->urlHinh)
                                                <!-- Direct URL approach -->
                                                <img src="/storage/private/{{ $item->urlHinh }}" alt="Hình ảnh" style="width: 100px; height: auto;">
                                            @else
                                                Không có hình ảnh
                                            @endif
                                        </p>
            <p><strong>Số lượt xem:</strong> {{ $item->xem }}</p>
            <p><strong>Tin nổi bật:</strong> {{ $item->tinNoiBat ? 'Có' : 'Không' }}</p>
            <p><strong>Trạng thái:</strong> {{ $item->anHien ? 'Hiển thị' : 'Ẩn' }}</p>
            <p><strong>Tags:</strong> {{ $item->tags }}</p>
            <p><strong>Ngôn ngữ:</strong> {{ $item->lang }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('tin.sua', ['id' => $item->id]) }}" class="btn btn-warning">Sửa</a>
            <form action="{{ route('tin.xoa', ['id' => $item->id]) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
        </div>
    </div>
    @endforeach
</div>