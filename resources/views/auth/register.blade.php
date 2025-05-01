<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RBL - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: blanchedalmond;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .register-container {
            max-width: 400px;
            width: 90%;
            background-color: rgba(255, 255, 255, 0.98);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .logo-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            border-radius: 50%;
            overflow: hidden;
            background: linear-gradient(45deg, #0ea5e9, #3b82f6);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .company-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .company-name {
            font-size: 28px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 20px;
            text-align: center;
        }

        .input-group {
            position: relative;
            margin-bottom: 30px;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            z-index: 10;
        }

        .input-with-icon {
            padding-left: 45px;
            width: 100%;
        }

        .form-control {
            height: 50px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .form-control.is-invalid {
            border-color: #dc2626;
            background-color: #fef2f2;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.75rem;
            position: absolute;
            bottom: -22px;
            left: 2px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #0ea5e9, #3b82f6);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            height: 50px;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
        }

        .text-muted {
            margin-top: 25px;
            font-size: 0.95rem;
        }

        .text-muted a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .text-muted a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .register-container {
                padding: 30px;
            }

            .company-name {
                font-size: 24px;
            }

            .logo-wrapper {
                width: 70px;
                height: 70px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-wrapper">
            <img src="{{ asset('images/rbl.png') }}" alt="RBL Logo" class="company-img">
        </div>
        <h2 class="company-name">RBL</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name Field -->
            <div class="input-group">
                <i class="bi bi-person input-icon"></i>
                <input type="text" 
                       class="form-control input-with-icon @error('firstname') is-invalid @enderror"
                       name="firstname" 
                       placeholder="First Name" 
                       value="{{ old('firstname') }}"
                       >
                @error('firstname')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Last Name Field -->
            <div class="input-group">
                <i class="bi bi-person input-icon"></i>
                <input type="text" 
                       class="form-control input-with-icon @error('lastname') is-invalid @enderror"
                       name="lastname" 
                       placeholder="Last Name" 
                       value="{{ old('lastname') }}"
                       >
                @error('lastname')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="input-group">
                <i class="bi bi-envelope input-icon"></i>
                <input type="email" 
                       class="form-control input-with-icon @error('email') is-invalid @enderror"
                       name="email" 
                       placeholder="Email" 
                       value="{{ old('email') }}"
                       >
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="input-group">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" 
                       class="form-control input-with-icon @error('password') is-invalid @enderror"
                       name="password" 
                       placeholder="Password" 
                       >
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="input-group">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" 
                       class="form-control input-with-icon @error('password_confirmation') is-invalid @enderror"
                       name="password_confirmation" 
                       placeholder="Confirm Password" 
                       >
                @error('password_confirmation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center">
                <i class="bi bi-person-plus me-2"></i>
                <span>Create Account</span>
            </button>
        </form>

        <div class="mt-3">
            <p class="text-muted">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
