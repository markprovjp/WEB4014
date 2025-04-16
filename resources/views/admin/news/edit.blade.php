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
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug"
                                class="form-control @error('slug') is-invalid @enderror"
                                value="{{ old('slug', $news->slug) }}">
                            <small class="form-text text-muted">Để trống để tự động tạo slug từ tiêu đề</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="summary" class="form-label">Tóm tắt</label>
                            <textarea name="summary" id="summary" class="form-control @error('summary') is-invalid @enderror" rows="3">{{ old('summary', $news->summary) }}</textarea>
                            @error('summary')
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
                            <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror"
                                required>
                                <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>
                                    Bản nháp
                                </option>
                                <option value="published"
                                    {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>
                                    Xuất bản
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hot" id="hot" value="1"
                                    {{ old('hot', $news->hot) ? 'checked' : '' }}>
                                <label class="form-check-label" for="hot">
                                    Tin nổi bật (HOT)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $news->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Hình ảnh (tối đa 2MB)</label>
                    <input type="file" name="thumbnail" id="thumbnail"
                        class="form-control @error('thumbnail') is-invalid @enderror" accept=".jpg,.jpeg,.png,.gif">
                    <small class="form-text text-muted">Chấp nhận các định dạng: jpg, jpeg, png, gif</small>
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($news->thumbnail)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}"
                                class="img-thumbnail" style="max-height: 150px;">
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" name="remove_thumbnail"
                                    id="remove_thumbnail" value="1">
                                <label class="form-check-label" for="remove_thumbnail">
                                    Xóa hình ảnh hiện tại
                                </label>
                            </div>
                        </div>
                    @endif
                </div>

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
@endsection

@section('styles')
    @parent
    <style>
        .ck-editor__editable {
            min-height: 300px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
        }

        .ck-content .image {
            max-width: 100%;
            margin: 20px auto;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <!-- Load CKEditor only once to prevent duplication -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script src="{{ asset('js/ckeditor-upload-adapter.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize CKEditor only if not already initialized
            if (window.editor === undefined) {
                ClassicEditor
                    .create(document.querySelector('#content'), {
                        toolbar: {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                                'outdent', 'indent', '|',
                                'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'
                            ]
                        },
                        language: 'en',
                        image: {
                            toolbar: [
                                'imageTextAlternative',
                                'toggleImageCaption',
                                'imageStyle:inline',
                                'imageStyle:block',
                                'imageStyle:side'
                            ]
                        },
                        // Add the upload adapter plugin to the editor
                        extraPlugins: [MyCustomUploadAdapterPlugin]
                    })
                    .then(editor => {
                        console.log('CKEditor initialized successfully');
                        window.editor = editor;
                    })
                    .catch(error => {
                        console.error('CKEditor initialization failed:', error);
                    });
            }

            // Auto-slug generation
            $('#title').on('blur', function() {
                if ($('#slug').val() === '') {
                    let slug = $(this).val()
                        .toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/--+/g, '-')
                        .trim();
                    $('#slug').val(slug);
                }
            });

            // Thumbnail preview
            $('#thumbnail').on('change', function(e) {
                // Remove existing preview if any
                $('.thumbnail-preview').remove();

                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = $('<img>').attr({
                            src: e.target.result,
                            class: 'img-thumbnail mt-2 thumbnail-preview',
                            style: 'max-height: 150px;'
                        });
                        $('#thumbnail').after(preview);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
