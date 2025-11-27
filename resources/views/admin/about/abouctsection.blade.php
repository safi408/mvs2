@extends('layouts.masterlayout')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-gradient text-black rounded-top-4" style="background: linear-gradient(90deg, #0d6efd, #6610f2);">
            <h4 class="mb-0">Edit About Section</h4>
        </div>

        <div class="card-body p-4">
            <form action="{{route('admin.about.section.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" id="title" value="{{old('title',$about->title)}}" class="form-control" placeholder="Enter section title" required>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Current Image</label><br>
                    @if($about->image)
                        <img src="{{asset('storage/'.$about->image)}}" id="preview" class="img-fluid mb-3 rounded-3 border" style="max-width: 220px;">
                    @else
                        <img id="preview" src="https://via.placeholder.com/220x150?text=No+Image" class="img-fluid mb-3 rounded-3 border">
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                </div>

                                <!-- Button_text -->
                <div class="mb-3">
                    <label for="button" class="form-label fw-semibold">Button</label>
                    <input type="text" name="button_text" id="button" value="{{old('button_text',$about->button_text)}}" class="form-control" placeholder="Enter section title" required>
                </div>

                <hr class="my-4">

                <!-- Tabs Content -->
                <div class="row g-4">
                    <!-- Tab 1 -->
                    <div class="col-md-6">
                        <label class="fw-semibold">Tab 1 Title</label>
                        <input type="text" name="tab1_title" value="{{old('tab1_title',$about->tab1_title)}}" class="form-control mb-2">
                        <textarea name="tab1_content" class="form-control" rows="4" placeholder="Enter Introduction content">{{old('tab1_content',$about->tab1_content)}}</textarea>
                    </div>

                    <!-- Tab 2 -->
                    <div class="col-md-6">
                        <label class="fw-semibold">Tab 2 Title</label>
                        <input type="text" name="tab2_title" value="{{old('tab2_title',$about->tab2_title)}}" class="form-control mb-2">
                        <textarea name="tab2_content" class="form-control" rows="4" placeholder="Enter Vision content">{{old('tab2_content',$about->tab2_content)}}</textarea>
                    </div>

                    <!-- Tab 3 -->
                    <div class="col-md-6">
                        <label class="fw-semibold">Tab 3 Title</label>
                        <input type="text" name="tab3_title" value="{{old('tab3_title',$about->tab3_title)}}" class="form-control mb-2">
                        <textarea name="tab3_content" class="form-control" rows="4" placeholder="Enter 'What Sets Us Apart' content">{{old('tab3_content',$about->tab3_content)}}</textarea>
                    </div>

                    <!-- Tab 4 -->
                    <div class="col-md-6">
                        <label class="fw-semibold">Tab 4 Title</label>
                        <input type="text" name="tab4_title" value="{{old('tab4_title',$about->tab4_title)}}" class="form-control mb-2">
                        <textarea name="tab4_content" class="form-control" rows="4" placeholder="Enter 'Our Commitment' content">{{old('tab4_content',$about->tab4_content)}}</textarea>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">Update Section</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
