<div class="w-full md:w-1/4">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky top-24">
        <ul class="flex flex-col space-y-2">
            <!-- Tài khoản của tôi -->
            <li>
                <a href="{{ url('/profile') }}"
                    class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-address-card text-lg w-6 text-center"></i>
                        <span>Tài khoản của tôi</span>
                    </div>
                </a>
            </li>

            <!-- Đơn hàng -->
            <li>
                <a href="{{ url('/orders') }}"
                    class="flex items-center justify-between px-4 py-3 rounded-xl {{ request()->is('orders') && !request()->is('orders/history*') ? 'bg-[#354A3D] text-white font-bold shadow-sm' : 'hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium' }} transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-cart-shopping text-lg w-6 text-center"></i>
                        <span>Đơn hàng</span>
                    </div>
                    @if(request()->is('orders') && !request()->is('orders/history*'))
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    @endif
                </a>
            </li>

            <!-- Lịch sử đơn hàng (Tự động Active khi đang ở trang history) -->
            <li>
                <a href="{{ url('/orders/history') }}"
                    class="flex items-center justify-between px-4 py-3 rounded-xl {{ request()->is('orders/history*') ? 'bg-[#354A3D] text-white font-bold shadow-sm' : 'hover:bg-gray-50 text-gray-600 hover:text-[#354A3D] font-medium' }} transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-clipboard-list text-lg w-6 text-center"></i>
                        <span>Lịch sử đơn hàng</span>
                    </div>
                    @if(request()->is('orders/history*'))
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    @endif
                </a>
            </li>

            <!-- Trung tâm trợ giúp -->
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

            <!-- Đăng xuất -->
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
