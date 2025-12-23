<?php
/**
 * Database Configuration
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ============================================
// Database Constants - ثوابت قاعدة البيانات
// ============================================

define('DB_HOST', 'localhost');
define('DB_NAME', 'tech_store');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// ============================================
// Database Connection - الاتصال بقاعدة البيانات
// ============================================

try {
    // إنشاء اتصال PDO مع الإعدادات الأمنية
    $pdo = new PDO(
        sprintf(
            "mysql:host=%s;dbname=%s;charset=%s",
            DB_HOST,
            DB_NAME,
            DB_CHARSET
        ),
        DB_USER,
        DB_PASS,
        [
            // تفعيل وضع الأخطاء للحصول على تفاصيل الأخطاء
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

            // إرجاع النتائج كـ associative array
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

            // تعطيل emulated prepares لأمان أفضل
            PDO::ATTR_EMULATE_PREPARES => false,

            // تعطيل التحويل التلقائي للأرقام
            PDO::ATTR_STRINGIFY_FETCHES => false
        ]
    );

} catch (PDOException $e) {
    // تسجيل الخطأ في ملف السجل (في بيئة الإنتاج)
    error_log("Database Connection Error: " . $e->getMessage());

    // إرجاع رسالة خطأ عامة للمستخدم (لا تكشف تفاصيل قاعدة البيانات)
    http_response_code(500);
    die(json_encode([
        'success' => false,
        'message' => 'عذراً، حدث خطأ في الاتصال بقاعدة البيانات. يرجى المحاولة لاحقاً.'
    ], JSON_UNESCAPED_UNICODE));
}
