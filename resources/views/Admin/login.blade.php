<h1>Admin Login</h1>

@if(session('success'))
    {{ session('success') }}
@endif

@if(session('error'))
    {{ session('error') }}
@endif

<form action="{{ route('admin_login_submit') }}" method="post">
    @csrf
    <!-- Email -->
    <label for="email">Email</label>
    <input type="email" name="email" placeholder="Enter Email">
    @error('email')
    <p style="color:red">This file is required.</p>
    @enderror

    <pre></pre>
    <!-- Password -->
    <label for="password">Password</label>
    <input type="password" name="password" placeholder="Enter Password">
    @error('password')
    <p style="color:red">This file is required.</p>
    @enderror

    <pre></pre>
    <button type="submit">Login</button>
    <button><a href="{{ route('home') }}">Home</a></button>
    <div>
        <a href="{{ route('admin_forget_password') }}">Forget Password</a>
    </div>

</form>