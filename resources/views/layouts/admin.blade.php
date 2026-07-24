<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Quản trị hệ thống — FADEGRA')</title>

    <!-- Cài đặt Font chữ đồng bộ với giao diện -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Playfair+Display:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Cấu hình Font cho Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                        cinzel: ['"Cinzel Decorative"', 'serif'],
                    },
                    colors: {
                        fadegra: {
                            main: '#354A3D',
                            hover: '#2A4435',
                            accent: '#F5A623',
                            bg: '#F8F6F2',
                            light: '#4A6B55',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom scrollbar cho sidebar */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.3); }
        
        /* Animation cho sidebar items */
        .nav-item { position: relative; overflow: hidden; }
        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: #F5A623;
            border-radius: 0 4px 4px 0;
            transition: height 0.3s ease;
        }
        .nav-item.active::before,
        .nav-item:hover::before {
            height: 60%;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex h-screen overflow-hidden">

    <!-- OVERLAY CHO MOBILE -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity opacity-0"></div>

    <!-- ═══════════════════════════════════════════════════════════ -->
    <!-- 1. SIDEBAR (THANH MENU BÊN TRÁI)                          -->
    <!-- ═══════════════════════════════════════════════════════════ -->
    <aside id="sidebar" class="bg-gradient-to-b from-fadegra-main to-[#1E3228] w-64 h-full flex flex-col transition-transform duration-300 fixed lg:relative z-50 -translate-x-full lg:translate-x-0 shadow-2xl lg:shadow-none">
        
        <!-- Logo khu vực quản trị -->
        <div class="h-16 flex items-center justify-between px-6 border-b border-white/10 shrink-0">
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-2.5">
                <!--<div class="w-8 h-8 bg-fadegra-accent rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-sm">F</span>
                </div> -->
                <span class="text-white font-cinzel text-lg font-bold tracking-wider">Fadegra</span>
            </a>
            <!-- Nút đóng Sidebar trên mobile -->
            <button onclick="toggleSidebar()" class="lg:hidden text-white/70 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <!-- Thông tin user nhỏ -->
        <div class="px-5 py-4 border-b border-white/5">
            <div class="flex items-center gap-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=F5A623&color=fff&bold=true&size=80" 
                     alt="Avatar" class="w-10 h-10 rounded-full ring-2 ring-fadegra-accent/50">
                <div class="min-w-0">
                    <p class="text-white text-sm font-bold truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-white/50 text-[11px] font-medium capitalize">{{ Auth::user()->roleRelation->name ?? 'admin' }}</p>
                </div>
            </div>
        </div>

        <!-- Các Menu Chức Năng -->
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 sidebar-scroll">
            <p class="px-3 text-[10px] font-bold tracking-wider text-white/30 uppercase mb-2 mt-2">Tổng quan</p>
            
            <a href="{{ url('/admin/dashboard') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl {{ request()->is('admin/dashboard*') ? 'active bg-white/10 text-white shadow-inner' : 'text-white/60 hover:text-white hover:bg-white/5' }} transition group">
                <div class="w-9 h-9 rounded-lg {{ request()->is('admin/dashboard*') ? 'bg-fadegra-accent text-white' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }} flex items-center justify-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                </div>
                <span class="font-medium text-sm">Dashboard</span>
            </a>

            <p class="px-3 text-[10px] font-bold tracking-wider text-white/30 uppercase mb-2 mt-5">Bán hàng</p>
            
            <a href="{{ route('orders.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('orders.*') ? 'active bg-white/10 text-white shadow-inner' : 'text-white/60 hover:text-white hover:bg-white/5' }} transition group">
                <div class="w-9 h-9 rounded-lg {{ request()->routeIs('orders.*') ? 'bg-fadegra-accent text-white' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }} flex items-center justify-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                </div>
                <span class="font-medium text-sm">Đơn hàng</span>
                <span class="ml-auto bg-red-500/90 text-white text-[10px] font-bold px-2 py-0.5 rounded-full animate-pulse">Mới</span>
            </a>

            <a href="{{ route('products.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('products.*') ? 'active bg-white/10 text-white shadow-inner' : 'text-white/60 hover:text-white hover:bg-white/5' }} transition group">
                <div class="w-9 h-9 rounded-lg {{ request()->routeIs('products.*') ? 'bg-fadegra-accent text-white' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }} flex items-center justify-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg>
                </div>
                <span class="font-medium text-sm">Sản phẩm & Menu</span>
            </a>

            <p class="px-3 text-[10px] font-bold tracking-wider text-white/30 uppercase mb-2 mt-5">Quản trị</p>
            
            <a href="{{ route('users.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('users.*') ? 'active bg-white/10 text-white shadow-inner' : 'text-white/60 hover:text-white hover:bg-white/5' }} transition group">
                <div class="w-9 h-9 rounded-lg {{ request()->routeIs('users.*') ? 'bg-fadegra-accent text-white' : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white' }} flex items-center justify-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                </div>
                <span class="font-medium text-sm">Quản lý Người dùng</span>
            </a>

            <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/60 hover:text-white hover:bg-white/5 transition group">
                <div class="w-9 h-9 rounded-lg bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white flex items-center justify-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
                <span class="font-medium text-sm">Cài đặt hệ thống</span>
            </a>
        </nav>

        <!-- Quay lại trang chủ & Đăng xuất -->
        <div class="p-3 border-t border-white/10 shrink-0 space-y-1">
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-3 py-2 text-white/50 hover:text-white hover:bg-white/5 rounded-xl transition text-sm">
                <i class="fa-solid fa-house w-5 text-center"></i>
                <span class="font-medium">Về trang chủ</span>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 text-red-400 hover:text-red-300 hover:bg-red-400/10 rounded-xl transition text-sm">
                    <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i>
                    <span class="font-medium">Đăng xuất</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ═══════════════════════════════════════════════════════════ -->
    <!-- 2. KHU VỰC NỘI DUNG CHÍNH (MAIN CONTENT)                 -->
    <!-- ═══════════════════════════════════════════════════════════ -->
    <div class="flex-1 flex flex-col h-full overflow-hidden relative w-full">
        
        <!-- TOPBAR -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 z-30 shrink-0">
            
            <!-- Trái: Nút Menu Mobile & Breadcrumb -->
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-500 hover:text-fadegra-main p-1 rounded-md hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" /></svg>
                </button>
                <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500">
                    <span class="font-medium text-gray-400">Admin</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                    <span class="font-semibold text-gray-700">@yield('page_title', 'Dashboard')</span>
                </div>
            </div>

            <!-- Phải: Thông báo & Hồ sơ -->
            <div class="flex items-center gap-3 sm:gap-4">
                <!-- Nút chuông thông báo -->
                <button class="relative text-gray-400 hover:text-fadegra-main p-2 rounded-lg hover:bg-gray-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                </button>

                <div class="h-6 w-px bg-gray-200 hidden sm:block"></div>

                <!-- User Profile -->
                <div class="flex items-center gap-3 cursor-pointer p-1.5 rounded-xl hover:bg-gray-50 border border-transparent hover:border-gray-200 transition">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=354A3D&color=fff&bold=true&size=64" alt="Admin" class="w-8 h-8 rounded-full shadow-sm ring-2 ring-gray-100">
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-[10px] font-medium text-fadegra-accent uppercase tracking-wide">{{ Auth::user()->roleRelation->name ?? 'Quản trị viên' }}</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- NƠI CHỨA CÁC TRANG CON BÊN TRONG -->
        <main class="flex-1 overflow-y-auto w-full relative">
            @yield('content')
        </main>
        
    </div>

    <!-- Script điều khiển Sidebar trên Mobile -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                }, 10);
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');
                setTimeout(() => {
                    backdrop.classList.add('hidden');
                }, 300);
                document.body.style.overflow = 'auto';
            }
        }
    </script>

    @yield('scripts')
</body>
</html>