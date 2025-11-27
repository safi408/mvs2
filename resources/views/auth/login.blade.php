<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 30px;
        }

        .login-card h3 {
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 8px rgba(102, 126, 234, 0.4);
        }

        .btn-login {
            background: linear-gradient(to right, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 12px;
            color: #fff;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #555;
        }

        .forgot-link {
            display: block;
            margin-top: 10px;
            font-size: 0.9rem;
            text-decoration: none;
            color: #667eea;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
            color: #764ba2;
        }
    </style>
</head>
<body>



    <div class="login-card">
        <h3 class="text-center">Login</h3>

    {{-- ✅ Success Message --}}
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif 
        
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first() }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
          
             <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label text-black">{{ __('Email Address') }}</label>
                <input id="email" type="email" 
                       class="form-control" 
                       name="email" value="{{ old('email') }}" required>
                {{-- @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
            </div>

        
            
            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label text-black">{{ __('Password') }}</label>
                <input id="password" type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       name="password" required>
                @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

       
                 <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                       {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label text-black" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

             
            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-login">
                    {{ __('Login') }}
                </button>
            </div>

            <!-- Register Link -->
        <div class="text-center mt-3">
            <p class="small">Don't have an account? 
                <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none">Register</a>
            </p>
        </div>

               <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <div class="text-center mt-2">
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif
        </form>
    </div>
</body>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>

