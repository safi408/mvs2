@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container mt-4">

    {{-- Flash Messages
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i> {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif --}}

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Categories</h5>
            <a href="{{route('category.create')}}" class="btn btn-light btn-sm ms-auto">
                <i class="bi bi-plus-circle"></i> Add New
            </a>
        </div>

        <div class="card-body">
            <table id="categoryTable" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th style="width: 150px;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $key => $category)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ ucfirst($category->name) }}</td>
                             <td>
                               @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="rounded-circle shadow" height="40" width="40">
                                @else
                                     <span class="text-muted">No Image</span>
                                @endif
                             </td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td><span class="badge bg-secondary">{{ $category->slug }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                 <form id="delete-form-{{ $category->id }}" 
                            action="{{ route('categories.destroy', $category->id) }}" 
                            method="POST" 
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $category->id }})">
                                <i class="bi bi-trash3"></i>
                            </button>
                            </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No categories found</td>
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
            $('#categoryTable').DataTable({
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