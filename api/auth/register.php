<?php
/**
 * API تسجيل مستخدم جديد
 */

require_once '../../config/database.php';
require_once '../../config/helpers.php';

// التأكد من طريقة الطلب
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'طريقة الطلب غير صالحة', null, 405);
}

try {
    // قراءة البيانات
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        jsonResponse(false, 'بيانات غير صالحة', null, 400);
    }

    // البيانات المطلوبة
    $username = sanitize($data['username'] ?? '');
    $email = sanitizeEmail($data['email'] ?? '');
    $password = $data['password'] ?? '';
    $full_name = sanitize($data['full_name'] ?? '');
    $phone = sanitize($data['phone'] ?? '');

    // التحقق من الحقول المطلوبة
    if (empty($username) || empty($email) || empty($password) || empty($full_name) || empty($phone)) {
        jsonResponse(false, 'يرجى إكمال جميع الحقول المطلوبة', null, 400);
    }

    // التحقق من البريد الإلكتروني
    if (!$email) {
        jsonResponse(false, 'البريد الإلكتروني غير صالح', null, 400);
    }

    // التحقق من طول كلمة المرور
    if (!isValidLength($password, 6, 100)) {
        jsonResponse(false, 'كلمة المرور يجب أن تكون بين 6 و 100 حرف', null, 400);
    }

    // التحقق من تكرار المستخدم أو البريد
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$email, $username]);

    if ($stmt->fetch()) {
        jsonResponse(false, 'اسم المستخدم أو البريد الإلكتروني مسجل بالفعل', null, 409);
    }

    // تشفير كلمة المرور
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // إدراج المستخدم الجديد
    $stmtInsert = $pdo->prepare("INSERT INTO users (username, email, password, full_name, phone, role) VALUES (?, ?, ?, ?, ?, 'customer')");
    $stmtInsert->execute([$username, $email, $hashedPassword, $full_name, $phone]);

    $userId = $pdo->lastInsertId();

    // بدء الجلسة للمستخدم الجديد
    ensureSession();
    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = 'customer';

    jsonResponse(true, 'تم إنشاء الحساب بنجاح! مرحباً بك في عائلتنا', [
        'user' => [
            'id' => $userId,
            'username' => $username,
            'email' => $email,
            'role' => 'customer'
        ]
    ], 201);

} catch (PDOException $e) {
    logError("User Registration Error: " . $e->getMessage());
    jsonResponse(false, 'حدث خطأ في قاعدة البيانات أثناء التسجيل', null, 500);
} catch (Exception $e) {
    jsonResponse(false, 'حدث خطأ غير متوقع', null, 500);
}


