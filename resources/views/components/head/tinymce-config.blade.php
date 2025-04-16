<script src="https://cdn.tiny.cloud/1/61rholev51a79p2gm76j1qz887ft5t2jy674aa3l464rgkzg/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    function initTinyMCE(selector = '.tinymce-editor') {
        tinymce.init({
            selector: selector,
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            language: 'vi',
            language_url: '{{ asset("js/tinymce/langs/vi.js") }}',
            height: 500,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image table',
            skin: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide',
            content_css: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            
            // Enable file upload
            images_upload_url: '{{ route("admin.upload.image") }}',
            automatic_uploads: true,
            file_picker_types: 'image',
            
            // File picker callback for media dialog
            file_picker_callback: function(callback, value, meta) {
                // Provide file and text for the link dialog
                if (meta.filetype === 'file') {
                    callback('{{ asset("storage/files/example.pdf") }}', { text: 'Tài liệu mẫu' });
                }
                
                // Provide image and alt text for the image dialog
                if (meta.filetype === 'image') {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    
                    input.onchange = function() {
                        const file = this.files[0];
                        
                        const reader = new FileReader();
                        reader.onload = function() {
                            // Create a preview image if needed
                            // const id = 'blobid' + (new Date()).getTime();
                            // const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            // const base64 = reader.result.split(',')[1];
                            // const blobInfo = blobCache.create(id, file, base64);
                            // blobCache.add(blobInfo);
                            
                            // We create FormData to upload the file
                            const formData = new FormData();
                            formData.append('file', file);
                            formData.append('_token', '{{ csrf_token() }}');
                            
                            // Show loading indicator
                            const loadingText = document.createElement('div');
                            loadingText.className = 'tinymce-loading';
                            loadingText.textContent = 'Đang tải ảnh lên... (0%)';
                            document.body.appendChild(loadingText);
                            
                            // AJAX upload file
                            const xhr = new XMLHttpRequest();
                            xhr.open('POST', '{{ route("admin.upload.image") }}');
                            
                            // Track upload progress
                            xhr.upload.onprogress = function(e) {
                                if (e.lengthComputable) {
                                    const percentComplete = Math.round((e.loaded / e.total) * 100);
                                    loadingText.textContent = `Đang tải ảnh lên... (${percentComplete}%)`;
                                }
                            };
                            
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    // File uploaded successfully
                                    const json = JSON.parse(xhr.responseText);
                                    
                                    // Call the callback and populate the Title field with the file name
                                    callback(json.url, { title: file.name });
                                    
                                    // Show success message
                                    loadingText.textContent = 'Tải ảnh thành công!';
                                    loadingText.className = 'tinymce-success';
                                    
                                    // Remove message after 3 seconds
                                    setTimeout(function() {
                                        document.body.removeChild(loadingText);
                                    }, 3000);
                                } else {
                                    // Handle upload error
                                    loadingText.textContent = 'Lỗi khi tải ảnh lên!';
                                    loadingText.className = 'tinymce-error';
                                    
                                    setTimeout(function() {
                                        document.body.removeChild(loadingText);
                                    }, 5000);
                                }
                            };
                            
                            xhr.onerror = function() {
                                loadingText.textContent = 'Lỗi kết nối khi tải ảnh!';
                                loadingText.className = 'tinymce-error';
                                
                                setTimeout(function() {
                                    document.body.removeChild(loadingText);
                                }, 5000);
                            };
                            
                            xhr.send(formData);
                        };
                        
                        reader.readAsDataURL(file);
                    };
                    
                    input.click();
                }
                
                // Provide alternative source and posted for the media dialog
                if (meta.filetype === 'media') {
                    callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                }
            },
            
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save(); // Ensures content is saved to textarea
                });
            }
        });
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        initTinyMCE();
    });
</script>

<style>
    .tinymce-loading,
    .tinymce-success,
    .tinymce-error {
        position: fixed;
        top: 50px;
        right: 20px;
        z-index: 9999;
        padding: 15px 20px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .tinymce-loading {
        background-color: #f8f9fa;
        border-left: 4px solid #007bff;
        color: #495057;
    }
    
    .tinymce-success {
        background-color: #d4edda;
        border-left: 4px solid #28a745;
        color: #155724;
    }
    
    .tinymce-error {
        background-color: #f8d7da;
        border-left: 4px solid #dc3545;
        color: #721c24;
    }
    
    /* Fix TinyMCE in dark mode */
    .tox .tox-toolbar,
    .tox .tox-toolbar__overflow,
    .tox .tox-toolbar__primary {
        background-color: #f8f9fa !important;
    }
</style>