<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $products = [];
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $variant = Variant::with(['product', 'attributes'])->find($item['variant_id']);

            if ($variant) {
                $products[] = [
                    'product_id' => $variant->product->id,
                    'variant_id' => $variant->id,
                    'name' => $variant->product->product_name,
                    'price' => $variant->price,
                    'quantity' => $item['quantity'],
                    'image' => $variant->image,
                    'variant_name' => $variant->variant_name,
                    'variant_details' => $variant->getVariantDetails()
                ];
                $subtotal += $variant->price * $item['quantity'];
            }
        }

        return view('user.cart', [
            'title' => 'Keranjang Belanja',
            'products' => $products,
            'subtotal' => $subtotal,
            'vat' => $subtotal * 0.1,
            'total' => $subtotal * 1.1
        ]);
    }

    public function add(Request $request, $productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk menambahkan produk ke keranjang');
        }

        $request->validate([
            'variant_id' => 'required|exists:variants,id',
            'quantity' => 'required|numeric|min:1|max:100'
        ]);

        $product = Product::findOrFail($productId);
        $variant = Variant::findOrFail($request->variant_id);

        if ($variant->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        $cart = session()->get('cart', []);
        $found = false;

        foreach ($cart as $key => $item) {
            if ($item['product_id'] == $productId && $item['variant_id'] == $request->variant_id) {
                $newQuantity = $cart[$key]['quantity'] + $request->quantity;
                if ($variant->stock < $newQuantity) {
                    return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia');
                }
                $cart[$key]['quantity'] = $newQuantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'product_id' => $productId,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $productId, $variantId)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        $cart = session()->get('cart', []);
        $variant = Variant::findOrFail($variantId);

        foreach ($cart as $key => $item) {
            if ($item['product_id'] == $productId && $item['variant_id'] == $variantId) {
                if ($variant->stock < $request->quantity) {
                    return redirect()->back()->with('error', 'Stok tidak mencukupi');
                }
                $cart[$key]['quantity'] = $request->quantity;
                break;
            }
        }

        session()->put('cart', $cart);
        return redirect()->route('cart')->with('success', 'Keranjang diperbarui!');
    }

    public function remove($productId, $variantId)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['product_id'] == $productId && $item['variant_id'] == $variantId) {
                unset($cart[$key]);
                break;
            }
        }

        session()->put('cart', array_values($cart));
        return redirect()->route('cart')->with('success', 'Produk dihapus dari keranjang!');
    }
    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return $count; 
    }
    public function showCheckout()
    {
        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart')->with('error', 'Keranjang anda kosong!');
        }

        $subtotal = 0;
        $products = [];

        foreach ($cartItems as $item) {
            $variant = Variant::with(['product', 'attributes'])->find($item['variant_id']);
            $product = $variant->product ?? null;

            if ($product && $variant) {
                $price = $variant->price;
                $products[] = [
                    'product' => $product,
                    'variant' => $variant,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'subtotal' => $price * $item['quantity']
                ];
                $subtotal += $price * $item['quantity'];
            }
        }

        return view('user.checkout', [
            'title' => 'Checkout',
            'products' => $products,
            'subtotal' => $subtotal,
            'vat' => $subtotal * 0.1,
            'total' => $subtotal * 1.1
        ]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'complete_address' => 'required|string|max:1000',
            'payment_method' => 'required|in:BANK,COD,EWALLET',
            'notes' => 'nullable|string'
        ]);

        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong!');
        }

        $subtotal = 0;
        $items = [];

        foreach ($cartItems as $item) {
            $variant = Variant::with('product')->find($item['variant_id']);
            $product = $variant->product ?? null;

            if (!$product || !$variant) continue;

            if ($variant->stock < $item['quantity']) {
                return redirect()->route('cart')->with('error', "Stok tidak mencukupi untuk {$product->product_name}");
            }

            $price = $variant->price;
            $items[] = [
                'product' => $product,
                'variant' => $variant,
                'quantity' => $item['quantity'],
                'price' => $price,
                'subtotal' => $price * $item['quantity']
            ];

            $subtotal += $price * $item['quantity'];
        }

        $vat = $subtotal * 0.1;
        $total = $subtotal + $vat;

        do {
            $orderCode = 'ORD-' . Str::upper(Str::random(8));
        } while (Order::where('order_code', $orderCode)->exists());

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => $orderCode,
            'total_price' => $total,
            'address' => "Nama: {$request->full_name}\nTelp: {$request->phone_number}\nAlamat: {$request->complete_address}",
            'payment_method' => $request->payment_method,
            'notes' => $request->notes
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'variant_id' => $item['variant']->id,
                'amount' => $item['quantity'],
                'unit_price' => $item['price'],
                'subtotal' => $item['subtotal']
            ]);

            $variant = $item['variant'];
            $variant->stock -= $item['quantity'];
            $variant->save();
        }

        session()->forget('cart');
        return redirect()->route('confirmation', ['order' => $order->id]);
    }

    public function confirmation($orderId)
    {
        $order = Order::with(['items.product', 'items.variant'])->findOrFail($orderId);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.confirmation', [
            'title' => 'Konfirmasi Pesanan',
            'order' => $order
        ]);
    }

    public function calculateCartCount()
{
    $cart = session()->get('cart', []);
    return array_sum(array_column($cart, 'quantity'));
}
}
