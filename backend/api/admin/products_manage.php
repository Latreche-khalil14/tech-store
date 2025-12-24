<?php
/**
 * API إدارة المنتجات (للمسؤولين فقط)
 */

require_once '../config/database.php';
require_once '../config/helpers.php';

// حماية الصفحة: للمسؤولين فقط
protectAdmin();

$method = $_SERVER['REQUEST_METHOD'];

try {
    // 1. إضافة منتج جديد
    if ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        $name = sanitize($data['name'] ?? '');
        $price = sanitizeFloat($data['price'] ?? 0);
        $category_id = sanitizeInt($data['category_id'] ?? 0);
        $stock = sanitizeInt($data['stock'] ?? 0);
        $description = sanitize($data['description'] ?? '');
        $image_url = sanitize($data['image_url'] ?? 'assets/images/placeholder.jpg');

        // التحقق من البيانات
        if (empty($name) || $price <= 0 || $category_id <= 0) {
            jsonResponse(false, 'يرجى إكمال جميع البيانات المطلوبة بدقة', null, 400);
        }

        $slug = createSlug($name);

        $stmt = $pdo->prepare("INSERT INTO products (name, slug, description, price, category_id, stock, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $slug, $description, $price, $category_id, $stock, $image_url]);

        jsonResponse(true, 'تم إضافة المنتج بنجاح');
    }

    // 2. تحديث منتج موجود
    if ($method === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = sanitizeInt($data['id'] ?? 0);

        if ($id <= 0) {
            jsonResponse(false, 'معرف المنتج غير صالح', null, 400);
        }

        $name = sanitize($data['name'] ?? '');
        $price = sanitizeFloat($data['price'] ?? 0);
        $category_id = sanitizeInt($data['category_id'] ?? 0);
        $stock = sanitizeInt($data['stock'] ?? 0);
        $description = sanitize($data['description'] ?? '');

        if (empty($name) || $price <= 0 || $category_id <= 0) {
            jsonResponse(false, 'يرجى إكمال جميع البيانات المطلوبة', null, 400);
        }

        $slug = createSlug($name);

        $stmt = $pdo->prepare("UPDATE products SET name = ?, slug = ?, description = ?, price = ?, category_id = ?, stock = ? WHERE id = ?");
        $stmt->execute([$name, $slug, $description, $price, $category_id, $stock, $id]);

        jsonResponse(true, 'تم تحديث المنتج بنجاح');
    }

    // 3. حذف منتج
    if ($method === 'DELETE') {
        $id = sanitizeInt($_GET['id'] ?? 0);

        if ($id <= 0) {
            jsonResponse(false, 'معرف المنتج غير صالح', null, 400);
        }

        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);

        jsonResponse(true, 'تم حذف المنتج بنجاح');
    }

} catch (PDOException $e) {
    logError("Products Management Error: " . $e->getMessage());
    jsonResponse(false, 'حدث خطأ في قاعدة البيانات', null, 500);
} catch (Exception $e) {
    jsonResponse(false, 'حدث خطأ غير متوقع', null, 500);
}
