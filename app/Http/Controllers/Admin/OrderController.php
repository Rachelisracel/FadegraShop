<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'shippingAddress']);

        if ($request->has('search') && $request->search != '') {
            $query->where('id', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->search . '%');
                  });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10)->appends($request->all());

        return view('admin.pages.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'shippingAddress', 'orderItems.product'])->findOrFail($id);
        
        // Return view or JSON depending on how modal handles it. Let's return JSON for easy AJAX modal loading
        return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,processing,shipping,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
