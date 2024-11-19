<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>

<body>
    <x-header></x-header>
    <main class="main-content">
        <div class="form-container">
            <h1 class="form-title">Registration</h1>
            <form id="registration-form" action="{{ route('user.create') }}" method="post">
                @csrf

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}" required>
                @error('name')
                <p class="error-message">{{ $message }}</p>
                @enderror
                <br>

                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}" required>
                @error('phone')
                <p class="error-message">{{ $message }}</p>
                @enderror
                <br>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                @error('email')
                <p class="error-message">{{ $message }}</p>
                @enderror
                <br>

                <label for="address">Address:</label>
                <input type="text" name="address" id="address" placeholder="Address" value="{{ old('address') }}" required>
                @error('address')
                <p class="error-message">{{ $message }}</p>
                @enderror
                <br>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
                @error('password')
                <p class="error-message">{{ $message }}</p>
                @enderror
                <br>

                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                @error('password_confirmation')
                <p class="error-message">{{ $message }}</p>
                @enderror
                <br>

                <button type="submit">Register</button>
            </form>
        </div>
    </main>
    <x-footer></x-footer>
</body>

</html>