<?php
require_once '../../config/database.php';
require_once '../../config/helpers.php';

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['id'])) {
    jsonResponse(false, 'معرف المنتج مطلوب');
}

$productId = (int) $_GET['id'];

try {
    $stmt = $pdo->prepare("
        SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE p.id = ?
    ");

    $stmt->execute([$productId]);
    $product = $stmt->fetch();

    if (!$product) {
        jsonResponse(false, 'المنتج غير موجود');
    }

    jsonResponse(true, 'تم جلب المنتج بنجاح', $product);

} catch (PDOException $e) {
    jsonResponse(false, 'حدث خطأ أثناء جلب المنتج');
}
