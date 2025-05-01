<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RBL - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background:blanchedalmond;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            max-width: 400px;
            width: 90%;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .company-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Logo Circle */
        .logo-wrapper {
            width: 100px;
            height: 100px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(45deg, #0ea5e9, #3b82f6);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            overflow: hidden; /* Ensures the image stays inside the circle */
        }

        .company-img {
            width: 100%;  
            height: 100%;
            object-fit: cover; /* Ensures the image fills the circle without distortion */
            border-radius: 50%; /* Makes sure the image itself is circular */
        }

        .company-name {
            font-size: 32px;
            font-weight: 600;
            color: #1e293b;
            text-align: center;
            margin-top: 10px;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
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
        }

        .btn-primary {
            background: linear-gradient(45deg, #0ea5e9, #3b82f6);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            color: #64748b;
        }

        .login-footer a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.75rem;
            position: absolute;
            bottom: -20px;
            left: 0;
            margin: 0;
        }

        .is-invalid {
            border-color: #dc2626 !important;
            background-image: none !important;
        }

        .is-invalid ~ .input-icon {
            color: #dc2626 !important;
        }

        .form-control {
            height: 48px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .form-control.is-invalid:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1);
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="company-logo">
            <div class="logo-wrapper">
                <img src="{{ asset('images/rbl.png') }}" alt="RBL Logo" class="company-img">
            </div>
            <h2 class="company-name">RBL</h2>
        </div>

        <!-- Update the form section -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <i class="bi bi-envelope input-icon"></i>
                <input type="email" 
                       class="form-control input-with-icon @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       placeholder="Enter your email" 
                       value="{{ old('email') }}"
                       autocomplete="email">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" 
                       class="form-control input-with-icon @error('password') is-invalid @enderror" 
                       id="password" 
                       name="password" 
                       placeholder="Enter your password"
                       autocomplete="current-password">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
            </button>
        </form>

        <div class="login-footer">
            <p>Don't have an account? <a href="{{ route('register') }}">Create Account</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
