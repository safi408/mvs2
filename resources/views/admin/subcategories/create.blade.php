@extends('layouts.masterlayout')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">Create SubCategory</div>
        <div class="card-body">
            <form action="{{ route('subcategories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Select Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">SubCategory Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
