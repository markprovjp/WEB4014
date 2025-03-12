<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ Laravel</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .welcome-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 40px 50px;
            text-align: center;
            max-width: 600px;
            width: 90%;
            position: relative;
            overflow: hidden;
        }
        
        .welcome-container::before {
            content: "";
            position: absolute;
            height: 6px;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(90deg, #ff6b6b, #7873f5);
        }
        
        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }
        
        p {
            color: #666;
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        
        .laravel-logo {
            width: 70px;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }
        
        .accent-text {
            color: #ff6b6b;
            font-weight: 600;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" class="laravel-logo">
        <h1>Hello, <span class="accent-text">Laravel!</span></h1>
        <p>Đây là trang index.blade.php</p>
        <p>Chào mừng Thầy đến với ứng dụng Laravel đầu tiên của Em ạ.</p>
    </div>
</body>
</html>