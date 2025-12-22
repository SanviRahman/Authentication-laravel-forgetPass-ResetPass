<h1>Admin Reset Password</h1>

@if(session('success'))
    <div style="color: green; background: #d4edda; padding: 10px; margin: 10px 0;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="color: red; background: #f8d7da; padding: 10px; margin: 10px 0;">
        {{ session('error') }}
    </div>
@endif


<form action="{{ route('admin_reset_password_submit', ['token' => $token, 'email' => $email]) }}" method="post">
    @csrf
    
    <!-- New Password -->
    <div>
        <label for="password">New Password</label>
        <input type="password" name="password" id="password" placeholder="Enter new password">
        @error('password')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>
    
    <!-- Confirm Password  -->
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
        @error('password_confirmation')
            <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>
    
    <button type="submit">Reset Password</button>
</form>