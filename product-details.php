<?php include 'includes/header.php'; ?>
<title>تفاصيل المنتج - Tech Store</title>

<div class="container mx-auto px-6 py-12" id="product-details-container">
    <!-- Dynamic Content from AJAX -->
    <div class="animate-pulse flex flex-col md:flex-row gap-12">
        <div class="flex-1 bg-slate-200 h-[400px] rounded-3xl"></div>
        <div class="flex-1 space-y-6 pt-10">
            <div class="h-8 bg-slate-200 w-3/4 rounded-lg"></div>
            <div class="h-4 bg-slate-200 w-1/4 rounded-lg"></div>
            <div class="h-24 bg-slate-200 w-full rounded-lg"></div>
            <div class="h-12 bg-slate-200 w-1/3 rounded-lg"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('id');

        if (!productId) {
            location.href = 'products.php';
            return;
        }

        $.get(`api/products/get_by_id.php?id=${productId}`, function (res) {
            if (res.success) {
                const p = res.data;
                const safeName = p.name.replace(/'/g, "\\'"); // Prevent quote breaking

                const html = `
                    <div class="flex flex-col lg:flex-row gap-16 lg:gap-24 items-start" data-aos="fade-up">
                        
                        <!-- Premium Image Section -->
                        <div class="w-full lg:w-1/2 sticky top-32">
                            <div class="bg-white rounded-[3rem] shadow-soft p-12 h-[550px] flex items-center justify-center relative overflow-hidden group border border-slate-100">
                                <div class="absolute inset-0 bg-gradient-to-br from-slate-50/50 to-white -z-10"></div>
                                
                                <!-- Decorative Elements -->
                                <div class="absolute top-10 left-10 w-32 h-32 bg-primary/5 rounded-full blur-3xl"></div>
                                <div class="absolute bottom-10 right-10 w-32 h-32 bg-secondary/5 rounded-full blur-3xl"></div>

                                <img src="${p.image_url}" onerror="this.src=PLACEHOLDER_IMAGE" 
                                    class="max-h-full max-w-full object-contain drop-shadow-2xl group-hover:scale-105 transition-transform duration-1000 ease-out">
                                
                                <div class="absolute top-8 left-8 flex flex-col gap-2">
                                    <div class="bg-white/80 backdrop-blur-md px-4 py-2 rounded-2xl shadow-sm border border-white/50">
                                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Category</span>
                                        <span class="block text-sm font-black text-primary uppercase tracking-wider">${p.category_name || 'Premium Tech'}</span>
                                    </div>
                                    <div class="bg-blue-600 text-white px-4 py-2 rounded-2xl shadow-lg shadow-blue-600/20 text-[10px] font-black tracking-[0.1em] uppercase">
                                        Original Product
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Premium Info Section -->
                        <div class="w-full lg:w-1/2 space-y-10">
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <span class="w-12 h-1 bg-primary rounded-full"></span>
                                    <span class="text-primary font-black text-xs uppercase tracking-[0.3em]">Hardware & Tech</span>
                                </div>
                                <h1 class="text-5xl lg:text-6xl font-black text-slate-900 leading-tight tracking-tight">${p.name}</h1>
                                <div class="flex items-center gap-6">
                                    <div class="flex items-center gap-2 bg-green-50 text-green-600 px-4 py-2 rounded-xl font-black text-xs border border-green-100">
                                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                        جاهز للشحن
                                    </div>
                                    <div class="flex items-center gap-1 text-yellow-400">
                                        <span class="text-lg">★★★★★</span>
                                        <span class="text-slate-400 text-xs font-bold">(4.9/5) مراجعات العملاء</span>
                                    </div>
                                </div>
                            </div>

                            <p class="text-slate-500 text-xl leading-relaxed font-medium border-r-4 border-primary/20 pr-8 italic">
                                ${p.description || 'هذا المنتج يمثل قمة التكنولوجيا في فئته، مصمم خصيصاً للمحترفين والباحثين عن الأداء الفائق.'}
                            </p>

                            <!-- Pricing Card -->
                            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-soft relative overflow-hidden group">
                                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-accent"></div>
                                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-8">
                                    <div class="space-y-1">
                                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">السعر الحصري</span>
                                        <div class="flex items-baseline gap-2">
                                            <span class="text-6xl font-black text-slate-900 tracking-tighter">${p.price}</span>
                                            <span class="text-2xl font-black text-primary">$</span>
                                        </div>
                                    </div>

                                    <div class="flex gap-4 flex-1 sm:flex-none">
                                        <button onclick="addToCart(${p.id}, '${safeName}')" 
                                            class="flex-1 sm:px-12 py-5 bg-gradient-to-r from-primary to-indigo-600 text-white rounded-2xl font-black text-xl hover:shadow-2xl hover:shadow-primary/40 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-4 group/btn">
                                            <span>أضف للسلة</span>
                                            <span class="text-2xl group-hover/btn:rotate-12 transition-transform">🛒</span>
                                        </button>
                                        
                                        <button class="w-16 h-16 bg-slate-50 text-2xl rounded-2xl border border-slate-100 hover:bg-red-50 hover:text-red-500 hover:border-red-100 transition-all flex items-center justify-center group/fav">
                                           <span class="group-hover/fav:scale-120 transition-transform">❤️</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Trust Badges -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                                <div class="flex items-center gap-5 bg-white p-6 rounded-[2rem] border border-slate-50 hover:border-primary/20 hover:shadow-md transition-all">
                                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm">🛡️</div>
                                    <div>
                                        <p class="font-black text-slate-800">ضمان ذهبي</p>
                                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">سنتين ضد عيوب الصناعة</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-5 bg-white p-6 rounded-[2rem] border border-slate-50 hover:border-primary/20 hover:shadow-md transition-all">
                                    <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm">🚀</div>
                                    <div>
                                        <p class="font-black text-slate-800">شحن آمن</p>
                                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">توصيل وحماية فائقة</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                $('#product-details-container').html(html);
            } else {
                Swal.fire('خطأ', 'المنتج غير موجود', 'error').then(() => {
                    location.href = 'products.php';
                });
            }
        });
    });
</script>

<?php include 'includes/footer.php'; ?>