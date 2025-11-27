@extends('layouts.masterlayout')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-bag-check me-2"></i> Update Shop Collection</h5>
            <a href="" class="btn btn-light btn-sm ms-auto">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{route('admin.update.shop',$collection->id)}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <!-- Title -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Enter title" value="{{ old('title',$collection->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Subtitle</label>
                        <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror"
                            placeholder="Enter subtitle" value="{{ old('subtitle',$collection->subtitle) }}">
                        @error('subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Button Text -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Button Text</label>
                        <input type="text" name="button_text" class="form-control @error('button_text') is-invalid @enderror"
                            placeholder="e.g. Shop Now" value="{{ old('button_text',$collection->button_text) }}">
                        @error('button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Collection Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Preview (optional JS-based image preview) -->
                    <div class="col-12 mt-3">
                        <img id="preview-image" src="#" alt="Preview Image"
                            class="img-fluid rounded d-none border" style="max-height: 200px;">
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-check-circle me-1"></i> Update Collection
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Image Preview Script -->
<script>
    document.querySelector('input[name="image"]').addEventListener('change', function (e) {
        const [file] = e.target.files;
        if (file) {
            const img = document.getElementById('preview-image');
            img.src = URL.createObjectURL(file);
            img.classList.remove('d-none');
        }
    });
</script>
@endsection
