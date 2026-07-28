@extends('layouts.client_menu')

@section('title', 'Tìm kiếm sản phẩm — FADEGRA')

@section('content')

@php
// Lấy từ khóa khách hàng tìm kiếm trên URL (VD: ?q=Trà)
$searchQuery = request()->input('q');

// Dữ liệu mẫu toàn bộ Menu (Giả lập Database)
$allProducts = [
    ['id' => 'bs1', 'name' => 'Trà Sữa Truyền Thống', 'prices' => ['S' => 20, 'L' => 25], 'tag' => 'hot', 'image' => 'hongtra.JPG', 'bg_color' => '#D6C5B3', 'emoji' => '🧋'],
    ['id' => 'bs2', 'name' => 'Matcha Latte Oatside', 'prices' => ['S' => 28, 'L' => 35], 'image' => 'matchalatte.jpg', 'bg_color' => '#C5D6BF', 'emoji' => '🍵'],
    ['id' => 'bs3', 'name' => 'Trà Đào', 'prices' => ['S' => 20, 'L' => 25], 'tag' => 'hot', 'image' => 'tradao.jpg', 'bg_color' => '#C5D6BF', 'emoji' => '🍃'],
    ['id' => 't1', 'name' => 'Hồng Trà', 'prices' => ['S' => 15, 'L' => 20], 'image' => 'hongtra.JPG', 'bg_color' => '#E3D2BE', 'emoji' => '🍃'],
    ['id' => 't2', 'name' => 'Hồng Trà Trân Châu', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'hongtra.JPG', 'bg_color' => '#C5D6BF', 'emoji' => '🍃'],
    ['id' => 'ts6', 'name' => 'Trà Sữa Thái Xanh', 'prices' => ['S' => 20, 'L' => 25], 'image' => 'thaixanh.jpg', 'bg_color' => '#D6C5B3', 'emoji' => '🧋'],
    ['id' => 'f1', 'name' => 'Cà phê Đen Đá', 'prices' => ['default' => 18], 'image' => 'caphe.jpg', 'bg_color' => '#C5D6BF', 'emoji' => '☕'],
];

// Lọc sản phẩm theo từ khóa (Nếu không có từ khóa thì hiển thị rỗng)
$searchResults = [];
if (!empty($searchQuery)) {
    foreach ($allProducts as $product) {
        // Tìm kiếm không phân biệt chữ hoa chữ thường
        if (stripos($product['name'], $searchQuery) !== false) {
            $searchResults[] = $product;
        }
    }
} else {
    // Nếu chưa nhập gì, hiển thị tất cả (hoặc bạn có thể để trống tùy ý)
    $searchResults = $allProducts; 
}

// Dữ liệu Topping
$toppings = [
    ['id' => 'tp1', 'name' => 'Bánh Flan', 'prices' => ['default' => 7]],
    ['id' => 'tp2', 'name' => 'Trân Châu Đen', 'prices' => ['default' => 6]],
    ['id' => 'tp3', 'name' => 'Pudding (4)', 'prices' => ['default' => 6]],
    ['id' => 'tp4', 'name' => 'Sương Sáo (8)', 'prices' => ['default' => 6]],
];
@endphp

<div class="bg-[#F8F6F2] min-h-screen pb-24 font-sans relative">
    
    <!-- HEADER & THANH TÌM KIẾM TRÊN TRANG -->
    <header class="bg-[#354A3D] pt-6 pb-8 px-6 sticky top-0 z-50 shadow-sm rounded-b-3xl">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center gap-3 mb-6">
                <a href="{{ url('/menu') }}" class="text-white hover:text-gray-300 transition-colors bg-white/10 p-2 rounded-full backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </a>
                <h1 class="font-serif text-2xl text-white font-bold tracking-wide">Tìm kiếm</h1>
            </div>

            <!-- Form Tìm Kiếm (Luôn hiển thị lại từ khóa khách vừa nhập) -->
            <form action="{{ url('/search') }}" method="GET" class="relative">
                <input type="text" name="q" value="{{ $searchQuery }}" placeholder="Bạn đang thèm món gì?" autofocus
                       class="w-full bg-white text-gray-800 border-none rounded-2xl pl-14 pr-4 py-4 text-base shadow-lg focus:outline-none focus:ring-4 focus:ring-[#354A3D]/30 transition-all placeholder:text-gray-400 font-medium">
                <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#354A3D] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </button>
            </form>
        </div>
    </header>

    <!-- KẾT QUẢ TÌM KIẾM -->
    <main class="max-w-7xl mx-auto px-6 py-10 space-y-8">
        
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h2 class="font-bold text-[#1F2937] text-lg">
                @if($searchQuery)
                    Kết quả cho: <span class="text-[#354A3D]">"{{ $searchQuery }}"</span>
                @else
                    Gợi ý món ngon cho bạn
                @endif
            </h2>
            <span class="text-sm font-medium text-[#354A3D] bg-[#354A3D]/10 px-3 py-1 rounded-full">{{ count($searchResults) }} món</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @forelse($searchResults as $item)
                <!-- Thẻ Sản Phẩm -->
                <div onclick='openOrderModal(@json($item), "{{ $item['bg_color'] }}", "{{ $item['emoji'] }}")' 
                     class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer flex flex-col border border-black/5 group hover:-translate-y-1">
                    
                    <!-- Phần Ảnh -->
                    <div class="relative h-[180px] md:h-[220px] overflow-hidden flex items-center justify-center transition-colors" style="background-color: {{ $item['bg_color'] }}">
                        @if(isset($item['image']))
                            <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
                        @else
                            <span class="text-6xl opacity-30 drop-shadow-sm transition-transform duration-500 group-hover:scale-110">{{ $item['emoji'] }}</span>
                        @endif

                        @if(isset($item['tag']))
                            <span class="absolute top-3 left-3 bg-[#354A3D] text-white text-[9px] md:text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm z-10">
                                {{ $item['tag'] === 'hot' ? 'HOT' : 'MỚI' }}
                            </span>
                        @endif

                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-20">
                            <span class="bg-white text-gray-800 text-xs font-bold px-5 py-2 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Đặt ngay
                            </span>
                        </div>
                    </div>

                    <!-- Phần Thông Tin -->
                    <div class="p-4 md:p-5 flex-1 flex flex-col">
                        <h3 class="font-bold text-[#1F2937] text-sm md:text-base mb-3 leading-snug group-hover:text-[#354A3D] transition-colors">{{ $item['name'] }}</h3>
                        <div class="flex flex-wrap gap-2 mt-auto">
                            @if(isset($item['prices']['S']))
                                <span class="bg-[#F4EFEA] text-gray-700 text-[11px] md:text-xs px-2.5 py-1 rounded-md font-semibold">S: {{ $item['prices']['S'] }}k</span>
                            @endif
                            @if(isset($item['prices']['L']))
                                <span class="bg-[#F4EFEA] text-gray-700 text-[11px] md:text-xs px-2.5 py-1 rounded-md font-semibold">L: {{ $item['prices']['L'] }}k</span>
                            @endif
                            @if(isset($item['prices']['default']))
                                <span class="bg-[#F4EFEA] text-gray-700 text-[11px] md:text-xs px-2.5 py-1 rounded-md font-semibold">{{ $item['prices']['default'] }}k</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <!-- Trạng thái trống (Không tìm thấy món) -->
                <div class="col-span-full py-20 flex flex-col items-center justify-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 mb-4 opacity-40"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" /></svg>
                    <p class="font-bold text-xl text-gray-600">Rất tiếc, không tìm thấy món nào!</p>
                    <p class="text-sm mt-2 font-medium">Hãy thử với từ khóa khác (ví dụ: Sữa tươi, Hồng trà, Đào...)</p>
                </div>
            @endforelse
        </div>
    </main>

    <!-- NÚT GIỎ HÀNG NỔI (FAB) -->
    <button onclick="openCartSidebar()" class="fixed bottom-8 right-8 bg-[#354A3D] text-white p-4 rounded-full shadow-xl hover:scale-105 transition-transform z-[60] flex items-center justify-center">
        <span id="cartBadge" class="absolute -top-2 -right-2 bg-[#F5A623] text-white text-[11px] font-bold w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F8F6F2] hidden transition-all duration-300 transform scale-0">0</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
    </button>

    <!-- POPUP ĐẶT HÀNG (MODAL) VÀ SIDEBAR GIỎ HÀNG -->
    <!-- (Mình đặt include riêng nếu dự án thật, ở đây viết gộp luôn để bạn copy 1 lần ăn ngay) -->
    <div id="orderModal" class="fixed inset-0 z-[100] hidden flex-col justify-end sm:justify-center items-center">
        <div class="absolute inset-0 bg-black/40 transition-opacity" onclick="closeOrderModal()"></div>
        <div class="bg-[#F9F6F0] w-full max-w-lg max-h-[90vh] sm:rounded-2xl rounded-t-3xl relative z-10 flex flex-col shadow-2xl animate-[slideUp_0.3s_ease-out]">
            <div id="modalImageArea" class="h-48 sm:h-56 relative flex items-center justify-center sm:rounded-t-2xl rounded-t-3xl overflow-hidden bg-[#D6C5B3]">
                <button onclick="closeOrderModal()" class="absolute top-4 right-4 bg-white/70 hover:bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center z-20 backdrop-blur-sm transition"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button>
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
                        @foreach($toppings as $topping)
                            <button onclick="toggleTopping('{{ $topping['name'] }}', {{ $topping['prices']['default'] }}, this)" class="topping-btn bg-white border border-black/10 rounded-xl p-3 flex justify-between items-center text-[13px] transition-colors"><span class="font-medium text-gray-700">{{ $topping['name'] }}</span><span class="text-gray-400">+{{ $topping['prices']['default'] }}k</span></button>
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

    <!-- SIDEBAR GIỎ HÀNG -->
    <div id="cartSidebar" class="fixed inset-0 z-[110] hidden justify-end">
        <div class="absolute inset-0 bg-black/40 transition-opacity" onclick="closeCartSidebar()"></div>
        <div class="bg-[#F9F6F0] w-full max-w-md h-full relative z-10 flex flex-col shadow-2xl animate-[slideLeft_0.3s_ease-out]">
            <div class="p-5 border-b border-black/5 bg-white flex justify-between items-center">
                <h2 class="font-serif text-xl font-bold text-[#1F2937]">Giỏ hàng của bạn</h2>
                <button onclick="closeCartSidebar()" class="text-gray-500 hover:text-gray-800 transition"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>
            <div id="cartItemsContainer" class="flex-1 overflow-y-auto p-5 space-y-4"></div>
            <div class="p-5 bg-white border-t border-black/5 shadow-[0_-4px_10px_rgba(0,0,0,0.02)]">
                <div class="flex justify-between font-bold text-[#1F2937] text-lg mb-4">
                    <span>Tổng cộng:</span><span id="cartSidebarTotal">0k</span>
                </div>
                <a href="{{ url('/cart') }}" class="w-full bg-[#354A3D] text-white rounded-full py-4 px-6 font-bold shadow-md hover:bg-[#2A4435] transition-colors flex justify-center text-center block">Tiến hành Thanh toán</a>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes slideUp { from { transform: translateY(100%); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    @keyframes slideLeft { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
</style>

<script>
    // --- KHỐI JAVASCRIPT ĐẶT HÀNG / GIỎ HÀNG (GIỐNG TRANG MENU) ---
    let cart = JSON.parse(localStorage.getItem('fadegra_cart')) || [];
    let currentItem = null, basePrice = 0, quantity = 1, toppingsPrice = 0, selectedSizeName = '', selectedToppingsList = [];
    const formatPrice = (price) => `${price}k`;

    function openOrderModal(item, bgColor, emoji) {
        currentItem = item; quantity = 1; toppingsPrice = 0; basePrice = 0; selectedSizeName = ''; selectedToppingsList = [];
        document.getElementById('modalQuantity').innerText = '1';
        
        const imageArea = document.getElementById('modalImageArea');
        imageArea.style.backgroundColor = bgColor;
        let innerHtml = `<button onclick="closeOrderModal()" class="absolute top-4 right-4 bg-white/70 hover:bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center z-20 backdrop-blur-sm transition"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button>`;
        if (item.tag) innerHtml += `<span class="absolute top-4 left-4 bg-[#354A3D] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider z-10 shadow-sm">${item.tag === 'hot' ? 'HOT' : 'MỚI'}</span>`;
        if (item.image) innerHtml += `<img src="{{ asset('images/') }}/${item.image}" class="w-full h-full object-cover">`;
        else innerHtml += `<span class="text-7xl opacity-30 drop-shadow-sm">${emoji}</span>`;
        imageArea.innerHTML = innerHtml;
        document.getElementById('modalTitle').innerText = item.name;
        
        const sizesDiv = document.getElementById('modalSizes'); sizesDiv.innerHTML = '';
        document.getElementById('sizeSection').style.display = 'block';
        let isFirstSize = true;
        if (item.prices.S) { sizesDiv.innerHTML += createSizeButton('S', item.prices.S, isFirstSize); if (isFirstSize) { basePrice = item.prices.S; selectedSizeName = 'S'; isFirstSize = false; } }
        if (item.prices.L) { sizesDiv.innerHTML += createSizeButton('L', item.prices.L, isFirstSize); if (isFirstSize) { basePrice = item.prices.L; selectedSizeName = 'L'; isFirstSize = false; } }
        if (!item.prices.S && !item.prices.L && item.prices.default) { document.getElementById('sizeSection').style.display = 'none'; basePrice = item.prices.default; selectedSizeName = 'Mặc định'; }
        
        document.getElementById('modalBasePriceDisplay').innerText = `Từ ${basePrice}000đ`;
        document.querySelectorAll('.topping-btn').forEach(btn => { btn.dataset.selected = "false"; btn.classList.remove('border-[#354A3D]', 'text-[#354A3D]', 'bg-[#354A3D]/5'); btn.classList.add('border-black/10'); btn.querySelector('span:first-child').classList.remove('text-[#354A3D]'); btn.querySelector('span:last-child').classList.remove('text-[#354A3D]'); btn.querySelector('span:last-child').classList.add('text-gray-400'); });
        
        updateTotal();
        const modal = document.getElementById('orderModal'); modal.classList.remove('hidden'); modal.classList.add('flex'); document.body.style.overflow = 'hidden'; 
    }

    function createSizeButton(sizeName, price, isActive) {
        const activeClass = isActive ? 'bg-[#354A3D] text-white border-[#354A3D]' : 'bg-white text-gray-700 border-gray-300 hover:border-gray-400';
        return `<button onclick="selectSize('${sizeName}', ${price}, this)" class="size-btn flex-1 border rounded-xl py-3 text-sm font-medium transition-colors ${activeClass}">Size ${sizeName} — ${price}k</button>`;
    }

    function closeOrderModal() { document.getElementById('orderModal').classList.add('hidden'); document.getElementById('orderModal').classList.remove('flex'); document.body.style.overflow = 'auto'; }

    function selectSize(sizeName, price, element) {
        basePrice = price; selectedSizeName = sizeName;
        document.querySelectorAll('.size-btn').forEach(btn => { btn.classList.remove('bg-[#354A3D]', 'text-white', 'border-[#354A3D]'); btn.classList.add('bg-white', 'text-gray-700', 'border-gray-300'); });
        element.classList.add('bg-[#354A3D]', 'text-white', 'border-[#354A3D]'); element.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
        updateTotal();
    }

    function toggleTopping(toppingName, price, element) {
        if (element.dataset.selected === "true") {
            element.dataset.selected = "false"; toppingsPrice -= price; selectedToppingsList = selectedToppingsList.filter(t => t !== toppingName);
            element.classList.remove('border-[#354A3D]', 'bg-[#354A3D]/5'); element.classList.add('border-black/10'); element.querySelector('span:first-child').classList.remove('text-[#354A3D]'); element.querySelector('span:last-child').classList.remove('text-[#354A3D]'); element.querySelector('span:last-child').classList.add('text-gray-400');
        } else {
            element.dataset.selected = "true"; toppingsPrice += price; selectedToppingsList.push(toppingName);
            element.classList.add('border-[#354A3D]', 'bg-[#354A3D]/5'); element.classList.remove('border-black/10'); element.querySelector('span:first-child').classList.add('text-[#354A3D]'); element.querySelector('span:last-child').classList.add('text-[#354A3D]'); element.querySelector('span:last-child').classList.remove('text-gray-400');
        }
        updateTotal();
    }

    function changeQuantity(delta) { if (quantity + delta >= 1) { quantity += delta; document.getElementById('modalQuantity').innerText = quantity; updateTotal(); } }
    function updateTotal() { document.getElementById('modalTotalPrice').innerText = formatPrice((basePrice + toppingsPrice) * quantity); }

    function submitOrder() {
        cart.push({ id: Date.now().toString(), name: currentItem.name, size: selectedSizeName, toppings: [...selectedToppingsList], quantity: quantity, pricePerItem: basePrice + toppingsPrice, totalPrice: (basePrice + toppingsPrice) * quantity, image: currentItem.image ? currentItem.image : null });
        localStorage.setItem('fadegra_cart', JSON.stringify(cart));
        updateCartUI(); closeOrderModal(); openCartSidebar();
    }

    function updateCartUI() {
        const badge = document.getElementById('cartBadge'), container = document.getElementById('cartItemsContainer');
        let totalQuantity = 0, grandTotal = 0;
        cart.forEach(item => { totalQuantity += item.quantity; grandTotal += item.totalPrice; });
        if (totalQuantity > 0) { badge.innerText = totalQuantity; badge.classList.remove('hidden', 'scale-0'); badge.classList.add('scale-100'); } 
        else { badge.classList.remove('scale-100'); badge.classList.add('scale-0'); setTimeout(() => badge.classList.add('hidden'), 300); }

        if (cart.length === 0) {
            container.innerHTML = `<div class="h-full flex flex-col items-center justify-center text-gray-400 opacity-70"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mb-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg><p>Giỏ hàng đang trống</p></div>`;
        } else {
            container.innerHTML = '';
            cart.forEach(item => {
                const toppingText = item.toppings.length > 0 ? `(+${item.toppings.join(', ')})` : '';
                container.innerHTML += `<div class="bg-white p-4 rounded-xl border border-black/5 shadow-sm"><div class="flex justify-between items-start mb-1"><h4 class="font-bold text-[#1F2937] text-sm pr-4">${item.name}</h4><button onclick="removeFromCart('${item.id}')" class="text-red-400 hover:text-red-600 transition p-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button></div><p class="text-xs text-gray-500 mb-2">Size ${item.size} <span class="text-[#354A3D] font-medium">${toppingText}</span></p><div class="flex justify-between items-center mt-3"><span class="font-bold text-base text-[#354A3D]">${formatPrice(item.totalPrice)}</span><span class="text-xs font-semibold bg-[#F4EFEA] px-2.5 py-1 rounded text-gray-700">x${item.quantity}</span></div></div>`;
            });
        }
        document.getElementById('cartSidebarTotal').innerText = formatPrice(grandTotal);
    }

    function removeFromCart(id) { cart = cart.filter(item => item.id !== id); localStorage.setItem('fadegra_cart', JSON.stringify(cart)); updateCartUI(); }
    function openCartSidebar() { const sidebar = document.getElementById('cartSidebar'); sidebar.classList.remove('hidden'); sidebar.classList.add('flex'); document.body.style.overflow = 'hidden'; }
    function closeCartSidebar() { const sidebar = document.getElementById('cartSidebar'); sidebar.classList.add('hidden'); sidebar.classList.remove('flex'); document.body.style.overflow = 'auto'; }

    document.addEventListener("DOMContentLoaded", function() { updateCartUI(); });
</script>
@endsection