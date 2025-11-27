@extends('layouts.masterlayout')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">Create Category</div>
        <div class="card-body">
            {{-- enctype is required for file upload --}}
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Category Name --}}
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>

                {{-- Image Upload --}}
                <div class="mb-3">
                    <label class="form-label">Category Image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-success">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
