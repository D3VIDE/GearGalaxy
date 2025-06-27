<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::with('items.variant') // ambil data dari variants
                   ->where('user_id', Auth::id())
                   ->orderBy('created_at', 'desc')
                   ->get();

    return view('orders.index', [
        'orders' => $orders,
        'title' => 'Order',
    ]);
}
}
