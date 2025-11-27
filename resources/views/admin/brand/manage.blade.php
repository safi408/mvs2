@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
            <div>
                <i class="bi bi-list-ul"></i> All Brands
            </div>
            <a href="{{ route('admin.productbrand.create') }}" class="btn btn-sm btn-light fw-semibold ms-auto">
                <i class="bi bi-plus-circle me-1"></i> Add New Brand
            </a>
        </div>

        <div class="card-body table-responsive">
            <table id="brandTable" class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Brand Name</th>
                        <th>Logo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($brands as $key => $brand)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            @if($brand->logo)
                                <img src="{{ asset('storage/'.$brand->logo) }}" width="60" class="img-thumbnail rounded-3">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.productbrand.edit',$brand->id)}}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form id="delete-productbrand-form-{{ $brand->id }}"  action="{{route('admin.productbrand.delete',$brand->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmProductBrandDelete({{ $brand->id }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No Brands Found</td>
                    </tr>
                    @endforelse
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
    </script>
@endsection
