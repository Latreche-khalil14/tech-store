/**
 * Cart Management Logic
 */

function addToCart(productId, productName) {
  productId = parseInt(productId);
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  let item = cart.find((i) => parseInt(i.id) === productId);

  if (item) {
    item.quantity = parseInt(item.quantity) + 1;
  } else {
    cart.push({ id: Number(productId), quantity: 1 });
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartIcon();

  if (typeof Swal !== "undefined") {
    Swal.fire({
      title: "تمت الإضافة!",
      text: `تمت إضافة ${productName || "المنتج"} إلى سلة التسوق`,
      icon: "success",
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });
  }
}

function updateCartIcon() {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  let count = cart.reduce((total, item) => total + item.quantity, 0);

  $("#cart-count").text(count);
  $(".mobile-menu #mobile-cart-count").text(count);
}
