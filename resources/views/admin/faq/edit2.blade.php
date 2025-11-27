@extends('layouts.masterlayout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-primary fw-bold">Edit FAQ</h4>
        <a href="{{ route('admin.faq.index') }}" class="btn btn-sm btn-secondary">← Back to List</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.faq.update2', $faq->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Category</label>
                    <input 
                        type="text" 
                        name="category" 
                        class="form-control @error('category') is-invalid @enderror" 
                        value="{{ old('category', $faq->category) }}" 
                        placeholder="Enter category name" 
                        required>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Question</label>
                    <input 
                        type="text" 
                        name="question" 
                        class="form-control @error('question') is-invalid @enderror" 
                        value="{{ old('question', $faq->question) }}" 
                        placeholder="Enter question" 
                        required>
                    @error('question')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Answer</label>
                    <textarea 
                        name="answer" 
                        class="form-control @error('answer') is-invalid @enderror" 
                        rows="4" 
                        placeholder="Enter answer" 
                        required>{{ old('answer', $faq->answer) }}</textarea>
                    @error('answer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">Update FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
