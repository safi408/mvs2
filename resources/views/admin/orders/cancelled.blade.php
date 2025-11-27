@extends('layouts.masterlayout')

@section('title', 'Cancelled Orders')

@section('content')
<h1>Cancelled Orders</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $orders = [
                ['id'=>3, 'customer'=>'Charlie', 'total'=>200],
            ];
        @endphp

        @foreach($orders as $order)
        <tr>
            <td>{{ $order['id'] }}</td>
            <td>{{ $order['customer'] }}</td>
            <td>${{ $order['total'] }}</td>
            <td><a href="#" class="btn btn-info btn-sm">View</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
