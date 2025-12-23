<div style="padding: 10px; margin-bottom: 20px; background: #f5f5f5;">
    <?php
    $admin = auth()->guard('admin')->check();
    $user = auth()->check();
    ?>
    
    <a href="{{ route('home') }}">Home</a> |
    <a href="{{ route('about') }}">About</a> |
    
    @if($admin)
        <a href="{{ route('admin_dashboard') }}">Dashboard</a> |
        <a href="{{ route('admin_logout') }}">Logout</a>
    @endif
    
    @if(!$admin && !$user)
        <a href="{{ route('admin_login') }}">Admin Login</a> |
    @endif
    
    @if($user)
        <a href="{{ route('dashboard') }}">Dashboard</a> |
        <a href="{{ route('logout') }}">Logout</a>
    @else
        <a href="{{ route('registration') }}">User Register</a> |
        <a href="{{ route('login') }}">User Login</a>
    @endif
</div>