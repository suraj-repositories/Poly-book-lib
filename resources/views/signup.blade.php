<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup</title>
    <style>
        .danger {
            color: red;
        }
    </style>
</head>

<body>

    <h2>Signup</h2>

    <form action="{{ route('signup') }}" method="POST">
        @csrf
        name: <input type="text" name="name" id="name" required>
        @error('name')
            <br><small class="danger">{{ $message }}</small>
        @enderror
        <br>
        <br>
        Date of Birth : <input type="date" name="dob" id="dob" required>
        @error('dob')
           <br> <small class="danger">{{ $message }}</small>
        @enderror
        <br>
        <br>
        Email: <input type="email" name="email" id="email" required>
        @error('email')
           <br> <small class="danger">{{ $message }}</small>
        @enderror
        <br>
        <br>
        Password : <input type="password" name="password" id="" required>
        @error('password')
           <br> <small class="danger">{{ $message }}</small>
        @enderror
        <br>
        <br>
        <input type="submit" value="submit">
    </form>

</body>

</html>
