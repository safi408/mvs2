@extends('layouts.masterlayout')

@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3 class="fw-bold mb-0">🛍️ Vendor Products</h3>
        </div>

        <div class="card-body">
            <table id="vendorProduct" class="table align-middle table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Vendor</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($product->images->count() > 0)
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                         width="60" height="60" class="rounded shadow-sm border">
                                @else
                                    <img src="https://via.placeholder.com/60" width="60" height="60" class="rounded shadow-sm border">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->vendor->store_name ?? 'N/A' }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>

                            <td>
                                @if($product->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($product->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>

<td class="text-center">

    <!-- If product is pending -->
    @if($product->status == 'pending')
        <!-- Approve -->
        <form action="{{ route('admin.products.approve', $product->id) }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-success">
                <i class="bi bi-check-circle"></i> Approve
            </button>
        </form>

        <!-- Reject -->
        <form action="{{ route('admin.products.reject', $product->id) }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-danger">
                <i class="bi bi-x-circle"></i> Reject
            </button>
        </form>

             <!-- View Button -->
<button class="btn btn-sm btn-info text-white"
        data-bs-toggle="modal"
        data-bs-target="#viewVendorProduct{{ $product->id }}">
    <i class="bi bi-eye"></i> View
</button>


    @else

            <!-- Approve -->
        <form action="{{ route('admin.products.approve', $product->id) }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-success">
                <i class="bi bi-check-circle"></i> Approve
            </button>
        </form>

                <!-- Reject -->
        <form action="{{ route('admin.products.reject', $product->id) }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-danger">
                <i class="bi bi-x-circle"></i> Reject
            </button>
        </form>
     <!-- View Button -->
<button class="btn btn-sm btn-info text-white"
        data-bs-toggle="modal"
        data-bs-target="#viewVendorProduct{{ $product->id }}">
    <i class="bi bi-eye"></i> View
</button>

    @endif

</td>


<!-- 🖼️ View Vendor Product Modal -->
<div class="modal fade" id="viewVendorProduct{{ $product->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title fw-bold">{{ $product->name }}</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row">
          <!-- ✅ Left: Product Images -->
          <div class="col-md-5 text-center">
            @if($product->images->count())
              <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                   class="rounded border shadow-sm mb-2" width="200" height="200">
              <div class="d-flex flex-wrap justify-content-center gap-2 mt-2">
                @foreach($product->images as $img)
                  <img src="{{ asset('storage/' . $img->image_path) }}" 
                       class="rounded border" width="60" height="60">
                @endforeach
              </div>
            @else
              <img src="https://via.placeholder.com/200" class="rounded border">
            @endif
          </div>

          <!-- ✅ Right: Product Details -->
          <div class="col-md-7">
            <p><strong>Vendor:</strong> {{ $product->vendor->store_name ?? 'N/A' }}</p>
            <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
            <p><strong>ChildCategory:</strong> {{ $product->childcategory->name ?? 'N/A' }}</p>
            <p><strong>Base Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p><strong>Stock:</strong> {{ $product->stock ?? 'N/A' }}</p>

            <p><strong>Sizes:</strong> 
              @if($product->variants->count())
                @foreach($product->variants as $size)
                  <span class="badge bg-secondary">{{ $size->size }}</span>
                @endforeach
              @else
                <span class="text-muted">N/A</span>
              @endif
            </p>

            <p><strong>Colors:</strong> 
              @if($product->variants->count())
                @foreach($product->variants as $variant)
                  <span class="d-inline-block border rounded-circle me-1" 
                        title="{{ $variant->color }}"
                        style="width:20px;height:20px;background:{{ $variant->color ?? '#ccc' }}"></span>
                @endforeach
              @else
                <span class="text-muted">N/A</span>
              @endif
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
            <p class="text-muted small">{!! $product->description ?? 'No description available.' !!}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



                        </tr>
                    @endforeach
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
                    paginate: {
                        previous: "←",
                        next: "→"
                    }
                }
            });
        });
    </script>
@endsection
