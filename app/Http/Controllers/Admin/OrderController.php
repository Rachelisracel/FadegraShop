<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'shippingAddress']);

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pages.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load([
            'user',
            'shippingAddress',
            'orderItems.product.images',
            'orderItems.size',
            'orderItems.toppings',
            'statusHistory.changedBy',
        ]);

        return view('admin.pages.order-detail', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,processing,shipping,completed,cancelled',
            'note' => 'nullable|string|max:1000',
        ]);

        $oldStatus = $order->status;

        DB::transaction(function () use ($order, $data, $oldStatus) {
            $order->update(['status' => $data['status']]);

            if ($oldStatus !== $data['status'] || !empty($data['note'])) {
                OrderStatusHistory::create([
                    'order_id' => $order->id,
                    'status' => $data['status'],
                    'old_status' => $oldStatus,
                    'new_status' => $data['status'],
                    'changed_by' => Auth::id(),
                    'note' => $data['note'] ?? null,
                    'changed_at' => now(),
                ]);
            }
        });

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
