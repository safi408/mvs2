<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class UserOrderController extends Controller
{
    // users all orders

 // old controller    
public function userOrders()
{
    $orders = Order::with('items')
        ->where('user_id', auth()->id())
        ->orderBy('id', 'desc')
        ->select('id', 'order_number', 'total', 'order_status', 'payment_status', 'created_at')
        ->get();

    return response()->json([
        'status' => 'success',
        'orders' => $orders
    ]);
}



// public function userOrders()
// {
//     try {
//         $orders = Order::with('items') // Include items
//             ->where('user_id', auth()->id())
//             ->orderBy('id', 'desc')
//             ->select('id', 'order_number', 'total', 'order_status', 'payment_status', 'created_at')
//             ->get();

//         return response()->json([
//             'status' => 'success',
//             'orders' => $orders  
//         ]);
//     } catch (\Throwable $e) {
//         return response()->json([
//             'status'  => 'error',
//             'message' => $e->getMessage()
//         ], 500);
//     }
// }







// users single orders
public function userOrderDetails($id)
{
    $order = Order::with('items') // items from order_items table
        ->where('user_id', auth()->id())
        ->where('id', $id)
        ->first();

    if (!$order) {
        return response()->json([
            'status' => 'error',
            'message' => 'Order not found'
        ], 404);
    }

    return response()->json([
        'status' => 'success',
        'order' => $order
    ]);
}

public function deleteUserOrder($id)
{
    $order = Order::where('user_id', auth()->id())
        ->where('id', $id)
        ->first();

    if (!$order) {
        return response()->json([
            'status' => 'error',
            'message' => 'Order not found'
        ], 404);
    }

    if ($order->order_status !== 'pending') {
        return response()->json([
            'status' => 'error',
            'message' => 'Only pending orders can be deleted'
        ], 403);
    }

    // delete order items from order_items table
    $order->items()->delete();

    // delete order
    $order->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Order deleted successfully'
    ]);
}



}
