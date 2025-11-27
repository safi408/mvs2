@extends('layouts.masterlayout')

@section('head')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

<style>
.btn.btn-primary.rounded-pill.px-4.ms-end {
    margin-left: 66%;
}
@media screen and (max-width:500px){
    .btn.btn-primary.rounded-pill.px-4.ms-end {
        margin-left: 32%;
    }
}
.color-circle {
    cursor: pointer;
}
</style>

@section('content')
<div class="container py-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="fw-bold mb-0 text-gradient">📦 My Products</h4>
            <a href="{{ route('vendor.product') }}" class="btn btn-primary rounded-pill px-4 ms-end">
                + Add Product
            </a>
        </div>

        <div class="card-body table-responsive">
            <table id="vendorProduct" class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Colors</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <!-- Product Image -->
                        <td>
                            @if($product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" width="60" height="60" class="rounded shadow-sm border">
                            @else
                                <img src="https://via.placeholder.com/60" width="60" height="60" class="rounded shadow-sm border">
                            @endif
                        </td>

                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>

                        <!-- Colors -->
                        <td>
                            @foreach($product->variants as $variant)
                                <span class="d-inline-block rounded-circle border me-1" 
                                      style="width:20px; height:20px; background:{{ $variant->color ?? '#ccc' }}">
                                </span>
                            @endforeach
                        </td>

                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>

                        <td>
                            @if($product->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($product->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>

                        <td>
                            @if($product->status === 'approved')
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $product->id }}">
                                    <i class="bi bi-eye"></i> View
                                </button>

                                <form id="delete-vendorproduct-form-{{ $product->id }}" action="{{ route('vendor.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDeleteVendorProduct({{ $product->id }})">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>

                    <!-- Product View Modal -->
                    <div class="modal fade" id="viewProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow-lg">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title fw-bold">
                                        <i class="bi bi-box-seam me-2"></i>{{ $product->name }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row g-4">
                                        <!-- Left: Images Carousel -->
                                        <div class="col-md-5 text-center border-end">
                                            @if($product->images->count() > 0)
                                                <div id="carouselProduct{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach($product->images as $key => $image)
                                                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                                     class="d-block w-100 rounded shadow-sm border"
                                                                     style="max-height:300px;object-fit:cover;" 
                                                                     alt="Product Image">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @if($product->images->count() > 1)
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduct{{ $product->id }}" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon"></span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselProduct{{ $product->id }}" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon"></span>
                                                        </button>
                                                    @endif
                                                </div>
                                            @else
                                                <img src="https://via.placeholder.com/300" class="rounded border shadow-sm w-100" style="max-height:300px;object-fit:cover;" alt="No Image">
                                            @endif
                                        </div>

                                        <!-- Right: Details -->
                                        <div class="col-md-7">
                                            <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                                            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                                            <p><strong>Stock:</strong> {{ $product->stock }}</p>

                                            <p><strong>Sizes:</strong>
                                                @php
                                                    $variantSizes = $product->variants->pluck('size')->unique()->filter();
                                                @endphp
                                                @if($variantSizes->count())
                                                    @foreach($variantSizes as $size)
                                                        <span class="badge bg-secondary">{{ $size }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </p>

                                            <p><strong>Colors:</strong>
                                                @if($product->variants->count())
                                                    <div class="d-flex flex-wrap align-items-center gap-2 mt-2">
                                                        @foreach($product->variants as $variant)
                                                            <span class="color-circle d-inline-block border rounded-circle"
                                                                  data-image="{{ asset('storage/' . ($variant->image_path ?? $product->images->first()->image_path ?? '')) }}"
                                                                  style="width:25px;height:25px;background:{{ $variant->color ?? '#ccc' }}">
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </p>

                                            <p><strong>Status:</strong>
                                                <span class="badge @if($product->status == 'approved') bg-success @elseif($product->status == 'pending') bg-warning text-dark @else bg-danger @endif">
                                                    {{ ucfirst($product->status) }}
                                                </span>
                                            </p>

                                            <p><strong>Description:</strong></p>
                                            <p class="text-muted small">{!! $product->description ?? 'No description available.' !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="10" class="text-muted">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#vendorProduct').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            search: "🔍 Search:",
            lengthMenu: "Show _MENU_ entries",
            zeroRecords: "No matching records found",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: { previous: "←", next: "→" }
        }
    });
});

// Handle color click for all modals
document.querySelectorAll('.color-circle').forEach(circle => {
    circle.addEventListener('click', function() {
        const modal = this.closest('.modal');
        const mainImage = modal.querySelector('.carousel-item.active img');
        const newImage = this.getAttribute('data-image');
        if(mainImage && newImage) mainImage.src = newImage;
    });
});
</script>
@endsection
