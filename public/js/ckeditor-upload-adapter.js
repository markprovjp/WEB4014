/**
 * Custom Upload Adapter for CKEditor 5
 * This adapter handles file uploads through AJAX request to the Laravel backend
 */
class MyUploadAdapter {
    constructor(loader) {
        // The file loader instance to use during the upload.
        this.loader = loader;
    }

    // Starts the upload process.
    upload() {
        return this.loader.file.then(
            (file) =>
                new Promise((resolve, reject) => {
                    this._uploadFile(file)
                        .then((response) => {
                            resolve({
                                default: response.url,
                            });
                        })
                        .catch((error) => {
                            reject(error);
                        });
                })
        );
    }

    // Aborts the upload process.
    abort() {
        if (this.xhr) {
            this.xhr.abort();
        }
    }

    // Handles the actual upload process
    _uploadFile(file) {
        const data = new FormData();

        // Important: CKEditor 5 expects the file field to be named 'upload'
        data.append("upload", file);

        // Safely get CSRF token - prevent null reference error
        try {
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (csrfMeta && csrfMeta.getAttribute) {
                data.append("_token", csrfMeta.getAttribute("content"));
            } else {
                // If meta tag is not found, try to get from the page's hidden inputs
                const csrfInput = document.querySelector(
                    'input[name="_token"]'
                );
                if (csrfInput && csrfInput.value) {
                    data.append("_token", csrfInput.value);
                }
                console.log(
                    "CSRF token not found in meta tag, but route should be CSRF exempt"
                );
            }
        } catch (e) {
            console.error("Error getting CSRF token:", e);
        }

        this.xhr = new XMLHttpRequest();

        // Set up the request
        this.xhr.open("POST", "/admin/upload-image", true);

        // Don't set any custom Content-Type - browser will set the correct
        // multipart/form-data with boundary correctly for file uploads

        // Set response type
        this.xhr.responseType = "json";

        // Set up progress event handlers
        const loader = this.loader;
        this.xhr.upload.onprogress = (evt) => {
            loader.uploadTotal = evt.total;
            loader.uploaded = evt.loaded;
        };

        // Set up event handlers for completion or errors
        return new Promise((resolve, reject) => {
            const xhr = this.xhr;

            xhr.onload = () => {
                console.log("Upload response received:", xhr.response);

                // Check if we have a successful response (status 200-299)
                if (xhr.status >= 200 && xhr.status < 300) {
                    const response = xhr.response;

                    if (!response || response.error) {
                        return reject(
                            response && response.error && response.error.message
                                ? response.error.message
                                : "Upload failed"
                        );
                    }

                    if (response.uploaded && response.url) {
                        resolve(response);
                    } else if (response.url) {
                        // Handle case where response has URL but not in CKEditor format
                        resolve({
                            url: response.url,
                            uploaded: 1,
                        });
                    } else {
                        reject("Invalid server response format");
                    }
                } else {
                    // We had a non-200 response
                    let errorMessage = "HTTP error: " + xhr.status;
                    try {
                        const response = xhr.response;
                        if (
                            response &&
                            response.error &&
                            response.error.message
                        ) {
                            errorMessage = response.error.message;
                        }
                    } catch (e) {
                        console.error("Error parsing error response:", e);
                    }
                    reject(errorMessage);
                }
            };

            xhr.onerror = () => {
                console.error("Network error occurred during upload");
                reject("Lỗi kết nối khi tải lên hình ảnh");
            };

            xhr.onabort = () => {
                console.log("Upload aborted");
                reject("Đã hủy tải lên");
            };

            // Send the request
            try {
                xhr.send(data);
                console.log("Upload request sent");
            } catch (e) {
                console.error("Error sending upload request:", e);
                reject("Lỗi gửi yêu cầu tải lên: " + e.message);
            }
        });
    }
}

// Plugin function that registers the upload adapter factory
function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
        // Create a new upload adapter instance
        return new MyUploadAdapter(loader);
    };
}
