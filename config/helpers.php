<?php
/**
 * Helper Functions
 * مجموعة من الدوال المساعدة لتسهيل العمل في المشروع
 */

// ============================================
// Response Functions - دوال الاستجابة
// ============================================

/**
 * إرسال استجابة JSON مع حماية ضد XSS
 * 
 * @param bool $success حالة النجاح
 * @param string $message رسالة الاستجابة
 * @param mixed $data البيانات الإضافية (اختياري)
 * @param int $statusCode كود حالة HTTP (افتراضي: 200)
 */
function jsonResponse($success, $message, $data = null, $statusCode = 200)
{
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');

    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * تنظيف البيانات بشكل متكرر من XSS
 * 
 * @param mixed $data البيانات المراد تنظيفها
 * @return mixed البيانات المنظفة
 */
function recursiveEscape($data)
{
    if (is_array($data)) {
        return array_map('recursiveEscape', $data);
    }

    if (is_string($data)) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    return $data;
}

// ============================================
// Input Sanitization - تنظيف المدخلات
// ============================================

/**
 * تنظيف المدخلات من HTML و JavaScript
 * 
 * @param string $data البيانات المراد تنظيفها
 * @return string البيانات المنظفة
 */
function sanitize($data)
{
    if (!is_string($data)) {
        return $data;
    }

    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * تنظيف البريد الإلكتروني والتحقق منه
 * 
 * @param string $email البريد الإلكتروني
 * @return string|false البريد المنظف أو false إذا كان غير صالح
 */
function sanitizeEmail($email)
{
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : false;
}

/**
 * تنظيف رقم صحيح
 * 
 * @param mixed $number الرقم المراد تنظيفه
 * @return int الرقم المنظف
 */
function sanitizeInt($number)
{
    return (int) filter_var($number, FILTER_SANITIZE_NUMBER_INT);
}

/**
 * تنظيف رقم عشري
 * 
 * @param mixed $number الرقم المراد تنظيفه
 * @return float الرقم المنظف
 */
function sanitizeFloat($number)
{
    return (float) filter_var($number, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

// ============================================
// Authentication Functions - دوال المصادقة
// ============================================

/**
 * بدء الجلسة إذا لم تكن قد بدأت
 */
function ensureSession()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

/**
 * التحقق من تسجيل دخول المستخدم
 * 
 * @return bool true إذا كان المستخدم مسجل الدخول
 */
function isLoggedIn()
{
    ensureSession();
    return isset($_SESSION['user_id']);
}

/**
 * التحقق من صلاحيات المسؤول
 * 
 * @return bool true إذا كان المستخدم مسؤول
 */
function isAdmin()
{
    ensureSession();
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

/**
 * حماية صفحات المسؤول - إيقاف التنفيذ إذا لم يكن مسؤول (تستخدم للـ API)
 */
function protectAdmin()
{
    ensureSession();
    if (!isAdmin()) {
        jsonResponse(false, 'غير مصرح لك بالدخول', null, 403);
    }
}

/**
 * حماية صفحات المسؤول - توجيه مباشر للمتجر إذا لم يكن مسؤول (تستخدم لصفحات الـ PHP)
 */
function protectAdminSecret()
{
    ensureSession();
    if (!isAdmin()) {
        header('Location: ../index.php');
        exit;
    }
}

/**
 * طلب تسجيل الدخول - إعادة توجيه إذا لم يكن مسجل الدخول
 * 
 * @param string $redirectUrl رابط إعادة التوجيه (افتراضي: login.php)
 */
function requireLogin($redirectUrl = 'login.php')
{
    if (!isLoggedIn()) {
        $currentUrl = urlencode($_SERVER['REQUEST_URI']);
        header("Location: $redirectUrl?redirect=$currentUrl");
        exit;
    }
}

/**
 * الحصول على معرف المستخدم الحالي
 * 
 * @return int|null معرف المستخدم أو null
 */
function getCurrentUserId()
{
    ensureSession();
    return $_SESSION['user_id'] ?? null;
}

/**
 * الحصول على اسم المستخدم الحالي
 * 
 * @return string|null اسم المستخدم أو null
 */
function getCurrentUsername()
{
    ensureSession();
    return $_SESSION['username'] ?? null;
}

// ============================================
// Validation Functions - دوال التحقق
// ============================================

/**
 * التحقق من صحة البريد الإلكتروني
 * 
 * @param string $email البريد الإلكتروني
 * @return bool true إذا كان صالح
 */
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * التحقق من طول النص
 * 
 * @param string $text النص
 * @param int $min الحد الأدنى
 * @param int $max الحد الأقصى
 * @return bool true إذا كان الطول صالح
 */
function isValidLength($text, $min, $max)
{
    $length = mb_strlen($text);
    return $length >= $min && $length <= $max;
}

/**
 * التحقق من أن القيمة رقم موجب
 * 
 * @param mixed $number الرقم
 * @return bool true إذا كان رقم موجب
 */
function isPositiveNumber($number)
{
    return is_numeric($number) && $number > 0;
}

// ============================================
// Utility Functions - دوال مساعدة عامة
// ============================================

/**
 * إعادة التوجيه إلى صفحة أخرى
 * 
 * @param string $url رابط الصفحة
 */
function redirect($url)
{
    header("Location: $url");
    exit;
}

/**
 * الحصول على قيمة من GET مع تنظيفها
 * 
 * @param string $key المفتاح
 * @param mixed $default القيمة الافتراضية
 * @return mixed القيمة المنظفة
 */
function getParam($key, $default = null)
{
    return isset($_GET[$key]) ? sanitize($_GET[$key]) : $default;
}

/**
 * الحصول على قيمة من POST مع تنظيفها
 * 
 * @param string $key المفتاح
 * @param mixed $default القيمة الافتراضية
 * @return mixed القيمة المنظفة
 */
function postParam($key, $default = null)
{
    return isset($_POST[$key]) ? sanitize($_POST[$key]) : $default;
}

/**
 * تسجيل خطأ في ملف السجل
 * 
 * @param string $message رسالة الخطأ
 * @param string $file اسم الملف (اختياري)
 */
function logError($message, $file = 'error.log')
{
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $message" . PHP_EOL;
    error_log($logMessage, 3, __DIR__ . '/../logs/' . $file);
}

/**
 * تنسيق السعر
 * 
 * @param float $price السعر
 * @param string $currency العملة (افتراضي: $)
 * @return string السعر المنسق
 */
function formatPrice($price, $currency = '$')
{
    return number_format($price, 2) . ' ' . $currency;
}

/**
 * تنسيق التاريخ بالعربية
 * 
 * @param string $date التاريخ
 * @return string التاريخ المنسق
 */
function formatDate($date)
{
    return date('Y-m-d H:i', strtotime($date));
}

/**
 * إنشاء slug من النص العربي أو الإنجليزي
 * 
 * @param string $text النص
 * @return string الـ slug
 */
function createSlug($text)
{
    $text = trim($text);
    $text = preg_replace('/[^A-Za-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return strtolower($text);
}
