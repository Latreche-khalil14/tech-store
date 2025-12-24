<?php include 'includes/header.php'; ?>
<title>تسجيل الدخول - Tech Store</title>

<script>
    // Handle redirect parameter
    const urlParams = new URLSearchParams(window.location.search);
    const redirect = urlParams.get('redirect');
    if (redirect) {
        localStorage.setItem('returnUrl', redirect);
    }
</script>

<div class="min-h-screen flex items-center justify-center py-20 px-6 relative overflow-hidden bg-background">
    <!-- Animated Background Decor -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div
            class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/20 rounded-full blur-[120px] mix-blend-multiply animate-blob">
        </div>
        <div
            class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-secondary/20 rounded-full blur-[120px] mix-blend-multiply animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute top-[40%] left-[40%] w-[40%] h-[40%] bg-accent/20 rounded-full blur-[100px] mix-blend-multiply animate-blob animation-delay-4000">
        </div>
    </div>

    <!-- Main Card -->
    <div class="w-full max-w-lg bg-white/80 backdrop-blur-xl rounded-[3rem] shadow-soft border border-white/50 relative z-10 overflow-hidden"
        data-aos="zoom-in" data-aos-duration="600">

        <!-- Header -->
        <div class="text-center pt-10 pb-6 px-10">
            <div
                class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-tr from-primary to-accent mb-6 shadow-lg shadow-primary/30 transform rotate-3 hover:rotate-6 transition-transform">
                <span class="text-3xl">🔐</span>
            </div>
            <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tight mb-2">مرحباً بك مجدداً</h1>
            <p class="text-slate-500 font-medium text-lg">سجل دخولك لمتابعة طلباتك</p>
        </div>

        <!-- Tabs -->
        <div class="px-10 mb-8">
            <div class="bg-slate-100/50 p-1.5 rounded-2xl flex relative">
                <button
                    class="tab active flex-1 py-3.5 text-center font-bold text-sm rounded-xl transition-all duration-300 relative z-10"
                    data-tab="login">
                    تسجيل دخول
                </button>
                <button
                    class="tab flex-1 py-3.5 text-center font-bold text-sm rounded-xl transition-all duration-300 relative z-10"
                    data-tab="register">
                    حساب جديد
                </button>
            </div>
        </div>

        <!-- Custom Styles for Tabs -->
        <style>
            .tab {
                color: #64748b;
            }

            .tab:hover {
                color: #1e293b;
            }

            .tab.active {
                background: white;
                color: #4f46e5;
                box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.1);
            }

            .form-section {
                display: none;
                animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .form-section.active {
                display: block;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>

        <!-- Forms Container -->
        <div class="px-10 pb-12">

            <!-- Login Form -->
            <div id="login-form" class="form-section active">
                <form id="loginForm" class="space-y-5">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 mr-1">البريد الإلكتروني</label>
                        <div class="relative group">
                            <input type="email" id="login-email" required placeholder="example@mail.com"
                                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-primary/50 focus:ring-4 focus:ring-primary/10 transition-all outline-none font-bold text-slate-700 placeholder-slate-400">
                            <span
                                class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-xl group-focus-within:text-primary transition-colors">📧</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center px-1">
                            <label class="block text-sm font-bold text-slate-700">كلمة المرور</label>
                            <a href="#" class="text-xs font-bold text-primary hover:text-accent transition-colors">نسيت
                                كلمة المرور؟</a>
                        </div>
                        <div class="relative group">
                            <input type="password" id="login-password" required placeholder="••••••••"
                                class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-primary/50 focus:ring-4 focus:ring-primary/10 transition-all outline-none font-bold text-slate-700 placeholder-slate-400">
                            <span
                                class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-xl group-focus-within:text-primary transition-colors">🔒</span>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-black text-lg rounded-2xl shadow-xl shadow-blue-600/20 hover:shadow-blue-600/40 transition-all transform hover:-translate-y-1 active:scale-95 flex justify-center items-center gap-2 group">
                        <span>دخول للمتجر</span>
                        <span class="group-hover:-translate-x-1 transition-transform">🚀</span>
                    </button>
                </form>
            </div>

            <!-- Register Form -->
            <div id="register-form" class="form-section">
                <form id="registerForm" class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-bold text-slate-700 mr-1">الاسم الكامل</label>
                        <div class="relative group">
                            <input type="text" id="reg-fullname" required placeholder="مثال: خليل ابراهيم"
                                class="w-full px-5 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-primary/50 transition-all outline-none font-bold text-slate-700">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">👤</span>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-bold text-slate-700 mr-1">اسم المستخدم</label>
                        <div class="relative group">
                            <input type="text" id="reg-username" required placeholder="khalil123"
                                class="w-full px-5 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-primary/50 transition-all outline-none font-bold text-slate-700">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">🆔</span>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-bold text-slate-700 mr-1">البريد الإلكتروني</label>
                        <div class="relative group">
                            <input type="email" id="reg-email" required placeholder="abc@example.com"
                                class="w-full px-5 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-primary/50 transition-all outline-none font-bold text-slate-700">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">📧</span>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-bold text-slate-700 mr-1">رقم الهاتف</label>
                        <div class="relative group">
                            <input type="tel" id="reg-phone" required placeholder="05XXXXXXXX"
                                class="w-full px-5 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-primary/50 transition-all outline-none font-bold text-slate-700">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">📱</span>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-sm font-bold text-slate-700 mr-1">كلمة المرور</label>
                        <div class="relative group">
                            <input type="password" id="reg-password" required placeholder="••••••••"
                                class="w-full px-5 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-primary/50 transition-all outline-none font-bold text-slate-700">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">🔒</span>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-black text-lg rounded-2xl shadow-xl shadow-blue-600/20 hover:shadow-blue-600/40 transition-all transform hover:-translate-y-1 active:scale-95 mt-4 flex justify-center items-center gap-2 group">
                        <span>إنشاء حساب</span>
                        <span class="group-hover:-translate-x-1 transition-transform">✨</span>
                    </button>
                </form>
            </div>


        </div>
    </div>
</div>

<script src="assets/js/auth.js?v=1.2"></script>
<?php include 'includes/footer.php'; ?>
