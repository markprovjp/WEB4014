<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tin->tieuDe }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Roboto, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .article-container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .article-header {
            padding: 30px;
            background: linear-gradient(135deg, #2980b9, #3498db);
            color: white;
        }
        .article-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .article-summary {
            font-size: 1.2rem;
            font-style: italic;
            opacity: 0.9;
            border-left: 4px solid rgba(255,255,255,0.5);
            padding-left: 15px;
        }
        .article-metadata {
            display: flex;
            margin-top: 20px;
            font-size: 0.9rem;
            opacity: 0.8;
        }
        .article-metadata div {
            margin-right: 20px;
        }
        .article-metadata i {
            margin-right: 5px;
        }
        .article-content {
            padding: 30px;
        }
        .article-content img {
            max-width: 100%;
            height: auto;
            margin: 15px 0;
            border-radius: 6px;
        }
        .article-footer {
            border-top: 1px solid #eee;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
        }
        .back-button {
            color: #3498db;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .back-button:hover {
            color: #2980b9;
        }
        .back-button i {
            margin-right: 5px;
        }
        .share-buttons a {
            color: #555;
            margin-left: 15px;
            font-size: 1.2rem;
        }
        .share-buttons a:hover {
            color: #3498db;
        }
        blockquote {
            border-left: 4px solid #3498db;
            padding-left: 15px;
            color: #666;
            font-style: italic;
            margin: 20px 0;
        }
        @media (max-width: 767px) {
            .article-title {
                font-size: 1.5rem;
            }
            .article-summary {
                font-size: 1rem;
            }
            .article-header, .article-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="article-container">
        <div class="article-header">
            <h1 class="article-title">{{ $tin->tieuDe }}</h1>
            <div class="article-summary">{{ $tin->tomTat }}</div>
            <div class="article-metadata">
                <div>
                    <i class="far fa-calendar"></i> 
                    {{ \Carbon\Carbon::parse($tin->ngayDang)->format('d/m/Y H:i') }}
                </div>
                <div>
                    <i class="far fa-user"></i> 
                    {{ DB::table('loaiTin')->where('id', $tin->idLT)->value('tenLoai') }}
                </div>
            </div>
        </div>
        
        <div class="article-content">
            {!! $tin->noiDung !!}
        </div>
        
        <div class="article-footer">
            <a href="javascript:history.back()" class="back-button">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <div class="share-buttons">
                <span>Chia sẻ:</span>
                <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>