<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>

<body>

    <h3>Welcome</h3>

    @guest
        <p>You are currently not logged. Please Login first</p>
        <a href="{{ route('login.page') }}">Login</a> &nbsp;&nbsp; <a href="{{ route('signup.page') }}">Signup</a>
    @endguest

    @auth
        <div>Name : {{ auth()->user()->name }}</div>
        <div>DOB : {{ Auth::user()->dob }}</div>
        <div>Email : {{ Auth::user()->email }}</div>

        @if (Auth::user()->hasRole("USER"))
            <hr>READ + WRITE<hr>
        @endif
        @if (Auth::user()->hasRole("ADMIN"))
            <hr>READ + WRITE + EXECUTE<hr>
        @endif

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">LOGOUT</button>
        </form>
    @endauth

</body>

</html>
