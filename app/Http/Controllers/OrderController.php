<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::with(['items.product'])
                   ->where('user_id', Auth::id())
                   ->orderBy('created_at', 'desc')
                   ->get();

    $title = "Order";

    return view('orders.index', compact('orders', 'title'));
}
}
