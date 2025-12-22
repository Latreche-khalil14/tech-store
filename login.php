<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول -khalil-Tech-Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        h1 {
            text-align: center;
            color: #667eea;
            margin-bottom: 30px;
        }
        
        .tabs {
            display: flex;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
        }
        
        .tab {
            flex: 1;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            color: #666;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            transition: all 0.3s;
        }
        
        .tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }
        
        .form-section {
            display: none;
        }
        
        .form-section.active {
            display: block;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }
        
        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            font-family: 'Tajawal', sans-serif;
            transition: border 0.3s;
        }
        
        input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
            transition: transform 0.2s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🖥️ khalil-Tech-Store</h1>
        
        <div class="tabs">
            <div class="tab active" data-tab="login">تسجيل الدخول</div>
            <div class="tab" data-tab="register">إنشاء حساب</div>
        </div>
        
        <div id="message" class="message"></div>
        
        <div id="login-form" class="form-section active">
            <form id="loginForm">
                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" id="login-email" required>
                </div>
                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" id="login-password" required>
                </div>
                <button type="submit" class="btn">تسجيل الدخول</button>
            </form>
        </div>
        
        <div id="register-form" class="form-section">
            <form id="registerForm">
                <div class="form-group">
                    <label>اسم المستخدم</label>
                    <input type="text" id="reg-username" required>
                </div>
                <div class="form-group">
                    <label>الاسم الكامل</label>
                    <input type="text" id="reg-fullname" required>
                </div>
                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" id="reg-email" required>
                </div>
                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" id="reg-password" required>
                </div>
                <button type="submit" class="btn">إنشاء حساب</button>
            </form>
        </div>
    </div>
    
    <script src="assets/js/auth.js"></script>
</body>
</html>
