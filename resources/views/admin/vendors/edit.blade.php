@extends('layouts.masterlayout')

@section('content')
 <div class="container my-3">
  <div class="row justify-content-center">
    <div class="col-md-12">

      <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-warning text-dark d-flex align-items-center">
          <i class="bi bi-pencil-square me-2"></i>
          <h4 class="mb-0">Edit Vendor Store</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('vendor.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
          
            <input type="hidden" name="user_id" value="{{ $vendor->user_id }}">

            <div class="row g-4">

              <!-- Store Name -->
              <div class="col-md-4">
                <div class="p-3 border rounded d-flex align-items-center">
                  <i class="bi bi-bag fs-4 text-primary me-3"></i>
                  <div class="flex-grow-1">
                    <label for="store_name" class="form-label mb-1">Store Name</label>
                    <input type="text" 
                           class="form-control" 
                           id="store_name" 
                           name="store_name" 
                           value="{{ old('store_name', $vendor->store_name) }}" 
                           placeholder="Enter store name">
                    @error('store_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>
              </div>

              <!-- Store Slug -->
              <div class="col-md-4">
                <div class="p-3 border rounded d-flex align-items-center">
                  <i class="bi bi-link-45deg fs-4 text-primary me-3"></i>
                  <div class="flex-grow-1">
                    <label for="store_slug" class="form-label mb-1">Store Slug</label>
                    <input type="text" 
                           class="form-control" 
                           id="store_slug" 
                           name="store_slug" 
                           value="{{ old('store_slug', $vendor->store_slug) }}">
                    @error('store_slug')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>
              </div>

              <!-- Store Logo -->
              <div class="col-md-4">
                <div class="p-3 border rounded d-flex align-items-center">
                  <i class="bi bi-image fs-4 text-primary me-3"></i>
                  <div class="flex-grow-1">
                    <label for="store_logo" class="form-label mb-1">Store Logo</label>
                    <input class="form-control" type="file" id="store_logo" name="store_logo" accept="image/*">
                    @if($vendor->store_logo)
                        <img src="{{ asset('storage/'.$vendor->store_logo) }}" alt="Logo" class="mt-2 rounded" width="60">
                    @endif
                  </div>
                </div>
              </div>

              <!-- Phone -->
              <div class="col-md-4">
                <div class="p-3 border rounded d-flex align-items-center">
                  <i class="bi bi-telephone fs-4 text-primary me-3"></i>
                  <div class="flex-grow-1">
                    <label for="phone" class="form-label mb-1">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" 
                           value="{{ old('phone', $vendor->phone) }}" placeholder="Enter phone number">
                  </div>
                </div>
              </div>

              <!-- City -->
              <div class="col-md-4">
                <div class="p-3 border rounded d-flex align-items-center">
                  <i class="bi bi-buildings fs-4 text-primary me-3"></i>
                  <div class="flex-grow-1">
                    <label for="city" class="form-label mb-1">City</label>
                    <input type="text" class="form-control" id="city" name="city" 
                           value="{{ old('city', $vendor->city) }}" placeholder="Enter city">
                  </div>
                </div>
              </div>

              <!-- Country -->
              <div class="col-md-4">
                <div class="p-3 border rounded d-flex align-items-center">
                  <i class="bi bi-globe fs-4 text-primary me-3"></i>
                  <div class="flex-grow-1">
                    <label for="country" class="form-label mb-1">Country</label>
                    <input type="text" class="form-control" id="country" name="country" 
                           value="{{ old('country', $vendor->country) }}" placeholder="Enter country">
                  </div>
                </div>
              </div>

              <!-- Commission -->
              <div class="col-md-6">
                <div class="p-3 border rounded d-flex align-items-center">
                  <i class="bi bi-percent fs-4 text-primary me-3"></i>
                  <div class="flex-grow-1">
                    <label for="commission_rate" class="form-label mb-1">Commission Rate (%)</label>
                    <input type="number" step="0.01" 
                           class="form-control" 
                           id="commission_rate" 
                           name="commission_rate" 
                           value="{{ old('commission_rate', $vendor->commission_rate) }}" 
                           placeholder="e.g. 10.00">
                  </div>
                </div>
              </div>

              <!-- Status -->
              <div class="col-md-6">
                <div class="p-3 border rounded d-flex align-items-center">
                  <i class="bi bi-check-circle fs-4 text-primary me-3"></i>
                  <div class="flex-grow-1">
                    <label for="status" class="form-label mb-1">Status</label>
                    <select class="form-select" id="status" name="status">
                      <option value="pending" {{ old('status', $vendor->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                      <option value="active" {{ old('status', $vendor->status) == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="blocked" {{ old('status', $vendor->status) == 'blocked' ? 'selected' : '' }}>Blocked</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Address -->
              <div class="col-md-12">
                <div class="p-3 border rounded d-flex align-items-start">
                  <i class="bi bi-geo-alt fs-4 text-primary me-3"></i>
                  <div class="flex-grow-1">
                    <label for="address" class="form-label mb-1">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="2">{{ old('address', $vendor->address) }}</textarea>
                  </div>
                </div>
              </div>

              <!-- Store Description -->
              <div class="col-md-12">
                <div class="p-2 border rounded d-flex align-items-start">
                  <i class="bi bi-textarea-t fs-4 text-primary me-2"></i>
                  <div class="flex-grow-1">
                    <label for="store_description" class="form-label mb-1">Store Description</label>
                    <textarea class="form-control" id="summernote" name="store_description" rows="3">{{ old('store_description', $vendor->store_description) }}</textarea>
                  </div>
                </div>
              </div>

              <!-- Verify Checkbox -->
              <div class="col-md-12">
                <div class="form-check p-3 border rounded bg-light">
                  <input class="form-check-input" type="checkbox" value="1" id="is_verified" name="is_verified"
                         {{ old('is_verified', $vendor->is_verified) ? 'checked' : '' }}>
                  <label class="form-check-label" for="is_verified">
                    <i class="bi bi-patch-check-fill text-success"></i> Vendor Verified
                  </label>
                </div>
              </div>

            </div><!-- row end -->

            <!-- Submit -->
            <div class="mt-2 d-flex justify-content-end">
              <button type="submit" class="btn btn-warning btn-md p-2">
                <i class="bi bi-save me-2"></i> Update Vendor
              </button>
            </div>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Summernote JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      placeholder: 'Write Store description here...',
      tabsize: 2,
      height: 200,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold','italic','underline','clear']],
        ['color', ['color']],
        ['para', ['ul','ol','paragraph']],
        ['insert', ['link','picture']],
        ['view', ['fullscreen','codeview','help']]
      ]
    });
  });
</script>
