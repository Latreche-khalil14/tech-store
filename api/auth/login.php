<?php
/**
 * API تسجيل الدخول
 */

require_once '../../config/database.php';
require_once '../../config/helpers.php';

header('Content-Type: application/json; charset=utf-8');

// التأكد من طريقة الطلب
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'طريقة الطلب غير صالحة', null, 405);
}

try {
    // قراءة البيانات
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['email']) || empty($data['password'])) {
        jsonResponse(false, 'البريد الإلكتروني وكلمة المرور مطلوبان', null, 400);
    }

    $email = trim($data['email']);
    $password = $data['password'];

    // البحث عن المستخدم
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        jsonResponse(false, 'البريد الإلكتروني أو كلمة المرور غير صحيحة', null, 401);
    }

    // بدء الجلسة
    ensureSession();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    jsonResponse(true, 'تم تسجيل الدخول بنجاح', [
        'user' => [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role']
        ]
    ]);

} catch (PDOException $e) {
    logError("Login Error: " . $e->getMessage());
    jsonResponse(false, 'حدث خطأ في قاعدة البيانات', null, 500);
} catch (Exception $e) {
    jsonResponse(false, 'حدث خطأ غير متوقع', null, 500);
}
