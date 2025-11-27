@extends('layouts.masterlayout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
            <div>
                <i class="bi bi-plus-circle"></i> Update Brand
            </div>
            <a href="{{ route('admin.productbrand.index') }}" class="btn btn-sm btn-light fw-semibold ms-auto">
                <i class="bi bi-arrow-left-circle me-1"></i> Back to List
            </a>
        </div>

        <div class="card-body">
            <form action="{{route('admin.productbrand.update',$brand->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">

                    {{-- Brand Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{$brand->name}}" class="form-control" placeholder="Enter brand name">
                        @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Brand Logo --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Brand Logo</label>
                        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                        <div class="mt-3">
                            <img id="logoPreview" src="#" class="img-fluid rounded-3 border d-none" width="120">
                        </div>
                    </div>


                    {{-- Submit Button --}}
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Update Brand
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

{{-- JS for logo preview --}}

@endsection
