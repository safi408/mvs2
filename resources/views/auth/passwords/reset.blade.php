<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
    }
    .card {
      border: none;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    .card-header {
      background: #fff;
      padding: 1.5rem;
      text-align: center;
      border-bottom: none;
    }
    .card-header h3 {
      font-weight: 700;
      color: #333;
    }
    .card-body {
      background: #f8f9ff;
      padding: 2rem;
    }
    .form-label {
      font-weight: 600;
      color: #444;
    }
    .form-control {
      border-radius: 10px;
      padding: 10px 14px;
      border: 1px solid #ddd;
    }
    .btn-primary {
      background-color: #2575fc;
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-weight: 600;
      transition: 0.3s;
    }
    .btn-primary:hover {
      background-color: #1e5edc;
    }
    .text-small {
      font-size: 0.9rem;
      color: #777;
    }
    .icon-box {
      background: #2575fc;
      color: white;
      width: 70px;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      margin: 0 auto 1rem auto;
      font-size: 30px;
      box-shadow: 0 4px 15px rgba(37, 117, 252, 0.3);
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">

          <div class="card-header">
            <div class="icon-box">
              <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h3>Reset Your Password</h3>
            <p class="text-muted mb-0">Enter your new password below to secure your account.</p>
          </div>

          <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
              @csrf

              <input type="hidden" name="token" value="{{ $token }}">

              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ $email ?? old('email') }}" 
                       required autocomplete="email" autofocus
                       placeholder="Enter your registered email">

                @error('email')
                  <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input id="password" type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="new-password"
                       placeholder="Enter new password">

                @error('password')
                  <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password-confirm" class="form-label">Confirm New Password</label>
                <input id="password-confirm" type="password" 
                       class="form-control" name="password_confirmation" 
                       required autocomplete="new-password"
                       placeholder="Re-enter new password">
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                  Reset Password
                </button>
              </div>

              <div class="text-center mt-3">
                <p class="text-small">Remember your password? 
                  <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-semibold">Login here</a>
                </p>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS + Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
