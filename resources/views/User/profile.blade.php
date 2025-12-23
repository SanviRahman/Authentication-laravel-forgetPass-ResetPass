@include('user.top')
<h1>User Profile Page</h1>

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


<form action="{{ route('profile_submit') }}" method="post" enctype="multipart/form-data">
    @csrf

    <!-- Existing Photo -->
    <div>
        <label>Existing Photo:</label><br>
        @if(Auth::guard('web')->user()->photo == null)
        <p>No Photo Found</p>
        @else
        <img src="{{ asset('uploads/'.Auth::guard('web')->user()->photo) }}" alt="Profile Photo"
            style="width: 100px;height:auto; border: 1px solid #ddd; border-radius: 5px;">
        @endif
    </div>
    <br>
    <!-- Change Photo -->
    <div>
        <label for="photo">Change Photo:</label><br>
        <input type="file" name="photo" id="photo" accept="image/*">
        @error('photo')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <!-- Name -->
    <div>
        <label for="name">Name:</label><br>
        <input type="text" name="name" id="name" value="{{  Auth::guard('web')->user()->name }}">
        @error('name')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <!-- Email -->
    <div>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" value="{{ Auth::guard('web')->user()->email }}">
        @error('email')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <!-- Phone -->
    <div>
        <label for="phone">Phone:</label><br>
        <input type="text" name="phone" id="phone" value="{{  Auth::guard('web')->user()->phone }}">
        @error('phone')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <!-- Address -->
    <div>
        <label for="address">Address:</label><br>
        <input type="text" name="address" id="address" value="{{  Auth::guard('web')->user()->address }}">
        @error('address')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <!-- Country -->
    <div>
        <label for="country">Country:</label><br>
        <input type="text" name="country" id="country" value="{{  Auth::guard('web')->user()->country }}">
        @error('country')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <!-- State -->
    <div>
        <label for="state">State:</label><br>
        <input type="text" name="state" id="state" value="{{  Auth::guard('web')->user()->state }}">
        @error('state')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <!-- City -->
    <div>
        <label for="city">City:</label><br>
        <input type="text" name="city" id="city" value="{{ Auth::guard('web')->user()->city }}">
        @error('city')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <!-- Zip -->
    <div>
        <label for="zip">Zip:</label><br>
        <input type="text" name="zip" id="zip" value="{{ Auth::guard('web')->user()->zip }}">
        @error('zip')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>

    <br>

    <!-- Password Change (Optional) -->

    <div>
        <label for="password">New Password:</label><br>
        <input type="password" name="password" id="password">
        @error('password')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <div>
        <label for="password_confirmation">Confirm New Password:</label><br>
        <input type="password" name="password_confirmation" id="password_confirmation">
        @error('password_confirmation')
        <p style="color:red">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <button type="submit">Update Profile</button>
</form>