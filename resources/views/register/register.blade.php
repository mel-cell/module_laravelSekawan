<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1>Form Register</h1>
    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <!-- First Name -->
        <label for="first_name">First Name:</label><br>
        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"><br>
        @error('first_name')
            <span class="error">{{ $message }}</span>
        @enderror

        <!-- Last Name -->
        <label for="last_name">Last Name:</label><br>
        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"><br>
        @error('last_name')
            <span class="error">{{ $message }}</span>
        @enderror

        <!-- Username -->
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" value="{{ old('username') }}"><br>
        @error('username')
            <span class="error">{{ $message }}</span>
        @enderror

        <!-- Email -->
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" value="{{ old('email') }}"><br>
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror

        <!-- Password -->
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password"><br>
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror

        <!-- Submit Button -->
        <button type="submit">Register</button>
    </form>
</body>
</html>