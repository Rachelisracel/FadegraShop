@extends('layouts.client_home')

@section('title', 'Lịch sử đơn hàng — Fadegra')

@section('content')
<div class="bg-cream min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <!-- Tiêu đề -->
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="font-serif text-3xl font-bold text-[#1F2937]">Lịch sử đơn hàng</h1>
                <p class="text-gray-500 text-sm mt-1">Xin chào {{ Auth::user()->name ?? 'Quý khách' }}, danh sách các đơn hàng đã hoàn tất hoặc đã hủy.</p>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6 font-medium">
            <a href="{{ url('/') }}" class="hover:text-[#354A3D] transition-colors">Trang chủ</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/profile') }}" class="hover:text-[#354A3D] transition-colors">Tài khoản</a>
            <span class="mx-2">/</span>
            <span class="text-[#354A3D] font-bold">Lịch sử đơn hàng</span>
        </div>

        <!-- BỐ CỤC 2 CỘT -->
        <div class="flex flex-col md:flex-row gap-8">

            <!-- SIDEBAR -->
            @include('clients.pages.orders.partials.sidebar')

            <!-- CỘT PHẢI: NỘI DUNG -->
            <div class="w-full md:w-3/4">
                <div class="bg-white rounded-[2rem] p-6 md:p-10 shadow-sm border border-gray-100 min-h-[500px]">

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border border-red-100">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Tabs -->
                    <div class="flex overflow-x-auto space-x-2 border-b border-gray-100 mb-6 pb-2 hide-scrollbar">
                        @foreach($tabs as $key => $label)
                            @php
                                $isActive = (request('status') === $key) || (request('status') === null && $key === 'all');
                            @endphp
                            <a href="{{ request()->url() }}?status={{ $key }}" 
                               class="whitespace-nowrap px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ $isActive ? 'bg-[#354A3D] text-white shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-[#354A3D]' }}">
                                {{ $label }} 
                                @if(isset($statusCounts[$key]) && $statusCounts[$key] > 0)
                                    <span class="ml-1 px-2 py-0.5 rounded-full text-[10px] {{ $isActive ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-500' }}">{{ $statusCounts[$key] }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>

                    <!-- NỘI DUNG LỊCH SỬ ĐƠN HÀNG -->
                    <div class="space-y-6">
                        @forelse($orders ?? [] as $order)
                            <div class="border border-gray-100 rounded-2xl p-5 hover:shadow-md transition-shadow bg-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div>
                                    <span class="font-bold text-gray-800 text-base">Đơn hàng #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                                    <p class="text-xs text-gray-400 mt-1">{{ $order->created_at->format('H:i, d/m/Y') }} · {{ $order->orderItems->count() }} sản phẩm</p>
                                </div>
                                <div class="flex items-center gap-4 w-full sm:w-auto justify-between sm:justify-end">
                                    <div class="text-right">
                                        <span class="font-bold text-[#354A3D] block text-base">{{ number_format($order->total_price ?? $order->total_amount ?? 0, 0, ',', '.') }}đ</span>
                                        @php
                                            $statusColors = [
                                                'completed' => 'bg-green-50 text-green-700',
                                                'cancelled' => 'bg-red-50 text-red-700',
                                            ];
                                            $colorClass = $statusColors[$order->status] ?? 'bg-gray-50 text-gray-700';
                                        @endphp
                                        <span class="inline-block mt-1 px-3 py-1 text-xs font-semibold rounded-full {{ $colorClass }}">
                                            {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                        </span>
                                    </div>
                                    <a href="{{ url('/orders/' . $order->id) }}" class="px-4 py-2 rounded-xl bg-[#354A3D] text-white text-sm font-medium hover:bg-[#2A4435] transition-colors shadow-sm">
                                        Chi tiết
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16">
                                <div class="bg-gray-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-solid fa-clipboard-list text-4xl text-gray-300"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-700">Chưa có lịch sử đơn hàng</h3>
                                <p class="text-gray-500 mt-2 text-sm">Các đơn hàng đã hoàn tất hoặc đã hủy sẽ hiển thị ở đây.</p>
                            </div>
                        @endforelse
                    </div>

                    @if(isset($orders) && method_exists($orders, 'hasPages') && $orders->hasPages())
                        <div class="mt-8">
                            {{ $orders->links() }}
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>
@endsection
