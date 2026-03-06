<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #00C89E;
            padding-bottom: 20px;
        }
        .header-title {
            color: #00C89E;
            font-size: 28px;
            font-weight: bold;
            margin: 0;
        }
        .content {
            margin: 20px 0;
        }
        .greeting {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }
        .message {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.8;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .reset-button {
            display: inline-block;
            background-color: #00C89E;
            color: white;
            text-decoration: none;
            padding: 14px 40px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .reset-button:hover {
            background-color: #00B894;
        }
        .token-section {
            background-color: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #00C89E;
            margin: 20px 0;
            border-radius: 4px;
        }
        .token-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .token-value {
            font-family: monospace;
            background-color: #fff;
            padding: 10px;
            border-radius: 4px;
            word-break: break-all;
            color: #333;
            font-size: 12px;
        }
        .warning {
            background-color: #fff3cd;
            color: #856404;
            padding: 12px;
            border-radius: 4px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
            font-size: 13px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 12px;
        }
        .footer-text {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="header-title">🔐 Password Reset Request</h1>
        </div>

        <div class="content">
            <p class="greeting">Hi {{ $name }},</p>
            
            <p class="message">
                We received a request to reset the password for your Lagan Lakshmi Infra account. 
                If you didn't make this request, you can safely ignore this email.
            </p>

            <p class="message">
                Click the button below to reset your password. This link will expire in 24 hours.
            </p>

            <div class="button-container">
                <a href="{{ $resetUrl }}" class="reset-button">Reset Password</a>
            </div>

            <p class="message">
                Or copy and paste this link in your browser:
            </p>

            <div class="token-section">
                <div class="token-label">Reset Link</div>
                <div class="token-value">{{ $resetUrl }}</div>
            </div>

            <div class="token-section">
                <div class="token-label">Reset Token (if needed)</div>
                <div class="token-value">{{ $resetToken }}</div>
            </div>

            <div class="warning">
                <strong>Security Note:</strong> This link is unique to your account and will expire in 24 hours. 
                Do not share it with anyone. If you didn't request a password reset, please change your account 
                password immediately.
            </div>

            <p class="message">
                If you have any questions or need further assistance, please contact our support team.
            </p>
        </div>

        <div class="footer">
            <p class="footer-text">© {{ date('Y') }} Lagan Lakshmi Infra. All rights reserved.</p>
            <p class="footer-text">This is an automated email, please do not reply directly.</p>
            <p class="footer-text">If you have questions, contact us at support@laganlakshmiinfra.com</p>
        </div>
    </div>
</body>
</html>
