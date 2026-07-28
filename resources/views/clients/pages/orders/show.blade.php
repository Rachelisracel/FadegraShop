@extends('layouts.client_home')

@section('title', 'Chi tiết đơn hàng #' . $order->id . ' — Fadegra')

@section('content')
<div class="bg-cream min-h-[calc(100vh-200px)] py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

        <!-- HEADER ĐIỀU HƯỚNG -->
        <div class="mb-6">
            <a href="{{ route('client.orders.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-forest hover:text-forest-dark transition mb-4">
                <i class="fa-solid fa-arrow-left text-xs"></i> Quay lại danh sách đơn hàng
            </a>
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <div>
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-forest">Chi tiết đơn hàng #{{ $order->id }}</h1>
                    <p class="text-xs text-gray-500 mt-1">Ngày đặt: {{ $order->created_at ? $order->created_at->format('H:i - d/m/Y') : 'N/A' }}</p>
                </div>
                @if($order->status === 'pending')
                <form action="{{ route('client.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 rounded-full text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 transition shadow-xs">
                        <i class="fa-solid fa-xmark mr-1"></i> Hủy đơn hàng
                    </button>
                </form>
                @endif
            </div>
        </div>

        <!-- NOTIFICATION -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-2xl flex items-center gap-3 shadow-sm">
            <i class="fa-solid fa-circle-check text-green-600 text-lg"></i>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl flex items-center gap-3 shadow-sm">
            <i class="fa-solid fa-triangle-exclamation text-red-600 text-lg"></i>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
        @endif

        <!-- tiến trình trạng thái (TIMELINE) -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-black/5 mb-8">
            <h3 class="text-base font-bold text-gray-800 mb-6">Trạng thái đơn hàng</h3>

            @if($order->status === 'cancelled')
            <div class="bg-red-50 border border-red-200 rounded-2xl p-5 text-center text-red-700">
                <i class="fa-solid fa-circle-xmark text-3xl mb-2"></i>
                <p class="font-bold text-base">Đơn hàng này đã bị hủy</p>
                <p class="text-xs text-red-500 mt-1">Vui lòng tạo đơn hàng mới nếu bạn vẫn có nhu cầu thưởng thức trà Fadegra.</p>
            </div>
            @else
            @php
                $steps = [
                    'pending' => ['title' => 'Đã đặt đơn', 'icon' => 'fa-clipboard-check'],
                    'processing' => ['title' => 'Đang chuẩn bị', 'icon' => 'fa-fire'],
                    'shipping' => ['title' => 'Đang giao hàng', 'icon' => 'fa-truck-fast'],
                    'completed' => ['title' => 'Giao thành công', 'icon' => 'fa-circle-check'],
                ];
                $orderSteps = array_keys($steps);
                $currentIndex = array_search($order->status, $orderSteps);
                if ($currentIndex === false) $currentIndex = 0;
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 relative">
                @foreach($steps as $key => $info)
                @php
                    $stepIndex = array_search($key, $orderSteps);
                    $isPassed = $stepIndex <= $currentIndex;
                    $isCurrent = $stepIndex === $currentIndex;
                @endphp
                <div class="flex flex-col items-center text-center">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg mb-2 transition-all {{ $isCurrent ? 'bg-forest text-white ring-4 ring-forest/20 shadow-md' : ($isPassed ? 'bg-forest/90 text-white' : 'bg-gray-100 text-gray-400') }}">
                        <i class="fa-solid {{ $info['icon'] }}"></i>
                    </div>
                    <span class="text-xs font-bold {{ $isPassed ? 'text-forest' : 'text-gray-400' }}">{{ $info['title'] }}</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- CỘT TRÁI: DANH SÁCH MÓN ĐÃ ĐẶT (2/3 width) -->
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-black/5">
                    <h3 class="text-base font-bold text-gray-800 mb-4 border-b border-gray-100 pb-3">Sản phẩm đã đặt</h3>

                    <div class="divide-y divide-gray-100">
                        @forelse($order->orderItems as $item)
                        <div class="py-4 flex items-center gap-4 first:pt-0 last:pb-0">
                            <!-- Ảnh sản phẩm -->
                            <div class="w-16 h-16 bg-cream rounded-2xl overflow-hidden flex-shrink-0 border border-black/5">
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/monmoi.jpg') }}'">
                                @else
                                    <img src="{{ asset('images/monmoi.jpg') }}" alt="Product" class="w-full h-full object-cover">
                                @endif
                            </div>

                            <!-- Thông tin tên & size -->
                            <div class="flex-grow">
                                <h4 class="font-bold text-gray-800 text-sm">{{ $item->product->name ?? 'Sản phẩm' }}</h4>
                                <div class="text-xs text-gray-500 mt-0.5">
                                    @if($item->size)
                                        <span>Size: {{ $item->size->name }}</span>
                                    @endif
                                    @if($item->toppings && $item->toppings->count() > 0)
                                        <span class="ml-2">• Topping: {{ $item->toppings->pluck('name')->join(', ') }}</span>
                                    @endif
                                </div>
                                <span class="text-xs text-gray-400 mt-1 block">x{{ $item->quantity }}</span>
                            </div>

                            <!-- Giá tiền -->
                            <div class="text-right flex-shrink-0">
                                <span class="font-bold text-sm text-forest">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                        @empty
                        <p class="text-xs text-gray-500 py-4">Không có dữ liệu chi tiết sản phẩm.</p>
                        @endforelse
                    </div>

                    <!-- TỔNG TIỀN CHI TIẾT -->
                    <div class="mt-6 pt-4 border-t border-gray-100 space-y-2 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Tạm tính</span>
                            <span class="font-medium">{{ number_format($order->total_price, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Phí giao hàng</span>
                            <span class="font-medium">0đ</span>
                        </div>
                        <div class="flex justify-between text-base font-bold text-forest pt-2 border-t border-dashed border-gray-200">
                            <span>Tổng cộng</span>
                            <span class="font-serif text-xl">{{ number_format($order->total_price, 0, ',', '.') }}đ</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CỘT PHẢI: THÔNG TIN GIAO HÀNG (1/3 width) -->
            <div class="space-y-6">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-black/5">
                    <h3 class="text-base font-bold text-gray-800 mb-4 border-b border-gray-100 pb-3">Địa chỉ nhận hàng</h3>

                    <div class="space-y-3 text-sm">
                        <div>
                            <span class="text-xs font-bold text-gray-400 block uppercase">Họ và tên</span>
                            <span class="font-bold text-gray-800">{{ $order->shippingAddress->full_name ?? 'N/A' }}</span>
                        </div>

                        <div>
                            <span class="text-xs font-bold text-gray-400 block uppercase">Số điện thoại</span>
                            <span class="font-medium text-gray-700">{{ $order->shippingAddress->phone ?? 'N/A' }}</span>
                        </div>

                        <div>
                            <span class="text-xs font-bold text-gray-400 block uppercase">Địa chỉ chi tiết</span>
                            <span class="text-gray-700 text-xs block mt-0.5 leading-relaxed">{{ $order->shippingAddress->address ?? 'N/A' }}</span>
                        </div>

                        @if(!empty($order->shippingAddress->detail))
                        <div>
                            <span class="text-xs font-bold text-gray-400 block uppercase">Ghi chú</span>
                            <span class="text-gray-600 text-xs italic block mt-0.5">{{ $order->shippingAddress->detail }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
