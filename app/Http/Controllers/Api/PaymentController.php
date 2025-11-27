<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    // old controller //
    // public function storePayment(Request $request)
    // {
    //     // ✅ Validation
    //     $validator = \Validator::make($request->all(), [
    //         'order_id'        => 'required|exists:orders,id',
    //         'payment_method'  => 'required|in:cod,stripe,paypal',
    //         'transaction_id'  => 'nullable|string',
    //         'payment_response'=> 'nullable|array',
    //         'card_number'     => 'nullable|required_if:payment_method,stripe,paypal|string', // Last 4 digits
    //         'card_name'       => 'nullable|required_if:payment_method,stripe,paypal|string',
    //         'card_date'       => 'nullable|required_if:payment_method,stripe,paypal|date',
    //         'cvv'             => 'nullable|required_if:payment_method,stripe,paypal|string|max:4', // CVV 3–4 digits
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     // ✅ Get order
    //     $order = Order::findOrFail($request->order_id);

    //     // 🔹 Payment status logic
    //     if ($request->payment_method === 'cod') {
    //         $paymentStatus = 'unpaid';
    //         $orderStatus   = 'pending';
    //     } else {
    //         $paymentStatus = 'paid';
    //         $orderStatus   = 'processing';
    //     }

    //     // 🔹 Create Payment (amount = order total)
    //     $payment = Payment::create([
    //         'order_id'         => $order->id,
    //         'payment_method'   => $request->payment_method,
    //         'payment_status'   => $paymentStatus,
    //         'transaction_id'   => $request->transaction_id ?? null,
    //         'payment_response' => $request->payment_response ?? null,
    //         'amount'           => $order->total,
    //         'card_number'      => $request->card_number ?? null,
    //         'card_name'        => $request->card_name ?? null,
    //         'card_date'        => $request->card_date ?? null,
    //         'cvv'              => $request->cvv ?? null,
    //     ]);

    //     // 🔹 Update Order payment status
    //     $order->update([
    //         'payment_status' => $paymentStatus,
    //         'order_status'   => $orderStatus,
    //     ]);

    //     // 🔹 Return response
    //     return response()->json([
    //         'status'  => 'success',
    //         'message' => 'Payment stored successfully',
    //         'payment' => $payment,
    //         'order'   => $order
    //     ]);
    // }


    public function storePayment(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'payment_method'  => 'required|in:cod,stripe,paypal',
        'transaction_id'  => 'nullable|string',
        'payment_response'=> 'nullable|array',
        'card_number'     => 'nullable|required_if:payment_method,stripe,paypal|string',
        'card_name'       => 'nullable|required_if:payment_method,stripe,paypal|string',
        'card_date'       => 'nullable|required_if:payment_method,stripe,paypal|date',
        'cvv'             => 'nullable|required_if:payment_method,stripe,paypal|string|max:4',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);
    }

    try {

        // 🔹 Get existing active order OR create new
        $order = Order::where('user_id', auth()->id())
                ->whereIn('order_status', ['pending', 'processing', 'confirmed'])
                ->latest()->first();

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

        // 🔹 Payment status
        $paymentStatus = $request->payment_method === 'cod' ? 'unpaid' : 'paid';
        $orderStatus   = $request->payment_method === 'cod' ? 'pending' : 'processing';

        // 🔹 Create Payment
        $payment = Payment::create([
            'order_id'         => $order->id,
            'payment_method'   => $request->payment_method,
            'payment_status'   => $paymentStatus,
            'transaction_id'   => $request->transaction_id,
            'payment_response' => $request->payment_response,
            'amount'           => $order->total,
            'card_number'      => $request->card_number,
            'card_name'        => $request->card_name,
            'card_date'        => $request->card_date,
            'cvv'              => $request->cvv,
        ]);

        // 🔹 Update Order
        $order->update([
            'payment_method' => $request->payment_method,
            'payment_status' => $paymentStatus,
            'order_status'   => $orderStatus,
        ]);

        return response()->json([
            'status'   => 'success',
            'message'  => 'Payment stored successfully',
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'payment' => $payment,
        ]);

    } catch (\Throwable $e) {
        return response()->json([
            'status'  => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
}



}
