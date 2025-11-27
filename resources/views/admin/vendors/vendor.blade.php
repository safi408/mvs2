@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')

<div class="container my-4">
  <div class="card shadow-sm">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i>Vendor Users</h5>
    </div>

    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="table-responsive">
        <table id="vendorTable" class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th class="text-center" style="width:60px;">#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              {{-- <th>City</th> --}}
              <th class="text-center" style="width:170px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $i => $user)
              <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/'.$user->image) }}" alt="avatar" class="rounded-circle me-2" style="width:36px; height:36px; object-fit:cover;">
                    <div>
                      <div class="fw-semibold">{{ $user->name }}</div>
                    </div>
                  </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? '-' }}</td>
                {{-- <td>{{ $user->city ?? '-' }}</td> --}}

                <td class="text-center">


@php
    $vendor = App\Models\Vendor::where('user_id', $user->id)->first();
@endphp

@if($vendor)
    @if($vendor->status == 'active')
        <button type="button" 
                class="btn btn-sm btn-success me-1" disabled
                title="Vendor already active for {{ $user->name }}">
            <i class="bi bi-check-circle me-1"></i> Active Vendor
        </button>
    @elseif($vendor->status == 'pending')
        <button type="button" 
                class="btn btn-sm btn-warning me-1" disabled
                title="Vendor pending approval for {{ $user->name }}">
            <i class="bi bi-hourglass-split me-1"></i> Pending Approval
        </button>
    @elseif($vendor->status == 'blocked')
        <button type="button" 
                class="btn btn-sm btn-danger me-1" disabled
                title="Vendor blocked for {{ $user->name }}">
            <i class="bi bi-slash-circle me-1"></i> Blocked Vendor
        </button>
    @else
        <button type="button" 
                class="btn btn-sm btn-secondary me-1" disabled
                title="Unknown vendor status for {{ $user->name }}">
            <i class="bi bi-question-circle me-1"></i> Unknown Status
        </button>
    @endif
@else
    <form action="{{ route('vendor.create', $user->id) }}" method="GET" class="d-inline">
        @csrf
        <button type="submit"
                class="btn btn-sm btn-primary me-1"
                title="Create Vendor for {{ $user->name }}">
            <i class="bi bi-shop me-1"></i> Create Store
        </button>
    </form>
@endif






                  <!-- Optional: View User -->
                  {{-- <a href="" class="btn btn-sm btn-outline-secondary" title="View user">
                    <i class="bi bi-eye"></i>
                  </a> --}}
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-4">
                  <div class="text-muted">No users found with <code></code>.</div>
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
<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<script>
//     $(document).ready(function() {
//            // Summernote
//     $('#summernote').summernote({
//         placeholder: 'Write Store description here...',
//         tabsize: 2,
//         height: 200,
//         toolbar: [
//             ['style', ['style']],
//             ['font', ['bold','italic','underline','clear']],
//             ['color', ['color']],
//             ['para', ['ul','ol','paragraph']],
//             ['insert', ['link','picture']],
//             ['view', ['fullscreen','codeview','help']]
//         ]
//     });
//     });
// </script>
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