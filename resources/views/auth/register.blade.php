<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - Bakery</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 2rem;
        }
        .auth-card {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .auth-header h1 {
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }
        .auth-header p {
            color: #666;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
            font-weight: 500;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        .form-group input.error {
            border-color: #dc3545;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .btn-register {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e0e0e0;
        }
        .auth-footer a {
            color: var(--primary-color);
            text-decoration: none;
        }
        .auth-footer a:hover {
            text-decoration: underline;
        }
        .back-to-site {
            text-align: center;
            margin-top: 1rem;
        }
        .back-to-site a {
            color: white;
            text-decoration: none;
            opacity: 0.9;
        }
        .back-to-site a:hover {
            opacity: 1;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div>
            <div class="auth-card">
                <div class="auth-header">
                    <h1>🍰 Admin Registration</h1>
                    <p>Create your admin account</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" 
                               required autofocus autocomplete="name"
                               class="{{ $errors->has('name') ? 'error' : '' }}">
                        @if ($errors->has('name'))
                            <div class="error-message">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" 
                               required autocomplete="username"
                               class="{{ $errors->has('email') ? 'error' : '' }}">
                        @if ($errors->has('email'))
                            <div class="error-message">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" 
                               required autocomplete="new-password"
                               class="{{ $errors->has('password') ? 'error' : '' }}">
                        @if ($errors->has('password'))
                            <div class="error-message">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" 
                               required autocomplete="new-password"
                               class="{{ $errors->has('password_confirmation') ? 'error' : '' }}">
                        @if ($errors->has('password_confirmation'))
                            <div class="error-message">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>

                    <button type="submit" class="btn-register">
                        Register
                    </button>

                    <div class="auth-footer">
                        Already registered? <a href="{{ route('login') }}">Login here</a>
                    </div>
                </form>
            </div>

            <div class="back-to-site">
                <a href="{{ route('home') }}">← Back to Website</a>
            </div>
        </div>
    </div>
</body>
</html>
