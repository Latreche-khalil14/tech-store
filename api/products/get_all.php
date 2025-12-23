<?php
require_once '../../config/database.php';
require_once '../../config/helpers.php';

header('Content-Type: application/json; charset=utf-8');

try {
    // Get parameters
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 12;
    $offset = ($page - 1) * $limit;
    $categoryId = isset($_GET['category']) ? (int) $_GET['category'] : null;
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    // Build query
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE 1=1";

    $params = [];

    if ($categoryId) {
        $sql .= " AND p.category_id = ?";
        $params[] = $categoryId;
    }

    if (!empty($search)) {
        $sql .= " AND (p.name LIKE ? OR p.description LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    // Clone for count before adding LIMIT
    $countSql = "SELECT COUNT(*) as total FROM (" . $sql . ") as t";
    $countParams = $params;

    $sql .= " ORDER BY p.created_at DESC LIMIT {$limit} OFFSET {$offset}";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get total count
    $stmt = $pdo->prepare($countSql);
    $stmt->execute($countParams);
    $total = $stmt->fetch()['total'];

    jsonResponse(true, 'تم جلب المنتجات بنجاح', [
        'products' => $products,
        'pagination' => [
            'page' => $page,
            'limit' => $limit,
            'total' => (int) $total,
            'pages' => ceil($total / $limit)
        ]
    ]);

} catch (PDOException $e) {
    jsonResponse(false, 'حدث خطأ أثناء جلب المنتجات: ' . $e->getMessage());
}
