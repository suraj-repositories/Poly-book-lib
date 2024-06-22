<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>

    <h2>Login</h2>
    
    @if (session()->has('error'))
        <div>{{ session('error') }}</div>
    @endif
    @if (session()->has('success'))
    <div>{{ session('success') }}</div>
@endif
    <br>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        Email: <input type="email" name="email" id="email" required>
        @error('email')
            <br><small class="danger">{{ $message }}</small>
        @enderror
        <br>
        <br>
        Password : <input type="password" name="password" id="password" required>
        @error('password')
            <br><small class="danger">{{ $message }}</small>
        @enderror
        <br>
        <br>
        <input type="submit" value="submit">
    </form>

</body>

</html>
