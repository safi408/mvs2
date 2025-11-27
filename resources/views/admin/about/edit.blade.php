@extends('layouts.masterlayout')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Update About Banner</h4>


    <form action="{{route('admin.about.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Banner Title</label>
            <input type="text" name="title" value="{{$about->title}}" class="form-control" placeholder="e.g. Contact Grid">
            @error('title')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Breadcrumb Text</label>
            <input type="text" name="breadcrumb" value="{{$about->breadcrumb}}" class="form-control" placeholder="Homepage > Contact > Contact Grid">
            @error('breadcrumb')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Banner Image (Recommended: 1900x300)</label>
            <input type="file" name="image" id="imageInput" class="form-control">
            @error('image')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Preview</label><br>
            @if($about->image)   
             <img id="previewImg" src="{{   asset('storage/'. $about->image)}}" style="border-radius:10px; width: 13%">
            @else
                <img id="previewImg" src="https://via.placeholder.com/1900x300?text=No+Banner" style="width:100%; max-width:900px;">
            @endif
        </div>

        <button class="btn btn-primary">Update About Banner</button>
    </form>
</div>

<script>
document.getElementById('imageInput').addEventListener('change', function(e){
    const [file] = e.target.files;
    if (file) document.getElementById('previewImg').src = URL.createObjectURL(file);
});
</script>
@endsection
