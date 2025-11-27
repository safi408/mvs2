@extends('layouts.masterlayout')
@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Profile Sidebar -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img id="profilePreview" 
                         src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/120' }}" 
                         alt="Profile Image" 
                         class="rounded-circle mb-3" width="120" height="120">

                    <h4>{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ Auth::user()->email }}</p>

                    <button class="btn btn-primary btn-sm" onclick="document.getElementById('profileTab').click()">Edit Profile</button>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">My Profile</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Profile Image</label>
                                <input type="file" name="image" id="profileImage" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-success">Update Profile</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS for Image Preview -->
<script>
    document.getElementById('profileImage').addEventListener('change', function (e) {
        let reader = new FileReader();
        reader.onload = function (event) {
            document.getElementById('profilePreview').setAttribute('src', event.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection
