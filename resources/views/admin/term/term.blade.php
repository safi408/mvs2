@extends('layouts.masterlayout')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Update Terms & Conditions</h4>
        </div>

        <div class="card-body">
            <form action="{{route('term.update')}}" method="POST">
                @csrf

                @for ($i = 1; $i <= 5; $i++)
                    <div class="mb-4 p-3 border rounded bg-light">
                        <h5 class="text-primary">Section {{ $i }}</h5>

                        <div class="mb-3">
                            <label for="title_{{ $i }}" class="form-label fw-bold">Title {{ $i }}</label>
                            <input type="text" name="title_{{ $i }}" id="title_{{ $i }}"
                                class="form-control @error('title_'.$i) is-invalid @enderror"
                                value="{{ old('title_'.$i, $term->{'title_'.$i} ?? '') }}"
                                placeholder="Enter title {{ $i }}">

                            @error('title_'.$i)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content_{{ $i }}" class="form-label fw-bold">Content {{ $i }}</label>
                            <textarea name="content_{{ $i }}" id="content_{{ $i }}" rows="4"
                                class="form-control @error('content_'.$i) is-invalid @enderror"
                                placeholder="Enter content {{ $i }}">{{ old('content_'.$i, $term->{'content_'.$i} ?? '') }}</textarea>

                            @error('content_'.$i)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endfor

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save me-1"></i> Save Terms
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
