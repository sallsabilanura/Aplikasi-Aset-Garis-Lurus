<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="{{ asset('images/aset.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
       body {
    background-color: #e9ecef;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh; /* Ganti height dengan min-height */
    margin: 0;
    overflow: auto; /* Pastikan bisa di-scroll */
}

.register-container {
    width: 100%;
    max-width: 450px; /* Memperlebar form */
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    overflow-y: auto;
}


        .register-container h3 {
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

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
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
        
    </style>
</head>
<body>
    <div class="register-container">
        <h3>Sign Up</h3>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

          
            <div class="mb-4">
                <label for="email" class="form-label">E-Mail Address</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    <span class="input-group-text eye-icon" onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>

            <div class="mb-4">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control" required>
                    <span class="input-group-text eye-icon" onclick="toggleConfirmPasswordVisibility()">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <h3 class="mt-4" style="color: rgb(137, 139, 255);">Institution Data</h3>
            <div class="mb-4">
                <label for="name" class="form-label">Institution Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>


            <div class="mb-4">
                <label for="Alamat" class="form-label">Address</label>
                <input type="text" id="Alamat" name="Alamat" class="form-control" value="{{ old('Alamat') }}" required>
            </div>

            <div class="mb-4">
                <label for="NoTelp" class="form-label">Phone Number</label>
                <input type="number" id="NoTelp" name="NoTelp" class="form-control" value="{{ old('NoTelp') }}" required>
            </div>

            <div class="mb-4">
                <label for="Gambar" class="form-label">Institution Logo</label>
                <input type="file" id="Gambar" name="Gambar" class="form-control">
            </div>

            <div class="mb-4">
                <label for="NamaPetugas" class="form-label">Officer's Name</label>
                <input type="text" id="NamaPetugas" name="NamaPetugas" class="form-control" value="{{ old('NamaPetugas') }}" required>
            </div>

            <div class="mb-4">
                <label for="Jabatan" class="form-label">Position</label>
                <input type="text" id="Jabatan" name="Jabatan" class="form-control" value="{{ old('Jabatan') }}" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            <div class="text-center mt-3">
                <span class="text-muted">Or</span>
            </div>
            <div class="text-center mt-2">
                <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">Back to Sign In</a>
            </div>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.querySelector('#password ~ .eye-icon i');
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
            const eyeIcon = document.querySelector('#password-confirm ~ .eye-icon i');
            if (confirmPasswordField.type === 'password') {
                confirmPasswordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                confirmPasswordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
