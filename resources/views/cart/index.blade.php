<x-layouts.app title="購物車">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-4 bg-white dark:bg-zinc-800 border border-neutral-200 dark:border-neutral-700">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold dark:text-white">購物車</h1>
        </div>

        {{-- 購物車內容表格 --}}
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-zinc-700">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 dark:bg-zinc-700">
                    <tr>
                        <th class="p-4 text-sm font-bold text-gray-700 dark:text-gray-200">品項</th>
                        <th class="p-4 text-sm font-bold text-gray-700 dark:text-gray-200">單價</th>
                        <th class="p-4 text-sm font-bold text-gray-700 dark:text-gray-200 text-center">數量</th>
                        <th class="p-4 text-sm font-bold text-gray-700 dark:text-gray-200">小計</th>
                        <th class="p-4 text-sm font-bold text-gray-700 dark:text-gray-200 text-center">操作</th>
                    </tr>
                </thead>
                <tbody id="cart-body" class="bg-white dark:bg-zinc-800 divide-y divide-gray-100 dark:divide-zinc-700">
                    {{-- 此處內容由 shop.js 自動填充 --}}
                </tbody>
            </table>
        </div>

        {{-- 底部按鈕區塊 (整合版) --}}
        <div class="mt-8 flex flex-col md:flex-row justify-between items-center bg-gray-50 dark:bg-zinc-900/50 p-6 rounded-2xl shadow-sm gap-4">
            
            {{-- 左側：返回點餐 --}}
            <div class="flex-shrink-0">
                <a href="{{ route('menu.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white dark:bg-zinc-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-zinc-700 rounded-xl hover:bg-gray-100 transition shadow-sm font-bold whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-orange-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    <span>繼續點餐</span>
                </a>
            </div>

            {{-- 右側：金額顯示與動作按鈕 --}}
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="text-right">
                    <p class="text-gray-400 text-sm font-medium">總計金額</p>
                    <p class="text-3xl font-black text-blue-600 dark:text-blue-400">$<span id="total">0</span></p>
                </div>

                <div class="flex gap-4">
                    <button onclick="clearCart()" class="px-6 py-3 text-red-500 hover:bg-red-50 rounded-xl transition font-bold">
                        清空
                    </button>
                    <button onclick="submitOrder()" class="px-10 py-3 bg-orange-500 text-white rounded-xl hover:bg-orange-600 transition font-black shadow-lg shadow-orange-200">
                        確認送出訂單
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- 載入 JS 資源 --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/shop.js') }}"></script>

    <script>
        /**
         * 提交訂單至後端資料庫
         */
        async function submitOrder() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            
            // 抓取總金額數字，並處理可能的符號與逗號
            let totalElement = document.getElementById('total');
            let totalValue = parseInt(totalElement.innerText.replace(/[$,]/g, '')) || 0;

            if (cart.length === 0) {
                alert('您的購物車是空的，快去點餐吧！');
                return;
            }

            if (!confirm(`確認要送出訂單嗎？總金額為 $${totalValue}`)) {
                return;
            }

            try {
                // 執行發送 POST 請求
                const response = await fetch("{{ route('orders.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        // 重要：必須包含 CSRF Token，確保 Laravel 允許 POST 請求
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        cart: cart,
                        total: totalValue
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    alert('🎉 訂單建立成功！編號：' + result.order_id);
                    localStorage.removeItem('cart'); // 成功後務必清除本地暫存
                    window.location.href = "{{ route('dashboard') }}"; // 跳轉回首頁
                } else {
                    alert('❌ 送出失敗：' + (result.message || '伺服器錯誤'));
                }
            } catch (error) {
                console.error('Submission error:', error);
                alert('⚠️ 網路連線錯誤，請確認伺服器連線狀態');
            }
        }
    </script>
</x-layouts.app>