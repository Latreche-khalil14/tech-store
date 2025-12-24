$(document).ready(function() {
    // دالة أمان لقراءة البيانات
    function safeParse(key) {
        const item = localStorage.getItem(key);
        try {
            return (item && item !== 'undefined' && item !== 'null') ? JSON.parse(item) : null;
        } catch (e) {
            localStorage.removeItem(key); // حذف البيانات الفاسدة
            return null;
        }
    }

    const user = safeParse('user');
    checkAuth(user);
    if ($('#featured-products').length) loadFeaturedProducts();
    if ($('#products-list').length) loadProducts();
    updateCartIcon();
    setupMobileMenu();

    $('#logout-btn, #mobile-logout-btn').on('click', function() {
        localStorage.removeItem('user');
        localStorage.removeItem('cart'); // تنظيف السلة عند الخروج
        $.post('../backend/api/auth/logout.php', function() {
            window.location.replace('login.php');
        });
    });
});

function checkAuth(user) {
    if (!user) {
        try {
            const item = localStorage.getItem('user');
            user = (item && item !== 'undefined') ? JSON.parse(item) : null;
        } catch (e) { user = null; }
    }

    const $userNavItem = $('#user-nav-item');

    if (user) {
        let adminLink = '';
        if (user.role && user.role.toLowerCase() === 'admin') {
            adminLink = `<a href="../backend/admin/index.php" class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition-all font-bold text-xs shadow-lg shadow-blue-600/20 whitespace-nowrap mr-3">لوحة التحكم ⚙️</a>`;
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
        
        // Mobile UI
        $('#mobile-login-btn, #mobile-register-btn').addClass('hidden');
        $('#mobile-logout-btn').removeClass('hidden').addClass('flex');
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
        
        // Mobile UI
        $('#mobile-login-btn, #mobile-register-btn').removeClass('hidden');
        $('#mobile-logout-btn').addClass('hidden').removeClass('flex');
    }
}

function loadFeaturedProducts() {
    fetchProducts('../backend/api/products/get_all.php?limit=4', '#featured-products');
}

function loadProducts() {
    const category = $('#category-filter').val() || '';
    const search = $('#search-input').val() || '';
    fetchProducts(`../backend/api/products/get_all.php?category=${category}&search=${search}`, '#products-list');
}

// Search & Filter Listeners
$(document).on('input', '#search-input', function() {
    loadProducts();
});
$(document).on('change', '#category-filter', function() {
    loadProducts();
});

function fetchProducts(url, containerId) {
    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
            if (response.success) {
                const products = response.data.products;
                let html = '';
                
                if (products.length === 0) {
                    $('#no-products').removeClass('hidden');
                    $(containerId).html('');
                    return;
                }

                $('#no-products').addClass('hidden');
                products.forEach(p => {
                    const isNew = Math.random() > 0.7; // Randomly badge some products
                    html += `
                        <div class="group bg-white rounded-[2.5rem] p-6 hover:shadow-soft transition-all duration-500 border border-slate-100 overflow-hidden relative" data-aos="fade-up">
                            
                            <!-- Premium Image Container -->
                            <div class="bg-slate-50 h-64 rounded-[2rem] mb-6 flex items-center justify-center relative overflow-hidden group-hover:bg-primary/5 transition-all duration-500">
                                <div class="absolute inset-0 bg-gradient-to-tr from-white/0 to-white/40 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <img src="${p.image_url}" onerror="this.src=PLACEHOLDER_IMAGE" 
                                    class="h-full w-full object-contain p-6 group-hover:scale-110 transition-transform duration-700 ease-out z-10">
                                
                                <!-- Floating Badges -->
                                ${isNew ? `
                                <div class="absolute top-4 right-4 bg-gradient-to-r from-secondary to-pink-500 text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-lg z-20 animate-pulse">
                                    NEW
                                </div>` : ''}
                                
                                <button class="absolute bottom-4 right-4 w-12 h-12 bg-white/90 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-lg text-slate-400 hover:text-red-500 hover:scale-110 transition-all z-20 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 duration-300 border border-white/50">
                                    ❤️
                                </button>
                            </div>

                            <!-- Product Info -->
                            <div class="space-y-4 relative z-10">
                                <div class="flex justify-between items-start">
                                    <span class="text-[10px] font-black text-primary uppercase tracking-[0.2em] bg-primary/5 px-4 py-1.5 rounded-full border border-primary/10">
                                        ${p.category_name}
                                    </span>
                                    <div class="flex -space-x-1">
                                        <div class="w-3 h-3 rounded-full border-2 border-white bg-secondary"></div>
                                        <div class="w-3 h-3 rounded-full border-2 border-white bg-accent"></div>
                                    </div>
                                </div>
                                
                                <h3 class="font-black text-slate-800 text-xl truncate leading-tight group-hover:text-primary transition-colors">
                                    ${p.name}
                                </h3>
                                
                                <div class="flex justify-between items-center pt-4 border-t border-slate-50 mt-4">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">السعر</span>
                                        <p class="text-3xl font-black text-slate-900 tracking-tighter">
                                            ${p.price} <span class="text-sm font-bold text-primary">$</span>
                                        </p>
                                    </div>
                                    
                                    <button class="bg-gradient-to-r from-primary to-indigo-600 text-white w-14 h-14 rounded-2xl hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 active:scale-95 flex items-center justify-center group/btn relative overflow-hidden" 
                                            onclick="event.stopPropagation(); addToCart(${p.id}, '${p.name.replace(/'/g, "\\'")}')">
                                        <span class="relative z-10 text-xl group-hover/btn:scale-110 transition-transform">🛒</span>
                                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                                    </button>
                                </div>
                            </div>
                            
                            <a href="product-details.php?id=${p.id}" class="absolute inset-0 z-0"></a>
                        </div>
                    `;
                });

                $(containerId).html(html);
                if(typeof AOS !== 'undefined') AOS.refresh();
            }
        }
    });
}

function addToCart(productId, productName) {
    productId = parseInt(productId);
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let item = cart.find(i => parseInt(i.id) === productId);
    
    if (item) {
        item.quantity = parseInt(item.quantity) + 1;
    } else {
        cart.push({ id: productId, quantity: 1 });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartIcon();

    Swal.fire({
        title: 'تمت الإضافة!',
        text: `تمت إضافة ${productName || 'المنتج'} إلى سلة التسوق`,
        icon: 'success',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
}

function updateCartIcon() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let count = cart.reduce((total, item) => total + item.quantity, 0);
    
    // تحديث العداد في الكمبيوتر والجوال
    $('#cart-count').text(count);
    $('.mobile-menu .bg-secondary').text(count); // تحديث عداد الجوال
}


function setupMobileMenu() {
    const $menu = $('#mobile-menu');
    const $overlay = $('#mobile-menu-overlay');
    const $btn = $('#mobile-menu-btn');
    const $closeBtn = $('#close-mobile-menu');

    function toggleMenu() {
        $menu.toggleClass('active');
        $overlay.toggleClass('active');
        $btn.toggleClass('active');
        $('body').css('overflow', $menu.hasClass('active') ? 'hidden' : '');
    }

    $btn.on('click', toggleMenu);
    $overlay.on('click', toggleMenu);
    $closeBtn.on('click', toggleMenu);
}
