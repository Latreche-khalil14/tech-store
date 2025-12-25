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

  <!-- Modular JS Modules -->
  <script src="assets/js/ui.js"></script>
  <script src="assets/js/products.js"></script>
  <script src="assets/js/cart.js"></script>
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

  <?php include 'navbar/navbar.php'; ?>
  <?php include 'mobile-menu/mobile-menu.php'; ?>

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