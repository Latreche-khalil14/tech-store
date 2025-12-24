<?php
require_once '../config/database.php';
require_once '../config/helpers.php';

protectAdmin();

$orderId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$orderId) {
    jsonResponse(false, 'معرف الطلب مطلوب');
}

try {
    // جلب تفاصيل الطلب
    $stmt = $pdo->prepare("
        SELECT o.*, u.username, u.email, u.phone
        FROM orders o
        JOIN users u ON o.user_id = u.id
        WHERE o.id = ?
    ");
    $stmt->execute([$orderId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        jsonResponse(false, 'الطلب غير موجود');
    }

    // افتراض أن هناك order_items، لكن إذا لم يكن، سأجعل items فارغ
    $items = [];
    // إذا كان هناك جدول order_items، أضف الكود هنا

    jsonResponse(true, 'تم جلب تفاصيل الطلب', [
        'order' => $order,
        'items' => $items
    ]);

} catch (Exception $e) {
    jsonResponse(false, 'حدث خطأ: ' . $e->getMessage());
}
?>
