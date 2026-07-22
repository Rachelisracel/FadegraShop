@extends('layouts.client_home')

@section('title', 'Trang chủ — FADEGRA')

@section('content')


    <!-- 1. HERO BANNER -->
    <div class="hero-swiper swiper relative bg-cover bg-center text-white py-16 lg:py-20 overflow-hidden" style="
        background-image: url('{{ asset('images/anhbanner.jpg') }}');
        background-position: center 40%;
    ">

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
                        <span
                            class="inline-block bg-cream-accent text-forest text-xs font-bold tracking-widest uppercase px-4 py-1.5 rounded-full mb-6 shadow-sm">
                            ĐẶC SẢN
                        </span>
                        <h1 class="font-serif text-4xl md:text-6xl font-bold leading-tight mb-6">Trà mộc — Hồn cốt
                            Việt&nbsp;Nam</h1>
                        <p class="text-white/80 text-base md:text-lg leading-relaxed mb-8 max-w-lg">
                            Nguyên liệu thuần tự nhiên, không chất bảo quản. Đơn giản mà đậm đà như tình đất quê hương.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="#products"
                                class="bg-cream-accent text-forest font-semibold px-8 py-3.5 rounded-full hover:bg-cream-hover transition shadow-sm">
                                Xem bộ sưu tập
                            </a>
                            <a href="#story"
                                class="border border-white/40 text-white font-medium px-8 py-3.5 rounded-full hover:bg-white/10 hover:border-white transition">
                                Xem thêm
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 (Ví dụ thêm slide thứ 2) -->
            <div class="swiper-slide">
                <div class="max-w-7xl mx-auto px-12 lg:px-20 relative z-10 w-full">
                    <div class="max-w-2xl">
                        <span
                            class="inline-block bg-cream-accent text-forest text-xs font-bold tracking-widest uppercase px-4 py-1.5 rounded-full mb-6 shadow-sm">
                            SẢN PHẨM MỚI
                        </span>
                        <h1 class="font-serif text-4xl md:text-6xl font-bold leading-tight mb-6">
                            Hương vị trà thanh mát
                        </h1>
                        <p class="text-white/80 text-base md:text-lg leading-relaxed mb-8 max-w-lg">
                            Khám phá ngay bộ sưu tập trà đặc biệt trong mùa hè này tại Fadegra.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="#products"
                                class="bg-cream-accent text-forest font-semibold px-8 py-3.5 rounded-full hover:bg-cream-hover transition shadow-sm">
                                Khám phá ngay
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Nút mũi tên chuyển slide (Đã thêm class hero-prev và hero-next) -->
        <button type="button"
            class="hero-prev hidden md:flex absolute left-12 lg:left-16 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full border border-white/20 bg-white/10 items-center justify-center text-white hover:bg-white/20 transition z-20 cursor-pointer">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button type="button"
            class="hero-next hidden md:flex absolute right-12 lg:right-16 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full border border-white/20 bg-white/10 items-center justify-center text-white hover:bg-white/20 transition z-20 cursor-pointer">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <!-- Dấu chấm phân trang (Đã thêm class hero-pagination để Swiper tự động quản lý các dot) -->
        <div class="hero-pagination absolute bottom-6 left-0 w-full flex justify-center items-center space-x-2 z-20"></div>

    </div>


    <!-- 2. CÂU CHUYỆN THƯƠNG HIỆU -->
    <section id="story" class="py-20 bg-cream">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">

            <!-- Tiêu đề chung của section -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-forest text-xs font-bold tracking-widest uppercase mb-3 block">
                    VỀ CHÚNG TÔI
                </span>
                <h2 class="font-serif text-3xl md:text-5xl font-semibold text-forest-dark">
                    Câu chuyện thương hiệu
                </h2>
            </div>

            <!-- Bố cục 2 cột: Ảnh đứng bên trái - Nội dung bên phải -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                <!-- Cột trái: Ô chứa hình ảnh (Đã đổi thành tỷ lệ khung đứng aspect-[3/4]) -->
                <div class="relative rounded-2xl overflow-hidden
                            aspect-[4/4] border border-black/5 shadow-sm">
                    <img src="{{ asset('images/bangvay.jpg') }}" alt="Ảnh thương hiệu" class="w-full h-full object-contain bg-white scale-100">
                </div>

                <!-- Cột phải: Nội dung câu chuyện -->
                <div>
                    <h3 class="font-serif text-2xl md:text-4xl font-semibold text-forest-dark mb-6 leading-snug">
                        Từ ngọn đồi trà xanh đến ly trà thơm ngát trong tay bạn
                    </h3>

                    <p class="text-gray-600 leading-relaxed text-base md:text-lg mb-6">
                        Fadegra được sinh ra từ tình yêu với thiên nhiên và những chuyến đi dài trên những con đường đất đỏ
                        Tây Nguyên. Chúng tôi tin rằng một ly trà ngon không chỉ là hương vị, đó là kết nối giữa con người
                        với đất đai, với truyền thống và với nhau.
                    </p>

                    <p class="text-gray-600 leading-relaxed text-base md:text-lg">
                        Mỗi sản phẩm Fadegra được tuyển chọn kỹ lưỡng từ các vùng trà nổi tiếng, qua bàn tay chế biến thủ
                        công của những người thợ lành nghề. Chúng tôi không chạy theo xu hướng — chúng tôi giữ gìn bản sắc.
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- 3. DANH SÁCH SẢN PHẨM -->
<section id="products" class="pb-24 bg-cream">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14">
            <span class="text-forest text-xs font-bold tracking-widest uppercase mb-2 block">
                THỰC ĐƠN ĐẶC SẮC
            </span>
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-forest-dark">
                Sản Phẩm Nổi Bật
            </h2>
        </div>

        <!-- Giao diện dạng Lưới (Grid) 3 cột -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

            <!-- SẢN PHẨM 1 -->
            <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                <div class="relative h-[320px] bg-white overflow-hidden">
                    <img src="{{ asset('images/truyenthong.jpg') }}" class="w-full h-full object-cover scale-105" alt="Trà Sữa Truyền Thống"> 
                    <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">
                        🔥 HOT
                    </div>
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
                            <span class="text-forest-dark font-semibold text-sm whitespace-nowrap mt-1"></span>
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
            <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                <div class="relative h-[320px] bg-[#BCCAB9] overflow-hidden">
                    <img src="{{ asset('images/matcha.jpg') }}" class="w-full h-full object-cover scale-105" alt="Matcha"> 
                    <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">
                        🔥 HOT
                    </div>
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
                            <span class="text-forest-dark font-semibold text-sm whitespace-nowrap mt-1"></span>
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
            <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                <div class="relative h-[320px] bg-[#DBCBBD] overflow-hidden">

                    <img src="{{ asset('images/tradao.jpg') }}" class="w-full h-full object-cover" alt="Trà Đào" style="object-position: center 60%;"> 
                    <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">
                        🔥 HOT
                    </div>
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
                            <span class="text-forest-dark font-semibold text-sm whitespace-nowrap mt-1"></span>
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

            <!-- SẢN PHẨM 4: CHOCOLATE -->
            <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                <div class="relative h-[320px] bg-[#BCCAB9] overflow-hidden">
                    <img src="{{ asset('images/chocolate.jpg') }}" class="w-full h-full object-cover" alt="Chocolate Sữa" style="object-position: center 80%;"> 
                    <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">
                        🔥 HOT
                    </div>
                    <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-20">
                        <span class="bg-white text-gray-800 text-sm font-semibold px-6 py-2.5 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            Đặt ngay
                        </span>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start gap-4 mb-3">
                            <h3 class="font-serif text-xl font-bold text-forest-dark leading-tight">Trà Sữa Chocolate </h3>
                            <span class="text-forest-dark font-semibold text-sm whitespace-nowrap mt-1"></span>
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

            <!-- SẢN PHẨM 5: SỮA TƯƠI TRÂN CHÂU ĐƯỜNG ĐEN -->
            <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                <div class="relative h-[320px] bg-[#DBCBBD] overflow-hidden">
                    <img src="{{ asset('images/suatuoi.jpg') }}" class="w-full h-full object-cover" alt="Sữa Tươi Trân Châu Đường Đen" style="object-position: center 80%;"> 
                    <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">
                        🔥 HOT
                    </div>
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
                            <span class="text-forest-dark font-semibold text-sm whitespace-nowrap mt-1"></span>
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

            <!-- SẢN PHẨM 6: THÁI XANH -->
            <div class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                <div class="relative h-[320px] bg-[#BCCAB9] overflow-hidden">
                    <img src="{{ asset('images/thaixanh.jpg') }}" class="w-full h-full object-cover" alt="Trà Sữa Thái Xanh" style="object-position: center 70%;"> 
                    <div class="absolute top-4 left-4 bg-[#3B4D41] text-white text-[11px] font-bold px-3 py-1 rounded-full flex items-center gap-1 z-10 shadow-sm">
                        🔥 HOT
                    </div>
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
                            <span class="text-forest-dark font-semibold text-sm whitespace-nowrap mt-1"></span>
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
</section>

    <!-- 4. TIN TỨC NỔI BẬT -->
<section id="news" class="py-24 bg-cream">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Tiêu đề và nút xem tất cả -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14">
            <div>
                <span class="text-forest text-xs font-bold tracking-widest uppercase mb-2 block">
                    GÓC THƯ GIÃN
                </span>
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-forest-dark">
                    Tin tức nổi bật
                </h2>
            </div>
            <a href="#" class="mt-4 md:mt-0 text-forest-dark font-medium hover:text-forest transition flex items-center gap-2 group">
                Xem tất cả bài viết 
                <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>

        <!-- Lưới tin tức 3 cột -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- BÀI VIẾT 1 -->
            <article class="group bg-[#FCFBFA] rounded-2xl overflow-hidden border border-black/5 hover:shadow-xl transition-all duration-300 flex flex-col">
                <!-- Ảnh bài viết -->
                <div class="relative h-[240px] bg-[#DBCBBD] overflow-hidden">
                    <img src="{{ asset('images/doitra.jpg') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Hành trình tìm trà">
                    
                    <!-- Badge thể loại -->
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-forest-dark text-[11px] font-bold px-3 py-1 rounded-full shadow-sm">
                        CÂU CHUYỆN
                    </div>

                    <!-- Thời gian đọc -->
                    <div class="absolute top-4 right-4 bg-black/40 backdrop-blur-sm text-white text-[11px] font-medium px-2.5 py-1 rounded-full">
                        5 phút đọc
                    </div>
                </div>

                <!-- Nội dung bài viết -->
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-serif text-xl font-bold text-forest-dark leading-snug mb-3 group-hover:text-forest transition">
                            Hành trình tìm trà trên cao nguyên Lâm Đồng
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                            Chúng tôi đã vượt hơn 300km để tìm đến những rẫy trà cổ thụ — nơi những búp trà xanh mướt vẫn được hái bằng tay mỗi sớm mai.
                        </p>
                    </div>

                    <!-- Tác giả & Ngày đăng -->
                    <div class="flex items-center justify-between pt-4 border-t border-black/5 text-xs text-gray-500">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-forest text-white flex items-center justify-center font-bold text-xs">
                                F
                            </div>
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
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-forest-dark text-[11px] font-bold px-3 py-1 rounded-full shadow-sm">
                        SẢN PHẨM MỚI
                    </div>
                    <div class="absolute top-4 right-4 bg-black/40 backdrop-blur-sm text-white text-[11px] font-medium px-2.5 py-1 rounded-full">
                        3 phút đọc
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-serif text-xl font-bold text-forest-dark leading-snug mb-3 group-hover:text-forest transition">
                            Ra mắt dòng trà Tứ Quý — 4 hương vị, 4 mùa cảm xúc
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                            Bộ sưu tập mới nhất của Fadegra lấy cảm hứng từ 4 mùa trong năm, đưa bạn qua từng cung bậc hương vị đặc trưng.
                        </p>
                    </div>
                    <div class="flex items-center justify-between pt-4 border-t border-black/5 text-xs text-gray-500">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-forest text-white flex items-center justify-center font-bold text-xs">
                                F
                            </div>
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
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-forest-dark text-[11px] font-bold px-3 py-1 rounded-full shadow-sm">
                        LỐI SỐNG
                    </div>
                    <div class="absolute top-4 right-4 bg-black/40 backdrop-blur-sm text-white text-[11px] font-medium px-2.5 py-1 rounded-full">
                        4 phút đọc
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-serif text-xl font-bold text-forest-dark leading-snug mb-3 group-hover:text-forest transition">
                            Tại sao một buổi sáng với trà lại thay đổi cả ngày của bạn?
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                            Nghiên cứu chỉ ra rằng thói quen uống trà buổi sáng không chỉ tốt cho sức khỏe mà còn tạo nên sự bình yên trong tâm trí.
                        </p>
                    </div>
                    <div class="flex items-center justify-between pt-4 border-t border-black/5 text-xs text-gray-500">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-forest text-white flex items-center justify-center font-bold text-xs">
                                F
                            </div>
                            <span class="font-medium text-gray-700">Fadegra Team</span>
                        </div>
                        <span>10 tháng 6, 2025</span>
                    </div>
                </div>
            </article>

        </div>
    </div>
</section>

@endsection


<!-- ĐOẠN SCRIPT ĐỂ CHẠY SLIDER SẼ ĐƯỢC ĐẶT Ở CUỐI CÙNG -->
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Swiper !== 'undefined') {
                new Swiper('.hero-swiper', {
                    loop: true, // Lặp lại vô tận
                    autoplay: {
                        delay: 5000, // Tự động chuyển sau 5s
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.hero-next', // Nút mũi tên phải
                        prevEl: '.hero-prev', // Nút mũi tên trái
                    },
                    pagination: {
                        el: '.hero-pagination', // Dấu chấm trang dưới cùng
                        clickable: true, // Cho phép click vào chấm trang
                    },
                });
            } else {
                console.error("Swiper JS chưa được tải. Hãy kiểm tra lại file client_home.blade.php.");
            }
        });
    </script>
@endsection