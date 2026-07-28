@extends('layouts.admin')

@section('title', 'Quản lý Đơn hàng — Admin FADEGRA')

@section('content')
<div class="bg-gray-50 min-h-screen p-6 sm:p-10 font-sans">
    
    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Quản lý Đơn hàng</h1>
            <p class="text-sm text-gray-500 mt-1">Theo dõi và cập nhật trạng thái đơn đặt hàng.</p>
        </div>
    </div>

    <!-- THÔNG BÁO -->
    @if(session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- TÌM KIẾM & LỌC -->
    <form action="{{ route('orders.index') }}" method="GET" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6 flex flex-col sm:flex-row gap-4 justify-between items-center">
        <div class="relative w-full sm:w-96">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm mã đơn hoặc tên khách..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#354A3D] focus:ring-1 focus:ring-[#354A3D] transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
        </div>
        <div class="flex gap-3 w-full sm:w-auto">
            <select name="status" class="bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg px-4 py-2.5 focus:outline-none focus:border-[#354A3D] w-full sm:w-auto">
                <option value="">Tất cả trạng thái</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang chuẩn bị</option>
                <option value="shipping" {{ request('status') == 'shipping' ? 'selected' : '' }}>Đang giao hàng</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
            <button type="submit" class="bg-gray-100 text-gray-700 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition">Lọc</button>
        </div>
    </form>

    <!-- DATA TABLE -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4 font-semibold">Mã Đơn</th>
                        <th class="px-6 py-4 font-semibold">Khách Hàng</th>
                        <th class="px-6 py-4 font-semibold">Tổng Tiền</th>
                        <th class="px-6 py-4 font-semibold">Trạng Thái</th>
                        <th class="px-6 py-4 font-semibold">Ngày Đặt</th>
                        <th class="px-6 py-4 font-semibold text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 text-sm font-bold text-gray-800">#{{ $order->id }}</td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-gray-800">{{ $order->user->name ?? 'Khách vãng lai' }}</p>
                            <p class="text-xs text-gray-500">{{ $order->user->phone ?? 'Không có SĐT' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-[#354A3D]">
                            {{ number_format($order->total_price, 0, ',', '.') }}đ
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusBadge = [
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'processing' => 'bg-blue-100 text-blue-700',
                                    'shipping' => 'bg-purple-100 text-purple-700',
                                    'completed' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-700'
                                ];
                                $statusLabel = [
                                    'pending' => 'Chờ xác nhận',
                                    'processing' => 'Đang chuẩn bị',
                                    'shipping' => 'Đang giao',
                                    'completed' => 'Hoàn thành',
                                    'cancelled' => 'Đã hủy'
                                ];
                                $badgeClass = $statusBadge[$order->status] ?? 'bg-gray-100 text-gray-600';
                                $label = $statusLabel[$order->status] ?? 'Không xác định';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full {{ $badgeClass }}">
                                {{ $label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <!-- Nút Xem/Sửa Trạng thái -->
                            <button onclick='openOrderModal(@json($order))' class="text-blue-500 hover:text-blue-700 hover:bg-blue-50 px-3 py-1.5 rounded-lg text-sm font-medium transition" title="Xem">
                                Chi tiết
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Không tìm thấy đơn hàng nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Phân trang -->
        @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
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
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Trạng thái hiện tại</label>
                    <select id="oStatus" name="status" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#354A3D] focus:bg-white transition">
                        <option value="pending">Chờ xác nhận</option>
                        <option value="processing">Đang chuẩn bị</option>
                        <option value="shipping">Đang giao hàng</option>
                        <option value="completed">Hoàn thành</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeOrderModal()" class="px-5 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 transition">Đóng</button>
                <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-medium text-white bg-[#354A3D] hover:bg-[#2A4435] shadow-sm transition">Cập nhật trạng thái</button>
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
