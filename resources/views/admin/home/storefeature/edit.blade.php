@extends('layouts.masterlayout')

@section('content')
<div class="container py-4">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Update Store Feature</h5>
      <a href="{{ route('admin.feature.index') }}" class="btn btn-light btn-sm ms-auto">
        <i class="bi bi-list"></i> View All Store Feature
      </a>
    </div>

    <div class="card-body">
  
      <form action="{{route('admin.feature.update', $feature->id)}}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Feature Icon --}}
        <div class="mb-3">
          <label for="icon" class="form-label fw-bold">Icon (Bootstrap Icon Class)</label>
          <input 
            type="text" 
            name="icon" 
            id="icon" 
            class="form-control" 
            value="{{$feature->icon}}"
            placeholder="e.g. bi-truck, bi-headset, bi-gift"
            >
          <small class="text-muted">Example: <code>bi-truck</code> → 🚚</small>
          @error('icon')
              <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        {{-- Feature Title --}}
        <div class="mb-3">
          <label for="title" class="form-label fw-bold">Title</label>
          <input 
            type="text" 
            name="title" 
            id="title" 
            class="form-control"
            value="{{$feature->title}}" 
            placeholder="e.g. Free Shipping"
             >
             @error('title')
                 <span class="text-danger">{{$message}}</span>
             @enderror
        </div>

        {{-- Feature Description --}}
        <div class="mb-3">
          <label for="description" class="form-label fw-bold">Description</label>
          <textarea 
            name="description" 
            id="description" 
            rows="3" 
            class="form-control" 
            placeholder="Enter a short description about this feature..."
              
            >  {{$feature->description}}</textarea>
          
            @error('description')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>



        <div class="text-end">
          <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-save me-1"></i> Update Feature
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
