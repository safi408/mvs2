<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;

class OrderController extends Controller
{
    //
    public function index(){
                // 🔹 Fetch all orders from DB
  $orders = Order::latest()->get();

$statusColors = [
    'pending' => 'warning',
    'processing' => 'primary',
    'shipped' => 'info',
    'completed' => 'success',
    'cancelled' => 'danger',
    'failed' => 'secondary',
    
    ];

      return view('admin.orders.index', compact('orders', 'statusColors'));

    }
    public function pending(){
        return view('admin.orders.pending');
    }
    public function completed(){
        return view('admin.orders.completed');
    }
    public function cancelled(){
        return view('admin.orders.cancelled');
    }

    public function show($id)
{
    // Fetch order with items and user (if registered)
    $order = Order::with('items', 'user')->findOrFail($id);

    // Prepare customer name
    $order->customer = $order->user
        ? $order->user->name
        : $order->first_name . ' ' . $order->last_name;

    return view('admin.orders.show', compact('order'));
}


}
