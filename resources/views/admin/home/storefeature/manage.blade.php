@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container py-4">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">All Store Features</h5>
      <a href="{{ route('admin.feature.create') }}" class="btn btn-light btn-sm ms-auto">
        <i class="bi bi-plus-circle"></i> Add New 
      </a>
    </div>



      @if($features->count() > 0)
        <div class="table-responsive">
          <table id="Features" class="table table-bordered align-middle">
            <thead class="table-light">
              <tr>
                <th width="60">#</th>
                <th>Icon</th>
                <th>Title</th>
                <th>Description</th>
                <th width="150" class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($features as $key => $feature)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td><i class="bi {{ $feature->icon }} fs-4"></i></td>
                  <td>{{ $feature->title }}</td>
                  <td>{{ $feature->description }}</td>
                  <td class="text-center">
                    <a href="{{route('feature.edit',$feature->id)}}" class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <form id="delete-feature-form-{{ $feature->id }}"   action="{{route('delete.feature',$feature->id)}}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeleteFeature({{ $feature->id }})">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="alert alert-info text-center mb-0">
          No features found. <a href="{{ route('admin.feature.create') }}">Add one now</a>.
        </div>
      @endif
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
            $('#Features').DataTable({
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
