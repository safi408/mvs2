@extends('layouts.masterlayout')

@section('content')
<div class="container py-4">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Edit Offer Banner</h5>
    </div>

    <div class="card-body">
    

      <form action="{{route('admin.offer.update')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label class="form-label fw-bold">Title</label>
          <input type="text" name="title" value="{{ old('title', $banner->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Subtitle</label>
          <input type="text" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Discount</label>
          <input type="text" name="discount" value="{{ old('discount', $banner->discount) }}" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Button Text</label>
          <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" class="form-control">
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Offer End Date</label>
            <input type="date" name="end_date" value="{{ old('end_date', $banner->end_date) }}" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Banner Image</label>
            <input type="file" name="image" class="form-control">
          </div>
        </div>

        @if($banner->image)
          <div class="mb-3 text-center">
            <p class="fw-bold">Current Banner:</p>
            <img src="{{ asset('storage/' . $banner->image) }}" width="250" class="rounded shadow-sm border">
          </div>
        @endif

        <div class="text-end">
          <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-save me-1"></i> Update Offer
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
