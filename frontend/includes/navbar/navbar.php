<!-- Professional Navbar -->
<link rel="stylesheet" href="includes/navbar/navbar.css">
<header id="navbar" class="fixed top-0 left-0 w-full z-50 navbar-glass">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="flex items-center justify-between h-20">

            <!-- Logo Section -->
            <a href="index.php" class="flex items-center gap-3 group">
                <div class="relative">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-primary via-indigo-500 to-accent rounded-2xl flex items-center justify-center text-white font-black text-lg shadow-lg shadow-primary/20 group-hover:shadow-primary/40 transition-all duration-300 group-hover:scale-105">
                        TS
                    </div>
                    <div
                        class="absolute -bottom-1 -right-1 w-4 h-4 bg-accent rounded-full border-2 border-white animate-pulse">
                    </div>
                </div>
                <div class="hidden sm:flex flex-col">
                    <h1
                        class="text-xl font-black leading-none text-slate-800 group-hover:text-primary transition-colors">
                        TechStore</h1>
                    <span class="text-[10px] text-primary font-bold tracking-[0.2em] uppercase">Premium Tech</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center">
                <ul class="flex items-center gap-3">
                    <li>
                        <a href="index.php"
                            class="nav-link group relative flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-primary hover:bg-primary/10 transition-all duration-300 border-b-2 border-transparent hover:border-primary <?php echo $current_page == 'index.php' ? 'active text-primary bg-primary/10 border-primary' : ''; ?>">
                                <svg class="w-4 h-4 transition-colors group-hover:text-primary shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                <span class="transition-colors group-hover:text-primary whitespace-nowrap">الرئيسية</span>
                        </a>
                    </li>
                    <li>
                        <a href="products.php"
                            class="nav-link group relative flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-primary hover:bg-primary/10 transition-all duration-300 border-b-2 border-transparent hover:border-primary <?php echo $current_page == 'products.php' ? 'active text-primary bg-primary/10 border-primary' : ''; ?>">
                                <svg class="w-4 h-4 transition-colors group-hover:text-primary shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span class="transition-colors group-hover:text-primary whitespace-nowrap">المنتجات</span>
                        </a>
                    </li>
                    <li>
                        <a href="#featured"
                            class="nav-link group relative flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-primary hover:bg-primary/10 transition-all duration-300 border-b-2 border-transparent hover:border-primary">
                                <svg class="w-4 h-4 transition-colors group-hover:text-primary shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                    </path>
                                </svg>
                                <span class="transition-colors group-hover:text-primary whitespace-nowrap">العروض</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Actions Section -->
            <div class="flex items-center gap-3">

                <!-- Search Button (Desktop) -->
                <button
                    class="hidden md:flex icon-btn w-11 h-11 bg-slate-100/80 hover:bg-white rounded-xl items-center justify-center text-slate-500 hover:text-primary border border-slate-200/50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <!-- Cart Button -->
                <a href="cart.php"
                    class="icon-btn relative w-11 h-11 bg-slate-100/80 hover:bg-white rounded-xl flex items-center justify-center text-slate-500 hover:text-primary border border-slate-200/50 <?php echo $current_page == 'cart.php' ? 'bg-primary/10 text-primary border-primary/20' : ''; ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span
                        class="cart-badge absolute -top-1.5 -right-1.5 bg-gradient-to-r from-secondary to-pink-400 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-lg shadow-secondary/30"
                        id="cart-count">0</span>
                </a>

                <!-- User Actions Container (Dynamic) -->
                <div id="user-nav-item" class="flex items-center gap-3">
                    <!-- Content will be added by JavaScript -->
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn"
                    class="hamburger lg:hidden flex flex-col items-center justify-center w-11 h-11 bg-slate-100/80 hover:bg-white rounded-xl border border-slate-200/50 gap-1.5 p-2.5">
                    <span class="w-5 h-0.5 bg-slate-600 rounded-full"></span>
                    <span class="w-5 h-0.5 bg-slate-600 rounded-full"></span>
                    <span class="w-5 h-0.5 bg-slate-600 rounded-full"></span>
                </button>

            </div>
        </div>
    </div>
</header>