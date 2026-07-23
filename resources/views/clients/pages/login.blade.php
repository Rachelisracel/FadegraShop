@extends('layouts.client_menu')

@section('title', 'Đăng nhập — Fadegra')

@section('content')
<div class="min-h-[calc(100vh-76px)] flex bg-[#F8F6F2]">
    
    <!-- Nửa trái: Hình ảnh (Chỉ hiện trên PC) -->
    <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
        <img src="{{ asset('images/1.jpg') }}" alt="bangvay1" class="absolute inset-0 w-full h-full object-cover">
        <!-- Lớp phủ màu xanh rêu mờ -->
        <div class="absolute inset-0 bg-[#354A3D]/40 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#354A3D]/90 to-transparent"></div>
        
        <!-- Chữ đè lên ảnh -->
        <div class="absolute bottom-20 left-16 text-white max-w-md z-10">
            <h2 class="font-serif text-4xl font-bold mb-4 leading-tight">Chào mừng<br>trở lại!</h2>
            <p class="text-base text-white/80 leading-relaxed">Cùng Fadegra thưởng thức những ly trà mộc mạc và tận hưởng phút giây thư giãn trọn vẹn nhất hôm nay.</p>
        </div>
    </div>

    <!-- Nửa phải: Form Đăng nhập -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl shadow-sm border border-black/5">
            
            <div class="text-center mb-8">
                <h1 class="font-serif text-3xl font-bold text-[#1F2937] mb-2">Đăng nhập</h1>
                <p class="text-gray-500 text-sm">Vui lòng điền thông tin để tiếp tục</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-xl text-sm mb-4 border border-red-100">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf
                <!-- Email hoặc Số điện thoại -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email / Số điện thoại</label>
                    <input type="text" name="login_field" required placeholder="Nhập email hoặc số điện thoại..." 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                </div>

                <!-- Mật khẩu -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-sm font-semibold text-gray-700">Mật khẩu</label>
                        <a href="{{ url('/forgot-password') }}" class="text-xs font-medium text-[#354A3D] hover:underline">Quên mật khẩu?</a>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••" 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                </div>

                <!-- Ghi nhớ đăng nhập -->
                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" id="remember" class="w-4 h-4 text-[#354A3D] rounded border-gray-300 focus:ring-[#354A3D] accent-[#354A3D]">
                    <label for="remember" class="text-sm text-gray-600 cursor-pointer">Ghi nhớ đăng nhập</label>
                </div>

                <!-- Nút Submit -->
                <button type="submit" class="w-full bg-[#354A3D] text-white font-bold rounded-xl py-3.5 mt-4 shadow-md hover:bg-[#2A4435] transition-colors flex justify-center items-center gap-2">
                    Đăng nhập
                    <!--<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>-->
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-500">
                Chưa có tài khoản? 
                <a href="{{ url('/register') }}" class="font-bold text-[#354A3D] hover:underline">Đăng ký ngay</a>
            </div>

        </div>
    </div>
</div>
@endsection