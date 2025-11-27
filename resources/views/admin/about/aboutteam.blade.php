@extends('layouts.masterlayout')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-gradient text-black rounded-top-4" style="background: linear-gradient(90deg, #0d6efd, #6610f2);">
            <h4 class="mb-0">Edit Team Members</h4>
        </div>

        <div class="card-body p-4">
            <form action="{{route('admin.team.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Member 1 -->
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <h5 class="mb-3">Member 1</h5>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name_1" value="{{old('name_1',$team->name_1)}}" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Designation</label>
                                <input type="text" name="destination_1" value="{{old('destination_1',$team->destination_1)}}" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Facebook URL</label>
                                <input type="url" name="facebook_1" value="{{old('facebook_1',$team->facebook_1)}}" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Image</label><br>
                                <img id="preview1" src="{{asset('storage/'.$team->image_1)}}" class="img-fluid mb-2 rounded-3 border" style="max-width: 180px;">
                                <input type="file" name="image_1" class="form-control" accept="image/*" onchange="previewImage(event, 1)">
                            </div>
                        </div>
                    </div>

                    <!-- Member 2 -->
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <h5 class="mb-3">Member 2</h5>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name_2" value="{{old('name_2',$team->name_2)}}" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Designation</label>
                                <input type="text" name="destination_2" value="{{old('destination_2',$team->destination_2)}}" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Facebook URL</label>
                                <input type="url" name="facebook_2" value="{{old('facebook_2',$team->facebook_2)}}" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Image</label><br>
                                <img id="preview2" src="{{asset('storage/'.$team->image_2)}}" class="img-fluid mb-2 rounded-3 border" style="max-width: 180px;">
                                <input type="file" name="image_2" class="form-control" accept="image/*" onchange="previewImage(event, 2)">
                            </div>
                        </div>
                    </div>

                    <!-- Member 3 -->
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <h5 class="mb-3">Member 3</h5>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name_3" value="{{old('name_3',$team->name_3)}}" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Designation</label>
                                <input type="text" name="destination_3" value="{{old('destination_3',$team->destination_3)}}" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Facebook URL</label>
                                <input type="url" name="facebook_3" value="{{old('facebook_3',$team->facebook_3)}}" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Image</label><br>
                                <img id="preview3" src="{{asset('storage/'. $team->image_3)}}" class="img-fluid mb-2 rounded-3 border" style="max-width: 180px;">
                                <input type="file" name="image_3" class="form-control" accept="image/*" onchange="previewImage(event, 3)">
                            </div>
                        </div>
                    </div>

                    <!-- Member 4 -->
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 h-100">
                            <h5 class="mb-3">Member 4</h5>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name_4" value="{{old('name_4',$team->name_4)}}" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Designation</label>
                                <input type="text" name="destination_4" value="{{old('destination_4',$team->destination_4)}}" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Facebook URL</label>
                                <input type="url" name="facebook_4" value="{{old('facebook_4',$team->facebook_4)}}" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold">Image</label><br>
                                <img id="preview4" src="{{asset('storage/'.$team->image_4)}}" class="img-fluid mb-2 rounded-3 border" style="max-width: 180px;">
                                <input type="file" name="image_4" class="form-control" accept="image/*" onchange="previewImage(event, 4)">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">Update Team Members</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

{{-- @section('scripts')
<script>
function previewImage(event, index) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview' + index).src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection --}}
