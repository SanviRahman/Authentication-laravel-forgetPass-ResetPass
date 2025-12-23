<div style="padding: 10px; margin-bottom: 20px; background: #f5f5f5; border: 1px solid #ddd; border-radius: 5px;">
    <?php
    $isAdminLoggedIn = auth()->guard('admin')->check();
    $isUserLoggedIn = auth()->guard('web')->check();
    ?>
    
    <!-- Common Links (Always Show) -->
    <a href="{{ route('home') }}" >Home</a> |
    <a href="{{ route('about') }}" >About</a> |
    
    <!-- Admin Links (Show only when Admin is logged in) -->
    @if($isAdminLoggedIn)
        <a href="{{ route('admin_dashboard') }}" >Dashboard</a> |
        <a href="{{ route('admin_profile') }}" >Profile</a> |
        <a href="{{ route('admin_logout') }}">Logout</a>
    
    <!-- User Links (Show only when User is logged in) -->
    @elseif($isUserLoggedIn)
        <a href="{{ route('dashboard') }}" >Dashboard</a> |
        <a href="{{ route('profile') }}" >Profile</a> |
        <a href="{{ route('logout') }}" >Logout</a>
    
    <!-- Guest Links (Show when NO ONE is logged in) -->
    @else
        <a href="{{ route('admin_login') }}" >Admin Login</a> |
        <a href="{{ route('registration') }}" >User Register</a> |
        <a href="{{ route('login') }}" >User Login</a>
    @endif
</div>