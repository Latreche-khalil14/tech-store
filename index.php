<?php include 'includes/header.php'; ?>
<title>Tech Store - الرئيسية</title>

<section class="hero">
    <h1>مرحباً بكم في Tech Store</h1>
    <p>بوابتكم لأحدث الأجهزة التقنية بأسعار منافسة</p>
    <button class="btn-add" onclick="location.href='products.php'" style="padding: 15px 40px; font-size: 1.1rem;">ابدأ
        التسوق</button>
</section>

<div class="container">
    <h2 class="section-title">أحدث المنتجات المميزة</h2>
    <div class="products-grid" id="featured-products">
        <!-- AJAX loading -->
    </div>
</div>

<?php include 'includes/footer.php'; ?>