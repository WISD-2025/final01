<x-layouts.app title="首頁">
    <div class="flex flex-col gap-6">
        
       <div class="relative overflow-hidden rounded-[3rem] shadow-2xl text-white flex items-center justify-center" 
            style="background: linear-gradient(135deg, #fb923c 0%, #f97316 50%, #ef4444 100%) !important; min-height: 450px;">
            
            {{-- 背景裝飾 (保持不變) --}}
            <div class="absolute top-0 right-0 -mr-16 -mt-16 h-64 w-64 rounded-full bg-white opacity-10 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-16 -mb-16 h-64 w-64 rounded-full bg-yellow-300 opacity-20 blur-3xl"></div>

            {{-- 內容區塊：移除 py-16，讓 flex 處理完全置中 --}}
            <div class="relative z-10 flex flex-col items-center justify-center px-6 text-center w-full">
                
                {{-- 標題 --}}
                <h1 class="font-black tracking-tighter text-white mb-6" 
                    style="
                        font-size: clamp(3.5rem, 10vw, 8rem);
                        line-height: 1;
                        text-shadow: 
                            0 10px 20px rgba(0,0,0,0.3), 
                            0 5px 10px rgba(0,0,0,0.2),
                            0 2px 2px rgba(0,0,0,0.5);
                        filter: drop-shadow(0 10px 10px rgba(0,0,0,0.2));
                    ">
                    2026 早餐店 <span class="animate-bounce inline-block">☀️</span>
                </h1>

                {{-- 敘述 --}}
                <p class="max-w-3xl font-bold text-white mb-10 leading-relaxed"
                    style="
                        font-size: clamp(1.2rem, 3vw, 2.2rem);
                        text-shadow: 0 2px 4px rgba(0,0,0,0.4);
                        opacity: 0.95;
                    ">
                    新鮮現做的美味早餐，讓您充滿元氣。<br class="hidden md:block">
                    不用排隊，手指點一點輕鬆預訂！
                </p>
                
                {{-- 按鈕 --}}
                <a href="/menu" class="group relative inline-flex items-center gap-2 px-10 py-4 bg-white text-orange-600 rounded-full font-black text-xl shadow-2xl hover:bg-orange-50 hover:scale-105 transition-all duration-300">
                    <span>🍽️ 開始點餐</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 group-hover:translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <a href="/menu" class="group relative flex flex-col items-center justify-center p-8 bg-white dark:bg-zinc-800 rounded-2xl border border-gray-100 dark:border-zinc-700 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="w-16 h-16 mb-4 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center text-3xl shadow-inner group-hover:scale-110 transition-transform duration-300">
                    📋
                </div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-1">瀏覽完整菜單</h2>
                <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                    漢堡、蛋餅、飲料...<br>查看所有豐富選擇
                </p>
            </a>

            <a href="/cart" class="group relative flex flex-col items-center justify-center p-8 bg-white dark:bg-zinc-800 rounded-2xl border border-gray-100 dark:border-zinc-700 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="w-16 h-16 mb-4 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center text-3xl shadow-inner group-hover:scale-110 transition-transform duration-300">
                    🛒
                </div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-1">我的購物車</h2>
                <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                    確認餐點或結帳<br>
                    <span class="text-blue-600 font-bold mt-1 inline-block bg-blue-50 px-2 py-0.5 rounded">
                        目前有 <span id="dashboard-cart-count">0</span> 樣商品
                    </span>
                </p>
            </a>

        </div>

        {{-- 3. 下方資訊區塊 (可以放營業時間或促銷) --}}
        <div class="relative flex-1 overflow-hidden rounded-2xl border border-neutral-200 dark:border-neutral-700 bg-gray-50 dark:bg-zinc-800/50 p-6 flex flex-col items-center justify-center text-center">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">📢 餐廳公告</h3>
            <p class="text-gray-500 dark:text-gray-400 max-w-2xl">
                歡迎使用線上點餐系統！我們目前的營業時間為 <strong>06:00 - 13:00</strong>。<br>
                建議提早送出訂單，避免現場久候。祝您用餐愉快！
            </p>
        </div>
    </div>

    {{-- 腳本：讀取 localStorage 並更新首頁的購物車數字 --}}
    <script>
        // 統一的更新函式
        function updateDashboardCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let totalQty = cart.reduce((sum, item) => sum + (item.qty || 0), 0);

            let countSpan = document.getElementById('dashboard-cart-count');
            if (countSpan) {
                countSpan.textContent = totalQty;
            }
        }

        // 一般載入頁面時
        document.addEventListener("DOMContentLoaded", updateDashboardCartCount);

        // 從其他頁按「上一頁 / 返回」回到 Dashboard 時（處理瀏覽器快取）
        window.addEventListener("pageshow", function (event) {
            // event.persisted 表示是從 bfcache 回來（Safari / Chrome 有時會用到）
            updateDashboardCartCount();
        });

        // 如果開多個分頁，其他分頁變更 localStorage.cart，也會同步更新這一頁（可選）
        window.addEventListener("storage", function (event) {
            if (event.key === 'cart') {
                updateDashboardCartCount();
            }
        });
    </script>
</x-layouts.app>