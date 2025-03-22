<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Mới Nhất</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }
        .news-container {
            max-width: 900px;
            margin: 30px auto;
        }
        .header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .news-item {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .news-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .news-title {
            font-weight: bold;
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .news-date {
            color: #7f8c8d;
            font-size: 14px;
        }
        .news-date i {
            margin-right: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #7f8c8d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container news-container">
        <div class="header">
            <h1 class="text-center mb-0"><i class="fas fa-newspaper me-2"></i>Tin Mới Nhất</h1>
        </div>
        
        <div class="news-list">
            @forelse ($data as $tin)
                <div class="news-item">
                    <div class="news-title">{{ $tin->tieuDe }}</div>
                    <div class="news-date">
                        <i class="far fa-calendar-alt"></i> Ngày đăng: {{ \Carbon\Carbon::parse($tin->ngayDang)->format('d/m/Y H:i') }}
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i> Chưa có tin tức mới
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