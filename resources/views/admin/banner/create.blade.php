@extends('layouts.masterlayout')

@section('content')
<div class="card">
  <div class="card-header"><h5>Add Sliders</h5></div>
  <div class="card-body">
    <!-- Add enctype for file upload -->
    <form action="{{route('store.banner')}}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control">
        @error('title')
            <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Subtitle</label>
        <input type="text" name="subtitle" class="form-control">
        @error('subtitle')
            <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Button Text</label>
        <input type="text" name="text_button" class="form-control">
        @error('text_button')
            <span style="color: red">{{$message}}</span>
        @enderror
      </div>

    {{-- jhgjhgjkkk --}}
      <div class="mb-3">
        <label class="form-label">Banner Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <small class="text-muted">Supported formats: jpg, jpeg, png, webp (max: 2MB)</small>
      </div>

      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</div>
@endsection
