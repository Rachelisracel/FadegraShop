@extends('layouts.client_menu')

@section('content')

    @php
    // Mảng dữ liệu MENU_DATA
    $menuData = [
        'bestSeller' => [
            'key' => 'best-seller',
            'label' => 'Best Seller',
            'emoji' => '',
            'bg_color' => '#D6C5B3',
            'grid_cols' => 'lg:grid-cols-3',
            'items' => [
                ['id' => 'bs1', 'name' => 'Trà Sữa Truyền Thống', 'prices' => ['S' => 20, 'L' => 25], 'tag' => 'hot', 'image' => 'truyenthong.jpg'],
                ['id' => 'bs2', 'name' => 'Matcha Latte Oatside Vị Nguyên Bản', 'prices' => ['L' => 28], 'tag' => 'hot', 'image' => 'matchalatte.jpg'],
                ['id' => 'bs3', 'name' => 'Trà Đào', 'prices' => ['S' => 20, 'L' => 25], 'tag' => 'hot', 'image' => 'tradao.jpg'],
            ],
        ],
        'tra' => [
            'key' => 'tra',
            'label' => 'Trà',
            'emoji' => '',
            'bg_color' => '#C5D6BF',
            'grid_cols' => 'lg:grid-cols-4',
            'items' => [
                ['id' => 't1', 'name' => 'Ô Long Bí Đao', 'prices' => ['L' => 15], 'image' => 'olong-bidao.jpg'],
                ['id' => 't2', 'name' => 'Hồng Trà Trân Châu', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'hongtra.JPG'],
                ['id' => 't3', 'name' => 'Dưa Lưới', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'tradualuoi.JPG'],
                ['id' => 't4', 'name' => 'Việt Quất', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'travq.JPG'],
                ['id' => 't5', 'name' => 'Đào', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'tradao.jpg'],
                ['id' => 't6', 'name' => 'Vải', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'travai.JPG'],
                ['id' => 't7', 'name' => 'Dâu', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'tradau.JPG'],
            ],
        ],
        'traSua' => [
            'key' => 'tra-sua',
            'label' => 'Trà Sữa',
            'emoji' => '',
            'bg_color' => '#D6C5B3',
            'grid_cols' => 'lg:grid-cols-4',
            'items' => [
                ['id' => 'ts1', 'name' => 'Matcha', 'prices' => ['L' => 28], 'tag' => 'new', 'image' => 'trasuamatcha.JPG'],
                ['id' => 'ts2', 'name' => 'Chocolate', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'chocolate.jpg'],
                ['id' => 'ts3', 'name' => 'Khoai Môn', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'trasuakhoaimon.JPG'],
                ['id' => 'ts4', 'name' => 'Dưa Lưới', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'trasuadualuoi.JPG'],
                ['id' => 'ts5', 'name' => 'Việt Quất', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'trasuavq.JPG'],
                ['id' => 'ts6', 'name' => 'Thái Xanh', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'thaixanh.jpg'],
                ['id' => 'ts7', 'name' => 'Đào', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'trasuadao.JPG'],
                ['id' => 'ts8', 'name' => 'Vải', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'trasuavai.JPG'],
                ['id' => 'ts9', 'name' => 'Dâu', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'trasuadau.JPG'],
            ],
        ],
        'suaTuoi' => [
            'key' => 'sua-tuoi',
            'label' => 'Sữa Tươi',
            'emoji' => '',
            'bg_color' => '#E8E0D5',
            'grid_cols' => 'lg:grid-cols-4',
            'items' => [
                ['id' => 'st1', 'name' => 'Sữa Tươi Trân Châu Đường Đen', 'prices' => ['S' => 25, 'L' => 30], 'image' => 'suatuoi.jpg'],
            ],
        ],
        'milo' => [
            'key' => 'milo',
            'label' => 'Milo',
            'emoji' => '',
            'bg_color' => '#C5C5D6',
            'grid_cols' => 'lg:grid-cols-4',
            'items' => [
                ['id' => 'm1', 'name' => 'Milo Dầm Trân Châu Đường Đen', 'prices' => ['L' => 25], 'image' => 'milo.jpg'],
            ],
        ],
        'topping' => [
            'key' => 'topping',
            'label' => 'Topping thêm',
            'emoji' => '',
            'bg_color' => '#EDE8E0',
            'grid_cols' => 'lg:grid-cols-4',
            'items' => [
                ['id' => 'tp1', 'name' => 'Bánh Flan', 'prices' => ['default' => 7]],
                ['id' => 'tp2', 'name' => 'Trân Châu Đen', 'prices' => ['default' => 6]],
                ['id' => 'tp3', 'name' => 'Pudding (4)', 'prices' => ['default' => 6]],
                ['id' => 'tp4', 'name' => 'Sương Sáo (8)', 'prices' => ['default' => 6]],
                ['id' => 'tp5', 'name' => 'Trân Châu Giòn', 'prices' => ['default' => 6]],
                ['id' => 'tp6', 'name' => 'Thạch Khoai Dẻo', 'prices' => ['default' => 6]],
                ['id' => 'tp7', 'name' => 'Thạch Rau Câu', 'prices' => ['default' => 6]],
                ['id' => 'tp8', 'name' => 'Đào (4)', 'prices' => ['default' => 5]],
                ['id' => 'tp9', 'name' => 'Vải (3)', 'prices' => ['default' => 6]],
            ],
        ],
    ];

    // Lưu lại toàn bộ toppings để sử dụng cho popup Modal
    $allToppings = $menuData['topping']['items'] ?? [];

    $searchQuery = request('q');
    if ($searchQuery) {
        $searchQueryNormalized = strtolower(\Illuminate\Support\Str::ascii(trim($searchQuery)));

        foreach ($menuData as $key => &$category) {
            $filteredItems = array_filter($category['items'], function($item) use ($searchQueryNormalized, $category) {
                // Kết hợp tên danh mục và tên món để tìm kiếm (Vd: "Trà" + "Dưa Lưới" = "Trà Dưa Lưới")
                $fullItemName = $category['label'] . ' ' . $item['name'];
                
                $itemNameNormalized = strtolower(\Illuminate\Support\Str::ascii($fullItemName));
                
                return str_contains($itemNameNormalized, $searchQueryNormalized);
            });
            $category['items'] = array_values($filteredItems);
        }
        unset($category);
        
        $menuData = array_filter($menuData, function($category) {
            return count($category['items']) > 0;
        });
    }
    @endphp

    <div class="bg-[#F8F6F2] min-h-screen pb-24 font-sans relative">

        <!-- 1. HEADER & FILTER CHIPS -->
        <header class="bg-[#354A3D] pt-4 pb-3 px-6 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center justify-between gap-4 mb-3">
                    <div class="flex items-center gap-3">
                        <a href="{{ url('/') }}" class="text-white hover:text-gray-300 transition-colors shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </a>
                        <div>
                            <h1 class="font-cinzel text-xl text-white font-bold tracking-wide">Menu Fadegra</h1>
                            <p class="text-white/70 text-xs mt-0.5">Chọn món yêu thích của bạn</p>
                        </div>
                    </div>

                    <!-- Ô tìm kiếm sản phẩm -->
                    <form action="{{ url('/menu') }}" method="GET" class="relative w-40 sm:w-64 shrink-0 mt-0 ">
                        <!-- Thêm thuộc tính name="q" để hệ thống nhận diện từ khóa -->
                        <input type="text" name="q" placeholder="Tìm sản phẩm..." required
                            class="w-full bg-white/10 text-white placeholder-white/60 text-sm rounded-full py-2 pl-4 pr-10 focus:outline-none focus:bg-white/20 transition-colors border border-white/20">

                        <!-- Đổi thẻ button thành type="submit" để khi bấm hoặc nhấn Enter sẽ tiến hành tìm kiếm -->
                        <button type="submit"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-white/80 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="flex overflow-x-auto gap-2.5 pb-1 scrollbar-none" style="scrollbar-width: none; -ms-overflow-style: none;">
                    <a href="#tat-ca" class="bg-[#F8F6F2] text-[#354A3D] px-4 py-2 rounded-full text-[13px] font-semibold whitespace-nowrap flex items-center gap-1.5 shadow-sm transition-all hover:bg-white">
                        Tất cả
                    </a>
                    @foreach($menuData as $category)
                        <a href="#{{ $category['key'] }}" class="bg-white/10 text-white hover:bg-white/20 transition-colors px-4 py-2 rounded-full text-[13px] font-medium whitespace-nowrap flex items-center gap-1.5">
                            {{ $category['emoji'] }} {{ $category['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </header>

        <!-- 2. NỘI DUNG MENU -->
        <main id="tat-ca" class="max-w-7xl mx-auto px-6 py-8 space-y-12">
            @if(empty($menuData))
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-sm mb-5 text-[#354A3D]/40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-serif text-2xl text-[#1F2937] font-bold mb-2">Không tìm thấy món</h3>
                    <p class="text-gray-500">Rất tiếc, chúng tôi không tìm thấy món nào phù hợp với từ khóa <span class="font-bold">"{{ request('q') }}"</span>.</p>
                    <a href="{{ url('/menu') }}" class="mt-6 bg-[#354A3D] text-white px-8 py-3 rounded-full font-bold shadow-md hover:bg-[#2A4435] transition-colors">
                        Xem toàn bộ Menu
                    </a>
                </div>
            @else
                @foreach($menuData as $catKey => $category)
                <section id="{{ $category['key'] }}" class="scroll-mt-40">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex items-center gap-2 text-2xl">{{ $category['emoji'] }}</div>
                        <h2 class="font-serif text-2xl font-bold text-[#1F2937]">{{ $category['label'] }}</h2>
                        <div class="flex-1 border-t border-gray-300 mx-2"></div>
                        <span class="text-gray-400 text-sm font-medium">{{ count($category['items']) }} món</span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 {{ $category['grid_cols'] }} gap-4 md:gap-5">
                        @foreach($category['items'] as $item)
                            @if($catKey === 'topping')
                                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow cursor-default p-4 md:p-5 flex flex-col justify-center min-h-[90px] gap-2 border border-black/5">
                                    <h3 class="font-bold text-[#1F2937] text-sm md:text-base">{{ $item['name'] }}</h3>
                                    <span class="text-[#354A3D] font-bold text-sm">+{{ $item['prices']['default'] }}k</span>
                                </div>
                            @else
                                <div onclick='openOrderModal(@json($item), "{{ $category['bg_color'] }}", "{{ $category['emoji'] }}")' 
                                     class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow cursor-pointer flex flex-col border border-black/5 group">

                                    <div class="relative h-[180px] md:h-[200px] overflow-hidden flex items-center justify-center transition-colors" style="background-color: {{ $category['bg_color'] }}">
                                        @if(isset($item['image']))
                                            <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover object-center transition-transform duration-300 group-hover:scale-110">
                                        @else
                                            <span class="text-6xl opacity-30 drop-shadow-sm transition-transform group-hover:scale-110">{{ $category['emoji'] }}</span>
                                        @endif

                                        @if(isset($item['tag']))
                                            <span class="absolute top-3 left-3 bg-[#354A3D] text-white text-[9px] md:text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider shadow-sm z-10">
                                                {{ $item['tag'] === 'hot' ? 'HOT' : 'MỚI' }}
                                            </span>
                                        @endif

                                        <div class="absolute inset-0 bg-[#354A3D]/0 group-hover:bg-[#354A3D]/10 transition-all flex items-end justify-center pb-4 z-10">
                                            <span class="opacity-0 group-hover:opacity-100 transition-opacity bg-white/95 text-[#354A3D] text-[11px] font-bold px-4 py-1.5 rounded-full shadow-md">
                                                Đặt ngay
                                            </span>
                                        </div>
                                    </div>

                                    <div class="p-4 flex-1 flex flex-col">
                                        <h3 class="font-bold text-[#1F2937] text-sm md:text-base mb-2 leading-snug">{{ $item['name'] }}</h3>
                                        <div class="flex flex-wrap gap-1.5 mt-auto">
                                            @if(isset($item['prices']['S']))
                                                <span class="bg-[#F4EFEA] text-gray-700 text-[10px] md:text-xs px-2 py-1 rounded font-medium">S: {{ $item['prices']['S'] }}k</span>
                                            @endif
                                            @if(isset($item['prices']['L']))
                                                <span class="bg-[#F4EFEA] text-gray-700 text-[10px] md:text-xs px-2 py-1 rounded font-medium">L: {{ $item['prices']['L'] }}k</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </section>
            @endforeach
            @endif
        </main>

        <!-- 3. NÚT GIỎ HÀNG NỔI (FAB) -->
        <button onclick="openCartSidebar()" class="fixed bottom-8 right-8 bg-[#354A3D] text-white p-4 rounded-full shadow-xl hover:scale-105 transition-transform z-[60] flex items-center justify-center">
            <span id="cartBadge" class="absolute -top-2 -right-2 bg-[#F5A623] text-white text-[11px] font-bold w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F8F6F2] hidden transition-all duration-300 transform scale-0">0</span>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
        </button>

        <!-- 4. POPUP ĐẶT HÀNG (MODAL) -->
        <div id="orderModal" class="fixed inset-0 z-[100] hidden flex-col justify-end sm:justify-center items-center">
            <div class="absolute inset-0 bg-black/40 transition-opacity" onclick="closeOrderModal()"></div>
            <div class="bg-[#F9F6F0] w-full max-w-lg max-h-[90vh] sm:rounded-2xl rounded-t-3xl relative z-10 flex flex-col shadow-2xl animate-[slideUp_0.3s_ease-out]">

                <div id="modalImageArea" class="h-48 sm:h-56 relative flex items-center justify-center sm:rounded-t-2xl rounded-t-3xl overflow-hidden bg-[#D6C5B3]">
                    <button onclick="closeOrderModal()" class="absolute top-4 right-4 bg-white/70 hover:bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center z-20 backdrop-blur-sm transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto space-y-6 scrollbar-none">
                    <div>
                        <h2 id="modalTitle" class="font-serif text-2xl font-bold text-[#1F2937]">Tên món</h2>
                        <p id="modalBasePriceDisplay" class="text-[#354A3D] font-medium mt-1">Từ 0đ</p>
                    </div>

                    <div id="sizeSection">
                        <p class="text-[11px] font-bold text-gray-500 mb-3 tracking-wider uppercase">Chọn Size</p>
                        <div id="modalSizes" class="flex gap-3"></div>
                    </div>

                    <div>
                        <p class="text-[11px] font-bold text-gray-500 mb-3 tracking-wider uppercase">Topping thêm (Tuỳ chọn)</p>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($allToppings as $topping)
                                <button onclick="toggleTopping('{{ $topping['name'] }}', {{ $topping['prices']['default'] }}, this)" 
                                        class="topping-btn bg-white border border-black/10 rounded-xl p-3 flex justify-between items-center text-[13px] transition-colors">
                                    <span class="font-medium text-gray-700">{{ $topping['name'] }}</span>
                                    <span class="text-gray-400">+{{ $topping['prices']['default'] }}k</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-2 pb-2">
                        <p class="text-[11px] font-bold text-gray-500 tracking-wider uppercase">Số lượng</p>
                        <div class="flex items-center gap-4">
                            <button onclick="changeQuantity(-1)" class="w-8 h-8 rounded-full bg-[#E3D2BE] flex items-center justify-center text-[#354A3D] font-bold hover:bg-[#D6C5B3] transition">-</button>
                            <span id="modalQuantity" class="font-bold text-lg text-[#1F2937] w-4 text-center">1</span>
                            <button onclick="changeQuantity(1)" class="w-8 h-8 rounded-full bg-[#354A3D] text-white flex items-center justify-center font-bold hover:bg-[#2A4435] transition">+</button>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white border-t border-black/5 sm:rounded-b-2xl shadow-[0_-4px_10px_rgba(0,0,0,0.02)]">
                    <button onclick="submitOrder()" class="w-full bg-[#354A3D] text-white rounded-full py-3.5 px-6 font-bold flex justify-between items-center shadow-md hover:bg-[#2A4435] transition-colors">
                        <span>Thêm vào giỏ hàng</span>
                        <span id="modalTotalPrice" class="bg-white/20 px-3 py-1 rounded-full text-sm">0k</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- 5. SIDEBAR GIỎ HÀNG (TRƯỢT TỪ PHẢI SANG) -->
        <div id="cartSidebar" class="fixed inset-0 z-[110] hidden justify-end">
            <div class="absolute inset-0 bg-black/40 transition-opacity" onclick="closeCartSidebar()"></div>
            <div class="bg-[#F9F6F0] w-full max-w-md h-full relative z-10 flex flex-col shadow-2xl animate-[slideLeft_0.3s_ease-out]">

                <div class="p-5 border-b border-black/5 bg-white flex justify-between items-center">
                    <h2 class="font-serif text-xl font-bold text-[#1F2937]">Giỏ hàng của bạn</h2>
                    <button onclick="closeCartSidebar()" class="text-gray-500 hover:text-gray-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <div id="cartItemsContainer" class="flex-1 overflow-y-auto p-5 space-y-4"></div>

                <div class="p-5 bg-white border-t border-black/5 shadow-[0_-4px_10px_rgba(0,0,0,0.02)]">
                    <div class="flex justify-between font-bold text-[#1F2937] text-lg mb-4">
                        <span>Tổng cộng:</span>
                        <span id="cartSidebarTotal">0k</span>
                    </div>
                    <a href="{{ url('/cart') }}" class="w-full bg-[#354A3D] text-white rounded-full py-4 px-6 font-bold shadow-md hover:bg-[#2A4435] transition-colors flex justify-center text-center block">
                        Tiến hành Thanh toán
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes slideUp {
            from { transform: translateY(100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes slideLeft {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>

    <!-- KỊCH BẢN JAVASCRIPT ĐIỀU KHIỂN POPUP & GIỎ HÀNG -->
    <script>
        let cart = JSON.parse(localStorage.getItem('fadegra_cart')) || [];
        let currentItem = null;
        let basePrice = 0;
        let quantity = 1;
        let toppingsPrice = 0;
        let selectedSizeName = '';
        let selectedToppingsList = [];

        const formatPrice = (price) => `${price}k`;

        function openOrderModal(item, bgColor, emoji) {
            currentItem = item;
            quantity = 1;
            toppingsPrice = 0;
            basePrice = 0;
            selectedSizeName = '';
            selectedToppingsList = [];

            document.getElementById('modalQuantity').innerText = '1';

            const imageArea = document.getElementById('modalImageArea');
            imageArea.style.backgroundColor = bgColor;

            let innerHtml = `<button onclick="closeOrderModal()" class="absolute top-4 right-4 bg-white/70 hover:bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center z-20 backdrop-blur-sm transition"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button>`;
            if (item.tag) {
                innerHtml += `<span class="absolute top-4 left-4 bg-[#354A3D] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider z-10 shadow-sm">${item.tag === 'hot' ? 'HOT' : 'MỚI'}</span>`;
            }
            if (item.image) {
                innerHtml += `<img src="{{ asset('images') }}/${item.image}" class="w-full h-full object-cover">`;
            } else {
                innerHtml += `<span class="text-7xl opacity-30 drop-shadow-sm">${emoji}</span>`;
            }
            imageArea.innerHTML = innerHtml;

            document.getElementById('modalTitle').innerText = item.name;

            const sizesDiv = document.getElementById('modalSizes');
            sizesDiv.innerHTML = '';
            document.getElementById('sizeSection').style.display = 'block';

            let isFirstSize = true;
            if (item.prices.S) {
                sizesDiv.innerHTML += createSizeButton('S', item.prices.S, isFirstSize);
                if (isFirstSize) { basePrice = item.prices.S; selectedSizeName = 'S'; isFirstSize = false; }
            }
            if (item.prices.L) {
                sizesDiv.innerHTML += createSizeButton('L', item.prices.L, isFirstSize);
                if (isFirstSize) { basePrice = item.prices.L; selectedSizeName = 'L'; isFirstSize = false; }
            }
            if (!item.prices.S && !item.prices.L && item.prices.default) {
                document.getElementById('sizeSection').style.display = 'none'; 
                basePrice = item.prices.default;
                selectedSizeName = 'Mặc định';
            }

            document.getElementById('modalBasePriceDisplay').innerText = `Từ ${basePrice}000đ`;

            document.querySelectorAll('.topping-btn').forEach(btn => {
                btn.dataset.selected = "false";
                btn.classList.remove('border-[#354A3D]', 'text-[#354A3D]', 'bg-[#354A3D]/5');
                btn.classList.add('border-black/10');
                btn.querySelector('span:first-child').classList.remove('text-[#354A3D]');
                btn.querySelector('span:last-child').classList.remove('text-[#354A3D]');
                btn.querySelector('span:last-child').classList.add('text-gray-400');
            });

            updateTotal();
            const modal = document.getElementById('orderModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden'; 
        }

        function createSizeButton(sizeName, price, isActive) {
            const activeClass = isActive ? 'bg-[#354A3D] text-white border-[#354A3D]' : 'bg-white text-gray-700 border-gray-300 hover:border-gray-400';
            return `<button onclick="selectSize('${sizeName}', ${price}, this)" class="size-btn flex-1 border rounded-xl py-3 text-sm font-medium transition-colors ${activeClass}">Size ${sizeName} — ${price}k</button>`;
        }

        function closeOrderModal() {
            document.getElementById('orderModal').classList.add('hidden');
            document.getElementById('orderModal').classList.remove('flex');
            document.body.style.overflow = 'auto'; 
        }

        function selectSize(sizeName, price, element) {
            basePrice = price;
            selectedSizeName = sizeName;
            document.querySelectorAll('.size-btn').forEach(btn => {
                btn.classList.remove('bg-[#354A3D]', 'text-white', 'border-[#354A3D]');
                btn.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
            });
            element.classList.add('bg-[#354A3D]', 'text-white', 'border-[#354A3D]');
            element.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
            updateTotal();
        }

        function toggleTopping(toppingName, price, element) {
            const isSelected = element.dataset.selected === "true";
            if (isSelected) {
                element.dataset.selected = "false";
                toppingsPrice -= price;
                selectedToppingsList = selectedToppingsList.filter(t => t !== toppingName);
                element.classList.remove('border-[#354A3D]', 'bg-[#354A3D]/5');
                element.classList.add('border-black/10');
                element.querySelector('span:first-child').classList.remove('text-[#354A3D]');
                element.querySelector('span:last-child').classList.remove('text-[#354A3D]');
                element.querySelector('span:last-child').classList.add('text-gray-400');
            } else {
                element.dataset.selected = "true";
                toppingsPrice += price;
                selectedToppingsList.push(toppingName);
                element.classList.add('border-[#354A3D]', 'bg-[#354A3D]/5');
                element.classList.remove('border-black/10');
                element.querySelector('span:first-child').classList.add('text-[#354A3D]');
                element.querySelector('span:last-child').classList.add('text-[#354A3D]');
                element.querySelector('span:last-child').classList.remove('text-gray-400');
            }
            updateTotal();
        }

        function changeQuantity(delta) {
            if (quantity + delta >= 1) {
                quantity += delta;
                document.getElementById('modalQuantity').innerText = quantity;
                updateTotal();
            }
        }

        function updateTotal() {
            const total = (basePrice + toppingsPrice) * quantity;
            document.getElementById('modalTotalPrice').innerText = formatPrice(total);
        }

        function submitOrder() {
            const cartItem = {
                id: Date.now().toString(),
                name: currentItem.name,
                size: selectedSizeName,
                toppings: [...selectedToppingsList],
                quantity: quantity,
                pricePerItem: basePrice + toppingsPrice,
                totalPrice: (basePrice + toppingsPrice) * quantity,
                image: currentItem.image ? currentItem.image : null
            };
            cart.push(cartItem);
            localStorage.setItem('fadegra_cart', JSON.stringify(cart));

            updateCartUI();
            closeOrderModal();
            openCartSidebar();
        }

        function updateCartUI() {
            const badge = document.getElementById('cartBadge');
            let totalQuantity = 0;
            let grandTotal = 0;

            cart.forEach(item => {
                totalQuantity += item.quantity;
                grandTotal += item.totalPrice;
            });

            if (totalQuantity > 0) {
                badge.innerText = totalQuantity;
                badge.classList.remove('hidden', 'scale-0');
                badge.classList.add('scale-100');
            } else {
                badge.classList.remove('scale-100');
                badge.classList.add('scale-0');
                setTimeout(() => badge.classList.add('hidden'), 300);
            }

            const container = document.getElementById('cartItemsContainer');
            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="h-full flex flex-col items-center justify-center text-gray-400 opacity-70">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mb-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                        <p>Giỏ hàng đang trống</p>
                    </div>`;
            } else {
                container.innerHTML = '';
                cart.forEach(item => {
                    const toppingText = item.toppings.length > 0 ? `(+${item.toppings.join(', ')})` : '';
                    container.innerHTML += `
                        <div class="bg-white p-4 rounded-xl border border-black/5 shadow-sm">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="font-bold text-[#1F2937] text-sm pr-4">${item.name}</h4>
                                <button onclick="removeFromCart('${item.id}')" class="text-red-400 hover:text-red-600 transition p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mb-2">Size ${item.size} <span class="text-[#354A3D] font-medium">${toppingText}</span></p>
                            <div class="flex justify-between items-center mt-3">
                                <span class="font-bold text-base text-[#354A3D]">${formatPrice(item.totalPrice)}</span>
                                <span class="text-xs font-semibold bg-[#F4EFEA] px-2.5 py-1 rounded text-gray-700">x${item.quantity}</span>
                            </div>
                        </div>
                    `;
                });
            }
            document.getElementById('cartSidebarTotal').innerText = formatPrice(grandTotal);
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            localStorage.setItem('fadegra_cart', JSON.stringify(cart));
            updateCartUI();
        }

        function openCartSidebar() {
            const sidebar = document.getElementById('cartSidebar');
            sidebar.classList.remove('hidden');
            sidebar.classList.add('flex');
            document.body.style.overflow = 'hidden'; 
        }

        function closeCartSidebar() {
            const sidebar = document.getElementById('cartSidebar');
            sidebar.classList.add('hidden');
            sidebar.classList.remove('flex');
            document.body.style.overflow = 'auto'; 
        }

        document.addEventListener("DOMContentLoaded", function() {
            updateCartUI();
        });
    </script>
@endsection