<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Topping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // 1. Chỉ hiển thị giao diện
    public function index()
    {
        return view('clients.pages.checkout');
    }

    // 2. Xử lý lưu đơn hàng từ JS gửi lên
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'cart_data' => 'required'
        ]);

        // Giải mã JSON giỏ hàng từ Javascript gửi lên
        $cart = json_decode($request->cart_data, true);
        
        if (empty($cart)) {
            return back()->withErrors(['error' => 'Giỏ hàng đang trống!']);
        }

        DB::beginTransaction();
        try {
            // Tính lại tổng tiền
            $subtotal = 0;
            foreach ($cart as $item) {
                // JS đang lưu totalPrice là số ngàn (VD: 50 nghĩa là 50.000đ)
                $subtotal += ($item['totalPrice'] ?? 0) * 1000; 
            }
            
            $shippingFee = (int)$request->shipping_fee;
            $total = $subtotal + $shippingFee;

            // Bước 1: Tạo Shipping Address trước
            $shippingAddress = ShippingAddress::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'full_name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city ?? null,
                'detail' => $request->note ?? null,
            ]);

            // Bước 2: Tạo Đơn hàng
            $order = Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'shipping_address_id' => $shippingAddress->id,
                'total_price' => $total,
                'status' => 'pending',
            ]);

            // Bước 3: Lưu chi tiết món ăn (OrderItems)
            foreach ($cart as $item) {
                $productId = null;
                $itemName = !empty($item['name']) ? trim($item['name']) : 'Trà Fadegra';

                // 1. Thử tìm theo ID thực trong DB (nếu id không phải timestamp của JS)
                if (!empty($item['id']) && is_numeric($item['id']) && $item['id'] < 1000000) {
                    $prod = Product::find($item['id']);
                    if ($prod) {
                        $productId = $prod->id;
                    }
                }

                // 2. Thử tìm sản phẩm theo Tên trong DB
                if (!$productId) {
                    $prod = Product::where('name', $itemName)->first();
                    if ($prod) {
                        $productId = $prod->id;
                    }
                }

                // 3. Nếu DB chưa từng có sản phẩm này, tự động tạo mới sản phẩm để không bị null product_id
                if (!$productId) {
                    $category = Category::first();
                    if (!$category) {
                        $category = Category::create([
                            'name' => 'Menu Fadegra',
                            'slug' => 'menu-fadegra'
                        ]);
                    }

                    $quantity = (int)($item['quantity'] ?? 1);
                    $itemPrice = (($item['totalPrice'] ?? 0) * 1000) / max(1, $quantity);

                    $newProd = Product::create([
                        'category_id' => $category->id,
                        'name' => $itemName,
                        'slug' => Str::slug($itemName) . '-' . time(),
                        'price' => $itemPrice,
                        'stock' => 100,
                        'status' => 'active',
                        'unit' => 'ly'
                    ]);
                    $productId = $newProd->id;
                }

                // Tìm Size ID hợp lệ (chỉ gán nếu tồn tại trong DB)
                $sizeId = null;
                if (!empty($item['size'])) {
                    $sizeObj = Size::where('name', 'like', '%' . trim($item['size']) . '%')->first();
                    if ($sizeObj && Size::where('id', $sizeObj->id)->exists()) {
                        $sizeId = $sizeObj->id;
                    }
                }

                $quantity = (int)($item['quantity'] ?? 1);
                $price = (($item['totalPrice'] ?? 0) * 1000) / max(1, $quantity);

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'size_id' => $sizeId,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                // Lưu Toppings nếu có
                if (!empty($item['toppings']) && is_array($item['toppings'])) {
                    foreach ($item['toppings'] as $topName) {
                        $topObj = Topping::where('name', 'like', '%' . trim($topName) . '%')->first();
                        if ($topObj && Topping::where('id', $topObj->id)->exists()) {
                            DB::table('order_item_toppings')->insert([
                                'order_item_id' => $orderItem->id,
                                'topping_id' => $topObj->id,
                                'price' => $topObj->price ?? 0,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            // Đánh dấu xóa giỏ hàng JS
            session()->flash('clear_cart', true);

            // Điều hướng tới trang Đơn hàng của tôi nếu đã đăng nhập
            if (Auth::check()) {
                return redirect()->route('client.orders.index')->with('success', 'Đặt hàng thành công! Đơn hàng của bạn đã được tiếp nhận.');
            }

            return redirect()->route('home')->with('success', 'Đặt hàng thành công! Chúng tôi sẽ sớm liên hệ cho bạn.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra khi tạo đơn hàng: ' . $e->getMessage()]);
        }
    }
}