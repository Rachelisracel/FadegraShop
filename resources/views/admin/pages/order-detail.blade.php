@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng #' . $order->id . ' — Admin FADEGRA')

@section('content')
<div class="min-h-screen bg-gray-50 py-10 px-6">
    <div class="max-w-6xl mx-auto">
        {{-- Nút quay lại --}}
        <a href="{{ route('orders.index') }}" class="inline-flex items-center text-green-700 hover:text-green-900 mb-6 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Quay lại danh sách đơn hàng
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Cột trái: Thông tin đơn hàng & sản phẩm --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Card trạng thái & cập nhật --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Đơn hàng #{{ $order->id }}</h2>
                            <p class="text-sm text-gray-500 mt-1">📅 {{ $order->created_at->format('H:i d/m/Y') }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm font-medium mt-2 sm:mt-0
                            @if($order->status == 'completed') bg-green-100 text-green-800
                            @elseif($order->status == 'shipping') bg-blue-100 text-blue-800
                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            @switch($order->status)
                                @case('pending') ⏳ Chờ xử lý @break
                                @case('processing') 🛠 Đang chuẩn bị @break
                                @case('shipping') 🚚 Đang giao @break
                                @case('completed') ✅ Hoàn thành @break
                                @case('cancelled') ❌ Đã hủy @break
                            @endswitch
                        </span>
                    </div>

                    {{-- Form cập nhật trạng thái --}}
                    @if(!in_array($order->status, ['completed', 'cancelled']))
                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="font-semibold text-gray-800 mb-3">🔄 Cập nhật trạng thái</h3>
                        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="space-y-3">
                            @csrf
                            @method('PUT')
                            <select name="status" class="w-full sm:w-auto rounded-lg border-gray-300 text-gray-900 px-3 py-2 focus:border-green-500 focus:ring-green-500">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Chờ xử lý</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>🛠 Đang chuẩn bị</option>
                                <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>🚚 Đang giao hàng</option>
                                <option value="completed">✅ Hoàn thành</option>
                                <option value="cancelled">❌ Hủy đơn</option>
                            </select>
                            <input type="text" name="note" placeholder="Ghi chú (tùy chọn)"
                                   class="w-full rounded-lg border-gray-300 text-sm px-3 py-2 focus:border-green-500 focus:ring-green-500">
                            <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition-colors">
                                Cập nhật
                            </button>
                        </form>
                    </div>
                    @endif
                </div>

                {{-- Danh sách sản phẩm --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4 text-lg">🛒 Sản phẩm đã đặt ({{ $order->orderItems->count() }})</h3>
                    <div class="space-y-4">
                        @forelse($order->orderItems as $item)
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
                            @php $firstImage = $item->product->images->first(); @endphp
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg overflow-hidden bg-white border flex-shrink-0">
                                @if($firstImage && $firstImage->image)
                                    <img src="{{ asset('images/' . $firstImage->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-2xl">🧋</div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900">{{ $item->product->name }}</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    Size: <strong>{{ $item->size->name ?? '--' }}</strong>
                                    @if($item->toppings->count())
                                        | Topping: <strong>{{ $item->toppings->pluck('name')->join(', ') }}</strong>
                                    @endif
                                </p>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-600">SL: {{ $item->quantity }}</span>
                                    <span class="font-semibold text-green-700">
                                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫
                                    </span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-center text-gray-500 py-8">Không có sản phẩm nào.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Lịch sử trạng thái --}}
                @if($order->statusHistory && $order->statusHistory->count())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">📜 Lịch sử trạng thái</h3>
                    <div class="space-y-3">
                        @foreach($order->statusHistory as $history)
                        <div class="flex items-start gap-3 text-sm">
                            <div class="w-2.5 h-2.5 mt-1.5 rounded-full bg-green-500 flex-shrink-0"></div>
                            <div>
                                <p class="text-gray-700">
                                    <strong>{{ optional($history->changedBy)->name ?? ($history->changed_by ? 'Quản trị viên' : 'Hệ thống') }}</strong>
                                    đã chuyển sang <em>"{{ \App\Models\Order::STATUS_LABELS[$history->status] ?? $history->status }}"</em>
                                </p>
                                @if($history->note)
                                    <p class="text-gray-500 text-xs mt-1">📝 {{ $history->note }}</p>
                                @endif
                                <p class="text-gray-400 text-xs">{{ $history->changed_at?->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Cột phải: Thông tin khách hàng & tổng tiền --}}
            <div class="space-y-6">
                {{-- Thông tin khách hàng --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">👤 Khách hàng</h3>
                    @if($order->user)
                    <div class="text-sm space-y-2">
                        <p><strong>Tên:</strong> {{ $order->user->name }}</p>
                        <p><strong>Email:</strong> {{ $order->user->email }}</p>
                        <p><strong>Điện thoại:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                    </div>
                    @else
                    <p class="text-gray-500 text-sm">Khách vãng lai</p>
                    @endif
                </div>

                {{-- Thông tin giao hàng --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">📦 Giao đến</h3>
                    @if($order->shippingAddress)
                    <div class="text-sm space-y-2">
                        <p><strong>{{ $order->shippingAddress->full_name }}</strong></p>
                        <p>📞 {{ $order->shippingAddress->phone }}</p>
                        <p>📍 {{ $order->shippingAddress->address }}</p>
                        @if($order->shippingAddress->city)
                            <p>{{ $order->shippingAddress->city }}</p>
                        @endif
                        @if($order->shippingAddress->detail)
                            <p class="text-gray-500 italic">📝 {{ $order->shippingAddress->detail }}</p>
                        @endif
                    </div>
                    @else
                    <p class="text-gray-500 text-sm">Không có thông tin giao hàng</p>
                    @endif
                </div>

                {{-- Tổng tiền --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-900 font-semibold text-lg">Tổng cộng</span>
                        <span class="text-2xl font-bold text-green-700">
                            {{ number_format($order->total_price, 0, ',', '.') }}₫
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Đã bao gồm phí vận chuyển</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection