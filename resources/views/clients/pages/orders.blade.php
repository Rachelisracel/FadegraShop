@extends('layouts.client_home')

@section('content')
<div class="bg-cream min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        <!-- Breadcrumb (Đường dẫn nằm lệch bên trái, ngoài cột menu) -->
        <div class="text-sm text-gray-500 mb-6 font-medium">
            <a href="{{ url('/') }}" class="hover:text-[#354A3D] transition-colors">Trang chủ</a> 
            <span class="mx-2">/</span> 
            <span class="text-[#354A3D] font-bold">Đơn hàng của tôi</span>
        </div>

        <div class="flex flex-col md:flex-row gap-8">
            
            <!-- ================= CỘT TRÁI: SIDEBAR ================= -->
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky top-24">
                    <ul class="flex flex-col space-y-2">
                        <li>
                            <a href="{{ url('/profile') }}" 
                               class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-regular fa-address-card text-lg w-6 text-center"></i>
                                    <span>Tài khoản của tôi</span>
                                </div>
                            </a>
                        </li>
                        
                        <!-- ĐƠN HÀNG (Đang Active đúng chuẩn) -->
                        <li>
                            <a href="{{ url('/orders') }}" 
                               class="flex items-center justify-between px-4 py-3 rounded-xl bg-[#354A3D] text-white font-bold transition-colors shadow-sm">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-cart-shopping text-lg w-6 text-center"></i>
                                    <span>Đơn hàng</span>
                                </div>
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/orders/history') }}" 
                               class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-clipboard-list text-lg w-6 text-center"></i>
                                    <span>Lịch sử đơn hàng</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/help') }}" 
                               class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium transition-colors">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-headset text-lg w-6 text-center"></i>
                                    <span>Trung tâm trợ giúp</span>
                                </div>
                            </a>
                        </li>

                        <div class="border-t border-gray-100 my-2"></div>
                        
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="flex w-full items-center justify-between px-4 py-3 rounded-xl hover:bg-red-50 text-gray-600 hover:text-red-600 font-medium transition-colors text-left">
                                    <div class="flex items-center gap-3">
                                        <i class="fa-solid fa-arrow-right-from-bracket text-lg w-6 text-center"></i>
                                        <span>Đăng xuất</span>
                                    </div>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ================= CỘT PHẢI: TIÊU ĐỀ + NỘI DUNG ĐƠN HÀNG ================= -->
            <div class="w-full md:w-3/4">
                
                <!-- Tiêu đề nằm ở cột phải, thẳng hàng tuyệt đối với khung danh sách bên dưới -->
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
                    <div>
                        <h1 class="font-serif text-3xl font-bold text-[#1F2937]">Đơn hàng của tôi</h1>
                        <p class="text-gray-500 text-sm mt-1">Quản lý và theo dõi trạng thái các đơn hàng bạn đã đặt.</p>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] p-6 md:p-10 shadow-sm border border-gray-100 min-h-[500px]">
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border border-red-100">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Thanh Menu Tabs trạng thái -->
                    @php
                        $tabs = [
                            'all' => 'Tất cả',
                            'pending' => 'Chờ xác nhận',
                            'processing' => 'Đang chuẩn bị',
                            'shipping' => 'Đang giao hàng',
                            'completed' => 'Hoàn thành',
                            'cancelled' => 'Đã hủy'
                        ];
                    @endphp
                    <div class="flex overflow-x-auto border-b border-gray-100 mb-6 hide-scrollbar space-x-6">
                        @foreach($tabs as $key => $label)
                            <a href="{{ url('/orders?status='.$key) }}" 
                               class="relative whitespace-nowrap pb-4 font-semibold text-sm transition-colors {{ $status == $key ? 'text-[#354A3D] border-b-2 border-[#354A3D]' : 'text-gray-500 hover:text-[#354A3D]' }}">
                                {{ $label }}
                                @if($key != 'all' && isset($statusCounts[$key]) && $statusCounts[$key] > 0)
                                    <span class="absolute -top-2 -right-3 bg-red-500 text-white rounded-full px-1.5 py-0.5 text-[10px] leading-none">
                                        {{ $statusCounts[$key] }}
                                    </span>
                                @endif
                            </a>
                        @endforeach
                    </div>

                    <!-- DANH SÁCH ĐƠN HÀNG -->
                    <div class="space-y-6">
                        @forelse($orders as $order)
                            <div class="border border-gray-100 rounded-2xl p-5 hover:shadow-md transition-shadow bg-white">
                                <!-- Header -->
                                <div class="flex justify-between items-center border-b border-gray-50 pb-3 mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-800">Mã đơn: #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                                        <span class="text-gray-400 text-sm hidden sm:inline-block">| {{ $order->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    
                                    @php
                                        $statusColor = match($order->status) {
                                            'pending', 'processing' => 'text-orange-500',
                                            'shipping' => 'text-blue-500',
                                            'completed' => 'text-green-600',
                                            'cancelled' => 'text-red-500',
                                            default => 'text-gray-500'
                                        };
                                        $statusIcon = match($order->status) {
                                            'pending' => 'fa-clock',
                                            'processing' => 'fa-mug-hot',
                                            'shipping' => 'fa-truck-fast',
                                            'completed' => 'fa-check-circle',
                                            'cancelled' => 'fa-times-circle',
                                            default => 'fa-circle-info'
                                        };
                                    @endphp
                                    <div class="{{ $statusColor }} font-medium text-sm flex items-center gap-1">
                                        <i class="fa-solid {{ $statusIcon }}"></i> {{ $statusLabels[$order->status] ?? $order->status }}
                                    </div>
                                </div>
                                
                                <!-- Sản phẩm -->
                                @foreach($order->orderItems as $item)
                                <div class="flex items-start gap-4 mb-4">
                                    <img src="{{ optional($item->product->images->first())->image_url ?? asset('images/default-product.jpg') }}" alt="Product" class="w-20 h-20 object-cover rounded-xl border border-gray-100">
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-800 text-base">{{ $item->product->name ?? 'Sản phẩm FADEGRA' }}</h3>
                                        <div class="font-semibold text-sm text-gray-600 mt-2">Số lượng: x{{ $item->quantity }}</div>
                                    </div>
                                    <div class="text-right">
                                        <span class="font-bold text-[#354A3D] block">{{ number_format($item->price ?? 0, 0, ',', '.') }}đ</span>
                                    </div>
                                </div>
                                @endforeach

                                <!-- Footer chức năng -->
                                <div class="border-t border-gray-50 pt-4 flex flex-col sm:flex-row justify-between items-center gap-4">
                                    <div class="text-gray-600 text-sm">
                                        Thành tiền: <span class="font-bold text-lg text-[#354A3D]">{{ number_format($order->total_amount ?? 0, 0, ',', '.') }}đ</span>
                                    </div>
                                    <div class="flex flex-wrap gap-2 w-full sm:w-auto justify-end">
                                        
                                        @if(in_array($order->status, ['pending', 'processing']))
                                            <form action="{{ url('/orders/'.$order->id.'/cancel') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">
                                                @csrf
                                                <button type="submit" class="px-5 py-2 rounded-xl border border-gray-200 text-gray-600 font-medium hover:bg-red-50 hover:text-red-600 transition-colors text-sm">
                                                    Hủy đơn
                                                </button>
                                            </form>
                                        @endif

                                        @if($order->status === 'completed')
                                            <a href="{{ url('/orders/'.$order->id) }}" class="px-5 py-2 rounded-xl bg-orange-500 text-white font-medium hover:bg-orange-600 transition-colors text-sm shadow-sm">
                                                Đánh giá
                                            </a>
                                        @endif

                                        <form action="{{ url('/orders/'.$order->id.'/reorder') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-5 py-2 rounded-xl border border-gray-200 text-[#354A3D] font-medium hover:bg-gray-50 transition-colors text-sm">
                                                Mua lại
                                            </button>
                                        </form>

                                        <a href="{{ url('/orders/'.$order->id) }}" class="px-5 py-2 rounded-xl bg-[#354A3D] text-white font-medium hover:bg-[#2A4435] transition-colors text-sm shadow-sm">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16">
                                <div class="bg-gray-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-solid fa-box-open text-4xl text-gray-300"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-700">Chưa có đơn hàng nào</h3>
                                <p class="text-gray-500 mt-2 text-sm">Bạn chưa có đơn hàng nào ở trạng thái này.</p>
                                <a href="{{ url('/menu') }}" class="inline-block mt-6 px-8 py-3 bg-[#354A3D] text-white font-bold rounded-xl hover:bg-[#2A4435] transition-colors">
                                    Đi đến Menu
                                </a>
                            </div>
                        @endforelse
                    </div>

                    @if($orders->hasPages())
                        <div class="mt-8">
                            {{ $orders->links() }}
                        </div>
                    @endif

                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
.hide-scrollbar::-webkit-scrollbar { display: none; }
.hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection