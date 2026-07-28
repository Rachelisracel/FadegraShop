@extends('layouts.client_menu')

@section('title', 'Chi tiết đơn hàng #' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' — Fadegra')

@section('content')
@php
    $badgeColors = [
        'pending'    => 'bg-amber-50 text-amber-700 border-amber-200',
        'processing' => 'bg-blue-50 text-blue-700 border-blue-200',
        'shipping'   => 'bg-indigo-50 text-indigo-700 border-indigo-200',
        'completed'  => 'bg-green-50 text-green-700 border-green-200',
        'cancelled'  => 'bg-red-50 text-red-700 border-red-200',
    ];
    $paymentLabels = [
        'cod'         => 'Thanh toán khi nhận hàng (COD)',
        'bank'        => 'Chuyển khoản ngân hàng',
        'momo'        => 'Ví MoMo',
        'zalopay'     => 'ZaloPay',
        'card'        => 'Thẻ tín dụng/ghi nợ',
    ];
    $stepKeys = array_keys($timelineSteps);
    $currentStepIndex = array_search($order->status, $stepKeys);
@endphp

<div class="bg-[#F8F6F2] min-h-screen py-8 md:py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        <!-- Back + Header -->
        <div class="mb-6">
            <a href="{{ $isOwner ? route('my.orders.index') : route('my.orders.lookup.form') }}" class="text-sm text-gray-500 hover:text-[#354A3D] flex items-center gap-1.5 mb-4">
                <i class="fa-solid fa-arrow-left text-xs"></i> Quay lại
            </a>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#1F2937]">Đơn hàng #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
                    <p class="text-gray-500 text-sm mt-1">Đặt lúc {{ $order->created_at->format('H:i, d/m/Y') }}</p>
                </div>
                <span class="text-sm font-semibold px-4 py-1.5 rounded-full border w-fit {{ $badgeColors[$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-200' }}">
                    {{ $statusLabels[$order->status] ?? $order->status }}
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3">{{ session('error') }}</div>
        @endif

        <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-start space-y-8 lg:space-y-0">

            <!-- CỘT TRÁI -->
            <div class="lg:col-span-7 space-y-6">

                <!-- Timeline trạng thái -->
                <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 sm:p-8">
                    <h2 class="font-serif text-lg font-bold text-[#1F2937] mb-6">Trạng thái đơn hàng</h2>

                    @if($order->status === 'cancelled')
                        <div class="flex items-center gap-3 bg-red-50 border border-red-100 rounded-xl px-4 py-3 text-red-700 text-sm">
                            <i class="fa-solid fa-circle-xmark text-lg"></i>
                            <span>Đơn hàng này đã bị hủy.</span>
                        </div>
                    @else
                        <div class="flex items-start justify-between relative">
                            @php
                                $progressPercent = $currentStepIndex >= 0 ? ($currentStepIndex / (count($stepKeys) - 1)) * 100 : 0;
                            @endphp
                            <div class="absolute top-5 left-5 right-5 h-0.5 bg-gray-200"></div>
                            <div class="absolute top-5 left-5 h-0.5 bg-[#354A3D] transition-all"
                                 style="width: calc((100% - 2.5rem) * {{ $progressPercent }} / 100)"></div>

                            @foreach($timelineSteps as $key => $step)
                                @php
                                    $stepIndex = array_search($key, $stepKeys);
                                    $isDone = $currentStepIndex >= 0 && $stepIndex <= $currentStepIndex;
                                @endphp
                                <div class="relative z-10 flex flex-col items-center text-center w-1/4">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 mb-2
                                        {{ $isDone ? 'bg-[#354A3D] border-[#354A3D] text-white' : 'bg-white border-gray-300 text-gray-300' }}">
                                        <i class="fa-solid {{ $step['icon'] }} text-sm"></i>
                                    </div>
                                    <span class="text-xs font-medium {{ $isDone ? 'text-[#1F2937]' : 'text-gray-400' }}">{{ $step['label'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Lịch sử chi tiết -->
                    @if($order->statusHistory->isNotEmpty())
                        <div class="mt-8 pt-6 border-t border-gray-100 space-y-4">
                            @foreach($order->statusHistory as $history)
                                <div class="flex items-start gap-3 text-sm">
                                    <div class="w-1.5 h-1.5 rounded-full bg-[#354A3D] mt-2 shrink-0"></div>
                                    <div>
                                        <p class="font-semibold text-[#1F2937]">{{ $statusLabels[$history->status] ?? $history->status }}</p>
                                        @if($history->note)
                                            <p class="text-gray-500">{{ $history->note }}</p>
                                        @endif
                                        <p class="text-xs text-gray-400 mt-0.5">{{ \Carbon\Carbon::parse($history->changed_at)->format('H:i, d/m/Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 sm:p-8">
                    <h2 class="font-serif text-lg font-bold text-[#1F2937] mb-5">Sản phẩm ({{ $order->orderItems->count() }})</h2>
                    <div class="space-y-5">
                        @foreach($order->orderItems as $item)
                            @php
                                $img = optional($item->product->images->first())->image;
                                $alreadyReviewed = in_array($item->product_id, $reviewedProductIds);
                            @endphp
                            <div class="flex items-start gap-4 pb-5 border-b border-gray-100 last:border-0 last:pb-0">
                                <div class="w-16 h-16 rounded-xl bg-[#F8F6F2] overflow-hidden shrink-0 flex items-center justify-center">
                                    @if($img)
                                        <img src="{{ asset('images/' . $img) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-mug-hot text-gray-300 text-xl"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-[#1F2937]">{{ $item->product->name ?? 'Sản phẩm đã ngừng bán' }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        @if($item->size) Size: {{ $item->size->name }} @endif
                                        @if($item->toppings->isNotEmpty())
                                            · Topping: {{ $item->toppings->pluck('name')->join(', ') }}
                                        @endif
                                    </p>
                                    <p class="text-sm text-gray-500 mt-1">SL: {{ $item->quantity }} × {{ number_format($item->price, 0, ',', '.') }}đ</p>

                                    @if($canReview)
                                        <div class="mt-3">
                                            @if($alreadyReviewed)
                                                <span class="inline-flex items-center gap-1 text-xs font-medium text-green-600">
                                                    <i class="fa-solid fa-check"></i> Bạn đã đánh giá sản phẩm này
                                                </span>
                                            @else
                                                <button type="button" onclick="document.getElementById('review-form-{{ $item->product_id }}').classList.toggle('hidden')"
                                                        class="text-xs font-semibold text-[#354A3D] hover:underline flex items-center gap-1">
                                                    <i class="fa-regular fa-star"></i> Đánh giá sản phẩm này
                                                </button>
                                                <form id="review-form-{{ $item->product_id }}" action="{{ route('my.orders.review', $order->id) }}" method="POST" class="hidden mt-3 bg-gray-50 rounded-xl p-4 space-y-3">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                    <div class="flex items-center gap-1">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <label class="cursor-pointer text-lg text-amber-400">
                                                                <input type="radio" name="rating" value="{{ $i }}" required class="hidden peer">
                                                                <i class="fa-regular fa-star peer-checked:hidden"></i>
                                                                <i class="fa-solid fa-star hidden peer-checked:inline"></i>
                                                            </label>
                                                        @endfor
                                                    </div>
                                                    <textarea name="comment" rows="2" placeholder="Cảm nhận của bạn về sản phẩm (không bắt buộc)..."
                                                              class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-[#354A3D]"></textarea>
                                                    <button type="submit" class="bg-[#354A3D] text-white text-xs font-semibold rounded-lg px-4 py-2 hover:bg-[#2A4435] transition-colors">
                                                        Gửi đánh giá
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <p class="font-semibold text-[#1F2937] whitespace-nowrap">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-5 border-t border-gray-100 flex justify-between items-center">
                        <span class="font-serif text-lg font-bold text-[#1F2937]">Tổng cộng</span>
                        <span class="font-serif text-xl font-bold text-[#354A3D]">{{ number_format($order->total_price, 0, ',', '.') }}đ</span>
                    </div>
                </div>
            </div>

            <!-- CỘT PHẢI -->
            <div class="lg:col-span-5 space-y-6">

                <!-- Thông tin giao hàng -->
                <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 sm:p-8">
                    <h2 class="font-serif text-lg font-bold text-[#1F2937] mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-[#354A3D]"></i> Thông tin giao hàng
                    </h2>
                    @if($order->shippingAddress)
                        <div class="space-y-1.5 text-sm">
                            <p class="font-semibold text-[#1F2937]">{{ $order->shippingAddress->full_name }}</p>
                            <p class="text-gray-500">{{ $order->shippingAddress->phone }}</p>
                            <p class="text-gray-500">
                                {{ $order->shippingAddress->address }}
                                @if($order->shippingAddress->detail), {{ $order->shippingAddress->detail }} @endif
                                @if($order->shippingAddress->city), {{ $order->shippingAddress->city }} @endif
                            </p>
                        </div>
                    @else
                        <p class="text-sm text-gray-400">Không có thông tin giao hàng.</p>
                    @endif
                </div>

                <!-- Phương thức thanh toán -->
                <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 sm:p-8">
                    <h2 class="font-serif text-lg font-bold text-[#1F2937] mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-credit-card text-[#354A3D]"></i> Thanh toán
                    </h2>
                    @forelse($order->payments as $payment)
                        <div class="flex justify-between items-center text-sm mb-2 last:mb-0">
                            <div>
                                <p class="font-medium text-[#1F2937]">{{ $paymentLabels[$payment->payment_method] ?? ($payment->payment_method ?: 'Chưa xác định') }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ $payment->status ? ucfirst($payment->status) : 'Chưa xác định trạng thái' }}
                                    @if($payment->paid_at) · {{ \Carbon\Carbon::parse($payment->paid_at)->format('H:i, d/m/Y') }} @endif
                                </p>
                            </div>
                            <span class="font-semibold text-[#354A3D]">{{ number_format($payment->amount, 0, ',', '.') }}đ</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400">Chưa có thông tin thanh toán.</p>
                    @endforelse
                </div>

                <!-- Hành động -->
                <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 sm:p-8 space-y-3">
                    <h2 class="font-serif text-lg font-bold text-[#1F2937] mb-2">Hành động</h2>

                    <form action="{{ route('my.orders.reorder', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-[#354A3D] text-white font-semibold rounded-xl py-3 hover:bg-[#2A4435] transition-colors flex items-center justify-center gap-2 text-sm">
                            <i class="fa-solid fa-rotate-right"></i> Đặt lại đơn hàng này
                        </button>
                    </form>

                    @if($cancellable)
                        <form action="{{ route('my.orders.cancel', $order->id) }}" method="POST"
                              onsubmit="return confirm('Bạn chắc chắn muốn hủy đơn hàng #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}?');">
                            @csrf
                            <button type="submit" class="w-full bg-white border border-red-200 text-red-600 font-semibold rounded-xl py-3 hover:bg-red-50 transition-colors flex items-center justify-center gap-2 text-sm">
                                <i class="fa-solid fa-ban"></i> Hủy đơn hàng
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
