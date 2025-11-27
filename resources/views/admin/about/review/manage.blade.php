@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Customer Reviews</h3>
        <a href="{{ route('admin.about.customer.review') }}" class="btn btn-primary">Add Review</a>
    </div>



    <table id="reviewTable" class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Title</th>
                <th>Message</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $key => $review)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $review->name }}</td>
                    <td>{{ $review->title ?? '-' }}</td>
                    <td>{{ Str::limit($review->message, 80) }}</td>
                    <td>
                        @for($i = 0; $i < $review->rating; $i++)
                            ⭐
                        @endfor
                    </td>
                   <td>
    <!-- Edit Button -->
    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning btn-sm">
        <i class="bi bi-pencil-square me-1"></i>
    </a>

    <!-- Delete Button -->
    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">
            <i class="bi bi-trash3 me-1"></i>
        </button>
    </form>
</td>

                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted">No reviews found</td></tr>
            @endforelse
        </tbody>
    </table>
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
            $('#reviewTable').DataTable({
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
        function confirmContactDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this contact?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-contact-form-' + id).submit();
                }
            });
        }
    </script>
@endsection