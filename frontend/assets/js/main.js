/**
 * Tech Store Main Entry Point
 */
$(document).ready(function () {
  // 1. Initialize Safety Parser
  function safeParse(key) {
    const item = localStorage.getItem(key);
    try {
      return item && item !== "undefined" && item !== "null"
        ? JSON.parse(item)
        : null;
    } catch (e) {
      localStorage.removeItem(key);
      return null;
    }
  }

  const user = safeParse("user");

  // 2. Setup Modules
  if (typeof checkAuth === "function") checkAuth(user);
  if (typeof updateCartIcon === "function") updateCartIcon();
  if (typeof setupMobileMenu === "function") setupMobileMenu();

  // 3. Page Specific Logic
  if (
    $("#featured-products").length &&
    typeof loadFeaturedProducts === "function"
  ) {
    loadFeaturedProducts();
  }

  if ($("#products-list").length && typeof loadProducts === "function") {
    loadProducts();

    // Listeners for Products Page
    $(document).on("input", "#search-input", loadProducts);
    $(document).on("change", "#category-filter", loadProducts);
  }

  // 4. Global Event Handlers
  $("#logout-btn, #mobile-logout-btn").on("click", function () {
    localStorage.removeItem("user");
    localStorage.removeItem("cart");
    $.post("../api/auth/logout.php", function () {
      window.location.replace("login.php");
    });
  });
});
