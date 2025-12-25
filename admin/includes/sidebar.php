<!-- Sidebar -->
<div class="w-64 bg-slate-900 text-white p-6 hidden md:flex flex-col fixed inset-y-0 right-0 z-50 shadow-2xl">
    <div class="text-2xl font-black mb-12 bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">
        🖥️ إدارة المتجر
    </div>

    <nav class="space-y-2 flex-grow">
        <?php $current_admin_page = basename($_SERVER['PHP_SELF']); ?>
        <a href="index.php"
            class="sidebar-link <?php echo $current_admin_page == 'index.php' ? 'active' : ''; ?> flex items-center gap-3 px-4 py-3 rounded-xl transition-all">
            <span>📊</span> الإحصائيات
        </a>
        <a href="orders.php"
            class="sidebar-link <?php echo $current_admin_page == 'orders.php' ? 'active' : ''; ?> flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-slate-400 hover:text-white">
            <span>🛒</span> الطلبات
        </a>
        <a href="products.php"
            class="sidebar-link <?php echo $current_admin_page == 'products.php' ? 'active' : ''; ?> flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-slate-400 hover:text-white">
            <span>📦</span> المنتجات
        </a>
        <a href="../index.php"
            class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-slate-400 hover:text-white">
            <span>🌐</span> عرض المتجر
        </a>
    </nav>

    <a href="logout.php"
        class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-500/10 text-red-400 transition-all mt-auto border border-red-500/20">
        <span>🚪</span> تسجيل الخروج
    </a>
</div>