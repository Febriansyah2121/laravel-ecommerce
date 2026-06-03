<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
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
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, int $id): JsonResponse|RedirectResponse
    {
        try {
            $product = Product::findOrFail($id);
            $quantity = $request->input('quantity', 1);
            
            $cart = session()->get('cart', []);
            
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'image' => $product->image
                ];
            }
            
            session()->put('cart', $cart);
            
            $cartCount = 0;
            foreach ($cart as $item) {
                $cartCount += $item['quantity'];
            }
            
            // Return JSON untuk AJAX request
            return response()->json([
                'success' => true,
                'cart_count' => $cartCount,
                'message' => 'Product added to cart'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->input('quantity', 1);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function remove(int $id): RedirectResponse
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Item removed!');
    }

    public function clear(): RedirectResponse
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}