<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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
        .feature-list {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .feature-item {
            padding: 8px 0;
            color: #555;
            font-size: 14px;
        }
        .feature-item:before {
            content: "✓ ";
            color: #00C89E;
            font-weight: bold;
            margin-right: 8px;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .action-button {
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
        .action-button:hover {
            background-color: #00B894;
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
            <h1 class="header-title">🎉 Welcome to Lagan Lakshmi Infra!</h1>
        </div>

        <div class="content">
            <p class="greeting">Hello {{ $name }},</p>
            
            <p class="message">
                Thank you for registering with Lagan Lakshmi Infra! We're excited to have you on board.
                Your account has been successfully created and you're ready to start exploring properties.
            </p>

            <div class="feature-list">
                <div class="feature-item">Browse thousands of properties</div>
                <div class="feature-item">Save your favorite listings</div>
                <div class="feature-item">Manage your own property listings</div>
                <div class="feature-item">Connect with other real estate professionals</div>
                <div class="feature-item">Get instant notifications for new properties</div>
            </div>

            <p class="message">
                Get started by completing your profile to unlock all features and help potential buyers 
                or renters find your properties more easily.
            </p>

            <div class="button-container">
                <a href="https://laganlakshmiinfra.com/profile" class="action-button">Complete Your Profile</a>
            </div>

            <p class="message">
                If you have any questions or need assistance, our support team is here to help. 
                Feel free to reach out to us at any time.
            </p>
        </div>

        <div class="footer">
            <p class="footer-text">© {{ date('Y') }} Lagan Lakshmi Infra. All rights reserved.</p>
            <p class="footer-text">This is an automated email, please do not reply directly.</p>
            <p class="footer-text">For support, contact support@laganlakshmiinfra.com</p>
        </div>
    </div>
</body>
</html>
