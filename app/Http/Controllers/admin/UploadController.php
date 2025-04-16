<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    /**
     * Handle image uploads from various editors (TinyMCE, CKEditor, etc.)
     */
    public function uploadImage(Request $request)
    {
        // Log full request information for debugging
        Log::info('Upload attempt - FULL REQUEST', [
            'method' => $request->method(),
            'has_file_upload' => $request->hasFile('upload'),
            'files' => $request->allFiles(),
            'is_ajax' => $request->ajax(),
            'content_type' => $request->header('Content-Type'),
            'headers' => $request->headers->all(),
            'all_inputs' => $request->all()
        ]);

        // Check if it's a CKEditor upload
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            Log::info('CKEditor upload detected', [
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension()
            ]);

            // Validate the file - Added jfif to the allowed extensions
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif'];
            if (!in_array(strtolower($file->getClientOriginalExtension()), $allowed_extensions)) {
                Log::warning('Invalid file type detected', [
                    'extension' => $file->getClientOriginalExtension(),
                    'allowed' => $allowed_extensions
                ]);
                return response()->json([
                    'uploaded' => 0,
                    'error' => [
                        'message' => 'Định dạng file không hợp lệ. Chấp nhận: ' . implode(', ', $allowed_extensions)
                    ]
                ], 400);
            }

            // Check file size
            if ($file->getSize() > 5120000) { // 5MB
                Log::warning('File too large', ['size' => $file->getSize()]);
                return response()->json([
                    'uploaded' => 0,
                    'error' => [
                        'message' => 'Kích thước file không được vượt quá 5MB'
                    ]
                ], 400);
            }

            try {
                // Generate a unique name for the file
                $fileName = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $file->getClientOriginalName());

                // Lưu trữ tệp trong kho công khai
                $filePath = $file->storeAs('news/content', $fileName, 'public');
                $url = Storage::url($filePath);

                Log::info('File uploaded successfully', [
                    'path' => $filePath,
                    'url' => $url
                ]);

                // Return the CKEditor 5 compliant response format
                return response()->json([
                    'uploaded' => 1,
                    'fileName' => $fileName,
                    'url' => $url
                ]);
            } catch (\Exception $e) {
                Log::error('Upload failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return response()->json([
                    'uploaded' => 0,
                    'error' => [
                        'message' => 'Lỗi tải lên: ' . $e->getMessage()
                    ]
                ], 500);
            }
        }

        // Handle TinyMCE or standard AJAX uploads
        if ($request->ajax()) {
            // TinyMCE sends file with name 'file' or inside 'images[]'
            $file = $request->file('file');

            if (!$file && $request->hasFile('images')) {
                $file = $request->file('images')[0];
            }

            if (!$file && $request->hasFile('image')) {
                $file = $request->file('image');
            }

            if (!$file) {
                Log::warning('No file found in request');
                return response()->json(['error' => 'Không tìm thấy file hình ảnh trong yêu cầu'], 400);
            }

            Log::info('AJAX upload detected', [
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension()
            ]);

            // Check if it's an image file - Added jfif to the allowed extensions
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif'];
            if (!in_array(strtolower($file->getClientOriginalExtension()), $allowed_extensions)) {
                Log::warning('Invalid file type detected', [
                    'extension' => $file->getClientOriginalExtension(),
                    'allowed' => $allowed_extensions
                ]);
                return response()->json(['error' => 'Định dạng file không hợp lệ. Chấp nhận: ' . implode(', ', $allowed_extensions)], 400);
            }

            // Check file size
            if ($file->getSize() > 5120000) { // 5MB
                Log::warning('File too large', ['size' => $file->getSize()]);
                return response()->json(['error' => 'Kích thước file không được vượt quá 5MB'], 400);
            }

            try {
                // Create a random filename to avoid duplicates, keep the original extension
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

                // Save the file to the editor-images directory
                $path = $file->storeAs('editor-images', $fileName, 'public');
                $url = asset('storage/' . $path);

                Log::info('File uploaded successfully', [
                    'path' => $path,
                    'url' => $url
                ]);

                // Return image path - TinyMCE uses 'location' key
                return response()->json([
                    'location' => $url,
                    'url' => $url
                ]);
            } catch (\Exception $e) {
                Log::error('Upload failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return response()->json(['error' => 'Lỗi tải lên: ' . $e->getMessage()], 500);
            }
        }

        // Try to find any file in the request
        foreach ($request->allFiles() as $fieldName => $file) {
            Log::info("Found file with field name: {$fieldName}");

            try {
                // Create a random filename to avoid duplicates
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

                // Save the file to a catch-all directory
                $path = $file->storeAs('debug-uploads', $fileName, 'public');
                $url = asset('storage/' . $path);

                return response()->json([
                    'uploaded' => 1,
                    'fileName' => $fileName,
                    'url' => $url,
                    'fieldName' => $fieldName
                ]);
            } catch (\Exception $e) {
                Log::error("Failed to handle file with field name: {$fieldName}", [
                    'error' => $e->getMessage()
                ]);
            }
        }

        Log::warning('Invalid request detected - No suitable file found');
        return response()->json([
            'uploaded' => 0,
            'error' => [
                'message' => 'Không tìm thấy file hình ảnh trong yêu cầu'
            ]
        ], 400);
    }
}
