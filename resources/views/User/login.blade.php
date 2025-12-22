  <a href="{{ route('home') }}">Home</a>|
  <a href="{{ route('about') }}">About</a>|
  <a href="{{ route('registration') }}">Register</a>|
  <a href="{{ route('admin_login') }}">Admin Login</a>|
  <a href="{{ route('login') }}">User Login</a>|
 


  <h1>User Login</h1>

  @if(session('success'))
  {{ session('success') }}
  @endif

  @if(session('error'))
  {{ session('error') }}
  @endif

  <form action="{{ route('login_submit') }}" method="post">
      @csrf
      <!-- Email -->
      <label for="email">Email</label>
      <input type="email" name="email" placeholder="Enter Email">
      @error('email')
      <p style="color:red">{{ $message }}</p>
      @enderror

      <pre></pre>
      <!-- Password -->
      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Enter Password">
      @error('password')
      <p style="color:red">{{ $message }}</p>
      @enderror


      <pre></pre>
      <button type="submit">Login</button>

  </form>