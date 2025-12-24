<?php
session_start();
require_once '../config/database.php';
require_once '../config/helpers.php';

header('Content-Type: application/json; charset=utf-8');

// التحقق من تسجيل الدخول
if (!isLoggedIn()) {
    jsonResponse(false, 'يجب تسجيل الدخول أولاً', null, 401);
}

// التحقق من طريقة الطلب
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'طريقة الطلب غير صالحة', null, 405);
}

// قراءة البيانات
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    jsonResponse(false, 'بيانات غير صالحة', null, 400);
}

$userId = getCurrentUserId();
$cart = $data['cart'] ?? [];
$phone = sanitize($data['phone'] ?? '');
$address = sanitize($data['address'] ?? '');

// دمج الهاتف مع العنوان لضمان حفظه
$fullAddress = "الهاتف: " . $phone . " | العنوان: " . $address;

// التحقق من البيانات المطلوبة
if (empty($cart)) {
    jsonResponse(false, 'السلة فارغة', null, 400);
}

if (empty($address) || empty($phone)) {
    jsonResponse(false, 'يرجى إكمال معلومات الهاتف والعنوان', null, 400);
}

try {
    $pdo->beginTransaction();

    // التحقق من جميع المنتجات قبل إنشاء الطلب
    $invalidProducts = [];
    $outOfStockProducts = [];
    $validatedCart = [];

    foreach ($cart as $item) {
        $productId = (int) ($item['id'] ?? 0);
        $quantity = (int) ($item['quantity'] ?? 0);

        if ($productId <= 0 || $quantity <= 0) {
            continue;
        }

        // التحقق من وجود المنتج والمخزون
        $stmt = $pdo->prepare("SELECT id, name, price, stock FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch();

        if (!$product) {
            $invalidProducts[] = "منتج رقم {$productId}";
            continue;
        }

        if ($product['stock'] < $quantity) {
            $outOfStockProducts[] = $product['name'] . " (متوفر: {$product['stock']})";
            continue;
        }

        $validatedCart[] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity
        ];
    }

    // إذا كانت هناك منتجات غير صالحة
    if (!empty($invalidProducts)) {
        $pdo->rollBack();
        jsonResponse(false, 'بعض المنتجات غير موجودة: ' . implode(', ', $invalidProducts), null, 400);
    }

    // إذا كانت هناك منتجات نفذت من المخزون
    if (!empty($outOfStockProducts)) {
        $pdo->rollBack();
        jsonResponse(false, 'بعض المنتجات غير متوفرة بالكمية المطلوبة: ' . implode(', ', $outOfStockProducts), null, 400);
    }

    // إذا لم تبقَ منتجات صالحة
    if (empty($validatedCart)) {
        $pdo->rollBack();
        jsonResponse(false, 'لا توجد منتجات صالحة في السلة', null, 400);
    }

    // حساب المجموع الفعلي من قاعدة البيانات
    $actualTotal = 0;
    foreach ($validatedCart as $item) {
        $actualTotal += $item['price'] * $item['quantity'];
    }

    // 1. إنشاء الطلب
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price, shipping_address, status) VALUES (?, ?, ?, 'pending')");
    $stmt->execute([$userId, $actualTotal, $fullAddress]);
    $orderId = $pdo->lastInsertId();

    // 2. إضافة تفاصيل المنتجات
    $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    $stmtStock = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");

    foreach ($validatedCart as $item) {
        // إضافة المنتج للطلب
        $stmtItem->execute([
            $orderId,
            $item['id'],
            $item['quantity'],
            $item['price']
        ]);

        // تحديث المخزون
        $stmtStock->execute([
            $item['quantity'],
            $item['id']
        ]);
    }

    $pdo->commit();

    jsonResponse(true, 'تم إنشاء الطلب بنجاح! شكراً لثقتك بنا', [
        'order_id' => $orderId,
        'total' => $actualTotal,
        'items_count' => count($validatedCart)
    ]);

} catch (PDOException $e) {
    $pdo->rollBack();
    logError("Order creation error: " . $e->getMessage());
    jsonResponse(false, 'حدث خطأ أثناء إنشاء الطلب. يرجى المحاولة مرة أخرى', null, 500);
} catch (Exception $e) {
    $pdo->rollBack();
    logError("Order creation error: " . $e->getMessage());
    jsonResponse(false, 'حدث خطأ غير متوقع', null, 500);
}
