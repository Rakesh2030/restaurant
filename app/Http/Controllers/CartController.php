<?php

namespace App\Http\Controllers;

use App\Models\EditFoodModel;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $title = "Cart";
        return view('frontend.pages.cart', compact('cart', 'title'));
    }

    public function add(Request $request, $id)
    {
        $food = EditFoodModel::findOrFail($id);
        $cart = session()->get('cart', []);
        $price = $food->discount_price ?: $food->price;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $food->id,
                'name' => $food->head,
                'price' => $price,
                'image' => $food->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Food added to cart',
                'cart_count' => count($cart),
            ]);
        }

        return back()->with('success', 'Food added to cart');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Cart updated successfully');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Food removed from cart');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $title = "Checkout";
        return view('frontend.pages.checkout', compact('cart', 'title'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (count($cart) == 0) {
            return redirect()->route('frontend.pages.menu')->with('success', 'Please add food to cart first');
        }

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // This is a simple project discount. Food discount is already included in item price.
        $discount = 0;
        $total = $subtotal - $discount;

        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'note' => $request->note,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $item['id'],
                'food_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('frontend.home')->with('success', 'Your order has been placed successfully');
    }

    public function myOrders()
    {
        $title = 'My Orders';

        // Get logged-in user orders.
        $orders = Order::with('items')
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhere('customer_email', Auth::user()->email);
            })
            ->latest()
            ->get();

        return view('frontend.pages.my-orders', compact('orders', 'title'));
    }
}
