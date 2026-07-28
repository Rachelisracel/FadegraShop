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
                {{-- 1. Tên người dùng --}}
                <a href="#" class="hover:text-cream-accent transition-colors text-sm font-medium" title="Tài khoản">
                    Xin chào, {{ Auth::user()->name }}
                </a>

                {{-- 2. Đơn hàng của tôi (dành cho mọi tài khoản) --}}
                    @if(in_array(Auth::user()->role ?? '', ['admin', 'staff']))
                        <a href="{{ route('admin.orders.index') }}" class="hover:text-cream-accent transition-colors text-sm font-medium" title="Quản lý đơn hàng">
                            <i class="fa-solid fa-clipboard-list mr-1"></i> Quản lý đơn
                        </a>
                    @else
                        <a href="{{ route('orders.index') }}" class="hover:text-cream-accent transition-colors text-sm font-medium" title="Đơn hàng của tôi">
                            <i class="fa-solid fa-receipt mr-1"></i> Đơn hàng
                        </a>
                    @endif

                {{-- 3. Dashboard chỉ hiển thị cho admin/staff --}}
                @if(in_array(Auth::user()->role->name ?? '', ['admin', 'staff']))
                    <a href="{{ url('/admin/dashboard') }}" 
                       class="bg-cream-accent/20 hover:bg-cream-accent/40 text-cream-accent border border-cream-accent/30 px-3 py-1 rounded-full text-xs font-bold transition-colors" 
                       title="Quản trị">
                        <i class="fa-solid fa-gauge-high mr-1"></i> Dashboard
                    </a>
                @endif

                {{-- 4. Đăng xuất --}}
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-cream-accent transition-colors text-sm" title="Đăng xuất">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </form>
            @else
                {{-- Chưa đăng nhập: icon user + giỏ hàng + tìm kiếm --}}
                <a href="{{ url('/login') }}" class="hover:text-cream-accent transition-colors" title="Tài khoản">
                    <i class="fa-regular fa-user"></i>
                </a>
            @endif

            {{-- Giỏ hàng (luôn hiển thị) --}}
            <a href="{{ url('/cart') }}" class="hover:text-cream-accent transition-colors relative" title="Giỏ hàng">
                <i class="fa-solid fa-bag-shopping"></i>
            </a>

            {{-- Tìm kiếm --}}
            <form action="{{ url('/menu') }}" method="GET" class="relative hidden sm:block w-48">
                <input type="text" name="q" placeholder="Tìm sản phẩm..." 
                       class="w-full bg-white/10 text-white placeholder-white/60 text-sm rounded-full py-1.5 pl-4 pr-8 focus:outline-none focus:bg-white/20 transition-colors border border-white/20">
                <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-white/80 hover:text-white">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </button>
            </form>
        </div>
    </div>
</header>