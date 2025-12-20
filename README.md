# Tech Store

متجر إلكتروني للمنتجات الرقمية

## التقنيات
- **Frontend**: HTML, CSS, JavaScript, jQuery
- **Backend**: PHP
- **Database**: MySQL

## الحالة الحالية
- ✅ اليوم 1: نظام تسجيل الدخول
- ✅ اليوم 2: قاعدة بيانات المنتجات + API
- ⏳ اليوم 3: الصفحة الرئيسية (قيد العمل)

## التثبيت

### 1. إنشاء قاعدة البيانات
```bash
# في phpMyAdmin، نفّذ الملفات بالترتيب:
1. database/init.sql
2. database/products.sql
```

### 2. التشغيل
```
افتح: http://localhost/tech-store/
```

## API Endpoints

### Authentication
- `POST /api/auth/login.php` 
- `POST /api/auth/register.php` 

### Products
- `GET /api/products/get_all.php` - جلب جميع المنتجات
- `GET /api/products/get_by_id.php?id={id}` - جلب منتج واحد

## هيكل المشروع
```
tech-store/
├── api/          # API endpoints
├── assets/       # CSS, JS, Images
├── config/       # Database & helpers
├── database/     # SQL files
└── login.html    # صفحة تسجيل الدخول
```
