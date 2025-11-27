<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - My App</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }
    .auth-card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .auth-header h4 {
      font-weight: 700;
    }
    .form-control {
      border-radius: 0.6rem;
    }
    .btn-custom {
      border-radius: 0.6rem;
      font-weight: 600;
    }
  </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center p-4" style="min-height: 80vh;">
  <div class="col-lg-7 col-md-9">
    <div class="card auth-card">
      
      <!-- Header -->
      <div class="text-center p-4 auth-header">
        <i class="bi bi-person-circle text-success" style="font-size: 3rem;"></i>
        <h4 class="mt-2 text-success">Create Account</h4>
        <p class="text-muted small">Fill the form below to register</p>
      </div>

      <!-- Body -->
      <div class="card-body p-4">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
          @csrf
          
          <div class="row g-3"><!-- Bootstrap Grid -->

            <!-- Name -->
            <div class="col-md-6">
              <label for="name" class="form-label">Full Name</label>
              <input id="name" type="text" 
                class="form-control @error('name') is-invalid @enderror"
                name="name" value="{{ old('name') }}"  autofocus
                placeholder="John Doe">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Email -->
            <div class="col-md-6">
              <label for="email" class="form-label">Email Address</label>
              <input id="email" type="email" 
                class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" 
                placeholder="you@example.com">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Phone -->
            <div class="col-md-6">
              <label for="phone" class="form-label">Phone Number</label>
              <input id="phone" type="text" 
                class="form-control @error('phone') is-invalid @enderror"
                name="phone" value="{{ old('phone') }}" 
                placeholder="+92 300 1234567">
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Profile Image -->
            <div class="col-md-6">
              <label for="profile_image" class="form-label">Profile Image</label>
              <input id="profile_image" type="file" 
                class="form-control @error('profile_image') is-invalid @enderror"
                name="image" accept="image/*">
              @error('profile_image')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Password -->
            <div class="col-md-6">
              <label for="password" class="form-label">Password</label>
              <input id="password" type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"  placeholder="Enter password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Confirm Password -->
            <div class="col-md-6">
              <label for="password-confirm" class="form-label">Confirm Password</label>
              <input id="password-confirm" type="password"
                class="form-control" name="password_confirmation" 
                placeholder="Re-enter password">
            </div>

          </div><!-- /row -->

          <!-- Button -->
          <div class="d-grid mt-4">
            <button type="submit" class="btn btn-success btn-custom">
              <i class="bi bi-person-plus-fill me-1"></i> Register
            </button>
          </div>
        </form>

        <!-- Login Link -->
        <div class="text-center mt-3">
          <p class="small">Already have an account? 
            <a href="{{ route('login') }}" class="fw-bold text-success text-decoration-none">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
