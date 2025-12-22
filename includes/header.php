<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <div class="logo">
            <h2 onclick="location.href='index.php'">🖥️ Tech Store</h2>
        </div>
        <div class="mobile-menu-btn">☰</div>
        <nav id="main-nav">
            <ul>
                <li><a href="index.php">الرئيسية</a></li>
                <li><a href="products.php">المنتجات</a></li>
                <li id="user-nav-item"><a href="login.php" id="login-link">تسجيل الدخول</a></li>
            </ul>
        </nav>
        <div class="nav-icons">
            <div class="cart-icon" onclick="location.href='cart.php'">
                🛒 <span class="cart-count">0</span>
            </div>
            <div id="logout-btn" style="display:none; cursor:pointer;" title="تسجيل الخروج">🚪</div>
        </div>
    </header>