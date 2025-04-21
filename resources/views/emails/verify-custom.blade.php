<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .container {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Our Service!</h1>
        <p>Thank you for signing up. To complete your registration, please verify your email address.</p>
        <h1>{{ $user->name }}</h1>
        <p>To verify your email address, please click the button below:</p>
        <h1>Verify Your Email Address</h1>
        <p>Click the button below to verify your email address:</p>
        <a href="{{ $url }}" class="button">Verify Email</a>
    </div>
</body>

</html>
