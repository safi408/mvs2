<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #74ABE2, #5563DE);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .reset-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            padding: 40px 35px;
            width: 100%;
            max-width: 480px;
            color: #fff;
        }

        .reset-card h3 {
            font-weight: 600;
            text-align: center;
            margin-bottom: 10px;
        }

        .reset-card p {
            text-align: center;
            color: #e1e1e1;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 12px;
            border: none;
            padding: 12px;
            background-color: rgba(255, 255, 255, 0.85);
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(85, 99, 222, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            padding: 12px;
            width: 100%;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a67d8, #6b46c1);
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 12px;
        }

        .footer-text {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #ddd;
        }

        .footer-text a {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="reset-card">
        <h3>🔐 Reset Password</h3>
        <p>Enter your email address below and we’ll send you a password reset link.</p>

        @if (session('status'))
            <div class="alert alert-success text-dark" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold text-white">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <div class="invalid-feedback d-block text-light">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
        </form>

        <div class="footer-text mt-3">
            <a href="{{ route('login') }}">← Back to Login</a>
        </div>
    </div>

</body>
</html>
