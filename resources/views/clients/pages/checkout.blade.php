@extends('layouts.client_menu')

@section('title', 'Thanh toán đơn hàng — FADEGRA')

@section('content')
<div class="bg-[#F8F6F2] min-h-screen font-sans py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        <!-- LOGO / TIÊU ĐỀ THƯƠNG HIỆU -->
        <div class="mb-8">
            <h1 class="font-serif text-3xl font-bold text-[#354A3D] tracking-wide">Fadegra®</h1>
        </div>

        <form onsubmit="handleCheckout(event)" class="lg:grid lg:grid-cols-12 lg:gap-12 items-start">
            
            <!-- CỘT TRÁI: THÔNG TIN GIAO HÀNG & THANH TOÁN -->
            <div class="lg:col-span-7 space-y-8">
                
                <!-- 1. Thông tin nhận hàng -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-black/5 space-y-5">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="font-serif text-xl font-bold text-[#1F2937]">Thông tin nhận hàng</h2>
                        <a href="#" class="text-sm text-[#354A3D] font-medium hover:underline flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            Đăng nhập
                        </a>
                    </div>

                    <div>
                        <input type="email" required placeholder="Email" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition">
                    </div>
                    <div>
                        <input type="text" required placeholder="Họ và tên" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition">
                    </div>
                    <div class="relative">
                        <input type="tel" required placeholder="Số điện thoại" class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-4 pr-16 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition">
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center gap-1 bg-gray-100 px-2 py-1 rounded text-xs font-medium text-gray-600">
                            🇻🇳 ▾
                        </div>
                    </div>
                    <div>
                        <input type="text" required placeholder="Địa chỉ (Ví dụ: 123 Nguyễn Huệ)" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition">
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <select class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-3 text-sm text-gray-600 focus:outline-none focus:border-[#354A3D]">
                            <option>Tỉnh thành</option>
                            <option>Hồ Chí Minh</option>
                            <option>Hà Nội</option>
                        </select>
                        <select class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-3 text-sm text-gray-600 focus:outline-none focus:border-[#354A3D]">
                            <option>Quận huyện</option>
                            <option>Quận 1</option>
                            <option>Quận 3</option>
                        </select>
                        <select class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-3 text-sm text-gray-600 focus:outline-none focus:border-[#354A3D]">
                            <option>Phường xã</option>
                            <option>Phường Bến Nghé</option>
                        </select>
                    </div>

                    <div>
                        <textarea rows="2" placeholder="Ghi chú (tuỳ chọn)" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition"></textarea>
                    </div>
                </div>

                <!-- 2. Vận chuyển -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-black/5 space-y-4">
                    <h2 class="font-serif text-xl font-bold text-[#1F2937]">Vận chuyển</h2>
                    <div class="bg-[#EBF3F0] border border-[#354A3D]/20 text-[#354A3D] p-4 rounded-xl text-sm font-medium">
                        Vui lòng nhập thông tin giao hàng để hiển thị phương thức vận chuyển.
                    </div>
                </div>

                <!-- 3. Thanh toán -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-black/5 space-y-4">
                    <h2 class="font-serif text-xl font-bold text-[#1F2937]">Thanh toán</h2>
                    <label class="flex items-center justify-between p-4 rounded-xl border border-[#354A3D] bg-[#354A3D]/5 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <input type="radio" checked name="payment" class="w-4 h-4 text-[#354A3D] accent-[#354A3D]">
                            <span class="text-sm font-bold text-[#1F2937]">Thanh toán khi giao hàng (COD)</span>
                        </div>
                        <span class="text-xl">💵</span>
                    </label>
                </div>
            </div>

            <!-- CỘT PHẢI: TÓM TẮT ĐƠN HÀNG (DỮ LIỆU TỰ ĐỘNG ĐỌC TỪ LOCALSTORAGE) -->
            <div class="lg:col-span-5 mt-8 lg:mt-0">
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-black/5 sticky top-8 space-y-6">
                    
                    <h2 id="orderSummaryTitle" class="font-serif text-xl font-bold text-[#1F2937] border-b border-gray-100 pb-4">
                        Đơn hàng (0 sản phẩm)
                    </h2>

                    <!-- Danh sách sản phẩm render từ JS -->
                    <div id="checkoutItemsList" class="space-y-4 max-h-72 overflow-y-auto pr-2">
                        <!-- JS đổ dữ liệu vào đây -->
                    </div>

                    <!-- Ô nhập mã giảm giá -->
                    <div class="flex gap-2 pt-2">
                        <input type="text" placeholder="Nhập mã giảm giá" class="flex-1 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D]">
                        <button type="button" class="bg-[#354A3D]/10 text-[#354A3D] font-bold px-5 py-2.5 rounded-xl hover:bg-[#354A3D] hover:text-white transition">Áp dụng</button>
                    </div>

                    <!-- Chi tiết tiền -->
                    <div class="space-y-3 border-y border-gray-100 py-4 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Tạm tính</span>
                            <span id="checkoutSubtotal" class="font-bold text-gray-800">0k</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Phí vận chuyển</span>
                            <span class="font-bold text-gray-800">Miễn phí</span>
                        </div>
                    </div>

                    <!-- Tổng cộng -->
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg text-[#1F2937]">Tổng cộng</span>
                        <span id="checkoutGrandTotal" class="font-bold text-2xl text-[#354A3D]">0k</span>
                    </div>

                    <!-- Nút hành động -->
                    <div class="flex items-center justify-between pt-2">
                        <a href="{{ url('/cart') }}" class="text-sm font-bold text-[#354A3D] hover:underline flex items-center gap-1">
                            ‹ Quay về giỏ hàng
                        </a>
                        <button type="submit" class="bg-[#354A3D] text-white font-bold px-8 py-4 rounded-xl shadow-md hover:bg-[#2A4435] transition-colors">
                            ĐẶT HÀNG
                        </button>
                    </div>

                </div>
            </div>

        </form>
    </div>
</div>

<!-- JAVASCRIPT ĐỒNG BỘ GIỎ HÀNG VÀ XỬ LÝ ĐẶT HÀNG -->
<script>
    const SHIPPING_FEE = 0; // Miễn phí vận chuyển như hình mẫu
    let cart = JSON.parse(localStorage.getItem('fadegra_cart')) || [];

    const formatPrice = (price) => `${price}.000đ`;

    function renderCheckoutPage() {
        const container = document.getElementById('checkoutItemsList');
        let totalCount = 0;
        let subtotal = 0;

        if (cart.length === 0) {
            container.innerHTML = `<p class="text-gray-400 text-sm text-center py-4">Chưa có sản phẩm nào trong đơn hàng.</p>`;
            document.getElementById('orderSummaryTitle').innerText = `Đơn hàng (0 sản phẩm)`;
            document.getElementById('checkoutSubtotal').innerText = `0đ`;
            document.getElementById('checkoutGrandTotal').innerText = `0đ`;
            return;
        }

        let html = '';
        cart.forEach(item => {
            totalCount += item.quantity;
            subtotal += item.totalPrice;

            const toppingText = item.toppings.length > 0 ? `<br><span class="text-xs text-gray-400">+ ${item.toppings.join(', ')}</span>` : '';
            const imageTag = item.image 
                ? `<img src="{{ asset('images') }}/${item.image}" class="w-full h-full object-cover">`
                : `<span class="text-2xl">🧋</span>`;

            html += `
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="relative w-14 h-14 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0 flex items-center justify-center border border-black/5">
                            ${imageTag}
                            <span class="absolute -top-1 -right-1 bg-gray-500 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center">${item.quantity}</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#1F2937] text-sm leading-tight">${item.name}</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Size ${item.size} ${toppingText}</p>
                        </div>
                    </div>
                    <span class="font-bold text-sm text-[#354A3D] whitespace-nowrap">${item.totalPrice}.000đ</span>
                </div>
            `;
        });

        container.innerHTML = html;
        document.getElementById('orderSummaryTitle').innerText = `Đơn hàng (${totalCount} sản phẩm)`;
        document.getElementById('checkoutSubtotal').innerText = `${subtotal}.000đ`;
        document.getElementById('checkoutGrandTotal').innerText = `${subtotal}.000đ`;
    }

    function handleCheckout(event) {
        event.preventDefault();
        if(cart.length === 0) {
            alert('Giỏ hàng của bạn đang trống!');
            return;
        }

        alert('Đặt hàng thành công! Cảm ơn bạn đã ủng hộ Fadegra.');
        // Xóa giỏ hàng sau khi đặt thành công
        localStorage.removeItem('fadegra_cart');
        window.location.href = "{{ url('/') }}";
    }

    document.addEventListener("DOMContentLoaded", function() {
        renderCheckoutPage();
    });
</script>
@endsection