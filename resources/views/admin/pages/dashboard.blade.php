@extends('layouts.admin')

@section('title', 'Dashboard — Admin FADEGRA')

@section('content')

@php
// Dữ liệu mẫu (Dummy Data) cho Đơn hàng mới nhất
$recentOrders = [
    ['id' => 'DH1004', 'customer' => 'Nguyễn Văn A', 'items' => 'Trà Sữa Truyền Thống (x2), Trà Đào (x1)', 'total' => '70.000đ', 'status' => 'pending', 'time' => '10 phút trước'],
    ['id' => 'DH1003', 'customer' => 'Trần Thị B', 'items' => 'Matcha Latte Oatside (x1)', 'total' => '28.000đ', 'status' => 'shipping', 'time' => '1 giờ trước'],
    ['id' => 'DH1002', 'customer' => 'Lê Hoàng C', 'items' => 'Sữa Tươi Trân Châu (x2)', 'total' => '60.000đ', 'status' => 'completed', 'time' => '3 giờ trước'],
    ['id' => 'DH1001', 'customer' => 'Phạm D', 'items' => 'Milo Dầm (x1), Hồng Trà (x1)', 'total' => '45.000đ', 'status' => 'cancelled', 'time' => 'Hôm qua'],
];

// Dữ liệu mẫu cho Sản phẩm bán chạy
$topProducts = [
    ['name' => 'Trà Sữa Truyền Thống', 'sales' => 1245, 'image' => 'hongtra.JPG'],
    ['name' => 'Matcha Latte Oatside', 'sales' => 980, 'image' => 'matchalatte.jpg'],
    ['name' => 'Trà Đào', 'sales' => 856, 'image' => 'tradao.jpg'],
    ['name' => 'Sữa Tươi Trân Châu', 'sales' => 640, 'image' => 'suatuoi.jpg'],
];
@endphp

<div class="bg-gray-50 min-h-screen p-6 sm:p-10 font-sans space-y-6">
    
    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tổng quan hệ thống</h1>
            <p class="text-sm text-gray-500 mt-1">Chào mừng bạn quay lại, đây là số liệu hôm nay.</p>
        </div>
        <div class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2.5 rounded-lg shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
            <span class="text-sm font-medium text-gray-700">Hôm nay, 23 Tháng 7</span>
        </div>
    </div>

    <!-- 1. THẺ THỐNG KÊ (STATS CARDS) -->
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Đơn hàng ngày</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($dailyOrders ?? 0) }}</h3>
            </div>
        </div>

        <!-- Đơn hàng tháng -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 group hover:shadow-md transition">
            <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center text-orange-500 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Đơn hàng tháng</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($monthlyOrders ?? 0) }}</h3>
            </div>
        </div>

    </div>

    <!-- 2. BIỂU ĐỒ (Mô phỏng bằng CSS) & SẢN PHẨM BÁN CHẠY -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Cột trái: Biểu đồ doanh thu (Chiếm 2 phần) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-800">Doanh thu 7 ngày qua</h2>
                <button class="text-sm text-[#354A3D] font-medium hover:underline">Xem chi tiết</button>
            </div>
            <!-- Biểu đồ cột CSS tĩnh -->
            <div class="h-64 flex items-end justify-between gap-2 sm:gap-6 pt-10 border-b border-gray-100 relative">
                <!-- Vạch ngang chia mức -->
                <div class="absolute w-full border-t border-dashed border-gray-200 top-0"></div>
                <div class="absolute w-full border-t border-dashed border-gray-200 top-1/2"></div>
                
                <!-- Các cột -->
                <div class="w-full flex flex-col items-center gap-2 z-10 group">
                    <div class="w-full bg-[#354A3D]/20 group-hover:bg-[#354A3D] transition-colors rounded-t-sm h-[40%] relative"><span class="absolute -top-6 left-1/2 -translate-x-1/2 text-xs font-bold text-gray-500 hidden group-hover:block">1.2M</span></div>
                    <span class="text-xs text-gray-500 font-medium">T2</span>
                </div>
                <div class="w-full flex flex-col items-center gap-2 z-10 group">
                    <div class="w-full bg-[#354A3D]/20 group-hover:bg-[#354A3D] transition-colors rounded-t-sm h-[60%] relative"><span class="absolute -top-6 left-1/2 -translate-x-1/2 text-xs font-bold text-gray-500 hidden group-hover:block">1.8M</span></div>
                    <span class="text-xs text-gray-500 font-medium">T3</span>
                </div>
                <div class="w-full flex flex-col items-center gap-2 z-10 group">
                    <div class="w-full bg-[#354A3D]/20 group-hover:bg-[#354A3D] transition-colors rounded-t-sm h-[30%] relative"><span class="absolute -top-6 left-1/2 -translate-x-1/2 text-xs font-bold text-gray-500 hidden group-hover:block">0.9M</span></div>
                    <span class="text-xs text-gray-500 font-medium">T4</span>
                </div>
                <div class="w-full flex flex-col items-center gap-2 z-10 group">
                    <div class="w-full bg-[#354A3D]/20 group-hover:bg-[#354A3D] transition-colors rounded-t-sm h-[80%] relative"><span class="absolute -top-6 left-1/2 -translate-x-1/2 text-xs font-bold text-gray-500 hidden group-hover:block">2.4M</span></div>
                    <span class="text-xs text-gray-500 font-medium">T5</span>
                </div>
                <div class="w-full flex flex-col items-center gap-2 z-10 group">
                    <div class="w-full bg-[#354A3D] rounded-t-sm h-[100%] shadow-lg relative"><span class="absolute -top-6 left-1/2 -translate-x-1/2 text-xs font-bold text-[#354A3D]">3.0M</span></div>
                    <span class="text-xs text-gray-800 font-bold">Hôm nay</span>
                </div>
                <div class="w-full flex flex-col items-center gap-2 z-10">
                    <div class="w-full bg-gray-100 rounded-t-sm h-[10%]"></div>
                    <span class="text-xs text-gray-400 font-medium">T7</span>
                </div>
                <div class="w-full flex flex-col items-center gap-2 z-10">
                    <div class="w-full bg-gray-100 rounded-t-sm h-[10%]"></div>
                    <span class="text-xs text-gray-400 font-medium">CN</span>
                </div>
            </div>
        </div>

        <!-- Cột phải: Top Sản phẩm bán chạy -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Top bán chạy (Tháng)</h2>
            <div class="space-y-5">
                @foreach($topProducts as $key => $product)
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                        <img src="{{ asset('images/' . $product['image']) }}" class="w-full h-full object-cover" alt="">
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-bold text-gray-800 truncate">{{ $product['name'] }}</h4>
                        <p class="text-xs text-gray-500 mt-0.5">{{ number_format($product['sales']) }} ly đã bán</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center font-bold text-[#354A3D] text-sm">
                        #{{ $key + 1 }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- 3. BẢNG ĐƠN HÀNG GẦN ĐÂY -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">Đơn hàng mới nhất</h2>
            <button class="text-sm bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium px-4 py-2 rounded-lg transition border border-gray-200">Xem tất cả</button>
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
                    @foreach($recentOrders as $order)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 text-sm font-bold text-gray-700">#{{ $order['id'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $order['customer'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-[200px] truncate">{{ $order['items'] }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#354A3D]">{{ $order['total'] }}</td>
                        <td class="px-6 py-4">
                            @if($order['status'] === 'pending')
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-yellow-700 bg-yellow-100 px-2.5 py-1 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span> Chờ xử lý
                                </span>
                            @elseif($order['status'] === 'shipping')
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-blue-700 bg-blue-100 px-2.5 py-1 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Đang giao
                                </span>
                            @elseif($order['status'] === 'completed')
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-green-700 bg-green-100 px-2.5 py-1 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Hoàn thành
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-red-700 bg-red-100 px-2.5 py-1 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Đã hủy
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-blue-500 hover:text-blue-700 font-medium text-sm hover:underline">Xem</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection