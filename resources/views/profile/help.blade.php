@extends('layouts.client_home')

@section('content')
<!-- Đổi nền thành #F8F9FA để khớp 100% với nền của trang Login / Tài khoản -->
<div class="bg-cream min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6 font-medium">
            <a href="{{ url('/') }}" class="hover:text-[#354A3D] transition-colors">Trang chủ</a> 
            <span class="mx-2">/</span> 
            <a href="{{ url('/profile') }}" class="hover:text-[#354A3D] transition-colors">Tài khoản</a>
            <span class="mx-2">/</span>
            <span class="text-[#354A3D] font-bold">Trung tâm trợ giúp</span>
        </div>

        <div class="flex flex-col md:flex-row gap-8">
            
            <!-- ================= CỘT TRÁI: SIDEBAR ================= -->
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                    <ul class="flex flex-col space-y-2">
                        <li>
                            <a href="{{ url('/profile') }}" class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-regular fa-address-card text-lg w-6 text-center"></i>
                                    <span>Tài khoản của tôi</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/orders') }}" class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-cart-shopping text-lg w-6 text-center"></i>
                                    <span>Đơn hàng</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/orders/history') }}" class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-clipboard-list text-lg w-6 text-center"></i>
                                    <span>Lịch sử đơn hàng</span>
                                </div>
                            </a>
                        </li>
                        <!-- TRUNG TÂM TRỢ GIÚP ACTIVE -->
                        <li>
                            <a href="{{ url('/help') }}" class="flex items-center justify-between px-4 py-3 rounded-xl bg-[#354A3D] text-white font-bold transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-headset text-lg w-6 text-center"></i>
                                    <span>Trung tâm trợ giúp</span>
                                </div>
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </a>
                        </li>
                        <div class="border-t border-gray-100 my-2"></div>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex w-full items-center justify-between px-4 py-3 rounded-xl hover:bg-red-50 text-gray-600 hover:text-red-600 font-medium transition-colors text-left">
                                    <div class="flex items-center gap-3">
                                        <i class="fa-solid fa-arrow-right-from-bracket text-lg w-6 text-center"></i>
                                        <span>Đăng xuất</span>
                                    </div>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ================= CỘT PHẢI: NỘI DUNG ================= -->
            <div class="w-full md:w-3/4">
                
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                    
                    <!-- 1. Hero Banner Hỗ trợ -->
                    <div class="bg-gradient-to-r from-[#293B2B] to-[#3F5A42] px-8 py-10 md:px-12 md:py-14 relative overflow-hidden">
                        <!-- Vòng tròn trang trí -->
                        <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-white opacity-5 rounded-full blur-2xl"></div>
                        <div class="absolute top-0 right-1/4 w-32 h-32 bg-[#E5D3B3] opacity-10 rounded-full blur-xl"></div>
                        
                        <div class="relative z-10 text-white">
                            <p class="text-white/80 text-sm mb-1 font-sans">
                                Xin chào {{ Auth::user()->name ?? 'Quý khách' }}
                            </p>
                            <!-- Sử dụng font-serif (Playfair) cho tiêu đề -->
                            <h2 class="font-serif text-3xl md:text-4xl font-bold mb-8 tracking-wide text-white">
                                FADEGRA giúp được gì cho bạn?
                            </h2>
                            
                            <!-- Thanh tìm kiếm -->
                            <div class="relative w-full">
                                <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                                <input type="text" placeholder="Nhập câu hỏi, từ khóa..." 
                                       class="w-full bg-white text-gray-800 rounded-full py-4 pl-14 pr-6 focus:outline-none focus:ring-2 focus:ring-[#354A3D] shadow-lg transition-all font-sans">
                            </div>
                        </div>
                    </div>

                    <!-- 2. Section: Về FADEGRA -->
                    <div class="p-8 md:p-10 bg-white">
                        <!-- Sửa font-serif cho các tiêu đề mục -->
                        <h3 class="font-serif text-2xl font-bold text-[#354A3D] mb-6">Về FADEGRA</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12">
                            <a href="#" class="flex justify-between items-center py-4 border-b border-gray-100 hover:text-[#354A3D] group transition-colors">
                                <span class="text-gray-700 text-sm group-hover:font-medium">Tại sao đến tháng sinh nhật, tôi không nhận được ưu đãi?</span>
                                <i class="fa-solid fa-chevron-right text-gray-300 text-xs group-hover:text-[#354A3D]"></i>
                            </a>
                            <a href="#" class="flex justify-between items-center py-4 border-b border-gray-100 hover:text-[#354A3D] group transition-colors">
                                <span class="text-gray-700 text-sm group-hover:font-medium">Tôi có thể tích điểm thành viên như thế nào?</span>
                                <i class="fa-solid fa-chevron-right text-gray-300 text-xs group-hover:text-[#354A3D]"></i>
                            </a>
                            <a href="#" class="flex justify-between items-center py-4 border-b border-gray-100 hover:text-[#354A3D] group transition-colors">
                                <span class="text-gray-700 text-sm group-hover:font-medium">FADEGRA có giao hàng tận nơi không?</span>
                                <i class="fa-solid fa-chevron-right text-gray-300 text-xs group-hover:text-[#354A3D]"></i>
                            </a>
                            <a href="#" class="flex justify-between items-center py-4 border-b border-gray-100 hover:text-[#354A3D] group transition-colors">
                                <span class="text-gray-700 text-sm group-hover:font-medium">Cách kiểm tra hạng thành viên hiện tại?</span>
                                <i class="fa-solid fa-chevron-right text-gray-300 text-xs group-hover:text-[#354A3D]"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Đường kẻ phân cách (Dùng cùng màu nền #F8F9FA) -->
                    <div class="h-3 w-full bg-cream"></div>

                    <!-- 3. Section: Chính sách -->
                    <div class="p-8 md:p-10 bg-white">
                        <h3 class="font-serif text-2xl font-bold text-[#354A3D] mb-6">Chính sách</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12">
                            <a href="#" class="flex justify-between items-center py-4 border-b border-gray-100 hover:text-[#354A3D] group transition-colors">
                                <span class="text-gray-700 text-sm group-hover:font-medium pr-4">Sử dụng hóa đơn chưa tích điểm để tích điểm được không?</span>
                                <i class="fa-solid fa-chevron-right text-gray-300 text-xs group-hover:text-[#354A3D] shrink-0"></i>
                            </a>
                            <a href="#" class="flex justify-between items-center py-4 border-b border-gray-100 hover:text-[#354A3D] group transition-colors">
                                <span class="text-gray-700 text-sm group-hover:font-medium pr-4">Đặt hàng qua hotline có được áp dụng ưu đãi Thành viên?</span>
                                <i class="fa-solid fa-chevron-right text-gray-300 text-xs group-hover:text-[#354A3D] shrink-0"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Đường kẻ phân cách -->
                    <div class="h-3 w-full bg-cream"></div>

                    <!-- 4. Section: Liên hệ hỗ trợ -->
                    <div class="p-8 md:p-10 bg-white">
                        <h3 class="font-serif text-2xl font-bold text-[#354A3D] mb-6">Liên Hệ Hỗ Trợ</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-2">
                            <a href="mailto:customerservice@fadegra.vn" class="flex items-center gap-4 py-4 border-b border-gray-100 hover:bg-gray-50 transition-colors rounded-lg px-2 -mx-2">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 text-lg shrink-0">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">customerservice@fadegra.vn</span>
                            </a>
                            <a href="#" class="flex items-center gap-4 py-4 border-b border-gray-100 hover:bg-gray-50 transition-colors rounded-lg px-2 -mx-2">
                                <div class="w-10 h-10 rounded-full bg-[#1877F2] flex items-center justify-center text-white text-xl shrink-0">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">https://m.me/fadegra.vn</span>
                            </a>
                            <a href="tel:1900234518" class="flex items-center gap-4 py-4 border-b border-gray-100 hover:bg-gray-50 transition-colors rounded-lg px-2 -mx-2">
                                <div class="w-10 h-10 rounded-full bg-[#25D366] flex items-center justify-center text-white text-lg shrink-0">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">1900 234 518 (Ext.01)</span>
                            </a>
                            <a href="#" class="flex items-center gap-4 py-4 border-b border-gray-100 hover:bg-gray-50 transition-colors rounded-lg px-2 -mx-2">
                                <div class="w-10 h-10 rounded-full bg-[#0068FF] flex items-center justify-center text-white shrink-0">
                                    <span class="font-bold text-[10px]">Zalo</span>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">https://zalo.me/fadegra</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection