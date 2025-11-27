@extends('layouts.masterlayout')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Update Customer Review</h3>

    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" class="form-control" 
                   value="{{ old('name', $review->name) }}" placeholder="Enter customer name" required>
            @error('name')
                 <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Title</label>
            <input type="text" name="title" class="form-control" 
                   value="{{ old('title', $review->title) }}" placeholder="e.g. CEO, Designer, etc.">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Message</label>
            <textarea name="message" class="form-control" rows="4" placeholder="Write review..." required>{{ old('message', $review->message) }}</textarea>
            @error('message')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Rating</label>
            <select name="rating" class="form-select">
                <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5)</option>
                <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4)</option>
                <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>⭐⭐⭐ (3)</option>
                <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>⭐⭐ (2)</option>
                <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>⭐ (1)</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check2-circle me-1"></i> Update Review
        </button>
    </form>
</div>
@endsection
