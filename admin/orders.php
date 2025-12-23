<?php
require_once '../config/database.php';
require_once '../config/helpers.php';
protectAdminSecret();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إدارة الطلبات - Tech Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Outfit', 'Tajawal', sans-serif; }
        .sidebar-link.active { background: #2563eb; color: white; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); }
    </style>
</head>

<body class="bg-slate-50 flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-slate-900 text-white p-6 hidden md:flex flex-col fixed inset-y-0 right-0 z-50 shadow-2xl">
        <div class="text-2xl font-black mb-12 bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">
            🖥️ إدارة المتجر
        </div>

        <nav class="space-y-2 flex-grow">
            <a href="index.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-slate-400 hover:text-white">
                <span>📊</span> الإحصائيات
            </a>
            <a href="#orders" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-xl transition-all">
                <span>🛒</span> الطلبات
            </a>
            <a href="products.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-slate-400 hover:text-white">
                <span>📦</span> المنتجات
            </a>
            <a href="../index.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-slate-400 hover:text-white">
                <span>🌐</span> عرض المتجر
            </a>
        </nav>

        <button onclick="logout()" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-500/10 text-red-400 transition-all mt-auto border border-red-500/20">
            <span>🚪</span> تسجيل الخروج
        </button>
    </div>

    <!-- Main Content -->
    <div class="flex-1 md:pr-64">
        <div class="p-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                <div>
                    <h1 class="text-3xl font-black text-slate-800">إدارة الطلبات</h1>
                    <p class="text-slate-500">عرض وإدارة جميع الطلبات</p>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
                <div class="p-8 border-b border-slate-50">
                    <h2 class="text-xl font-black text-slate-800">جميع الطلبات</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-sm uppercase">
                                <th class="p-5 font-black">رقم الطلب</th>
                                <th class="p-5 font-black">العميل</th>
                                <th class="p-5 font-black text-center">الإجمالي</th>
                                <th class="p-5 font-black text-center">الحالة</th>
                                <th class="p-5 font-black text-center">التاريخ</th>
                                <th class="p-5 font-black text-center">التفاصيل</th>
                            </tr>
                        </thead>
                        <tbody id="orders-table" class="divide-y divide-slate-50 font-medium">
                            <!-- JS Items -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details Modal -->
    <div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4 max-h-[80vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-black text-slate-800">تفاصيل الطلب</h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 text-2xl">&times;</button>
            </div>
            <div id="orderDetails" class="space-y-4">
                <!-- Details will be loaded here -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            loadAllOrders();

            function loadAllOrders() {
                $.get('../api/admin/orders.php', function(res) {
                    if (res.success) {
                        let html = '';
                        res.data.orders.forEach(o => {
                            const statusColor = o.status === 'pending' ? 'bg-amber-100 text-amber-600' : o.status === 'processing' ? 'bg-blue-100 text-blue-600' : o.status === 'shipped' ? 'bg-purple-100 text-purple-600' : o.status === 'delivered' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600';
                            html += `
                                <tr class="hover:bg-slate-50/50 transition duration-200">
                                    <td class="p-5 font-bold text-slate-700">#${o.id}</td>
                                    <td class="p-5">${o.username}</td>
                                    <td class="p-5 text-center font-bold text-slate-900">${o.total_price} $</td>
                                    <td class="p-5 text-center">
                                        <span class="px-3 py-1.5 rounded-full text-xs font-black ${statusColor}">
                                            ${o.status}
                                        </span>
                                    </td>
                                    <td class="p-5 text-center">${new Date(o.created_at).toLocaleDateString('ar')}</td>
                                    <td class="p-5 text-center">
                                        <button onclick="viewOrderDetails(${o.id})" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-sm font-bold transition">
                                            عرض
                                        </button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#orders-table').html(html);
                    }
                });
            }

            window.viewOrderDetails = function(orderId) {
                $.get(`../api/orders/get_details.php?id=${orderId}`, function(res) {
                    if (res.success) {
                        const order = res.data.order;
                        let html = `
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div><strong>رقم الطلب:</strong> #${order.id}</div>
                                <div><strong>العميل:</strong> ${order.username}</div>
                                <div><strong>البريد:</strong> ${order.email}</div>
                                <div><strong>الهاتف:</strong> ${order.phone}</div>
                                <div><strong>الإجمالي:</strong> ${order.total_price} $</div>
                                <div><strong>الحالة:</strong> ${order.status}</div>
                                <div><strong>تاريخ الطلب:</strong> ${order.created_at}</div>
                                <div><strong>طريقة الدفع:</strong> ${order.payment_method}</div>
                            </div>
                            <div class="mb-4">
                                <strong>عنوان الشحن:</strong><br>
                                <div class="bg-slate-50 p-3 rounded-lg">${order.shipping_address}</div>
                            </div>
                            <div>
                                <strong>ملاحظات:</strong><br>
                                تفاصيل المنتجات ستُضاف لاحقاً في نظام الطلبات الكامل.
                            </div>
                        `;
                        $('#orderDetails').html(html);
                        $('#orderModal').removeClass('hidden');
                    } else {
                        alert('فشل في جلب تفاصيل الطلب');
                    }
                });
            };

            window.closeModal = function() {
                $('#orderModal').addClass('hidden');
            };
        });

        function logout() {
            localStorage.removeItem('user');
            location.href = '../login.php';
        }
    </script>
</body>

</html>