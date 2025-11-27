@extends('layouts.masterlayout')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Edit Banner</h5>
    <a href="{{ route('banner.index') }}" class="btn btn-sm btn-secondary ms-auto">
      <i class="bi bi-arrow-left"></i> Back
    </a>
  </div>

  <div class="card-body">
    <form action="{{ route('admin.update.banner', $banner->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!-- Title -->
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $banner->title) }}" placeholder="Enter banner title">
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Subtitle -->
      <div class="mb-3">
        <label class="form-label">Subtitle</label>
        <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror"
               value="{{ old('subtitle', $banner->subtitle) }}" placeholder="Enter subtitle">
        @error('subtitle')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Button Text -->
      <div class="mb-3">
        <label class="form-label">Button Text</label>
        <input type="text" name="text_button" class="form-control @error('text_button') is-invalid @enderror"
               value="{{ old('text_button', $banner->text_button) }}" placeholder="Enter button text (optional)">
        @error('text_button')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <!-- Banner Image -->
      <div class="mb-3">
        <label class="form-label">Banner Image</label>
        <div class="mb-2">
          @if ($banner->image)
            <img src="{{ asset('storage/' . $banner->image) }}" width="150" height="80" style="object-fit: cover; border-radius: 6px;">
          @else
            <p class="text-muted">No image uploaded</p>
          @endif
        </div>
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
        <small class="text-muted d-block mt-1">Leave empty to keep current image</small>
        @error('image')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <!-- Status -->
      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
          <option value="active" {{ $banner->status == 'active' ? 'selected' : '' }}>Active</option>
          <option value="inactive" {{ $banner->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-save"></i> Update Banner
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
