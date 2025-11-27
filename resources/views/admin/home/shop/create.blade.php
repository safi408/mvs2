@extends('layouts.masterlayout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Update Shop Collection Section</h5>
        </div>

        <div class="card-body">
            {{-- @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif --}}

            <form action="{{route('admin.update.shop', $collection->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                {{-- 🛍️ Section 1 --}}
                <h6 class="fw-bold mb-3 text-primary">Section 1</h6>

                <div class="mb-3">
                    <label class="form-label">Title 1</label>
                    <input type="text" name="title1" value="{{ old('title1', $collection->title1) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Subtitle 1</label>
                    <input type="text" name="subtitle1" value="{{ old('subtitle1', $collection->subtitle1) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Button Text 1</label>
                    <input type="text" name="button_text1" value="{{ old('button_text1', $collection->button_text1) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Image 1</label>
                    <input type="file" name="image1" class="form-control">
                    @if($collection->image1)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $collection->image1) }}" class="img-thumbnail" width="150">
                        </div>
                    @endif
                </div>

                <hr>

                {{-- 👜 Section 2 --}}
                <h6 class="fw-bold mb-3 text-primary">Section 2</h6>

                <div class="mb-3">
                    <label class="form-label">Title 2</label>
                    <input type="text" name="title2" value="{{ old('title2', $collection->title2) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Subtitle 2</label>
                    <input type="text" name="subtitle2" value="{{ old('subtitle2', $collection->subtitle2) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Button Text 2</label>
                    <input type="text" name="button_text2" value="{{ old('button_text2', $collection->button_text2) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Image 2</label>
                    <input type="file" name="image2" class="form-control">
                    @if($collection->image2)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $collection->image2) }}" class="img-thumbnail" width="150">
                        </div>
                    @endif
                </div>

                <hr>



                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update Collection
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
