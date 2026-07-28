@extends('layouts.client_menu')

@section('title', 'Thanh toán đơn hàng — FADEGRA')

@section('content')
<div class="bg-[#F8F6F2] min-h-screen font-sans py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        <div class="mb-8">
            <h1 class="font-serif text-3xl font-bold text-[#354A3D] tracking-wide">Fadegra®</h1>
        </div>

        <!-- HIỆN THÔNG BÁO LỖI NẾU CÓ -->
        @if($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl">
                {{ $errors->first() }}
            </div>
        @endif

        <form id="checkoutForm" action="{{ route('checkout.post') }}" method="POST" class="lg:grid lg:grid-cols-12 lg:gap-12 items-start">
            @csrf
            
            <!-- INPUT ẨN ĐỂ CHUYỂN GIỎ HÀNG, PHÍ SHIP VÀ ĐỊA CHỈ TỪ JS LÊN PHP -->
            <input type="hidden" name="cart_data" id="cartDataInput">
            <input type="hidden" name="shipping_fee" id="shippingFeeInput" value="0">
            <input type="hidden" name="address" id="finalAddressInput">

            <!-- CỘT TRÁI -->
            <div class="lg:col-span-7 space-y-8">
                
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-black/5 space-y-5">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="font-serif text-xl font-bold text-[#1F2937]">Thông tin nhận hàng</h2>
                    </div>

                    <div>
                        <input type="email" name="email" required placeholder="Email" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition">
                    </div>
                    <div>
                        <input type="text" name="name" required placeholder="Họ và tên" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition">
                    </div>
                    <div class="relative">
                        <input type="tel" name="phone" required placeholder="Số điện thoại" class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-4 pr-16 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition">
                    </div>
                    
                    <!-- ĐÃ SỬA: Tách địa chỉ thành Số nhà và Tên đường -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <input type="text" id="streetInput" onblur="autoCalculateDistance()" required placeholder="Tên đường (VD: Nguyễn Huệ)" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition">
                        </div>
                        <div>
                            <input type="text" id="houseNumberInput" onblur="autoCalculateDistance()" required placeholder="Số nhà, hẻm (VD: 123/4)" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <select id="provinceSelect" onchange="onProvinceChange()" class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-3 text-sm text-gray-600 focus:outline-none focus:border-[#354A3D]">
                            <option value="">Tỉnh thành</option>
                        </select>
                        <select id="districtSelect" onchange="onDistrictChange()" class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-3 text-sm text-gray-600 focus:outline-none focus:border-[#354A3D]">
                            <option value="">Quận huyện</option>
                        </select>
                        <select id="wardSelect" onchange="autoCalculateDistance()" class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-3 text-sm text-gray-600 focus:outline-none focus:border-[#354A3D]">
                            <option value="">Phường xã</option>
                        </select>
                    </div>

                    <div id="distanceContainer" class="hidden">
                        <input type="text" id="distanceInput" readonly placeholder="Hệ thống đang tính khoảng cách giao hàng..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition text-gray-500 bg-gray-100">
                        <p id="distanceErrorMsg" class="text-xs text-red-500 mt-1 hidden">Không thể tự động tính khoảng cách, hệ thống sẽ sử dụng mức phí mặc định.</p>
                    </div>
                    <div>
                        <textarea name="note" rows="2" placeholder="Ghi chú (tuỳ chọn)" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] transition"></textarea>
                    </div>
                </div>

                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-black/5 space-y-4">
                    <h2 class="font-serif text-xl font-bold text-[#1F2937]">Vận chuyển</h2>
                    <div id="shippingMethodContainer" class="bg-[#EBF3F0] border border-[#354A3D]/20 text-[#354A3D] p-4 rounded-xl text-sm font-medium">
                        Vui lòng chọn Tỉnh thành để hiển thị phương thức vận chuyển.
                    </div>
                </div>

                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-black/5 space-y-4">
                    <h2 class="font-serif text-xl font-bold text-[#1F2937]">Thanh toán</h2>
                    <label class="flex items-center justify-between p-4 rounded-xl border border-[#354A3D] bg-[#354A3D]/5 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <input type="radio" checked name="payment_method" value="cod" class="w-4 h-4 text-[#354A3D] accent-[#354A3D]">
                            <span class="text-sm font-bold text-[#1F2937]">Thanh toán khi giao hàng (COD)</span>
                        </div>
                        <span class="text-xl">💵</span>
                    </label>
                </div>
            </div>

            <!-- CỘT PHẢI -->
            <div class="lg:col-span-5 mt-8 lg:mt-0">
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-black/5 sticky top-8 space-y-6">
                    <h2 id="orderSummaryTitle" class="font-serif text-xl font-bold text-[#1F2937] border-b border-gray-100 pb-4">Đơn hàng</h2>
                    <div id="checkoutItemsList" class="space-y-4 max-h-72 overflow-y-auto pr-2"></div>
                    
                    <div class="space-y-3 border-y border-gray-100 py-4 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Tạm tính</span>
                            <span id="checkoutSubtotal" class="font-bold text-gray-800">0k</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Phí vận chuyển</span>
                            <span id="shippingFeeLabel" class="font-bold text-gray-800">Chưa xác định</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg text-[#1F2937]">Tổng cộng</span>
                        <span id="checkoutGrandTotal" class="font-bold text-2xl text-[#354A3D]">0k</span>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a href="{{ url('/cart') }}" class="text-sm font-bold text-[#354A3D] hover:underline flex items-center gap-1">‹ Quay về giỏ hàng</a>
                        <button type="button" onclick="submitCheckout()" class="bg-[#354A3D] text-white font-bold px-8 py-4 rounded-xl shadow-md hover:bg-[#2A4435] transition-colors">
                            ĐẶT HÀNG
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    let currentShippingFee = 0;
    let currentSubtotal = 0;
    let cart = JSON.parse(localStorage.getItem('fadegra_cart')) || [];
    let calculationTimeout = null;
    const STORE_LAT = 10.792222; 
    const STORE_LON = 106.563056;

    function renderCheckoutPage() {
        const container = document.getElementById('checkoutItemsList');
        let totalCount = 0;
        currentSubtotal = 0;

        if (cart.length === 0) {
            container.innerHTML = `<p class="text-gray-400 text-sm text-center py-4">Chưa có sản phẩm nào trong đơn hàng.</p>`;
            document.getElementById('orderSummaryTitle').innerText = `Đơn hàng (0 sản phẩm)`;
            return;
        }

        let html = '';
        cart.forEach(item => {
            totalCount += item.quantity;
            currentSubtotal += item.totalPrice;
            
            const imageTag = item.image 
                ? `<img src="{{ asset('images') }}/${item.image}" class="w-full h-full object-cover">`
                : `<span class="text-2xl">🧋</span>`;
                
            const toppingText = (item.toppings && item.toppings.length > 0) ? `<br><span class="text-xs text-gray-400">+ ${item.toppings.join(', ')}</span>` : '';

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
        document.getElementById('checkoutSubtotal').innerText = `${currentSubtotal}.000đ`;
        updateGrandTotal();
    }

    function updateGrandTotal() {
        const grandTotal = currentSubtotal + currentShippingFee;
        document.getElementById('checkoutGrandTotal').innerText = `${grandTotal}.000đ`;
    }

    // ĐÃ SỬA: Hàm gom thông tin gửi đi
    function submitCheckout() {
        if(cart.length === 0) {
            alert('Giỏ hàng của bạn đang trống!');
            return;
        }
        
        // Lấy tên đường, số nhà, phường, quận, tỉnh
        const street = document.getElementById('streetInput').value.trim();
        const houseNumber = document.getElementById('houseNumberInput').value.trim();
        const wardSelect = document.getElementById('wardSelect');
        const districtSelect = document.getElementById('districtSelect');
        const provinceSelect = document.getElementById('provinceSelect');
        
        const ward = wardSelect.options[wardSelect.selectedIndex] ? wardSelect.options[wardSelect.selectedIndex].text : '';
        const district = districtSelect.options[districtSelect.selectedIndex] ? districtSelect.options[districtSelect.selectedIndex].text : '';
        const province = provinceSelect.options[provinceSelect.selectedIndex] ? provinceSelect.options[provinceSelect.selectedIndex].text : '';

        // Kiểm tra khách đã nhập đủ chưa
        if(!street || !houseNumber || !ward || !district || !province || ward === 'Phường xã' || district === 'Quận huyện' || province === 'Tỉnh thành') {
            alert('Vui lòng nhập đầy đủ Tên đường, Số nhà, Phường xã và Quận huyện!');
            return;
        }


        // Gộp chuỗi địa chỉ đầy đủ
        const finalAddress = `${houseNumber} ${street}, ${ward}, ${district}, ${province}`;
        document.getElementById('finalAddressInput').value = finalAddress;

        document.getElementById('cartDataInput').value = JSON.stringify(cart);
        document.getElementById('shippingFeeInput').value = currentShippingFee * 1000; 
        document.getElementById('checkoutForm').submit();
    }

    function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
        const R = 6371; 
        const dLat = (lat2-lat1) * (Math.PI/180);  
        const dLon = (lon2-lon1) * (Math.PI/180); 
        const a = 
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(lat1 * (Math.PI/180)) * Math.cos(lat2 * (Math.PI/180)) * 
            Math.sin(dLon/2) * Math.sin(dLon/2); 
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
        return R * c; 
    }

    async function loadProvinces() {
        try {
            const res = await fetch('https://provinces.open-api.vn/api/');
            const data = await res.json();
            const provinceSelect = document.getElementById('provinceSelect');
            provinceSelect.innerHTML = '';
            
            // Lọc chỉ lấy duy nhất Hồ Chí Minh
            data.forEach(item => {
                if(item.name.includes('Hồ Chí Minh')) {
                    provinceSelect.innerHTML += `<option value="${item.code}" data-name="${item.name}" selected>${item.name}</option>`;
                }
            });

            // Tự động kích hoạt tải danh sách Quận/Huyện của TP.HCM luôn
            onProvinceChange();
        } catch (e) {
            console.error('Error fetching provinces:', e);
        }
    }

    async function onProvinceChange() {
        const provinceSelect = document.getElementById('provinceSelect');
        const districtSelect = document.getElementById('districtSelect');
        const wardSelect = document.getElementById('wardSelect');
        const provinceCode = provinceSelect.value;
        
        districtSelect.innerHTML = '<option value="">Quận huyện</option>';
        wardSelect.innerHTML = '<option value="">Phường xã</option>';
        
        if(provinceCode) {
            try {
                const res = await fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`);
                const data = await res.json();
                data.districts.forEach(item => {
                    districtSelect.innerHTML += `<option value="${item.code}" data-name="${item.name}">${item.name}</option>`;
                });
            } catch(e) {}
        }
        autoCalculateDistance();
    }

    async function onDistrictChange() {
        const districtSelect = document.getElementById('districtSelect');
        const wardSelect = document.getElementById('wardSelect');
        const districtCode = districtSelect.value;
        
        wardSelect.innerHTML = '<option value="">Phường xã</option>';
        
        if(districtCode) {
            try {
                const res = await fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`);
                const data = await res.json();
                data.wards.forEach(item => {
                    wardSelect.innerHTML += `<option value="${item.code}" data-name="${item.name}">${item.name}</option>`;
                });
            } catch(e) {}
        }
        autoCalculateDistance();
    }

    // ĐÃ SỬA: Lấy địa chỉ từ 2 ô mới để tính map
    function autoCalculateDistance() {
        const provinceSelect = document.getElementById('provinceSelect');
        const districtSelect = document.getElementById('districtSelect');
        const wardSelect = document.getElementById('wardSelect');
        
        const street = document.getElementById('streetInput') ? document.getElementById('streetInput').value.trim() : '';
        const houseNumber = document.getElementById('houseNumberInput') ? document.getElementById('houseNumberInput').value.trim() : '';
        const fullStreetAddress = (houseNumber + ' ' + street).trim();

        const provinceOption = provinceSelect.options[provinceSelect.selectedIndex];
        const provinceName = provinceOption ? (provinceOption.getAttribute('data-name') || '') : '';
        const isHCM = provinceName.includes('Hồ Chí Minh');
        const isHN = provinceName.includes('Hà Nội');

        if (isHCM) {
            document.getElementById('distanceContainer').classList.remove('hidden');
            document.getElementById('distanceErrorMsg').classList.add('hidden');
            
            const districtOption = districtSelect.options[districtSelect.selectedIndex];
            const districtName = districtOption ? (districtOption.getAttribute('data-name') || '') : '';
            const wardOption = wardSelect.options[wardSelect.selectedIndex];
            const wardName = wardOption ? (wardOption.getAttribute('data-name') || '') : '';
            
            if(fullStreetAddress && districtName && wardName) {
                document.getElementById('distanceInput').value = 'Đang tính khoảng cách giao hàng...';
                const fullAddress = `${fullStreetAddress}, ${wardName}, ${districtName}, Hồ Chí Minh, Việt Nam`;
                
                clearTimeout(calculationTimeout);
                calculationTimeout = setTimeout(() => {
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(fullAddress)}`)
                        .then(res => res.json())
                        .then(data => {
                            if(data && data.length > 0) {
                                const lat = parseFloat(data[0].lat);
                                const lon = parseFloat(data[0].lon);
                                let distance = getDistanceFromLatLonInKm(STORE_LAT, STORE_LON, lat, lon) * 1.3;
                                distance = Math.round(distance * 10) / 10;
                                document.getElementById('distanceInput').value = `${distance} km`;
                                applyShippingFee(distance, 'HCM');
                            } else {
                                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(districtName + ', Hồ Chí Minh, Việt Nam')}`)
                                    .then(res => res.json())
                                    .then(data2 => {
                                        if(data2 && data2.length > 0) {
                                            const lat = parseFloat(data2[0].lat);
                                            const lon = parseFloat(data2[0].lon);
                                            let distance = getDistanceFromLatLonInKm(STORE_LAT, STORE_LON, lat, lon) * 1.3;
                                            distance = Math.round(distance * 10) / 10;
                                            document.getElementById('distanceInput').value = `${distance} km (Ước tính theo quận)`;
                                            applyShippingFee(distance, 'HCM');
                                        } else {
                                            showError();
                                        }
                                    }).catch(showError);
                            }
                        }).catch(showError);
                }, 800); 
            } else {
                 document.getElementById('distanceInput').value = 'Vui lòng nhập đầy đủ địa chỉ để tính phí';
                 applyShippingFee(0, 'HCM');
            }
        } else {
            document.getElementById('distanceContainer').classList.add('hidden');
            const provinceType = isHN ? 'HN' : (provinceName ? 'OTHER' : '');
            applyShippingFee(null, provinceType);
        }
    }

    function showError() {
        document.getElementById('distanceErrorMsg').classList.remove('hidden');
        document.getElementById('distanceInput').value = '';
        applyShippingFee(4); 
    }

    function applyShippingFee(distance, provinceType = 'HCM') {
        const container = document.getElementById('shippingMethodContainer');
        const label = document.getElementById('shippingFeeLabel');
        
        if (provinceType === 'HCM') {
            if (distance > 0) {
                currentShippingFee = Math.round(distance * 5); 
                container.innerHTML = `Giao hàng (Hồ Chí Minh) - ${distance}km - <span class="font-bold">${currentShippingFee}.000đ</span>`;
                label.innerText = `${currentShippingFee}.000đ`;
            } else {
                currentShippingFee = 0;
                container.innerHTML = 'Vui lòng nhập đầy đủ địa chỉ để hiển thị phí vận chuyển.';
                label.innerText = 'Chưa xác định';
            }
        } else {
            currentShippingFee = 0;
            container.innerHTML = 'Vui lòng chọn Tỉnh thành để hiển thị phương thức vận chuyển.';
            label.innerText = 'Chưa xác định';
        }
        
        updateGrandTotal();
    }

    document.addEventListener("DOMContentLoaded", function() {
        renderCheckoutPage();
        loadProvinces(); 
    });
</script>
@endsection