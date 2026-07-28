<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('shippingAddress')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('clients.pages.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load([
            'shippingAddress', 
            'items.product.images', 
            'items.size', 
            'items.toppings',
            'statusHistory.changedBy'
        ]);

        return view('clients.pages.order-detail', compact('order'));
    }

    // Thêm method mới để xóa đơn hàng
    public function destroy(Order $order)
    {
        // Chỉ cho phép xóa đơn của chính mình và đơn ở trạng thái completed hoặc cancelled
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($order->status, ['completed', 'cancelled'])) {
            return back()->withErrors(['error' => 'Chỉ có thể xóa đơn hàng đã hoàn thành hoặc đã hủy.']);
        }

        // Xóa các items và toppings liên quan
        foreach ($order->items as $item) {
            $item->toppings()->detach();
            $item->delete();
        }
        
        // Xóa lịch sử trạng thái
        $order->statusHistory()->delete();
        
        // Xóa đơn hàng
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Đã xóa đơn hàng thành công.');
    }
}