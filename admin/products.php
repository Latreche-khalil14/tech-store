<?php
require_once '../config/database.php';
require_once '../config/helpers.php';
protectAdminSecret();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إدارة المنتجات - Tech Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Tajawal:wght@400;700&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Outfit', 'Tajawal', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-slate-900 text-white p-6 hidden md:flex flex-col fixed inset-y-0 right-0 z-50">
        <div class="text-2xl font-black mb-12 text-blue-400">🖥️ إدارة المتجر</div>
        <nav class="space-y-2 flex-grow">
            <a href="index.php"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition text-slate-400 hover:text-white"><span>📊</span>
                الإحصائيات</a>
            <a href="products.php"
                class="bg-blue-600 text-white flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg"><span>📦</span>
                المنتجات</a>
            <a href="../index.php"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition text-slate-400 hover:text-white"><span>🌐</span>
                عرض المتجر</a>
        </nav>
        <button onclick="logout()"
            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-500/10 text-red-400 transition border border-red-500/20 mt-auto"><span>🚪</span>
            خروج</button>
    </div>

    <!-- Content -->
    <div class="flex-1 md:pr-64 p-8">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-800">إدارة المنتجات</h1>
                <p class="text-slate-500">أضف، عدل، أو احذف منتجاتك</p>
            </div>
            <button onclick="$('#addModal').removeClass('hidden').addClass('flex')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4 rounded-2xl font-bold shadow-xl shadow-blue-500/20 transition transform hover:-translate-y-1">
                ➕ إضافة منتج جديد
            </button>
        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
            <table class="w-full text-right divide-y divide-slate-50">
                <thead class="bg-slate-50 text-slate-500 text-xs font-black uppercase">
                    <tr>
                        <th class="p-6">المنتج</th>
                        <th class="p-6 text-center">السعر</th>
                        <th class="p-6 text-center">القسم</th>
                        <th class="p-6 text-center">المخزون</th>
                        <th class="p-6 text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="products-table" class="divide-y divide-slate-50">
                    <!-- Dynamic -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modern Add Modal -->
    <div id="addModal"
        class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] justify-center items-center p-6">
        <div class="bg-white w-full max-w-lg rounded-[2.5rem] p-10 shadow-2xl relative">
            <button onclick="$('#addModal').addClass('hidden').removeClass('flex')"
                class="absolute top-6 left-6 text-slate-300 hover:text-slate-600 text-2xl">✕</button>
            <h2 class="text-2xl font-black text-slate-800 mb-8">إضافة منتج جديد</h2>

            <form id="add-product-form" class="space-y-5">
                <div class="space-y-2">
                    <label class="font-bold text-slate-600 mr-2 text-sm">اسم المنتج</label>
                    <input type="text" id="p-name" required
                        class="w-full px-5 py-3.5 bg-slate-50 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none border-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="font-bold text-slate-600 mr-2 text-sm">السعر ($)</label>
                        <input type="number" step="0.01" id="p-price" required
                            class="w-full px-5 py-3.5 bg-slate-50 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none border-none">
                    </div>
                    <div class="space-y-2">
                        <label class="font-bold text-slate-600 mr-2 text-sm">المخزون</label>
                        <input type="number" id="p-stock" required
                            class="w-full px-5 py-3.5 bg-slate-50 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none border-none">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="font-bold text-slate-600 mr-2 text-sm">القسم</label>
                    <select id="p-category" required
                        class="w-full px-5 py-3.5 bg-slate-50 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none border-none cursor-pointer">
                        <option value="1">لابتوب</option>
                        <option value="2">كمبيوتر مكتبي</option>
                        <option value="3">شاشات</option>
                        <option value="4">الملحقات</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="font-bold text-slate-600 mr-2 text-sm">الوصف</label>
                    <textarea id="p-desc" required rows="3"
                        class="w-full px-5 py-3.5 bg-slate-50 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none border-none"></textarea>
                </div>
                <button type="submit"
                    class="w-full py-5 bg-slate-900 border-2 border-slate-900 text-white font-black rounded-2xl hover:bg-blue-600 hover:border-blue-600 transition shadow-xl mt-4 transform hover:-translate-y-1">
                    حفظ المنتج الجديد
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal"
        class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] justify-center items-center p-6">
        <div class="bg-white w-full max-w-lg rounded-[2.5rem] p-10 shadow-2xl relative">
            <button onclick="$('#editModal').addClass('hidden').removeClass('flex')"
                class="absolute top-6 left-6 text-slate-300 hover:text-slate-600 text-2xl">✕</button>
            <h2 class="text-2xl font-black text-slate-800 mb-8">تعديل المنتج</h2>

            <form id="edit-product-form" class="space-y-5">
                <input type="hidden" id="edit-id">
                <div class="space-y-2">
                    <label class="font-bold text-slate-600 mr-2 text-sm">اسم المنتج</label>
                    <input type="text" id="edit-name" required
                        class="w-full px-5 py-3.5 bg-slate-50 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none border-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="font-bold text-slate-600 mr-2 text-sm">السعر ($)</label>
                        <input type="number" step="0.01" id="edit-price" required
                            class="w-full px-5 py-3.5 bg-slate-50 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none border-none">
                    </div>
                    <div class="space-y-2">
                        <label class="font-bold text-slate-600 mr-2 text-sm">المخزون</label>
                        <input type="number" id="edit-stock" required
                            class="w-full px-5 py-3.5 bg-slate-50 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none border-none">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="font-bold text-slate-600 mr-2 text-sm">القسم</label>
                    <select id="edit-category" required
                        class="w-full px-5 py-3.5 bg-slate-50 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none border-none cursor-pointer">
                        <option value="1">لابتوب</option>
                        <option value="2">كمبيوتر مكتبي</option>
                        <option value="3">شاشات</option>
                        <option value="4">الملحقات</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="font-bold text-slate-600 mr-2 text-sm">الوصف</label>
                    <textarea id="edit-desc" required rows="3"
                        class="w-full px-5 py-3.5 bg-slate-50 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none border-none"></textarea>
                </div>
                <button type="submit"
                    class="w-full py-5 bg-blue-600 border-2 border-blue-600 text-white font-black rounded-2xl hover:bg-blue-700 hover:border-blue-700 transition shadow-xl mt-4 transform hover:-translate-y-1">
                    تحديث المنتج
                </button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            loadProducts();
            $('#add-product-form').on('submit', function (e) {
                e.preventDefault();
                const data = {
                    name: $('#p-name').val(),
                    price: $('#p-price').val(),
                    category_id: $('#p-category').val(),
                    stock: $('#p-stock').val(),
                    description: $('#p-desc').val()
                };

                $.ajax({
                    url: '../api/admin/products_manage.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function (res) {
                        if (res.success) {
                            Swal.fire('تم!', 'أضيف المنتج بنجاح', 'success').then(() => location.reload());
                        }
                    }
                });
            });

            $('#edit-product-form').on('submit', function (e) {
                e.preventDefault();
                const data = {
                    id: $('#edit-id').val(),
                    name: $('#edit-name').val(),
                    price: $('#edit-price').val(),
                    category_id: $('#edit-category').val(),
                    stock: $('#edit-stock').val(),
                    description: $('#edit-desc').val()
                };

                $.ajax({
                    url: '../api/admin/products_manage.php',
                    method: 'PUT',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function (res) {
                        if (res.success) {
                            Swal.fire('تم!', 'تم تحديث المنتج بنجاح', 'success').then(() => location.reload());
                        }
                    }
                });
            });
        });

        function loadProducts() {
            $.get('../api/products/get_all.php?limit=100', function (res) {
                if (res.success) {
                    let html = '';
                    res.data.products.forEach(p => {
                        html += `
                            <tr class="hover:bg-slate-50 transition duration-150">
                                <td class="p-6">
                                    <div class="flex items-center gap-4 text-right">
                                        <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-xl shrink-0">🖼️</div>
                                        <div class="font-bold text-slate-800">${p.name}</div>
                                    </div>
                                </td>
                                <td class="p-6 text-center font-bold text-slate-900">${p.price} $</td>
                                <td class="p-6 text-center">
                                    <span class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-black rounded-full">${p.category_name}</span>
                                </td>
                                <td class="p-6 text-center text-slate-500 font-bold">${p.stock}</td>
                                <td class="p-6 text-center flex justify-center gap-2">
                                    <button onclick='openEditModal(${JSON.stringify(p).replace(/'/g, "&apos;")})' class="text-blue-600 hover:text-blue-800 font-black p-2 transition">تعديل</button>
                                    <button onclick="deleteProduct(${p.id})" class="text-red-400 hover:text-red-600 font-black p-2 transition">حذف</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#products-table').html(html);
                }
            });
        }

        function openEditModal(product) {
            $('#edit-id').val(product.id);
            $('#edit-name').val(product.name);
            $('#edit-price').val(product.price);
            $('#edit-stock').val(product.stock);
            $('#edit-category').val(product.category_id);
            $('#edit-desc').val(product.description);
            $('#editModal').removeClass('hidden').addClass('flex');
        }

        function deleteProduct(id) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من استرجاع هذا المنتج!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#e1e7ef',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `../api/admin/products_manage.php?id=${id}`,
                        method: 'DELETE',
                        success: function (res) {
                            if (res.success) {
                                Swal.fire('تم!', 'حذف المنتج', 'success');
                                loadProducts();
                            }
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>