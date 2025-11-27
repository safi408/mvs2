@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container py-4">

  <div class="card shadow-sm rounded-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Shop Collections</h5>
      <a href="{{route('admin.shop.collection')}}" class="btn btn-light btn-sm ms-auto">
        <i class="bi bi-plus-circle"></i> Add New
      </a>
    </div>

    <div class="card-body p-4">
      <table id="shopTable" class="table table-bordered table-striped align-middle text-center">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Button Text</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($collections as $index => $collection)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $collection->title }}</td>
            <td>{{ $collection->subtitle }}</td>
            <td>{{ $collection->button_text }}</td>
            <td>
 
                @if($collection->image)
  <img src="{{ asset('storage/'.$collection->image) }}" 
       alt="{{ $collection->title }}" width="80" class="rounded shadow-sm border">
@else
  <span class="text-muted">No Image</span>
@endif


            </td>
            <td>
              <a href="{{route('admin.edit.shop',$collection->id)}}" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil-square"></i>
              </a>
              <form id="delete-shop-form-{{ $collection->id }}" action="{{route('admin.delete.shop',$collection->id)}}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeleteShop({{ $collection->id }})">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-muted py-4">No collections found.</td>
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
            $('#shopTable').DataTable({
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