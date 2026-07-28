<!-- 1. HEADER / NAVBAR -->
    <header class="bg-forest sticky top-0 z-50 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="font-cinzel text-2xl font-bold tracking-widest text-white uppercase">
                FADEGRA
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center space-x-10 text-sm font-medium">
                <a href="{{ url('/#products') }}" class="text-white/90 hover:text-cream-accent transition-colors">Sản phẩm</a>
                <a href="{{ url('/menu') }}" class="text-white/90 hover:text-cream-accent transition-colors">Menu</a>
                <a href="{{ url('/#story') }}" class="text-white/90 hover:text-cream-accent transition-colors">Câu chuyện thương hiệu</a>
                <a href="{{ url('/#news') }}" class="text-white/90 hover:text-cream-accent transition-colors">Tin tức</a>
            </nav>

            <!-- Icons -->
            <div class="flex items-center space-x-6 text-white text-lg">
                @if(Auth::check())
                    <div class="relative group">
                        <button class="hover:text-cream-accent transition-colors text-sm font-medium flex items-center gap-2 py-1 focus:outline-none">
                            <i class="fa-regular fa-user"></i>
                            <span>Xin chào, {{ Auth::user()->name }}</span>
                            <i class="fa-solid fa-chevron-down text-[10px] opacity-70 transition-transform group-hover:rotate-180"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 top-full mt-2 w-52 bg-white text-gray-800 rounded-2xl shadow-xl border border-black/5 py-2 hidden group-hover:block group-focus-within:block z-50">
                            <a href="{{ route('client.orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold hover:bg-cream hover:text-forest transition">
                                <i class="fa-solid fa-receipt text-forest text-sm w-4"></i> Đơn hàng của tôi
                            </a>
                            @if(in_array(Auth::user()->roleRelation->name ?? '', ['admin', 'staff']))
                                <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold hover:bg-cream hover:text-forest transition border-t border-gray-100">
                                    <i class="fa-solid fa-gauge-high text-forest text-sm w-4"></i> Trang quản trị (Dashboard)
                                </a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" class="border-t border-gray-100">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 transition text-left">
                                    <i class="fa-solid fa-arrow-right-from-bracket text-sm w-4"></i> Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="hover:text-cream-accent transition-colors" title="Tài khoản">
                        <i class="fa-regular fa-user"></i>
                    </a>
                @endif
                <a href="{{ url('/cart') }}" class="hover:text-cream-accent transition-colors relative" title="Giỏ hàng">
                    <i class="fa-solid fa-bag-shopping"></i>
                </a>
                <form action="{{ url('/menu') }}" method="GET" class="relative hidden sm:block w-48">
                    <input type="text" name="q" placeholder="Tìm sản phẩm..." class="w-full bg-white/10 text-white placeholder-white/60 text-sm rounded-full py-1.5 pl-4 pr-8 focus:outline-none focus:bg-white/20 transition-colors border border-white/20">
                    <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-white/80 hover:text-white">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>