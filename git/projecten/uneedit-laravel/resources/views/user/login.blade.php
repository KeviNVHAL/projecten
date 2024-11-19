<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>

<body>
    <x-header></x-header>
    <main class="main-content">
        <div class="form-container">
            <h2 class="form-title">Login</h2>
            <form id="registration-form" action="{{ route('user.login') }}" method="post">
                @csrf
                <input type="text" name="name" id="name" placeholder="Name" required><br>
                <input type="email" name="email" id="email" placeholder="Email" required><br>
                <input type="password" name="password" id="password" placeholder="Password" required><br>

                <button type="submit">Log in</button>

                <!-- Handle errors using Laravel Blade -->
                @if(session('error'))
                <p style="color:red;">{{ session('error') }}</p>
                @endif
            </form>
        </div>
    </main>
    <x-footer></x-footer>
</body>

</html>