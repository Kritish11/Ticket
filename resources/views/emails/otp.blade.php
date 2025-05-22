<!DOCTYPE html>
<html>
<head>
    <style>
        .container { padding: 20px; font-family: Arial, sans-serif; }
        .otp-box {
            font-size: 32px;
            letter-spacing: 8px;
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Email Verification</h2>
        <p>Hello!</p>
        <p>Your OTP for email verification is:</p>
        <div class="otp-box">{{ $otp }}</div>
        <p>This OTP will expire in 10 minutes.</p>
        <p>If you didn't request this OTP, please ignore this email.</p>
    </div>
</body>
</html>
