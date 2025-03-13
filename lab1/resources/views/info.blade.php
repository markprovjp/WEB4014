<!DOCTYPE html>
<html>
<head>
    <title>Thông tin sinh viên</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
                body {
            font-family: 'Comic Sans MS', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .student-card {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 400px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .student-card::before {
            content: "";
            position: absolute;
            top: -15px;
            left: -15px;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #ff9a9e 0%, #fad0c4 99%, #fad0c4 100%);
            border-radius: 50%;
            z-index: 0;
        }
        
        .student-card::after {
            content: "";
            position: absolute;
            bottom: -15px;
            right: -15px;
            width: 120px;
            height: 120px;
            background: linear-gradient(45deg, #a1c4fd 0%, #c2e9fb 100%);
            border-radius: 50%;
            z-index: 0;
        }
        
        h1 {
            font-size: 28px;
            color: #4a4a4a;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            z-index: 1;
        }
        
        h2 {
            font-size: 22px;
            color: #5a5a5a;
            margin: 12px 0;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }
        
        h2:nth-of-type(odd) {
            transform: rotate(-1deg);
        }
        
        h2:nth-of-type(even) {
            transform: rotate(1deg);
        }
        
        .student-name {
            font-size: 28px;
            font-weight: bold;
            color: #ff6b6b;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
            margin-bottom: 20px;
            background: linear-gradient(90deg, #ff758c 0%, #ff7eb3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            z-index: 1;
        }
        
        .student-id {
            font-size: 24px;
            font-weight: 600;
            position: relative;
            z-index: 1;
        }
        
        .student-id span {
            background: linear-gradient(90deg, #ff0844 0%, #ffb199 100%);
            padding: 5px 15px;
            border-radius: 20px;
            color: white;
            display: inline-block;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            box-shadow: 0 4px 15px rgba(255, 8, 68, 0.2);
            letter-spacing: 2px;
        }
        
        .rainbow-border {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(124deg, #ff2400, #e81d1d, #e8b71d, #e3e81d, #1de840, #1ddde8, #2b1de8, #dd00f3, #dd00f3);
            background-size: 1800% 1800%;
            border-radius: 20px;
            z-index: -1;
            animation: rainbow 18s ease infinite;
            opacity: 0.6;
        }
        
        .decoration {
            position: absolute;
            z-index: 1;
        }
        
        .deco-1 {
            top: 20px;
            left: 20px;
            font-size: 24px;
            color: #FFD700;
            transform: rotate(-15deg);
        }
        
        .deco-2 {
            bottom: 20px;
            right: 20px;
            font-size: 24px;
            color: #FF69B4;
            transform: rotate(15deg);
        }
        
        .deco-3 {
            top: 20px;
            right: 20px;
            font-size: 24px;
            color: #00BFFF;
            transform: rotate(15deg);
        }
        
        .deco-4 {
            bottom: 20px;
            left: 20px;
            font-size: 24px;
            color: #32CD32;
            transform: rotate(-15deg);
        }
        
        @keyframes rainbow {
            0% { background-position: 0% 82% }
            50% { background-position: 100% 19% }
            100% { background-position: 0% 82% }
        }
    </style>
</head>
<body>
    <div class="student-card">
        <div class="rainbow-border"></div>
        <span class="decoration deco-1"><i class="fas fa-star"></i></span>
        <span class="decoration deco-2"><i class="fas fa-heart"></i></span>
        <span class="decoration deco-3"><i class="fas fa-graduation-cap"></i></span>
        <span class="decoration deco-4"><i class="fas fa-book"></i></span>

        <h1>Thông tin sinh viên</h1>
        <h2 class="student-name">Nguyễn Văn Quyền</h2>
        <h2 class="student-id">MSV: <span>pa00278</span></h2>
        <h2>Ngày sinh: 24/4/2004</h2>
        <h2>Quê quán: Thanh Hoá</h2>
    </div>
</body>
</html>