<div>
    <h1>Thêm tin </h1>
    <form action="{{ route('tin.luu') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="tieuDe" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="tieuDe" name="tieuDe" required>
        </div>
        <div class="mb-3">
            <label for="tomtat" class="form-label">Tóm tắt</label>
            <textarea class="form-control" id="tomtat" name="tomtat" rows="2" required></textarea>
        </div>
        <div class="mb-3">
            <label for="noiDung" class="form-label">Nội dung</label>
            <textarea class="form-control" id="noiDung" name="noiDung" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="urlHinh" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="urlHinh" name="urlHinh">
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags" required>
        </div>
        <div class="mb-3">
            <label for="lang" class="form-label">Ngôn ngữ</label>
            <input type="text" class="form-control" id="lang" name="lang" value="vn" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="tinNoiBat" name="tinNoiBat" value="1" required>
            <label class="form-check-label" for="tinNoiBat">Tin nổi bật</label>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="anHien" name="anHien" value="1" checked>
            <label class="form-check-label" for="anHien">Hiển thị</label>
        </div>
        <button type="submit" class="btn btn-primary">Thêm tin</button>
    </form>
    <a href="{{ route('tin.danhsach') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
</div>