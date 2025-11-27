@extends('layouts.masterlayout')

@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        /* make the first row of each category visually distinct */
        .category-first-row td {
            background-color: #f8f9fa; /* light grey similar to table-secondary */
            font-weight: 600;
            color: #0d6efd; /* bootstrap primary */
        }
        /* small visual hint for empty category cells */
        .category-empty {
            color: transparent;
            user-select: none;
        }
    </style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary fw-bold">FAQs List</h3>
        <a href="{{ route('admin.faq.create') }}" class="btn btn-success btn-sm shadow-sm">+ Add FAQ</a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table id="faqTable" class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" style="width:6%;">#</th>
                    <th style="width:18%;">Category</th>
                    <th style="width:28%;">Question</th>
                    <th style="width:36%;">Answer</th>
                    <th class="text-center" style="width:12%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $catIndex = 1;
                    $grouped = $faqs->groupBy('category');
                @endphp

                @forelse($grouped as $category => $faqsByCategory)
                    @foreach($faqsByCategory as $faqIndex => $faq)
                        <tr @if($faqIndex === 0) class="category-first-row" @endif>
                            {{-- Serial number: show category number only on first row of group --}}
                            @if($faqIndex === 0)
                                <td class="text-center fw-bold">{{ $catIndex }}</td>
                            @else
                                <td class="text-center category-empty">-</td>
                            @endif

                            {{-- Category name only on first row of group; otherwise empty but present --}}
                            @if($faqIndex === 0)
                                <td class="fw-bold text-primary">{{ $category }}</td>
                            @else
                                <td class="category-empty">{{ $category }}</td>
                            @endif

                            {{-- Question and Answer always present --}}
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>

                            {{-- Actions --}}
                            <td class="text-center">
                                <a href="{{route('admin.faq.edit2',$faq->id)}}" class="btn btn-sm btn-warning me-1">Edit</a>
                                <form id="delete-faq-form-{{ $faq->id }}" action="{{route('faq.destroy',$faq->id)}}" method="POST" class="d-inline-block" onclick="confirmFaqDelete({{ $faq->id }})">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @php $catIndex++; @endphp
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">No FAQs found.</td>
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
            $('#faqTable').DataTable({
                responsive: true,
                autoWidth: false,
                // keep ordering enabled if you like, but category visual rows are static rows
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
