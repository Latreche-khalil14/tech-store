<?php
require_once '../config/database.php';
require_once '../config/helpers.php';
protectAdminSecret();
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<!-- Main Content -->
<div class="flex-1 md:pr-64">
    <div class="p-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-black text-slate-800">لوحة التحكم</h1>
                <p class="text-slate-500">نظرة عامة على نشاط المتجر اليوم</p>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex justify-between items-start mb-4">
                    <span class="p-3 bg-blue-50 text-blue-600 rounded-2xl text-2xl">📥</span>
                    <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">+12%</span>
                </div>
                <div class="text-slate-500 text-sm font-bold">إجمالي الطلبات</div>
                <div id="stat-orders" class="text-3xl font-black mt-1 text-slate-800">0</div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex justify-between items-start mb-4">
                    <span class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl text-2xl">💰</span>
                </div>
                <div class="text-slate-500 text-sm font-bold">الإيرادات</div>
                <div id="stat-revenue" class="text-3xl font-black mt-1 text-slate-800">0 $</div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex justify-between items-start mb-4">
                    <span class="p-3 bg-amber-50 text-amber-600 rounded-2xl text-2xl">📦</span>
                </div>
                <div class="text-slate-500 text-sm font-bold">المنتجات</div>
                <div id="stat-products" class="text-3xl font-black mt-1 text-slate-800">0</div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <div class="flex justify-between items-start mb-4">
                    <span class="p-3 bg-purple-50 text-purple-600 rounded-2xl text-2xl">👥</span>
                </div>
                <div class="text-slate-500 text-sm font-bold">العملاء</div>
                <div id="stat-users" class="text-3xl font-black mt-1 text-slate-800">0</div>
            </div>
        </div>

        <!-- Latest Orders Table -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h2 class="text-xl font-black text-slate-800">آخر العمليات</h2>
                <button class="text-blue-600 font-bold hover:underline">عرض الكل</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-sm uppercase">
                            <th class="p-5 font-black">رقم الطلب</th>
                            <th class="p-5 font-black">العميل</th>
                            <th class="p-5 font-black text-center">الإجمالي</th>
                            <th class="p-5 font-black text-center">الحالة</th>
                            <th class="p-5 font-black text-center">التفاصيل</th>
                        </tr>
                    </thead>
                    <tbody id="latest-orders-table" class="divide-y divide-slate-50 font-medium">
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

<script>
    $(document).ready(function () {
        $.get('../api/admin/stats.php', function (res) {
            if (res.success) {
                $('#stat-orders').text(res.data.stats.orders);
                $('#stat-revenue').text(res.data.stats.revenue);
                $('#stat-products').text(res.data.stats.products);
                $('#stat-users').text(res.data.stats.users);

                let html = '';
                res.data.latestOrders.forEach(o => {
                    const statusColor = o.status === 'pending' ? 'bg-amber-100 text-amber-600' : 'bg-green-100 text-green-600';
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
                            <td class="p-5 text-center">
                                <button onclick="viewOrderDetails(${o.id})" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-sm font-bold transition">
                                    عرض
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $('#latest-orders-table').html(html);
            }
        });
    });

    function viewOrderDetails(orderId) {
        $.get(`../api/orders/get_details.php?id=${orderId}`, function (res) {
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
                    </div>
                `;
                $('#orderDetails').html(html);
                $('#orderModal').removeClass('hidden');
            }
        });
    }
</script>

<?php include 'includes/footer.php'; ?>