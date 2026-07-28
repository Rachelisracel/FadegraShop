@extends('layouts.client_home')

@section('title', 'Đơn hàng của tôi — Fadegra')

@section('content')
<div class="bg-cream min-h-[calc(100vh-200px)] py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">

        <!-- TIÊU ĐỀ & ĐIỀU HƯỚNG -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 border-b border-forest/10 pb-6">
            <div>
                <h1 class="font-serif text-3xl md:text-4xl font-bold text-forest">Đơn hàng của tôi</h1>
                <p class="text-sm text-gray-600 mt-1">Theo dõi tiến trình và lịch sử tất cả các đơn đặt hàng của bạn.</p>
            </div>
            <a href="{{ url('/menu') }}" class="inline-flex items-center gap-2 bg-forest text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-forest-dark transition shadow-md">
                <i class="fa-solid fa-plus text-xs"></i> Đặt món mới
            </a>
        </div>

        <!-- BÁO CÁO / THÔNG BÁO -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-2xl flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-green-600 text-lg"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-triangle-exclamation text-red-600 text-lg"></i>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        <!-- BỘ LỌC TRẠNG THÁI -->
        <div class="flex flex-wrap gap-2 mb-8 bg-white/60 p-2 rounded-2xl border border-black/5 shadow-xs">
            <a href="{{ route('client.orders.index') }}" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition {{ !request('status') ? 'bg-forest text-white shadow-xs' : 'text-gray-600 hover:bg-white hover:text-forest' }}">
                Tất cả đơn
            </a>
            <a href="{{ route('client.orders.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition {{ request('status') == 'pending' ? 'bg-yellow-500 text-white shadow-xs' : 'text-gray-600 hover:bg-white hover:text-forest' }}">
                Chờ xác nhận
            </a>
            <a href="{{ route('client.orders.index', ['status' => 'processing']) }}" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition {{ request('status') == 'processing' ? 'bg-blue-600 text-white shadow-xs' : 'text-gray-600 hover:bg-white hover:text-forest' }}">
                Đang chuẩn bị
            </a>
            <a href="{{ route('client.orders.index', ['status' => 'shipping']) }}" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition {{ request('status') == 'shipping' ? 'bg-purple-600 text-white shadow-xs' : 'text-gray-600 hover:bg-white hover:text-forest' }}">
                Đang giao
            </a>
            <a href="{{ route('client.orders.index', ['status' => 'completed']) }}" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition {{ request('status') == 'completed' ? 'bg-green-600 text-white shadow-xs' : 'text-gray-600 hover:bg-white hover:text-forest' }}">
                Hoàn thành
            </a>
            <a href="{{ route('client.orders.index', ['status' => 'cancelled']) }}" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition {{ request('status') == 'cancelled' ? 'bg-red-600 text-white shadow-xs' : 'text-gray-600 hover:bg-white hover:text-forest' }}">
                Đã hủy
            </a>
        </div>

        <!-- DANH SÁCH ĐƠN HÀNG -->
        @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
            @php
                $statusBadges = [
                    'pending' => ['bg' => 'bg-yellow-100 text-yellow-800 border-yellow-200', 'icon' => 'fa-clock', 'label' => 'Chờ xác nhận'],
                    'processing' => ['bg' => 'bg-blue-100 text-blue-800 border-blue-200', 'icon' => 'fa-fire', 'label' => 'Đang chuẩn bị món'],
                    'shipping' => ['bg' => 'bg-purple-100 text-purple-800 border-purple-200', 'icon' => 'fa-truck-fast', 'label' => 'Đang giao hàng'],
                    'completed' => ['bg' => 'bg-green-100 text-green-800 border-green-200', 'icon' => 'fa-circle-check', 'label' => 'Hoàn thành'],
                    'cancelled' => ['bg' => 'bg-red-100 text-red-800 border-red-200', 'icon' => 'fa-circle-xmark', 'label' => 'Đã hủy'],
                ];
                $badge = $statusBadges[$order->status] ?? ['bg' => 'bg-gray-100 text-gray-700 border-gray-200', 'icon' => 'fa-question', 'label' => 'Không xác định'];
            @endphp
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-black/5 hover:shadow-md transition">
                
                <!-- Card Header -->
                <div class="flex flex-wrap justify-between items-center pb-4 mb-4 border-b border-gray-100 gap-3">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-gray-900 text-base">Đơn hàng #{{ $order->id }}</span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $badge['bg'] }}">
                                <i class="fa-solid {{ $badge['icon'] }}"></i>
                                {{ $badge['label'] }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Đặt ngày: {{ $order->created_at ? $order->created_at->format('H:i - d/m/Y') : 'N/A' }}</p>
                    </div>

                    <div class="text-right">
                        <span class="text-xs text-gray-500 block">Tổng thanh toán</span>
                        <span class="font-serif text-xl font-bold text-forest">{{ number_format($order->total_price, 0, ',', '.') }}đ</span>
                    </div>
                </div>

                <!-- Card Body: Tóm tắt thông tin người nhận -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 text-sm text-gray-600">
                    <div class="bg-gray-50/70 p-4 rounded-2xl border border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Người nhận</p>
                        <p class="font-bold text-gray-800">{{ $order->shippingAddress->full_name ?? 'N/A' }} — {{ $order->shippingAddress->phone ?? '' }}</p>
                        <p class="text-xs text-gray-500 mt-1 truncate">{{ $order->shippingAddress->address ?? 'N/A' }}</p>
                    </div>

                    <div class="bg-gray-50/70 p-4 rounded-2xl border border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Sản phẩm</p>
                        <p class="text-gray-800 font-medium">
                            @if($order->orderItems->count() > 0)
                                {{ $order->orderItems->first()->product->name ?? 'Sản phẩm' }}
                                @if($order->orderItems->count() > 1)
                                    <span class="text-xs text-gray-500">và {{ $order->orderItems->count() - 1 }} sản phẩm khác</span>
                                @endif
                            @else
                                Chưa có sản phẩm
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Card Footer Actions -->
                <div class="flex flex-wrap items-center justify-between pt-2 gap-3">
                    <a href="{{ route('client.orders.show', $order->id) }}" class="inline-flex items-center gap-2 text-forest hover:text-forest-dark font-bold text-sm transition">
                        Xem chi tiết đơn hàng <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>

                    @if($order->status === 'pending')
                    <form action="{{ route('client.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 transition">
                            <i class="fa-solid fa-xmark mr-1"></i> Hủy đơn
                        </button>
                    </form>
                    @endif
                </div>

            </div>
            @endforeach
        </div>

        <!-- PHÂN TRANG -->
        @if($orders->hasPages())
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
        @endif

        @else
        <!-- KHÔNG CÓ ĐƠN HÀNG -->
        <div class="bg-white rounded-3xl p-12 text-center border border-black/5 shadow-sm max-w-md mx-auto my-12">
            <div class="w-20 h-20 bg-cream rounded-full flex items-center justify-center mx-auto mb-4 text-forest text-3xl">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">Chưa có đơn hàng nào</h3>
            <p class="text-gray-500 text-sm mb-6">Bạn chưa đặt đơn hàng nào tại Fadegra. Hãy chọn món trà yêu thích ngay hôm nay!</p>
            <a href="{{ url('/menu') }}" class="inline-block bg-forest text-white font-bold text-sm px-6 py-3 rounded-full hover:bg-forest-dark transition shadow-md">
                Khám phá Menu ngay
            </a>
        </div>
        @endif

    </div>
</div>
@endsection
