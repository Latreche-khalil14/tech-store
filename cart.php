<?php include 'includes/header.php'; ?>
<title>سلة التسوق - Tech Store</title>

<div class="container mx-auto px-6 py-16 pb-32 min-h-[70vh]">
    <div class="mb-12" data-aos="fade-left">
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight flex items-center gap-4">
            <span class="bg-primary/10 text-primary p-4 rounded-[1.5rem] shadow-sm">🛒</span>
            سلة المشتريات
        </h1>
    </div>

    <div class="flex flex-col lg:flex-row gap-12 items-start">
        <!-- Cart Items List -->
        <div class="w-full lg:flex-1 space-y-6" id="cart-items">
            <!-- Loading Placeholder -->
            <div class="animate-pulse bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-soft h-40 w-full">
            </div>
        </div>

        <!-- Summary Sidebar -->
        <div class="w-full lg:w-[420px] space-y-6 sticky top-32" data-aos="fade-up">
            <div
                class="bg-white rounded-[2.5rem] p-8 shadow-soft border border-slate-100 relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary to-accent"></div>

                <h3 class="text-2xl font-black mb-8 border-b border-slate-100 pb-6 text-slate-900">ملخص الطلب</h3>

                <div class="space-y-6 mb-10">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500 font-bold">عدد المنتجات</span>
                        <span id="items-count" class="text-lg font-black text-slate-800">0 قطعة</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500 font-bold">رسوم التوصيل</span>
                        <span
                            class="text-green-600 font-bold bg-green-50 px-3 py-1 rounded-full text-xs border border-green-100">مجاني
                            لفترة محدودة</span>
                    </div>
                    <div class="pt-8 border-t border-slate-100 flex flex-col gap-2">
                        <span class="text-slate-500 font-bold">المجموع النهائي</span>
                        <div class="flex justify-between items-end">
                            <span id="cart-total" class="text-5xl font-black text-slate-900 tracking-tighter">0.00 <span
                                    class="text-2xl text-primary">$</span></span>
                        </div>
                    </div>
                </div>

                <button onclick="location.href='checkout.php'"
                    class="w-full py-5 bg-blue-600 text-white hover:bg-blue-700 font-bold text-xl rounded-2xl transition-all duration-300 shadow-xl shadow-blue-600/20 hover:shadow-blue-600/30 transform hover:-translate-y-1 active:scale-95 flex justify-center items-center gap-2 group/btn">
                    <span>إتمام الطلب</span>
                    <span class="group-hover/btn:translate-x-[-5px] transition-transform">←</span>
                </button>
            </div>

            <a href="products.php"
                class="block text-center py-5 bg-transparent border-2 border-slate-200 text-slate-500 font-bold rounded-2xl hover:bg-slate-50 hover:text-slate-700 transition-all duration-300">
                مواصلة التسوق
            </a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        loadCart();

        async function loadCart() {
            let cart = [];
            try {
                const val = localStorage.getItem('cart');
                cart = (val && val !== 'undefined') ? JSON.parse(val) : [];
            } catch (e) {
                cart = [];
                localStorage.removeItem('cart');
            }

            if (!Array.isArray(cart) || cart.length === 0) {
                renderEmptyCart();
                return;
            }

            try {
                // Fetch all products in parallel
                const productPromises = cart.map(item =>
                    $.get(`api/products/get_by_id.php?id=${item.id}`).catch(() => null)
                );

                const responses = await Promise.all(productPromises);

                let html = '';
                let total = 0;
                let count = 0;
                let validItems = [];

                responses.forEach((res, index) => {
                    if (res && res.success && res.data) {
                        const p = res.data;
                        const item = cart.find(i => i.id == p.id); // Match back to cart item for quantity

                        if (item) {
                            const subtotal = p.price * item.quantity;
                            total += subtotal;
                            count += item.quantity;

                            html += `
                                 <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-soft flex flex-col sm:flex-row items-center gap-8 hover:shadow-lg transition-all duration-300 group relative overflow-hidden" data-aos="fade-up" data-aos-delay="${index * 50}">
                                     <!-- Product Image -->
                                     <div class="w-32 h-32 bg-slate-50 rounded-2xl overflow-hidden flex items-center justify-center p-4 shrink-0 group-hover:bg-primary/5 transition-colors">
                                         <img src="${p.image_url}" onerror="this.src=PLACEHOLDER_IMAGE" class="max-h-full object-contain group-hover:scale-110 transition-transform duration-500">
                                     </div>

                                     <!-- Product Details -->
                                     <div class="flex-1 min-w-0 text-center sm:text-right">
                                         <span class="text-[10px] font-black text-primary uppercase tracking-[0.2em] mb-2 block">${p.category_name || 'Tech'}</span>
                                         <h4 class="text-xl font-black text-slate-800 truncate mb-2 group-hover:text-primary transition-colors">${p.name}</h4>
                                         <div class="flex items-center justify-center sm:justify-start gap-2">
                                             <span class="text-2xl font-black text-slate-900">${p.price}</span>
                                             <span class="text-sm font-bold text-primary">$</span>
                                         </div>
                                     </div>

                                     <!-- Quantity Controls -->
                                     <div class="flex items-center gap-4 bg-slate-50 p-2 rounded-2xl border border-slate-100">
                                         <button onclick="updateQty(${p.id}, -1)" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow-sm hover:bg-red-50 hover:text-red-500 transition-all font-bold">-</button>
                                         <span class="w-8 text-center font-black text-slate-800 text-lg">${item.quantity}</span>
                                         <button onclick="updateQty(${p.id}, 1)" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow-sm hover:bg-primary hover:text-white transition-all font-bold">+</button>
                                     </div>

                                     <!-- Delete Button -->
                                     <button onclick="removeFromCart(${p.id})" class="absolute top-4 left-4 sm:relative sm:top-0 sm:left-0 w-12 h-12 flex items-center justify-center rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all text-xl">
                                         🗑️
                                     </button>
                                 </div>
                            `;

                            validItems.push(item);
                        }
                    }
                });

                if (html === '') {
                    renderEmptyCart();
                } else {
                    $('#cart-items').html(html);
                    $('#cart-total').text(total.toFixed(2) + ' $');
                    $('#items-count').text(count + ' قطعة');
                }

            } catch (error) {
                console.error("Error loading cart:", error);
                $('#cart-items').html('<p class="text-center text-red-500">حدث خطأ في تحميل السلة. يرجى المحاولة لاحقاً.</p>');
            }
        }

        function renderEmptyCart() {
            $('#cart-items').html(`
                <div class="bg-white rounded-3xl p-20 text-center border-2 border-dashed border-slate-200" data-aos="zoom-in">
                    <div class="text-7xl mb-6">🏜️</div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-2">سلتك فارغة تماماً</h2>
                    <p class="text-slate-500 mb-8">لم تضف أي منتجات تقنية بعد!</p>
                    <a href="products.php" class="inline-block px-10 py-4 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">اكتشف منتجاتنا</a>
                </div>
            `);
            $('#cart-total').text('0 $');
            $('#items-count').text('0 قطعة');
        }

        window.updateQty = function (id, delta) {
            let cart = JSON.parse(localStorage.getItem('cart'));
            let item = cart.find(i => i.id == id);
            if (item) {
                item.quantity += delta;
                if (item.quantity <= 0) return removeFromCart(id);
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCart();
                updateCartIcon();
            }
        }

        window.removeFromCart = function (id) {
            let cart = JSON.parse(localStorage.getItem('cart'));
            cart = cart.filter(i => i.id != id);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
            updateCartIcon();
            Swal.fire({
                title: 'تم الحذف',
                icon: 'info',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
        }
    });
</script>

<?php include 'includes/footer.php'; ?>