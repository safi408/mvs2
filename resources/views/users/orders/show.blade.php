@extends('layouts.masterlayout')

@section('content')

<div class="container mx-auto py-6">
    <div class="bg-white shadow rounded p-6">
        <div class="flex items-center mb-4">
            <img src="{{ $order->items->first()->image ?? 'placeholder.jpg' }}" class="w-24 h-24 object-cover rounded mr-4">
            <div>
                <h2 class="text-xl font-bold">Order #{{ $order->order_number }}</h2>
                <span class="text-sm text-gray-500">Status: <span class="font-semibold">{{ ucfirst($order->order_status) }}</span></span>
            </div>
        </div>

```
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <h3 class="font-semibold">Item</h3>
            <p>{{ $order->items->first()->category ?? 'NA' }}</p>
        </div>
        <div>
            <h3 class="font-semibold">Courier</h3>
            <p>{{ $order->items->first()->name ?? 'NA' }}</p>
        </div>
        <div>
            <h3 class="font-semibold">Start Time</h3>
            <p>{{ $order->created_at->format('d F Y, H:i:s') }}</p>
        </div>
        <div>
            <h3 class="font-semibold">Address</h3>
            <p>{{ $order->shipping_address }}</p>
        </div>
    </div>

    <div>
        <ul class="flex border-b mb-4">
            <li class="mr-4">
                <a href="#order-history" class="tab-link font-semibold text-blue-500 border-b-2 border-blue-500">Order History</a>
            </li>
            <li class="mr-4">
                <a href="#item-details" class="tab-link">Item Details</a>
            </li>
            <li class="mr-4">
                <a href="#courier" class="tab-link">Courier</a>
            </li>
            <li>
                <a href="#receiver" class="tab-link">Receiver</a>
            </li>
        </ul>

        <div id="order-history" class="tab-content">
            {{-- @foreach($order->history as $history)
            <div class="flex items-start mb-4">
                <div class="w-6 h-6 border-2 border-blue-500 rounded-full mr-4 mt-1"></div>
                <div>
                    <p class="font-semibold">{{ $history->status }}</p>
                    <p class="text-gray-500 text-sm">{{ $history->created_at->format('d/m/Y H:i') }}</p>
                    @if(isset($history->courier_service))
                    <p>Courier Service: {{ $history->courier_service }}</p>
                    @endif
                    @if(isset($history->tracking_number))
                    <p>Tracking Number: {{ $history->tracking_number }}</p>
                    @endif
                    @if(isset($history->warehouse))
                    <p>Warehouse: {{ $history->warehouse }}</p>
                    @endif
                </div>
            </div>
            @endforeach --}}
        </div>

        <div id="item-details" class="tab-content hidden">
            @foreach($order->items as $item)
            <div class="mb-4">
                <p><strong>Item Name:</strong> {{ $item->name }}</p>
                <p><strong>Price:</strong> ${{ $item->price }}</p>
                <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
            </div>
            @endforeach
        </div>

        <div id="courier" class="tab-content hidden">
            <p><strong>Courier Name:</strong> {{ $order->courier_name ?? 'Na' }}</p>
            <p><strong>Tracking Number:</strong> {{ $order->tracking_number ?? 'Na' }}</p>
            <p><strong>Estimated Delivery:</strong> {{ $order->estimated_delivery ?? 'Na'}}</p>
        </div>

        <div id="receiver" class="tab-content hidden">
            <p><strong>Name:</strong> {{ $order->receiver_name ?? 'Na' }}</p>
            <p><strong>Phone:</strong> {{ $order->receiver_phone ?? 'Na' }}</p>
            <p><strong>Address:</strong> {{ $order->shipping_address ?? 'Na' }}</p>
        </div>
    </div>
</div>
```

</div>

<script>
document.querySelectorAll('.tab-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
        document.querySelectorAll('.tab-link').forEach(l => l.classList.remove('text-blue-500', 'border-b-2', 'border-blue-500'));
        document.querySelector(this.getAttribute('href')).classList.remove('hidden');
        this.classList.add('text-blue-500', 'border-b-2', 'border-blue-500');
    });
});
</script>
@endsection