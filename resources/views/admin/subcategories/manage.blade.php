@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container mt-4">

    {{-- Success / Error Messages --}}
    {{-- @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif --}}

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-diagram-3 me-1"></i> SubCategories</h5>
            <a href="{{route('subcategory.create')}}" class="btn btn-light btn-sm ms-auto">
                <i class="bi bi-plus-circle"></i> Add New
            </a>
        </div>

        <div class="card-body p-2">
            <div class="table-responsive">
                <table id="subcategoryTable" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>Description</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subcategories as $index => $subcategory)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="badge bg-info">{{ $subcategory->category->name ?? 'N/A' }}</span></td>
                                <td><i class="bi bi-folder2-open text-primary me-1"></i> {{ $subcategory->name }}</td>
                                <td>{{ $subcategory->description }}</td>
                                <td class="text-end">
                                    <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="delete-subcategory-form-{{ $subcategory->id }}" 
                                    action="{{ route('subcategories.destroy', $subcategory->id) }}" 
                                    method="POST" 
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeleteSubcategory({{ $subcategory->id }})">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                    No SubCategories Found
                                </td>
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
            $('#subcategoryTable').DataTable({
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