<!-- Search & Filters Container -->
<div class="glass rounded-[2rem] shadow-soft p-4 md:p-6 flex flex-col lg:flex-row gap-4 items-center mb-12 border border-white/50"
    data-aos="fade-up">

    <div class="relative flex-1 w-full group">
        <span
            class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors text-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </span>
        <input type="text" id="search-input" placeholder="ابحث عن منتج، ماركة، أو فئة..."
            class="w-full pr-16 pl-6 py-4 bg-slate-50/50 hover:bg-slate-50 focus:bg-white rounded-[1.5rem] focus:ring-2 focus:ring-primary/20 transition-all duration-300 outline-none font-bold text-slate-700 text-lg border border-transparent focus:border-primary/30 placeholder-slate-400">
    </div>

    <div class="w-full lg:w-72 relative">
        <select id="category-filter"
            class="w-full px-6 py-4 bg-slate-50/50 hover:bg-slate-50 focus:bg-white rounded-[1.5rem] focus:ring-2 focus:ring-primary/20 transition-all duration-300 outline-none appearance-none cursor-pointer font-bold text-slate-700 text-lg border border-transparent focus:border-primary/30">
            <option value="">كل الفئات</option>
            <option value="1">لابتوب</option>
            <option value="2">كمبيوتر مكتبي</option>
            <option value="3">شاشات</option>
            <option value="4">الملحقات</option>
        </select>
        <div class="absolute left-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 0 01-1.414 0l-4-4a1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    </div>
</div>