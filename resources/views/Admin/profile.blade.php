@include('user.top')
<h1>Admin Profile Page</h1>

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

@if($errors->any())
<div style="color: red; background: #f8d7da; padding: 10px; margin: 10px 0;">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin_profile_submit') }}" method="post" enctype="multipart/form-data">
    @csrf

    <!-- Existing Photo -->
    <div>
        <label>Existing Photo:</label><br>
        @if(Auth::guard('admin')->user()->photo == null)
        <p>No Photo Found</p>
        @else
        <img src="{{ asset('uploads/'.Auth::guard('admin')->user()->photo) }}" 
             alt="Profile Photo"
             style="width: 150px;height:auto; border: 1px solid #ddd; border-radius: 5px;">
        @endif
    </div>
    
    <pre></pre>
    
    <!-- Change Photo -->
    <div>
        <label for="photo">Change Photo:</label><br>
        <input type="file" name="photo" id="photo" accept="image/*">
        @error('photo')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    
    <pre></pre>
    
    <!-- Name Field (Missing in your code) -->
    <div>
        <label for="name">Name:</label><br>
        <input type="text" name="name" value="{{ Auth::guard('admin')->user()->name }}">
        @error('name')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <pre></pre>
    <!-- Email -->
    <div>
        <label for="email">Email:</label><br>
        <input type="email" name="email" value="{{ Auth::guard('admin')->user()->email }}">
        @error('email')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    
    <pre></pre>
    <!-- Password Change (Optional) -->
    <div>
        <label for="password">New Password:</label><br>
        <input type="password" name="password">
        @error('password')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    
    <pre></pre>
    
    <div>
        <label for="password_confirmation">Confirm New Password:</label><br>
        <input type="password" name="password_confirmation">
        @error('password_confirmation')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    
    <br>
    
    <button type="submit">Update Profile</button>
</form>