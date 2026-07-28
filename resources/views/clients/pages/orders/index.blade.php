@extends('layouts.client_menu')

@section('title', 'Lịch sử đơn hàng — Fadegra')

@section('content')
<div class="bg-[#F8F6F2] min-h-screen py-8 md:py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        <!-- Tiêu đề -->
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="font-serif text-3xl font-bold text-[#1F2937]">Lịch sử đơn hàng</h1>
                <p class="text-gray-500 text-sm mt-1">Xin chào {{ Auth::user()->name }}, đây là toàn bộ đơn hàng của bạn.</p>
            </div>
            <a href="{{ route('my.orders.lookup.form') }}" class="text-sm font-medium text-[#354A3D] hover:underline flex items-center gap-1.5 shrink-0">
                <i class="fa-solid fa-magnifying-glass"></i> Tra cứu đơn bằng mã đơn + SĐT
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabs trạng thái -->
        <div class="flex flex-wrap gap-2 mb-8 overflow-x-auto pb-1">
            @php
                $tabs = ['all' => 'Tất cả'] + $statusLabels;
            @endphp
            @foreach($tabs as $key => $label)
                <a href="{{ route('my.orders.index', $key === 'all' ? [] : ['status' => $key]) }}"
                   class="px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap transition-colors border
                   {{ $status === $key ? 'bg-[#354A3D] text-white border-[#354A3D]' : 'bg-white text-gray-600 border-gray-200 hover:border-[#354A3D]/40' }}">
                    {{ $label }}
                    @if($key !== 'all' && ($statusCounts[$key] ?? 0) > 0)
                        <span class="ml-1 {{ $status === $key ? 'text-white/80' : 'text-gray-400' }}">({{ $statusCounts[$key] }})</span>
                    @endif
                </a>
            @endforeach
        </div>

        @if($orders->isEmpty())
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-12 text-center">
                <i class="fa-solid fa-receipt text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Chưa có đơn hàng nào trong mục này.</p>
                <a href="{{ url('/menu') }}" class="inline-block mt-5 bg-[#354A3D] text-white font-semibold rounded-xl px-6 py-2.5 hover:bg-[#2A4435] transition-colors text-sm">
                    Bắt đầu đặt trà ngay
                </a>
            </div>
        @else
            <div class="space-y-5">
                @foreach($orders as $order)
                    @php
                        $badgeColors = [
                            'pending'    => 'bg-amber-50 text-amber-700 border-amber-200',
                            'processing' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'shipping'   => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                            'completed'  => 'bg-green-50 text-green-700 border-green-200',
                            'cancelled'  => 'bg-red-50 text-red-700 border-red-200',
                        ];
                    @endphp
                    <a href="{{ route('my.orders.show', $order->id) }}" class="block bg-white rounded-2xl border border-black/5 shadow-sm p-5 sm:p-6 hover:shadow-md transition-shadow">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-[#F8F6F2] flex items-center justify-center text-[#354A3D] shrink-0">
                                    <i class="fa-solid fa-mug-saucer text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#1F2937]">Đơn hàng #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $order->created_at->format('H:i, d/m/Y') }} · {{ $order->orderItems->count() }} sản phẩm</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 sm:justify-end">
                                <span class="text-sm font-bold text-[#354A3D]">{{ number_format($order->total_price, 0, ',', '.') }}đ</span>
                                <span class="text-xs font-semibold px-3 py-1 rounded-full border {{ $badgeColors[$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-200' }}">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                                <i class="fa-solid fa-chevron-right text-gray-300 text-sm"></i>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
