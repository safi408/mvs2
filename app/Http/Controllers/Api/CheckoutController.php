<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\VendorProduct;
use App\Models\ProductVariant;

class CheckoutController extends Controller
{









public function checkout(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'country' => 'required|string',
        'state' => 'nullable|string',
        'city' => 'required|string',
        'street' => 'required|string',
        'postal_code' => 'nullable|string',
        'note' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422);
    }

    // 🔹 Since items are not sent, set totals manually
    $subtotal = 0;
    $discount = 0;
    $shipping = 0;
    $total = ($subtotal - $discount) + $shipping;

    // 🔹 Create Order
    $order = Order::create([
        'user_id'        => auth()->id(),
        'order_number'   => 'ORD-' . now()->format('YmdHis'),

        
        'payment_method' => $request->payment_method ?? 'cod',
        'payment_status' => $request->payment_method === 'cod' ? 'unpaid' : 'paid',
        'order_status'   => $request->payment_method === 'cod' ? 'processing' : 'confirmed',

        'first_name'     => $request->first_name,
        'last_name'      => $request->last_name,
        'email'          => $request->email,
        'phone'          => $request->phone,
        'country'        => $request->country,
        'state'          => $request->state,
        'city'           => $request->city,
        'street'         => $request->street,
        'postal_code'    => $request->postal_code,
        'note'           => $request->note,
        'subtotal'       => $subtotal,
        'discount'       => $discount,
        'shipping'       => $shipping,
        'total'          => $total,
    ]);

    return response()->json([
        'status'   => 'success',
        'message'  => 'Order created successfully',
        'order_id' => $order->id,
        'subtotal' => $subtotal,
        'total'    => $total,
    ]);
}












// public function carts(Request $request)
// {
//     // Validate request
//     $validator = \Validator::make($request->all(), [
//         'order_id' => 'nullable|exists:orders,id',
//         'items'    => 'nullable|array',
//         'items.*.id' => 'nullable|exists:vendor_products,id',
//         'items.*.price' => 'nullable|numeric|min:0',
//         'items.*.quantity' => 'nullable|integer|min:1',
//     ]);

//     if ($validator->fails()) {
//         return response()->json([
//             'status' => 'error',
//             'errors' => $validator->errors(),
//         ], 422);
//     }

//     // Find order
//     $order = Order::findOrFail($request->order_id);

//     $subtotal = 0;
//     $orderItemIds = [];

//     foreach ($request->items as $item) {
//         $product = VendorProduct::findOrFail($item['id']);
//         $variant = isset($item['variant_id']) ? ProductVariant::find($item['variant_id']) : null;

//         // Determine image
//         $image = $variant?->images()->exists()
//             ? $variant->images()->first()->image_path
//             : ($product->images()->exists() ? $product->images()->first()->image_path : null);

//         // Create order item via relationship
//         $orderItem = $order->items()->create([
//             'vendor_product_id'  => $item['id'],
//             'product_variant_id' => $item['variant_id'] ?? null,
//             'name'               => $item['name'] ?? $product->name,
//             'product_slug'       => $product->slug,
//             'image'              => $item['image'] ?? $image,
//             'color'              => $item['color'] ?? $variant?->color_name,
//             'size'               => $item['sizes'] ?? null,
//             'price'              => $item['price'],
//             'quantity'           => $item['quantity'],
//             'total'              => $item['price'] * $item['quantity'],
//         ]);

//         $orderItemIds[] = $orderItem->id;
//         $subtotal += $orderItem->total;
//     }

//     // Calculate discount and shipping (update logic if needed)
//     $discount = 0;
//     $shipping = 0;
//     $total = ($subtotal - $discount) + $shipping;

//     // Update order totals
//     $order->update([
//         'order_item_id' => $orderItemIds,
//         'subtotal'      => $subtotal,
//         'discount'      => $discount,
//         'shipping'      => $shipping,
//         'total'         => $total,
//     ]);

//     return response()->json([
//         'status'   => 'success',
//         'message'  => 'Order items saved successfully',
//         'order_id' => $order->id,
//         'items'    => $orderItemIds,
//         'subtotal' => $subtotal,
//         'discount' => $discount,
//         'shipping' => $shipping,
//         'total'    => $total,
//     ]);
// }




























// new carts //
public function carts(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'order_id'        => 'nullable|exists:orders,id',

        'items'           => 'nullable|array',
        'items.*.id'      => 'required_with:items|exists:vendor_products,id',
        'items.*.price'   => 'required_with:items|numeric|min:0',
        'items.*.quantity'=> 'nullable|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422);
    }

    try {

        // Try existing active order
        $order = $request->order_id
            ? Order::find($request->order_id)
            : Order::where('user_id', auth()->id())
                ->whereIn('order_status', ['pending', 'processing', 'confirmed'])
                ->latest()->first();

        // If not found, create new
        if (!$order) {
            $order = Order::create([
                'user_id'        => auth()->id(),
                'order_number'   => 'ORD-' . now()->format('YmdHis'),
                'payment_method' => $request->payment_method ?? 'cod',
                'payment_status' => 'unpaid',
                'order_status'   => 'pending',
                'subtotal'       => 0,
                'discount'       => 0,
                'shipping'       => 0,
                'total'          => 0,
            ]);
        }

        $subtotal = $order->subtotal ?? 0;

        if (!empty($request->items)) {
            foreach ($request->items as $item) {

                $product = VendorProduct::find($item['id']);
                $variant = $item['variant_id'] ?? null
                    ? ProductVariant::find($item['variant_id'])
                    : null;

                $quantity = $item['qty'] ?? 1;

                $image = optional($variant?->images()->first())->image_path
                    ?? optional($product?->images()->first())->image_path
                    ?? null;

                $itemTotal = $item['price'] * $quantity;
                $subtotal += $itemTotal;

                $order->items()->create([
                    'vendor_product_id'  => $item['id'],
                    'product_variant_id' => $item['variant_id'] ?? null,
                    'name'               => $item['name'] ?? $product->name,
                    'product_slug'       => $product->slug,
                    'image'              => $image,
                    'color'              => $item['color'] ?? optional($variant)->color_name,
                    'size'               => $item['size'] ?? null,
                    'price'              => $item['price'],
                    'quantity'           => $quantity,
                    'total'              => $itemTotal,
                ]);
            }
        }

        // Update order totals
        $order->update([
            'subtotal' => $subtotal,
            'total'    => $subtotal,
        ]);

        return response()->json([
            'status'   => 'success',
            'message'  => 'Order items saved successfully',
            'order_id' => $order->id,
            'subtotal' => $subtotal,
            'total'    => $subtotal,
        ]);

    } catch (\Throwable $e) {
        return response()->json([
            'status'  => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
}







}
