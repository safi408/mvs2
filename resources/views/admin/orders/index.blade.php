@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('title', 'All Orders')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">All Orders</h1>



    <div class="card shadow-sm">
        <div class="card-body">
            <table id="orderTable" class="table table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
        <td>${{ number_format($order->total, 2) }}</td>
        <td>
           <span class="badge bg-{{ $statusColors[$order->order_status] ?? 'secondary' }}">
              {{ ucfirst($order->order_status) }}
          </span>
        </td>
        <td>
            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-eye"></i> View
            </a>
        </td>
    </tr>
    @endforeach
</tbody>

            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <!-- jQuery must come first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#orderTable').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    search: "🔍 Search:",
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching records found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        previous: "←",
                        next: "→"
                    }
                }
            });
        });
    </script>
@endsection