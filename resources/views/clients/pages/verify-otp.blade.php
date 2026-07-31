@extends('layouts.client_menu')

@section('title', 'Xác nhận mã OTP — FADEGRA')

@section('content')
<div class="min-h-[calc(100vh-76px)] flex items-center justify-center bg-cream py-12">
    <div class="max-w-md w-full bg-white p-8 rounded-3xl shadow-sm border border-black/5 text-center">
        
        <h2 class="text-2xl font-bold text-[#354A3D] mb-2">Nhập mã xác nhận</h2>
        <p class="text-gray-500 text-sm mb-6">Mã OTP gồm 6 chữ số đã được gửi tới email <br> <b class="text-[#354A3D]">{{ session('otp_email') }}</b></p>

        <!-- Hiển thị thông báo thành công (Gửi OTP lần 1 hoặc Gửi lại) -->
        @if(session('success'))
            <div class="mb-5 text-green-700 bg-green-50/80 border border-green-200 p-3 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form 1: Nhập OTP để xác nhận -->
        <form action="{{ route('verify-otp.post') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <input type="text" name="otp" required maxlength="6" autocomplete="off" placeholder="" 
                       class="w-full text-center tracking-[0.5em] text-2xl font-bold bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:outline-none focus:border-[#354A3D] focus:ring-1 transition">
                @error('otp') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-[#354A3D] text-white font-bold rounded-xl py-3.5 shadow-md hover:bg-[#2A4435] transition-colors">
                Xác nhận
            </button>
        </form>

        <!-- Form 2: Nút Gửi lại mã OTP -->
        <div class="mt-8 text-sm text-gray-500">
            Chưa nhận được mã? 
            <form action="{{ route('resend-otp.post') }}" method="POST" class="inline-block m-0 p-0">
                @csrf
                <button type="submit" class="font-bold text-[#354A3D] hover:underline bg-transparent border-none cursor-pointer">
                    Gửi lại mã
                </button>
            </form>
        </div>

    </div>
</div>
@endsection