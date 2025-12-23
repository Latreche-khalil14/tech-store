<?php
// Security Headers
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("Content-Security-Policy: default-src 'self' https: data: 'unsafe-inline' 'unsafe-eval';");

// Get current page for active state
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tech Store - التجربة العصرية</title>

  <!-- Preconnect to external domains for faster loading -->
  <link rel="preconnect" href="https://cdn.tailwindcss.com">
  <link rel="preconnect" href="https://code.jquery.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">

  <!-- Critical CSS inline -->
  <style>
    body {
      font-family: 'Outfit', 'Tajawal', sans-serif;
      background-color: #f8fafc;
      margin: 0;
      padding: 0
    }

    .navbar-glass {
      background: rgba(255, 255, 255, .75);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px)
    }
  </style>

  <!-- Load Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Load jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Load tsParticles -->
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>

  <!-- Tailwind Config -->
  <script>
    // صورة بديلة مدمجة (لا تحتاج إنترنت)
    const PLACEHOLDER_IMAGE = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 400 400'%3E%3Crect width='400' height='400' fill='%23f1f5f9'/%3E%3Ctext x='50%25' y='50%25' font-family='sans-serif' font-size='24' fill='%2394a3b8' dominant-baseline='middle' text-anchor='middle'%3ENo Image%3C/text%3E%3C/svg%3E";

    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: { DEFAULT: '#4f46e5', hover: '#4338ca', light: '#e0e7ff' },
            secondary: { DEFAULT: '#ec4899', hover: '#db2777', light: '#fce7f3' },
            accent: { DEFAULT: '#06b6d4', hover: '#0891b2' },
            surface: '#ffffff',
            background: '#f8fafc',
            dark: '#1e293b',
          },
          boxShadow: {
            'soft': '0 20px 40px -15px rgba(79, 70, 229, 0.1)',
            'glow': '0 0 20px rgba(79, 70, 229, 0.3)',
            'navbar': '0 4px 30px rgba(79, 70, 229, 0.08)',
          },
          borderRadius: { '4xl': '2.5rem' },
          animation: {
            'float': 'float 6s ease-in-out infinite',
            'pulse-soft': 'pulse-soft 2s ease-in-out infinite',
          }
        }
      }
    }
  </script>

  <!-- Font Loading -->
  <link
    href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;900&family=Tajawal:wght@400;500;700;800&display=swap"
    rel="stylesheet">

  <!-- CSS Loading -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="assets/css/style.css">


  <!-- Load jQuery Core First -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Load tsParticles only if needed (defer loading) -->
  <script src="https://cdn.jsdelivr.net/npm/tsparticles-slim@2.0.6/tsparticles.slim.bundle.min.js" defer></script>

  <!-- Load SweetAlert2 (defer loading) -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
  <style>
    body {
      font-family: 'Outfit', 'Tajawal', sans-serif;
      background-color: #f8fafc;
    }

    /* Navbar Glassmorphism */
    .navbar-glass {
      background: rgba(255, 255, 255, 0.75);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.3);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .navbar-glass.scrolled {
      background: rgba(255, 255, 255, 0.95);
      box-shadow: 0 4px 30px rgba(79, 70, 229, 0.1);
    }

    /* Nav Link Hover Effect */
    .nav-link {
      position: relative;
      padding: 0.5rem 0;
      transition: all 0.3s ease;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      right: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #4f46e5, #06b6d4);
      border-radius: 2px;
      transition: width 0.3s ease;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
      width: 100%;
    }

    .nav-link.active {
      color: #4f46e5;
    }

    /* Cart Badge Animation */
    .cart-badge {
      animation: pulse-soft 2s ease-in-out infinite;
    }

    @keyframes pulse-soft {

      0%,
      100% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.1);
      }
    }

    /* Mobile Menu */
    .mobile-menu {
      transform: translateX(100%);
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .mobile-menu.active {
      transform: translateX(0);
    }

    .mobile-menu-overlay {
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }

    .mobile-menu-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    /* Hamburger Animation */
    .hamburger span {
      transition: all 0.3s ease;
    }

    .hamburger.active span:nth-child(1) {
      transform: rotate(45deg) translate(6px, 6px);
    }

    .hamburger.active span:nth-child(2) {
      opacity: 0;
      transform: translateX(20px);
    }

    .hamburger.active span:nth-child(3) {
      transform: rotate(-45deg) translate(6px, -6px);
    }

    /* Button Shine Effect */
    .btn-shine {
      position: relative;
      overflow: hidden;
    }

    .btn-shine::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.5s ease;
    }

    .btn-shine:hover::before {
      left: 100%;
    }

    /* Icon Button Hover */
    .icon-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(79, 70, 229, 0.15);
    }

    /* AOS Fallback: Ensure visibility if JS library fails */
    [data-aos] {
      opacity: 1;
      transition-property: opacity, transform;
    }

    /* When AOS is initialized, it will handle the states */
    html.aos-init [data-aos] {
      /* AOS default states will take over */
    }
  </style>
</head>

<body class="bg-background text-slate-800 overflow-x-hidden antialiased">

  <!-- Professional Navbar -->
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
            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-accent rounded-full border-2 border-white animate-pulse">
            </div>
          </div>
          <div class="hidden sm:flex flex-col">
            <h1 class="text-xl font-black leading-none text-slate-800 group-hover:text-primary transition-colors">
              TechStore</h1>
            <span class="text-[10px] text-primary font-bold tracking-[0.2em] uppercase">Premium Tech</span>
          </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center">
          <ul class="flex items-center gap-3">
            <li>
              <a href="index.php"
                class="nav-link relative px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-primary hover:bg-primary/10 transition-all duration-300 border-b-2 border-transparent hover:border-primary <?php echo $current_page == 'index.php' ? 'active text-primary bg-primary/10 border-primary' : ''; ?>">
                <span class="flex items-center gap-2">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                  </svg>
                  الرئيسية
                </span>
              </a>
            </li>
            <li>
              <a href="products.php"
                class="nav-link relative px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-primary hover:bg-primary/10 transition-all duration-300 border-b-2 border-transparent hover:border-primary <?php echo $current_page == 'products.php' ? 'active text-primary bg-primary/10 border-primary' : ''; ?>">
                <span class="flex items-center gap-2">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                  </svg>
                  المنتجات
                </span>
              </a>
            </li>
            <li>
              <a href="#featured"
                class="nav-link relative px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-primary hover:bg-primary/10 transition-all duration-300 border-b-2 border-transparent hover:border-primary">
                <span class="flex items-center gap-2">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                    </path>
                  </svg>
                  العروض
                </span>
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

  <!-- Mobile Menu Overlay -->
  <div id="mobile-menu-overlay"
    class="mobile-menu-overlay fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 lg:hidden"></div>

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
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Mobile Nav Links -->
      <nav class="flex-1 p-6">
        <ul class="space-y-2">
          <li>
            <a href="index.php"
              class="flex items-center gap-4 px-4 py-4 rounded-xl text-slate-700 hover:bg-primary/5 hover:text-primary transition-all <?php echo $current_page == 'index.php' ? 'bg-primary/10 text-primary font-bold' : ''; ?>">
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
              class="flex items-center gap-4 px-4 py-4 rounded-xl text-slate-700 hover:bg-primary/5 hover:text-primary transition-all <?php echo $current_page == 'products.php' ? 'bg-primary/10 text-primary font-bold' : ''; ?>">
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
              class="flex items-center gap-4 px-4 py-4 rounded-xl text-slate-700 hover:bg-primary/5 hover:text-primary transition-all <?php echo $current_page == 'cart.php' ? 'bg-primary/10 text-primary font-bold' : ''; ?>">
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
              d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
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

  <!-- Spacer -->
  <div class="h-20"></div>

  <!-- Navbar JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const navbar = document.getElementById('navbar');

      // Scroll effect
      window.addEventListener('scroll', function () {
        if (window.scrollY > 50) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
      });

      // نظام التصفير الصارم
      if (window.location.search.includes('order_success=true')) {
        localStorage.removeItem('cart');
        localStorage.setItem('cart', '[]');
        if (typeof updateCartIcon === 'function') updateCartIcon();
      }
    });
  </script>