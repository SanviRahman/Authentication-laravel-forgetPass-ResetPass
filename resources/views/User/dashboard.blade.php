@include('user.top')
<h1>User Dashboard</h1>
<p>
    Welcome {{ Auth::guard('web')->user()->name }} to your dashboard.
</p>