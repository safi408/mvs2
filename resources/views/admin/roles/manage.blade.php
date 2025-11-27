@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h2 class="mb-3 text-primary">All Roles</h2>
             <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center mb-0">
            <h5 class="mb-0">All Roles</h5>
            <a href="{{route('role.create')}}" class="btn btn-light btn-sm ms-auto">
                <i class="bi bi-plus-circle"></i> Add New Role
            </a>
        </div>

                <div class="card-body p-2">
                    <table id="roleTable" class="table table-striped table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="8%">#</th>
                                <th>Role Name</th>
                                <th width="25%">Created At</th>
                                <th width="20%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $index => $role)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->created_at->format('d M Y, h:i A') }}</td>
                                    <td>


                                        <a href="{{route('roles.grant', $role->id)}}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-key-fill"></i>
                                        </a>

                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-success">
                                             <i class="bi bi-pencil-square"></i>
                                        </a>

                            <form id="delete-role-form-{{ $role->id }}" 
                                    action="{{ route('role.destroy', $role->id) }}" 
                                    method="POST" 
                                    style="display:inline-block;">
                                @csrf
                                @method('DELETE')   <!-- ✅ Ye line add karo -->

                                <button type="button" 
                                        class="btn btn-sm btn-danger"
                                        onclick="confirmDeleteRole({{ $role->id }})">
                                    <i class="bi bi-trash3"></i>
                                </button>
                                </form>

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No roles available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
            $('#roleTable').DataTable({
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