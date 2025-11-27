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
                    {{-- <span class="badge bg-success px-3 py-2"><i class="bi bi-patch-check-fill"></i> Verified Vendor</span> --}}

                    <hr class="my-4">

                    <div class="d-grid gap-2">
                        {{-- <button class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-gear me-1"></i> Account Settings
                        </button> --}}
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
                    <small class="text-muted">Update your vendor details</small>
                </div>
                <div class="card-body">
                    <form action="{{route('vendor.profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
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

            <!-- Vendor Store Info -->
            {{-- <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-shop me-2 text-primary"></i> Store Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Store Name:</strong> {{ $vendor->store_name ?? 'Not Added' }}</p>
                    <p><strong>City:</strong> {{ $vendor->city ?? '-' }}</p>
                    <p><strong>Country:</strong> {{ $vendor->country ?? '-' }}</p>
                    <p><strong>Status:</strong> 
                        {{-- <span class="badge bg-{{ $vendor->status == 'active' ? 'success' : (vendor -> status == 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($vendor->status ?? 'pending') }}
                        </span> --}}
                    {{-- </p>
                    <p><strong>Description:</strong> {!! $vendor->store_description ?? '<span class="text-muted">No description provided.</span>' !!}</p>
                </div>
            </div> --}}
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
