<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
class OrderController extends Controller
{
// app/Http/Controllers/Admin/OrderController.php
    public function index(Request $request)
    {
        $query = Order::with(['shippingAddress', 'user', 'items']);
        
        // Filter theo trạng thái
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        // Tìm kiếm theo mã đơn hoặc tên khách
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                ->orWhereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('shippingAddress', function($addrQuery) use ($search) {
                    $addrQuery->where('full_name', 'like', "%{$search}%");
                });
            });
        }
        
        $orders = $query->latest()->paginate(20);
        
        return view('admin.pages.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load([
            'shippingAddress', 
            'user',
            'items.product.images', 
            'items.size', 
            'items.toppings',
            'statusHistory'
        ]);
        return view('admin.pages.order-detail', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,delivering,completed,cancelled'
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        // Cập nhật trạng thái
        $order->status = $newStatus;
        $order->save();

        // Ghi lịch sử thay đổi
        OrderStatusHistory::create([
            'order_id' => $order->id,
            'status' => $newStatus,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'changed_by' => auth()->id(),
            'note' => $request->note ?? null,
        ]);

        $statusLabels = [
            'pending' => 'Chờ xử lý',
            'delivering' => 'Đang giao',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy'
        ];

        return back()->with('success', 'Đã cập nhật trạng thái thành "' . $statusLabels[$newStatus] . '"');
    }
}