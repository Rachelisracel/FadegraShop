@extends('layouts.client_menu')

@section('title', 'Tạo mật khẩu mới — FADEGRA')

@section('content')
<div class="min-h-[calc(100vh-76px)] flex items-center justify-center bg-[#F8F6F2] py-12">
    <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl shadow-sm border border-black/5">
        
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-[#354A3D]/10 rounded-full flex items-center justify-center mx-auto mb-5 text-[#354A3D]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-[#354A3D] mb-2">Tạo mật khẩu mới</h2>
            <p class="text-gray-500 text-sm">Vui lòng nhập mật khẩu mới cho tài khoản <br><b class="text-[#354A3D]">{{ session('otp_email') }}</b></p>
        </div>

        @if(session('success'))
            <div class="mb-5 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2">
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('reset-password.post') }}" method="POST" class="space-y-5" autocomplete="off">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mật khẩu mới</label>
                <input type="password" name="password" required minlength="6" autocomplete="new-password" placeholder="Ít nhất 6 ký tự..." 
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
                @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" required minlength="6" autocomplete="new-password" placeholder="Nhập lại mật khẩu mới..." 
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
            </div>

            <button type="submit" class="w-full bg-[#354A3D] text-white font-bold rounded-xl py-3.5 mt-2 shadow-md hover:bg-[#2A4435] transition-colors">
                Lưu mật khẩu & Đăng nhập
            </button>
        </form>

    </div>
</div>
@endsection