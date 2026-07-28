@extends('layouts.client_home') {{-- hoặc layout bạn dùng --}}

@section('content')
<div class="min-h-screen bg-green-50 py-10 px-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-green-900 mb-8">🍵 Đơn hàng của tôi</h1>

        @if($orders->count())
            <div class="space-y-4">
                @foreach($orders as $order)
                <div class="bg-white rounded-xl shadow-sm border border-green-200 p-5 flex flex-col sm:flex-row sm:items-center justify-between">
                    <div class="flex-1">
                        <h2 class="font-semibold text-green-900 text-lg">Đơn #{{ $order->id }}</h2>
                        <p class="text-sm text-gray-600">
                            📅 {{ $order->created_at->format('d/m/Y H:i') }}
                            @if($order->shippingAddress)
                                – {{ $order->shippingAddress->full_name }}
                            @endif
                        </p>
                    </div>
                    <div class="text-right mt-3 sm:mt-0">
                        <p class="text-xl font-bold text-green-800">
                            {{ number_format($order->total_price, 0, ',', '.') }}₫
                        </p>
                        <span class="inline-block mt-1 px-2 py-1 text-xs font-medium rounded-full 
                            @if($order->status == 'completed') bg-green-200 text-green-800
                            @elseif($order->status == 'delivering') bg-yellow-100 text-yellow-800
                            @else bg-gray-200 text-gray-600 @endif">
                            @if($order->status == 'pending') Chờ xử lý
                            @elseif($order->status == 'delivering') Đang giao
                            @elseif($order->status == 'completed') Hoàn thành
                            @endif
                        </span>
                    </div>
                    <div class="sm:ml-6 mt-3 sm:mt-0">
                        <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center text-sm bg-green-100 hover:bg-green-200 text-green-800 px-3 py-1.5 rounded-lg">
                            🔍 Xem chi tiết
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $orders->links() }}
        @else
            <div class="text-center py-16 text-gray-500">
                <p class="text-5xl mb-4">🍃</p>
                <p>Bạn chưa có đơn hàng nào.</p>
                <a href="{{ url('/menu') }}" class="mt-4 inline-block text-green-700 underline">Đặt món ngay</a>
            </div>
        @endif
    </div>
</div>
@endsection