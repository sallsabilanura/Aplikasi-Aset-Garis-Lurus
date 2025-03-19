<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" type="image/png" href="{{ asset('images/aset.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            background-color: #ffffff;
            border: 1px solid #dfe3e8;
        }
        .login-container h3 {
            margin-bottom: 20px;
            color: #2c3e50;
            font-weight: 700;
            text-align: center;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #bdc3c7;
        }
        .btn-primary {
            border-radius: 8px;
            padding: 12px;
            background-color: rgb(137, 139, 255);
            border: none;
        }
        .btn-primary:hover {
            background-color: rgb(137, 139, 255);
        }
        .input-group {
            position: relative;
        }
        .form-check-label {
            color: #2c3e50;
        }
        .text-center a {
            color: #1a73e8;
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        .form-group label {
            color: #34495e;
            font-weight: 600;
        }
        .form-group span {
            color: #e74c3c;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>{{ __('Reset Password') }}</h3>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">E-Mail Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>

            <div class="text-center mt-3">
                <span class="text-muted">Atau</span>
            </div>

            <div class="text-center mt-2">
                <a href="{{ route('login') }}" class="text-decoration-none">Kembali ke Login</a>
            </div>
        </form>
    </div>
</body>
</html>
