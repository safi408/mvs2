@extends('layouts.masterlayout')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Add Customer Review</h3>



    <form action="{{route('store')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter customer name">
            @error('name')
                 <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Title</label>
            <input type="text" name="title" class="form-control" placeholder="e.g. CEO, Designer, etc.">
            @error('title')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Message</label>
            <textarea name="message" class="form-control" rows="4" placeholder="Write review..."></textarea>
            @error('message')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Rating</label>
            <select name="rating" class="form-select">
                <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                <option value="4">⭐⭐⭐⭐ (4)</option>
                <option value="3">⭐⭐⭐ (3)</option>
                <option value="2">⭐⭐ (2)</option>
                <option value="1">⭐ (1)</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>
@endsection