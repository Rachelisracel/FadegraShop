@extends('layouts.client_menu')

@section('title', 'Đăng ký tài khoản — FADEGRA')

@section('content')
<div class="min-h-[calc(100vh-76px)] flex bg-[#F8F6F2] flex-row-reverse">
    
    <!-- Nửa phải: Hình ảnh (Chỉ hiện trên PC) -->
    <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
        <img src="{{ asset('images/bangvay.jpg') }}" alt="Trà Tứ Quý" class="absolute inset-0 w-full h-full object-cover object-[center_23%]">
        <div class="absolute inset-0 bg-[#354A3D]/40 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#354A3D]/90 to-transparent"></div>
        
        <div class="absolute bottom-20 right-16 text-white max-w-md text-right z-10">
            <h2 class="font-serif text-4xl font-bold mb-4 leading-tight">Gia nhập<br>cùng chúng tôi</h2>
            <p class="text-base text-white/80 leading-relaxed">Trở thành thành viên của Fadegra để tích điểm đổi quà và nhận những ưu đãi đặc quyền sớm nhất.</p>
        </div>
    </div>

    <!-- Nửa trái: Form Đăng ký -->
    <!-- Nửa trái: Form Đăng ký -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl shadow-sm border border-black/5">
            
            <div class="text-center mb-8">
                <h1 class="font-serif text-3xl font-bold text-[#1F2937] mb-2">Đăng ký</h1>
                <p class="text-gray-500 text-sm">Tạo tài khoản mới hoàn toàn miễn phí</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST" class="space-y-4" autocomplete="off">
                @csrf
                
                <!-- Họ Tên -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Họ và tên</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autocomplete="off" placeholder="Nhập họ tên của bạn..." 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                    @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Nhập địa chỉ email..." 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                    @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Số điện thoại -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Số điện thoại</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" required autocomplete="off" placeholder="Nhập số điện thoại của bạn..." 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                    @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Mật khẩu -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mật khẩu</label>
                    <input type="password" name="password" minlength="6" required autocomplete="new-password" placeholder="Tạo mật khẩu (Ít nhất 6 ký tự)" 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                    @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Xác nhận mật khẩu -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" minlength="6" required autocomplete="new-password" placeholder="Nhập lại mật khẩu..." 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                </div>

                <!-- Nút Submit -->
                <button type="submit" class="w-full bg-[#354A3D] text-white font-bold rounded-xl py-3.5 mt-6 shadow-md hover:bg-[#2A4435] transition-colors flex justify-center items-center gap-2">
                    Tạo tài khoản
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-500">
                Đã có tài khoản? 
                <a href="{{ url('/login') }}" class="font-bold text-[#354A3D] hover:underline">Đăng nhập ngay</a>
            </div>

        </div>
    </div>
</div>
@endsection