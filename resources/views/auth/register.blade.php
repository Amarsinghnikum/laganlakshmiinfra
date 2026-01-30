<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* Register button */
.btn-register {
    width: 100%;
    padding: 12px;
    background: #1a73e8;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
}

.btn-register:hover {
    background: #0f5fd6;
}

.or-text {
    text-align: center;
    margin: 14px 0;
    font-size: 14px;
    color: #888;
    position: relative;
}

/* line left-right */
.or-text::before,
.or-text::after {
    content: "";
    position: absolute;
    top: 50%;
    width: 40%;
    height: 1px;
    background: #ddd;
}

.or-text::before {
    left: 0;
}

.or-text::after {
    right: 0;
}

/* Google wrapper */
.social-login {
    width: 100%;
}

/* Google button */
.google-btn {
    width: 100%;
    padding: 12px;

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;

    background: #fff;
    border: 1px solid #dadce0;
    border-radius: 6px;

    font-size: 15px;
    font-weight: 500;
    color: #3c4043;
    text-decoration: none;

    cursor: pointer;
    transition: all 0.2s ease;
}

/* Hover */
.google-btn:hover {
    background: #f7f8f8;
}

/* Google icon */
.google-btn img {
    width: 18px;
    height: 18px;
}
</style>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, sans-serif;
        }
        body{
            min-height:100vh;
            background:#f3f4f6;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .container{
            max-width:900px;
            width:100%;
            background:#fff;
            display:flex;
            border-radius:10px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
        }
        .form-box{
            padding:50px;
        }
        .form-box h2{
            font-size:32px;
            margin-bottom:30px;
        }
        .input-group{
            margin-bottom:20px;
            position: relative;
        }
        .input-group input{
            width:100%;
            padding:12px 12px 12px 40px;
            border:1px solid #ccc;
            border-radius:5px;
            font-size:14px;
        }
        .input-group i{
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 16px;
        }
        .terms{
            display:flex;
            align-items:center;
            font-size:14px;
            margin-bottom:20px;
        }
        .terms input{
            margin-right:8px;
        }
        button{
            width:100%;
            padding:12px;
            background:#3b82f6;
            border:none;
            color:white;
            font-size:16px;
            border-radius:5px;
            cursor:pointer;
        }
        button:hover{
            background:#2563eb;
        }
        .image-box{
            background:#eef2ff;
            display:flex;
            flex-direction: column;
            align-items:center;
            justify-content:center;
        }
        .image-box img{
            width:90%;
        }
        .image-text{
            font-size:14px;
            margin-top: 10px;
        }
        .error{
            color:red;
            font-size:13px;
            margin-top:5px;
        }

        /* Responsive classes */
        .col-lg-6, .col-md-6, .col-sm-12 {
            width: 50%;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .form-box {
                width: 100% !important;
                padding: 30px;
            }
            .form-box h2 {
                font-size: 28px;
            }
            .image-box {
                display: none;
            }
            .col-lg-6, .col-md-6, .col-sm-12 {
                width: 100%;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .form-box, .image-box {
                width: 50%;
            }
        }

        @media (min-width: 1025px) {
            .form-box, .image-box {
                width: 50%;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <!-- LEFT FORM -->
    <div class="form-box col-lg-6 col-md-6 col-sm-12">
        <h2>Sign up</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Your email">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <i class="fas fa-phone"></i>
                <input type="number" name="phone" value="{{ old('phone') }}" placeholder="Your phone number">
                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password_confirmation" placeholder="Confirm password">
            </div>

            <div class="terms">
                <input type="checkbox" required>
                <label>I agree all statements in Terms of service</label>
            </div>

            <button type="submit">Register</button>
        </form>

        <div class="or-text">OR</div>

        <!-- GOOGLE LOGIN -->
        <div class="social-login">
            <a href="{{ url('auth/google') }}" class="google-btn">
                <img src="https://developers.google.com/identity/images/g-logo.png">
                <span>Login with Google</span>
            </a>
        </div>
    </div>

    <!-- RIGHT IMAGE -->
    <div class="image-box col-lg-6 col-md-6 col-sm-12">
        <img src="https://gloryavenues.com/wp-content/uploads/2025/07/115bd0be35b4ac368e20654832467750.jpg"alt="Login">
        <div class="image-text">
            <a href="{{ route('login') }}">I am already member</a>
        </div>
    </div>

</div>

</body>
</html>