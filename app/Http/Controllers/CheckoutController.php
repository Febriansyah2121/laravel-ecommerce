<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;
        
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $subtotal = $product->price * $details['quantity'];
                $total += $subtotal;
                $cartItems[] = [
                    'id' => $id,
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'subtotal' => $subtotal
                ];
            }
        }
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function process(Request $request): RedirectResponse
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:cod,transfer,card'
        ]);
        
        $total = 0;
        $items = [];
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $subtotal = $product->price * $details['quantity'];
                $total += $subtotal;
                $items[] = [
                    'product_id' => $id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $details['quantity'],
                    'subtotal' => $subtotal
                ];
                $product->decrement('stock', $details['quantity']);
            }
        }
        
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'shipping_address' => $validated['shipping_address'],
            'total_amount' => $total,  // ← PASTIKAN total_amount, BUKAN total
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            'items' => json_encode($items)
        ]);
        
        session()->forget('cart');
        
        return redirect()->route('checkout.success', $order)->with('success', 'Order placed successfully!');
    }

    public function success(Order $order): View
    {
        return view('checkout.success', compact('order'));
    }
}