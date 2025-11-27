@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Brand List</h2>
        <a href="{{ route('admin.about.create') }}" class="btn btn-primary">Add Brand</a>
    </div>

    <div class="table-responsive">
        <table id="brandTable" class="table table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Logo</th>
                    <th>Brand Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $index => $brand)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($brand->logo)
                                <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}" class="img-thumbnail" style="height:40px; width:auto;">
                            @else
                                <span class="text-muted">No Logo</span>
                            @endif
                        </td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form id="delete-brand-form-{{ $brand->id }}"  action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmBrandDelete({{ $brand->id }})">Delete</button>
                            </form>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- SweetAlert for Confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('#brandTable').DataTable({
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

        // 🔴 Delete confirmation function
        function confirmBrandDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this Brand?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-brand-form-' + id).submit();
                }
            });
        }
    </script>
@endsection