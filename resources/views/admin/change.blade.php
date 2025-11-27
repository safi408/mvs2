@extends('layouts.masterlayout')

<style>
    .password-card {
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 30px;
    }
    .password-card h4 {
        font-weight: bold;
        color: #0d6efd;
        margin-bottom: 20px;
    }
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    .btn-custom {
        border-radius: 8px;
        padding: 10px 18px;
        font-weight: 500;
    }
</style>

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="password-card">
                <h4><i class="bi bi-shield-lock"></i> Change Password</h4>
                <form action="{{ route('admin.password.update') }}" method="POST">
                    @csrf
                
                    <!-- Current Password -->
                    {{-- <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
                    </div> --}}

                    <!-- New Password -->
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" value="" name="password" class="form-control" placeholder="Enter new password" required>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter new password" required>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="bi bi-check-circle"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
