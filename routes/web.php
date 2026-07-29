<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;

// ==========================================
// 1. CÁC TRANG CƠ BẢN (CLIENT)
// ==========================================
Route::get('/', function () { return view('clients.pages.home'); })->name('home');
Route::get('/menu', function () { return view('clients.pages.menu'); })->name('menu');
Route::get('/search', function () { return view('clients.pages.search'); })->name('search');

// Luồng Liên hệ Client
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ==========================================
// 2. GIỎ HÀNG & THANH TOÁN
// ==========================================
Route::get('/cart', function () { return view('clients.pages.cart'); })->name('cart');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.post');

// ==========================================
// 2b. ĐƠN HÀNG (CLIENT) — dùng prefix 'my' để tránh trùng với resource admin 'orders'
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('my.orders.index');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('my.orders.cancel');
    Route::post('/orders/{order}/reorder', [OrderController::class, 'reorder'])->name('my.orders.reorder');
    Route::post('/orders/{order}/review', [OrderController::class, 'review'])->name('my.orders.review');
});
Route::get('/orders/lookup', [OrderController::class, 'lookupForm'])->name('my.orders.lookup.form');
Route::post('/orders/lookup', [OrderController::class, 'lookup'])->name('my.orders.lookup');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('my.orders.show');

// ==========================================
// 3. XÁC THỰC (ĐĂNG NHẬP, ĐĂNG KÝ, QUÊN MẬT KHẨU)
// ==========================================
Route::get('/login', function () { return view('clients.pages.login'); })->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () { return view('clients.pages.register'); })->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Luồng Quên mật khẩu & OTP
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('forgot-password.post');

Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify-otp');
Route::post('/verify-otp', [AuthController::class, 'processVerifyOtp'])->name('verify-otp.post');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend-otp.post');

Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('reset-password');
Route::post('/reset-password', [AuthController::class, 'processResetPassword'])->name('reset-password.post');

// ==========================================
// 4. TRANG QUẢN TRỊ ADMIN / STAFF
// ==========================================
Route::prefix('admin')->middleware(['auth', 'role:admin,staff'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        $today = \Carbon\Carbon::today();
        $thisMonth = \Carbon\Carbon::now()->month;
        $thisYear = \Carbon\Carbon::now()->year;

        $dailyRevenue = \App\Models\Order::whereDate('created_at', $today)->sum('total_price');
        $monthlyRevenue = \App\Models\Order::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->sum('total_price');

        $dailyOrders = \App\Models\Order::whereDate('created_at', $today)->count();
        $monthlyOrders = \App\Models\Order::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->count();

        // Biểu đồ doanh thu 7 ngày gần nhất (mỗi ngày tính tổng total_price)
        $chartLabels = [];
        $chartRevenue = [];
        $chartValues = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $dayRevenue = \App\Models\Order::whereDate('created_at', $date)->sum('total_price');
            $chartLabels[] = $date->format('d/m');
            $chartRevenue[] = (float) $dayRevenue;
            $chartValues[] = (float) $dayRevenue;
        }
        $chartData = [
            'labels' => $chartLabels,
            'values' => $chartValues,
            'revenue' => $chartRevenue,
        ];

        // Top 5 sản phẩm bán chạy trong tháng
        $topProducts = \App\Models\Product::query()
            ->select('products.*')
            ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
            ->leftJoin('order_items', 'order_items.product_id', '=', 'products.id')
            ->leftJoin('orders', function ($join) use ($thisMonth, $thisYear) {
                $join->on('orders.id', '=', 'order_items.order_id')
                    ->whereMonth('orders.created_at', $thisMonth)
                    ->whereYear('orders.created_at', $thisYear);
            })
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get()
            ->map(function ($p) {
                // Lấy ảnh đầu tiên của sản phẩm (nếu có)
                $firstImage = \App\Models\ProductImage::where('product_id', $p->id)->first();
                $p->image = $firstImage ? $firstImage->image : null;
                return $p;
            });

        // 5 đơn hàng mới nhất kèm user + orderItems + product
        $recentOrders = \App\Models\Order::with(['user', 'orderItems.product'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.pages.dashboard', compact(
            'dailyRevenue', 'monthlyRevenue', 'dailyOrders', 'monthlyOrders',
            'chartData', 'topProducts', 'recentOrders'
        ));
    })->name('admin.dashboard');

    // Quản lý Đơn hàng (Staff + Admin)
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);

    // Quản lý Liên hệ / Phản hồi (Staff + Admin) -> ĐÃ GỘP VÀO ĐÂY
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->only(['index', 'show', 'update', 'destroy']);

    // Chỉ Admin mới có quyền truy cập
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['create', 'show', 'edit']);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['create', 'show', 'edit']);
    });
});