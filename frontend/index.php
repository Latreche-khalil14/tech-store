<?php include 'includes/header.php'; ?>

<?php include 'includes/hero/hero.php'; ?>

<?php include 'includes/features/features.php'; ?>

<!-- Featured Section -->
<section class="py-24 bg-white relative" id="featured">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div data-aos="fade-left">
                <span class="text-primary font-bold tracking-widest uppercase text-sm mb-2 block">Premium
                    Selection</span>
                <h2 class="text-4xl md:text-5xl font-black text-dark mb-4 tracking-tight">إصدارات <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">مختارة
                        بعناية</span></h2>
                <div class="w-32 h-2 bg-gradient-to-r from-primary to-secondary rounded-full"></div>
            </div>
            <a href="products.php"
                class="group flex items-center space-x-2 space-x-reverse text-primary font-bold text-lg hover:text-secondary transition-colors"
                data-aos="fade-right">
                <span>استكشف كافة المنتجات</span>
                <span class="group-hover:translate-x-[-8px] transition-transform duration-300">←</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10" id="featured-products">
            <!-- AJAX Products -->
        </div>
    </div>
</section>

<?php include 'includes/partners/partners.php'; ?>

<?php include 'includes/footer/footer.php'; ?>