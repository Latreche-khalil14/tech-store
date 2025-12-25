/**
 * Product Loading & Rendering Logic
 */

function loadFeaturedProducts() {
  if ($("#featured-products").length) {
    fetchProducts("../api/products/get_all.php?limit=4", "#featured-products");
  }
}

function loadProducts() {
  if ($("#products-list").length) {
    const category = $("#category-filter").val() || "";
    const search = $("#search-input").val() || "";
    fetchProducts(
      `../api/products/get_all.php?category=${category}&search=${search}`,
      "#products-list"
    );
  }
}

function fetchProducts(url, containerId) {
  $.ajax({
    url: url,
    method: "GET",
    success: function (response) {
      if (response.success) {
        const products = response.data.products;
        let html = "";

        if (products.length === 0) {
          $("#no-products").removeClass("hidden");
          $(containerId).html("");
          return;
        }

        $("#no-products").addClass("hidden");
        products.forEach((p) => {
          const isNew = Math.random() > 0.7;
          html += `
                        <div class="group bg-white rounded-[2.5rem] p-6 hover:shadow-soft transition-all duration-500 border border-slate-100 overflow-hidden relative" data-aos="fade-up">
                            <div class="bg-slate-50 h-64 rounded-[2rem] mb-6 flex items-center justify-center relative overflow-hidden group-hover:bg-primary/5 transition-all duration-500">
                                <div class="absolute inset-0 bg-gradient-to-tr from-white/0 to-white/40 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <img src="${
                                  p.image_url
                                }" onerror="this.src=PLACEHOLDER_IMAGE" 
                                    class="h-full w-full object-contain p-6 group-hover:scale-110 transition-transform duration-700 ease-out z-10">
                                
                                ${
                                  isNew
                                    ? `
                                <div class="absolute top-4 right-4 bg-gradient-to-r from-secondary to-pink-500 text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-lg z-20 animate-pulse">
                                    NEW
                                </div>`
                                    : ""
                                }
                                
                                <button class="absolute bottom-4 right-4 w-12 h-12 bg-white/90 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-lg text-slate-400 hover:text-red-500 hover:scale-110 transition-all z-20 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 duration-300 border border-white/50">
                                    ❤️
                                </button>
                            </div>

                            <div class="space-y-4 relative z-10">
                                <div class="flex justify-between items-start">
                                    <span class="text-[10px] font-black text-primary uppercase tracking-[0.2em] bg-primary/5 px-4 py-1.5 rounded-full border border-primary/10">
                                        ${p.category_name}
                                    </span>
                                </div>
                                <h3 class="font-black text-slate-800 text-xl truncate leading-tight group-hover:text-primary transition-colors">
                                    ${p.name}
                                </h3>
                                <div class="flex justify-between items-center pt-4 border-t border-slate-50 mt-4">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">السعر</span>
                                        <p class="text-3xl font-black text-slate-900 tracking-tighter">
                                            ${
                                              p.price
                                            } <span class="text-sm font-bold text-primary">$</span>
                                        </p>
                                    </div>
                                    <button class="bg-gradient-to-r from-primary to-indigo-600 text-white w-14 h-14 rounded-2xl hover:shadow-lg hover:shadow-primary/30 transition-all duration-300 active:scale-95 flex items-center justify-center group/btn relative overflow-hidden" 
                                            onclick="event.stopPropagation(); addToCart(${
                                              p.id
                                            }, '${p.name.replace(
            /'/g,
            "\\'"
          )}')">
                                        <span class="relative z-10 text-xl group-hover/btn:scale-110 transition-transform">🛒</span>
                                    </button>
                                </div>
                            </div>
                            <a href="product-details.php?id=${
                              p.id
                            }" class="absolute inset-0 z-0"></a>
                        </div>
                    `;
        });

        $(containerId).html(html);
        if (typeof AOS !== "undefined") AOS.refresh();
      }
    },
  });
}
