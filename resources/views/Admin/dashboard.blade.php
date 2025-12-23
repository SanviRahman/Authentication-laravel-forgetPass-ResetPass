@include('user.top')
<h1>Admin Dashboard.</h1>
 Welcome {{ Auth::guard('admin')->user()->name }} to your dashboard.
</p>
