<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemTopping;
use App\Models\ShippingAddress;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Size;
use App\Models\Topping;
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'shipping_fee' => 'nullable|integer|min:0',
            'cart_data' => 'required',
        ]);

        // Giải mã JSON giỏ hàng từ Javascript gửi lên
        $cart = json_decode($request->cart_data, true);

        if (empty($cart)) {
            return back()->withErrors(['error' => 'Giỏ hàng đang trống!']);
        }

        $shippingFee = (int) ($request->shipping_fee ?? 0);

        DB::beginTransaction();
        try {
            // Bước 1: Tạo Shipping Address trước
            $shippingAddress = ShippingAddress::create([
                'user_id'    => Auth::check() ? Auth::id() : null,
                'full_name'  => $request->name,
                'phone'      => $request->phone,
                'address'    => $request->address,
                'city'       => null,
                'detail'     => $request->note ?? null,
            ]);

            // Bước 2: Tạo Order (total sẽ cập nhật sau khi tính)
            $order = Order::create([
                'user_id'             => Auth::check() ? Auth::id() : null,
                'shipping_address_id' => $shippingAddress->id,
                'total_price'         => 0,
                'status'              => 'pending',
            ]);

            // Bước 3: Tạo các OrderItem + topping pivot từ cart
            $subtotal = 0;
            foreach ($cart as $item) {
                $name = trim((string) ($item['name'] ?? ''));
                if ($name === '') {
                    continue;
                }

                // Tìm sản phẩm theo tên (vì JS cart chỉ lưu tên)
                $product = Product::where('name', $name)->first();
                if (!$product) {
                    continue;
                }

                $quantity = max(1, (int) ($item['quantity'] ?? 1));
                $sizeName = isset($item['size']) ? trim((string) $item['size']) : '';
                $toppingNames = $item['toppings'] ?? [];

                // Đơn giá = giá sản phẩm + size_extra + tổng topping
                $unitPrice = (float) $product->price;

                $sizeId = null;
                if ($sizeName !== '' && $sizeName !== 'Mặc định') {
                    $size = Size::where('name', $sizeName)->first();
                    if ($size) {
                        $sizeId = $size->id;
                        $unitPrice += (float) $size->price_extra;
                    }
                }

                $toppingRecords = Topping::whereIn('name', $toppingNames)->get();
                foreach ($toppingRecords as $topping) {
                    $unitPrice += (float) $topping->price;
                }

                $orderItem = OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'size_id'    => $sizeId,
                    'quantity'   => $quantity,
                    'price'      => $unitPrice,
                ]);

                foreach ($toppingRecords as $topping) {
                    OrderItemTopping::create([
                        'order_item_id' => $orderItem->id,
                        'topping_id'    => $topping->id,
                        'price'         => $topping->price,
                    ]);
                }

                $subtotal += $unitPrice * $quantity;
            }

            // Bước 4: Cập nhật tổng tiền
            $total = $subtotal + $shippingFee;
            $order->total_price = $total;
            $order->save();

            // Bước 5: Lưu payment
            Payment::create([
                'order_id'       => $order->id,
                'payment_method' => $request->payment_method,
                'amount'         => $total,
                'status'         => 'pending',
            ]);

            // Bước 6: Lưu trạng thái đầu tiên
            \App\Models\OrderStatusHistory::create([
                'order_id'   => $order->id,
                'status'     => 'pending',
                'old_status' => null,
                'new_status' => 'pending',
                'changed_by' => null,
                'note'       => 'Đơn hàng mới được tạo.',
                'changed_at' => now(),
            ]);

            DB::commit();

            // Thông báo cho client JS xóa cart
            session()->flash('clear_cart', true);
            session()->flash('last_order_id', $order->id);

            return redirect()->route('home')->with('success', 'Đặt hàng thành công! Mã đơn của bạn là #' . str_pad($order->id, 6, '0', STR_PAD_LEFT));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
}