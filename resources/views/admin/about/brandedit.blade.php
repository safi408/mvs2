@extends('layouts.masterlayout')

@section('content')
<div class="container py-5">
  <div class="card shadow-sm p-4 rounded-4">
    <h3 class="fw-bold mb-4">About Page – Brand Logos</h3>

    {{--  Add Brand Form --}}
    <form action="{{route('admin.brand.update',$brand->id)}}" method="POST" enctype="multipart/form-data" class="mb-4">
      @csrf
      <div class="row g-3 align-items-end">
        <div class="col-md-4">
          <label class="form-label fw-semibold">Brand Name</label>
          <input type="text" name="name" value="{{$brand->name}}" class="form-control" placeholder="Enter brand name">
          @error('name')
              <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Brand Logo</label>
          <input type="file" name="logo" class="form-control">
        </div>

        <div class="col-md-4">
          <button class="btn btn-primary px-4 fw-bold rounded-pill">Update Brand</button>
        </div>
      </div>
    </form>

  </div>
</div>
@endsection
