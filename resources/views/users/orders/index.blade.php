@extends('layouts.masterlayout')
@section('content')
 {{-- @foreach ($orders as $order)
    <h3>Order #{{ $order->order_number }}</h3>

    @foreach ($order->items as $item)
        <p>{{ $item->price }} x {{ $item->quantity }}</p>
    @endforeach
@endforeach --}}
<style>
    .btn{
    background: black;
    color: white;
    transition: all 0.3s ease-in-out;
    padding: 10px 20px;
    border-radius: 0px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 16px;
    line-height: 26px;
    font-weight: 600;
    text-transform: capitalize;
    border: 1px solid black;
    position: relative;
    overflow: hidden;
    }
    .btn::after:hover{
        transform-origin: bottom center; */
        transform: skewY(9.3deg) scaleY(2);
    }
    .btn::after{
    content: "";
    position: absolute;
    bottom: -50%;
    width: 102%;
    height: 100%;
    background-color: var(--white);
    transform-origin: bottom center;
    transition: transform 600ms 
    cubic-bezier(0.48, 0, 0.12, 1);
    transform: skewY(9.3deg) scaleY(0);
    z-index: 1;
    }
</style>
<table class="table py-4">
    <thead>
        <tr>
            <th>Order#</th>
            <th>Date</th>
            <th>Status</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        @foreach($order->items as $item)
            <tr>
                <td>#{{ $order->order_number }}</td>
                <td>{{ $order->created_at->format('F d, Y') }}</td>
                <td>{{ ucfirst($order->order_status) ?? 'NA' }}</td>
                <td>{{ $item->price }} for {{ $item->quantity }} Items</td>
                <td><a href="{{route('orders.show',$order->id)}}" class="btn">View</a></td>
                
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>

@endsection