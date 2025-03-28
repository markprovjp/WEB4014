@extends('layouts.admin')

@section('title', 'Sửa tin tức')

@section('page-title', 'Sửa tin tức')

@section('page-actions')
    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
@endsection

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $news->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="excerpt" class="form-label">Tóm tắt</label>
                            <textarea name="excerpt" id="excerpt" class="form-control @error('excerpt') is-invalid @enderror" rows="3">{{ old('excerpt', $news->excerpt) }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Loại tin <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">-- Chọn loại tin --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>Bản
                                    nháp</option>
                                <option value="published"
                                    {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Xuất bản</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" id="featured"
                                    value="1" {{ old('featured', $news->featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">
                                    Tin nổi bật
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                    <textarea name="content" id="content" class="summernote form-control @error('content') is-invalid @enderror" required>{{ old('content', $news->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh</label>
                    <input type="file" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($news->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}"
                                class="img-thumbnail" style="max-height: 150px;">
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image"
                                    value="1">
                                <label class="form-check-label" for="remove_image">
                                    Xóa hình ảnh hiện tại
                                </label>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- <div class="mb-3">
                <label for="tags" class="form-label">Thẻ (cách nhau bởi dấu phẩy)</label>
                <input type="text" name="tags" id="tags" class="form-control @error('tags') is-invalid @enderror" 
                    value="{{ old('tags', $news->tags) }}">
                @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> --}}

                <hr>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật tin tức
                    </button>

                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Xem trước</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="previewContent">
                    <!-- Preview content will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            // Initialize Summernote with more options
            $('.summernote').summernote({
                height: 300,
                lang: 'vi-VN',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        // You can implement image upload functionality here
                        // For a simple approach, you can use FileReader to preview
                        for (let i = 0; i < files.length; i++) {
                            let reader = new FileReader();
                            reader.onloadend = function() {
                                let image = $('<img>').attr('src', reader.result)
                                    .addClass('img-fluid');
                                $('.summernote').summernote('insertNode', image[0]);
                            }
                            reader.readAsDataURL(files[i]);
                        }
                    }
                }
            });

            // Preview functionality
            $('#previewBtn').on('click', function(e) {
                e.preventDefault();
                let title = $('#title').val();
                let content = $('.summernote').summernote('code');

                $('#previewContent').html(`
                <h1>${title}</h1>
                <hr>
                ${content}
            `);

                $('#previewModal').modal('show');
            });
        });
    </script>
@endsection
