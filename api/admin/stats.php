<?php
/**
 * API الإحصائيات (للوحة تحكم المسؤول)
 */

require_once '../../config/database.php';
require_once '../../config/helpers.php';

// حماية الصفحة: للمسؤولين فقط
protectAdmin();

try {
    // 1. إحصائيات عامة
    $totalOrders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();

    $revenueQuery = $pdo->query("SELECT SUM(total_price) FROM orders WHERE status != 'cancelled'");
    $totalRevenue = $revenueQuery->fetchColumn() ?: 0;

    $totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
    $totalUsers = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'customer'")->fetchColumn();

    // 2. أخر 5 طلبات
    $stmtLatest = $pdo->query("
        SELECT o.*, u.username 
        FROM orders o 
        JOIN users u ON o.user_id = u.id 
        ORDER BY o.created_at DESC 
        LIMIT 5
    ");
    $latestOrders = $stmtLatest->fetchAll();

    // 3. إرسال الاستجابة
    jsonResponse(true, 'تم جلب الإحصائيات بنجاح', [
        'stats' => [
            'orders' => sanitizeInt($totalOrders),
            'revenue' => formatPrice($totalRevenue),
            'products' => sanitizeInt($totalProducts),
            'users' => sanitizeInt($totalUsers)
        ],
        'latestOrders' => $latestOrders
    ]);

} catch (PDOException $e) {
    logError("Dashboard Stats Error: " . $e->getMessage());
    jsonResponse(false, 'حدث خطأ أثناء جلب إحصائيات قاعدة البيانات', null, 500);
} catch (Exception $e) {
    jsonResponse(false, 'حدث خطأ غير متوقع', null, 500);
}
