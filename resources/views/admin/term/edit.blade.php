@extends('layouts.masterlayout')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Update Terms Banner</h4>


    <form action="{{route('admin.term.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Banner Title</label>
            <input type="text" name="title" value="{{$term->title}}" class="form-control" placeholder="e.g. Terms Grid">
            @error('title')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Breadcrumb Text</label>
            <input type="text" name="breadcrumb" value="{{$term->breadcrumb}}" class="form-control" placeholder="Homepage > Terms > Terms Grid">
            @error('breadcrumb')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Banner Image (Recommended: 1900x300)</label>
            <input type="file" name="image" id="imageInput" class="form-control">
            @error('image')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Preview</label><br>
              @if ($term->image)
                 <img id="previewImg" src="{{asset('storage/'.$term->image)}}" style="border-radius:10px; width: 13%">   
              @else
                <img id="previewImg" src="" style="border-radius:10px; width: 13%">  
              @endif           
        </div>

        <button class="btn btn-primary">Update Terms Banner</button>
    </form>
</div>
@endsection
