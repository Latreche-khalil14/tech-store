<!-- Hero Section with Intelligent Particles -->
<link rel="stylesheet" href="includes/hero/hero.css">
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
                        mode: "grab"
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
                    value: ["#4f46e5", "#06b6d4"]
                },
                links: {
                    enable: true,
                    distance: 150,
                    color: "#94a3b8",
                    opacity: 0.3,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 1.5,
                    direction: "none",
                    outModes: "bounce"
                },
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        area: 800
                    }
                },
                opacity: {
                    value: 0.6
                },
                shape: {
                    type: ["circle", "triangle"]
                },
                size: {
                    value: { min: 1, max: 3 },
                    random: true
                }
            },
            detectRetina: true
        });
    });
</script>