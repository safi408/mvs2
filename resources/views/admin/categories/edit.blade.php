@extends('layouts.masterlayout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <i class="bi bi-pencil-square"></i> Edit Category
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Category Name --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Category Name</label>
                    <input type="text" name="name" 
                           value="{{ old('name', $category->name) }}" 
                           class="form-control rounded-3 shadow-sm" 
                           required>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" rows="3" 
                              class="form-control rounded-3 shadow-sm">{{ old('description', $category->description) }}</textarea>
                </div>

                {{-- Image Upload --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Category Image</label>
                    <input type="file" name="image" class="form-control rounded-3 shadow-sm">
                    <small class="text-muted d-block mt-1">Supported: JPG, JPEG, PNG, GIF (max 2MB)</small>

                    {{-- Show existing image if available --}}
                    @if($category->image)
                        <div class="mt-3">
                            <p class="fw-semibold mb-1">Current Image:</p>
                            <img src="{{ asset('storage/' . $category->image) }}" 
                                 alt="Category Image" 
                                 class="rounded shadow-sm border" 
                                 width="120" height="120">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('category.manage') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle"></i> Back
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
