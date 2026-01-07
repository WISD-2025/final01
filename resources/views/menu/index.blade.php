<x-layouts.app :title="__('2026 早餐店 - 菜單')">

    {{-- 強制背景為白色，防止透明度問題 --}}
    <div class="flex h-full w-full flex-1 flex-col gap-6 p-6 relative bg-white">
        
        {{-- 頁面標題區塊 --}}
        <div class="flex flex-col md:flex-row justify-between items-end pb-6 border-b-2 border-orange-100 gap-4">
            <div>
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight">2026 早餐店</h1>
                <p class="text-gray-500 mt-2 font-medium">美味、新鮮、元氣滿分！選好餐點就去結帳吧 🍴</p>
            </div>
            
            {{-- 購物車按鈕：強制背景色與文字顏色 --}}
            <a href="/cart" class="group flex items-center gap-3 px-8 py-3 rounded-2xl font-bold shadow-xl active:scale-95 transition-all" 
               style="background-color: #2563eb !important; color: white !important; text-decoration: none;">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .952.347 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    <span id="menu-cart-count" class="absolute -top-3 -right-3 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 text-xs font-black ring-2 ring-white text-white" style="background-color: #ef4444 !important;">0</span>
                </div>
                <span class="text-lg" style="color: white !important;">查看我的購物車</span>
            </a>
        </div>

        {{-- 分類按鈕區 --}}
        <div class="flex flex-wrap justify-center gap-3 my-4 sticky top-0 z-20 bg-gray-50/90 backdrop-blur-md py-3 rounded-2xl border border-gray-100 shadow-sm">
            <button onclick="filterCategory('all')" class="filter-btn active px-8 py-2.5 rounded-xl font-bold bg-orange-500 text-white shadow-md hover:bg-orange-600 transition-all">全部</button>
            @foreach($categories as $category)
                @if($category->meals->count() > 0)
                    <button onclick="filterCategory('{{ $category->name }}')" class="filter-btn px-8 py-2.5 rounded-xl font-bold bg-white text-gray-700 shadow-sm border border-gray-200 hover:bg-orange-100 hover:text-orange-600 transition-all">{{ $category->name }}</button>
                @endif
            @endforeach
        </div>

        {{-- 商品列表 --}}
        <div id="menu-container">
            @foreach($categories as $category)
                @if($category->meals->count() > 0)
                    <div class="category-section mb-12" data-category="{{ $category->name }}">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-2 h-8 bg-orange-500 rounded-full"></div>
                            <h2 class="text-3xl font-extrabold text-gray-800">{{ $category->name }} 系列</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($category->meals as $meal)
                                <div class="group relative flex flex-col rounded-3xl border border-gray-100 bg-white p-6 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ $meal->name }}</h3>
                                        <span class="text-2xl font-black text-orange-600">${{ $meal->price }}</span>
                                    </div>

                                    <div class="flex justify-between items-center mb-6 mt-auto">
                                        <span class="text-sm px-3 py-1 rounded-lg {{ $meal->stock > 0 ? 'text-gray-500 bg-gray-100' : 'text-red-500 bg-red-50 font-bold' }}">
                                            {{ $meal->stock > 0 ? '庫存: '.$meal->stock : '暫無庫存' }}
                                        </span>

                                        <div class="flex items-center gap-3 bg-gray-50 rounded-xl p-1.5 border border-gray-200">
                                            <button onclick="decrease(this)" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white shadow-sm text-gray-600 hover:text-orange-500 font-bold hover:bg-orange-50 transition">-</button>
                                            <input type="text" class="qty w-8 text-center bg-transparent font-black text-gray-800 outline-none" value="1" readonly data-max="{{ $meal->stock }}">
                                            <button onclick="increase(this)" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white shadow-sm text-gray-600 hover:text-orange-500 font-bold hover:bg-orange-50 transition">+</button>
                                        </div>
                                    </div>

                                    @if($meal->stock > 0)
                                        <button
                                            onclick="menuAddToCart({{ $meal->id }}, '{{ $meal->name }}', {{ $meal->price }}, this, {{ $meal->stock }})"
                                            class="w-full py-4 rounded-2xl bg-orange-500 text-white font-black shadow-lg shadow-orange-100 hover:bg-orange-600 active:scale-95 transition-all"
                                        >
                                            加入購物車
                                        </button>
                                    @else
                                        <button disabled class="w-full py-4 rounded-2xl bg-gray-100 text-gray-400 font-bold cursor-not-allowed border border-gray-200">
                                            已售完
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/shop.js') }}"></script>

    <script>
        function updateMenuCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
            let countSpan = document.getElementById('menu-cart-count');
            if (countSpan) countSpan.innerText = totalQty;
        }

        document.addEventListener("DOMContentLoaded", updateMenuCartCount);

        function menuAddToCart(id, name, price, btn, maxStock) {
            if (typeof window.addToCart === 'function') {
                window.addToCart(id, name, price, btn, maxStock);
            }
            updateMenuCartCount();
        }

        function filterCategory(categoryName) {
            const sections = document.querySelectorAll('.category-section');
            const buttons = document.querySelectorAll('.filter-btn');

            sections.forEach(section => {
                if (categoryName === 'all' || section.getAttribute('data-category') === categoryName) {
                    section.style.display = 'block';
                    section.animate(
                        [
                            { opacity: 0, transform: 'translateY(10px)' },
                            { opacity: 1, transform: 'translateY(0)' }
                        ],
                        { duration: 300, fill: 'forwards' }
                    );
                } else {
                    section.style.display = 'none';
                }
            });

            buttons.forEach(btn => {
                if (btn.innerText.trim() === categoryName || (categoryName === 'all' && btn.innerText.trim() === '全部')) {
                    btn.classList.add('bg-orange-500', 'text-white');
                    btn.classList.remove('bg-white', 'text-gray-700');
                } else {
                    btn.classList.remove('bg-orange-500', 'text-white');
                    btn.classList.add('bg-white', 'text-gray-700');
                }
            });
        }
    </script>
</x-layouts.app>
