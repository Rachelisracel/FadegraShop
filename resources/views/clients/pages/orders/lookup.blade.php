@extends('layouts.client_menu')

@section('title', 'Tra cứu đơn hàng — Fadegra')

@section('content')
<div class="bg-[#F8F6F2] min-h-[calc(100vh-76px)] flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl shadow-sm border border-black/5">

        <div class="text-center mb-8">
            <div class="w-14 h-14 rounded-2xl bg-[#354A3D]/10 text-[#354A3D] flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-magnifying-glass text-xl"></i>
            </div>
            <h1 class="font-serif text-2xl font-bold text-[#1F2937] mb-2">Tra cứu đơn hàng</h1>
            <p class="text-gray-500 text-sm">Nhập mã đơn hàng và số điện thoại đã dùng khi đặt để xem chi tiết.</p>
        </div>

        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('orders.lookup') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mã đơn hàng</label>
                <input type="text" name="order_code" required value="{{ old('order_code') }}" placeholder="Ví dụ: 000123 hoặc #123"
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Số điện thoại đặt hàng</label>
                <input type="tel" name="phone" required value="{{ old('phone') }}" placeholder="Nhập số điện thoại..."
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
            </div>

            <button type="submit" class="w-full bg-[#354A3D] text-white font-bold rounded-xl py-3.5 mt-2 shadow-md hover:bg-[#2A4435] transition-colors flex justify-center items-center gap-2">
                Tra cứu đơn hàng
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-500">
            Bạn đã có tài khoản?
            <a href="{{ url('/login') }}" class="font-bold text-[#354A3D] hover:underline">Đăng nhập</a>
            để xem toàn bộ lịch sử đơn hàng.
        </div>
    </div>
</div>
@endsection
