@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container py-5">
  <div class="card shadow-sm border-0 rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="fw-bold text-primary mb-0">
        <i class="bi bi-diagram-3 me-2"></i>All Child Categories
      </h4>
      <a href="{{ route('childcategory.create') }}" class="btn btn-primary rounded-pill ms-auto">
        <i class="bi bi-plus-circle me-1"></i>Add New
      </a>
    </div>

    {{-- Table --}}
    <div class="table-responsive">
      <table id="ChildCategory" class="table table-bordered table-hover align-middle">
        <thead class="table-primary">
          <tr class="text-center">
            <th width="5%">#</th>
            <th><i class="bi bi-tags me-1"></i>Category</th>
            <th><i class="bi bi-diagram-2 me-1"></i>Subcategory</th>
            <th><i class="bi bi-pencil-square me-1"></i>Child Category</th>
            <th><i class="bi bi-calendar me-1"></i>Created At</th>
            <th width="15%"><i class="bi bi-gear me-1"></i>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($childcategories as $index => $child)
          <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $child->category->name ?? '—' }}</td>
            <td>{{ $child->subcategory->name ?? '—' }}</td>
            <td class="fw-semibold">{{ $child->name }}</td>
            <td class="text-muted">{{ $child->created_at->format('d M, Y') }}</td>
            <td class="text-center">
              <a href="{{route('childcategory.edit',$child->id)}}" 
                 class="btn btn-sm btn-outline-primary rounded-pill me-1">
                <i class="bi bi-pencil-square"></i>
              </a>
              <form action="{{route('childcategory.destroy',$child->id)}}" 
                    method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="btn btn-sm btn-outline-danger rounded-pill"
                        onclick="return confirm('Are you sure you want to delete this child category?')">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-4">
              <i class="bi bi-inbox fs-4 d-block mb-2"></i>
              No child categories found.
            </td>
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
            $('#ChildCategory').DataTable({
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
