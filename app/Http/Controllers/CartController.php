<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Size;
use App\Models\Topping;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        $cartItems = [];
        $totalPrice = 0;

        if (Auth::check()) {
            $cart = Cart::with(['items.product.images', 'items.size', 'items.toppings'])
                        ->where('user_id', Auth::id())
                        ->first();
            
            if ($cart) {
                foreach ($cart->items as $item) {
                    $itemPrice = $item->product->price;
                    if ($item->size) {
                        $itemPrice += $item->size->price_extra;
                    }
                    $toppingPrice = $item->toppings->sum('price');
                    $itemPrice += $toppingPrice;
                    
                    $itemTotal = $itemPrice * $item->quantity;
                    $totalPrice += $itemTotal;

                    $cartItems[] = [
                        'id' => $item->id,
                        'product' => $item->product,
                        'size' => $item->size,
                        'toppings' => $item->toppings,
                        'quantity' => $item->quantity,
                        'item_total' => $itemTotal,
                        'is_db' => true,
                    ];
                }
            }
        } else {
            $sessionCart = session('cart', []);
            foreach ($sessionCart as $index => $item) {
                $product = Product::with('images')->find($item['product_id']);
                $size = isset($item['size_id']) ? Size::find($item['size_id']) : null;
                $toppings = isset($item['topping_ids']) ? Topping::whereIn('id', $item['topping_ids'])->get() : collect();

                if (!$product) continue;

                $itemPrice = $product->price;
                if ($size) {
                    $itemPrice += $size->price_extra;
                }
                $toppingPrice = $toppings->sum('price');
                $itemPrice += $toppingPrice;

                $itemTotal = $itemPrice * $item['quantity'];
                $totalPrice += $itemTotal;

                $cartItems[] = [
                    'id' => $index,
                    'product' => $product,
                    'size' => $size,
                    'toppings' => $toppings,
                    'quantity' => $item['quantity'],
                    'item_total' => $itemTotal,
                    'is_db' => false,
                ];
            }
        }

        return view('clients.pages.cart', compact('cartItems', 'totalPrice'));
    }

    /**
     * Add item to cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size_id' => 'nullable|exists:sizes,id',
            'topping_ids' => 'nullable|array',
            'topping_ids.*' => 'exists:toppings,id'
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity;
        $sizeId = $request->size_id;
        $toppingIds = $request->topping_ids ?? [];
        sort($toppingIds); // For comparison

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            
            // Find if item exists
            $existingItem = null;
            foreach ($cart->items as $item) {
                $itemToppingIds = $item->toppings->pluck('id')->toArray();
                sort($itemToppingIds);

                if ($item->product_id == $productId && $item->size_id == $sizeId && $itemToppingIds == $toppingIds) {
                    $existingItem = $item;
                    break;
                }
            }

            if ($existingItem) {
                $existingItem->quantity += $quantity;
                $existingItem->save();
            } else {
                $cartItem = CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $productId,
                    'size_id' => $sizeId,
                    'quantity' => $quantity
                ]);
                if (!empty($toppingIds)) {
                    $cartItem->toppings()->attach($toppingIds);
                }
            }
        } else {
            $cart = session('cart', []);
            $found = false;
            
            foreach ($cart as &$item) {
                $itemToppings = $item['topping_ids'] ?? [];
                sort($itemToppings);
                if ($item['product_id'] == $productId && ($item['size_id'] ?? null) == $sizeId && $itemToppings == $toppingIds) {
                    $item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $cart[] = [
                    'product_id' => $productId,
                    'size_id' => $sizeId,
                    'quantity' => $quantity,
                    'topping_ids' => $toppingIds
                ];
            }
            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $isDb = $request->input('is_db', false);

        if ($isDb && Auth::check()) {
            $cartItem = CartItem::where('id', $id)->whereHas('cart', function($q) {
                $q->where('user_id', Auth::id());
            })->first();

            if ($cartItem) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
            }
        } else {
            $cart = session('cart', []);
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $request->quantity;
                session(['cart' => $cart]);
            }
        }

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật số lượng.');
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request, $id)
    {
        $isDb = $request->input('is_db', false);

        if ($isDb && Auth::check()) {
            $cartItem = CartItem::where('id', $id)->whereHas('cart', function($q) {
                $q->where('user_id', Auth::id());
            })->first();

            if ($cartItem) {
                $cartItem->delete();
            }
        } else {
            $cart = session('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session(['cart' => $cart]);
            }
        }

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    /**
     * Clear cart.
     */
    public function clear()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $cart->items()->delete();
                // Optionally delete the cart itself
                // $cart->delete();
            }
        } else {
            session()->forget('cart');
        }

        return redirect()->route('cart.index')->with('success', 'Đã làm trống giỏ hàng.');
    }
}
