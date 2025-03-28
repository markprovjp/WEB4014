<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Khôi phục mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #0d6efd;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
        }
        .token {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            margin: 20px 0;
            background-color: #f8f9fa;
            border: 1px dashed #ddd;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>WEB4014 - Tin Tức</h2>
        </div>
        <div class="content">
            <h3>Xin chào {{ $user->name }},</h3>
            <p>Chúng tôi nhận được yêu cầu khôi phục mật khẩu cho tài khoản của bạn.</p>
            <p>Vui lòng sử dụng mã xác nhận sau đây để tiếp tục quá trình đặt lại mật khẩu:</p>
            
            <div class="token">
                {{ $token }}
            </div>
            
            <p>Mã xác nhận có hiệu lực trong vòng 60 phút.</p>
            
            <p>Để tiếp tục, hãy nhập mã xác nhận cùng với địa chỉ email của bạn vào trang xác minh mã.</p>
            
            <p>Nếu bạn không thực hiện yêu cầu khôi phục mật khẩu, bạn có thể bỏ qua email này.</p>
            
            <p>Trân trọng,<br>WEB4014 - Tin Tức</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 WEB4014. Tất cả các quyền được bảo lưu.</p>
        </div>
    </div>
</body>
</html>