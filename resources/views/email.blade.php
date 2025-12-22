<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .button {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h2>{{ $subject }}</h2>
    <p>{{ $body }}</p>
    
    @if(isset($link) && $link)
    <div>
        <a href="{{ $link }}" class="button">Reset Password</a>
    </div>
    <p>Or copy and paste this link in your browser:</p>
    <p><code>{{ $link }}</code></p>
    @endif
    
    <hr>
    <p>Thank you,<br>{{ config('app.name') }}</p>
</body>
</html>