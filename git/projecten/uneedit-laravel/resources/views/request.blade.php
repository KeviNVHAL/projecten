<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNEED-IT - Contact</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/request.css') }}">
    <meta name="description" content="Your one-stop solution for all your IT needs.">
    <meta name="keywords" content="IT, repair, services, phones, laptops, PCs">
</head>

<body>
    <x-header></x-header>
    <main>
        <section class="hero">
            <div class="container">
                <h1>Aanvraag</h1>
                <form action="{{ route('request.create') }}" method="POST">
                    @csrf

                    <!-- Select Platform -->
                    <label for="platform">Select Platform:</label>
                    <select name="device_type" id="platform">
                        <option value="telefoon" {{ old('device_type') == 'telefoon' ? 'selected' : '' }}>Telefoon</option>
                        <option value="pc" {{ old('device_type') == 'pc' ? 'selected' : '' }}>PC</option>
                        <option value="appel pc/mac" {{ old('device_type') == 'appel pc/mac' ? 'selected' : '' }}>Apple PC/Mac</option>
                        <option value="laptop" {{ old('device_type') == 'laptop' ? 'selected' : '' }}>Laptop</option>
                        <option value="other" {{ old('device_type') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('device_type')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    <!-- Device Name -->
                    <label for="device_name">Computer naam/Telefoon naam:</label>
                    <input type="text" name="device_name" placeholder="Computer Name" value="{{ old('device_name') }}">
                    @error('device_name')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    <!-- Email -->
                    <label for="email">Email:</label>
                    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    <!-- Phone Number -->
                    <label for="telephone">Telefoon nummer:</label>
                    <input type="text" name="telephone" placeholder="Phone Number" value="{{ old('telephone') }}">
                    @error('telephone')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    <!-- Problem Description -->
                    <label for="problem">Probleem met product:</label>
                    <textarea name="problem" placeholder="Problem">{{ old('problem') }}</textarea>
                    @error('problem')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    <!-- Submit Button -->
                    <input type="submit" id="btn">
                </form>
            </div>
        </section>
    </main>
    <x-footer></x-footer>
</body>

</html>