<?php
session_start();
require_once '../../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$required = ['username', 'email', 'password', 'full_name'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        echo json_encode(['success' => false, 'message' => "حقل {$field} مطلوب"]);
        exit;
    }
}

$username = trim($data['username']);
$email = trim($data['email']);
$password = $data['password'];
$full_name = trim($data['full_name']);

if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$email, $username]);
    
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'البريد الإلكتروني أو اسم المستخدم مستخدم بالفعل']);
        exit;
    }
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, full_name) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $hashedPassword, $full_name]);
    
    $userId = $pdo->lastInsertId();
    
    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = 'customer';
    
    echo json_encode([
        'success' => true,
        'message' => 'تم إنشاء الحساب بنجاح',
        'user' => [
            'id' => $userId,
            'username' => $username,
            'email' => $email,
            'role' => 'customer'
        ]
    ]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'حدث خطأ أثناء إنشاء الحساب']);
}
