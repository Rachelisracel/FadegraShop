@extends('layouts.admin')

@section('title', 'Dashboard — Admin FADEGRA')

@section('content')

<div class="bg-gray-50 min-h-screen p-6 sm:p-10 font-sans space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tổng quan hệ thống</h1>
            <p class="text-sm text-gray-500 mt-1">Chào mừng bạn quay lại, đây là số liệu hôm nay.</p>
        </div>
        <div class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2.5 rounded-lg shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
            <span class="text-sm font-medium text-gray-700">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
        </div>
    </div>

    <!-- 1. THẺ THỐNG KÊ (STATS CARDS) - DATA THẬT -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Doanh thu ngày -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition">
            <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-green-600 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Doanh thu ngày</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($dailyRevenue ?? 0, 0, ',', '.') }}đ</h3>
            </div>
        </div>

        <!-- Doanh thu tháng -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition">
            <div class="w-14 h-14 rounded-full bg-purple-50 flex items-center justify-center text-purple-600 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Doanh thu tháng</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}đ</h3>
            </div>
        </div>

        <!-- Đơn hàng ngày -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition">
            <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A4.5 4.5 0 015.513 7.5h12.974c1.576 0 2.97.836 3.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Đơn hàng ngày</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($dailyOrders ?? 0) }}</h3>
            </div>
        </div>

        <!-- Đơn hàng tháng -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition">
            <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center text-orange-500 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A4.5 4.5 0 015.513 7.5h12.974c1.576 0 2.97.836 3.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Đơn hàng tháng</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($monthlyOrders ?? 0) }}</h3>
            </div>
        </div>

    </div>

    <!-- 2. BIỂU ĐỒ DOANH THU 7 NGÀY & TOP SẢN PHẨM BÁN CHẠY -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Cột trái: Biểu đồ doanh thu 7 ngày qua (data thật) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-800">Doanh thu 7 ngày qua</h2>
                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::now()->subDays(6)->format('d/m') }} - {{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
            </div>

            @php
                $chartMax = max($chartData['values'] ?? [0]) ?: 1;
                $chartValues = $chartData['values'] ?? [0, 0, 0, 0, 0, 0, 0];
                $chartLabels = $chartData['labels'] ?? ['', '', '', '', '', '', ''];
                $chartRevenue = $chartData['revenue'] ?? [0, 0, 0, 0, 0, 0, 0];
            @endphp

            <div class="h-64 flex items-end justify-between gap-2 sm:gap-6 pt-10 border-b border-gray-100 relative">
                <div class="absolute w-full border-t border-dashed border-gray-200 top-0"></div>
                <div class="absolute w-full border-t border-dashed border-gray-200 top-1/2"></div>

                @foreach($chartValues as $index => $height)
                    @php
                        $isToday = $index === 6;
                        $hPercent = $height > 0 ? max(($height / $chartMax) * 100, 5) : 5;
                        $revenueText = $chartRevenue[$index] > 0 ? number_format($chartRevenue[$index] / 1000, 1) . 'K' : '0';
                    @endphp
                    <div class="w-full flex flex-col items-center gap-2 z-10 group">
                        <div class="w-full {{ $isToday ? 'bg-[#354A3D]' : 'bg-[#354A3D]/20 group-hover:bg-[#354A3D]' }} transition-colors rounded-t-sm relative" style="height: {{ $hPercent }}%">
                            <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-xs font-bold {{ $isToday ? 'text-[#354A3D]' : 'text-gray-500' }}">{{ $revenueText }}</span>
                        </div>
                        <span class="text-xs {{ $isToday ? 'text-gray-800 font-bold' : 'text-gray-500 font-medium' }}">{{ $chartLabels[$index] ?? '' }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Cột phải: Top Sản phẩm bán chạy (data thật) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Top bán chạy (Tháng)</h2>
            <div class="space-y-5">
                @forelse($topProducts ?? [] as $key => $product)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                            @if(!empty($product->image))
                                <img src="{{ asset('images/' . $product->image) }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-2xl">🧋</div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-gray-800 truncate">{{ $product->name }}</h4>
                            <p class="text-xs text-gray-500 mt-0.5">{{ number_format($product->total_sold) }} ly đã bán</p>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center font-bold text-[#354A3D] text-sm">
                            #{{ $key + 1 }}
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-6">Chưa có dữ liệu bán hàng.</p>
                @endforelse
            </div>
        </div>

    </div>

    <!-- 3. BẢNG ĐƠN HÀNG GẦN ĐÂY (data thật) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">Đơn hàng mới nhất</h2>
            <a href="{{ route('orders.index') }}" class="text-sm bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium px-4 py-2 rounded-lg transition border border-gray-200">Xem tất cả</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4 font-semibold">Mã ĐH</th>
                        <th class="px-6 py-4 font-semibold">Khách hàng</th>
                        <th class="px-6 py-4 font-semibold">Sản phẩm</th>
                        <th class="px-6 py-4 font-semibold">Tổng tiền</th>
                        <th class="px-6 py-4 font-semibold">Trạng thái</th>
                        <th class="px-6 py-4 font-semibold text-right">Chi tiết</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentOrders ?? [] as $order)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 text-sm font-bold text-gray-700">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $order->user->name ?? 'Khách vãng lai' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-[200px] truncate">
                                @forelse($order->orderItems->take(2) as $item)
                                    {{ $item->product->name ?? 'Sản phẩm' }} (x{{ $item->quantity }})@if(!$loop->last), @endif
                                @empty
                                    —
                                @endforelse
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-[#354A3D]">{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClass = match($order->status) {
                                        'pending' => 'text-yellow-700 bg-yellow-100',
                                        'processing' => 'text-blue-700 bg-blue-100',
                                        'shipping' => 'text-purple-700 bg-purple-100',
                                        'completed' => 'text-green-700 bg-green-100',
                                        'cancelled' => 'text-red-700 bg-red-100',
                                        default => 'text-gray-700 bg-gray-100',
                                    };
                                    $statusLabel = match($order->status) {
                                        'pending' => 'Chờ xử lý',
                                        'processing' => 'Đang chuẩn bị',
                                        'shipping' => 'Đang giao',
                                        'completed' => 'Hoàn thành',
                                        'cancelled' => 'Đã hủy',
                                        default => 'Không xác định',
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium {{ $statusClass }} px-2.5 py-1 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span> {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('orders.show', $order->id) }}" class="text-blue-500 hover:text-blue-700 font-medium text-sm hover:underline">Xem</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Chưa có đơn hàng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection