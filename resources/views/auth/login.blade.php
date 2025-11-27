<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ asset('images/aset.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .login-container {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 1100px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        @media (min-width: 768px) {
            .login-container {
                flex-direction: row;
            }
        }

        .image-section {
            flex: 1.5;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        
        @media (min-width: 768px) {
            .image-section {
                margin-bottom: 0;
            }
        }

        .form-section {
            flex: 1;
            padding-left: 30px;
        }

        .login-container h3 {
            margin-bottom: 25px;
            text-align: center;
            font-weight: 600;
            color: #343a40;
            font-size: 1.8rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ddd;
        }

        .form-label {
            font-size: 0.9rem;
            color: #495057;
        }

        .btn-primary {
            border-radius: 8px;
            padding: 12px;
            background-color: rgb(137, 139, 255);
            border: none;
            color: white;
            font-weight: 600;
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
            color: #6c757d;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #495057;
        }

        .text-center {
            font-size: 0.9rem;
        }

        .text-muted {
            color: #6c757d;
        }

        .text-muted a {
            color: rgb(137, 139, 255);
            text-decoration: none;
        }

        .btn-outline-primary {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid rgb(137, 139, 255);
            color: rgb(137, 139, 255);
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background-color: rgb(137, 139, 255);
            color: white;
        }

        .logo {
            display: block;
            width: 100%;
            max-width: 400px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="image-section">
            <img src="{{ asset('images/bagrone.png') }}" alt="Logo" class="logo">
        </div>
        <div class="form-section">

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
            <h3>Sign In</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" required autofocus placeholder="Enter your email">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control" name="password" required placeholder="Enter your password">
                        <span class="input-group-text eye-icon" onclick="togglePassword()">
                            <i id="eye-icon" class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label for="remember" class="form-check-label">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign In</button>
                <div class="text-center mt-3">
                    <span class="text-muted">Or</span>
                </div>
                <div class="text-center mt-2">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Sign Up</a>
                </div>
                <a href="{{ url('login/google') }}" class="btn btn-danger">
    Login dengan Google
</a>

            </form>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
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
    </script>
</body>
</html>
