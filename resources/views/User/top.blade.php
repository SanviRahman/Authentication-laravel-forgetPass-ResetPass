<div style="padding: 10px; margin-bottom: 20px; background: #f5f5f5;">
    <?php
    $admin = auth()->guard('admin')->check();
    $user = auth()->check();
    ?>
    
    <a href="{{ route('home') }}">Home</a> |
    <a href="{{ route('about') }}">About</a> |
    
    @if($admin)
        <a href="{{ route('admin_dashboard') }}">Dashboard</a> |
        <form action="{{ route('admin_logout') }}" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; cursor: pointer;">
                Admin Logout
            </button>
        </form>
    @endif
    
    @if(!$admin && !$user)
        <a href="{{ route('admin_login') }}">Admin Login</a> |
    @endif
    
    @if($user)
        <form action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; cursor: pointer;">
                Logout
            </button>
        </form>
    @else
        <a href="{{ route('registration') }}">User Register</a> |
        <a href="{{ route('login') }}">User Login</a>
    @endif
</div>