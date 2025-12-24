<?php include 'includes/header.php'; ?>

<!-- Hero Section with Intelligent Particles -->
<section id="hero" class="relative h-[90vh] flex items-center justify-center overflow-hidden bg-white text-slate-900">

    <!-- TSParticles Container -->
    <div id="tsparticles" class="absolute inset-0 z-0 text-slate-400"></div>

    <!-- Background Gradients (Subtle) -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div
            class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] bg-primary/20 blur-[120px] rounded-full mix-blend-multiply opacity-70 animate-blob">
        </div>
        <div
            class="absolute -bottom-[20%] -right-[10%] w-[50%] h-[50%] bg-secondary/20 blur-[120px] rounded-full mix-blend-multiply opacity-70 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute top-[20%] left-[20%] w-[40%] h-[40%] bg-accent/20 blur-[100px] rounded-full mix-blend-multiply opacity-70 animate-blob animation-delay-4000">
        </div>
    </div>

    <!-- Content -->
    <div class="container relative z-10 text-center px-4" data-aos="fade-up" data-aos-duration="1000">
        <div
            class="inline-flex items-center gap-2 px-4 py-2 mb-8 rounded-full bg-white/80 border border-slate-200 shadow-sm backdrop-blur-md">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
            </span>
            <span class="text-xs font-bold tracking-wide uppercase text-slate-600">
                ....مستقبل التسوق التقني
            </span>
        </div>

        <h1 class="text-7xl md:text-9xl font-black mb-6 leading-tight tracking-tighter text-slate-900 drop-shadow-sm">
            <span
                class="bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-primary to-slate-800">ابتكار</span>
            <br>بلا حدود
        </h1>

        <p class="text-slate-500 text-xl md:text-2xl max-w-2xl mx-auto mb-10 font-medium leading-relaxed">
            منصة متكاملة تجمع بين قوة الأداء وجمال التصميم.
            <span class="text-primary font-bold">كل ما تحتاجه</span> لبناء مساحة عمل أحلامك.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="products.php"
                class="group relative px-10 py-5 bg-blue-600 text-white overflow-hidden rounded-full transition-all duration-300 hover:shadow-2xl hover:shadow-blue-600/30 transform hover:-translate-y-1">
                <span class="relative z-10 font-bold text-lg flex items-center gap-3">
                    تصفح المنتجات
                    <span class="group-hover:translate-x-[-5px] transition-transform">←</span>
                </span>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-primary to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </a>
            <a href="#featured"
                class="px-10 py-5 bg-white text-slate-700 font-bold text-lg rounded-full border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all shadow-sm hover:shadow-md">
                شاهد العروض
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        await tsParticles.load("tsparticles", {
            fullScreen: { enable: false },
            background: { color: "transparent" },
            interactivity: {
                events: {
                    onHover: {
                        enable: true,
                        mode: "grab" // إمساك النقاط عند المرور (تأثير تفاعلي تقني)
                    },
                    onClick: {
                        enable: true,
                        mode: "push"
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 200,
                        links: {
                            opacity: 0.8
                        }
                    },
                    push: {
                        quantity: 4
                    }
                }
            },
            particles: {
                color: {
                    value: ["#4f46e5", "#06b6d4"] // Indigo, Cyan (Tech Colors)
                },
                links: {
                    enable: true, // تفعيل الروابط (شبكة تقنية)
                    distance: 150,
                    color: "#94a3b8", // لون رمادي فاتح للروابط
                    opacity: 0.3,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 1.5,
                    direction: "none",
                    random: false,
                    straight: false,
                    outModes: "bounce",
                    attract: {
                        enable: false,
                        rotateX: 600,
                        rotateY: 1200
                    }
                },
                number: {
                    value: 80, // زيادة العدد لتكوين شبكة
                    density: {
                        enable: true,
                        area: 800
                    }
                },
                opacity: {
                    value: 0.6,
                    random: false,
                    animation: {
                        enable: false
                    }
                },
                shape: {
                    type: ["circle", "triangle"] // أشكال هندسية بسيطة
                },
                size: {
                    value: { min: 1, max: 3 }, // نقاط دقيقة جداً
                    random: true,
                    animation: {
                        enable: false
                    }
                }
            },
            detectRetina: true
        });
    });
</script>

<!-- Features Section -->
<section class="py-20 bg-background relative overflow-hidden">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-soft border border-white/50 hover:-translate-y-2 transition-all duration-300 group"
                data-aos="fade-up">
                <div
                    class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-slate-800 mb-3">شحن فائق السرعة</h3>
                <p class="text-slate-500 font-medium leading-relaxed">توصيل آمن وسريع خلال 24 ساعة لجميع محافظات مصر.
                </p>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] shadow-soft border border-white/50 hover:-translate-y-2 transition-all duration-300 group"
                data-aos="fade-up" data-aos-delay="100">
                <div
                    class="w-16 h-16 bg-secondary/10 rounded-2xl flex items-center justify-center text-secondary mb-6 group-hover:bg-secondary group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-slate-800 mb-3">ضمان حقيقي</h3>
                <p class="text-slate-500 font-medium leading-relaxed">ضمان استرجاع مجاني خلال 14 يوم وضمان الوكيل لكل
                    قطعة.</p>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] shadow-soft border border-white/50 hover:-translate-y-2 transition-all duration-300 group"
                data-aos="fade-up" data-aos-delay="200">
                <div
                    class="w-16 h-16 bg-accent/10 rounded-2xl flex items-center justify-center text-accent mb-6 group-hover:bg-accent group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-slate-800 mb-3">دعم فني مختص</h3>
                <p class="text-slate-500 font-medium leading-relaxed">خبراء في الهاردوير متاحون طوال الوقت لمساعدتك في
                    التجميع.</p>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] shadow-soft border border-white/50 hover:-translate-y-2 transition-all duration-300 group"
                data-aos="fade-up" data-aos-delay="300">
                <div
                    class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-slate-800 mb-3">دفع آمن وسهل</h3>
                <p class="text-slate-500 font-medium leading-relaxed">خيارات دفع متعددة (كاش، فيزا، تقسيط) مع أعلى
                    معايير الأمان.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Section -->
<section class="py-24 bg-white relative" id="featured">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div data-aos="fade-left">
                <span class="text-primary font-bold tracking-widest uppercase text-sm mb-2 block">Premium
                    Selection</span>
                <h2 class="text-4xl md:text-5xl font-black text-dark mb-4 tracking-tight">إصدارات <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">مختارة
                        بعناية</span></h2>
                <div class="w-32 h-2 bg-gradient-to-r from-primary to-secondary rounded-full"></div>
            </div>
            <a href="products.php"
                class="group flex items-center space-x-2 space-x-reverse text-primary font-bold text-lg hover:text-secondary transition-colors"
                data-aos="fade-right">
                <span>استكشف كافة المنتجات</span>
                <span class="group-hover:translate-x-[-8px] transition-transform duration-300">←</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10" id="featured-products">
            <!-- AJAX Products -->
        </div>
    </div>
</section>

<!-- Trust / Partners Section -->
<section class="py-20 bg-slate-50 relative overflow-hidden">
    <div class="container mx-auto px-6 text-center">
        <p class="text-slate-400 font-bold mb-10 tracking-[0.3em] uppercase text-sm">شركاء النجاح في عالم الجيمنج</p>
        <div
            class="flex flex-wrap justify-center items-center gap-12 opacity-50 grayscale hover:grayscale-0 transition-all duration-700">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Samsung_Logo.svg" class="h-8" alt="Samsung">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/NVIDIA_logo.svg" class="h-6" alt="NVIDIA">
            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/Intel_logo_%282020%29.svg" class="h-10"
                alt="Intel">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/75/Asus_Logo.svg" class="h-6" alt="ASUS">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/bb/Razer_logo.svg" class="h-8" alt="Razer">
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
