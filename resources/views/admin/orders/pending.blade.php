@extends('layouts.masterlayout')

@section('title', 'Pending Orders')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold text-primary">
            <i class="bi bi-hourglass-split me-2"></i> Pending Orders
        </h1>
        <span class="badge bg-warning fs-6">
            {{ count($orders ?? []) }} Pending
        </span>
    </div>

    @php
        $orders = [
            ['id'=>1, 'customer'=>'Alice Johnson', 'total'=>120.50, 'date'=>'2025-11-12'],
            ['id'=>4, 'customer'=>'Diana Smith', 'total'=>50.00, 'date'=>'2025-11-13'],
            ['id'=>7, 'customer'=>'Mark Wilson', 'total'=>89.99, 'date'=>'2025-11-10'],
        ];
    @endphp

    @if(count($orders) > 0)
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col"><i class="bi bi-person-circle me-1"></i>Customer</th>
                            <th scope="col"><i class="bi bi-calendar-event me-1"></i>Date</th>
                            <th scope="col" class="text-end"><i class="bi bi-cash-stack me-1"></i>Total</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="text-center fw-semibold">{{ $order['id'] }}</td>
                            <td>{{ $order['customer'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($order['date'])->format('d M, Y') }}</td>
                            <td class="text-end">${{ number_format($order['total'], 2) }}</td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-clock me-1"></i> Pending
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.orders.show', $order['id'] ?? '#') }}" 
                                   class="btn btn-sm btn-outline-primary rounded-pill">
                                   <i class="bi bi-eye me-1"></i> View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info text-center shadow-sm">
        <i class="bi bi-info-circle me-1"></i> No pending orders found.
    </div>
    @endif
</div>

<style>
.table th {
    font-weight: 600;
}
.table-hover tbody tr:hover {
    background-color: #f8f9fa;
    transition: 0.2s ease-in-out;
}
.badge {
    font-size: 0.85rem;
}
</style>
@endsection
