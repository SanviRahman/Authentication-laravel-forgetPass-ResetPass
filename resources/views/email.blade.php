<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <h2>{{ $subject }}</h2>
    <p>{{ $body }}</p>
    
    @if(isset($link) && $link)
    <div>
        <a href="{{ $link }}">Reset Password</a>
    </div>
    <p>Or copy and paste this link in your browser:</p>
    <p><code>{{ $link }}</code></p>
    @endif
    
    <hr>
    <p>Thank you,<br>{{ config('app.name') }}</p>
</body>
</html>