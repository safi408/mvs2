@extends('layouts.masterlayout')
@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
<style>
    .btn.btn-primary.rounded-pill.px-4.ms-end{
        margin-left: 66%;
    }
    @media screen and (max-width:500px){
        body{
        }
    .btn.btn-primary.rounded-pill.px-4.ms-end{
        margin-left: 32%;
    }
    }
</style>
@section('content')
<div class="container py-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="fw-bold mb-0 text-gradient">📦 My Products</h4>
            <a href="{{route('admin.create.product')}}" class="btn btn-primary rounded-pill px-4 ms-end">
                + Add Product
            </a>
        </div>

        <div class="card-body table-responsive">
            <table id="vendorProduct" class="table  table-bordered align-middle text-center">
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
    @if($product->variants->count() && $product->variants->first()->images->count())
        <img src="{{ asset('storage/' . $product->variants->first()->images->first()->image_path) }}"
             class="rounded border shadow-sm"
             width="60" height="60" alt="Product Image">
    @else
        <img src="https://via.placeholder.com/60"
             class="rounded border shadow-sm"
             width="60" height="60" alt="No Image">
    @endif
</td>





                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>




                            <!-- Variants (colors) -->
                            <td>
                                @foreach($product->variants as $variant)
                                    <span class="d-inline-block rounded-circle border" 
                                          style="width:20px; height:20px; background:{{ $variant->color ?? '#ccc' }}">
                                    </span>
                                @endforeach
                            </td>

                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>

                            <td>
                                @if($product->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($product->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>



        @php
        $vendorProduct = \App\Models\VendorProduct::where('vendor_id', $product->id)->first();
        @endphp


<td>
    @if ($product->status === 'pending')
        <span class="badge bg-warning text-dark">Pending</span>
    @elseif ($product->status === 'rejected')
        <span class="badge bg-danger">Rejected</span>

    @elseif ($product->status === 'approved')

            <!-- ✅ View Button -->
        <button class="btn btn-sm btn-info me-1" 
                data-bs-toggle="modal" 
                data-bs-target="#viewProductModal{{ $product->id }}">
            <i class="bi bi-eye"></i>
        </button>
               <a href="{{route('products.edit', $product->id)}}" class="btn btn-sm btn-warning me-1">
            <i class="bi bi-pencil-square"></i>
        </a>
        <form id="delete-product-form-{{ $product->id }}"  action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDeleteProduct({{ $product->id }})">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    @else
        <span class="badge bg-secondary">Unknown</span>
    @endif
</td>





<!-- 🖼️ View Product Modal -->
<div class="modal fade" id="viewProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="viewProductModalLabel{{ $product->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-bold" id="viewProductModalLabel{{ $product->id }}">
            {{ $product->name }}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-5 text-center">
            @if($product->images->count())
              <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                   class="rounded border shadow-sm mb-2" width="200" height="200">
              <div class="d-flex flex-wrap justify-content-center gap-2 mt-2">
                @foreach($product->images as $img)
                  <img src="{{ asset('storage/' . $img->image_path) }}" class="rounded border" width="60" height="60">
                @endforeach
              </div>
            @else
              <img src="https://via.placeholder.com/200" class="rounded border">
            @endif
          </div>

          <div class="col-md-7">
            <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
            <p><strong>ChildCategory:</strong> {{ $product->childcategory->name ?? 'N/A' }}</p>
            <p><strong>Brands:</strong> {{ $product->brand->name ?? 'N/A' }}</p>
            <p><strong>Base Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>

            <p><strong>Sizes:</strong> 
            


@php
    // Collect all sizes from variants
    $variantSizes = $product->variants->pluck('size') // 'sizes' column stores JSON array
        ->filter() // remove empty/null
        ->map(function($sizes) {
            // If sizes is JSON array, flatten it
            if(is_array($sizes)) return $sizes;
            // If stored as comma-separated string
            return explode(',', $sizes);
        })
        ->flatten() // flatten all arrays into one
        ->filter() // remove empty values
        ->map(function($size) {
            // Remove unwanted characters like ] [ " ' etc. and trim spaces
            return trim(str_replace(['[', ']', '"', "'"], '', $size));
        })
        ->unique(); // remove duplicates
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
              @foreach($product->variants as $variant)
                <span class="d-inline-block border rounded-circle me-1" 
                      style="width:20px;height:20px;background:{{ $variant->color ?? '#ccc' }}"></span>
              @endforeach
            </p>

            <p><strong>Status:</strong> 
              <span class="badge 
                @if($product->status == 'approved') bg-success 
                @elseif($product->status == 'pending') bg-warning 
                @else bg-danger @endif">
                {{ ucfirst($product->status) }}
              </span>
            </p>
            <p><strong>Description:</strong></p>
<div class="border rounded p-0 bg-light" style="max-height: 150px; overflow-y: auto;">
  {!! Str::limit(strip_tags($product->description), 80) !!}
</div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>





                        </tr>
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
    <!-- jQuery must come first -->
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
                    paginate: {
                        previous: "←",
                        next: "→"
                    }
                }
            });
        });
    </script>
@endsection