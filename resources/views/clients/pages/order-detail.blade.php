@extends('layouts.client_home')

@section('content')
<div class="min-h-screen bg-green-50 py-10 px-6">
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('orders.index') }}" class="inline-flex items-center text-green-700 hover:text-green-900 mb-6">
            ← Quay lại danh sách đơn hàng
        </a>

        <div class="bg-white rounded-2xl shadow-md border border-green-200 overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-green-100 to-green-50 px-6 py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div>
                    <h2 class="text-2xl font-bold text-green-900">Đơn hàng #{{ $order->id }}</h2>
                    <p class="text-sm text-gray-600 mt-1">📅 {{ $order->created_at->format('H:i d/m/Y') }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-sm font-medium mt-2 sm:mt-0
                    @if($order->status == 'completed') bg-green-200 text-green-800
                    @elseif($order->status == 'delivering') bg-yellow-100 text-yellow-800
                    @else bg-gray-200 text-gray-600 @endif">
                    @if($order->status == 'pending') Chờ xử lý
                    @elseif($order->status == 'delivering') Đang giao
                    @elseif($order->status == 'completed') Hoàn thành
                    @endif
                </span>
            </div>

            {{-- Địa chỉ --}}
            @if($order->shippingAddress)
            <div class="px-6 py-4 border-b border-green-100">
                <h3 class="font-semibold text-green-800 mb-2">📦 Giao đến</h3>
                <div class="text-sm text-gray-700 space-y-1">
                    <p><strong>{{ $order->shippingAddress->full_name }}</strong> – {{ $order->shippingAddress->phone }}</p>
                    <p>{{ $order->shippingAddress->address }}{{ $order->shippingAddress->city ? ', ' . $order->shippingAddress->city : '' }}</p>
                    @if($order->shippingAddress->detail)
                        <p class="text-gray-500 italic">📝 {{ $order->shippingAddress->detail }}</p>
                    @endif
                </div>
            </div>
            @endif

            {{-- Danh sách món --}}
            <div class="px-6 py-5">
                <h3 class="font-semibold text-green-800 mb-4 flex items-center">
                    <span class="text-lg mr-2">🍵</span> Sản phẩm đã đặt
                </h3>

                <div class="space-y-4">
                    @forelse($order->items as $item)
                    <div class="flex items-start space-x-4 p-4 bg-green-50/50 rounded-xl border border-green-100">
                        {{-- Ảnh --}}
                            <div class="flex-shrink-0 w-16 h-16 sm:w-20 sm:h-20 rounded-lg overflow-hidden bg-white border border-green-200">
                                @php
                                    $firstImage = $item->product->images->first();
                                @endphp
                                @if($firstImage && $firstImage->image)
                                    <img src="{{ asset('images/' . $firstImage->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-green-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </div>

                        {{-- Thông tin --}}
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-green-900 truncate">{{ $item->product->name ?? 'Sản phẩm không tồn tại' }}</h4>
                            <div class="text-xs text-gray-600 mt-1 space-x-2">
                                <span>Size: {{ $item->size->name ?? '--' }}</span>
                                @if($item->toppings->count())
                                    <span>|</span>
                                    <span>Topping: {{ $item->toppings->pluck('name')->join(', ') }}</span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-sm text-gray-600">SL: {{ $item->quantity }}</span>
                                <span class="font-semibold text-green-800">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-6 text-gray-500">Không có sản phẩm nào.</div>
                    @endforelse
                </div>
            </div>

            {{-- Tổng cộng --}}
            <div class="px-6 py-4 bg-green-50 border-t border-green-200 flex justify-between items-center">
                <span class="text-green-900 font-semibold">Tổng cộng (đã bao gồm phí ship)</span>
                <span class="text-xl font-bold text-green-800">{{ number_format($order->total_price, 0, ',', '.') }}₫</span>
            </div>
        </div>
    </div>
</div>
{{-- Thêm vào trước @endsection --}}
@if(in_array($order->status, ['completed', 'cancelled']))
<div class="px-6 py-4 bg-red-50 border-t border-red-200 flex justify-end">
    <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
          onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này? Hành động này không thể hoàn tác.')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            Xóa đơn hàng
        </button>
    </form>
</div>
@endif
@endsection