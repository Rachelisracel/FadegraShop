@extends('layouts.client_menu')

@section('title', 'Đăng ký tài khoản — Fadegra')

@section('content')
<div class="min-h-[calc(100vh-76px)] flex bg-cream flex-row-reverse">
    
    <!-- Nửa phải: Hình ảnh (Chỉ hiện trên PC) -->
    <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
        <img src="{{ asset('images/monmoi.jpg') }}" alt="Trà Tứ Quý" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-[#354A3D]/40 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#354A3D]/90 to-transparent"></div>
        
        <div class="absolute bottom-20 right-16 text-white max-w-md text-right z-10">
            <h2 class="font-serif text-4xl font-bold mb-4 leading-tight">Gia nhập<br>cùng chúng tôi</h2>
            <p class="text-base text-white/80 leading-relaxed">Trở thành thành viên của Fadegra để tích điểm đổi quà và nhận những ưu đãi đặc quyền sớm nhất.</p>
        </div>
    </div>

    <!-- Nửa trái: Form Đăng ký -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl shadow-sm border border-black/5">
            
            <div class="text-center mb-8">
                <h1 class="font-serif text-3xl font-bold text-[#1F2937] mb-2">Đăng ký</h1>
                <p class="text-gray-500 text-sm">Tạo tài khoản mới hoàn toàn miễn phí</p>
            </div>

            <form action="#" method="POST" class="space-y-4">
                @csrf
                <!-- Họ Tên -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Họ và tên</label>
                    <input type="text" name="name" required placeholder="Nhập họ tên của bạn..." 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" required placeholder="Nhập địa chỉ email..." 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                </div>

                <!-- Mật khẩu -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mật khẩu</label>
                    <input type="password" name="password" required placeholder="Tạo mật khẩu (Ít nhất 6 ký tự)" 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                </div>

                <!-- Xác nhận mật khẩu -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" required placeholder="Nhập lại mật khẩu..." 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                </div>

                <!-- Nút Submit -->
                <button type="submit" class="w-full bg-[#354A3D] text-white font-bold rounded-xl py-3.5 mt-6 shadow-md hover:bg-[#2A4435] transition-colors flex justify-center items-center gap-2">
                    Tạo tài khoản
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
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