@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">All Blogs</h3>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Blog
        </a>
    </div>

    {{-- ✅ Blog Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">
            <table id="blogTable" class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publish Date</th>
                        <th>Description</th>
                        <th>Tags</th> {{-- 🏷 Added Tags Column --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $index => $blog)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            {{-- 🖼 Blog Image --}}
                            <td>
                                <img src="{{ asset('storage/' . $blog->image_2) }}" 
                                     alt="{{ $blog->title }}" 
                                     style="width: 70px; height: 60px; object-fit: cover;" 
                                     class="rounded">
                            </td>

                            {{-- 📝 Title --}}
                            <td>
                                <a href="{{ route('admin.view.blog', $blog->id) }}" class="fw-bold text-dark text-decoration-none">
                                    {{ $blog->title }}
                                </a>
                            </td>

                            {{-- ✍️ Author --}}
                            <td>{{ $blog->author ?? 'Unknown' }}</td>

                            {{-- 📅 Publish Date --}}
                            <td>{{ $blog->publish_date ? date('d M Y', strtotime($blog->publish_date)) : 'N/A' }}</td>

                            {{-- 🧾 Description (shortened) --}}
                            <td>{!! Str::limit(strip_tags($blog->description), 10) !!}</td>

                                   {{-- 🏷 Tags Column --}}
            <td>
                @if($blog->tags)
                    @foreach(json_decode($blog->tags, true) as $tag)
                        <span class="badge bg-info text-dark me-1">{{ $tag }}</span>
                    @endforeach
                @else
                    <span class="text-muted">No Tags</span>
                @endif
            </td>

                            {{-- ⚙️ Actions --}}
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    {{-- ✏️ Edit --}}
                                    <a href="{{ route('admin.edit.blog', $blog->id) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       data-bs-toggle="tooltip" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- 🗑️ Delete --}}
                                    <form id="delete-blog-form-{{ $blog->id }}" 
                                          action="{{ route('admin.blog.delete', $blog->id) }}" 
                                          method="POST" 
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                onclick="confirmDeleteBlog({{ $blog->id }})"
                                                class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="tooltip" 
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No blogs found. 
                                <a href="{{ route('admin.blog.create') }}">Add one now!</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- 🔥 JS for Delete Confirmation --}}
<script>
function confirmDeleteBlog(id) {
    if (confirm("Are you sure you want to delete this blog?")) {
        document.getElementById('delete-blog-form-' + id).submit();
    }
}
</script>
@endsection
@section('scripts')
    <!-- jQuery must come first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#blogTable').DataTable({
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