<?php include 'includes/header.php'; ?>
<?php include 'includes/page-header/page-header.php'; ?>
<title>Tech Store - المتجر</title>

<?php
renderPageHeader(
    'استكشف',
    'تسوق أحدث قطع الهاردوير، أجهزة الجيمنج، واللابتوبات الاحترافية بأفضل الأسعار وضمان الجودة.',
    'TS STORE COLLECTION',
    'المتجر'
);
?>

<div class="container mx-auto px-6 -mt-10 relative z-20 pb-32">

    <?php include 'includes/search-filters/search-filters.php'; ?>

    <!-- Products Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10" id="products-list">
        <!-- AJAX loading via main.js -->
    </div>

    <!-- Empty State -->
    <div id="no-products" class="hidden text-center py-32 bg-white rounded-[3rem] shadow-inner mt-10"
        data-aos="fade-up">
        <div class="text-8xl mb-8 animate-bounce">🕵️‍♂️</div>
        <h3 class="text-3xl font-black text-dark mb-4">عذراً، لم نجد ما تبحث عنه!</h3>
        <p class="text-slate-500 text-lg max-w-md mx-auto font-medium leading-relaxed">جرب استخدام كلمات بحث مختلفة أو
            تصفح فئة أخرى من القائمة العلوية.</p>
        <button onclick="location.reload()"
            class="mt-10 px-8 py-4 bg-dark text-white rounded-2xl font-bold hover:bg-primary transition-all">إعادة ضبط
            البحث</button>
    </div>
</div>

<script>
    $(document).ready(function () {
        if (typeof loadProducts === 'function') loadProducts();

        // Enhance category dropdown on mobile
        $('#category-filter').wrap('<div class="relative"></div>').after('<span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">▼</span>');
    });
</script>

<?php include 'includes/footer/footer.php'; ?>