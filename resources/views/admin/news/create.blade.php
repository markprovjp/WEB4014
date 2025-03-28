@extends('layouts.admin')

@section('title', 'Thêm tin tức')

@section('page-title', 'Thêm tin tức mới')

@section('page-actions')
<a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Quay lại
</a>
@endsection

@section('admin-content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                        <div class="form-text">Để trống để tự động tạo slug từ tiêu đề</div>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="summary" class="form-label">Tóm tắt</label>
                        <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="3">{{ old('summary') }}</textarea>
                        @error('summary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Loại tin <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">-- Chọn loại tin --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Xuất bản</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="hot" name="hot" value="1" {{ old('hot') ? 'checked' : '' }}>
                        <label class="form-check-label" for="hot">Tin nổi bật (HOT)</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                <textarea class="form-control summernote @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Hình ảnh đại diện (tối đa 2MB)</label>
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                <div class="form-text">Định dạng: JPG, PNG, GIF. Kích thước tối đa: 2MB.</div>
                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="mt-2">
                    <img id="thumbnail-preview" src="" class="img-thumbnail d-none" alt="Thumbnail preview" style="max-height: 200px;">
                </div>
            </div>
            
            <hr>
            
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu tin tức
                </button>
                
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Hủy
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        // Initialize summernote
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
                    // You can implement server-side image upload here
                    // For now, we'll just use FileReader for preview
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

        // Auto-slug generation from title
        $('#title').on('input', function() {
            if ($('#slug').val() === '') {
                var slug = $(this).val()
                    .toLowerCase()
                    .replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a")
                    .replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e")
                    .replace(/ì|í|ị|ỉ|ĩ/g, "i")
                    .replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o")
                    .replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u")
                    .replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y")
                    .replace(/đ/g, "d")
                    .replace(/[^\w\s-]/g, '')    // Remove special chars
                    .replace(/\s+/g, '-')        // Replace spaces with -
                    .replace(/--+/g, '-')        // Replace multiple - with single -
                    .trim();                     // Trim - from start and end of text
                
                $('#slug').val(slug);
            }
        });
        
        // Thumbnail preview
        $('#thumbnail').change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#thumbnail-preview').attr('src', event.target.result);
                    $('#thumbnail-preview').removeClass('d-none');
                }
                reader.readAsDataURL(file);
            } else {
                $('#thumbnail-preview').addClass('d-none');
            }
        });
    });
</script>
@endsection