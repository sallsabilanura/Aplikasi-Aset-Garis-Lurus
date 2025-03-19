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
            padding: 10px;
            background-color: rgb(137, 139, 255);
            border: none;
        }
        .btn-primary:hover {
            background-color: rgb(137, 139, 255);
        }
        .input-group {
            position: relative;
        }
        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 10;
            color: #7f8c8d;
        }
        .form-check-label {
            color: #2c3e50;
        }
        .text-center a {
            color: rgb(137, 139, 255);
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        .text-muted {
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>Reset Password</h3>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label for="email" class="form-label">E-Mail Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <span class="eye-icon" onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
    <label for="password-confirm" class="form-label">Confirm Password</label>
    <div class="input-group">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        <span class="eye-icon" onclick="toggleConfirmPasswordVisibility()">
            <i class="fas fa-eye"></i>
        </span>
    </div>
</div>


            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <span class="text-muted">Atau</span>
        </div>

        <div class="text-center mt-2">
            <a href="{{ route('login') }}" class="text-decoration-none">Kembali ke Login</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
    function togglePasswordVisibility() {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.querySelector('.eye-icon i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }

    function toggleConfirmPasswordVisibility() {
        const confirmPasswordField = document.getElementById('password-confirm');
        const confirmEyeIcon = document.querySelector('.eye-icon i');
        if (confirmPasswordField.type === 'password') {
            confirmPasswordField.type = 'text';
            confirmEyeIcon.classList.remove('fa-eye');
            confirmEyeIcon.classList.add('fa-eye-slash');
        } else {
            confirmPasswordField.type = 'password';
            confirmEyeIcon.classList.remove('fa-eye-slash');
            confirmEyeIcon.classList.add('fa-eye');
        }
    }
</script>

</body>
</html>
