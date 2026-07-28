@extends('layouts.client_home')

@section('title', 'Trang chủ — FADEGRA')

@section('content')

@php
// Khai báo danh sách Topping để hiển thị trong Modal Đặt hàng
$toppings = [
    ['id' => 'tp1', 'name' => 'Bánh Flan', 'prices' => ['default' => 7]],
    ['id' => 'tp2', 'name' => 'Trân Châu Đen', 'prices' => ['default' => 6]],
    ['id' => 'tp3', 'name' => 'Pudding (4)', 'prices' => ['default' => 6]],
    ['id' => 'tp4', 'name' => 'Sương Sáo (8)', 'prices' => ['default' => 6]],
    ['id' => 'tp5', 'name' => 'Trân Châu Giòn', 'prices' => ['default' => 6]],
    ['id' => 'tp6', 'name' => 'Thạch Khoai Dẻo', 'prices' => ['default' => 6]],
    ['id' => 'tp7', 'name' => 'Thạch Rau Câu', 'prices' => ['default' => 6]],
    ['id' => 'tp8', 'name' => 'Đào (4)', 'prices' => ['default' => 5]],
    ['id' => 'tp9', 'name' => 'Vải (3)', 'prices' => ['default' => 6]],
];
@endphp

    <!-- 1. HERO BANNER -->
    <div class="hero-swiper swiper relative bg-cover bg-center text-white py-16 lg:py-20 overflow-hidden" style="background-image: url('{{ asset('images/anhbanner.jpg') }}'); background-position: center 40%;">

        <!-- Lớp phủ tối màu (overlay) giúp chữ nổi bật và giữ tone màu thương hiệu -->
        <div class="absolute inset-0 bg-forest/85 z-0"></div>

        <!-- Họa tiết đường cong chìm lan tỏa nền  -->
        <div class="absolute -top-32 -right-32 w-[600px] h-[600px] bg-white/5 rounded-full pointer-events-none z-1"></div>
        <div class="absolute right-10 -bottom-40 w-[500px] h-[500px] bg-white/5 rounded-full pointer-events-none z-1"></div>

        <!-- SWIPER WRAPPER CHỨA CÁC SLIDE -->
        <div class="swiper-wrapper">

            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="max-w-7xl mx-auto px-12 lg:px-20 relative z-10 w-full">
                    <div class="max-w-2xl">
                        <span class="inline-block bg-cream-accent text-forest text-xs font-bold tracking-widest uppercase px-4 py-1.5 rounded-full mb-6 shadow-sm">ĐẶC SẢN</span>
                        <h1 class="font-serif text-4xl md:text-6xl font-bold leading-tight mb-6">Trà mộc — Hồn cốt Việt&nbsp;Nam</h1>
                        <p class="text-white/80 text-base md:text-lg leading-relaxed mb-8 max-w-lg">
                            Nguyên liệu thuần tự nhiên, không chất bảo quản. Đơn giản mà đậm đà như tình đất quê hương.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="#products" class="bg-cream-accent text-forest font-semibold px-8 py-3.5 rounded-full hover:bg-cream-hover transition shadow-sm">
                                Xem bộ sưu tập
                            </a>
                            <a href="#story" class="border border-white/40 text-white font-medium px-8 py-3.5 rounded-full hover:bg-white/10 hover:border-white transition">
                                Xem thêm
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
                <div class="max-w-7xl mx-auto px-12 lg:px-20 relative z-10 w-full">
                    <div class="max-w-2xl">
                        <span class="inline-block bg-cream-accent text-forest text-xs font-bold tracking-widest uppercase px-4 py-1.5 rounded-full mb-6 shadow-sm">SẢN PHẨM MỚI</span>
                        <h1 class="font-serif text-4xl md:text-6xl font-bold leading-tight mb-6">Hương vị trà thanh mát</h1>
                        <p class="text-white/80 text-base md:text-lg leading-relaxed mb-8 max-w-lg">
                            Khám phá ngay bộ sưu tập trà đặc biệt trong mùa hè này tại Fadegra.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="#products" class="bg-cream-accent text-forest font-semibold px-8 py-3.5 rounded-full hover:bg-cream-hover transition shadow-sm">Khám phá ngay</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Nút mũi tên chuyển slide -->
        <button type="button" class="hero-prev hidden md:flex absolute left-12 lg:left-16 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full border border-white/20 bg-white/10 items-center justify-center text-white hover:bg-white/20 transition z-20 cursor-pointer">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button type="button" class="hero-next hidden md:flex absolute right-12 lg:right-16 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full border border-white/20 bg-white/10 items-center justify-center text-white hover:bg-white/20 transition z-20 cursor-pointer">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <!-- Dấu chấm phân trang -->
        <div class="hero-pagination absolute bottom-6 left-0 w-full flex justify-center items-center space-x-2 z-20"></div>

    </div>


    <!-- 2. CÂU CHUYỆN THƯƠNG HIỆU -->
    <section id="story" class="py-20 bg-cream">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-forest text-xs font-bold tracking-widest uppercase mb-3 block">VỀ CHÚNG TÔI</span>
                <h2 class="font-serif text-3xl md:text-5xl font-semibold text-forest-dark">Câu chuyện thương hiệu</h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="relative rounded-2xl overflow-hidden aspect-[4/4] border border-black/5 shadow-sm">
                    <img src="{{ asset('images/bangvay.jpg') }}" alt="Ảnh thương hiệu" class="w-full h-full object-contain bg-white scale-100">
                </div>
                <div>
                    <h3 class="font-serif text-2xl md:text-4xl font-semibold text-forest-dark mb-6 leading-snug">
                        Từ ngọn đồi trà xanh đến ly trà thơm ngát trong tay bạn
                    </h3>
                    <p class="text-gray-600 leading-relaxed text-base md:text-lg mb-6">
                        Fadegra được sinh ra từ tình yêu với thiên nhiên và những chuyến đi dài trên những con đường đất đỏ Tây Nguyên. Chúng tôi tin rằng một ly trà ngon không chỉ là hương vị, đó là kết nối giữa con người với đất đai, với truyền thống và với nhau.
                    </p>
                    <p class="text-gray-600 leading-relaxed text-base md:text-lg">
                        Mỗi sản phẩm Fadegra được tuyển chọn kỹ lưỡng từ các vùng trà nổi tiếng, qua bàn tay chế biến thủ công của những người thợ lành nghề. Chúng tôi không chạy theo xu hướng — chúng tôi giữ gìn bản sắc.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- 3. DANH SÁCH SẢN PHẨM NỔI BẬT -->
    <section id="products" class="pb-24 bg-cream relative">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-14">
                <span class="text-forest text-xs font-bold tracking-widest uppercase mb-2 block">THỰC ĐƠN ĐẶC SẮC</span>
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-forest-dark">Sản Phẩm Nổi Bật</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

                <!-- SẢN PHẨM 1 -->
                <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col cursor-pointer"
                     onclick='openOrderModal({"id":"bs1","name":"Trà Sữa Truyền Thống","prices":{"S":20,"L":25},"tag":"hot","image":"truyenthong.jpg"}, "#D6C5B3", "🧋")'>
                    <div class="relative h-[320px] bg-white overflow-hidden">
                        <img src="{{ asset('images/truyenthong.jpg') }}" class="w-full h-full object-cover scale-105" alt="Trà Sữa Truyền Thống"> 
                        <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">🔥 HOT</div>
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-20">
                            <span class="bg-white text-gray-800 text-sm font-semibold px-6 py-2.5 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Đặt ngay
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start gap-4 mb-3">
                                <h3 class="font-serif text-xl font-bold text-forest-dark leading-tight">Trà Sữa Truyền Thống</h3>
                            </div>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-cream-accent/40 text-gray-600 text-xs px-2.5 py-1 rounded-md font-medium">S: 20k</span>
                                <span class="bg-cream-accent/40 text-gray-600 text-xs px-2.5 py-1 rounded-md font-medium">L: 25k</span>
                            </div>
                        </div>
                        <button class="w-full py-3.5 rounded-full font-bold text-sm transition-all duration-300 bg-forest text-white group-hover:bg-[#D3C6B6] group-hover:text-forest-dark border border-transparent group-hover:border-black/10">
                            Chọn & Đặt ngay
                        </button>
                    </div>
                </div>

                <!-- SẢN PHẨM 2 -->
                <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col cursor-pointer"
                     onclick='openOrderModal({"id":"bs2","name":"Matcha Latte Oatside Vị Nguyên Bản","prices":{"L":28},"tag":"hot","image":"matcha.jpg"}, "#BCCAB9", "🍃")'>
                    <div class="relative h-[320px] bg-[#BCCAB9] overflow-hidden">
                        <img src="{{ asset('images/matcha.jpg') }}" class="w-full h-full object-cover scale-105" alt="Matcha"> 
                        <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">🔥 HOT</div>
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-20">
                            <span class="bg-white text-gray-800 text-sm font-semibold px-6 py-2.5 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Đặt ngay
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start gap-4 mb-3">
                                <h3 class="font-serif text-xl font-bold text-forest-dark leading-tight">Matcha Latte Oatside Vị Nguyên Bản</h3>
                            </div>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-cream-accent/40 text-gray-600 text-xs px-2.5 py-1 rounded-md font-medium">L: 28k</span>
                            </div>
                        </div>
                        <button class="w-full py-3.5 rounded-full font-bold text-sm transition-all duration-300 bg-forest text-white group-hover:bg-[#D3C6B6] group-hover:text-forest-dark border border-transparent group-hover:border-black/10">
                            Chọn & Đặt ngay
                        </button>
                    </div>
                </div>

                <!-- SẢN PHẨM 3 -->
                <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col cursor-pointer"
                     onclick='openOrderModal({"id":"bs3","name":"Trà Đào","prices":{"S":20,"L":25},"tag":"hot","image":"tradao.jpg"}, "#DBCBBD", "🍃")'>
                    <div class="relative h-[320px] bg-[#DBCBBD] overflow-hidden">
                        <img src="{{ asset('images/tradao.jpg') }}" class="w-full h-full object-cover" alt="Trà Đào" style="object-position: center 60%;"> 
                        <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">🔥 HOT</div>
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-20">
                            <span class="bg-white text-gray-800 text-sm font-semibold px-6 py-2.5 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Đặt ngay
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start gap-4 mb-3">
                                <h3 class="font-serif text-xl font-bold text-forest-dark leading-tight">Trà Đào</h3>
                            </div>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-cream-accent/40 text-gray-600 text-xs px-2.5 py-1 rounded-md font-medium">S: 20k</span>
                                <span class="bg-cream-accent/40 text-gray-600 text-xs px-2.5 py-1 rounded-md font-medium">L: 25k</span>
                            </div>
                        </div>
                        <button class="w-full py-3.5 rounded-full font-bold text-sm transition-all duration-300 bg-forest text-white group-hover:bg-[#D3C6B6] group-hover:text-forest-dark border border-transparent group-hover:border-black/10">
                            Chọn & Đặt ngay
                        </button>
                    </div>
                </div>

                <!-- SẢN PHẨM 4 -->
                <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col cursor-pointer"
                     onclick='openOrderModal({"id":"ts2","name":"Trà Sữa Chocolate","prices":{"S":20,"L":25},"tag":"hot","image":"chocolate.jpg"}, "#BCCAB9", "🧋")'>
                    <div class="relative h-[320px] bg-[#BCCAB9] overflow-hidden">
                        <img src="{{ asset('images/chocolate.jpg') }}" class="w-full h-full object-cover" alt="Chocolate Sữa" style="object-position: center 80%;"> 
                        <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">🔥 HOT</div>
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-20">
                            <span class="bg-white text-gray-800 text-sm font-semibold px-6 py-2.5 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Đặt ngay
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start gap-4 mb-3">
                                <h3 class="font-serif text-xl font-bold text-forest-dark leading-tight">Trà Sữa Chocolate</h3>
                            </div>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-cream-accent/40 text-gray-600 text-xs px-2.5 py-1 rounded-md font-medium">S: 20k</span>
                                <span class="bg-cream-accent/40 text-gray-600 text-xs px-2.5 py-1 rounded-md font-medium">L: 25k</span>
                            </div>
                        </div>
                        <button class="w-full py-3.5 rounded-full font-bold text-sm transition-all duration-300 bg-forest text-white group-hover:bg-[#D3C6B6] group-hover:text-forest-dark border border-transparent group-hover:border-black/10">
                            Chọn & Đặt ngay
                        </button>
                    </div>
                </div>

                <!-- SẢN PHẨM 5 -->
                <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col cursor-pointer"
                     onclick='openOrderModal({"id":"st1","name":"Sữa Tươi Trân Châu Đường Đen","prices":{"S":25,"L":30},"tag":"hot","image":"suatuoi.jpg"}, "#DBCBBD", "🥛")'>
                    <div class="relative h-[320px] bg-[#DBCBBD] overflow-hidden">
                        <img src="{{ asset('images/suatuoi.jpg') }}" class="w-full h-full object-cover" alt="Sữa Tươi Trân Châu Đường Đen" style="object-position: center 80%;"> 
                        <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">🔥 HOT</div>
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-20">
                            <span class="bg-white text-gray-800 text-sm font-semibold px-6 py-2.5 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Đặt ngay
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start gap-4 mb-3">
                                <h3 class="font-serif text-xl font-bold text-forest-dark leading-tight">Sữa Tươi Trân Châu Đường Đen</h3>
                            </div>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-cream-accent/40 text-gray-600 text-xs px-2.5 py-1 rounded-md font-medium">S: 25k</span>
                                <span class="bg-cream-accent/40 text-gray-600 text-xs px-2.5 py-1 rounded-md font-medium">L: 30k</span>
                            </div>
                        </div>
                        <button class="w-full py-3.5 rounded-full font-bold text-sm transition-all duration-300 bg-forest text-white group-hover:bg-[#D3C6B6] group-hover:text-forest-dark border border-transparent group-hover:border-black/10">
                            Chọn & Đặt ngay
                        </button>
                    </div>
                </div>

                <!-- SẢN PHẨM 6 -->
                <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col cursor-pointer"
                     onclick='openOrderModal({"id":"ts6","name":"Trà Sữa Thái Xanh","prices":{"S":20,"L":25},"tag":"hot","image":"thaixanh.jpg"}, "#BCCAB9", "🧋")'>
                    <div class="relative h-[320px] bg-[#BCCAB9] overflow-hidden">
                        <img src="{{ asset('images/thaixanh.jpg') }}" class="w-full h-full object-cover" alt="Trà Sữa Thái Xanh" style="object-position: center 70%;"> 
                        <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">🔥 HOT</div>
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-20">
                            <span class="bg-white text-gray-800 text-sm font-semibold px-6 py-2.5 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Đặt ngay
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start gap-4 mb-3">
                                <h3 class="font-serif text-xl font-bold text-forest-dark leading-tight">Trà Sữa Thái Xanh</h3>
                            </div>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-cream-accent/40 text-gray-600 text-xs px-2.5 py-1 rounded-md font-medium">S: 20k</span>
                                <span class="bg-cream-accent/40 text-gray-600 text-xs px-2.5 py-1 rounded-md font-medium">L: 25k</span>
                            </div>
                        </div>
                        <button class="w-full py-3.5 rounded-full font-bold text-sm transition-all duration-300 bg-forest text-white group-hover:bg-[#D3C6B6] group-hover:text-forest-dark border border-transparent group-hover:border-black/10">
                            Chọn & Đặt ngay
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- 4.1. NÚT GIỎ HÀNG NỔI (FAB) - Giống hệt trang Menu -->
        <button onclick="openCartSidebar()" class="fixed bottom-8 right-8 bg-[#354A3D] text-white p-4 rounded-full shadow-xl hover:scale-105 transition-transform z-[60] flex items-center justify-center">
            <span id="cartBadge" class="absolute -top-2 -right-2 bg-[#F5A623] text-white text-[11px] font-bold w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F8F6F2] hidden transition-all duration-300 transform scale-0">0</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
        </button>

        <!-- 4.2. POPUP ĐẶT HÀNG (MODAL) -->
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
                            @foreach($toppings as $topping)
                                <button onclick="toggleTopping('{{ $topping['name'] }}', {{ $topping['prices']['default'] }}, this)" 
                                        class="topping-btn bg-white border border-black/10 rounded-xl p-3 flex justify-between items-center text-[13px] transition-colors text-left">
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

        <!-- 4.3. SIDEBAR GIỎ HÀNG -->
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

    </section>

    <!-- 5. TIN TỨC NỔI BẬT -->
    <section id="news" class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14">
                <div>
                    <span class="text-forest text-xs font-bold tracking-widest uppercase mb-2 block">GÓC THƯ GIÃN</span>
                    <h2 class="font-serif text-3xl md:text-4xl font-bold text-forest-dark">Tin tức nổi bật</h2>
                </div>
                <a href="#" class="mt-4 md:mt-0 text-forest-dark font-medium hover:text-forest transition flex items-center gap-2 group">
                    Xem tất cả bài viết 
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- BÀI VIẾT 1 -->
                <article class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="relative h-[240px] bg-[#DBCBBD] overflow-hidden">
                        <img src="{{ asset('images/doitra.jpg') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Hành trình tìm trà">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-forest-dark text-[11px] font-bold px-3 py-1 rounded-full shadow-sm">CÂU CHUYỆN</div>
                        <div class="absolute top-4 right-4 bg-black/40 backdrop-blur-sm text-white text-[11px] font-medium px-2.5 py-1 rounded-full">5 phút đọc</div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif text-xl font-bold text-forest-dark leading-snug mb-3 group-hover:text-forest transition">Hành trình tìm trà trên cao nguyên Lâm Đồng</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">Chúng tôi đã vượt hơn 300km để tìm đến những rẫy trà cổ thụ — nơi những búp trà xanh mướt vẫn được hái bằng tay mỗi sớm mai.</p>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-black/5 text-xs text-gray-500">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-forest text-white flex items-center justify-center font-bold text-xs">F</div>
                                <span class="font-medium text-gray-700">Fadegra Team</span>
                            </div>
                            <span>20 tháng 6, 2025</span>
                        </div>
                    </div>
                </article>

                <!-- BÀI VIẾT 2 -->
                <article class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="relative h-[240px] bg-[#BCCAB9] overflow-hidden">
                        <img src="{{ asset('images/monmoi.jpg') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Trà Tứ Quý">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-forest-dark text-[11px] font-bold px-3 py-1 rounded-full shadow-sm">SẢN PHẨM MỚI</div>
                        <div class="absolute top-4 right-4 bg-black/40 backdrop-blur-sm text-white text-[11px] font-medium px-2.5 py-1 rounded-full">3 phút đọc</div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif text-xl font-bold text-forest-dark leading-snug mb-3 group-hover:text-forest transition">Ra mắt dòng trà Tứ Quý — 4 hương vị, 4 mùa cảm xúc</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">Bộ sưu tập mới nhất của Fadegra lấy cảm hứng từ 4 mùa trong năm, đưa bạn qua từng cung bậc hương vị đặc trưng.</p>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-black/5 text-xs text-gray-500">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-forest text-white flex items-center justify-center font-bold text-xs">F</div>
                                <span class="font-medium text-gray-700">Fadegra Team</span>
                            </div>
                            <span>15 tháng 6, 2025</span>
                        </div>
                    </div>
                </article>

                <!-- BÀI VIẾT 3 -->
                <article class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="relative h-[240px] bg-[#DBCBBD] overflow-hidden">
                        <img src="{{ asset('images/uongtrasang.jpg') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Uống trà buổi sáng">
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-forest-dark text-[11px] font-bold px-3 py-1 rounded-full shadow-sm">LỐI SỐNG</div>
                        <div class="absolute top-4 right-4 bg-black/40 backdrop-blur-sm text-white text-[11px] font-medium px-2.5 py-1 rounded-full">4 phút đọc</div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif text-xl font-bold text-forest-dark leading-snug mb-3 group-hover:text-forest transition">Tại sao một buổi sáng với trà lại thay đổi cả ngày của bạn?</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">Nghiên cứu chỉ ra rằng thói quen uống trà buổi sáng không chỉ tốt cho sức khỏe mà còn tạo nên sự bình yên trong tâm trí.</p>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-black/5 text-xs text-gray-500">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-forest text-white flex items-center justify-center font-bold text-xs">F</div>
                                <span class="font-medium text-gray-700">Fadegra Team</span>
                            </div>
                            <span>10 tháng 6, 2025</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- CSS Animation cho Popup -->
    <style>
        @keyframes slideUp { from { transform: translateY(100%); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes slideLeft { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
    </style>
@endsection


<!-- ĐOẠN SCRIPT ĐỂ CHẠY SLIDER VÀ POPUP GIỎ HÀNG -->
@section('scripts')
    <script>
        // CHẠY SLIDER HERO BANNER
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Swiper !== 'undefined') {
                new Swiper('.hero-swiper', {
                    loop: true, autoplay: { delay: 5000, disableOnInteraction: false },
                    navigation: { nextEl: '.hero-next', prevEl: '.hero-prev' },
                    pagination: { el: '.hero-pagination', clickable: true },
                });
            } else {
                console.error("Swiper JS chưa được tải.");
            }
        });

        // ==========================================
        // CÁC HÀM XỬ LÝ POPUP & GIỎ HÀNG
        // ==========================================
        let currentItem = null;
        let basePrice = 0;
        let quantity = 1;
        let toppingsPrice = 0;
        let selectedSizeName = 'Mặc định'; 
        let selectedToppingsList = []; 
        let cart = JSON.parse(localStorage.getItem('fadegra_cart')) || [];

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
                container.innerHTML = `<div class="h-full flex flex-col items-center justify-center text-gray-400 opacity-70"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mb-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg><p>Giỏ hàng đang trống</p></div>`;
            } else {
                container.innerHTML = '';
                cart.forEach(item => {
                    const toppingText = item.toppings.length > 0 ? `(+${item.toppings.join(', ')})` : '';
                    container.innerHTML += `
                        <div class="bg-white p-4 rounded-xl border border-black/5 shadow-sm">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="font-bold text-[#1F2937] text-sm pr-4">${item.name}</h4>
                                <button onclick="removeFromCart('${item.id}')" class="text-red-400 hover:text-red-600 transition p-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></button>
                            </div>
                            <p class="text-xs text-gray-500 mb-2">Size ${item.size} <span class="text-[#354A3D] font-medium">${toppingText}</span></p>
                            <div class="flex justify-between items-center mt-3">
                                <span class="font-bold text-base text-[#354A3D]">${formatPrice(item.totalPrice)}</span>
                                <span class="text-xs font-semibold bg-[#F4EFEA] px-2.5 py-1 rounded text-gray-700">x${item.quantity}</span>
                            </div>
                        </div>`;
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