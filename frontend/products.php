<?php include 'includes/header.php'; ?>
<title>Tech Store - المتجر</title>

<!-- Modern Product Header -->
<section class="relative py-24 bg-background overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full max-w-7xl pointer-events-none">
        <div
            class="absolute top-10 left-10 w-64 h-64 bg-primary/10 rounded-full blur-3xl mix-blend-multiply animate-blob">
        </div>
        <div
            class="absolute top-10 right-10 w-64 h-64 bg-secondary/10 rounded-full blur-3xl mix-blend-multiply animate-blob animation-delay-2000">
        </div>
    </div>

    <div class="container mx-auto px-6 relative z-10 text-center" data-aos="fade-down">
        <span
            class="inline-block py-1 px-3 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-widest mb-4 border border-primary/20">
            TS STORE COLLECTION
        </span>
        <h1 class="text-5xl md:text-6xl font-black mb-6 tracking-tight text-slate-900">
            استكشف <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent">المتجر</span>
        </h1>
        <p class="text-slate-500 max-w-2xl mx-auto text-lg font-medium leading-relaxed">
            تسوق أحدث قطع الهاردوير، أجهزة الجيمنج، واللابتوبات الاحترافية بأفضل الأسعار وضمان الجودة.
        </p>
    </div>
</section>

<div class="container mx-auto px-6 -mt-10 relative z-20 pb-32">
    <!-- Search & Filters Container -->
    <div class="glass rounded-[2rem] shadow-soft p-4 md:p-6 flex flex-col lg:flex-row gap-4 items-center mb-12 border border-white/50"
        data-aos="fade-up">

        <div class="relative flex-1 w-full group">
            <span
                class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" id="search-input" placeholder="ابحث عن منتج، ماركة، أو فئة..."
                class="w-full pr-16 pl-6 py-4 bg-slate-50/50 hover:bg-slate-50 focus:bg-white rounded-[1.5rem] focus:ring-2 focus:ring-primary/20 transition-all duration-300 outline-none font-bold text-slate-700 text-lg border border-transparent focus:border-primary/30 placeholder-slate-400">
        </div>

        <div class="w-full lg:w-72 relative">
            <select id="category-filter"
                class="w-full px-6 py-4 bg-slate-50/50 hover:bg-slate-50 focus:bg-white rounded-[1.5rem] focus:ring-2 focus:ring-primary/20 transition-all duration-300 outline-none appearance-none cursor-pointer font-bold text-slate-700 text-lg border border-transparent focus:border-primary/30">
                <option value="">كل الفئات</option>
                <option value="1">لابتوب</option>
                <option value="2">كمبيوتر مكتبي</option>
                <option value="3">شاشات</option>
                <option value="4">الملحقات</option>
            </select>
            <div class="absolute left-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 0 01-1.414 0l-4-4a1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>

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

<?php include 'includes/footer.php'; ?>