<?php
/**
 * API الطلبات (للوحة تحكم المسؤول)
 */

require_once '../../config/database.php';
require_once '../../config/helpers.php';

// حماية الصفحة: للمسؤولين فقط
protectAdmin();

try {
    // جلب جميع الطلبات مع معلومات العميل
    $stmt = $pdo->query("
        SELECT o.*, u.username
        FROM orders o
        JOIN users u ON o.user_id = u.id
        ORDER BY o.created_at DESC
    ");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // إرسال الاستجابة
    jsonResponse(true, 'تم جلب الطلبات بنجاح', [
        'orders' => $orders
    ]);

} catch (PDOException $e) {
    logError("Orders API Error: " . $e->getMessage());
    jsonResponse(false, 'حدث خطأ أثناء جلب الطلبات', null, 500);
} catch (Exception $e) {
    jsonResponse(false, 'حدث خطأ غير متوقع', null, 500);
}
?>
