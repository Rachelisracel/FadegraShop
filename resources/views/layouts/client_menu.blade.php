<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FADEGRA — Trà mộc hồn cốt Việt Nam')</title>

    <!-- chuyen trang -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS CDN (Đã cấu hình màu & font chuẩn dự án) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#F9F6F0',
                        'cream-accent': '#E3D2BE',
                        'cream-hover': '#D6C5B3',
                        forest: '#385A46',
                        'forest-dark': '#2A4435',
                        'footer-dark': '#0F1522',
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['DM Sans', 'sans-serif'],
                        cinzel: ['"Cinzel Decorative"', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&family=Cinzel+Decorative:wght@400;700;900&display=swap');
        


        body {
            background-color: #F9F6F0;
            font-family: 'DM Sans', sans-serif;

        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F9F6F0;
        }
        ::-webkit-scrollbar-thumb {
            background: #D6C5B3;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #385A46;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-cream font-sans text-gray-800 antialiased selection:bg-cream-accent selection:text-forest">

   

    <main>
        @yield('content')
    </main>
    @include('clients.partials.footer_home')

   


    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @if(session('clear_cart'))
    <script>
        localStorage.removeItem('fadegra_cart');
    </script>
    @endif
</body>
</html>