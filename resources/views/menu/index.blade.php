<x-layouts.app :title="__('2026 早餐店 - 菜單')">
    {{-- 最外層容器 --}}
    <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 bg-gray-50/30 min-h-screen">
        
        {{-- 1. 頁面標題與購物車區塊 --}}
        <div class="flex flex-col md:flex-row md:items-end gap-6 w-full mb-10">            
            {{-- 標題與敘述 --}}
            <div class="text-center md:text-left">
                <h1 class="font-black tracking-tight text-gray-900" 
                    style="font-size: clamp(2rem, 5vw, 3.5rem); line-height: 1.2;">
                    2026 早餐店 <span class="animate-bounce inline-block">☀️</span>
                </h1>
                <p class="text-gray-400 mt-1 font-medium text-lg">
                    美味、新鮮、元氣滿分！選好餐點就去結帳吧 🍴
                </p>
            </div>

            {{-- 購物車按鈕 --}}
            <a href="/cart"class="w-full md:w-auto md:ml-auto flex items-center justify-center gap-3 px-6 py-3 rounded-xl font-bold text-white shadow-lg transition-all hover:scale-105 active:scale-95 whitespace-nowrap"
                style="background-color: #2563eb;">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span id="menu-cart-count" class="absolute -top-3 -right-3 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 text-[10px] font-black ring-4 ring-white">0</span>
                </div>
                <span>我的購物車</span>
            </a>
        </div>

        {{-- 分類切換按鈕 --}}
        <div class="flex justify-center mb-12">
            <div class="inline-flex p-1.5 bg-white border border-gray-100 rounded-2xl shadow-sm overflow-x-auto">
                <button onclick="filterCategory('all')" class="filter-btn active px-6 py-2 rounded-xl font-bold bg-orange-500 text-white transition-all whitespace-nowrap">全部</button>
                @foreach($categories as $category)
                    <button onclick="filterCategory('{{ $category->name }}')" class="filter-btn px-6 py-2 rounded-xl font-bold text-gray-500 hover:bg-gray-50 transition-all whitespace-nowrap">{{ $category->name }}</button>
                @endforeach
            </div>
        </div>

        {{-- 商品區塊 --}}
        <div id="menu-container" class="space-y-16">
            @foreach($categories as $category)
                @if($category->meals->count() > 0)
                    <div class="category-section" data-category="{{ $category->name }}">
                        {{-- 分類標題 --}}
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-1.5 h-6 bg-orange-500 rounded-full"></div>
                            <h2 class="text-xl font-black text-gray-800 tracking-tight">{{ $category->name }} 系列</h2>
                        </div>

                        {{-- 卡片網格：設定為 md:grid-cols-3 (一行三個) --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                            @foreach($category->meals as $meal)
                                <div class="group bg-white rounded-[2.5rem] border border-gray-100 p-6 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                                    
                                    <div>
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="text-lg font-bold text-gray-800">{{ $meal->name }}</h3>
                                            <span class="text-xl font-black text-orange-500">${{ $meal->price }}</span>
                                        </div>
                                        
                                        <div class="mb-6">
                                            <span class="px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase {{ $meal->stock > 0 ? 'bg-gray-100 text-gray-400' : 'bg-red-50 text-red-500' }}">
                                                {{ $meal->stock > 0 ? '庫存: '.$meal->stock : '已售完' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between bg-gray-50 rounded-2xl p-1.5 border border-gray-100">
                                            <button onclick="decrease(this)" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white shadow-sm text-gray-400 hover:text-orange-500 transition-all font-bold">-</button>
                                            <input type="text" class="qty w-10 text-center bg-transparent font-black text-gray-800 outline-none" value="1" readonly data-max="{{ $meal->stock }}">
                                            <button onclick="increase(this)" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white shadow-sm text-gray-400 hover:text-orange-500 transition-all font-bold">+</button>
                                        </div>

                                        @if($meal->stock > 0)
                                            <button onclick="menuAddToCart({{ $meal->id }}, '{{ $meal->name }}', {{ $meal->price }}, this, {{ $meal->stock }})"
                                                    class="w-full py-3.5 rounded-2xl bg-orange-500 text-white font-black shadow-lg shadow-orange-100 hover:bg-orange-600 active:scale-95 transition-all">
                                                加入購物車
                                            </button>
                                        @else
                                            <div class="w-full py-3.5 rounded-2xl bg-gray-100 text-gray-400 font-bold text-center cursor-not-allowed">
                                                已售完
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <script src="{{ asset('js/shop.js') }}"></script>
    <script>
        function updateMenuCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            document.getElementById('menu-cart-count').innerText = cart.reduce((s, i) => s + (i.qty || 0), 0);
        }
        document.addEventListener("DOMContentLoaded", updateMenuCartCount);

        function menuAddToCart(id, name, price, btn, max) {
            if (window.addToCart) window.addToCart(id, name, price, btn, max);
            updateMenuCartCount();
        }

        function filterCategory(cat) {
            document.querySelectorAll('.category-section').forEach(s => s.style.display = (cat === 'all' || s.getAttribute('data-category') === cat) ? 'block' : 'none');
            document.querySelectorAll('.filter-btn').forEach(b => {
                if (b.innerText.trim() === cat || (cat === 'all' && b.innerText.trim() === '全部')) {
                    b.classList.add('bg-orange-500', 'text-white');
                    b.classList.remove('text-gray-500');
                } else {
                    b.classList.remove('bg-orange-500', 'text-white');
                    b.classList.add('text-gray-500');
                }
            });
        }
    </script>
</x-layouts.app>