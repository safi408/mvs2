@extends('layouts.masterlayout')

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <!-- Profile Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center p-4">
                    <div class="position-relative d-inline-block">
                        <img id="profilePreview"
                             src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/150' }}"
                             alt="Profile Image"
                             class="rounded-circle border shadow-sm"
                             width="140" height="140"
                             style="object-fit: cover;">
                        <span class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow-sm" style="cursor:pointer;">
                            <i class="bi bi-camera"></i>
                        </span>
                    </div>

                    <h4 class="mt-3 mb-0">{{ Auth::user()->name }}</h4>
                    <p class="text-muted small"><i class="bi bi-envelope me-1"></i>{{ Auth::user()->email }}</p>

                    <hr class="my-4">

                    <div class="d-grid gap-2">
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm w-100"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-light d-flex align-items-center justify-content-between">
                    <h5 class="mb-0"><i class="bi bi-person-badge me-2 text-primary"></i> Edit Profile</h5>
                    <small class="text-muted">Update your account information</small>
                </div>
                <div class="card-body">
                

                    <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone</label>
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Profile Image</label>
                                <input type="file" name="image" id="profileImage" class="form-control" accept="image/*">
                            </div>
                            {{-- <div class="col-md-6">
                                <label class="form-label fw-semibold">Password <small class="text-muted">(optional)</small></label>
                                <input type="password" name="password" class="form-control" placeholder="Enter new password">
                            </div> --}}
                        </div>

                        <hr class="my-4">

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-check2-circle me-1"></i> Save Changes
                            </button>
                            <button type="reset" class="btn btn-secondary px-4">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Additional Info Card -->
            <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2 text-primary"></i> Account Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Role ID:</strong> {{ Auth::user()->role->name }}</p>
                    <p><strong>Joined At:</strong> {{ Auth::user()->created_at->format('d M, Y') }}</p>
                    <p><strong>About:</strong> <span class="text-muted">You can add your profile details here later.</span></p>
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
