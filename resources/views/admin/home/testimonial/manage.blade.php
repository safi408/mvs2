@extends('layouts.masterlayout')

@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
<style>
  .actions{
    display: flex;
    margin-top: 8px;
    width: 100%;
  }
  .btn{
    height: 27px;
    padding-top: 6px;
  }
</style>

@section('title', 'All Testimonials')

@section('content')
<div class="container-fluid px-4 py-4">
  <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

    <!-- Header -->
    <div class="card-header bg-primary bg-gradient text-white py-3 d-flex justify-content-between align-items-center">
      <h5 class="mb-0 fw-bold d-flex align-items-center">
        <i class="bi bi-chat-square-quote me-2 fs-5"></i> All Testimonials
      </h5>
      <a href="{{route('admin.testimonial.create')}}" class="btn btn-light btn-sm rounded-pill shadow-sm ms-auto">
        <i class="bi bi-plus-circle me-1"></i> Add New Testimonial
      </a>
    </div>

    <!-- Body -->
    <div class="card-body bg-light p-4">
      <div class="table-responsive">
        <table id="Testimonial" class="table table-bordered table-hover align-middle shadow-sm">
          <thead class="table-primary text-center">
            <tr>
              <th>#</th>
              <th>Customer</th>
              <th>Title</th>
              <th>Message</th>
              <th>Rating</th>
              <th>Customer Image</th>
              <th>Product Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($testimonials as $index => $testimonial)
              <tr>
                <td class="text-center fw-bold">{{ $index + 1 }}</td>

                <td>
                  <strong>{{ $testimonial->name }}</strong>
                </td>

                <td>{{ $testimonial->title ?? '—' }}</td>

                <td style="max-width: 250px;">
                  <span class="text-muted small">
                    {{ Str::limit($testimonial->message, 80) }}
                  </span>
                </td>

                <td class="text-center">
                  @for($i = 1; $i <= 5; $i++)
                    @if($i <= $testimonial->rating)
                      <i class="bi bi-star-fill text-warning"></i>
                    @else
                      <i class="bi bi-star text-muted"></i>
                    @endif
                  @endfor
                </td>

                <td class="text-center">
                  @if($testimonial->image)
                    <img src="{{ asset('storage/' . $testimonial->image) }}" 
                         class="rounded-circle border shadow-sm" 
                         width="50" height="50" alt="Customer">
                  @else
                    <span class="badge bg-secondary">No Image</span>
                  @endif
                </td>

                <td class="text-center">
                  @if($testimonial->product_image)
                    <img src="{{ asset('storage/' . $testimonial->product_image) }}" 
                         class="rounded border shadow-sm" 
                         width="50" height="50" alt="Product">
                  @else
                    <span class="badge bg-secondary">No Image</span>
                  @endif
                </td>

                <style>
                  .actions{
                    width: 70px;
                  }
                </style>

            

                <td class="actions">
                  <a href="{{ route('admin.testimonial.edit', $testimonial->id) }}" class="btn btn-sm btn-outline-primary me-1 rounded-pill">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <form id="delete-testimonial-form-{{ $testimonial->id }}"   action="{{ route('admin.testimonial.destroy', $testimonial->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE') 
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill" onclick="confirmDeleteTestimonial({{ $testimonial->id }})">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="10" class="text-center py-4 text-muted">
                  <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                  No testimonials found.
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
            $('#Testimonial').DataTable({
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