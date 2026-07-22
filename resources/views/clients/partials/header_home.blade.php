<!-- 1. HEADER / NAVBAR -->
    <header class="bg-forest sticky top-0 z-50 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="font-serif text-2xl font-bold tracking-widest text-white uppercase">
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
                <a href="#" class="hover:text-cream-accent transition-colors" title="Tài khoản">
                    <i class="fa-regular fa-user"></i>
                </a>
                <a href="{{ url('/cart') }}" class="hover:text-cream-accent transition-colors relative" title="Giỏ hàng">
                    <i class="fa-solid fa-bag-shopping"></i>
                </a>
                <a href="#" class="hover:text-cream-accent transition-colors" title="Tìm kiếm">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </div>
        </div>
    </header>