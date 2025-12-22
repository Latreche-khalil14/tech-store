<?php include 'includes/header.php'; ?>
<title>Tech Store - المنتجات</title>

<div class="container" style="padding-top: 2rem;">
    <h2 class="section-title">تصفح مجموعتنا الواسعة</h2>

    <div class="filters" style="display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;">
        <input type="text" id="search-input" placeholder="عن ماذا تبحث اليوم؟"
            style="flex:1; padding:10px; border-radius:8px; border:1px solid #ddd;">
        <select id="category-filter" style="padding:10px; border-radius:8px; border:1px solid #ddd;">
            <option value="">كل الفئات</option>
            <option value="1">لابتوب</option>
            <option value="2">كمبيوتر مكتبي</option>
            <option value="3">شاشات</option>
            <option value="4">الملحقات</option>
        </select>
    </div>

    <div class="products-grid" id="products-list">
        <!-- AJAX loading -->
    </div>
</div>

<script>
    // خاص لصفحة المنتجات
    $(document).ready(function () {
        if (typeof loadProducts === 'function') loadProducts();
    });
</script>

<?php include 'includes/footer.php'; ?>