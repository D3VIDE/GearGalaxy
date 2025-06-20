<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        // For now we'll use session-based cart
        $cartItems = session()->get('cart', []);
        $products = [];
        $subtotal = 0;

        // Get product details from database
        foreach ($cartItems as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $products[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'image' => $product->image,
                    'color' => $product->color,
                    'size' => $product->size
                ];
                $subtotal += $product->price * $quantity;
            }
        }

        return view('cart', [
            'products' => $products,
            'subtotal' => $subtotal,
            'shipping' => 0, // Free shipping by default
            'vat' => $subtotal * 0.1, // Assuming 10% VAT
            'total' => $subtotal * 1.1 // Subtotal + VAT
        ]);
    }

    /**
     * Add item to cart
     */
    public function add(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]++;
        } else {
            $cart[$productId] = 1;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Cart updated!');
    }

    /**
     * Remove item from cart
     */
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Product removed from cart!');
    }

    /**
     * Apply coupon code
     */
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        // Here you would typically validate the coupon against database
        // For now we'll just store it in session
        session()->put('coupon', $request->coupon_code);

        return redirect()->route('cart')->with('success', 'Coupon applied!');
    }
}