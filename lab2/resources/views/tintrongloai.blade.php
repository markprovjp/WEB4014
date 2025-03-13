<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Trong Loại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }
        .content-container {
            max-width: 900px;
            margin: 30px auto;
        }
        .category-header {
            background: linear-gradient(135deg, #e67e22, #d35400);
            color: white;
            padding: 25px;
            border-radius: 8px 8px 0 0;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            position: relative;
        }
        .category-header h1 {
            margin: 0;
            font-weight: 600;
        }
        .category-icon {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: 2rem;
            opacity: 0.7;
        }
        .news-card {
            background-color: white;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 5px solid #e67e22;
        }
        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-left: 5px solid #d35400;
        }
        .news-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .news-title a {
            color: #2c3e50;
            text-decoration: none;
            transition: color 0.2s;
        }
        .news-title a:hover {
            color: #e67e22;
            text-decoration: none;
        }
        .news-summary {
            color: #555;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .read-more {
            display: inline-block;
            color: #e67e22;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
        }
        .read-more:hover {
            color: #d35400;
        }
        .read-more i {
            margin-left: 5px;
            font-size: 0.8rem;
        }
        .no-news {
            text-align: center;
            padding: 50px 0;
            color: #7f8c8d;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px 0;
            color: #7f8c8d;
            font-size: 14px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container content-container">
        <div class="category-header">
            <h1>
                <i class="fas fa-folder-open me-2"></i>
                {{ DB::table('loaiTin')->where('id', request()->route('id'))->value('tenLoai') }}
            </h1>
            <div class="category-icon">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
        
        <div class="news-list">
            @forelse ($data as $tin)
                <div class="news-card">
                    <h2 class="news-title">
                        <a href="/tin/{{ $tin->id }}">{{ $tin->tieuDe }}</a>
                    </h2>
                    <p class="news-summary">{{ $tin->tomTat }}</p>
                    <a href="/tin/{{ $tin->id }}" class="read-more">Đọc thêm <i class="fas fa-arrow-right"></i></a>
                </div>
            @empty
                <div class="no-news">
                    <i class="fas fa-exclamation-circle fa-3x mb-3"></i>
                    <h3>Chưa có tin tức nào trong loại này</h3>
                </div>
            @endforelse
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} - Hệ thống tin tức</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>