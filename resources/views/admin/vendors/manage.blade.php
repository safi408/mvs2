@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="bi bi-shop me-2"></i> Manage Vendors Stores</h2>
        <a href="{{route('vendor.list')}}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Vendor
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="vendorTable" class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Store</th>
                            <th>Owner</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Commission</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vendors as $vendor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($vendor->store_logo)
                                            <img src="{{ asset('storage/'.$vendor->store_logo) }}" alt="logo" class="rounded me-2" width="40" height="40">
                                        @else
                                            <i class="bi bi-image text-muted fs-4 me-2"></i>
                                        @endif
                                        <div>
                                            <strong>{{ $vendor->store_name }}</strong><br>
                                            <small class="text-muted">{{ $vendor->store_slug }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $vendor->user->name ?? 'N/A' }}</td>
                                <td>{{ $vendor->phone ?? '-' }}</td>
                                <td>{{ $vendor->city ?? '-' }}</td>
                                <td>
                                    @if($vendor->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($vendor->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Blocked</span>
                                    @endif
                                </td>
                                <td>{{ $vendor->commission_rate ? $vendor->commission_rate.'%' : '-' }}</td>
                                <td>
                                    <a href="{{route('vender.view', $vendor->id)}}" class="btn btn-sm btn-info me-1">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{--  Activate / Block Buttons --}}
{{--  Activate / Block Buttons --}}
@if($vendor->status === 'active')
    <a href="{{ route('admin.vendor.status', ['id' => $vendor->id, 'status' => 'blocked']) }}"
       class="btn btn-sm btn-danger me-1 confirm-action"
       data-message="Are you sure you want to block this store?"
       data-action="block">
        <i class="bi bi-lock-fill"></i> Block
    </a>
@elseif($vendor->status === 'blocked' || $vendor->status === 'pending')
    <a href="{{ route('admin.vendor.status', ['id' => $vendor->id, 'status' => 'active']) }}"
       class="btn btn-sm btn-success me-1 confirm-action"
       data-message="Are you sure you want to activate this store?"
       data-action="activate">
        <i class="bi bi-unlock-fill"></i> Activate
    </a>
@endif





            <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-sm btn-warning me-1">
                <i class="bi bi-pencil"></i>
            </a>
            <form id="delete-vendor-form-{{ $vendor->id }}" action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-danger"
                        onclick="confirmVendorDelete({{ $vendor->id }})">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </td>
    </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">No vendors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


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
            $('#vendorTable').DataTable({
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