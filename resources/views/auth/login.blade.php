<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
.social-login{
    margin:15px 0;
}

.google-btn{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    width:100%;
    padding:10px;
    border:1px solid #ddd;
    border-radius:6px;
    text-decoration:none;
    color:#444;
    font-weight:500;
    background:#fff;
}

.google-btn img{
    width:18px;
}

.google-btn:hover{
    background:#f5f5f5;
}

.or-text{
    text-align:center;
    margin:14px 0;
    font-size:14px;
    color:#888;
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
        .links{
            margin-top:15px;
            font-size:14px;
        }
        .links a{
            color:#2563eb;
            text-decoration:none;
            font-weight:600;
        }
        .error{
            color:red;
            font-size:13px;
            margin-top:5px;
        }
        .image-box{
            background:#eef2ff;
            display:flex;
            align-items:center;
            justify-content:center;
            position:relative;
        }
        .image-box img{
            width:80%;
        }
        .image-text{
            position:absolute;
            bottom:20px;
            right:20px;
            font-size:14px;
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

    <!-- LEFT LOGIN FORM -->
    <div class="form-box col-lg-6 col-md-6 col-sm-12">
        <h2>Sign in</h2>

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Your email" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="links">
                <p>
                    Don’t have an account?
                    <a href="{{ route('register') }}">Create one</a>
                </p>
            </div>

            @if(session('error'))
                <div class="error">{{ session('error') }}</div>
            @endif

            <div style="margin-top: 20px;">
                <button type="submit">Login</button>
            </div>

            <div class="or-text">OR</div>

            <!-- GOOGLE LOGIN -->
            <div class="social-login">
                <a href="{{ url('auth/google') }}" class="google-btn">
                    <img src="https://developers.google.com/identity/images/g-logo.png">
                    <span>Login with Google</span>
                </a>
            </div>
        </form>
    </div>
 <!-- RIGHT IMAGE -->
    <div class="image-box col-lg-6 col-md-6 col-sm-12">
        <img src="https://gloryavenues.com/wp-content/uploads/2025/07/115bd0be35b4ac368e20654832467750.jpg" alt="Login">
        <div class="image-text">
        <a href="{{ route('register') }}">welcome back</a>
        </div>
    </div>

</div>

</body>
</html>
