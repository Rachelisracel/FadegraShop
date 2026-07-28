@extends('layouts.admin')

@section('title', 'Quản lý Đơn hàng — Admin FADEGRA')

@section('content')
<div class="bg-gray-50 min-h-screen p-6 sm:p-10 font-sans">
    
    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">📋 Quản lý Đơn hàng</h1>
            <p class="text-sm text-gray-500 mt-1">Theo dõi và cập nhật trạng thái đơn đặt hàng. Tổng: {{ $orders->total() }} đơn</p>
        </div>
    </div>

    <!-- THÔNG BÁO -->
    @if(session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
        {{ $errors->first() }}
    </div>
    @endif

    <!-- FILTER TABS -->
    <div class="flex gap-2 mb-6 flex-wrap">
        <a href="{{ route('admin.orders.index') }}" 
           class="px-4 py-2 rounded-full text-sm font-medium {{ !request('status') ? 'bg-green-600 text-white' : 'bg-white text-gray-600 border hover:bg-gray-50' }}">
            Tất cả
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" 
           class="px-4 py-2 rounded-full text-sm font-medium {{ request('status') == 'pending' ? 'bg-yellow-500 text-white' : 'bg-white text-gray-600 border hover:bg-gray-50' }}">
            ⏳ Chờ xử lý
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'delivering']) }}" 
           class="px-4 py-2 rounded-full text-sm font-medium {{ request('status') == 'delivering' ? 'bg-blue-500 text-white' : 'bg-white text-gray-600 border hover:bg-gray-50' }}">
            🚚 Đang giao
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" 
           class="px-4 py-2 rounded-full text-sm font-medium {{ request('status') == 'completed' ? 'bg-green-500 text-white' : 'bg-white text-gray-600 border hover:bg-gray-50' }}">
            ✅ Hoàn thành
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" 
           class="px-4 py-2 rounded-full text-sm font-medium {{ request('status') == 'cancelled' ? 'bg-red-500 text-white' : 'bg-white text-gray-600 border hover:bg-gray-50' }}">
            ❌ Đã hủy
        </a>
    </div>

    <!-- DANH SÁCH ĐƠN HÀNG -->
    <div class="space-y-4">
        @forelse($orders as $order)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h2 class="font-semibold text-gray-900 text-lg">
                            #{{ $order->id }}
                        </h2>
                        <span class="px-2.5 py-1 text-xs font-medium rounded-full 
                            @if($order->status == 'completed') bg-green-100 text-green-800
                            @elseif($order->status == 'delivering') bg-blue-100 text-blue-800
                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            @switch($order->status)
                                @case('pending') Chờ xử lý @break
                                @case('delivering') Đang giao @break
                                @case('completed') Hoàn thành @break
                                @case('cancelled') Đã hủy @break
                            @endswitch
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-sm">
                        <div>
                            <span class="text-gray-500">Khách hàng:</span>
                            <span class="font-medium">{{ $order->user->name ?? $order->shippingAddress->full_name ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Địa chỉ:</span>
                            <span class="font-medium truncate block max-w-[250px]">{{ $order->shippingAddress->address ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Ngày đặt:</span>
                            <span class="font-medium">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-2xl font-bold text-green-800">
                            {{ number_format($order->total_price, 0, ',', '.') }}₫
                        </p>
                        <p class="text-xs text-gray-500">{{ $order->items->count() }} sản phẩm</p>
                    </div>
                    
                    <div class="flex gap-2">
                        {{-- Nút xem chi tiết --}}
                        <a href="{{ route('admin.orders.show', $order->id) }}" 
                           class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition-colors"
                           title="Xem chi tiết">
                            👁️
                        </a>
                        
                        {{-- Nút mở modal cập nhật trạng thái --}}
                        <button onclick='openOrderModal(@json($order))' 
                                class="px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg text-sm font-medium transition-colors"
                                title="Cập nhật trạng thái">
                            ✏️
                        </button>

                        {{-- Nút nhanh chuyển trạng thái --}}
                        @if($order->status == 'pending')
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="delivering">
                            <button type="submit" 
                                    class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-medium transition-colors"
                                    title="Bắt đầu giao hàng">
                                🚚
                            </button>
                        </form>
                        @endif

                        @if($order->status == 'delivering')
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" 
                                    class="px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm font-medium transition-colors"
                                    onclick="return confirm('Xác nhận đơn hàng đã giao thành công?')"
                                    title="Hoàn thành đơn hàng">
                                ✅
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-16 text-gray-500 bg-white rounded-xl">
            <p class="text-5xl mb-4">📭</p>
            <p>Không có đơn hàng nào.</p>
        </div>
        @endforelse
    </div>

    {{-- Phân trang --}}
    @if($orders->hasPages())
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
    @endif
</div>

<!-- MODAL CẬP NHẬT TRẠNG THÁI -->
<div id="orderModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeOrderModal()"></div>
    
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl relative z-10 p-6 sm:p-8 animate-[slideDown_0.3s_ease-out]">
        <button onclick="closeOrderModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 p-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>

        <h2 class="text-xl font-bold text-gray-800 mb-2">Cập nhật trạng thái đơn</h2>
        <p class="text-sm text-gray-500 mb-6">Mã đơn: <span id="modalOrderId" class="font-bold text-gray-700"></span></p>

        <form action="" method="POST" id="orderForm">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Trạng thái mới</label>
                    <select id="oStatus" name="status" required 
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
                        <option value="pending">⏳ Chờ xử lý</option>
                        <option value="delivering">🚚 Đang giao hàng</option>
                        <option value="completed">✅ Hoàn thành</option>
                        <option value="cancelled">❌ Hủy đơn</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Ghi chú (tùy chọn)</label>
                    <textarea name="note" rows="3" 
                              class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition"
                              placeholder="Nhập ghi chú cho lần cập nhật này..."></textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeOrderModal()" 
                        class="px-5 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 transition">
                    Đóng
                </button>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 shadow-sm transition">
                    Cập nhật trạng thái
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes slideDown {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>

<script>
    function openOrderModal(order) {
        const modal = document.getElementById('orderModal');
        const form = document.getElementById('orderForm');
        
        document.getElementById('modalOrderId').innerText = '#' + order.id;
        document.getElementById('oStatus').value = order.status;
        form.action = `/admin/orders/${order.id}`;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeOrderModal() {
        const modal = document.getElementById('orderModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection