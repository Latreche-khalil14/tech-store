<!-- Mobile Menu Overlay -->
<div id="mobile-menu-overlay" class="mobile-menu-overlay fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 lg:hidden">
</div>

<!-- Mobile Menu -->
<div id="mobile-menu"
    class="mobile-menu fixed top-0 left-0 w-80 max-w-[85vw] h-full bg-white z-50 shadow-2xl lg:hidden">
    <div class="flex flex-col h-full">
        <!-- Mobile Menu Header -->
        <div class="flex items-center justify-between p-6 border-b border-slate-100">
            <a href="index.php" class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center text-white font-black">
                    TS</div>
                <span class="font-black text-lg">TechStore</span>
            </a>
            <button id="close-mobile-menu"
                class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Mobile Nav Links -->
        <nav class="flex-1 p-6">
            <ul class="space-y-2">
                <li>
                    <a href="index.php"
                        class="flex items-center gap-4 px-4 py-4 rounded-xl text-slate-700 hover:bg-primary/5 hover:text-primary transition-all <?php echo $current_page == 'index.php' ? 'active text-primary bg-primary/10 border-primary' : ''; ?>">
                        <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <span class="font-semibold">الرئيسية</span>
                            <p class="text-xs text-slate-400">العودة للصفحة الرئيسية</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="products.php"
                        class="flex items-center gap-4 px-4 py-4 rounded-xl text-slate-700 hover:bg-primary/5 hover:text-primary transition-all <?php echo $current_page == 'products.php' ? 'active text-primary bg-primary/10 border-primary' : ''; ?>">
                        <div class="w-10 h-10 bg-accent/10 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="font-semibold">المنتجات</span>
                            <p class="text-xs text-slate-400">تصفح جميع المنتجات</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="cart.php"
                        class="flex items-center gap-4 px-4 py-4 rounded-xl text-slate-700 hover:bg-primary/5 hover:text-primary transition-all <?php echo $current_page == 'cart.php' ? 'active text-primary bg-primary/10 border-primary' : ''; ?>">
                        <div class="w-10 h-10 bg-secondary/10 rounded-xl flex items-center justify-center relative">
                            <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="font-semibold">سلة التسوق</span>
                            <p class="text-xs text-slate-400">عرض منتجاتك</p>
                        </div>
                        <span class="bg-secondary text-white text-xs font-bold px-2.5 py-1 rounded-full">0</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Mobile Menu Footer -->
        <div class="p-6 border-t border-slate-100 space-y-3">
            <a href="login.php" id="mobile-login-btn"
                class="flex items-center justify-center gap-2 w-full bg-gradient-to-r from-primary to-indigo-500 text-white py-4 rounded-xl font-bold hover:shadow-lg hover:shadow-primary/30 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                    </path>
                </svg>
                تسجيل الدخول
            </a>
            <a href="#" id="mobile-register-btn"
                class="flex items-center justify-center gap-2 w-full bg-slate-100 text-slate-700 py-4 rounded-xl font-bold hover:bg-slate-200 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                إنشاء حساب جديد
            </a>

            <!-- Mobile Logout Button (Hidden by default) -->
            <button id="mobile-logout-btn"
                class="hidden flex items-center justify-center gap-2 w-full bg-red-50 text-red-500 border border-red-100 py-4 rounded-xl font-bold hover:bg-red-500 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                تسجيل الخروج
            </button>
        </div>
    </div>
</div>