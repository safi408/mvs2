@extends('layouts.masterlayout')
@section('content')

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

{{-- Session Messages --}}
{{-- @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif   --}}

            <div class="card shadow-sm border-0">
                <div class="card-header bg-light text-primary">
                    <h6 class="mb-0"><i class="fa fa-user-plus me-2"></i> Add New User</h6>
                </div>

                <div class="card-body">
                    <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       placeholder="Enter full name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       placeholder="Enter email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" 
                                       name="phone" 
                                       id="phone" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       placeholder="+92 300 1234567">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


<!-- Role -->
<div class="col-md-6">
    <label for="role" class="form-label">Select Role</label>
    <select name="role_id" id="role" class="form-select @error('role_id') is-invalid @enderror">
        @foreach($roles as $role)
            @if($role->id != 10) {{-- 10 = Admin Role ID --}}
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endif
        @endforeach
    </select>
    @error('role_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>



                            <!-- Password -->
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Enter password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-12">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       class="form-control" 
                                       placeholder="Re-enter password">
                            </div>
                        </div>

                                                    <!-- Profile Image -->
                            <div class="col-md-12">
                                <label for="image" class="form-label">Profile Image</label>
                                <input type="file" 
                                       name="image" 
                                       id="image" 
                                       class="form-control @error('image') is-invalid @enderror"
                                       accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        <!-- Submit -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn p-2 btn-sm btn-success">
                                <i class="fa fa-save"></i> Save User
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
