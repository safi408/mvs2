@extends('layouts.masterlayout')
@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h5>Edit SubCategory</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Select Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $subcategory->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">SubCategory Name</label>
                    <input type="text" name="name" value="{{ $subcategory->name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ $subcategory->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('subcategory.manage') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
