<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Các trạng thái hợp lệ và thứ tự hiển thị trên timeline.
     */
    protected array $timelineSteps = [
        'pending'    => ['label' => 'Chờ xác nhận', 'icon' => 'fa-receipt'],
        'processing' => ['label' => 'Đang chuẩn bị', 'icon' => 'fa-mug-hot'],
        'shipping'   => ['label' => 'Đang giao hàng', 'icon' => 'fa-truck-fast'],
        'completed'  => ['label' => 'Hoàn thành', 'icon' => 'fa-circle-check'],
    ];

    /**
     * Các trạng thái mà khách còn có thể hủy đơn.
     */
    protected array $cancellableStatuses = ['pending', 'processing'];

    /**
     * Danh sách đơn hàng của tài khoản đang đăng nhập.
     * GET /orders
     */
    public function index(Request $request)
    {
        // Admin/Staff không dùng trang lịch sử đơn hàng của khách — chuyển sang trang quản lý đơn
        $userRole = Auth::user()->roleRelation->name ?? '';
        if (in_array($userRole, ['admin', 'staff'])) {
            return redirect()->route('admin.orders.index');
        }

        $status = $request->query('status', 'all');

        $query = Order::with(['orderItems.product.images', 'payments'])
            ->where('user_id', Auth::id());

        if ($status !== 'all' && array_key_exists($status, $this->statusLabels())) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->paginate(6)->withQueryString();

        $statusCounts = Order::where('user_id', Auth::id())
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('clients.pages.orders.index', [
            'orders'        => $orders,
            'status'        => $status,
            'statusLabels'  => $this->statusLabels(),
            'statusCounts'  => $statusCounts,
        ]);
    }

    /**
     * Form tra cứu đơn hàng bằng mã đơn + số điện thoại (dành cho khách chưa đăng nhập).
     * GET /orders/lookup
     */
    public function lookupForm()
    {
        if (Auth::check()) {
            return redirect()->route('orders.index');
        }

        return view('clients.pages.orders.lookup');
    }

    /**
     * Xử lý tra cứu đơn hàng bằng mã đơn + số điện thoại.
     * POST /orders/lookup
     */
    public function lookup(Request $request)
    {
        $data = $request->validate([
            'order_code' => 'required|string',
            'phone'      => 'required|string|max:20',
        ], [
            'order_code.required' => 'Vui lòng nhập mã đơn hàng.',
            'phone.required'      => 'Vui lòng nhập số điện thoại đã đặt hàng.',
        ]);

        $orderId = (int) preg_replace('/\D/', '', $data['order_code']);
        $phone = trim($data['phone']);

        $order = Order::with('shippingAddress', 'user')
            ->where('id', $orderId)
            ->where(function ($q) use ($phone) {
                $q->whereHas('shippingAddress', function ($sq) use ($phone) {
                    $sq->where('phone', $phone);
                })->orWhereHas('user', function ($uq) use ($phone) {
                    $uq->where('phone', $phone);
                });
            })
            ->first();

        if (!$order) {
            return back()
                ->withInput()
                ->withErrors(['order_code' => 'Không tìm thấy đơn hàng phù hợp với mã đơn và số điện thoại đã nhập.']);
        }

        // Lưu quyền xem đơn này vào session cho khách vãng lai
        $verified = session('verified_order_ids', []);
        $verified[] = $order->id;
        session(['verified_order_ids' => array_values(array_unique($verified))]);

        return redirect()->route('orders.show', $order->id);
    }

    /**
     * Chi tiết đơn hàng: sản phẩm, tổng tiền, giao hàng, thanh toán, timeline trạng thái.
     * GET /orders/{order}
     */
    public function show(Order $order)
    {
        $this->authorizeOrderAccess($order);

        $order->load([
            'orderItems.product.images',
            'orderItems.size',
            'orderItems.toppings',
            'shippingAddress',
            'payments',
            'statusHistory' => function ($q) {
                $q->orderBy('changed_at', 'asc');
            },
            'user',
        ]);

        $reviewedProductIds = [];
        if (Auth::check() && $order->status === 'completed') {
            $reviewedProductIds = Review::where('user_id', Auth::id())
                ->whereIn('product_id', $order->orderItems->pluck('product_id')->unique())
                ->pluck('product_id')
                ->toArray();
        }

        return view('clients.pages.orders.show', [
            'order'               => $order,
            'statusLabels'        => $this->statusLabels(),
            'timelineSteps'       => $this->timelineSteps,
            'cancellable'         => in_array($order->status, $this->cancellableStatuses) && $this->authorizeOrderAccess($order, false),
            'canReview'           => Auth::check() && Auth::id() === $order->user_id && $order->status === 'completed',
            'reviewedProductIds'  => $reviewedProductIds,
            'isOwner'             => Auth::check() && Auth::id() === $order->user_id,
        ]);
    }

    /**
     * Hủy đơn hàng (chỉ khi còn ở trạng thái cho phép hủy).
     * POST /orders/{order}/cancel
     */
    public function cancel(Request $request, Order $order)
    {
        $this->authorizeOrderAccess($order);

        if (!in_array($order->status, $this->cancellableStatuses)) {
            return back()->with('error', 'Đơn hàng này không thể hủy ở trạng thái hiện tại.');
        }

        $reason = $request->input('reason');

        $order->status = 'cancelled';
        $order->save();

        OrderStatusHistory::create([
            'order_id'   => $order->id,
            'status'     => 'cancelled',
            'note'       => $reason ? "Khách hủy đơn: {$reason}" : 'Khách hàng đã hủy đơn hàng.',
            'changed_at' => now(),
        ]);

        return back()->with('success', 'Đơn hàng đã được hủy thành công.');
    }

    /**
     * Đặt lại đơn hàng: thêm toàn bộ sản phẩm trong đơn vào giỏ hàng.
     * POST /orders/{order}/reorder
     */
    public function reorder(Order $order)
    {
        $this->authorizeOrderAccess($order);

        $order->load('orderItems.toppings');

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            foreach ($order->orderItems as $item) {
                $cartItem = CartItem::create([
                    'cart_id'    => $cart->id,
                    'product_id' => $item->product_id,
                    'size_id'    => $item->size_id,
                    'quantity'   => $item->quantity,
                ]);

                $toppingIds = $item->toppings->pluck('id')->toArray();
                if (!empty($toppingIds)) {
                    $cartItem->toppings()->attach($toppingIds);
                }
            }
        } else {
            $sessionCart = session('cart', []);

            foreach ($order->orderItems as $item) {
                $sessionCart[] = [
                    'product_id'  => $item->product_id,
                    'size_id'     => $item->size_id,
                    'quantity'    => $item->quantity,
                    'topping_ids' => $item->toppings->pluck('id')->toArray(),
                ];
            }

            session(['cart' => $sessionCart]);
        }

        return redirect()->route('cart')->with('success', 'Đã thêm lại các sản phẩm từ đơn hàng #' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' vào giỏ hàng.');
    }

    /**
     * Gửi đánh giá cho sản phẩm sau khi đơn đã hoàn thành.
     * POST /orders/{order}/review
     */
    public function review(Request $request, Order $order)
    {
        if (!Auth::check() || Auth::id() !== $order->user_id) {
            abort(403);
        }

        if ($order->status !== 'completed') {
            return back()->with('error', 'Chỉ có thể đánh giá sau khi đơn hàng đã hoàn thành.');
        }

        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
        ]);

        // Đảm bảo sản phẩm này thực sự thuộc về đơn hàng
        $belongsToOrder = $order->orderItems()->where('product_id', $data['product_id'])->exists();
        if (!$belongsToOrder) {
            abort(403);
        }

        Review::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $data['product_id']],
            ['rating' => $data['rating'], 'comment' => $data['comment']]
        );

        return back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }

    /**
     * Kiểm tra quyền xem/thao tác trên đơn hàng: chủ tài khoản hoặc khách đã tra cứu hợp lệ.
     */
    private function authorizeOrderAccess(Order $order, bool $abortIfDenied = true): bool
    {
        if (Auth::check() && Auth::id() === $order->user_id) {
            return true;
        }

        $verified = session('verified_order_ids', []);
        if (in_array($order->id, $verified)) {
            return true;
        }

        if ($abortIfDenied) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        return false;
    }

    private function statusLabels(): array
    {
        return [
            'pending'    => 'Chờ xác nhận',
            'processing' => 'Đang chuẩn bị',
            'shipping'   => 'Đang giao',
            'completed'  => 'Hoàn thành',
            'cancelled'  => 'Đã hủy',
        ];
    }
}
