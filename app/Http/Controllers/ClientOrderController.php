<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ClientOrderController extends Controller
{
    /**
     * Danh sách đơn hàng của khách hàng đang đăng nhập
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        $query = Order::with(['orderItems.product', 'shippingAddress'])
            ->where('user_id', $userId);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(8)->appends($request->all());

        return view('clients.pages.orders.index', compact('orders'));
    }

    /**
     * Chi tiết đơn hàng của khách hàng
     */
    public function show($id)
    {
        $userId = Auth::id();

        $order = Order::with([
            'shippingAddress',
            'orderItems.product',
            'orderItems.size',
            'orderItems.toppings'
        ])
        ->where('user_id', $userId)
        ->findOrFail($id);

        return view('clients.pages.orders.show', compact('order'));
    }

    /**
     * Hủy đơn hàng (Chỉ áp dụng khi đơn hàng ở trạng thái pending)
     */
    public function cancel($id)
    {
        $userId = Auth::id();

        $order = Order::where('user_id', $userId)->findOrFail($id);

        if ($order->status !== 'pending') {
            return back()->with('error', 'Không thể hủy đơn hàng này vì đơn đã được cửa hàng tiếp nhận hoặc xử lý!');
        }

        $order->status = 'cancelled';
        $order->save();

        return back()->with('success', 'Hủy đơn hàng thành công!');
    }
}
