@extends('layouts.masterlayout')

@section('title', 'Order Details')

@section('content')

<div class="container mt-5">

```
<h1 class="mb-4">Order #{{ $order->order_number }}</h1>

{{-- Customer Info --}}
<div class="row mb-4">
    <div class="col-md-6">
        <h5>Customer Information</h5>
        <ul class="list-group">
            <li class="list-group-item"><strong>Name:</strong> {{ $order->customer }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $order->email }}</li>
            <li class="list-group-item"><strong>Phone:</strong> {{ $order->phone }}</li>
            <li class="list-group-item"><strong>Address:</strong> 
                {{ $order->street }}, {{ $order->city }}, {{ $order->state }}, {{ $order->country }}, {{ $order->postal_code }}
            </li>
        </ul>
    </div>

    {{-- Order Info --}}
    <div class="col-md-6">
        <h5>Order Information</h5>
        <ul class="list-group">
            <li class="list-group-item"><strong>Status:</strong> 
                <span class="badge bg-{{ $order->order_status=='pending'?'warning':($order->order_status=='completed'?'success':'danger') }}">
                    {{ ucfirst($order->order_status) }}
                </span>
            </li>

            <li class="list-group-item"><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</li>
            <li class="list-group-item"><strong>Payment Status:</strong> 
                @if($order->payment_method == 'cod')
                    <span class="badge bg-{{ $order->payment_status == 'pending' ? 'warning' : ($order->payment_status == 'paid' ? 'success' : 'danger') }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                @else
                    @php
                        $payment = $order->payment; // relation to payments table
                    @endphp
                    @if($payment && $payment->payment_status == 'paid')
                        <span class="badge bg-success">Paid ({{ ucfirst($order->payment_method) }})</span>
                    @elseif($payment)
                        <span class="badge bg-danger">Failed</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                @endif
            </li>

            <li class="list-group-item"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</li>
        </ul>
    </div>
</div>

{{-- Order Items --}}
<div class="card mb-4">
    <div class="card-header bg-primary text-white">Order Items</div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/'. $item->image) }}" alt="{{ $item->name }}" style="width:60px; height:60px; object-fit:cover; border-radius:5px;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $item->color ?? '-' }}</td>
                    <td>
                        @if(is_array($item->size))
                            {{ implode(', ', $item->size) }}
                        @else
                            {{ $item->size ?? '-' }}
                        @endif
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Totals --}}
@php
    $calculatedSubtotal = $order->items->sum(function($item) {
        return $item->price * $item->quantity;
    });
    $calculatedDiscount = $order->discount ?? 5;
    $calculatedShipping = $order->shipping ?? 5;
    $calculatedTotal = $calculatedSubtotal - $calculatedDiscount + $calculatedShipping;
@endphp

<div class="row">
    <div class="col-md-4 offset-md-8">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between">
                <strong>Subtotal:</strong> <span>${{ number_format($calculatedSubtotal, 2) }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Discount:</strong> <span>${{ number_format($calculatedDiscount, 2) }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Shipping:</strong> <span>${{ number_format($calculatedShipping, 2) }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Total:</strong> <span>${{ number_format($calculatedTotal, 2) }}</span>
            </li>
        </ul>
    </div>
</div>

<a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-4">Back to Orders</a>
```

</div>
@endsection
        {{-- // 'payment_method' => $request->payment_method ?? 'cod',
        // 'payment_status' => $request->payment_method === 'cod' ? 'unpaid' : 'paid',
        // 'order_status'   => $request->payment_method === 'cod' ? 'pending' : 'processing', --}}