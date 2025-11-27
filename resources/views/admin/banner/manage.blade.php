@extends('layouts.masterlayout')
<style>
.table td {
  vertical-align: middle !important;
  text-align: center;
}

/* .btn-sm {
  padding: 5px 12px;
}

.btn-danger {
  height: 29px;
} */

@media screen and (max-width: 500px) {
  .btn-sm {
    padding: 5px 10px;
  }
}
</style>

@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">All Sliders</h5>
    <a href="{{route('banner.create')}}" class="btn btn-primary btn-sm ms-auto">
      <i class="bi bi-plus-circle"></i> Add New Sliders
    </a>
  </div>

  <div class="card-body table-responsive">
    <table id="bannerTable" class="table table-bordered table-striped align-middle">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>Title</th>
          <th>Subtitle</th>
          <th>Button Text</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($banners as $key => $banner)
        <tr>
          <td>{{ $key + 1 }}</td>
          <td>
            @if($banner->image)
              <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner" width="100" height="60" style="object-fit: cover; border-radius: 6px;">
            @else
              <span class="text-muted">No Image</span>
            @endif
          </td>
          <td>{{ $banner->title ?? '-' }}</td>
          <td>{{ $banner->subtitle ?? '-' }}</td>
          <td>{{ $banner->text_button ?? '-' }}</td>
<td class="text-align align-middle">
  @if($banner->status == 'active')
    <form action="{{ route('admin.toggle.banner', $banner->id) }}" method="POST" class="d-inline-block">
      @csrf
      @method('PUT')
      <button type="submit" class="btn btn-success btn-sm px-3">
        Active
      </button>
    </form>
  @else
    <form action="{{ route('admin.toggle.banner', $banner->id) }}" method="POST" class="d-inline-block">
      @csrf
      @method('PUT')
      <button type="submit" class="btn btn-secondary btn-sm px-3">
        Inactive
      </button>
    </form>
  @endif
</td>


          <td>
            <a href="{{route('banner.edit',$banner->id)}}" class="btn btn-sms btn-info">
              <i class="bi bi-pencil"></i>
            </a>
            <form id="delete-banner-form-{{ $banner->id }}"
      action="{{ route('delete.banner', $banner->id) }}"
      method="POST"
      style="display:inline-block;"
      onclick="confirmDeleteBanner({{ $banner->id }})">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-sm btn-danger">
        <i class="bi bi-trash"></i>
    </button>
</form>

          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center text-muted">No banners found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
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
            $('#bannerTable').DataTable({
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