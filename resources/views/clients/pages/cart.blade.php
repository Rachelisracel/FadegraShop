@extends('layouts.client_menu')

@section('title', 'Giỏ hàng của bạn — FADEGRA')

@section('content')
<div class="bg-[#F8F6F2] min-h-screen font-sans pb-24 relative">
    
    <!-- HEADER -->
    <header class="bg-[#354A3D] pt-6 pb-6 px-6 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center gap-4">
            <a href="{{ url('/menu') }}" class="text-white hover:text-gray-300 transition-colors bg-white/10 p-2 rounded-full backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <h1 class="font-serif text-2xl text-white font-bold tracking-wide">Giỏ hàng của bạn</h1>
        </div>
    </header>

    <!-- NỘI DUNG GIỎ HÀNG -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-8 md:py-12">
        <div class="lg:grid lg:grid-cols-12 lg:gap-10 items-start">
            
            <!-- CỘT TRÁI: DANH SÁCH MÓN ĂN -->
            <div class="lg:col-span-8 space-y-6">
                <div class="flex justify-between items-end border-b border-gray-200 pb-4">
                    <h2 class="font-bold text-[#1F2937] text-lg">Danh sách món (<span id="totalItemsCount">0</span>)</h2>
                    <button onclick="removeAllItems()" class="text-sm font-medium text-red-500 hover:text-red-700 transition">Xóa tất cả</button>
                </div>

                <div id="cartItemsWrapper" class="space-y-6">
                    <!-- JS render danh sách giỏ hàng ở đây -->
                </div>
            </div>

            <!-- CỘT PHẢI: TỔNG KẾT ĐƠN HÀNG -->
            <div class="lg:col-span-4 mt-8 lg:mt-0">
                <div class="bg-white rounded-2xl shadow-sm border border-black/5 p-6 sticky top-28">
                    <h2 class="font-serif text-xl font-bold text-[#1F2937] mb-6">Tổng đơn hàng</h2>
                    
                    <div class="mb-6">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 block">Mã khuyến mãi</label>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Nhập mã..." class="flex-1 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] transition">
                            <button class="bg-[#E3D2BE] text-[#354A3D] font-bold px-4 py-2.5 rounded-xl hover:bg-[#D6C5B3] transition">Áp dụng</button>
                        </div>
                    </div>

                    <div class="space-y-4 border-b border-gray-100 pb-6 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Tạm tính</span>
                            <span id="subtotalPrice" class="font-medium text-gray-800">0k</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Phí giao hàng</span>
                            <span id="shippingPrice" class="font-medium text-gray-800">15k</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-8">
                        <span class="font-bold text-[#1F2937] text-lg">Tổng cộng</span>
                        <span id="grandTotalPrice" class="font-bold text-[#354A3D] text-2xl">0k</span>
                    </div>

                    <a href="{{ url('/checkout') }}" class="w-full bg-[#354A3D] text-white rounded-xl py-4 font-bold shadow-md hover:bg-[#2A4435] transition-colors flex justify-center items-center gap-2 block text-center">
    Thanh toán
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" /></svg>
</a>
                </div>
            </div>

        </div>
    </main>

    <!-- POPUP SẢN PHẨM (Dùng chung để sửa món) -->
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
                    <div class="grid grid-cols-2 gap-3" id="toppingContainer">
                        <!-- Render danh sách topping chuẩn bằng JS -->
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
                <button id="modalSubmitBtn" onclick="submitOrder()" class="w-full bg-[#354A3D] text-white rounded-full py-3.5 px-6 font-bold flex justify-between items-center shadow-md hover:bg-[#2A4435] transition-colors">
                    <span id="modalBtnText">Thêm vào giỏ hàng</span>
                    <span id="modalTotalPrice" class="bg-white/20 px-3 py-1 rounded-full text-sm">0k</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes slideUp { from { transform: translateY(100%); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
</style>

<script>
    const SHIPPING_FEE = 15;
    let cart = JSON.parse(localStorage.getItem('fadegra_cart')) || [];
    
    // Biến cho Popup Sửa món
    let editingIndex = null; // Nếu null là thêm mới, nếu có số là đang sửa ở vị trí index đó
    let currentItemData = null;
    let basePrice = 0;
    let quantity = 1;
    let toppingsPrice = 0;
    let selectedSizeName = '';
    let selectedToppingsList = [];

    // Danh sách giá các Topping đồng bộ
    const allToppings = [
        {name: 'Bánh Flan', price: 7},
        {name: 'Trân Châu Đen', price: 6},
        {name: 'Pudding (4)', price: 6},
        {name: 'Sương Sáo (8)', price: 6},
        {name: 'Trân Châu Giòn', price: 6},
        {name: 'Thạch Khoai Dẻo', price: 6},
        {name: 'Thạch Rau Câu', price: 6},
        {name: 'Đào (4)', price: 5},
        {name: 'Vải (3)', price: 6}
    ];

    const formatPrice = (price) => `${price}k`;

    // Render danh sách giỏ hàng
    function renderCart() {
        const wrapper = document.getElementById('cartItemsWrapper');
        let totalItems = 0;
        cart.forEach(item => totalItems += item.quantity);
        document.getElementById('totalItemsCount').innerText = totalItems;

        if (cart.length === 0) {
            wrapper.innerHTML = `
                <div class="bg-white rounded-2xl p-10 flex flex-col items-center justify-center text-gray-400 border border-black/5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mb-4 opacity-50"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                    <p class="text-gray-500 font-medium">Giỏ hàng của bạn đang trống</p>
                    <a href="{{ url('/menu') }}" class="mt-4 bg-[#354A3D] text-white px-6 py-2 rounded-full hover:bg-[#2A4435] transition">Tiếp tục mua hàng</a>
                </div>
            `;
            updateTotals();
            return;
        }

        let html = '';
        cart.forEach((item, index) => {
            const toppingText = item.toppings.length > 0 ? `(+ ${item.toppings.join(', ')})` : '';
            const imageHtml = item.image 
                ? `<img src="{{ asset('images') }}/${item.image}" class="w-full h-full object-cover">`
                : `<span class="text-4xl opacity-30">🧋</span>`;

            html += `
                <div class="bg-white rounded-2xl p-4 sm:p-5 flex gap-4 sm:gap-6 shadow-sm border border-black/5 relative group">
                    <div class="w-20 h-20 sm:w-28 sm:h-28 bg-[#D6C5B3] rounded-xl overflow-hidden flex-shrink-0 flex items-center justify-center">
                        ${imageHtml}
                    </div>
                    
                    <div class="flex-1 flex flex-col justify-between">
                        <div class="pr-16">
                            <h3 class="font-bold text-[#1F2937] text-base sm:text-lg mb-1">${item.name}</h3>
                            <p class="text-sm text-gray-500 mb-2">Size ${item.size} <span class="text-[#354A3D] font-medium">${toppingText}</span></p>
                        </div>
                        
                        <div class="flex flex-wrap justify-between items-center gap-4 mt-auto">
                            <div class="flex items-center gap-3 bg-gray-50 rounded-full px-2 py-1 border border-gray-200">
                                <button onclick="updateQuantityDirect(${index}, -1)" class="w-7 h-7 rounded-full bg-white flex items-center justify-center text-gray-600 font-bold hover:bg-gray-200 transition shadow-sm">-</button>
                                <span class="font-bold text-sm text-[#1F2937] w-4 text-center">${item.quantity}</span>
                                <button onclick="updateQuantityDirect(${index}, 1)" class="w-7 h-7 rounded-full bg-[#354A3D] text-white flex items-center justify-center font-bold hover:bg-[#2A4435] transition shadow-sm">+</button>
                            </div>
                            <span class="font-bold text-lg text-[#354A3D]">${item.totalPrice}k</span>
                        </div>
                    </div>

                    <div class="absolute top-4 right-4 flex items-center gap-2">
                        <!-- Nút Sửa -->
                        <button onclick="openEditModal(${index})" title="Sửa món" class="text-gray-400 hover:text-[#354A3D] transition p-1 bg-gray-50 hover:bg-gray-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                        </button>
                        <!-- Nút Xóa -->
                        <button onclick="removeCartItem(${index})" title="Xóa món" class="text-gray-300 hover:text-red-500 transition p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                </div>
            `;
        });

        wrapper.innerHTML = html;
        updateTotals();
    }

    // Tăng giảm nhanh trực tiếp tại giỏ hàng
    function updateQuantityDirect(index, delta) {
        if (cart[index].quantity + delta >= 1) {
            cart[index].quantity += delta;
            cart[index].totalPrice = cart[index].quantity * cart[index].pricePerItem;
            localStorage.setItem('fadegra_cart', JSON.stringify(cart));
            renderCart();
        }
    }

    // MỞ POPUP Ở CHẾ ĐỘ SỬA MÓN
    function openEditModal(index) {
        editingIndex = index;
        const itemToEdit = cart[index];
        
        // Tìm thông tin giá gốc dựa vào tên món
        currentItemData = getProductDataByName(itemToEdit.name);
        if(!currentItemData) return;

        quantity = itemToEdit.quantity;
        selectedSizeName = itemToEdit.size;
        selectedToppingsList = [...itemToEdit.toppings];

        // Xác định basePrice dựa trên size hiện tại
        if (selectedSizeName === 'S' && currentItemData.prices.S) basePrice = currentItemData.prices.S;
        else if (selectedSizeName === 'L' && currentItemData.prices.L) basePrice = currentItemData.prices.L;
        else if (currentItemData.prices.default) basePrice = currentItemData.prices.default;
        else basePrice = 20;

        // Tính lại giá topping
        toppingsPrice = 0;
        selectedToppingsList.forEach(tName => {
            const found = allToppings.find(t => t.name === tName);
            if(found) toppingsPrice += found.price;
        });

        document.getElementById('modalQuantity').innerText = quantity;
        document.getElementById('modalTitle').innerText = currentItemData.name;
        document.getElementById('modalBtnText').innerText = 'Cập nhật món';

        // Render Vùng Ảnh
        const imageArea = document.getElementById('modalImageArea');
        imageArea.style.backgroundColor = currentItemData.bg_color || '#D6C5B3';
        let innerHtml = `<button onclick="closeOrderModal()" class="absolute top-4 right-4 bg-white/70 hover:bg-white text-gray-800 rounded-full w-8 h-8 flex items-center justify-center z-20 backdrop-blur-sm transition"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button>`;
        if (currentItemData.image) {
            innerHtml += `<img src="{{ asset('images') }}/${currentItemData.image}" class="w-full h-full object-cover">`;
        } else {
            innerHtml += `<span class="text-7xl opacity-30 drop-shadow-sm">🧋</span>`;
        }
        imageArea.innerHTML = innerHtml;

        // Render Size
        const sizesDiv = document.getElementById('modalSizes');
        sizesDiv.innerHTML = '';
        document.getElementById('sizeSection').style.display = 'block';

        if (currentItemData.prices.S) {
            sizesDiv.innerHTML += createSizeButton('S', currentItemData.prices.S, selectedSizeName === 'S');
        }
        if (currentItemData.prices.L) {
            sizesDiv.innerHTML += createSizeButton('L', currentItemData.prices.L, selectedSizeName === 'L');
        }
        if (!currentItemData.prices.S && !currentItemData.prices.L) {
            document.getElementById('sizeSection').style.display = 'none';
        }

        // Render Topping
        const toppingContainer = document.getElementById('toppingContainer');
        toppingContainer.innerHTML = '';
        allToppings.forEach(top => {
            const isChecked = selectedToppingsList.includes(top.name);
            const activeClass = isChecked ? 'border-[#354A3D] bg-[#354A3D]/5 text-[#354A3D]' : 'border-black/10 text-gray-700';
            const priceClass = isChecked ? 'text-[#354A3D]' : 'text-gray-400';
            
            toppingContainer.innerHTML += `
                <button onclick="toggleTopping('${top.name}', ${top.price}, this)" 
                        data-selected="${isChecked}"
                        class="topping-btn bg-white border ${activeClass} rounded-xl p-3 flex justify-between items-center text-[13px] transition-colors">
                    <span class="font-medium">${top.name}</span>
                    <span class="${priceClass}">+${top.price}k</span>
                </button>
            `;
        });

        updateTotal();
        const modal = document.getElementById('orderModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    // Dữ liệu mẫu hỗ trợ nhận diện món khi sửa
    function getProductDataByName(name) {
        const menuList = [
            {name: 'Trà Sữa Truyền Thống', prices: {S: 20, L: 25}, image: 'hongtra.JPG', bg_color: '#D6C5B3'},
            {name: 'Matcha Latte Oatside Vị Nguyên Bản', prices: {L: 28}, image: 'matchalatte.jpg', bg_color: '#D6C5B3'},
            {name: 'Trà Đào', prices: {S: 20, L: 25}, image: 'tradao.jpg', bg_color: '#C5D6BF'},
            {name: 'Ô Long Bí Đao', prices: {L: 15}, image: 'olong-bidao.jpg', bg_color: '#C5D6BF'},
            {name: 'Hồng Trà Trân Châu', prices: {S: 20, L: 25}, image: 'hongtra.JPG', bg_color: '#C5D6BF'},
            {name: 'Dưa Lưới', prices: {S: 20, L: 25}, image: 'tradualuoi.JPG', bg_color: '#C5D6BF'},
            {name: 'Việt Quất', prices: {S: 20, L: 25}, image: 'travq.JPG', bg_color: '#C5D6BF'},
            {name: 'Vải', prices: {S: 20, L: 25}, image: 'travai.JPG', bg_color: '#C5D6BF'},
            {name: 'Dâu', prices: {S: 20, L: 25}, image: 'tradau.JPG', bg_color: '#C5D6BF'},
            {name: 'Matcha', prices: {L: 28}, image: 'trasuamatcha.JPG', bg_color: '#D6C5B3'},
            {name: 'Chocolate', prices: {S: 20, L: 25}, image: 'chocolate.jpg', bg_color: '#D6C5B3'},
            {name: 'Khoai Môn', prices: {S: 20, L: 25}, image: 'trasuakhoaimon.JPG', bg_color: '#D6C5B3'},
            {name: 'Thái Xanh', prices: {S: 20, L: 25}, image: 'thaixanh.jpg', bg_color: '#D6C5B3'},
            {name: 'Sữa Tươi Trân Châu Đường Đen', prices: {S: 25, L: 30}, image: 'suatuoi.jpg', bg_color: '#E8E0D5'},
            {name: 'Milo Dầm Trân Châu Đường Đen', prices: {L: 25}, image: 'milo.jpg', bg_color: '#C5C5D6'}
        ];
        return menuList.find(m => m.name === name) || {name: name, prices: {S: 20, L: 25}, image: null, bg_color: '#D6C5B3'};
    }

    function createSizeButton(sizeName, price, isActive) {
        const activeClass = isActive ? 'bg-[#354A3D] text-white border-[#354A3D]' : 'bg-white text-gray-700 border-gray-300 hover:border-gray-400';
        return `<button onclick="selectSize('${sizeName}', ${price}, this)" class="size-btn flex-1 border rounded-xl py-3 text-sm font-medium transition-colors ${activeClass}">Size ${sizeName} — ${price}k</button>`;
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
        document.getElementById('orderModal').classList.remove('flex');
        document.body.style.overflow = 'auto';
        editingIndex = null;
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
            element.classList.remove('border-[#354A3D]', 'bg-[#354A3D]/5', 'text-[#354A3D]');
            element.classList.add('border-black/10', 'text-gray-700');
            element.querySelector('span:last-child').classList.remove('text-[#354A3D]');
            element.querySelector('span:last-child').classList.add('text-gray-400');
        } else {
            element.dataset.selected = "true";
            toppingsPrice += price;
            selectedToppingsList.push(toppingName);
            element.classList.add('border-[#354A3D]', 'bg-[#354A3D]/5', 'text-[#354A3D]');
            element.classList.remove('border-black/10', 'text-gray-700');
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

    // LƯU HOẶC CẬP NHẬT MÓN
    function submitOrder() {
        const updatedItem = {
            id: editingIndex !== null ? cart[editingIndex].id : Date.now().toString(),
            product_id: editingIndex !== null ? cart[editingIndex].product_id : currentItemData.id,
            name: currentItemData.name,
            size: selectedSizeName || 'Mặc định',
            toppings: [...selectedToppingsList],
            quantity: quantity,
            pricePerItem: basePrice + toppingsPrice,
            totalPrice: (basePrice + toppingsPrice) * quantity,
            image: currentItemData.image || null
        };

        if (editingIndex !== null) {
            // Đang sửa món cũ
            cart[editingIndex] = updatedItem;
        } else {
            // Thêm mới
            cart.push(updatedItem);
        }

        localStorage.setItem('fadegra_cart', JSON.stringify(cart));
        closeOrderModal();
        renderCart();
    }

    function removeCartItem(index) {
        cart.splice(index, 1);
        localStorage.setItem('fadegra_cart', JSON.stringify(cart));
        renderCart();
    }

    function removeAllItems() {
        if(cart.length === 0) return;
        if(confirm('Bạn có chắc muốn xóa tất cả món trong giỏ hàng?')) {
            cart = [];
            localStorage.setItem('fadegra_cart', JSON.stringify(cart));
            renderCart();
        }
    }

    function updateTotals() {
        let subtotal = 0;
        let totalItems = 0;
        cart.forEach(item => {
            subtotal += item.totalPrice;
            totalItems += item.quantity;
        });

        let currentShipping = (totalItems > 0) ? SHIPPING_FEE : 0;
        let grandTotal = subtotal + currentShipping;

        document.getElementById('subtotalPrice').innerText = subtotal + 'k';
        document.getElementById('shippingPrice').innerText = currentShipping + 'k';
        document.getElementById('grandTotalPrice').innerText = grandTotal + 'k';
    }

    document.addEventListener("DOMContentLoaded", function() {
        renderCart();
    });
</script>
@endsection