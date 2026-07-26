<?php

namespace App\Http\Controllers;

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
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'cart_data' => 'required'
        ]);

        // Giải mã JSON giỏ hàng từ Javascript gửi lên
        $cart = json_decode($request->cart_data, true);
        
        if(empty($cart)) {
            return back()->withErrors(['error' => 'Giỏ hàng đang trống!']);
        }

        DB::beginTransaction();
        try {
            // Tính lại tiền
            $subtotal = 0;
            foreach($cart as $item) {
                // JS đang lưu totalPrice là số ngàn (VD: 50 nghĩa là 50.000)
                $subtotal += $item['totalPrice'] * 1000; 
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

            // Bước 2: Tạo Đơn hàng với shipping_address_id hợp lệ
            $order = Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'shipping_address_id' => $shippingAddress->id,
                'total_price' => $total,
                'status' => 'pending',
            ]);

            DB::commit();

            // Xóa JS Cart bằng cách chèn 1 script nhỏ vào session thông báo
            session()->flash('clear_cart', true);

            return redirect()->route('home')->with('success', 'Đặt hàng thành công! Chúng tôi sẽ sớm liên hệ cho bạn.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
}