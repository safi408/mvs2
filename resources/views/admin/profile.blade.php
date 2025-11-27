@extends('layouts.masterlayout')

<style>
    .profile-card {
        border-radius: 15px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .profile-header {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        color: #fff;
        padding: 30px 20px;
        text-align: center;
    }
    .profile-header img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid #fff;
        margin-bottom: 15px;
        object-fit: cover;
    }
    .info-label {
        font-weight: 600;
        color: #6c757d;
    }
    .info-value {
        color: #212529;
    }
    .section-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #0d6efd;
        margin-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 5px;
    }
</style>

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Left Side -->
        <div class="col-md-4">
            <div class="profile-card">
                <div class="profile-header">
                     <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/150' }}" alt="Admin Avatar">
                     <h4 class="mb-0">{{ Auth::user()->name ?? 'Admin Name' }}</h4>
                    <p class="mb-0">{{Auth::user()->role->name ?? 'N/A'}}</p>
                </div>
                <div class="p-3">
                    <div class="mb-3">
                        <span class="info-label"><i class="bi bi-envelope"></i> Email:</span>
                        <p class="info-value mb-0">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                    </div>
                    <div class="mb-3">
                        <span class="info-label"><i class="bi bi-telephone"></i> Phone:</span>
                        <p class="info-value mb-0">{{ Auth::user()->phone ?? '+92 300 1234567' }}</p>
                    </div>
                    <div class="mb-3">
                        <span class="info-label"><i class="bi bi-calendar-check"></i> Member Since:</span>
                        <p class="info-value mb-0">{{ Auth::user()->created_at->format('d M Y') ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="col-md-8">
            <div class="profile-card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="section-title">Personal Information</div>
                    <button class="btn btn-sm btn-primary" onclick="toggleEdit()">Edit</button>
                </div>

                <!-- View Mode -->
                <div id="viewMode">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <span class="info-label">Full Name</span>
                            <p class="info-value">{{ Auth::user()->name ?? 'Admin User' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="info-label">Role</span>
                            <p class="info-value">{{Auth::user()->role->name}}</p>
                        </div>
                        
                    </div>
                </div>

                <!-- Edit Mode -->
                <div id="editMode" style="display:none;">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="info-label mb-1">Full Name</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">
                                 @error('name')
                                     <span class="text-danger">{{$message}}</span>
                                 @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="info-label mb-1">Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" class="form-control">
                                 @error('email')
                                     <span class="text-danger">{{$message}}</span>
                                 @enderror
                            </div>
                                 <div class="col-md-6 mb-3 mb-1">
                                <label class="info-label">Phone</label>
                                <input type="number" name="phone" value="{{ Auth::user()->phone ?? '' }}" class="form-control">
                                 @error('phone')
                                     <span class="text-danger">{{$message}}</span>
                                 @enderror
                            </div>
                                 <div class="col-md-6 mb-3">
                             <label>Profile Image</label>
                            <input type="file" name="profile_image" class="form-control">
                        </div>

                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-secondary" onclick="toggleEdit()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="profile-card p-2 mb-4">
                {{-- <div class="section-title">Settings</div> --}}
                <div class="d-flex justify-content-between align-items-center p-2">
                    <div class="section-title">Settings</div>
                    <button class="btn btn-md mb-2 btn-primary" onclick="passwordEdit()"><i class="bi bi-shield-lock"></i></button>
                </div>

                
                <div id="editMode2" class="p-2" style="display:none;">
                    <h5><i class="bi bi-shield-lock"></i> Change Password</h5>
                      <form action="{{ route('admin.password.update') }}" method="POST">
                    @csrf
                
                 

                   
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" value="" name="password" class="form-control" placeholder="Enter new password" required>
                    </div>

                  
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter new password" required>
                    </div>

                
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-success">update</button>
                        <button type="button" class="btn btn-secondary" onclick="passwordEdit()">Cancel</button>
                    </div>

                </form>
                </div>
            </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item mb-1"><i class="bi bi-shield-lock"></i> Change Password</li>
                    <li class="list-group-item mb-1"><i class="bi bi-bell"></i> Notifications</li>
                    <li class="list-group-item mb-1"><i class="bi bi-gear"></i> Account Settings</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleEdit() {
        document.getElementById('viewMode').style.display =
            document.getElementById('viewMode').style.display === 'none' ? 'block' : 'none';
        document.getElementById('editMode').style.display =
            document.getElementById('editMode').style.display === 'none' ? 'block' : 'none';
    }

    function passwordEdit(){
               document.getElementById('editMode2').style.display =
            document.getElementById('editMode2').style.display === 'none' ? 'block' : 'none';
    }
    
</script>
@endsection
