<x-layouts.app title="首頁">
    <div class="flex flex-col gap-8">
        
        {{-- 🔶 Hero 區塊 --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-orange-400 to-red-500 shadow-lg text-white">
            <div class="relative z-10 flex flex-col items-center justify-center py-16 px-6 text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-4 drop-shadow">
                    2026 早餐店 ☀️
                </h1>

                <p class="max-w-xl text-base md:text-lg text-orange-50 mb-8 font-medium">
                    新鮮現做的美味早餐，讓您充滿元氣。<br class="hidden md:block">
                    不用排隊，手指點一點輕鬆預訂！
                </p>

                <a href="/menu"
                   class="inline-flex items-center gap-2 px-8 py-3 bg-white text-orange-600 rounded-full font-bold text-lg shadow hover:bg-orange-50 hover:scale-105 transition">
                    🍽️ 開始點餐
                </a>
            </div>
        </div>


        {{-- 🔷 兩大功能入口 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- 菜單 --}}
            <a href="/menu"
               class="group flex flex-col items-center justify-center p-8 bg-white dark:bg-zinc-800 rounded-2xl border border-gray-200 dark:border-zinc-700 shadow hover:shadow-lg hover:-translate-y-1 transition">

                <div class="w-16 h-16 mb-4 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center text-3xl shadow-inner">
                    📋
                </div>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-1">
                    瀏覽完整菜單
                </h2>

                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    漢堡、蛋餅、飲料… 查看所有餐點
                </p>
            </a>


            {{-- 購物車 --}}
            <a href="/cart"
               class="group flex flex-col items-center justify-center p-8 bg-white dark:bg-zinc-800 rounded-2xl border border-gray-200 dark:border-zinc-700 shadow hover:shadow-lg hover:-translate-y-1 transition">

                <div class="w-16 h-16 mb-4 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center text-3xl shadow-inner">
                    🛒
                </div>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-1">
                    我的購物車
                </h2>

                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    目前有
                    <span class="font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded">
                        <span id="dashboard-cart-count">0</span>
                        樣商品
                    </span>
                </p>
            </a>
        </div>


        {{-- 🔔 公告區 --}}
        <div class="rounded-2xl border border-gray-200 dark:border-neutral-700 bg-gray-50 dark:bg-zinc-800/60 p-6 text-center">
            
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">
                📢 餐廳公告
            </h3>

            <p class="text-gray-600 dark:text-gray-400">
                歡迎使用線上點餐系統！目前營業時間：
                <strong class="text-gray-900 dark:text-white">06:00 - 13:00</strong><br>
                建議提早送出訂單，避免現場久候。祝您用餐愉快！
            </p>
        </div>
    </div>


    {{-- 🧩 購物車同步腳本 --}}
    <script>
        function updateDashboardCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let totalQty = cart.reduce((sum, item) => sum + (item.qty || 0), 0);

            let span = document.getElementById('dashboard-cart-count');
            if (span) span.textContent = totalQty;
        }

        document.addEventListener("DOMContentLoaded", updateDashboardCartCount);
        document.addEventListener("livewire:navigated", updateDashboardCartCount);
        window.addEventListener("pageshow", updateDashboardCartCount);
        window.addEventListener("storage", e => e.key === "cart" && updateDashboardCartCount());
    </script>
</x-layouts.app>
