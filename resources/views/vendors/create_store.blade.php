@extends('layouts.masterlayout')

@section('content')
<div class="container my-3">
  <div class="row justify-content-center">
    <div class="col-md-12">

      <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white d-flex align-items-center">
          <i class="bi bi-shop me-2"></i>
          <h4 class="mb-0">Add Store</h4>
        </div>

        <div class="card-body">
          <form action="{{ route('createStore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">

              <!-- Store Name -->
              <div class="col-md-4">
                <div class="p-3 border rounded">
                  <label for="store_name" class="form-label mb-1">Store Name</label>
                  <input type="text" class="form-control @error('store_name') is-invalid @enderror" 
                         id="store_name" name="store_name" value="{{ old('store_name') }}" placeholder="Enter store name">
                  @error('store_name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Store Slug -->
              <div class="col-md-4">
                <div class="p-3 border rounded">
                  <label for="store_slug" class="form-label mb-1">Store Slug</label>
                  <input type="text" class="form-control @error('store_slug') is-invalid @enderror" 
                         id="store_slug" name="store_slug" value="{{ old('store_slug') }}" placeholder="Auto-generated or enter manually">
                  @error('store_slug')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Store Logo -->
              <div class="col-md-4">
                <div class="p-3 border rounded">
                  <label for="store_logo" class="form-label mb-1">Store Logo</label>
                  <input class="form-control @error('store_logo') is-invalid @enderror" 
                         type="file" id="store_logo" name="store_logo" accept="image/*">
                  @error('store_logo')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Phone -->
              <div class="col-md-4">
                <div class="p-3 border rounded">
                  <label for="phone" class="form-label mb-1">Phone</label>
                  <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                         id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number">
                  @error('phone')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- City -->
              <div class="col-md-4">
                <div class="p-3 border rounded">
                  <label for="city" class="form-label mb-1">City</label>
                  <input type="text" class="form-control @error('city') is-invalid @enderror" 
                         id="city" name="city" value="{{ old('city') }}" placeholder="Enter city">
                  @error('city')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Country -->
              <div class="col-md-4">
                <div class="p-3 border rounded">
                  <label for="country" class="form-label mb-1">Country</label>
                  <input type="text" class="form-control @error('country') is-invalid @enderror" 
                         id="country" name="country" value="{{ old('country') }}" placeholder="Enter country">
                  @error('country')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Commission -->
              <div class="col-md-6">
                <div class="p-3 border rounded">
                  <label for="commission_rate" class="form-label mb-1">Commission Rate (%)</label>
                  <input type="number" step="0.01" class="form-control @error('commission_rate') is-invalid @enderror" 
                         id="commission_rate" name="commission_rate" value="{{ old('commission_rate') }}" placeholder="e.g. 10.00">
                  @error('commission_rate')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Status -->
              {{-- <div class="col-md-6">
                <div class="p-3 border rounded">
                  <label for="status" class="form-label mb-1">Status</label>
                  <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="blocked" {{ old('status') == 'blocked' ? 'selected' : '' }}>Blocked</option>
                  </select>
                  @error('status')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div> --}}

              <!-- Address -->
              <div class="col-md-6">
                <div class="p-3 border rounded">
                  <label for="address" class="form-label mb-1">Address</label>
                  <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2" placeholder="Enter store address">{{ old('address') }}</textarea>
                  @error('address')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Store Description -->
              <div class="col-md-12">
                <div class="p-3 border rounded">
                  <label for="store_description" class="form-label mb-1">Store Description</label>
                  <textarea class="form-control @error('store_description') is-invalid @enderror" id="summernote" name="store_description" rows="3" placeholder="Write about your store...">{{ old('store_description') }}</textarea>
                  @error('store_description')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Verify Checkbox -->
              <div class="col-md-12">
                <div class="form-check p-3 border rounded bg-light">
                  <input class="form-check-input" type="checkbox" id="is_verified" name="is_verified" value="1" {{ old('is_verified') ? 'checked' : '' }}>
                  <label class="form-check-label" for="is_verified">
                    <i class="bi bi-patch-check-fill text-success"></i> Vendor Verified
                  </label>
                </div>
              </div>

            </div><!-- row end -->

            <!-- Submit -->
            <div class="mt-3 text-end">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-2"></i> Save Vendor Store
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
