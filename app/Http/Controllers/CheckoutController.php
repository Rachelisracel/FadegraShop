<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Size;
use App\Models\Topping;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // 1. Chỉ hiển thị giao diện (Mọi thứ khác JS tự lo)
    public function index()
    {
        return view('clients.pages.checkout');
    }

    // 2. Xử lý lưu đơn hàng từ JS gửi lên
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'payment_method' => 'required',
            'cart_data' => 'required'
        ]);

        $cart = json_decode($request->cart_data, true);
        if (empty($cart)) {
            return back()->withErrors(['error' => 'Giỏ hàng đang trống!'])->withInput();
        }

        // Lấy phí ship từ frontend (đơn vị VND)
        $shippingFee = (int) $request->shipping_fee;

        DB::beginTransaction();
        try {
            // 1. Tạo địa chỉ
            $shippingAddress = ShippingAddress::create([
                'user_id' => Auth::id(),
                'full_name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city ?? null,
                'detail' => $request->note ?? null,
            ]);

            // 2. Tạo đơn hàng (tạm tổng = 0)
            $order = Order::create([
                'user_id' => Auth::id(),
                'shipping_address_id' => $shippingAddress->id,
                'total_price' => 0,
                'status' => 'pending',
            ]);

            $total = 0;

            // 3. Lưu từng món
            foreach ($cart as $item) {
                // Tìm sản phẩm (theo ID hoặc tên)
                $product = null;
                if (!empty($item['product_id'])) {
                    $product = Product::find($item['product_id']);
                }
                if (!$product && !empty($item['name'])) {
                    $product = Product::where('name', $item['name'])->first();
                }
                if (!$product) continue;

                // Tìm size theo tên (nếu có)
                $size = null;
                $sizeName = $item['size'] ?? null;
                if ($sizeName && $sizeName !== 'Mặc định') {
                    $size = Size::where('name', $sizeName)->first();
                }

                // Tính giá sản phẩm + size
                $price = $product->price;
                if ($size) {
                    $price += $size->price_extra ?? 0;
                }
                $sizeId = $size ? $size->id : null;

                $quantity = $item['quantity'];

                // Tạo OrderItem
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'size_id' => $sizeId,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                $itemTotal = $price * $quantity;

                // Lưu topping theo tên
                $toppingNames = $item['toppings'] ?? [];
                foreach ($toppingNames as $toppingName) {
                    $topping = Topping::where('name', $toppingName)->first();
                    if ($topping) {
                        $orderItem->toppings()->attach($topping->id, ['price' => $topping->price]);
                        $itemTotal += $topping->price * $quantity;
                    }
                }

                $total += $itemTotal;
            }

            // 4. Cộng phí ship vào tổng
            $total += $shippingFee;

            // 5. Cập nhật tổng tiền đơn hàng
            $order->update(['total_price' => $total]);

            DB::commit();

            // Xóa giỏ hàng localStorage (thông báo cho frontend)
            session()->flash('clear_cart', true);

            return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Lỗi: ' . $e->getMessage()])->withInput();
        }
    }
}