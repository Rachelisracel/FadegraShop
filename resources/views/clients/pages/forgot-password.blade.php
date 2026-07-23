@extends('layouts.client_menu')

@section('title', 'Quên mật khẩu — Fadegra')

@section('content')
<div class="min-h-[calc(100vh-76px)] flex bg-[#F8F6F2]">
    
    <!-- Form Quên mật khẩu -->
    <div class="w-full flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl shadow-sm border border-black/5">
            
            <div class="text-center mb-8">
                <!-- Icon Ổ khóa -->
                <div class="w-16 h-16 bg-[#354A3D]/10 rounded-full flex items-center justify-center mx-auto mb-5 text-[#354A3D]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>

                <h1 class="font-serif text-3xl font-bold text-[#1F2937] mb-2">Quên mật khẩu?</h1>
                <p class="text-gray-500 text-sm leading-relaxed">Vui lòng nhập địa chỉ email đã đăng ký. Chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu.</p>
            </div>

            <form action="#" method="POST" class="space-y-5">
                @csrf
                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" required placeholder="Nhập địa chỉ email..." 
                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                </div>

                <!-- Nút Submit -->
                <button type="submit" class="w-full bg-[#354A3D] text-white font-bold rounded-xl py-3.5 mt-4 shadow-md hover:bg-[#2A4435] transition-colors flex justify-center items-center gap-2">
                    Gửi liên kết khôi phục
                    <!--<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">-->
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-500 flex items-center justify-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <a href="{{ url('/login') }}" class="font-bold text-[#354A3D] hover:underline ml-1">Quay lại Đăng nhập</a>
            </div>

        </div>
    </div>
</div>
@endsection