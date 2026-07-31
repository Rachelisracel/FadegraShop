@extends('layouts.client_menu')

@section('title', 'Liên hệ — FADEGRA')

@section('content')
<div class="bg-cream py-12 sm:py-20 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Tiêu đề trang -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-serif font-bold text-[#1F2937] mb-4">Liên Hệ Chúng Tôi</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Bạn có câu hỏi, góp ý hay cần hỗ trợ? Đừng ngần ngại để lại lời nhắn, đội ngũ Fadegra luôn sẵn sàng lắng nghe bạn.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            
            <!-- Cột trái: Thông tin liên hệ + Bản đồ Google Maps -->
            <div>
                <h2 class="text-2xl font-bold text-[#354A3D] mb-6">Thông Tin Cửa Hàng</h2>
                
                <div class="space-y-6 text-gray-700 mb-8">
                    <div class="flex items-start gap-4">
                        <div class="bg-[#E3D2BE]/30 p-3 rounded-full text-[#354A3D] shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div>
                            <h3 class="font-bold mb-1">Địa chỉ</h3>
                            <p>123 Đường Trà Sữa, Quận 1, TP. Hồ Chí Minh</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-[#E3D2BE]/30 p-3 rounded-full text-[#354A3D] shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        </div>
                        <div>
                            <h3 class="font-bold mb-1">Điện thoại</h3>
                            <p>0988 888 888</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-[#E3D2BE]/30 p-3 rounded-full text-[#354A3D] shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <h3 class="font-bold mb-1">Email</h3>
                            <p>support@fadegra.com</p>
                        </div>
                    </div>
                </div>

                <!-- KHUNG GOOGLE MAPS -->
                <div class="rounded-3xl overflow-hidden shadow-sm border border-gray-200 h-64 sm:h-72">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.424167419727!2d106.69834711533413!3d10.778788162098612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3a53e60271%3A0xd6803a6042e6191b!2sHo%20Chi%20Minh%20City!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

            <!-- Cột phải: Form Gửi lời nhắn -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-[#354A3D] mb-6">Gửi Lời Nhắn</h2>

                <!-- Hiển thị thông báo thành công -->
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Họ và tên <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}" required placeholder="Nhập tên của bạn..." 
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 transition">
                        @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" required placeholder="Địa chỉ email..." 
                                   class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 transition">
                            @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Số điện thoại</label>
                            <input type="tel" name="phone" value="{{ old('phone', auth()->check() ? auth()->user()->phone : '') }}" placeholder="Số điện thoại..." 
                                   class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 transition">
                        </div>
                    </div>

                    <!-- THÊM MÃ ĐƠN HÀNG VÀ TIÊU ĐỀ -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mã đơn hàng (Nếu có)</label>
                            <input type="text" name="order_code" value="{{ old('order_code') }}" placeholder="VD: ORD12345" 
                                   class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 transition">
                            @error('order_code') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tiêu đề <span class="text-red-500">*</span></label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required placeholder="Tiêu đề góp ý/hỗ trợ..." 
                                   class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 transition">
                            @error('subject') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nội dung <span class="text-red-500">*</span></label>
                        <textarea name="message" rows="4" required placeholder="Bạn muốn nhắn nhủ điều gì..." 
                                  class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 transition resize-none">{{ old('message') }}</textarea>
                        @error('message') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-[#354A3D] text-white font-bold rounded-xl py-3.5 mt-2 shadow-md hover:bg-[#2A4435] transition-colors">
                        Gửi tin nhắn
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection