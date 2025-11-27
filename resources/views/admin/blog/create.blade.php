@extends('layouts.masterlayout')

@section('content')
<div class="bg-light min-vh-100 py-5">
    <div class="container">

        <div class="card shadow-lg border-0 rounded-4 overflow-hidden" 
            style="backdrop-filter: blur(12px); background: rgba(255,255,255,0.9);">

            <!-- Header -->
            <div class="card-header py-3 px-4 text-white" 
                style="background: linear-gradient(90deg, #0d6efd, #6610f2);">
                <h4 class="mb-0 fw-bold"><i class="bi bi-journal-text me-2"></i> Add Blog</h4>
            </div>

            <!-- Body -->
            <div class="card-body p-4">
                <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Subtitle -->
                    <div class="mb-3">
                        <label class="fw-semibold text-secondary"><i class="bi bi-type"></i> Subtitle</label>
                        <input type="text" name="title" class="form-control modern-input shadow-sm" placeholder="Enter subtitle" value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div class="mb-3">
                        <label class="fw-semibold text-secondary"><i class="bi bi-person"></i> Author</label>
                        <input type="text" name="author" class="form-control modern-input shadow-sm" value="{{ old('author', 'Themesflat') }}">
                        @error('author')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Publish Date -->
                    <div class="mb-3">
                        <label class="fw-semibold text-secondary"><i class="bi bi-calendar-event"></i> Publish Date</label>
                        <input type="date" name="publish_date" class="form-control modern-input shadow-sm" value="{{ old('publish_date') }}">
                        @error('publish_date')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="fw-semibold text-secondary"><i class="bi bi-textarea-t"></i> Description</label>
                        <textarea id="summernote" name="description" rows="5" class="form-control modern-input shadow-sm" placeholder="Enter blog description here...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Paragraphs -->
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="fw-semibold text-secondary"><i class="bi bi-file-text"></i> Paragraphs</label>
        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill shadow-sm" id="add-paragraph">
            <i class="bi bi-plus-circle"></i> Add Paragraph
        </button>
    </div>
    <div id="paragraphs-wrapper" class="p-3 bg-white border rounded-4 shadow-sm"></div>
    @error('paragraphs')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>



                    <!-- Bullets -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="fw-semibold text-secondary"><i class="bi bi-list-ul"></i> Bullet Points</label>
                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill shadow-sm" id="add-bullet">
                                <i class="bi bi-plus-circle"></i> Add
                            </button>
                        </div>
                        <div id="bullets-wrapper" class="p-3 bg-white border rounded-4 shadow-sm"></div>
                        @error('bullets')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Images -->
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="fw-semibold text-secondary"><i class="bi bi-image"></i> Upload Blog Image 1</label>
                            <input type="file" name="image_1" id="imageUpload1" class="form-control modern-input shadow-sm">
                            @error('image_1')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="fw-semibold text-secondary"><i class="bi bi-image"></i> Upload Blog Image 2</label>
                            <input type="file" name="image_2" id="imageUpload2" class="form-control modern-input shadow-sm">
                            @error('image_2')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="fw-semibold text-secondary"><i class="bi bi-image"></i> Upload Blog Image 3</label>
                            <input type="file" name="image_3" id="imageUpload2" class="form-control modern-input shadow-sm">
                            @error('image_3')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="mt-4 mb-4">
                        <label class="fw-semibold text-secondary"><i class="bi bi-tags"></i> Tags</label>
                        <select name="tags[]" class="form-select modern-input d-none" id="tagsSelect" multiple>
                            @foreach (['Fashion', 'Trending', 'Business', 'Lifestyle', 'Travel'] as $tag)
                                <option value="{{ $tag }}" {{ collect(old('tags'))->contains($tag) ? 'selected' : '' }}>{{ $tag }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Related Posts -->
                    <div class="mb-4">
                        <label class="fw-semibold text-secondary"><i class="bi bi-link-45deg"></i> Related Posts</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="related_previous_title" class="form-control modern-input shadow-sm" placeholder="Previous Post Title" value="{{ old('related_previous_title') }}">
                                <input type="text" name="related_previous_url" class="form-control modern-input shadow-sm mt-2" placeholder="Previous Post URL" value="{{ old('related_previous_url') }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="related_next_title" class="form-control modern-input shadow-sm" placeholder="Next Post Title" value="{{ old('related_next_title') }}">
                                <input type="text" name="related_next_url" class="form-control modern-input shadow-sm mt-2" placeholder="Next Post URL" value="{{ old('related_next_url') }}">
                            </div>
                        </div>
                    </div>


                    <!-- Social Media Inputs -->
<div class="mt-4 mb-4">
    <label class="fw-semibold text-secondary"><i class="bi bi-share"></i> Social Media Links</label>
    <div class="row g-3 mt-2">
        @foreach (['facebook', 'x', 'instagram', 'tiktok', 'youtube', 'pinterest'] as $platform)
            @php
                $label = $platform === 'x' ? 'X (Twitter)' : ucfirst($platform);
            @endphp
            <div class="col-md-4">
                <input type="text" class="form-control modern-input shadow-sm" 
                       name="social_media[{{ $platform }}]" 
                       placeholder="Enter {{ $label }} URL" 
                       value="{{ old('social_media.'.$platform) }}">
            </div>
        @endforeach
    </div>
    @error('social_media')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>



                    <!-- Submit -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-gradient rounded-pill px-4 py-2 shadow-lg">
                            <i class="bi bi-save2 me-1"></i> Save Blog
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- 🌈 Custom Styles --}}
<style>
    body { background: linear-gradient(120deg, #f8f9fa, #eef2ff); }
    .modern-input { border-radius: 12px; border: 1px solid #dee2e6; transition: all 0.3s ease; }
    .modern-input:focus { border-color: #6610f2; box-shadow: 0 0 0 0.25rem rgba(102,16,242,0.15); }
    .btn-gradient { background: linear-gradient(90deg, #0d6efd, #6610f2); color: #fff; transition: 0.3s ease; }
    .btn-gradient:hover { opacity: 0.9; transform: translateY(-2px); }
</style>

{{-- 🌈 Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>


<!-- Summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>


<script>
$(document).ready(function() {
    // Add Bullet
    $('#add-bullet').click(function() {
        $('#bullets-wrapper').append(`
            <div class="input-group mb-3 bullet-item">
                <input type="text" name="bullets[]" class="form-control modern-input" placeholder="Enter bullet point">
                <button type="button" class="btn btn-light border remove-bullet"><i class="bi bi-x-lg text-danger"></i></button>
            </div>
        `);
    });

    // Summernote
    $('#summernote').summernote({
        placeholder: 'Write product description here...',
        tabsize: 2,
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold','italic','underline','clear']],
            ['color', ['color']],
            ['para', ['ul','ol','paragraph']],
            ['insert', ['link','picture']],
            ['view', ['fullscreen','codeview','help']]
        ]
    });



    // Add Paragraph
$('#add-paragraph').click(function() {
    $('#paragraphs-wrapper').append(`
        <div class="input-group mb-3 paragraph-item">
            <textarea name="paragraphs[]" class="form-control modern-input" placeholder="Enter paragraph"></textarea>
            <button type="button" class="btn btn-light border remove-paragraph">
                <i class="bi bi-x-lg text-danger"></i>
            </button>
        </div>
    `);
});

// Remove Paragraph
$(document).on('click', '.remove-paragraph', function() {
    $(this).closest('.paragraph-item').remove();
});




    // Remove Bullet
    $(document).on('click', '.remove-bullet', function() {
        $(this).closest('.bullet-item').remove();
    });

    // FilePond
    //FilePond.registerPlugin(FilePondPluginImagePreview);
    //FilePond.create(document.querySelector('#imageUpload1'), { imagePreviewHeight: 120, labelIdle: '📸 Upload Blog Image 1' });
    //FilePond.create(document.querySelector('#imageUpload2'), { imagePreviewHeight: 120, labelIdle: '📸 Upload Blog Image 2' });

    // Select2
    $('#tagsSelect').select2({ placeholder: "Select or search tags", allowClear: true, width: '100%' }).removeClass('d-none');
});
</script>
@endsection
