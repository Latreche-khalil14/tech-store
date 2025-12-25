/**
 * UI & Header Logic
 * Includes: Navbar scroll effects, Mobile Menu toggles, & Auth View updates
 */

function setupMobileMenu() {
  const $menu = $("#mobile-menu");
  const $overlay = $("#mobile-menu-overlay");
  const $btn = $("#mobile-menu-btn");
  const $closeBtn = $("#close-mobile-menu");

  if (!$menu.length) return;

  function toggleMenu() {
    $menu.toggleClass("active");
    $overlay.toggleClass("active");
    $btn.toggleClass("active");
    $("body").css("overflow", $menu.hasClass("active") ? "hidden" : "");
  }

  $btn.on("click", toggleMenu);
  $overlay.on("click", toggleMenu);
  $closeBtn.on("click", toggleMenu);
}

function checkAuth(user) {
  const $userNavItem = $("#user-nav-item");
  if (!$userNavItem.length) return;

  if (user) {
    let adminLink = "";
    if (user.role && user.role.toLowerCase() === "admin") {
      adminLink = `<a href="../admin/index.php" class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition-all font-bold text-xs shadow-lg shadow-blue-600/20 whitespace-nowrap mr-3">لوحة التحكم ⚙️</a>`;
    }

    $userNavItem.html(`
            ${adminLink}
            <div class="flex items-center gap-2 bg-primary/5 px-4 py-2 rounded-xl border border-primary/10">
                <span class="text-primary font-bold text-sm">👋 ${user.username}</span>
            </div>
            <button id="logout-btn"
              class="hidden sm:flex items-center gap-2 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-4 py-2.5 rounded-xl border border-red-100 transition-all font-bold text-sm">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
              </svg>
              <span class="hidden md:inline">خروج</span>
            </button>
        `);

    $("#mobile-login-btn, #mobile-register-btn").addClass("hidden");
    $("#mobile-logout-btn").removeClass("hidden").addClass("flex");
  } else {
    $userNavItem.html(`
            <a href="login.php" class="hidden sm:flex btn-shine items-center gap-2 bg-gradient-to-r from-primary to-indigo-500 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 hover:-translate-y-0.5">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                </path>
              </svg>
              <span>تسجيل الدخول</span>
            </a>
        `);

    $("#mobile-login-btn, #mobile-register-btn").removeClass("hidden");
    $("#mobile-logout-btn").addClass("hidden").removeClass("flex");
  }
}
